@extends('layouts.app-public')

@section('title', 'Miwakpon Bénin - Découvrez la Culture')

@section('content')


            <style>
                .card-link {
                    display: block;
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }
                .card-link:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
                }
                
                .card-link:hover .card-overlay {
                    opacity: 1 !important;
                }
                
                .card-link:hover img {
                    transform: scale(1.1);
                }
                
                @keyframes float {
                    0%, 100% { transform: translateY(0px); }
                    50% { transform: translateY(-20px); }
                }
                
                @keyframes pulse {
                    0%, 100% { opacity: 0.6; }
                    50% { opacity: 0.3; }
                }
                
                .decorative-circle {
                    position: absolute;
                    border-radius: 50%;
                    opacity: 0.08;
                    pointer-events: none;
                }
                
                .hero-accent {
                    position: absolute;
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    background: linear-gradient(135deg, #FCD116 0%, #E8B923 100%);
                    opacity: 0.15;
                    animation: float 6s ease-in-out infinite;
                }

                /* Responsive adjustments */
                .agenda-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                    gap: 2rem;
                }
                .gallery-grid {
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    grid-template-rows: repeat(2, 200px);
                    gap: 1rem;
                }
                .newsletter-content {
                    display: flex;
                    align-items: center;
                    gap: 3rem;
                }
                @media (max-width: 992px) {
                    .gallery-grid {
                        grid-template-columns: repeat(2, 1fr);
                        grid-template-rows: repeat(4, 200px);
                    }
                    .newsletter-content {
                        flex-direction: column;
                        gap: 2rem;
                        text-align: center;
                    }
                }
                @media (max-width: 576px) {
                    .gallery-grid {
                        grid-template-columns: 1fr;
                        grid-template-rows: auto;
                    }
                    .gallery-item-large {
                        grid-column: span 1 !important;
                        grid-row: span 1 !important;
                        height: 250px;
                    }
                }
            </style>
    <!-- Hero Section (Static) -->
    <section style="padding: 6rem 2rem; position: relative; overflow: hidden;">
        <!-- Decorative Background Elements -->
        <div class="decorative-circle" style="width: 300px; height: 300px; background: var(--color-accent-1); top: -100px; right: 10%; animation: pulse 8s ease-in-out infinite;"></div>
        <div class="decorative-circle" style="width: 200px; height: 200px; background: var(--color-accent-2); bottom: -50px; left: 5%; animation: pulse 6s ease-in-out infinite 1s;"></div>
        <div class="hero-accent" style="top: 20%; right: 15%;"></div>
        <div class="hero-accent" style="bottom: 15%; left: 10%; animation-delay: 2s;"></div>
        <div style="max-width: 1300px; margin: 0 auto; position: relative;" id="hero-carousel">
            @if($contenus && $contenus->count() > 0)
                <div class="carousel-container" style="position: relative; min-height: 500px;">
                    @foreach($contenus->take(5) as $index => $contenu)
                        <div class="hero-slide" data-index="{{ $index }}" style="min-width: 100%; height: 500px; display: {{ $index === 0 ? 'flex' : 'none' }}; gap: 2rem; align-items: center; position: absolute; top: 0; left: 0; opacity: {{ $index === 0 ? '1' : '0' }}; transition: opacity 0.8s ease-in-out;">
                            <!-- Left: Image -->
                            <div style="flex: 2.5; position: relative; height: 100%; border-radius: 20px; overflow: hidden; box-shadow: 8px 8px 0px var(--color-accent-1);">
                                @if($contenu->medias && $contenu->medias->count() > 0)
                                    <div style="width: 100%; height: 100%; background-image: url('{{ \Storage::url($contenu->medias->first()->chemin) }}'); background-size: cover; background-position: center;"></div>
                                @else
                                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #009E60 0%, #00C878 100%);"></div>
                                @endif
                            </div>
                                <!-- Right: Content -->
                            <div style="flex: 1; display: flex; flex-direction: column; justify-content: center; position: relative; padding-left: 2rem;">
                                <!-- Badge -->
                                <div style="margin-bottom: 1rem;">
                                    <span style="background-color: #FCD116; color: var(--color-accent-1); padding: 0.6rem 1.5rem; font-size: 0.9rem; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; box-shadow: 4px 4px 0px var(--color-accent-1);">
                                        {{ $contenu->type ? $contenu->type->nom : 'ARTICLE' }}
                                    </span>
                                </div>
                                
                                <!-- Title -->
                                <h2 style="font-family: 'Poppins', sans-serif; font-size: 2.2rem; font-weight: 600; color: var(--color-accent-1); margin: 0 0 1rem 0; line-height: 1.2;">
                                    {{ $contenu->titre }}
                                </h2>
                                
                                <!-- Description -->
                                <p style="color: #666; font-size: 1rem; margin: 0 0 1.5rem 0; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; font-weight: 400;">
                                    {{ Str::limit($contenu->texte, 180) }}
                                </p>
                                
                                <!-- CTA Button -->
                                <div style="margin-bottom: 1.5rem;">
                                    <a href="{{ route('contenu.public.show', $contenu->id_contenu) }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: var(--color-accent-1); text-decoration: none; font-weight: 700; font-size: 1rem; border-bottom: 2px solid var(--color-accent-1); padding-bottom: 2px; transition: all 0.3s ease;">
                                        Lire l'article
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>

                                <!-- Metadata (Author & Date) -->
                                <div style="display: flex; align-items: center; gap: 1rem; font-size: 0.9rem; color: #666;">
                                    @if($contenu->auteur)
                                        <div style="display: flex; align-items: center; gap: 0.8rem;">
                                            <div style="width: 35px; height: 35px; border-radius: 50%; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                                                <i class="bi bi-person-fill" style="font-size: 1.2rem; color: #bbb;"></i>
                                            </div>
                                            <span style="font-weight: 700; color: var(--color-accent-1); text-transform: uppercase; letter-spacing: 0.5px;">{{ $contenu->auteur->name }}</span>
                                        </div>
                                    @endif
                                    
                                    <!-- Separator -->
                                    <div style="width: 6px; height: 6px; background-color: var(--color-accent-1); border-radius: 50%;"></div>
                                    
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <span style="font-weight: 600; color: #555;">
                                            {{ $contenu->created_at ? $contenu->created_at->format('d M Y à H:i') : '' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Controls -->
                <button id="prevSlide" style="position: absolute; top: 50%; left: -120px; transform: translateY(-50%); background: none; border: none; width: 50px; height: 50px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--color-accent-1); font-size: 2.5rem; transition: all 0.3s ease; z-index: 10; opacity: 0.7;" onmouseover="this.style.opacity='1'; this.style.transform='translateY(-50%) scale(1.1)'" onmouseout="this.style.opacity='0.7'; this.style.transform='translateY(-50%) scale(1)'">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button id="nextSlide" style="position: absolute; top: 50%; right: -120px; transform: translateY(-50%); background: none; border: none; width: 50px; height: 50px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--color-accent-1); font-size: 2.5rem; transition: all 0.3s ease; z-index: 10; opacity: 0.7;" onmouseover="this.style.opacity='1'; this.style.transform='translateY(-50%) scale(1.1)'" onmouseout="this.style.opacity='0.7'; this.style.transform='translateY(-50%) scale(1)'">
                    <i class="bi bi-chevron-right"></i>
                </button>
            @endif
        </div>



        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const slides = document.querySelectorAll('.hero-slide');
                const prevBtn = document.getElementById('prevSlide');
                const nextBtn = document.getElementById('nextSlide');
                const carousel = document.getElementById('hero-carousel');
                let currentIndex = 0;
                let interval;

                function showSlide(index) {
                    // Handle wrap-around
                    if (index >= slides.length) index = 0;
                    if (index < 0) index = slides.length - 1;
                    
                    currentIndex = index;

                    // Update slides
                    slides.forEach((slide, i) => {
                        if (i === currentIndex) {
                            slide.style.display = 'flex';
                            // Small delay to allow display:flex to apply before opacity transition
                            setTimeout(() => {
                                slide.style.opacity = '1';
                            }, 50);
                        } else {
                            slide.style.opacity = '0';
                            setTimeout(() => {
                                if (i !== currentIndex) slide.style.display = 'none';
                            }, 800); // Match transition duration
                        }
                    });
                }

                function nextSlide() {
                    showSlide(currentIndex + 1);
                }

                function prevSlide() {
                    showSlide(currentIndex - 1);
                }

                function startAutoRotation() {
                    interval = setInterval(nextSlide, 30000);
                }

                function stopAutoRotation() {
                    clearInterval(interval);
                }

                // Event Listeners
                if (prevBtn && nextBtn) {
                    prevBtn.addEventListener('click', () => {
                        stopAutoRotation();
                        prevSlide();
                        startAutoRotation();
                    });

                    nextBtn.addEventListener('click', () => {
                        stopAutoRotation();
                        nextSlide();
                        startAutoRotation();
                    });
                }

                // Pause on hover
                if (carousel) {
                    carousel.addEventListener('mouseenter', stopAutoRotation);
                    carousel.addEventListener('mouseleave', startAutoRotation);
                }

                // Start
                startAutoRotation();
            });
        </script>
    </section>

    </section>

    @include('partials.actualites-section')

    <!-- DERNIÈRES PUBLICATIONS Section -->
    <section class="section animate-slide-up" id="contenus" style="background-color: var(--color-accent-3); position: relative; overflow: hidden; animation-delay: 0.2s;">
        <!-- Decorative accent -->
        <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: linear-gradient(135deg, #FCD116 0%, #E8B923 100%); border-radius: 50%; opacity: 0.1;"></div>
        <div class="container">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: var(--spacing-md);">
                <div style="background: linear-gradient(135deg, #FCD116 0%, #E8B923 100%); color: var(--color-accent-1); padding: 0.6rem 1.5rem; font-weight: 900; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 2px; box-shadow: 4px 4px 0px var(--color-accent-1); position: relative;">
                    DERNIÈRES PUBLICATIONS
                    <div style="position: absolute; top: -3px; right: -3px; width: 10px; height: 10px; background: var(--color-accent-2); border-radius: 50%;"></div>
                </div>
            </div>
            <div class="divider"></div>
            
            @if($contenus && count($contenus) > 0)
                <div class="grid grid-cols-3">
                    @foreach($contenus->take(6) as $contenu)
                        <a href="{{ route('contenu.public.show', $contenu->id_contenu) }}" class="card-link hover-lift" style="text-decoration: none; color: inherit;">
                            <article class="card" style="height: 100%; display: flex; flex-direction: column;">
                                <div style="height: 200px; overflow: hidden; position: relative;">
                                    @if($contenu->medias && $contenu->medias->count() > 0)
                                        <img src="{{ \Storage::url($contenu->medias->first()->chemin) }}" alt="{{ $contenu->titre }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" class="hover:scale-110">
                                    @else
                                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--color-accent-2) 0%, var(--color-accent-1) 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                                            📰
                                        </div>
                                    @endif
                                    <div style="position: absolute; top: 1rem; left: 1rem; background-color: #FCD116; color: var(--color-accent-1); padding: 0.4rem 1rem; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; box-shadow: 3px 3px 0px rgba(0,43,106,0.3);">
                                        {{ $contenu->type ? $contenu->type->nom : 'ARTICLE' }}
                                    </div>

                                </div>
                                <div class="card-body" style="flex: 1; display: flex; flex-direction: column;">
                                    <h3 class="card-title" style="line-height: 1.3; font-size: 1.1rem; margin-bottom: 0.75rem;">
                                        {{ Str::limit($contenu->titre ?? 'Sans titre', 60) }}
                                    </h3>
                                    <p class="card-text" style="font-size: 0.9rem; color: #666; margin-bottom: 1.5rem; flex: 1;">
                                        {{ Str::limit($contenu->texte ?? '', 100) }}
                                    </p>
                                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 1rem; margin-top: auto;">
                                        <small style="color: #999; font-size: 0.8rem; display: flex; align-items: center; gap: 0.3rem;">
                                            <i class="bi bi-calendar3"></i> 
                                            {{ $contenu->created_at ? $contenu->created_at->format('d M Y') : '' }}
                                        </small>
                                        <span style="color: var(--color-accent-2); font-weight: 600; font-size: 0.85rem; display: flex; align-items: center; gap: 0.3rem;">
                                            Lire <i class="bi bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>



    <!-- Agenda Culturel -->
    <section class="section animate-slide-up" id="agenda" style="animation-delay: 0.7s; background-color: #fff; position: relative;">
        <div class="decorative-circle" style="width: 150px; height: 150px; background: var(--color-accent-4); top: 10%; left: -50px; opacity: 0.1;"></div>
        <div class="container">
            <div class="divider"></div>
            <div style="display: flex; justify-content: space-between; align-items: end; margin-bottom: 2rem;">
                <div>
                    <h2 class="section-title">Agenda Culturel</h2>
                    <p class="section-subtitle" style="margin-bottom: 0;">Ne manquez aucun événement</p>
                </div>
                <a href="#" style="color: var(--color-accent-1); font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                    Voir tout l'agenda <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="agenda-grid">
                @if(isset($festivals) && $festivals->count() > 0)
                    @foreach($festivals as $festival)
                        <!-- Event Card -->
                        <div class="card hover-lift" style="display: flex; flex-direction: column;">
                            <div style="position: relative; height: 200px; overflow: hidden;">
                                @if($festival->medias && $festival->medias->count() > 0)
                                    <div style="background-image: url('{{ \Storage::url($festival->medias->first()->chemin) }}'); background-size: cover; background-position: center; width: 100%; height: 100%; transition: transform 0.5s ease;" class="hover:scale-110"></div>
                                @else
                                    <div style="background: linear-gradient(135deg, #FF6B6B 0%, #EE5253 100%); width: 100%; height: 100%;"></div>
                                @endif
                                
                                <div style="position: absolute; top: 1rem; right: 1rem; background: white; padding: 0.5rem 1rem; border-radius: 12px; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                    <div style="font-weight: 800; font-size: 1.2rem; color: var(--color-accent-1); line-height: 1;">{{ $festival->created_at ? $festival->created_at->format('d') : '?' }}</div>
                                    <div style="font-size: 0.8rem; text-transform: uppercase; color: #666;">{{ $festival->created_at ? $festival->created_at->format('M') : '' }}</div>
                                </div>
                                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                                    @if($festival->region)
                                        <span style="color: white; font-size: 0.8rem; background: rgba(255,255,255,0.2); padding: 0.2rem 0.6rem; border-radius: 20px; backdrop-filter: blur(4px);">
                                            <i class="bi bi-geo-alt-fill"></i> {{ $festival->region->nom_region }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title" style="font-size: 1.2rem;">{{ Str::limit($festival->titre, 40) }}</h3>
                                <p class="card-text" style="font-size: 0.9rem; color: #666;">{{ Str::limit($festival->texte, 80) }}</p>
                                <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #eee; display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 0.85rem; color: #888;"><i class="bi bi-clock"></i> {{ $festival->created_at ? $festival->created_at->format('H:i') : '' }}</span>
                                    <a href="{{ route('contenu.public.show', $festival->id_contenu) }}" style="background: none; border: 1px solid var(--color-accent-1); text-decoration: none; color: var(--color-accent-1); padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.background='var(--color-accent-1)'; this.style.color='white'" onmouseout="this.style.background='none'; this.style.color='var(--color-accent-1)'">
                                        Détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Aucun événement prévu pour le moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Galerie Photos -->
    <section class="section animate-slide-up" id="galerie" style="animation-delay: 0.8s; background-color: var(--color-accent-3);">
        <div class="container">
            <div class="divider"></div>
            <h2 class="section-title" style="text-align: center;">Immersion Visuelle</h2>
            <p class="section-subtitle" style="text-align: center; max-width: 600px; margin: 0 auto 3rem auto;">Le Bénin en images, une terre de couleurs et de traditions.</p>

            <div class="gallery-grid">
                <!-- Large Item -->
                <div class="hover-scale gallery-item-large" style="grid-column: span 2; grid-row: span 2; border-radius: 16px; overflow: hidden; position: relative; cursor: pointer;">
                    <div style="background: linear-gradient(45deg, #FF9A9E 0%, #FECFEF 99%, #FECFEF 100%); width: 100%; height: 100%;"></div>
                    <div class="card-overlay" style="position: absolute; inset: 0; background: rgba(0,0,0,0.3); opacity: 0; transition: opacity 0.3s; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-zoom-in" style="color: white; font-size: 2rem;"></i>
                    </div>
                </div>
                <!-- Small Items -->
                <div class="hover-scale" style="border-radius: 16px; overflow: hidden; position: relative; cursor: pointer;">
                    <div style="background: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%); width: 100%; height: 100%;"></div>
                </div>
                <div class="hover-scale" style="border-radius: 16px; overflow: hidden; position: relative; cursor: pointer;">
                    <div style="background: linear-gradient(to right, #fa709a 0%, #fee140 100%); width: 100%; height: 100%;"></div>
                </div>
                <div class="hover-scale" style="border-radius: 16px; overflow: hidden; position: relative; cursor: pointer;">
                    <div style="background: linear-gradient(to top, #30cfd0 0%, #330867 100%); width: 100%; height: 100%;"></div>
                </div>
                <div class="hover-scale" style="border-radius: 16px; overflow: hidden; position: relative; cursor: pointer;">
                    <div style="background: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%); width: 100%; height: 100%;"></div>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 2rem;">
                <a href="#" class="btn btn-secondary" style="background: transparent; border: 2px solid var(--color-accent-1); color: var(--color-accent-1);">
                    Voir toute la galerie
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="section animate-slide-up" style="animation-delay: 0.9s; padding: 5rem 0;">
        <div class="container">
            <div style="background: var(--color-accent-1); border-radius: 30px; padding: 3rem; position: relative; overflow: hidden; box-shadow: 0 20px 40px rgba(0, 158, 96, 0.2);">
                <!-- Decorative circles -->
                <div style="position: absolute; top: -50px; left: -50px; width: 200px; height: 200px; border-radius: 50%; border: 20px solid rgba(255,255,255,0.05);"></div>
                <div style="position: absolute; bottom: -30px; right: -30px; width: 150px; height: 150px; background: #FCD116; border-radius: 50%; opacity: 0.1;"></div>
                
                <div class="newsletter-content" style="position: relative; z-index: 1;">
                    <div style="flex: 1; color: white;">
                        <h2 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; margin-bottom: 1rem;">Restez connecté</h2>
                        <p style="opacity: 0.9; font-size: 1.1rem; font-weight: 300;">Recevez nos dernières découvertes culturelles et actualités directement dans votre boîte mail.</p>
                    </div>
                    <div style="flex: 1;">
                        <form style="background: white; padding: 0.5rem; border-radius: 50px; display: flex; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                            <input type="email" placeholder="Votre adresse email" style="border: none; outline: none; padding: 1rem 1.5rem; flex: 1; border-radius: 50px; font-family: 'Outfit', sans-serif;">
                            <button type="submit" style="background: var(--color-accent-2); color: white; border: none; padding: 0.8rem 2rem; border-radius: 50px; font-weight: 700; cursor: pointer; transition: transform 0.2s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                S'abonner
                            </button>
                        </form>
                        <div style="margin-top: 1rem; text-align: center; color: rgba(255,255,255,0.6); font-size: 0.8rem;">
                            <i class="bi bi-lock-fill"></i> Nous respectons votre vie privée.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="background: linear-gradient(135deg, var(--color-accent-1) 0%, var(--color-accent-2) 100%); color: var(--color-base); text-align: center;">
        <div class="container">
            <h2 class="section-title" style="color: var(--color-base);">Explorez Miwakpon Bénin</h2>
            <p style="font-size: 1.1rem; margin-bottom: var(--spacing-lg); opacity: 0.95; max-width: 600px; margin-left: auto; margin-right: auto;">
                Plongez dans notre plateforme interactive et découvrez toute la richesse du patrimoine culturel béninois.
            </p>
            <a href="#" class="btn btn-secondary" style="background-color: var(--color-accent-4); color: var(--color-accent-1); border: none;">
                <i class="bi bi-rocket"></i> Commencer l'exploration
            </a>
        </div>
    </section>
@endsection

<!-- Back to Top Button with Progress -->
<div id="backToTop" style="position: fixed; bottom: 2rem; right: 2rem; width: 60px; height: 60px; background: var(--color-accent-1); border-radius: 50%; display: none; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 8px 20px rgba(0,43,106,0.3); z-index: 1000; transition: all 0.3s ease;">
    <svg width="60" height="60" style="position: absolute; transform: rotate(-90deg);">
        <circle cx="30" cy="30" r="26" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="3"/>
        <circle id="progressCircle" cx="30" cy="30" r="26" fill="none" stroke="#FCD116" stroke-width="3" stroke-dasharray="163.36" stroke-dashoffset="163.36" style="transition: stroke-dashoffset 0.1s;"/>
    </svg>
    <i class="bi bi-arrow-up" style="color: white; font-size: 1.5rem; position: relative; z-index: 1;"></i>
</div>

<script>
// Smooth Scroll for all links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && document.querySelector(href)) {
            e.preventDefault();
            document.querySelector(href).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Back to Top Button with Progress
const backToTop = document.getElementById('backToTop');
const progressCircle = document.getElementById('progressCircle');
const circumference = 163.36;

window.addEventListener('scroll', () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrollPercentage = (scrollTop / scrollHeight) * 100;
    
    // Show/hide button
    if (scrollTop > 300) {
        backToTop.style.display = 'flex';
        backToTop.style.opacity = '1';
    } else {
        backToTop.style.opacity = '0';
        setTimeout(() => {
            if (window.pageYOffset <= 300) backToTop.style.display = 'none';
        }, 300);
    }
    
    // Update progress circle
    const offset = circumference - (scrollPercentage / 100) * circumference;
    progressCircle.style.strokeDashoffset = offset;
});

backToTop.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Hover effect on back to top
backToTop.addEventListener('mouseenter', () => {
    backToTop.style.transform = 'scale(1.1)';
});
backToTop.addEventListener('mouseleave', () => {
    backToTop.style.transform = 'scale(1)';
});

// Scroll Reveal Animation
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Apply to cards and sections
document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.card, .section');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
    
    // Enhanced CTA button animation
    const ctaButtons = document.querySelectorAll('a[href*="contenu.public.show"]');
    ctaButtons.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            const arrow = this.querySelector('.bi-arrow-right');
            if (arrow) {
                arrow.style.transform = 'translateX(5px)';
                arrow.style.transition = 'transform 0.3s ease';
            }
        });
        btn.addEventListener('mouseleave', function() {
            const arrow = this.querySelector('.bi-arrow-right');
            if (arrow) {
                arrow.style.transform = 'translateX(0)';
            }
        });
    });
    
    // Add ripple effect to cards
    document.querySelectorAll('.card-link').forEach(card => {
        card.addEventListener('click', function(e) {
            const ripple = document.createElement('div');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(0, 158, 96, 0.3)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'ripple 0.6s ease-out';
            ripple.style.pointerEvents = 'none';
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 600);
        });
    });
});

// Add ripple animation
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    #backToTop:hover {
        box-shadow: 0 12px 30px rgba(0,43,106,0.4);
    }
    
    .card-link {
        position: relative;
        overflow: hidden;
    }
`;
document.head.appendChild(style);
</script>
