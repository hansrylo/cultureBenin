<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\TypeContenu;
use App\Models\Langue;
use App\Models\Region;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class ContenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contenus = Contenu::with(['type', 'auteur', 'langue', 'region', 'moderateur', 'parentContenu'])->get();
        return view('contenus.index', compact('contenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = TypeContenu::all();
        $langues = Langue::all();
        $regions = Region::all();
        $utilisateurs = Utilisateur::where('statut', 'actif')->get();
        $contenus = Contenu::all();
        
        return view('contenus.create', compact('types', 'langues', 'regions', 'utilisateurs', 'contenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'id_type' => 'required|exists:type_contenus,id_type',
            'texte' => 'required',
            'statut' => 'required|in:en attente,validé,rejeté',
            'id_langue' => 'required|exists:langues,id_langue',
            'id_region' => 'required|exists:regions,id_region',
            'parent' => 'nullable|exists:contenus,id_contenu',
            'id_moderateur' => 'nullable|exists:utilisateurs,id_utilisateur',
            'date_validation' => 'nullable|date',
        ]);
        
        // Auto-fill fields
        $validated['date_creation'] = now();
        $validated['id_auteur'] = auth()->user()->id_utilisateur;
        
        $contenu = Contenu::create($validated);

        return redirect()->route('contenus.index')
                         ->with('success', 'Contenu créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_contenu)
    {

        
        $contenu = Contenu::findORFail($id_contenu);
        return view('contenus.index', compact('contenu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_contenu)
    {
        $contenu = Contenu::findOrFail($id_contenu);
        $types = TypeContenu::all();
        $langues = Langue::all();
        $regions = Region::all();
        $utilisateurs = Utilisateur::where('statut', 'actif')->get();
        $contenus = Contenu::where('id_contenu', '!=', $id_contenu)->get();

        return view('contenus.edit', compact('contenu', 'types', 'langues', 'regions', 'utilisateurs', 'contenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_contenu)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'id_type' => 'required|exists:type_contenus,id_type',
            'texte' => 'required',
            'statut' => 'required|in:en attente,validé,rejeté',
            'id_langue' => 'required|exists:langues,id_langue',
            'id_region' => 'required|exists:regions,id_region',
            'parent' => 'nullable|exists:contenus,id_contenu',
            'id_moderateur' => 'nullable|exists:utilisateurs,id_utilisateur',
            'date_validation' => 'nullable|date',
        ]);

        $contenu = Contenu::findOrFail($id_contenu);
        $contenu->update($validated);

        return redirect()->route('contenus.index')
                       ->with('success', 'Contenu modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
