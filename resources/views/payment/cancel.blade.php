@extends('layouts.app-public')

@section('title', 'Paiement Annulé - Miwakpon Bénin')

@section('content')
    <div style="height: 5px; background-color: white;"></div>

    <section style="padding: 6rem 2rem; background-color: #f8f9fa; min-height: 80vh; display: flex; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: 20px; padding: 4rem 3rem; box-shadow: 0 20px 60px rgba(0,0,0,0.05); max-width: 600px; width: 100%; text-align: center;">
            
            <div style="width: 100px; height: 100px; background-color: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem auto;">
                <i class="bi bi-x-lg" style="font-size: 3.5rem; color: #dc2626;"></i>
            </div>
            
            <h1 style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #dc2626; margin-bottom: 1rem;">
                Paiement Annulé
            </h1>
            
            <p style="color: #666; font-size: 1.1rem; margin-bottom: 3rem; line-height: 1.6;">
                Le processus de paiement a été annulé ou a échoué. Aucun montant n'a été débité.
                @if(session('error'))
                    <br><span style="color: #dc2626; font-size: 0.9rem;">{{ session('error') }}</span>
                @endif
            </p>
            
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <a href="{{ url()->previous() }}" style="background-color: var(--color-accent-1); color: white; padding: 1rem 2rem; border-radius: 50px; font-weight: 600; text-decoration: none; transition: transform 0.2s;">
                    Réessayer
                </a>
                
                <a href="{{ route('Home') }}" style="background-color: white; color: #666; border: 2px solid #eee; padding: 1rem 2rem; border-radius: 50px; font-weight: 600; text-decoration: none; transition: background 0.2s;">
                    Retour à l'accueil
                </a>
            </div>
        </div>
    </section>
@endsection
