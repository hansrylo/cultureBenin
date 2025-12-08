<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Page d'accueil publique (SANS auth)
Route::get('/', [HomeController::class, 'index'])->name('Home');
Route::get('/article/{id}', [HomeController::class, 'show'])->name('contenu.public.show');

// Route de test pour vérifier la connexion à la base de données
Route::get('/test-db', function() {
    try {
        $contenus = \App\Models\Contenu::count();
        $contenusValides = \App\Models\Contenu::where('statut', 'validé')->count();
        $regions = \App\Models\Region::count();
        $langues = \App\Models\Langue::count();
        
        return response()->json([
            'status' => 'success',
            'database' => config('database.default'),
            'connection' => [
                'driver' => config('database.connections.mysql.driver'),
                'host' => config('database.connections.mysql.host'),
                'port' => config('database.connections.mysql.port'),
                'database' => config('database.connections.mysql.database'),
                'username' => config('database.connections.mysql.username'),
            ],
            'counts' => [
                'contenus_total' => $contenus,
                'contenus_valides' => $contenusValides,
                'regions' => $regions,
                'langues' => $langues
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});




Route::middleware(['auth'])->group(function () {
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

    // Commentaires
    Route::post('/contenus/{id}/commenter', [App\Http\Controllers\CommentairesController::class, 'storePublic'])->name('commentaires.storePublic');
});

// Routes d'authentification
require __DIR__.'/auth.php';

// Routes admin
require __DIR__.'/admin.php';

// Routes de test
if (file_exists(base_path('routes/test-login.php'))) {
    require __DIR__.'/test-login.php';
}



