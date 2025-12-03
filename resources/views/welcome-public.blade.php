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
            </style>
    <!-- Hero Section (Static) -->
    <section style="padding: 6rem 2rem; position: relative; overflow: hidden;">
        <!-- Decorative Background Elements -->
        <div class="decorative-circle" style="width: 300px; height: 300px; background: var(--color-accent-1); top: -100px; right: 10%; animation: pulse 8s ease-in-out infinite;"></div>
        <div class="decorative-circle" style="width: 200px; height: 200px; background: var(--color-accent-2); bottom: -50px; left: 5%; animation: pulse 6s ease-in-out infinite 1s;"></div>
        <div class="hero-accent" style="top: 20%; right: 15%;"></div>
        <div class="hero-accent" style="bottom: 15%; left: 10%; animation-delay: 2s;"></div>
        <div style="max-width: 1300px; margin: 0 auto; position: relative;">
            @if($contenus && $contenus->count() > 0)
                @php $contenu = $contenus->first(); @endphp
                <div style="min-width: 100%; height: 500px; display: flex; gap: 2rem; align-items: center;">
                    <!-- Left: Image -->
                    <div style="flex: 2.5; position: relative; height: 100%; border-radius: 20px; overflow: hidden; box-shadow: 8px 8px 0px var(--color-accent-1);">
                        @if($contenu->medias && $contenu->medias->count() > 0)
                            <div style="width: 100%; height: 100%; background-image: url('{{ asset('storage/' . $contenu->medias->first()->chemin) }}'); background-size: cover; background-position: center;"></div>
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
            @endif
        </div>
    </section>

    <!-- DERNIÈRES PUBLICATIONS Section -->
    <section class="section" id="contenus" style="background-color: var(--color-accent-3); position: relative; overflow: hidden;">
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
                    @foreach($contenus->take(12) as $contenu)
                        <a href="{{ route('contenu.public.show', $contenu->id_contenu) }}" class="card-link" style="text-decoration: none; color: inherit;">
                            <article class="card" style="height: 100%; display: flex; flex-direction: column;">
                                <div style="height: 200px; overflow: hidden; position: relative;">
                                    @if($contenu->medias && $contenu->medias->count() > 0)
                                        <img src="{{ asset('storage/' . $contenu->medias->first()->chemin) }}" alt="{{ $contenu->titre }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                                    @else
                                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--color-accent-2) 0%, var(--color-accent-1) 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                                            📰
                                        </div>
                                    @endif
                                    <div style="position: absolute; top: 1rem; left: 1rem; background-color: #FCD116; color: var(--color-accent-1); padding: 0.4rem 1rem; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; box-shadow: 3px 3px 0px rgba(0,43,106,0.3);">
                                        {{ $contenu->type ? $contenu->type->nom : 'ARTICLE' }}
                                    </div>
                                    <!-- Gradient overlay on hover -->
                                    <div style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.3) 100%); opacity: 0; transition: opacity 0.3s ease;" class="card-overlay"></div>
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

    <!-- Régions -->
    <section class="section" id="regions" style="background-color: var(--color-accent-3);">
        <div class="container">
            <div class="divider"></div>
            <h2 class="section-title">Explorez nos Régions</h2>
            <p class="section-subtitle">Découvrez la diversité culturelle à travers les 12 régions du Bénin</p>
            
            @if($regions && count($regions) > 0)
                <div class="grid grid-cols-3">
                    @foreach($regions->take(12) as $region)
                        <a href="#" class="card" style="cursor: pointer; text-decoration: none; text-align: center; overflow: hidden;">
                            <div style="background: linear-gradient(135deg, var(--color-accent-2) 0%, var(--color-accent-1) 100%); height: 180px; display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem;">
                                🏛️
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ $region->nom_region ?? 'Région' }}
                                </h3>
                                <p class="card-text" style="font-size: 0.85rem;">
                                    Découvrez la culture locale
                                </p>
                                <div style="margin-top: var(--spacing-md); color: var(--color-accent-2); font-weight: 600; font-size: 0.9rem;">
                                    En savoir plus →
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Langues -->
    <section class="section" id="langues">
        <div class="container">
            <div class="divider"></div>
            <h2 class="section-title">Nos Langues</h2>
            <p class="section-subtitle">Explorez la diversité linguistique du Bénin</p>
            
            @if($langues && count($langues) > 0)
                <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    @foreach($langues->take(8) as $langue)
                        <a href="#" class="card" style="cursor: pointer; text-decoration: none; text-align: center;">
                            <div style="background: linear-gradient(135deg, var(--color-accent-4) 0%, #FFB84D 100%); height: 150px; display: flex; align-items: center; justify-content: center; color: var(--color-accent-1); font-size: 2.5rem;">
                                <i class="bi bi-translate"></i>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ $langue->nom_langue ?? 'Langue' }}
                                </h3>
                                <p class="card-text" style="font-size: 0.85rem; color: var(--color-accent-2); font-weight: 600;">
                                    {{ $langue->code_langue ?? '' }}
                                </p>
                                <div style="margin-top: var(--spacing-md); color: var(--color-accent-2); font-weight: 600; font-size: 0.9rem;">
                                    Découvrir →
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
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
