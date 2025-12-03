<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Langue;
use App\Models\Region;

class HomeController extends Controller
{
    public function index()
    {
        // Contenu vedette (le plus récent avec statut validé)
        $featured = Contenu::with(['type', 'medias'])
            ->where('statut', 'validé')
            ->latest('date_creation')
            ->first();
        
        // Récupérer les médias du contenu vedette (jusqu'à 3)
        $featuredMedias = $featured && $featured->medias ? $featured->medias->take(3) : collect();
        
        // Tous les contenus pour les autres sections
        $contenus = Contenu::with(['type', 'medias'])
            ->where('statut', 'validé')
            ->latest('date_creation')
            ->get();
            
        $regions = Region::all();
        $langues = Langue::all();
        $stats_contenus = Contenu::count();
        $stats_langues = Langue::count();
        $stats_regions = Region::count();
        
        return view('welcome-public', compact('featured', 'featuredMedias', 'contenus', 'regions', 'langues'));
    }

    public function show($id)
    {
        $contenu = Contenu::with(['type', 'medias', 'auteur', 'langue', 'region'])->findOrFail($id);
        
        // Récupérer d'autres contenus récents pour la sidebar ou suggestions
        $recentContenus = Contenu::where('statut', 'validé')
            ->where('id_contenu', '!=', $id)
            ->latest('date_creation')
            ->take(3)
            ->get();

        return view('contenus.public-show', compact('contenu', 'recentContenus'));
    }
}
