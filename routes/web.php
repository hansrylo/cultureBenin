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
});

// Routes d'authentification
require __DIR__.'/auth.php';

// Routes admin
require __DIR__.'/admin.php';

// Routes de test
if (file_exists(base_path('routes/test-login.php'))) {
    require __DIR__.'/test-login.php';
}



