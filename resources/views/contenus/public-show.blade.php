@extends('layouts.app-public')

@section('title', $contenu->titre . ' - Miwakpon Bénin')

@section('content')
    <!-- Header Spacing -->
    <div style="height: 5px; background-color: white;"></div>

    <!-- Article Header / Hero -->
    <section style="padding: 4rem 2rem; background-color: #fff;">
        <div style="max-width: 900px; margin: 0 auto;">
            <!-- Badge -->
            <div style="margin-bottom: 1.5rem; text-align: center;">
                <span style="background-color: #FCD116; color: var(--color-accent-1); padding: 0.6rem 1.5rem; font-size: 0.9rem; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; box-shadow: 4px 4px 0px var(--color-accent-1);">
                    {{ $contenu->type ? $contenu->type->nom : 'ARTICLE' }}
                </span>
            </div>

            <!-- Badge Premium -->
            @if(isset($estPremium) && $estPremium)
                <div style="margin-bottom: 1rem; text-align: center;">
                    <span style="background-color: #000; color: #FCD116; padding: 0.4rem 1rem; font-size: 0.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; border-radius: 4px; display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="bi bi-star-fill"></i> PREMIUM
                    </span>
                </div>
            @endif

            <!-- Title -->
            <h1 style="font-family: 'Poppins', sans-serif; font-size: 3rem; font-weight: 700; color: var(--color-accent-1); margin: 0 0 2rem 0; line-height: 1.2; text-align: center;">
                {{ $contenu->titre }}
            </h1>

            <!-- Metadata -->
            <div style="display: flex; align-items: center; justify-content: center; gap: 2rem; margin-bottom: 3rem; color: #666; font-size: 0.95rem;">
                @if($contenu->auteur)
                    <div style="display: flex; align-items: center; gap: 0.8rem;">
                        <div style="width: 45px; height: 45px; border-radius: 50%; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                            <i class="bi bi-person-fill" style="font-size: 1.5rem; color: #bbb;"></i>
                        </div>
                        <span style="font-weight: 700; color: var(--color-accent-1); text-transform: uppercase; letter-spacing: 0.5px;">{{ $contenu->auteur->name }}</span>
                    </div>
                @endif

                <!-- Separator -->
                <div style="width: 6px; height: 6px; background-color: var(--color-accent-1); border-radius: 50%;"></div>

                <div style="font-weight: 600; color: #555;">
                    {{ $contenu->created_at ? $contenu->created_at->format('d M Y à H:i') : '' }}
                </div>
                
                @if(isset($estPremium) && $estPremium)
                    <!-- Separator -->
                    <div style="width: 6px; height: 6px; background-color: var(--color-accent-1); border-radius: 50%;"></div>
                    
                    <div style="font-weight: 700; color: #000;">
                        {{ $contenu->prixFormate() }}
                    </div>
                @endif
            </div>

            <!-- Featured Image -->
            @if($contenu->medias && $contenu->medias->count() > 0)
                <div style="width: 100%; height: 500px; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1); margin-bottom: 4rem;">
                    <img src="{{ asset('storage/' . $contenu->medias->first()->chemin) }}" alt="{{ $contenu->titre }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            @endif
        </div>
    </section>

    <!-- Article Content -->
    <section style="padding: 0 2rem 6rem 2rem;">
        <div style="max-width: 800px; margin: 0 auto;">
            
            <!-- Messages Flash -->
            @if(session('error'))
                <div style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border-left: 4px solid #b91c1c;">
                    {{ session('error') }}
                </div>
            @endif
            
            @if(session('info'))
                <div style="background-color: #e0f2fe; color: #0369a1; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border-left: 4px solid #0369a1;">
                    {{ session('info') }}
                </div>
            @endif

            <div style="font-size: 1.2rem; line-height: 1.8; color: #333; font-family: 'Georgia', serif;">
                @if(isset($estPremium) && $estPremium && !$peutAcceder)
                    <!-- Contenu Verrouillé (Aperçu) -->
                    <div style="position: relative;">
                        <div style="margin-bottom: 2rem;">
                            {!! nl2br(e($contenu->texte_apercu)) !!}
                        </div>
                        
                        <!-- Paywall Overlay -->
                        <div style="background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,1) 20%, rgba(255,255,255,1)); padding: 4rem 2rem; text-align: center; margin-top: -100px; position: relative; z-index: 10;">
                            <div style="background: white; border: 2px solid #FCD116; border-radius: 20px; padding: 3rem; box-shadow: 0 20px 50px rgba(0,0,0,0.1); max-width: 500px; margin: 0 auto;">
                                <div style="font-size: 3rem; color: #FCD116; margin-bottom: 1rem;">
                                    <i class="bi bi-lock-fill"></i>
                                </div>
                                <h3 style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #000; margin-bottom: 1rem;">
                                    Contenu Premium
                                </h3>
                                <p style="color: #666; margin-bottom: 2rem;">
                                    Cet article est réservé aux abonnés premium. Achetez-le pour accéder à la suite.
                                </p>
                                <div style="font-size: 2rem; font-weight: 800; color: var(--color-accent-1); margin-bottom: 2rem;">
                                    {{ $contenu->prixFormate() }}
                                </div>
                                
                                @auth
                                    <a href="{{ route('payment.initiate', $contenu->id_contenu) }}" style="display: inline-block; background-color: var(--color-accent-1); color: white; padding: 1rem 2.5rem; border-radius: 50px; font-weight: 700; text-decoration: none; font-size: 1.1rem; box-shadow: 0 10px 20px rgba(var(--color-accent-1-rgb), 0.3); transition: transform 0.2s;">
                                        Acheter l'article
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" style="display: inline-block; background-color: #333; color: white; padding: 1rem 2.5rem; border-radius: 50px; font-weight: 700; text-decoration: none; font-size: 1.1rem; margin-bottom: 1rem;">
                                        Se connecter pour acheter
                                    </a>
                                    <div style="font-size: 0.9rem; color: #888;">
                                        Pas encore de compte ? <a href="{{ route('register') }}" style="color: var(--color-accent-1);">S'inscrire</a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Contenu Complet -->
                    {!! nl2br(e($contenu->texte)) !!}
                @endif
            </div>

            <!-- Tags / Region / Language -->
            <div style="margin-top: 4rem; padding-top: 2rem; border-top: 1px solid #eee; display: flex; gap: 1rem; flex-wrap: wrap;">
                @if($contenu->region)
                    <span style="background: #f8f9fa; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem; color: #666; font-weight: 600;">
                        <i class="bi bi-geo-alt-fill" style="color: var(--color-accent-1); margin-right: 0.5rem;"></i>
                        {{ $contenu->region->nom_region }}
                    </span>
                @endif
                @if($contenu->langue)
                    <span style="background: #f8f9fa; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem; color: #666; font-weight: 600;">
                        <i class="bi bi-translate" style="color: var(--color-accent-1); margin-right: 0.5rem;"></i>
                        {{ $contenu->langue->nom_langue }}
                    </span>
                @endif
            </div>
        </div>
    </section>

    <!-- Related Content -->
    @if(isset($recentContenus) && $recentContenus->count() > 0)
        <section style="padding: 4rem 2rem; background-color: #f8f9fa;">
            <div style="max-width: 1200px; margin: 0 auto;">
                <h3 style="font-family: 'Poppins', sans-serif; font-size: 2rem; font-weight: 700; color: var(--color-accent-1); margin-bottom: 2rem; text-align: center;">
                    À lire aussi
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                    @foreach($recentContenus as $recent)
                        <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform 0.3s ease;">
                            <div style="height: 200px; overflow: hidden;">
                                @if($recent->medias && $recent->medias->count() > 0)
                                    <img src="{{ asset('storage/' . $recent->medias->first()->chemin) }}" alt="{{ $recent->titre }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #eee 0%, #ddd 100%);"></div>
                                @endif
                            </div>
                            <div style="padding: 1.5rem;">
                                <h4 style="font-family: 'Poppins', sans-serif; font-size: 1.2rem; font-weight: 700; margin-bottom: 1rem;">
                                    <a href="{{ route('contenu.public.show', $recent->id_contenu) }}" style="color: var(--color-accent-1); text-decoration: none;">
                                        {{ $recent->titre }}
                                    </a>
                                </h4>
                                <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">
                                    {{ Str::limit($recent->texte, 100) }}
                                </p>
                                <a href="{{ route('contenu.public.show', $recent->id_contenu) }}" style="color: var(--color-accent-1); font-weight: 600; text-decoration: none; font-size: 0.9rem;">
                                    Lire la suite <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
