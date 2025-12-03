<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Services\FedapayService;
use App\Services\ContentPurchaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    protected $fedapayService;
    protected $purchaseService;
    
    public function __construct(FedapayService $fedapayService, ContentPurchaseService $purchaseService)
    {
        $this->fedapayService = $fedapayService;
        $this->purchaseService = $purchaseService;
    }
    
    /**
     * Gérer les webhooks Fedapay
     */
    public function handle(Request $request)
    {
        try {
            // Récupérer la signature du webhook
            $signature = $request->header('X-Fedapay-Signature');
            
            // Traiter le webhook
            $webhookData = $this->fedapayService->traiterWebhook(
                $request->all(),
                $signature
            );
            
            if (!$webhookData) {
                Log::warning('Webhook Fedapay invalide');
                return response()->json(['error' => 'Invalid webhook'], 400);
            }
            
            // Récupérer le paiement correspondant
            $paiement = Paiement::where('fedapay_transaction_id', $webhookData['transaction_id'])->first();
            
            if (!$paiement) {
                Log::warning('Paiement non trouvé pour la transaction: ' . $webhookData['transaction_id']);
                return response()->json(['error' => 'Payment not found'], 404);
            }
            
            // Mettre à jour le statut du paiement
            $paiement->update([
                'fedapay_status' => $webhookData['status'],
                'statut' => $this->mapStatus($webhookData['status']),
                'methode_paiement' => $webhookData['customer']['payment_method'] ?? null,
            ]);
            
            // Si le paiement est réussi, créer l'achat
            if ($paiement->statut === 'reussi') {
                $this->purchaseService->traiterPaiementReussi($paiement);
            }
            
            Log::info('Webhook Fedapay traité avec succès pour le paiement: ' . $paiement->id_paiement);
            
            return response()->json(['success' => true], 200);
            
        } catch (\Exception $e) {
            Log::error('Erreur lors du traitement du webhook Fedapay: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
    
    /**
     * Mapper les statuts Fedapay vers nos statuts
     */
    private function mapStatus($fedapayStatus)
    {
        $statusMap = [
            'approved' => 'reussi',
            'declined' => 'echoue',
            'canceled' => 'echoue',
            'pending' => 'en_attente',
        ];
        
        return $statusMap[$fedapayStatus] ?? 'en_attente';
    }
}
