<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentairesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $commentaires = Commentaire::all();
        return view('commentaires.index', compact('commentaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('commentaires.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $commentaire = Commentaire::create([
            'texte' =>$request->texte,
            'date' =>$request->date,
            'note' =>$request->note,
            'id_utilisateur' =>$request->id_utilisateur,
            'id_contenu' =>$request->id_contenu,
        ]);

        if (method_exists($commentaire,'generateAvatar')){
            $commentaire->generateAvatar();
        }

        return Redirect()->route('commentaires.index')
                         ->with('success', 'utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $commentaire = Commentaire::findORFail($id);
        return view('commentaires.index', compact('commentaire'));
    }

    /**u
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $commentaire = Commentaire::findOrFail($id);

        return view('commentaires.edit', compact('commentaire'));
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
    public function destroy(string $id){
        //
    }

    /**
     * Store a public comment from the content page.
     */
    public function storePublic(Request $request, $idContenu)
    {
        $request->validate([
            'texte' => 'required|string|max:1000',
        ]);

        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour commenter.');
        }

        Commentaire::create([
            'texte' => $request->texte,
            'date' => now(),
            'id_utilisateur' => auth()->user()->id_utilisateur,
            'id_contenu' => $idContenu,
        ]);

        return redirect()->back()->with('success', 'Votre commentaire a été ajouté avec succès.');
    }
}
