@extends('layouts.app-public')

@section('title', 'Mes Achats - Miwakpon Bénin')

@section('content')
    <div style="height: 5px; background-color: white;"></div>

    <section style="padding: 4rem 2rem; background-color: #f8f9fa; min-height: 80vh;">
        <div style="max-width: 1000px; margin: 0 auto;">
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
                <h1 style="font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--color-accent-1); margin: 0;">
                    Mes Achats
                </h1>
                <div style="background: white; padding: 0.5rem 1.5rem; border-radius: 50px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); font-weight: 600; color: #666;">
                    {{ $achats->count() }} article(s) acheté(s)
                </div>
            </div>

            @if($achats->count() > 0)
                <div style="display: grid; gap: 1.5rem;">
                    @foreach($achats as $achat)
                        <div style="background: white; border-radius: 15px; padding: 1.5rem; display: flex; align-items: center; gap: 2rem; box-shadow: 0 5px 20px rgba(0,0,0,0.03); transition: transform 0.2s ease;">
                            <!-- Image -->
                            <div style="width: 120px; height: 80px; border-radius: 10px; overflow: hidden; flex-shrink: 0;">
                                @if($achat->contenu->medias && $achat->contenu->medias->count() > 0)
                                    <img src="{{ asset('storage/' . $achat->contenu->medias->first()->chemin) }}" alt="{{ $achat->contenu->titre }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #eee 0%, #ddd 100%);"></div>
                                @endif
                            </div>
                            
                            <!-- Info -->
                            <div style="flex-grow: 1;">
                                <h3 style="font-family: 'Poppins', sans-serif; font-size: 1.1rem; font-weight: 700; margin: 0 0 0.5rem 0;">
                                    <a href="{{ route('contenu.public.show', $achat->contenu->id_contenu) }}" style="color: #333; text-decoration: none;">
                                        {{ $achat->contenu->titre }}
                                    </a>
                                </h3>
                                <div style="display: flex; gap: 1.5rem; font-size: 0.9rem; color: #888;">
                                    <span><i class="bi bi-calendar3"></i> Acheté le {{ $achat->date_achat->format('d/m/Y') }}</span>
                                    <span><i class="bi bi-tag"></i> {{ $achat->paiement->montantFormate() }}</span>
                                </div>
                            </div>
                            
                            <!-- Action -->
                            <a href="{{ route('contenu.public.show', $achat->contenu->id_contenu) }}" style="background-color: #f0fdf4; color: #16a34a; padding: 0.8rem 1.5rem; border-radius: 50px; font-weight: 600; text-decoration: none; font-size: 0.9rem; white-space: nowrap;">
                                Lire l'article
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 4rem; background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    <div style="font-size: 4rem; color: #eee; margin-bottom: 1rem;">
                        <i class="bi bi-bag"></i>
                    </div>
                    <h3 style="color: #333; margin-bottom: 1rem;">Aucun achat pour le moment</h3>
                    <p style="color: #888; margin-bottom: 2rem;">Explorez nos articles premium et soutenez la culture béninoise.</p>
                    <a href="{{ route('Home') }}" style="background-color: var(--color-accent-1); color: white; padding: 1rem 2rem; border-radius: 50px; font-weight: 600; text-decoration: none;">
                        Découvrir les articles
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
