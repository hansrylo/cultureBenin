<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckContentAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $contenu = $request->route('contenu');
        
        // Si ce n'est pas un objet Contenu (ex: ID), on le récupère
        if (!($contenu instanceof \App\Models\Contenu)) {
            $contenu = \App\Models\Contenu::find($contenu);
        }

        // Si le contenu n'existe pas ou n'est pas premium, on laisse passer
        if (!$contenu || !$contenu->estPremium()) {
            return $next($request);
        }

        // Si l'utilisateur est l'auteur, on laisse passer
        if (auth()->check() && auth()->user()->id_utilisateur === $contenu->id_auteur) {
            return $next($request);
        }

        // Si l'utilisateur a acheté le contenu, on laisse passer
        if (auth()->check() && auth()->user()->aAchete($contenu)) {
            return $next($request);
        }

        // Sinon, on redirige vers la page de paiement ou on affiche une erreur
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Contenu Premium. Veuillez acheter pour accéder.'], 403);
        }

        return redirect()->route('contenu.public.show', $contenu->id_contenu)
            ->with('info', 'Ce contenu est réservé aux abonnés premium. Veuillez l\'acheter pour y accéder.');
    }
}
