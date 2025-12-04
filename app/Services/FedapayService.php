<?php

namespace App\Services;

use FedaPay\FedaPay;
use FedaPay\Transaction;
use Exception;
use Illuminate\Support\Facades\Log;

class FedapayService
{
    public function __construct()
    {
        // Configuration de Fedapay
        FedaPay::setApiKey(config('fedapay.secret_key'));
        FedaPay::setEnvironment(config('fedapay.environment'));
    }
    
    /**
     * Initier un paiement Fedapay
     *
     * @param float $montant
     * @param string $description
     * @param array $customer
     * @param string|null $callbackUrl
     * @return Transaction|null
     */
    public function initierPaiement($montant, $description, $customer = [], $callbackUrl = null)
    {
        try {
            Log::info('Initiation paiement FedaPay', ['amount' => $montant, 'type' => gettype($montant)]);
            
            $transaction = Transaction::create([
                'description' => $description,
                'amount' => (int) $montant,
                'currency' => [
                    'iso' => config('fedapay.currency', 'XOF')
                ],
                'callback_url' => $callbackUrl ?? config('fedapay.callback_url'),
                'customer' => $customer,
            ]);
            
            return $transaction;
        } catch (\FedaPay\Error\Base $e) {
            $body = $e->getHttpBody();
            $err  = $e->getJsonBody();
            $errorMessage = isset($err['message']) ? $err['message'] : $e->getMessage();
            if (isset($err['errors'])) {
                $errorMessage .= ' - ' . json_encode($err['errors']);
            }
            Log::error('Erreur FedaPay: ' . $errorMessage);
            throw new Exception("FedaPay Error: " . $errorMessage);
        } catch (Exception $e) {
            Log::error('Erreur lors de l\'initiation du paiement Fedapay: ' . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Vérifier le statut d'une transaction
     *
     * @param string $transactionId
     * @return Transaction|null
     */
    public function verifierTransaction($transactionId)
    {
        try {
            $transaction = Transaction::retrieve($transactionId);
            return $transaction;
        } catch (Exception $e) {
            Log::error('Erreur lors de la vérification de la transaction: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Obtenir l'URL de paiement
     *
     * @param Transaction $transaction
     * @return string|null
     */
    public function getUrlPaiement($transaction)
    {
        try {
            $token = $transaction->generateToken();
            return $token->url;
        } catch (Exception $e) {
            Log::error('Erreur lors de la génération du token de paiement: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Traiter et valider un webhook Fedapay
     *
     * @param array $payload
     * @param string|null $signature
     * @return array|null
     */
    public function traiterWebhook($payload, $signature = null)
    {
        try {
            // Vérification de la signature si fournie
            if ($signature && config('fedapay.webhook_secret')) {
                $expectedSignature = hash_hmac('sha256', json_encode($payload), config('fedapay.webhook_secret'));
                
                if (!hash_equals($expectedSignature, $signature)) {
                    Log::warning('Signature de webhook Fedapay invalide');
                    return null;
                }
            }
            
            // Extraire les informations du webhook
            $event = $payload['entity'] ?? null;
            $transaction = $payload['entity']['transaction'] ?? null;
            
            if (!$transaction) {
                Log::warning('Transaction manquante dans le webhook Fedapay');
                return null;
            }
            
            return [
                'transaction_id' => $transaction['id'] ?? null,
                'status' => $transaction['status'] ?? null,
                'amount' => $transaction['amount'] ?? null,
                'currency' => $transaction['currency']['iso'] ?? null,
                'customer' => $transaction['customer'] ?? null,
                'description' => $transaction['description'] ?? null,
                'event_type' => $payload['name'] ?? null,
            ];
        } catch (Exception $e) {
            Log::error('Erreur lors du traitement du webhook Fedapay: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Obtenir le statut d'une transaction
     *
     * @param Transaction $transaction
     * @return string
     */
    public function getStatutTransaction($transaction)
    {
        $status = $transaction->status ?? 'unknown';
        
        // Mapping des statuts Fedapay vers nos statuts
        $statusMap = [
            'approved' => 'reussi',
            'declined' => 'echoue',
            'canceled' => 'echoue',
            'pending' => 'en_attente',
        ];
        
        return $statusMap[$status] ?? 'en_attente';
    }
}
