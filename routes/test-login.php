<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;

// Route de test pour connexion directe
Route::get('/test-login/{email}', function ($email) {
    $user = Utilisateur::where('email', $email)->first();
    
    if (!$user) {
        return "Utilisateur non trouvé: " . $email;
    }
    
    Auth::login($user);
    
    return redirect()->route('contenus.index');
});
