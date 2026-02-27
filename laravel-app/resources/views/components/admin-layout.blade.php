<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Playfair+Display:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Admin Header -->
        <nav class="bg-gray-900 border-b border-gray-700 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center gap-8">
                        <a href="{{ route('admin.dashboard') }}" class="text-white font-bold text-lg">
                            ADMIN PANEL
                        </a>
                        <div class="hidden md:flex gap-6">
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'text-white border-b-2 border-blue-500' : '' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('admin.cats.index') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.cats.*') ? 'text-white border-b-2 border-blue-500' : '' }}">
                                Cats
                            </a>
                            <a href="{{ route('admin.adoptions.index') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.adoptions.*') ? 'text-white border-b-2 border-blue-500' : '' }}">
                                Adoptions
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'text-white border-b-2 border-blue-500' : '' }}">
                                Users
                            </a>
                            <a href="{{ route('admin.reports.index') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.reports.*') ? 'text-white border-b-2 border-blue-500' : '' }}">
                                Reports
                            </a>
                            <a href="{{ route('admin.donations.index') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.donations.*') ? 'text-white border-b-2 border-blue-500' : '' }}">
                                Donations
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="text-gray-300 text-sm">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Admin Content -->
        <main class="py-8">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
