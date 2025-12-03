<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">

        <!-- Third Party Plugin(OverlayScrollbars) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous">

        <!-- Third Party Plugin(Bootstrap Icons) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">

        <!-- Required Plugin(AdminLTE) -->
        <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                background-color: #e9ecef;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .login-box {
                width: 400px;
            }
            .card {
                box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
                margin-bottom: 0;
            }
            .card-header {
                background-color: transparent;
                border-bottom: 1px solid rgba(0,0,0,.125);
                padding: 12px;
                text-align: center;
            }
            .card-body {
                padding: 20px;
            }
            .btn-primary {
                background-color: #0d6efd;
                border-color: #0d6efd;
            }
            .btn-primary:hover {
                background-color: #0b5ed7;
                border-color: #0a58ca;
            }
        </style>
    </head>
    <body class="login-page bg-body-secondary">
        <div class="login-box">
            <!-- Logo -->
            <div style="text-align: center; margin-bottom: 2rem;">
                <img src="{{ asset('images/miwakpon-benin-logo-removebg-preview.png') }}" alt="Logo" style="height: 70px; width: auto;">
            </div>
            
            {{ $slot }}
            
        </div>

        <!-- Required Plugin(Bootstrap 5) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!-- Required Plugin(AdminLTE) -->
        <script src="{{ asset('adminlte/js/adminlte.js') }}"></script>
    </body>
</html>
