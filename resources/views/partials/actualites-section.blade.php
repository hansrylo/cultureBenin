
    <!-- Actualités Section -->
    <section class="section animate-slide-up" id="actualites" style="background-color: #fff; padding: 4rem 0; position: relative;">
        <div class="container">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
                <h2 class="section-title" style="margin-bottom: 0;">Actualités</h2>
                <div style="flex: 1; height: 2px; background: #eee;"></div>
                <a href="#" style="color: var(--color-accent-2); font-weight: 600; font-size: 0.9rem; text-decoration: none;">Voir tout</a>
            </div>

            @if(isset($actualites) && $actualites->count() > 0)
                <div class="grid grid-cols-4 gap-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                    @foreach($actualites as $actu)
                        <div class="card hover-lift" style="border: none; box-shadow: none;">
                            <div style="height: 180px; border-radius: 12px; overflow: hidden; position: relative; margin-bottom: 1rem;">
                                @if($actu->medias && $actu->medias->count() > 0)
                                    <img src="{{ asset('storage/' . $actu->medias->first()->chemin) }}" alt="{{ $actu->titre }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" class="hover:scale-110">
                                @else
                                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #e0e0e0 0%, #f5f5f5 100%);"></div>
                                @endif
                                <div style="position: absolute; bottom: 0; left: 0; background: var(--color-accent-1); color: white; padding: 0.2rem 0.8rem; font-size: 0.7rem; font-weight: 700; border-top-right-radius: 10px;">
                                    ACTUALITÉ
                                </div>
                            </div>
                            <h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.5rem; line-height: 1.4;">
                                <a href="{{ route('contenu.public.show', $actu->id_contenu) }}" style="color: inherit; text-decoration: none;">
                                    {{ Str::limit($actu->titre, 50) }}
                                </a>
                            </h3>
                            <p style="font-size: 0.85rem; color: #777; margin-bottom: 0.5rem; line-height: 1.5;">
                                {{ Str::limit($actu->texte, 80) }}
                            </p>
                            <span style="font-size: 0.75rem; color: #aaa;">
                                {{ $actu->created_at ? $actu->created_at->diffForHumans() : '' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <p class="text-muted">Aucune actualité récente.</p>
                </div>
            @endif
        </div>
    </section>
