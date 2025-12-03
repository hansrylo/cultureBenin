<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Role;
use App\Models\Langue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Précharger les relations pour éviter les requêtes N+1
        $utilisateurs = Utilisateur::with(['role', 'langue'])->get();
        return view('utilisateurs.index', compact('utilisateurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $langues = Langue::all();
        return view('utilisateurs.create', compact('roles', 'langues'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'mot_de_passe' => 'required|string|min:8',
            'role' => 'required|exists:roles,id_role',
            'id_langue' => 'nullable|exists:langues,id_langue',
            'date_naissance' => 'nullable|date',
            'sexe' => 'nullable|in:M,F,Autre',
        ]);

        // Hachage du mot de passe
        $validated['mot_de_passe'] = Hash::make($validated['mot_de_passe']);
        
        // Valeurs par défaut
        $validated['date_inscription'] = now();
        $validated['statut'] = 'actif';
        
        // Gestion de la photo si nécessaire (non implémenté dans le formulaire actuel mais présent dans le modèle)
        if ($request->has('photo')) {
            $validated['photo'] = $request->photo;
        }

        $utilisateur = Utilisateur::create($validated);

        event(new Registered($utilisateur));

        if (method_exists($utilisateur,'generateAvatar')){
            $utilisateur->generateAvatar();
        }

        return redirect()->route('utilisateurs.index')
                         ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        return view('utilisateurs.show', compact('utilisateur'));
    }

    /**u
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);

        // Précharger les listes pour les selects
        $roles = Role::all();
        $langues = Langue::all();

        return view('utilisateurs.edit', compact('utilisateur', 'roles', 'langues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);

        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email,'.$utilisateur->id_utilisateur.',id_utilisateur',
            'role' => 'required|exists:roles,id_role',
            'id_langue' => 'nullable|exists:langues,id_langue',
            'date_naissance' => 'nullable|date',
            'sexe' => 'nullable|in:M,F,Autre',
            'statut' => 'nullable|in:actif,inactif,banni',
        ]);

        // Gestion du mot de passe (laisser vide pour ne pas modifier)
        if ($request->filled('mot_de_passe')) {
            $data['mot_de_passe'] = Hash::make($request->mot_de_passe);
        }

        // Mettre à jour le modèle
        $utilisateur->update($data);

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
