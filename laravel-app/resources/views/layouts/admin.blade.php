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
    <link href="https://api.fontshare.com/v2/css?f[]=cabinet-grotesk@800,700,600,500,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#EDE8DE',
                        'cream-dark': '#E0D8C8',
                        gold: '#C9A84C',
                        amber: { 850: '#92400e' }
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Lato', 'sans-serif'],
                        cabinet: ['Cabinet Grotesk', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Lato', sans-serif; }
        .font-serif   { font-family: 'Playfair Display', serif; }
        .font-cabinet { font-family: 'Cabinet Grotesk', sans-serif; }

        /* Sidebar slides width only — no global transition-all */
        #admin-sidebar {
            transition: width 280ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Text labels collapse in-place: opacity + max-width together */
        .nav-label {
            overflow: hidden;
            white-space: nowrap;
            transition: max-width 250ms cubic-bezier(0.4, 0, 0.2, 1),
                        opacity     200ms ease;
        }
        .nav-label.open  { max-width: 200px; opacity: 1; transition-delay: 80ms; }
        .nav-label.closed { max-width: 0;    opacity: 0; transition-delay: 0ms; }

        /* Nav item padding shifts smoothly */
        .nav-item {
            transition: padding 280ms cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="antialiased bg-[#EDE8DE]">

@php
    $initialMenu = match(true) {
        request()->routeIs('admin.adoptions.*', 'admin.adopters.*')  => 'applications',
        request()->routeIs('admin.donations.*', 'admin.expenses.*')  => 'fund',
        request()->routeIs('admin.events.*')                         => 'web',
        request()->routeIs('admin.volunteers.*', 'admin.users.*')    => 'staff',
        default => '',
    };
@endphp

<div class="flex h-screen overflow-hidden"
     x-data="{ sidebarOpen: true, openMenu: '{{ $initialMenu }}' }">

    <!-- Sidebar -->
    <aside id="admin-sidebar"
           :class="sidebarOpen ? 'w-60' : 'w-[64px]'"
           class="bg-[#2A2A2A] flex flex-col flex-shrink-0 overflow-hidden">

        <!-- Logo -->
        <div class="nav-item h-[72px] flex items-center border-b border-[#3A3A3A] overflow-hidden"
             :class="sidebarOpen ? 'px-4 gap-3' : 'px-[14px]'">
            <img src="{{ asset('images/logo.jpg') }}" alt="e-Doptcat"
                 class="w-9 h-9 rounded-full object-cover flex-shrink-0">
            <span class="nav-label" :class="sidebarOpen ? 'open' : 'closed'">
                <span class="text-[11px] font-semibold tracking-widest text-[#C9A84C] uppercase leading-tight">e-Doptcat Admin</span>
            </span>
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-2 py-5 space-y-0.5 overflow-y-auto overflow-x-hidden">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               :title="!sidebarOpen ? 'Dashboard' : ''"
               :class="sidebarOpen ? 'px-3 gap-3' : 'px-[14px]'"
               class="nav-item flex items-center py-2.5 rounded-xl text-sm font-medium w-full
                      {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.analytics.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                </svg>
                <span class="nav-label" :class="sidebarOpen ? 'open' : 'closed'">Dashboard</span>
            </a>

            {{-- Cat Directory --}}
            <a href="{{ route('admin.cats.index') }}"
               :title="!sidebarOpen ? 'Cat Directory' : ''"
               :class="sidebarOpen ? 'px-3 gap-3' : 'px-[14px]'"
               class="nav-item flex items-center py-2.5 rounded-xl text-sm font-medium w-full
                      {{ request()->routeIs('admin.cats.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path d="M6 4c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm8 0c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zM4 10c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm12 0c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zM12 21c-3.87 0-7-1.57-7-4.5 0-1.5 1-2.8 2.5-3.6.6-.3 1.3-.5 2-.6.8-.1 1.6-.3 2.5-.3s1.7.2 2.5.3c.7.1 1.4.3 2 .6 1.5.8 2.5 2.1 2.5 3.6 0 2.93-3.13 4.5-7 4.5z"/>
                </svg>
                <span class="nav-label" :class="sidebarOpen ? 'open' : 'closed'">Cat Directory</span>
            </a>

            {{-- Applications dropdown --}}
            <div>
                <button @click="sidebarOpen && (openMenu = openMenu === 'applications' ? '' : 'applications')"
                        :title="!sidebarOpen ? 'Applications' : ''"
                        :class="sidebarOpen ? 'px-3 gap-3' : 'px-[14px]'"
                        class="nav-item flex items-center py-2.5 rounded-xl text-sm font-medium w-full
                               {{ request()->routeIs('admin.adoptions.*') || request()->routeIs('admin.adopters.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                    </svg>
                    <span class="nav-label flex-1 flex items-center justify-between" :class="sidebarOpen ? 'open' : 'closed'">
                        <span>Applications</span>
                        <svg class="w-3 h-3 flex-shrink-0 transition-transform duration-200" :class="openMenu === 'applications' ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </span>
                </button>
                <div x-show="sidebarOpen && openMenu === 'applications'"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="mt-0.5 ml-4 pl-3 border-l border-[#4A4A4A] space-y-0.5">
                    <a href="{{ route('admin.adoptions.index') }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition
                              {{ request()->routeIs('admin.adoptions.index') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                        </svg>
                        Adoptions
                    </a>
                    <a href="{{ route('admin.adopters.index') }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition
                              {{ request()->routeIs('admin.adopters.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Adopters
                    </a>
                </div>
            </div>

            {{-- Reports Hub --}}
            <a href="{{ route('admin.reporting.index') }}"
               :title="!sidebarOpen ? 'Reports Hub' : ''"
               :class="sidebarOpen ? 'px-3 gap-3' : 'px-[14px]'"
               class="nav-item flex items-center py-2.5 rounded-xl text-sm font-medium w-full
                      {{ request()->routeIs('admin.reporting.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                </svg>
                <span class="nav-label" :class="sidebarOpen ? 'open' : 'closed'">Reports Hub</span>
            </a>

            {{-- Fund Management dropdown --}}
            <div>
                <button @click="sidebarOpen && (openMenu = openMenu === 'fund' ? '' : 'fund')"
                        :title="!sidebarOpen ? 'Fund Management' : ''"
                        :class="sidebarOpen ? 'px-3 gap-3' : 'px-[14px]'"
                        class="nav-item flex items-center py-2.5 rounded-xl text-sm font-medium w-full
                               {{ request()->routeIs('admin.donations.*') || request()->routeIs('admin.expenses.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="nav-label flex-1 flex items-center justify-between" :class="sidebarOpen ? 'open' : 'closed'">
                        <span>Fund Management</span>
                        <svg class="w-3 h-3 flex-shrink-0 transition-transform duration-200" :class="openMenu === 'fund' ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </span>
                </button>
                <div x-show="sidebarOpen && openMenu === 'fund'"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="mt-0.5 ml-4 pl-3 border-l border-[#4A4A4A] space-y-0.5">
                    <a href="{{ route('admin.donations.index') }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition
                              {{ request()->routeIs('admin.donations.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                        </svg>
                        Donation Log
                    </a>
                    <a href="{{ route('admin.expenses.index') }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition
                              {{ request()->routeIs('admin.expenses.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Expenses
                    </a>
                </div>
            </div>

        </nav>

        <!-- Bottom Section -->
        <div class="px-2 pb-5 space-y-0.5 border-t border-[#3A3A3A] pt-4">
            <div class="space-y-0.5">

                {{-- Messages --}}
                <a href="{{ route('admin.messages.index') }}"
                   :title="!sidebarOpen ? 'Messages' : ''"
                   :class="sidebarOpen ? 'px-3 gap-3' : 'px-[14px]'"
                   class="nav-item flex items-center py-2.5 rounded-xl text-sm font-medium w-full
                          {{ request()->routeIs('admin.messages.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                    <span class="nav-label" :class="sidebarOpen ? 'open' : 'closed'">Messages</span>
                </a>

                {{-- Calendar --}}
                <a href="{{ route('admin.calendar.index') }}"
                   :title="!sidebarOpen ? 'Calendar' : ''"
                   :class="sidebarOpen ? 'px-3 gap-3' : 'px-[14px]'"
                   class="nav-item flex items-center py-2.5 rounded-xl text-sm font-medium w-full
                          {{ request()->routeIs('admin.calendar.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"/>
                    </svg>
                    <span class="nav-label" :class="sidebarOpen ? 'open' : 'closed'">Calendar</span>
                </a>

                <div class="border-b border-[#3A3A3A]" role="presentation"></div>

                {{-- Web Management dropdown --}}
                <div>
                    <button @click="sidebarOpen && (openMenu = openMenu === 'web' ? '' : 'web')"
                            :title="!sidebarOpen ? 'Web Management' : ''"
                            :class="sidebarOpen ? 'px-3 gap-3' : 'px-[14px]'"
                            class="nav-item flex items-center py-2.5 rounded-xl text-sm font-medium w-full
                                   {{ request()->routeIs('admin.events.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253M3 12c0 .778.099 1.533.284 2.253"/>
                        </svg>
                        <span class="nav-label flex-1 flex items-center justify-between" :class="sidebarOpen ? 'open' : 'closed'">
                            <span>Web Management</span>
                            <svg class="w-3 h-3 flex-shrink-0 transition-transform duration-200" :class="openMenu === 'web' ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </button>
                    <div x-show="sidebarOpen && openMenu === 'web'"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="mt-0.5 ml-4 pl-3 border-l border-[#4A4A4A] space-y-0.5">
                        <a href="{{ route('admin.events.index') }}"
                           class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition
                                  {{ request()->routeIs('admin.events.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                            Event Management
                        </a>
                    </div>
                </div>
            </div>

            {{-- Staff Management dropdown --}}
            <div>
                <button @click="sidebarOpen && (openMenu = openMenu === 'staff' ? '' : 'staff')"
                        :title="!sidebarOpen ? 'Staff Management' : ''"
                        :class="sidebarOpen ? 'px-3 gap-3' : 'px-[14px]'"
                        class="nav-item flex items-center py-2.5 rounded-xl text-sm font-medium w-full
                               {{ request()->routeIs('admin.volunteers.*') || request()->routeIs('admin.users.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="nav-label flex-1 flex items-center justify-between" :class="sidebarOpen ? 'open' : 'closed'">
                        <span>Staff Management</span>
                        <svg class="w-3 h-3 flex-shrink-0 transition-transform duration-200" :class="openMenu === 'staff' ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </span>
                </button>
                <div x-show="sidebarOpen && openMenu === 'staff'"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="mt-0.5 ml-4 pl-3 border-l border-[#4A4A4A] space-y-0.5">
                    <a href="{{ route('admin.volunteers.index') }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition
                              {{ request()->routeIs('admin.volunteers.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                        </svg>
                        Volunteers
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition
                              {{ request()->routeIs('admin.users.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                        </svg>
                        Manage Users
                    </a>
                </div>
            </div>

            <div class="border-b border-[#3A3A3A]" role="presentation"></div>

            {{-- Settings --}}
            <a href="{{ route('profile.edit') }}"
               :title="!sidebarOpen ? 'Settings' : ''"
               :class="sidebarOpen ? 'px-3 gap-3' : 'px-[14px]'"
               class="nav-item flex items-center py-2.5 rounded-xl text-sm w-full text-[#9A9A9A] hover:bg-[#383838] hover:text-white transition-colors">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="nav-label" :class="sidebarOpen ? 'open' : 'closed'">Settings</span>
            </a>

            <!-- User row -->
            @php $sidebarUser = auth()->user(); @endphp
            <div :class="sidebarOpen ? 'px-3 gap-3' : 'px-2'"
                 class="nav-item flex items-center pt-3 mt-2 border-t border-[#3A3A3A] overflow-hidden">
                @if($sidebarUser?->getAttribute('avatar'))
                    <img src="{{ Storage::url($sidebarUser->getAttribute('avatar')) }}" alt="{{ $sidebarUser->getAttribute('name') }}"
                         class="w-8 h-8 rounded-full object-cover flex-shrink-0 ring-2 ring-[#C9A84C]">
                @else
                    <div class="w-8 h-8 rounded-full bg-[#C9A84C] text-white flex items-center justify-center text-xs font-bold flex-shrink-0">
                        {{ strtoupper(substr($sidebarUser?->getAttribute('name') ?? 'A', 0, 2)) }}
                    </div>
                @endif
                <span class="nav-label flex-1 flex items-center gap-2 min-w-0" :class="sidebarOpen ? 'open' : 'closed'">
                    <span class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-white truncate">{{ $sidebarUser?->getAttribute('name') }}</p>
                        <p class="text-[10px] text-[#7A7A7A] truncate">{{ $sidebarUser?->getAttribute('email') }}</p>
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Log out" class="text-[#7A7A7A] hover:text-[#C9A84C] text-sm transition-colors">→</button>
                    </form>
                </span>
            </div>
        </div>
    </aside>

    <!-- Main Area -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Top Bar -->
        <header class="bg-white border-b border-[#E8E2D8] px-6 h-[72px] flex items-center justify-between flex-shrink-0 shadow-sm">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen"
                        class="text-gray-400 hover:text-[#C9A84C] transition-colors p-1.5 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/>
                    </svg>
                </button>
                <p class="text-sm tracking-widest text-[#C9A84C] uppercase font-semibold">Feline Management Console</p>
            </div>
            <div class="flex items-center gap-4">
                <button class="relative text-gray-400 hover:text-[#C9A84C] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                    </svg>
                </button>
                @if($sidebarUser?->getAttribute('avatar'))
                    <img src="{{ Storage::url($sidebarUser->getAttribute('avatar')) }}" alt="{{ $sidebarUser->getAttribute('name') }}"
                         class="w-9 h-9 rounded-full object-cover ring-2 ring-[#C9A84C]">
                @else
                    <div class="w-9 h-9 rounded-full bg-[#C9A84C] text-white flex items-center justify-center text-xs font-bold ring-2 ring-[#C9A84C]/30">
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
        <footer class="px-8 py-3 border-t border-[#E8E2D8] bg-white">
            <p class="text-[10px] text-gray-400 text-center">© {{ date('Y') }} e-Doptcat Administrative Atelier. All systems operational.</p>
        </footer>
    </div>
</div>
</body>
</html>
