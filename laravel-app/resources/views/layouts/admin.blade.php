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

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar Navigation -->
        <div class="w-64 bg-white border-r border-gray-200 flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-900">E-DOPTCAT</h1>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 @if(request()->routeIs('admin.dashboard')) bg-yellow-100 @else hover:bg-gray-100 @endif rounded-lg transition">
                    <span class="text-xl">📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.cats.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 @if(request()->routeIs('admin.cats.*')) bg-yellow-100 @else hover:bg-gray-100 @endif rounded-lg transition">
                    <span class="text-xl">🐱</span>
                    <span>Cats</span>
                </a>
                <a href="{{ route('admin.adoptions.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 @if(request()->routeIs('admin.adoptions.*')) bg-yellow-100 @else hover:bg-gray-100 @endif rounded-lg transition">
                    <span class="text-xl">❤️</span>
                    <span>Adoptions</span>
                </a>
                <a href="{{ route('admin.incidents.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 @if(request()->routeIs('admin.incidents.*')) bg-yellow-100 @else hover:bg-gray-100 @endif rounded-lg transition">
                    <span class="text-xl">⚠️</span>
                    <span>Incidents</span>
                </a>
                <a href="{{ route('admin.donations.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 @if(request()->routeIs('admin.donations.*')) bg-yellow-100 @else hover:bg-gray-100 @endif rounded-lg transition">
                    <span class="text-xl">💰</span>
                    <span>Finances</span>
                </a>
                <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 @if(request()->routeIs('admin.reports.*')) bg-yellow-100 @else hover:bg-gray-100 @endif rounded-lg transition">
                    <span class="text-xl">📋</span>
                    <span>Reports</span>
                </a>
                <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 @if(request()->routeIs('admin.messages.*')) bg-yellow-100 @else hover:bg-gray-100 @endif rounded-lg transition">
                    <span class="text-xl">💬</span>
                    <span>Messages</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                    <span class="text-xl">📅</span>
                    <span>Calendar</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                    <span class="text-xl">⚙️</span>
                    <span>Settings</span>
                </a>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center gap-3 px-4 py-3 bg-gray-100 rounded-lg">
                    <div class="w-10 h-10 bg-gray-400 rounded-full flex items-center justify-center text-white font-bold">
                        <span>AD</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">Admin User</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()?->email ?? 'admin@app.com' }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-gray-700">
                            <span class="text-xl">→</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto bg-gray-50">
            <div class="p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
