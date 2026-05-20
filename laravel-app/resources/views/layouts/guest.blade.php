<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'e-Doptcat') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Lato:wght@300;400;700&family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes blobPulse {
            0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
            50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
        }
        .blob { animation: blobPulse 10s ease-in-out infinite; }
    </style>
</head>
<body class="font-sans text-cozy-brown antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cozy-bg relative overflow-hidden">

        <!-- Decorative Blobs -->
        <div class="absolute top-[-15%] right-[-10%] w-[40%] h-[50%] bg-cozy-warm/40 blob opacity-50 pointer-events-none"></div>
        <div class="absolute bottom-[-20%] left-[-10%] w-[35%] h-[45%] bg-cozy-accent/20 blob opacity-40 pointer-events-none" style="animation-delay: -5s;"></div>

        <!-- Logo -->
        <div class="relative z-10 mb-4">
            <a href="/" class="flex flex-col items-center gap-2 group">
                @if(file_exists(public_path('images/logo.jpg')))
                    <img src="{{ asset('images/logo.jpg') }}" alt="e-Doptcat" class="h-16 w-16 rounded-full object-cover shadow-lg ring-4 ring-cozy-warm/50 group-hover:ring-cozy-accent transition-all">
                @else
                    <div class="h-16 w-16 rounded-full bg-cozy-brown flex items-center justify-center text-white text-2xl shadow-lg">🐱</div>
                @endif
                <span class="font-script text-3xl text-cozy-brown">e-Doptcat</span>
            </a>
        </div>

        <!-- Auth Card -->
        <div class="w-full sm:max-w-md mt-2 px-6 py-8 bg-cozy-card shadow-xl overflow-hidden sm:rounded-3xl relative z-10 border border-cozy-warm/30">
            {{ $slot }}
        </div>

        <p class="text-sm text-cozy-brown/40 mt-6 relative z-10">© {{ date('Y') }} Abu Hurairah Club</p>
    </div>
</body>
</html>
