<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use Illuminate\Http\Request;

class LangueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langues = Langue::all();
        return view('langues.index', compact('langues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isManager()) {
            return redirect()->route('langues.index')
                ->with('error', 'Vous n\'avez pas les droits pour effectuer cette action.');
        }
        return view('langues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isManager()) {
            return redirect()->route('langues.index')
                ->with('error', 'Vous n\'avez pas les droits pour effectuer cette action.');
        }
        // Validation des données
        $validated = $request->validate([
            'nom_langue' => 'required|string|max:255',
            'code_langue' => 'required|string|max:10|unique:langues,code_langue',
            'description' => 'nullable|string'
        ]);

        $langue = Langue::create($validated);

        if (method_exists($langue, 'generateAvatar')){
            $langue->generateAvatar();
        }

        return redirect()->route('langues.index')
                         ->with('success', 'Langue créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_langue)
    {
        $langue = Langue::findOrFail($id_langue);
        return view('langues.show', compact('langue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_langue)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isManager()) {
            return redirect()->route('langues.index')
                ->with('error', 'Vous n\'avez pas les droits pour effectuer cette action.');
        }
        $langue = Langue::findOrFail($id_langue);
        return view('langues.edit', compact('langue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_langue)
{
    if (!auth()->user()->isAdmin() && !auth()->user()->isManager()) {
        return redirect()->route('langues.index')
            ->with('error', 'Vous n\'avez pas les droits pour effectuer cette action.');
    }
    // Correction de la règle unique pour utiliser 'id_langue' au lieu de 'id'
    $validated = $request->validate([
        'nom_langue' => 'required|string|max:255',
        'code_langue' => 'required|string|max:10|unique:langues,code_langue,' . $id_langue . ',id_langue',
        'description' => 'nullable|string'
    ]);

    $langue = Langue::findOrFail($id_langue);
    $langue->update($validated);

    return redirect()->route('langues.index')
                     ->with('success', 'Langue modifiée avec succès.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_langue)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isManager()) {
            return redirect()->route('langues.index')
                ->with('error', 'Vous n\'avez pas les droits pour effectuer cette action.');
        }
        $langue = Langue::findOrFail($id_langue);
        $langue->delete();
        
        return redirect()->route('langues.index')
                         ->with('success', 'Langue supprimée avec succès.');
    }
}