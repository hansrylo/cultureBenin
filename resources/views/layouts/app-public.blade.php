<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Culture Benin')</title>
    
    <!-- Fonts -->
    <!-- Imported via app.css -->
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            /* Couleurs du thème Premium Culture Bénin */
            --color-accent-1: #002B6A; /* Original Deep Blue */
            --color-accent-2: #007FE6; /* Original Bright Blue */
            --color-contrast: #111827; /* Neutral 900 */
            --color-base: #ffffff;
            --color-accent-3: #F7F6F1; /* Cream */
            --color-accent-4: #E8112D; /* Benin Red */
            
            /* Spacing */
            --spacing-xs: 0.25rem;
            --spacing-sm: 1rem;
            --spacing-md: 1.75rem;
            --spacing-lg: 3.5rem;
            --spacing-xl: 5.25rem;
            --spacing-2xl: 8.75rem;
            
            /* Typography */
            --font-primary: 'Playfair Display', serif;
            --font-secondary: 'Outfit', sans-serif;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            height: 100%;
        }
        
        body {
            font-family: var(--font-secondary);
            color: var(--color-contrast);
            background-color: var(--color-base);
            line-height: 1.6;
        }
        
        a {
            color: var(--color-accent-2);
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        a:hover {
            color: var(--color-accent-1);
        }
        
        /* Layout */
        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        main {
            flex: 1;
        }
        
        /* Decorative Elements */
        .decorative-pattern {
            position: fixed;
            pointer-events: none;
            z-index: 0;
            opacity: 0.08;
        }
        
        .pattern-circle {
            position: absolute;
            border-radius: 50%;
            border: 3px solid;
        }
        
        .pattern-triangle {
            width: 0;
            height: 0;
            border-style: solid;
        }
        
        .pattern-zigzag {
            background-image: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                currentColor 10px,
                currentColor 20px
            );
        }
        
        /* Beninese Traditional Patterns */
        .adinkra-pattern {
            background-image: 
                radial-gradient(circle at 20% 50%, transparent 10%, #FCD116 10%, #FCD116 20%, transparent 20%),
                radial-gradient(circle at 80% 50%, transparent 10%, #009E60 10%, #009E60 20%, transparent 20%);
            background-size: 100px 100px;
            opacity: 0.05;
        }
        
        /* Geometric Shapes */
        .geo-shape {
            position: absolute;
            pointer-events: none;
        }
        
        /* Header/Navbar - Modern Redesign */
        .navbar {
            background: linear-gradient(180deg, rgba(255,255,255,0.98) 0%, rgba(250,249,246,0.95) 100%);
            color: var(--color-contrast);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-bottom: 1px solid rgba(0, 43, 106, 0.08);
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.04);
        }
        
        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            border-bottom: 1px solid rgba(0, 158, 96, 0.15);
        }
        
        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }
        
        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--color-base);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .navbar.scrolled .navbar-brand {
            font-size: 1.6rem;
        }
        
        .navbar-brand:hover {
            color: var(--color-accent-4);
            transform: translateY(-2px);
        }
        
        @keyframes wave {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(20deg); }
            75% { transform: rotate(-20deg); }
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .navbar-menu {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            list-style: none;
        }
        
        .navbar-menu li {
            position: relative;
        }
        
        .navbar-menu a {
            color: var(--color-accent-1);
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: capitalize;
            letter-spacing: 0.3px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            padding: 0.75rem 1.25rem;
            display: inline-block;
            position: relative;
            border-radius: 12px;
            background: transparent;
        }
        
        .navbar-menu a::after {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #009E60 0%, #00C878 100%);
            border-radius: 2px;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .navbar-menu a:hover {
            color: #495057;
        }
        
        .navbar-menu a:hover::after {
            width: 60%;
        }
        
        .navbar-menu a::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 12px;
            padding: 1px;
            background: linear-gradient(135deg, rgba(0, 158, 96, 0.2), rgba(0, 200, 120, 0.2));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .navbar-menu a:hover::before {
            opacity: 1;
        }
        
        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            width: 100%;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--color-accent-1) 0%, var(--color-accent-2) 100%);
            color: var(--color-base);
            padding: var(--spacing-2xl) 0;
            text-align: center;
            margin-bottom: var(--spacing-2xl);
        }
        
        .hero-title {
            font-family: var(--font-primary);
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            margin-bottom: var(--spacing-md);
            line-height: 1.2;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: var(--spacing-lg);
            opacity: 0.95;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.75rem;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-primary {
            background-color: var(--color-accent-2);
            color: var(--color-base);
        }
        
        .btn-primary:hover {
            background-color: var(--color-accent-1);
        }
        
        .btn-secondary {
            background-color: var(--color-accent-3);
            color: var(--color-contrast);
            border-color: var(--color-accent-2);
        }
        
        .btn-secondary:hover {
            background-color: var(--color-base);
            border-color: var(--color-accent-1);
        }
        
        /* Grid */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--spacing-lg);
        }
        
        .grid-cols-2 {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .grid-cols-3 {
            grid-template-columns: repeat(3, 1fr);
        }
        
        @media (max-width: 768px) {
            .grid-cols-2 {
                grid-template-columns: 1fr;
            }
            .grid-cols-3 {
                grid-template-columns: 1fr;
            }
            .navbar-menu {
                flex-direction: column;
                gap: var(--spacing-sm);
            }
        }
        
        /* Card */
        .card {
            background: var(--color-base);
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 6px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }
        
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }
        
        .card-body {
            padding: var(--spacing-lg);
        }
        
        .card-title {
            font-family: var(--font-primary);
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: var(--spacing-sm);
            color: var(--color-contrast);
        }
        
        .card-text {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        /* Section */
        .section {
            padding: var(--spacing-2xl) 0;
        }
        
        .section-title {
            font-family: var(--font-primary);
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 700;
            margin-bottom: var(--spacing-lg);
            color: var(--color-contrast);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .section-subtitle {
            font-size: 1rem;
            color: #666;
            margin-bottom: var(--spacing-lg);
        }
        
        .divider {
            width: 60px;
            height: 2px;
            background-color: var(--color-accent-2);
            margin-bottom: var(--spacing-lg);
        }
        
        /* Stats */
        .stat-block {
            text-align: center;
            padding: var(--spacing-lg);
        }
        
        .stat-number {
            font-family: var(--font-primary);
            font-size: clamp(1.75rem, 5vw, 3rem);
            font-weight: 700;
            color: var(--color-accent-2);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 0.95rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Footer */
        footer {
            background-color: var(--color-accent-1);
            color: var(--color-base);
            padding: var(--spacing-lg) 0;
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            text-align: center;
        }
        
        footer a {
            color: var(--color-accent-4);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .section {
                padding: var(--spacing-xl) 0;
            }
            
            .container {
                padding: 0 1rem;
            }
            
            .navbar-container {
                flex-direction: column;
                text-align: center;
            }
        }
        
        /* Dropdown Menu */
        #userDropdown.show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
        }
        
        a[href*="login"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.25) !important;
        }
    
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Decorative Background Elements Removed as requested -->
    
    <div id="app">
        <!-- Header - Simplified -->
        <header class="navbar">
            <div class="navbar-container" style="padding: 1rem 2rem;">
                <!-- Logo Section -->
                <a href="{{ route('Home') }}" class="navbar-brand">
                    <img src="{{ asset('images/miwakpon-benin-logo-removebg-preview.png') }}" alt="Logo" style="height: 45px; width: auto;">
                    <div style="display: flex; flex-direction: column; gap: 0.1rem;">
                        <span style="font-family: var(--font-primary); font-size: 1.4rem; font-weight: 700; color: var(--color-accent-1); letter-spacing: -0.5px; line-height: 1;">Miwakpon Bénin</span>
                        <span style="font-size: 0.65rem; color: var(--color-accent-2); font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase;">Culture & Patrimoine</span>
                    </div>
                </a>
                
                <!-- Search Bar - Centered -->
                <div style="flex: 1; max-width: 500px; margin: 0 2rem;">
                    <form action="{{ route('Home') }}" method="GET" style="position: relative; width: 100%;">
                        <div style="position: relative; display: flex; align-items: center;">
                            <i class="bi bi-search" style="position: absolute; left: 1.2rem; color: #9CA3AF; font-size: 1rem;"></i>
                            <input
                                type="text"
                                name="search"
                                placeholder="Rechercher un article, une région..."
                                value="{{ request('search') }}"
                                style="width: 100%; padding: 0.8rem 1rem 0.8rem 3rem; border: 1px solid rgba(0,0,0,0.1); border-radius: 50px; background: rgba(0,0,0,0.03); color: var(--color-contrast); font-size: 0.95rem; transition: all 0.3s ease; font-family: var(--font-secondary);"
                                onfocus="this.style.background='white'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.08)'; this.style.borderColor='var(--color-accent-2)';"
                                onblur="this.style.background='rgba(0,0,0,0.03)'; this.style.boxShadow='none'; this.style.borderColor='rgba(0,0,0,0.1)';"
                            >
                            <button type="submit" style="position: absolute; right: 0.5rem; background: var(--color-accent-1); color: white; border: none; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: transform 0.2s ease;">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Action Buttons -->
                <div style="display: flex; align-items: center; gap: 1rem; flex-shrink: 0;">
                    @auth
                        <div style="position: relative;">
                            <button id="userMenuBtn" style="background: white; color: var(--color-contrast); padding: 0.5rem 0.5rem 0.5rem 1rem; border-radius: 50px; font-weight: 600; border: 1px solid rgba(0,0,0,0.08); cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 0.8rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                                <span style="font-size: 0.9rem;">{{ Auth::user()->prenom }}</span>
                                <div style="width: 35px; height: 35px; background: var(--color-accent-1); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div id="userDropdown" style="position: absolute; top: calc(100% + 1rem); right: 0; min-width: 260px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); z-index: 1000;">
                                <div style="background: white; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.12); overflow: hidden; border: 1px solid rgba(0,0,0,0.05);">
                                    <div style="padding: 1.5rem; background: linear-gradient(135deg, var(--color-accent-1) 0%, var(--color-accent-2) 100%); color: white;">
                                        <div style="font-size: 1.1rem; font-weight: 700; font-family: var(--font-primary);">{{ Auth::user()->name }}</div>
                                        <div style="font-size: 0.85rem; opacity: 0.9;">{{ Auth::user()->email }}</div>
                                    </div>
                                    <div style="padding: 0.5rem;">
                                        <a href="{{ route('profile.edit') }}" style="display: flex; align-items: center; gap: 1rem; padding: 0.8rem 1rem; color: var(--color-contrast); text-decoration: none; transition: background 0.2s; border-radius: 8px;">
                                            <i class="bi bi-person-gear" style="color: var(--color-accent-2);"></i> Mon Profil
                                        </a>
                                        <a href="{{ route('mes-achats') }}" style="display: flex; align-items: center; gap: 1rem; padding: 0.8rem 1rem; color: var(--color-contrast); text-decoration: none; transition: background 0.2s; border-radius: 8px;">
                                            <i class="bi bi-bag-check" style="color: var(--color-accent-2);"></i> Mes Achats
                                        </a>
                                        <div style="height: 1px; background: #eee; margin: 0.5rem 1rem;"></div>
                                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                            @csrf
                                            <button type="submit" style="width: 100%; display: flex; align-items: center; gap: 1rem; padding: 0.8rem 1rem; color: var(--color-accent-4); background: none; border: none; cursor: pointer; font-family: var(--font-secondary); font-size: 0.95rem; text-align: left; border-radius: 8px;">
                                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary" style="border-radius: 50px; padding: 0.7rem 1.5rem; box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);">
                            <i class="bi bi-person"></i> Connexion
                        </a>
                    @endauth
                </div>
            </div>
        </header>
        
        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
        
        <!-- Footer -->
        <footer>
            <div class="container">
                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: var(--spacing-xl); margin-bottom: var(--spacing-2xl);">
                    <!-- About Section -->
                    <div>
                        <h4 style="font-family: var(--font-primary); font-weight: 700; color: var(--color-base); margin-bottom: var(--spacing-md);">
                            Miwakpon Bénin
                        </h4>
                        <p style="opacity: 0.9; font-size: 0.9rem; line-height: 1.6; margin-bottom: var(--spacing-md);">
                            Plateforme de découverte et de valorisation de la richesse culturelle du Bénin. Explorez nos traditions, langues et patrimoine.
                        </p>
                        <!-- Newsletter -->
                        <div style="margin-top: var(--spacing-lg);">
                            <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; opacity: 0.9;">
                                📧 S'abonner à la newsletter
                            </label>
                            <form style="display: flex; gap: 0.5rem;">
                                <input type="email" placeholder="Votre email" style="flex: 1; padding: 0.6rem; border: 1px solid rgba(255,255,255,0.3); border-radius: 4px; background: rgba(255,255,255,0.1); color: var(--color-base); font-size: 0.9rem;">
                                <button type="submit" style="padding: 0.6rem 1rem; background-color: var(--color-accent-4); color: var(--color-accent-1); border: none; border-radius: 4px; font-weight: 600; cursor: pointer; white-space: nowrap;">
                                    S'abonner
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h5 style="font-weight: 700; color: var(--color-base); margin-bottom: var(--spacing-md); font-size: 0.95rem;">
                            Navigation
                        </h5>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: 0.5rem;"><a href="#contenus" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.9rem; transition: color 0.2s;">→ Contenus</a></li>
                            <li style="margin-bottom: 0.5rem;"><a href="#regions" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.9rem; transition: color 0.2s;">→ Régions</a></li>
                            <li style="margin-bottom: 0.5rem;"><a href="#langues" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.9rem; transition: color 0.2s;">→ Langues</a></li>
                            <li style="margin-bottom: 0.5rem;"><a href="#" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.9rem; transition: color 0.2s;">→ Qui sommes-nous?</a></li>
                        </ul>
                    </div>

                    <!-- Social Links -->
                    <div>
                        <h5 style="font-weight: 700; color: var(--color-base); margin-bottom: var(--spacing-md); font-size: 0.95rem;">
                            Suivez-nous
                        </h5>
                        <div style="display: flex; gap: var(--spacing-md); flex-wrap: wrap;">
                            <a href="https://www.instagram.com/miwakpon_benin" target="_blank" rel="noopener" title="Instagram" style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%; color: var(--color-base); text-decoration: none; font-size: 1.2rem; transition: background 0.3s; cursor: pointer;">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="https://www.facebook.com/miwakpon.benin" target="_blank" rel="noopener" title="Facebook" style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%; color: var(--color-base); text-decoration: none; font-size: 1.2rem; transition: background 0.3s; cursor: pointer;">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://www.twitter.com/miwakpon_benin" target="_blank" rel="noopener" title="Twitter/X" style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%; color: var(--color-base); text-decoration: none; font-size: 1.2rem; transition: background 0.3s; cursor: pointer;">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                        </div>
                        <p style="font-size: 0.8rem; opacity: 0.7; margin-top: var(--spacing-md);">
                            Rejoignez notre communauté
                        </p>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: var(--spacing-lg); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: var(--spacing-md);">
                    <p style="margin: 0; font-size: 0.85rem; opacity: 0.8;">
                        &copy; {{ date('Y') }} <strong>Miwakpon Bénin</strong> — Tous droits réservés
                    </p>
                    <div style="display: flex; gap: var(--spacing-lg); font-size: 0.85rem;">
                        <a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none;">Mentions légales</a>
                        <a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none;">Politique de confidentialité</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    
    <script>
        // Dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const userMenuBtn = document.getElementById('userMenuBtn');
            const userDropdown = document.getElementById('userDropdown');
            
            if (userMenuBtn && userDropdown) {
                const chevronIcon = userMenuBtn.querySelector('.chevron-icon');
                
                userMenuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('show');
                    
                    // Rotate chevron
                    if (chevronIcon) {
                        if (userDropdown.classList.contains('show')) {
                            chevronIcon.style.transform = 'rotate(180deg)';
                        } else {
                            chevronIcon.style.transform = 'rotate(0deg)';
                        }
                    }
                });
                
                document.addEventListener('click', function(e) {
                    if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                        userDropdown.classList.remove('show');
                        if (chevronIcon) chevronIcon.style.transform = 'rotate(0deg)';
                    }
                });
            }
            
            // Sticky Header with Glassmorphism
            const navbar = document.querySelector('.navbar');
            
            window.addEventListener('scroll', () => {
                const currentScroll = window.pageYOffset;
                
                if (currentScroll > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
            
            // Search toggle functionality
            const searchToggle = document.getElementById('searchToggle');
            const searchBar = document.getElementById('searchBar');
            const searchInput = document.getElementById('searchInput');
            
            if (searchToggle && searchBar) {
                searchToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isVisible = searchBar.style.visibility === 'visible';
                    
                    if (isVisible) {
                        searchBar.style.opacity = '0';
                        searchBar.style.visibility = 'hidden';
                        searchBar.style.transform = 'translateY(-10px)';
                    } else {
                        searchBar.style.opacity = '1';
                        searchBar.style.visibility = 'visible';
                        searchBar.style.transform = 'translateY(0)';
                        if (searchInput) searchInput.focus();
                    }
                });
                
                document.addEventListener('click', function(e) {
                    if (!searchBar.contains(e.target) && e.target !== searchToggle) {
                        searchBar.style.opacity = '0';
                        searchBar.style.visibility = 'hidden';
                        searchBar.style.transform = 'translateY(-10px)';
                    }
                });
            }
            
            // Enhanced hover effects
            const navbarBrand = document.querySelector('.navbar-brand');
            if (navbarBrand) {
                const logoGlow = navbarBrand.querySelector('.logo-glow');
                const logoImg = navbarBrand.querySelector('img');
                
                navbarBrand.addEventListener('mouseenter', function() {
                    if (logoGlow) logoGlow.style.opacity = '1';
                    if (logoImg) logoImg.style.transform = 'scale(1.05) rotate(5deg)';
                });
                
                navbarBrand.addEventListener('mouseleave', function() {
                    if (logoGlow) logoGlow.style.opacity = '0';
                    if (logoImg) logoImg.style.transform = 'scale(1) rotate(0deg)';
                });
            }
            
            // Search button hover
            const searchHoverBg = document.querySelector('.search-hover-bg');
            if (searchToggle && searchHoverBg) {
                searchToggle.addEventListener('mouseenter', function() {
                    searchHoverBg.style.opacity = '1';
                    searchToggle.style.transform = 'translateY(-2px)';
                    searchToggle.style.boxShadow = '0 6px 20px rgba(0, 158, 96, 0.25)';
                });
                
                searchToggle.addEventListener('mouseleave', function() {
                    searchHoverBg.style.opacity = '0';
                    searchToggle.style.transform = 'translateY(0)';
                    searchToggle.style.boxShadow = '0 4px 12px rgba(0, 158, 96, 0.12)';
                });
            }
            
            // User button hover
            const userBtnHover = document.querySelector('.user-btn-hover');
            if (userMenuBtn && userBtnHover) {
                userMenuBtn.addEventListener('mouseenter', function() {
                    userBtnHover.style.opacity = '1';
                    userMenuBtn.style.transform = 'translateY(-2px)';
                    userMenuBtn.style.boxShadow = '0 8px 28px rgba(0, 158, 96, 0.45)';
                });
                
                userMenuBtn.addEventListener('mouseleave', function() {
                    userBtnHover.style.opacity = '0';
                    userMenuBtn.style.transform = 'translateY(0)';
                    userMenuBtn.style.boxShadow = '0 6px 20px rgba(0, 158, 96, 0.35)';
                });
            }
            
            // Login button hover
            const loginBtn = document.querySelector('a[href*="login"]');
            const loginHoverBg = document.querySelector('.login-hover-bg');
            if (loginBtn && loginHoverBg) {
                loginBtn.addEventListener('mouseenter', function() {
                    loginHoverBg.style.opacity = '1';
                    loginBtn.style.transform = 'translateY(-2px)';
                    loginBtn.style.boxShadow = '0 8px 28px rgba(0, 158, 96, 0.45)';
                });
                
                loginBtn.addEventListener('mouseleave', function() {
                    loginHoverBg.style.opacity = '0';
                    loginBtn.style.transform = 'translateY(0)';
                    loginBtn.style.boxShadow = '0 6px 20px rgba(0, 158, 96, 0.35)';
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
