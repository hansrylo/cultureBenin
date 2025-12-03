<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Culture Benin')</title>
    
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
    
    <!-- WordPress Theme Styles (if needed) -->
    @stack('styles')
    
    <style>
        :root {
            --wp--preset--spacing--20: 1.125rem;
            --wp--preset--spacing--30: 1.5rem;
            --wp--preset--spacing--40: 2rem;
            --wp--preset--spacing--50: 2.75rem;
            --wp--preset--spacing--60: 3.625rem;
            --wp--preset--color--base: #ffffff;
            --wp--preset--color--accent-1: #1a1a1a;
            --wp--preset--color--accent-2: #0066cc;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        .wp-block-group {
            display: block;
        }
        
        .wp-block-columns {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }
        
        .wp-block-column {
            flex: 1 1 0;
        }
        
        .alignwide {
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);background-color:var(--wp--preset--color--accent-1);">
        <div style="max-width: 90%; margin: 0 auto;">
            <div class="wp-block-columns" style="align-items: center;">
                <div class="wp-block-column" style="flex-basis: 50%;">
                    <h1 style="font-size: 2rem; color: white;">
                        <a href="{{ route('Home') }}" style="color: inherit; text-decoration: none;">
                            Culture Benin
                        </a>
                    </h1>
                </div>
                <div class="wp-block-column" style="flex-basis: 50%; text-align: right;">
                    <nav style="display: flex; gap: 2rem; justify-content: flex-end;">
                        <a href="{{ route('Home') }}" style="color: white; text-decoration: none; text-transform: uppercase; font-size: 0.9rem;">Accueil</a>
                        <a href="{{ route('langues.index') }}" style="color: white; text-decoration: none; text-transform: uppercase; font-size: 0.9rem;">Langues</a>
                        <a href="{{ route('regions.index') }}" style="color: white; text-decoration: none; text-transform: uppercase; font-size: 0.9rem;">Régions</a>
                        <a href="{{ route('contenus.index') }}" style="color: white; text-decoration: none; text-transform: uppercase; font-size: 0.9rem;">Contenus</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main style="min-height: calc(100vh - 200px); padding: 2rem 0;">
        <div style="max-width: 90%; margin: 0 auto;">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);background-color:var(--wp--preset--color--accent-1);margin-top:3rem;">
        <div style="max-width: 90%; margin: 0 auto; color: white; text-align: center;">
            <p>&copy; {{ date('Y') }} Culture Benin. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
