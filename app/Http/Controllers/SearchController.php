<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Langue;
use App\Models\Region;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        
        // Return empty results if query is too short
        if (strlen($query) < 2) {
            return response()->json([
                'contenus' => [],
                'regions' => [],
                'langues' => [],
                'total' => 0
            ]);
        }
        
        // Search in contenus (articles)
        $contenus = Contenu::with(['type', 'medias'])
            ->where('statut', 'validé')
            ->where(function($q) use ($query) {
                $q->where('titre', 'like', "%{$query}%")
                  ->orWhere('texte', 'like', "%{$query}%");
            })
            ->latest('date_creation')
            ->limit(5)
            ->get()
            ->map(function($contenu) {
                $imageUrl = null;
                if ($contenu->medias->first()) {
                    try {
                        $imageUrl = \Storage::url($contenu->medias->first()->chemin);
                    } catch (\Exception $e) {
                        // Fallback if Storage driver not configured
                        $imageUrl = null;
                    }
                }
                
                return [
                    'id' => $contenu->id_contenu,
                    'title' => $contenu->titre,
                    'type' => $contenu->type->nom ?? 'Article',
                    'url' => route('contenu.public.show', $contenu->id_contenu),
                    'image' => $imageUrl,
                    'category' => 'contenu'
                ];
            });
        
        // Search in regions
        $regions = Region::where('nom_region', 'like', "%{$query}%")
            ->limit(3)
            ->get()
            ->map(function($region) {
                return [
                    'id' => $region->id_region,
                    'title' => $region->nom_region,
                    'url' => route('Home') . '?region=' . $region->id_region,
                    'category' => 'region'
                ];
            });
        
        // Search in langues
        $langues = Langue::where('nom_langue', 'like', "%{$query}%")
            ->limit(3)
            ->get()
            ->map(function($langue) {
                return [
                    'id' => $langue->id_langue,
                    'title' => $langue->nom_langue,
                    'url' => route('Home') . '?langue=' . $langue->id_langue,
                    'category' => 'langue'
                ];
            });
        
        $total = $contenus->count() + $regions->count() + $langues->count();
        
        return response()->json([
            'contenus' => $contenus,
            'regions' => $regions,
            'langues' => $langues,
            'total' => $total,
            'query' => $query
        ]);
    }
}
