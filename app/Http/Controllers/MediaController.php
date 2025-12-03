<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medias = Media::with(['contenu'])->get();
        return view('medias.index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contenus = \App\Models\Contenu::with('type')->where('statut', 'validé')->get();
        return view('medias.create', compact('contenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fichier' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,webm,avi,mov|max:10240',
            'id_contenu' => 'required|exists:contenus,id_contenu',
            'description' => 'nullable|string|max:500',
        ]);

        // Upload du fichier
        $path = $request->file('fichier')->store('medias', 'public');

        // Création du média
        $media = Media::create([
            'chemin' => $path,
            'description' => $validated['description'],
            'id_contenu' => $validated['id_contenu'],
        ]);

        return redirect()->route('medias.index')
                         ->with('success', 'Média ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $media = Media::with(['contenu'])->findOrFail($id);
        return view('medias.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $media = Media::findOrFail($id);

        return view('medias.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $media)
    {
        $mediaModel = Media::findOrFail($media);
        
        // Supprimer le fichier du storage
        if ($mediaModel->chemin && \Storage::disk('public')->exists($mediaModel->chemin)) {
            \Storage::disk('public')->delete($mediaModel->chemin);
        }
        
        // Supprimer l'enregistrement de la base de données
        $mediaModel->delete();
        
        return redirect()->route('medias.index')
                         ->with('success', 'Média supprimé avec succès.');
    }
}
