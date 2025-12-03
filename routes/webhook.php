<?php

use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

// Route webhook Fedapay (sans middleware CSRF)
Route::post('/webhook/fedapay', [WebhookController::class, 'handle'])->name('webhook.fedapay');
