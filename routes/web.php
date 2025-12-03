<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Page d'accueil publique (SANS auth)
Route::get('/', [HomeController::class, 'index'])->name('Home');
Route::get('/article/{id}', [HomeController::class, 'show'])->name('contenu.public.show');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Routes de paiement
    Route::get('/payment/initiate/{contenu}', [App\Http\Controllers\PaymentController::class, 'initiate'])->name('payment.initiate');
    Route::get('/payment/callback/{paiement}', [App\Http\Controllers\PaymentController::class, 'callback'])->name('payment.callback');
    Route::get('/payment/success/{paiement}', [App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [App\Http\Controllers\PaymentController::class, 'cancel'])->name('payment.cancel');
    Route::get('/payment/history', [App\Http\Controllers\PaymentController::class, 'history'])->name('payment.history');
    
    // Routes des achats
    Route::get('/mes-achats', [App\Http\Controllers\PurchaseController::class, 'index'])->name('mes-achats');
    Route::get('/mes-achats/{contenu}', [App\Http\Controllers\PurchaseController::class, 'show'])->name('mes-achats.show');
});

// Routes d'authentification
require __DIR__.'/auth.php';

// Routes admin
require __DIR__.'/admin.php';

// Routes de test
if (file_exists(base_path('routes/test-login.php'))) {
    require __DIR__.'/test-login.php';
}



