<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Paiement;
use App\Services\FedapayService;
use App\Services\ContentPurchaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $fedapayService;
    protected $purchaseService;
    
    public function __construct(FedapayService $fedapayService, ContentPurchaseService $purchaseService)
    {
        $this->fedapayService = $fedapayService;
        $this->purchaseService = $purchaseService;
    }
    
    /**
     * Initier un paiement pour un contenu
     */
    public function initiate(Request $request, $contenuId)
    {
        try {
            $contenu = Contenu::findOrFail($contenuId);
            $utilisateur = Auth::user();
            
            // Vérifier que le contenu est premium
            if (!$contenu->estPremium()) {
                return redirect()->route('contenu.public.show', $contenu->id_contenu)
                    ->with('error', 'Ce contenu n\'est pas premium.');
            }
            
            // Vérifier si l'utilisateur a déjà acheté
            if ($utilisateur->aAchete($contenu)) {
                return redirect()->route('contenu.public.show', $contenu->id_contenu)
                    ->with('info', 'Vous avez déjà acheté ce contenu.');
            }
            
            // Créer l'enregistrement de paiement
            $paiement = Paiement::create([
                'id_utilisateur' => $utilisateur->id_utilisateur,
                'id_contenu' => $contenu->id_contenu,
                'montant' => $contenu->prix,
                'devise' => 'XOF',
                'statut' => 'en_attente',
            ]);
            
            // Initier la transaction Fedapay
            $transaction = $this->fedapayService->initierPaiement(
                $contenu->prix,
                "Achat de l'article: " . $contenu->titre,
                [
                    'firstname' => $utilisateur->prenom,
                    'lastname' => $utilisateur->nom,
                    'email' => $utilisateur->email,
                ],
                route('payment.callback', ['paiement' => $paiement->id_paiement])
            );
            
            if (!$transaction) {
                $paiement->marquerCommeEchoue();
                return back()->with('error', 'Erreur lors de l\'initiation du paiement.');
            }
            
            // Mettre à jour le paiement avec l'ID de transaction
            $paiement->update([
                'fedapay_transaction_id' => $transaction->id,
                'fedapay_status' => $transaction->status,
            ]);
            
            // Obtenir l'URL de paiement
            $paymentUrl = $this->fedapayService->getUrlPaiement($transaction);
            
            if (!$paymentUrl) {
                $paiement->marquerCommeEchoue();
                return back()->with('error', 'Erreur lors de la génération du lien de paiement.');
            }
            
            // Rediriger vers Fedapay
            return redirect($paymentUrl);
            
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'initiation du paiement: ' . $e->getMessage());
            return back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }
    
    /**
     * Callback après paiement
     */
    public function callback(Request $request, $paiementId)
    {
        try {
            $paiement = Paiement::findOrFail($paiementId);
            
            // Vérifier le statut de la transaction
            $transaction = $this->fedapayService->verifierTransaction($paiement->fedapay_transaction_id);
            
            if (!$transaction) {
                return redirect()->route('payment.cancel')
                    ->with('error', 'Impossible de vérifier le paiement.');
            }
            
            $statut = $this->fedapayService->getStatutTransaction($transaction);
            
            // Mettre à jour le paiement
            $paiement->update([
                'fedapay_status' => $transaction->status,
                'statut' => $statut,
            ]);
            
            if ($statut === 'reussi') {
                // Traiter le paiement réussi
                $this->purchaseService->traiterPaiementReussi($paiement);
                
                return redirect()->route('payment.success', $paiement->id_paiement);
            } else {
                return redirect()->route('payment.cancel')
                    ->with('error', 'Le paiement a échoué.');
            }
            
        } catch (\Exception $e) {
            Log::error('Erreur lors du callback de paiement: ' . $e->getMessage());
            return redirect()->route('payment.cancel')
                ->with('error', 'Une erreur est survenue.');
        }
    }
    
    /**
     * Page de succès
     */
    public function success($paiementId)
    {
        $paiement = Paiement::with(['contenu', 'achat'])->findOrFail($paiementId);
        
        // Vérifier que c'est bien le paiement de l'utilisateur connecté
        if ($paiement->id_utilisateur !== Auth::id()) {
            abort(403);
        }
        
        return view('payment.success', compact('paiement'));
    }
    
    /**
     * Page d'annulation
     */
    public function cancel()
    {
        return view('payment.cancel');
    }
    
    /**
     * Historique des paiements
     */
    public function history()
    {
        $paiements = Paiement::where('id_utilisateur', Auth::user()->id_utilisateur)
            ->with('contenu')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('payment.history', compact('paiements'));
    }
}
