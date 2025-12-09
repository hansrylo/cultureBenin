<?php

namespace App\Http\Controllers;

use App\Services\ContentPurchaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    protected $purchaseService;
    
    public function __construct(ContentPurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }
    
    /**
     * Liste des contenus achetés par l'utilisateur
     */
    public function index()
    {
        $achats = $this->purchaseService->getAchatsUtilisateur(Auth::user());
        
        return view('purchases.index', compact('achats'));
    }
    
    /**
     * Afficher un contenu acheté
     */
    public function show($contenuId)
    {
        $utilisateur = Auth::user();
        
        // Vérifier que l'utilisateur a acheté ce contenu
        if (!$utilisateur->aAchete($contenuId)) {
            return redirect()->route('mes-achats')
                ->with('error', 'Vous n\'avez pas acheté ce contenu.');
        }
        
        // Rediriger vers la page de visualisation du contenu
        return redirect()->route('contenu.public.show', $contenuId);
    }
}
