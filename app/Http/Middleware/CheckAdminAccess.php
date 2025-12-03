<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('CheckAdminAccess middleware called', [
            'url' => $request->url(),
            'is_authenticated' => auth()->check(),
            'user_id' => auth()->check() ? auth()->user()->id_utilisateur : null,
        ]);

        // Vérifier si l'utilisateur est connecté
        if (!auth()->check()) {
            \Log::info('User not authenticated, redirecting to login');
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // Vérifier si l'utilisateur a accès à la zone admin
        if (!auth()->user()->canAccessAdmin()) {
            \Log::info('User does not have admin access', ['user_id' => auth()->user()->id_utilisateur]);
            abort(403, 'Accès refusé. Vous n\'avez pas les permissions nécessaires pour accéder à cette zone.');
        }

        \Log::info('User has admin access, proceeding', ['user_id' => auth()->user()->id_utilisateur]);
        return $next($request);
    }
}
