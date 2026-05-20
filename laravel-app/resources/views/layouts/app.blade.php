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
<<<<<<< HEAD
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Lato:wght@300;400;700&family=Playfair+Display:wght@400;600;700;800&display=swap"
=======
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Lato:wght@300;400;700&family=Playfair+Display:wght@400;600;700;800&family=Montserrat:wght@400;500;600;700;800;900&family=Dancing+Script:wght@400;600;700&display=swap"
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
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

<<<<<<< HEAD
<body class="font-sans antialiased text-cozy-brown">
    <div class="min-h-screen bg-cozy-bg selection:bg-cozy-warm selection:text-cozy-brown">
=======
<body class="font-montserrat antialiased text-cozy-brown">
    <div class="min-h-screen bg-cozy-bg selection:bg-cozy-light selection:text-cozy-brown">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
<<<<<<< HEAD
            <header class="bg-cozy-card/80 backdrop-blur-sm shadow-sm border-b border-cozy-warm/30 pt-20">
=======
            <header class="bg-white shadow pt-20">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>