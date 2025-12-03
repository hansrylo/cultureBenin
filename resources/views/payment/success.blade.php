@extends('layouts.app-public')

@section('title', 'Paiement Réussi - Miwakpon Bénin')

@section('content')
    <div style="height: 5px; background-color: white;"></div>

    <section style="padding: 6rem 2rem; background-color: #f8f9fa; min-height: 80vh; display: flex; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: 20px; padding: 4rem 3rem; box-shadow: 0 20px 60px rgba(0,0,0,0.05); max-width: 600px; width: 100%; text-align: center;">
            
            <div style="width: 100px; height: 100px; background-color: #dcfce7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem auto;">
                <i class="bi bi-check-lg" style="font-size: 3.5rem; color: #16a34a;"></i>
            </div>
            
            <h1 style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #16a34a; margin-bottom: 1rem;">
                Paiement Réussi !
            </h1>
            
            <p style="color: #666; font-size: 1.1rem; margin-bottom: 3rem; line-height: 1.6;">
                Merci pour votre achat. Vous avez maintenant accès à l'article complet.
                Un email de confirmation vous a été envoyé.
            </p>
            
            <div style="background-color: #f8f9fa; padding: 2rem; border-radius: 15px; margin-bottom: 3rem; text-align: left;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; border-bottom: 1px solid #eee; padding-bottom: 1rem;">
                    <span style="color: #888;">Article</span>
                    <span style="font-weight: 600; color: #333;">{{ $paiement->contenu->titre }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; border-bottom: 1px solid #eee; padding-bottom: 1rem;">
                    <span style="color: #888;">Montant</span>
                    <span style="font-weight: 600; color: #333;">{{ $paiement->montantFormate() }}</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: #888;">Référence</span>
                    <span style="font-weight: 600; color: #333;">#{{ $paiement->id_paiement }}</span>
                </div>
            </div>
            
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('contenu.public.show', $paiement->contenu->id_contenu) }}" style="background-color: var(--color-accent-1); color: white; padding: 1rem 2rem; border-radius: 50px; font-weight: 600; text-decoration: none; transition: transform 0.2s;">
                    Lire l'article maintenant
                </a>
                
                <a href="{{ route('mes-achats') }}" style="background-color: white; color: #666; border: 2px solid #eee; padding: 1rem 2rem; border-radius: 50px; font-weight: 600; text-decoration: none; transition: background 0.2s;">
                    Voir mes achats
                </a>
            </div>
        </div>
    </section>
@endsection
