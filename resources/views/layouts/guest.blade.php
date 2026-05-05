<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RZ Market') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/smoke.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background: var(--bg-dark); color: var(--text-main);">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background: radial-gradient(circle at top right, rgba(255, 159, 28, 0.08), transparent 500px), radial-gradient(circle at bottom left, rgba(46, 196, 182, 0.08), transparent 500px);">
            <div style="margin-bottom: 2rem; text-align: center;">
                <a href="/">
                    <h1 style="font-size: 2.5rem; font-weight: 800; letter-spacing: -2px; margin: 0;">RZ <span style="color: var(--primary);">MARKET</span></h1>
                    <p style="color: var(--text-muted); font-size: 0.8125rem; letter-spacing: 2px; text-transform: uppercase; margin-top: 5px;">Management System</p>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 smoke-card" style="background: var(--glass); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1);">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
