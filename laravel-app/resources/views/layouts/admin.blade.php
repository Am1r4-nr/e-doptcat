<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin · {{ config('app.name', 'e-Doptcat') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#FAF6F0',
                        'cream-dark': '#F0E8DC',
                        amber: {
                            850: '#92400e',
                        }
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Lato', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Lato', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="antialiased bg-[#FAF6F0]">
<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-60 bg-white flex flex-col flex-shrink-0 border-r border-amber-100">

        <!-- Logo -->
        <div class="px-6 pt-7 pb-5 border-b border-amber-100">
            <p class="text-[11px] font-semibold tracking-widest text-amber-500 uppercase mb-0.5">e-Doptcat Admin</p>
            <p class="font-serif italic text-gray-400 text-sm">Nurturing Atelier</p>
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-3 py-5 space-y-0.5 overflow-y-auto">
            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.dashboard') ? 'bg-amber-50 text-amber-700 font-semibold' : 'text-gray-400 hover:bg-amber-50 hover:text-amber-700' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                Dashboard
            </a>

            {{-- Applications (with dropdown for Adopter) --}}
            <div x-data="{ open: {{ request()->routeIs('admin.adoptions.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                               {{ request()->routeIs('admin.adoptions.*') ? 'bg-amber-50 text-amber-700 font-semibold' : 'text-gray-400 hover:bg-amber-50 hover:text-amber-700' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                    </svg>
                    <span class="flex-1 text-left">Applications</span>
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="mt-0.5 ml-4 pl-3 border-l border-amber-100 space-y-0.5">

                    <a href="{{ route('admin.adoptions.index') }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition
                              {{ request()->routeIs('admin.adoptions.*') ? 'bg-amber-50 text-amber-700 font-semibold' : 'text-gray-400 hover:bg-amber-50 hover:text-amber-700' }}">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Adopter
                    </a>
                </div>
            </div>

            {{-- Cat Directory --}}
            <a href="{{ route('admin.cats.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.cats.*') ? 'bg-amber-50 text-amber-700 font-semibold' : 'text-gray-400 hover:bg-amber-50 hover:text-amber-700' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path d="M6 4c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm8 0c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zM4 10c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm12 0c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zM12 21c-3.87 0-7-1.57-7-4.5 0-1.5 1-2.8 2.5-3.6.6-.3 1.3-.5 2-.6.8-.1 1.6-.3 2.5-.3s1.7.2 2.5.3c.7.1 1.4.3 2 .6 1.5.8 2.5 2.1 2.5 3.6 0 2.93-3.13 4.5-7 4.5z"/>
                </svg>
                Cat Directory
            </a>

            {{-- Staff Management --}}
            <a href="#"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition text-gray-400 hover:bg-amber-50 hover:text-amber-700">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Staff Management
            </a>

            {{-- Reports / Analytics --}}
            <a href="{{ route('admin.reports.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.reports.*') ? 'bg-amber-50 text-amber-700 font-semibold' : 'text-gray-400 hover:bg-amber-50 hover:text-amber-700' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                </svg>
                Analytics
            </a>

            {{-- Fund Management (collapsible dropdown) --}}
            <div x-data="{ open: {{ request()->routeIs('admin.donations.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                               {{ request()->routeIs('admin.donations.*') ? 'bg-amber-50 text-amber-700 font-semibold' : 'text-gray-400 hover:bg-amber-50 hover:text-amber-700' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="flex-1 text-left">Fund Management</span>
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="mt-0.5 ml-4 pl-3 border-l border-amber-100 space-y-0.5">

                    <a href="{{ route('admin.donations.index') }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition
                              {{ request()->routeIs('admin.donations.*') ? 'bg-amber-50 text-amber-700 font-semibold' : 'text-gray-400 hover:bg-amber-50 hover:text-amber-700' }}">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                        </svg>
                        Donation Log
                    </a>

                    <a href="{{ route('admin.expenses.index') }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition
                              {{ request()->routeIs('admin.expenses.*') ? 'bg-amber-50 text-amber-700 font-semibold' : 'text-gray-400 hover:bg-amber-50 hover:text-amber-700' }}">
                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Expenses
                    </a>

                </div>
            </div>
        </nav>

        <!-- Bottom: Preview + Settings + User -->
        <div class="px-3 pb-5 space-y-0.5 border-t border-amber-100 pt-4">
            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-400 hover:bg-amber-50 hover:text-amber-700 transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253M3 12c0 .778.099 1.533.284 2.253"/>
                </svg>
                Preview Website
            </a>
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.users.*') ? 'bg-amber-50 text-amber-700 font-semibold' : 'text-gray-400 hover:bg-amber-50 hover:text-amber-700' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                </svg>
                Manage Users
            </a>
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-400 hover:bg-amber-50 hover:text-amber-700 transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Settings
            </a>

            <!-- User row -->
            @php $sidebarUser = auth()->user(); @endphp
            <div class="flex items-center gap-3 px-3 pt-3 mt-2 border-t border-amber-50">
                @if($sidebarUser?->getAttribute('avatar'))
                    <img src="{{ Storage::url($sidebarUser->getAttribute('avatar')) }}" alt="{{ $sidebarUser->getAttribute('name') }}"
                         class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                @else
                    <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-xs font-bold flex-shrink-0">
                        {{ strtoupper(substr($sidebarUser?->getAttribute('name') ?? 'A', 0, 2)) }}
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-gray-800 truncate">{{ $sidebarUser?->getAttribute('name') }}</p>
                    <p class="text-[10px] text-gray-400 truncate">{{ $sidebarUser?->getAttribute('email') }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Log out" class="text-gray-400 hover:text-amber-600 text-sm transition">→</button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Area -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Top Bar -->
        <header class="bg-white border-b border-amber-100 px-8 py-4 flex items-center justify-between flex-shrink-0">
            <div>
                <p class="text-[10px] tracking-widest text-amber-400 uppercase font-semibold">Feline Management Console</p>
            </div>
            <div class="flex items-center gap-4">
                <button class="relative text-gray-400 hover:text-amber-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                </button>
                @if($sidebarUser?->getAttribute('avatar'))
                    <img src="{{ Storage::url($sidebarUser->getAttribute('avatar')) }}" alt="{{ $sidebarUser->getAttribute('name') }}"
                         class="w-8 h-8 rounded-full object-cover ring-2 ring-amber-200">
                @else
                    <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-xs font-bold ring-2 ring-amber-200">
                        {{ strtoupper(substr($sidebarUser?->getAttribute('name') ?? 'A', 0, 2)) }}
                    </div>
                @endif
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-8">
            @if(session('success'))
                <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl">
                    {{ session('error') }}
                </div>
            @endif
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="px-8 py-3 border-t border-amber-100 bg-white">
            <p class="text-[10px] text-gray-400 text-center">© {{ date('Y') }} e-Doptcat Administrative Atelier. All systems operational.</p>
        </footer>
    </div>
</div>
</body>
</html>
