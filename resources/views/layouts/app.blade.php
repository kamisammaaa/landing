<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO Meta --}}
    @include('partials.seo-meta')

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Fonts & Styles --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    {{-- Google Analytics (GA4) --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-29VD02SQ9G"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-29VD02SQ9G');
    </script>

    {{-- Vite Assets (CSS & JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }

        /* Animasi Grid Kripto Halus untuk Background (Ringan tanpa JS) */
        .crypto-grid {
            background-image: linear-gradient(rgba(16, 185, 129, 0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(16, 185, 129, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>

    @stack('styles')
</head>

<body class="font-sans antialiased bg-[#0a0f1d] text-gray-200 min-h-screen relative selection:bg-emerald-500 selection:text-black">

    {{-- 🌌 Animated Background (FIXED) --}}
    <div class="bg-animation-container">
        <div class="bg-gradient-ambient"></div>

        <div class="bg-orb orb-1"></div>
        <div class="bg-orb orb-2"></div>
        <div class="bg-orb orb-3"></div>
    </div>

    {{-- Static glow (boleh tetap) --}}
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute top-1/3 right-1/4 w-96 h-96 bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none"></div>

    {{-- Navigation --}}
    @include('layouts.navbar')

    {{-- Main --}}
    <main class="min-h-screen relative z-10">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    @stack('scripts')
</body>

</html>