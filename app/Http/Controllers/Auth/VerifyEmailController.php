<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Vérifier si l'utilisateur existe
        if (!$request->user()) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Utilisateur non trouvé. Veuillez vous reconnecter.']);
        }

        // Vérifier si l'email est déjà vérifié
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('Home', absolute: false))
                ->with('info', 'Votre email est déjà vérifié.');
        }

        // Marquer l'email comme vérifié
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            
            return redirect()->intended(route('Home', absolute: false).'?verified=1')
                ->with('success', 'Votre email a été vérifié avec succès !');
        }

        // Si la vérification échoue pour une raison quelconque
        return redirect()->route('verification.notice')
            ->withErrors(['email' => 'La vérification de votre email a échoué. Veuillez réessayer.']);
    }
}
