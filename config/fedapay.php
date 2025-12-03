<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Fedapay API Keys
    |--------------------------------------------------------------------------
    |
    | Les clés API Fedapay pour l'authentification. Utilisez les clés sandbox
    | pour les tests et les clés de production pour le déploiement.
    |
    */
    
    'public_key' => env('FEDAPAY_PUBLIC_KEY'),
    'secret_key' => env('FEDAPAY_SECRET_KEY'),
    
    /*
    |--------------------------------------------------------------------------
    | Mode
    |--------------------------------------------------------------------------
    |
    | Le mode d'exécution: 'sandbox' pour les tests, 'live' pour la production
    |
    */
    
    'mode' => env('FEDAPAY_MODE', 'sandbox'),
    
    /*
    |--------------------------------------------------------------------------
    | Environnement
    |--------------------------------------------------------------------------
    |
    | L'environnement Fedapay: 'sandbox' ou 'production'
    |
    */
    
    'environment' => env('FEDAPAY_MODE', 'sandbox') === 'live' ? 'production' : 'sandbox',
    
    /*
    |--------------------------------------------------------------------------
    | Webhook Secret
    |--------------------------------------------------------------------------
    |
    | Le secret utilisé pour valider les webhooks Fedapay
    |
    */
    
    'webhook_secret' => env('FEDAPAY_WEBHOOK_SECRET'),
    
    /*
    |--------------------------------------------------------------------------
    | URLs de callback
    |--------------------------------------------------------------------------
    |
    | Les URLs de retour après paiement
    |
    */
    
    'callback_url' => env('APP_URL') . '/payment/callback',
    'success_url' => env('APP_URL') . '/payment/success',
    'cancel_url' => env('APP_URL') . '/payment/cancel',
    
    /*
    |--------------------------------------------------------------------------
    | Devise par défaut
    |--------------------------------------------------------------------------
    |
    | La devise utilisée pour les transactions (XOF pour le Franc CFA)
    |
    */
    
    'currency' => 'XOF',
    
    /*
    |--------------------------------------------------------------------------
    | Timeout
    |--------------------------------------------------------------------------
    |
    | Timeout pour les requêtes API en secondes
    |
    */
    
    'timeout' => 30,
];
