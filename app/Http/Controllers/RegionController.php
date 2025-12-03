<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Region::all();
        return view('regions.index', compact('regions'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('langues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'nom_region' => 'required|string|max:255',
            'description' => 'nullable|string',
            'population' =>'nullable|int',
            'superficie'=>'nullable|int',
            'localisation'=> 'nullable|int',
        ]);

        $region = Region::create($validated);

        if (method_exists($region, 'generateAvatar')){
            $region->generateAvatar();
        }

        return redirect()->route('langues.index')
                         ->with('success', 'Region créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_region)
    {
        $region = Region::findOrFail($id_region);
        return view('regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_region)
    {
        $region = Region::findOrFail($id_region);
        return view('regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_region)
{
    // Correction de la règle unique pour utiliser 'id_langue' au lieu de 'id'
    $validated = $request->validate([
        'nom_region' => 'required|string|max:255',
        'description' => 'nullable|string',
        'population' =>'nullable|int',
        'superficie'=>'nullable|int',
        'localisation'=> 'nullable|int',
    ]);

    $region = Region::findOrFail($id_region);
    $region->update($validated);

    return redirect()->route('regions.index')
                     ->with('success', 'Region modifiée avec succès.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_region)
    {
        $region = Region::findOrFail($id_region);
        $region->delete();
        
        return redirect()->route('regions.index')
                         ->with('success', 'Region supprimée avec succès.');
    }
}
