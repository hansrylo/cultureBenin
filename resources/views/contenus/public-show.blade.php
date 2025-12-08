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

            <!-- Featured Media (Hero) -->
            @if($contenu->medias && $contenu->medias->count() > 0)
                @php
                    $firstMedia = $contenu->medias->first();
                    $extension = pathinfo($firstMedia->chemin, PATHINFO_EXTENSION);
                    $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'avi', 'mov']);
                @endphp
                <style>
                    @keyframes ambient-glow-entry {
                        0% { opacity: 0; transform: scale(0.95); }
                        100% { opacity: 1; transform: scale(1.15); } /* Increased scale and opacity */
                    }
                    @keyframes ambient-pulse {
                        0% { opacity: 0.8; transform: scale(1.15); }
                        50% { opacity: 0.5; transform: scale(1.1); }
                        100% { opacity: 0.8; transform: scale(1.15); }
                    }
                </style>
                <div style="position: relative; margin-bottom: 6rem; isolation: isolate;"> <!-- Increased margin for bleed -->
                    <!-- Ambient Glow Layer -->
                    <div style="position: absolute; inset: 0; z-index: -1; filter: blur(60px) saturate(2); animation: ambient-glow-entry 1.5s ease-out forwards, ambient-pulse 5s ease-in-out infinite 1.5s; opacity: 0.8; transform: scale(1.15);">
                        @if($isVideo)
                            <video autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover;">
                                <source src="{{ \Storage::url($firstMedia->chemin) }}" type="video/{{ $extension }}">
                            </video>
                        @else
                            <img src="{{ \Storage::url($firstMedia->chemin) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                        @endif
                    </div>

                    <!-- Main Hero Media -->
                    <div style="width: 100%; height: 500px; border-radius: 20px; box-shadow: 0 30px 60px rgba(0,0,0,0.5); position: relative; z-index: 2; background: #000;">
                        @if($isVideo)
                            <video controls style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
                                <source src="{{ \Storage::url($firstMedia->chemin) }}" type="video/{{ $extension }}">
                                Votre navigateur ne supporte pas la lecture de vidéos.
                            </video>
                        @else
                            <img src="{{ \Storage::url($firstMedia->chemin) }}" alt="{{ $contenu->titre }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
                        @endif
                    </div>
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

    <!-- Media Gallery Section -->
    @if($contenu->medias && $contenu->medias->count() > 1)
        <section style="padding: 2rem 2rem 6rem 2rem; background-color: var(--color-accent-3);">
            <div style="max-width: 1200px; margin: 0 auto;">
                <h3 style="font-family: 'Poppins', sans-serif; font-size: 2rem; font-weight: 700; color: var(--color-accent-1); margin-bottom: 2rem; text-align: center;">
                    Galerie Média
                </h3>
                <p style="text-align: center; margin-bottom: 3rem; color: #666;">Découvrez plus d'images et vidéos sur ce sujet.</p>
                
                <div class="gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
                    @foreach($contenu->medias->skip(1) as $index => $media)
                        @php
                            $ext = pathinfo($media->chemin, PATHINFO_EXTENSION);
                            $isVid = in_array(strtolower($ext), ['mp4', 'webm', 'avi', 'mov']);
                            $isPdf = strtolower($ext) === 'pdf';
                        @endphp
                        
                        <div class="gallery-item" style="position: relative; height: 250px; border-radius: 12px; overflow: hidden; cursor: pointer; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;" onclick="{{ $isPdf ? '' : ($isVid ? '' : 'openLightbox(this)') }}">
                            @if($isVid)
                                <video controls style="width: 100%; height: 100%; object-fit: cover;">
                                    <source src="{{ \Storage::url($media->chemin) }}" type="video/{{ $ext }}">
                                </video>
                                <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem;">
                                    <i class="bi bi-play-fill"></i> Vidéo
                                </div>
                            @elseif($isPdf)
                                <div style="width: 100%; height: 100%; background: #f0f0f0; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1rem; padding: 1rem; text-align: center;">
                                    <i class="bi bi-file-earmark-pdf-fill" style="font-size: 3rem; color: #dc3545;"></i>
                                    <span style="font-size: 0.9rem; font-weight: 600;">Document PDF</span>
                                    <a href="{{ \Storage::url($media->chemin) }}" target="_blank" class="btn btn-sm" style="background: var(--color-accent-1); color: white; padding: 0.5rem 1rem; border-radius: 20px; text-decoration: none; font-size: 0.8rem;">
                                        Voir le document
                                    </a>
                                </div>
                            @else
                                <img src="{{ \Storage::url($media->chemin) }}" alt="Galerie image" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" class="gallery-img">
                                <div class="overlay" style="position: absolute; inset: 0; background: rgba(0,0,0,0.2); opacity: 0; transition: opacity 0.3s ease; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-zoom-in" style="color: white; font-size: 2rem;"></i>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Lightbox Modal -->
        <div id="lightbox" style="position: fixed; inset: 0; background: rgba(0,0,0,0.95); z-index: 9999; display: none; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;">
            <button onclick="closeLightbox()" style="position: absolute; top: 2rem; right: 2rem; background: none; border: none; color: white; font-size: 3rem; cursor: pointer; z-index: 10000;">&times;</button>
            <button onclick="prevImage()" style="position: absolute; left: 2rem; background: none; border: none; color: white; font-size: 3rem; cursor: pointer; z-index: 10000; padding: 1rem;">&#10094;</button>
            <button onclick="nextImage()" style="position: absolute; right: 2rem; background: none; border: none; color: white; font-size: 3rem; cursor: pointer; z-index: 10000; padding: 1rem;">&#10095;</button>
            
            <img id="lightbox-img" src="" alt="Full view" style="max-width: 90%; max-height: 90vh; border-radius: 4px; box-shadow: 0 0 50px rgba(0,0,0,0.5);">
        </div>

        <script>
            let currentImageIndex = 0;
            const images = [
                @foreach($contenu->medias->skip(1) as $media)
                    @php
                        $ext = pathinfo($media->chemin, PATHINFO_EXTENSION);
                        $isImg = !in_array(strtolower($ext), ['mp4', 'webm', 'avi', 'mov', 'pdf']);
                    @endphp
                    @if($isImg)
                        "{{ \Storage::url($media->chemin) }}",
                    @endif
                @endforeach
            ];

            function openLightbox(element) {
                const img = element.querySelector('img');
                if (!img) return;
                
                const src = img.src;
                currentImageIndex = images.indexOf(src);
                
                const lightbox = document.getElementById('lightbox');
                const lightboxImg = document.getElementById('lightbox-img');
                
                lightboxImg.src = src;
                lightbox.style.display = 'flex';
                // Trigger reflow
                lightbox.offsetHeight;
                lightbox.style.opacity = '1';
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            }

            function closeLightbox() {
                const lightbox = document.getElementById('lightbox');
                lightbox.style.opacity = '0';
                setTimeout(() => {
                    lightbox.style.display = 'none';
                    document.body.style.overflow = 'auto'; // Restore scrolling
                }, 300);
            }

            function showImage(index) {
                if (index < 0) index = images.length - 1;
                if (index >= images.length) index = 0;
                
                currentImageIndex = index;
                const lightboxImg = document.getElementById('lightbox-img');
                lightboxImg.style.opacity = '0.5';
                
                setTimeout(() => {
                    lightboxImg.src = images[currentImageIndex];
                    lightboxImg.style.opacity = '1';
                }, 200);
            }

            function nextImage() {
                showImage(currentImageIndex + 1);
            }

            function prevImage() {
                showImage(currentImageIndex - 1);
            }
            
            // Hover effects via JS since style block is clean
            document.querySelectorAll('.gallery-item').forEach(item => {
                if(item.querySelector('.overlay')) {
                    item.addEventListener('mouseenter', () => {
                        item.querySelector('.overlay').style.opacity = '1';
                        item.querySelector('img').style.transform = 'scale(1.1)';
                    });
                    item.addEventListener('mouseleave', () => {
                        item.querySelector('.overlay').style.opacity = '0';
                        item.querySelector('img').style.transform = 'scale(1)';
                    });
                }
            });

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (document.getElementById('lightbox').style.display === 'flex') {
                    if (e.key === 'Escape') closeLightbox();
                    if (e.key === 'ArrowLeft') prevImage();
                    if (e.key === 'ArrowRight') nextImage();
                }
            });
        </script>
    @endif

    </section>

    <!-- Comments Section -->
    <section style="padding: 2rem 2rem 6rem 2rem; background-color: #fff; border-top: 1px solid #eee;">
        <div style="max-width: 800px; margin: 0 auto;">
            <h3 style="font-family: 'Poppins', sans-serif; font-size: 1.8rem; font-weight: 700; color: var(--color-accent-1); margin-bottom: 2rem;">
                Commentaires ({{ $contenu->commentaires->count() }})
            </h3>

            <!-- Comment Form -->
            @auth
                <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 12px; margin-bottom: 3rem;">
                    <form action="{{ route('commentaires.storePublic', $contenu->id_contenu) }}" method="POST">
                        @csrf
                        <div style="margin-bottom: 1rem;">
                            <label for="texte" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #555;">Votre réaction</label>
                            <textarea name="texte" id="texte" rows="3" class="form-control" required placeholder="Partagez votre avis sur ce contenu..." style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px; resize: vertical;"></textarea>
                        </div>
                        <div style="text-align: right;">
                            <button type="submit" style="background-color: var(--color-accent-1); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 50px; font-weight: 600; cursor: pointer; transition: background 0.2s;">
                                Publier
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div style="text-align: center; background: #f8f9fa; padding: 2rem; border-radius: 12px; margin-bottom: 3rem;">
                    <p style="margin-bottom: 1rem; color: #666;">Connectez-vous pour partager votre avis.</p>
                    <a href="{{ route('login') }}" style="display: inline-block; background-color: var(--color-accent-1); color: white; padding: 0.6rem 1.5rem; border-radius: 50px; font-weight: 600; text-decoration: none;">
                        Se connecter
                    </a>
                </div>
            @endauth

            <!-- Comments List -->
            <div class="comments-list">
                @forelse($contenu->commentaires as $commentaire)
                    <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
                        <div style="flex-shrink: 0;">
                            <div style="width: 45px; height: 45px; background: #eee; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #888;">
                                {{ substr($commentaire->utilisateur->name ?? 'A', 0, 1) }}
                            </div>
                        </div>
                        <div style="flex-grow: 1;">
                            <div style="background: #f8f9fa; padding: 1rem; border-radius: 12px; border-top-left-radius: 0;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <h5 style="margin: 0; font-size: 0.95rem; font-weight: 700; color: #333;">{{ $commentaire->utilisateur->name ?? 'Anonyme' }}</h5>
                                    <span style="font-size: 0.8rem; color: #999;">{{ $commentaire->created_at ? $commentaire->created_at->diffForHumans() : $commentaire->date }}</span>
                                </div>
                                <p style="margin: 0; color: #555; line-height: 1.5;">{{ $commentaire->texte }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; color: #999; font-style: italic;">Soyez le premier à commenter !</p>
                @endforelse
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
                                    <img src="{{ \Storage::url($recent->medias->first()->chemin) }}" alt="{{ $recent->titre }}" style="width: 100%; height: 100%; object-fit: cover;">
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
