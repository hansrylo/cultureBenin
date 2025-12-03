<?php

namespace App\Http\Controllers;

use App\Models\TypeContenu;
use Illuminate\Http\Request;

class TypeContenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types_contenu = TypeContenu::all();
        return view('types_contenu.index', compact('types_contenu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('types_contenu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        $type_contenu = TypeContenu::create($validated);

        if (method_exists($type_contenu, 'generateAvatar')){
            $type_contenu->generateAvatar();
        }

        return Redirect()->route('types_contenu.index')
                         ->with('success', 'type de contenu créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_type)
    {
        $type_contenu = TypeContenu::findORFail($id_type);
        return view('types_contenu.index', compact('type_contenu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_type)
    {
        $type_contenu = TypeContenu::findOrFail($id_type);

        return view('types_contenu.edit', compact('type_contenu'));
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
    public function destroy(string $id)
    {
        //
    }
}
