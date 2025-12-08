<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Auth\Access\AuthorizationException;

class HandleInvalidSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (InvalidSignatureException $e) {
            // Si la signature est invalide, rediriger avec un message d'erreur
            return redirect()->route('verification.notice')
                ->withErrors(['email' => 'Le lien de vérification est invalide ou a expiré. Veuillez demander un nouveau lien.']);
        } catch (AuthorizationException $e) {
            // Si l'utilisateur n'est pas autorisé (ID ne correspond pas)
            return redirect()->route('verification.notice')
                ->withErrors(['email' => 'Ce lien de vérification ne vous appartient pas ou est invalide.']);
        }
    }
}
