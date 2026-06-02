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
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Lato:wght@300;400;700&family=Playfair+Display:wght@400;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- HTML5-QR Code -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
</head>

<body class="font-sans antialiased text-cozy-brown">
    <div class="min-h-screen bg-cozy-bg selection:bg-cozy-warm selection:text-cozy-brown">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-cozy-card/80 backdrop-blur-sm shadow-sm border-b border-cozy-warm/30 pt-20">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Floating Notifications (Toast) -->
        @if(session('success') || session('error') || session('status'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 6000)"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                 x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed bottom-8 right-8 z-50 max-w-lg w-full bg-white rounded-3xl shadow-[0_10px_50px_rgba(0,0,0,0.15)] border-2 border-cozy-warm/80 p-6 flex items-start gap-5 pointer-events-auto">
                
                @if(session('success'))
                    <div class="w-14 h-14 rounded-full bg-green-50 text-green-500 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-lg font-serif font-bold text-cozy-brown">Success</p>
                        <p class="text-sm text-cozy-brown/70 mt-1 leading-relaxed">{{ session('success') }}</p>
                    </div>
                @elseif(session('error'))
                    <div class="w-14 h-14 rounded-full bg-red-50 text-red-500 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-lg font-serif font-bold text-cozy-brown">Error</p>
                        <p class="text-sm text-cozy-brown/70 mt-1 leading-relaxed">{{ session('error') }}</p>
                    </div>
                @else
                    <div class="w-14 h-14 rounded-full bg-cozy-warm/60 text-cozy-accent flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 111.059.95l-.148.148c-.085.084-.148.188-.182.301l-.213.68c-.06.192-.189.356-.364.453l-.226.125a.75.75 0 11-.76-1.3l.211-.117a.25.25 0 00.121-.151l.214-.68a.75.75 0 01.545-.494zM12 18.75h.008v.008H12v-.008z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-lg font-serif font-bold text-cozy-brown">Notification</p>
                        <p class="text-sm text-cozy-brown/70 mt-1 leading-relaxed">{{ session('status') }}</p>
                    </div>
                @endif
                
                <button @click="show = false" class="text-cozy-brown/40 hover:text-cozy-brown transition-colors mt-0.5 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif
    </div>
</body>
</html>