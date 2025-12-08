<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:utilisateurs'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        // Séparer le nom complet en nom et prénom
        $nameParts = explode(' ', $request->name, 2);
        $prenom = $nameParts[0];
        $nom = $nameParts[1] ?? '';

        // Récupérer le rôle par défaut (user)
        $defaultRole = Role::where('nom_role', 'user')->first();
        if (!$defaultRole) {
            // Si le rôle 'user' n'existe pas, créer un utilisateur sans rôle pour l'instant
            $defaultRole = Role::first(); // Prendre le premier rôle disponible
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            // Ajouter le préfixe storage/ pour l'accès via asset()
            $photoPath = 'storage/' . $photoPath;
        }

        $user = Utilisateur::create([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $request->email,
            'mot_de_passe' => Hash::make($request->password),
            'role' => $defaultRole ? $defaultRole->id_role : null,
            'id_langue' => 1, // Langue par défaut (à ajuster selon vos besoins)
            'photo' => $photoPath,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Rediriger vers la page d'accueil après inscription
        return redirect()->route('verification.notice');
    }
}
