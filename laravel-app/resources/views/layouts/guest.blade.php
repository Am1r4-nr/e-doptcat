<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<<<<<<< HEAD

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
=======
    <title>{{ config('app.name', 'e-Doptcat') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Lato:wght@300;400;700&family=Playfair+Display:wght@400;600;700;800&family=Montserrat:wght@400;500;600;700;800;900&family=Dancing+Script:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-montserrat antialiased bg-cozy-bg text-cozy-brown" style="min-height: 100vh;">

    {{-- Organic Blob Backgrounds --}}
    <div class="fixed top-[-10%] left-[-10%] w-[50%] h-[50%] bg-[#F5DEB3] opacity-50 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[60%] h-[60%] bg-[#FFF4E3] opacity-60 rounded-[60%_40%_30%_70%/60%_30%_70%_40%] blur-3xl pointer-events-none -z-10"></div>

    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center px-4 py-10">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-8 group">
            <svg viewBox="0 0 100 100" class="w-12 h-12 shadow-sm rounded-full" style="color:#6F4E37;">
                <circle cx="50" cy="50" r="50" fill="#FFF4E3"/>
                <path d="M30,85 L30,45 Q30,20 55,20 Q80,20 80,45 L80,55 Q80,75 60,75 Q45,75 40,65 L30,85Z" fill="currentColor"/>
                <path d="M48,38 L44,28 Q43,26 45,27 L50,32Z" fill="currentColor"/>
                <path d="M62,38 L58,32 Q57,27 59,28 L66,38Z" fill="currentColor"/>
                <circle cx="48" cy="46" r="3.5" fill="#FFF4E3"/>
                <circle cx="62" cy="46" r="3.5" fill="#FFF4E3"/>
                <path d="M52,54 Q55,57 58,54" stroke="#FFF4E3" stroke-width="2" fill="none" stroke-linecap="round"/>
            </svg>
            <span class="font-script text-[32px] font-bold text-cozy-brown tracking-tight group-hover:text-cozy-brown/80 transition-colors">
                e-Doptcat
            </span>
        </a>

        {{-- Card slot --}}
        <div class="w-full max-w-md bg-cozy-card rounded-[2.5rem] shadow-xl p-8 border border-cozy-brown/10">
            {{ $slot }}
        </div>

        {{-- Back link --}}
        <a href="{{ route('home') }}"
           class="mt-8 text-[14px] font-bold text-cozy-brown/60 hover:text-cozy-brown transition-colors flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Home
        </a>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
    </div>
</body>
</html>
