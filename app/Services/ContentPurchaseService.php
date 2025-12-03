<?php

namespace App\Services;

use App\Models\Paiement;
use App\Models\AchatContenu;
use App\Models\Contenu;
use App\Models\Utilisateur;
use App\Notifications\PurchaseConfirmation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class ContentPurchaseService
{
    protected $fedapayService;
    
    public function __construct(FedapayService $fedapayService)
    {
        $this->fedapayService = $fedapayService;
    }
    
    /**
     * Créer un enregistrement d'achat
     *
     * @param Utilisateur $utilisateur
     * @param Contenu $contenu
     * @param Paiement $paiement
     * @return AchatContenu|null
     */
    public function creerAchat($utilisateur, $contenu, $paiement)
    {
        try {
            // Vérifier si l'achat existe déjà
            $achatExistant = AchatContenu::where('id_utilisateur', $utilisateur->id_utilisateur)
                                        ->where('id_contenu', $contenu->id_contenu)
                                        ->first();
            
            if ($achatExistant) {
                Log::info('Achat déjà existant pour l\'utilisateur ' . $utilisateur->id_utilisateur . ' et le contenu ' . $contenu->id_contenu);
                return $achatExistant;
            }
            
            // Créer l'achat
            $achat = AchatContenu::create([
                'id_utilisateur' => $utilisateur->id_utilisateur,
                'id_contenu' => $contenu->id_contenu,
                'id_paiement' => $paiement->id_paiement,
                'date_achat' => now(),
            ]);
            
            return $achat;
        } catch (Exception $e) {
            Log::error('Erreur lors de la création de l\'achat: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Vérifier si un utilisateur peut accéder à un contenu
     *
     * @param Utilisateur|null $utilisateur
     * @param Contenu $contenu
     * @return bool
     */
    public function verifierAcces($utilisateur, $contenu)
    {
        // Si le contenu n'est pas premium, tout le monde peut y accéder
        if (!$contenu->estPremium()) {
            return true;
        }
        
        // Si l'utilisateur n'est pas connecté, pas d'accès
        if (!$utilisateur) {
            return false;
        }
        
        // Si l'utilisateur est l'auteur, il peut accéder
        if ($contenu->id_auteur == $utilisateur->id_utilisateur) {
            return true;
        }
        
        // Vérifier si l'utilisateur a acheté le contenu
        return $utilisateur->aAchete($contenu);
    }
    
    /**
     * Traiter un paiement réussi
     *
     * @param Paiement $paiement
     * @return bool
     */
    public function traiterPaiementReussi($paiement)
    {
        try {
            DB::beginTransaction();
            
            // Marquer le paiement comme réussi
            $paiement->marquerCommeReussi();
            
            // Créer l'achat
            $achat = $this->creerAchat(
                $paiement->utilisateur,
                $paiement->contenu,
                $paiement
            );
            
            if (!$achat) {
                throw new Exception('Impossible de créer l\'achat');
            }
            
            // Envoyer la notification de confirmation
            $paiement->utilisateur->notify(new PurchaseConfirmation($paiement, $achat));
            
            DB::commit();
            
            Log::info('Paiement traité avec succès: ' . $paiement->id_paiement);
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors du traitement du paiement réussi: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Obtenir les statistiques de vente
     *
     * @return array
     */
    public function getStatistiques()
    {
        try {
            $stats = [
                'total_ventes' => Paiement::reussis()->count(),
                'revenu_total' => Paiement::reussis()->sum('montant'),
                'articles_vendus' => AchatContenu::distinct('id_contenu')->count(),
                'clients_uniques' => AchatContenu::distinct('id_utilisateur')->count(),
                'ventes_par_mois' => Paiement::reussis()
                    ->selectRaw('DATE_FORMAT(date_paiement, "%Y-%m") as mois, COUNT(*) as nombre, SUM(montant) as revenu')
                    ->groupBy('mois')
                    ->orderBy('mois', 'desc')
                    ->limit(12)
                    ->get(),
                'top_articles' => Contenu::withCount('achats')
                    ->where('est_premium', true)
                    ->orderBy('achats_count', 'desc')
                    ->limit(10)
                    ->get(),
            ];
            
            return $stats;
        } catch (Exception $e) {
            Log::error('Erreur lors de la récupération des statistiques: ' . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Obtenir les achats d'un utilisateur
     *
     * @param Utilisateur $utilisateur
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAchatsUtilisateur($utilisateur)
    {
        return AchatContenu::where('id_utilisateur', $utilisateur->id_utilisateur)
                          ->with(['contenu', 'paiement'])
                          ->orderBy('date_achat', 'desc')
                          ->get();
    }
}
