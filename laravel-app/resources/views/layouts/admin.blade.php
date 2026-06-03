<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin · {{ config('app.name', 'e-Doptcat') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#F2EDE3',
                        'cream-dark': '#E8E0D0',
                        gold: '#C9A84C',
                        'gold-dim': 'rgba(201,168,76,0.12)',
                    },
                    fontFamily: {
                        sans:    ['Lato', 'sans-serif'],
                        jakarta: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    boxShadow: {
                        card:       '0 2px 12px rgba(0,0,0,0.06)',
                        'card-lg':  '0 6px 24px rgba(0,0,0,0.10)',
                    }
                }
            }
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Lato', sans-serif; background-color: #F2EDE3; }
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Sidebar slides width only */
        #admin-sidebar {
            transition: width 280ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Text labels collapse in-place */
        .nav-label {
            overflow: hidden;
            white-space: nowrap;
            transition: max-width 250ms cubic-bezier(0.4, 0, 0.2, 1),
                        opacity     200ms ease;
        }
        .nav-label.open   { max-width: 200px; opacity: 1; transition-delay: 80ms; }
        .nav-label.closed { max-width: 0;     opacity: 0; transition-delay: 0ms; }

        /* Nav item padding shifts smoothly */
        .nav-item {
            transition: padding 280ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Suppress ALL transitions on first render */
        .no-transition, .no-transition * {
            transition: none !important;
        }

        /* Active nav: gold pill with slight glow */
        .nav-active {
            background: #C9A84C;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(201,168,76,0.30);
        }

        /* Card global style */
        .card {
            background: #fff;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: box-shadow 200ms ease;
        }
        .card:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.10); }
        .card-sm {
            background: #fff;
            border-radius: 1rem;
            padding: 1.25rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: box-shadow 200ms ease;
        }
        .card-sm:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.10); }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased">

@php
    $initialMenu = match(true) {
        request()->routeIs('admin.adoptions.*')  => 'applications',
        request()->routeIs('admin.donations.*', 'admin.expenses.*')  => 'fund',
        request()->routeIs('admin.events.*')                         => 'web',
        request()->routeIs('admin.volunteers.*', 'admin.users.*')    => 'staff',
        default => '',
    };
@endphp

<div class="flex h-screen overflow-hidden"
     :class="ready ? '' : 'no-transition'"
     @tour-sidebar.window="sidebarOpen = $event.detail"
     x-data="{
         sidebarOpen: JSON.parse(localStorage.getItem('sidebarOpen') ?? 'true'),
         openMenu: '{{ $initialMenu }}',
         ready: false,
         init() {
             this.$nextTick(() => { this.ready = true })
             this.$watch('sidebarOpen', v => localStorage.setItem('sidebarOpen', v))
         }
     }">

    <!-- Sidebar -->
    <aside id="admin-sidebar"
           :class="sidebarOpen ? 'w-60' : 'w-[64px]'"
           class="bg-[#252525] flex flex-col flex-shrink-0 overflow-hidden">

        <!-- Logo -->
        <div class="nav-item h-[72px] flex items-center border-b border-[#303030] overflow-hidden"
             :class="sidebarOpen ? 'px-4 gap-3' : 'px-[14px]'">
            <img src="{{ asset('images/logo.jpg') }}" alt="e-Doptcat"
                 class="w-9 h-9 rounded-full object-cover flex-shrink-0 ring-2 ring-[#C9A84C]/40">
            <span class="nav-label" :class="sidebarOpen ? 'open' : 'closed'">
                <span class="font-jakarta text-[12px] font-bold tracking-wide text-white leading-tight">e-Doptcat
                    <span class="block text-[10px] font-medium text-[#C9A84C] tracking-widest uppercase">Admin Panel</span>
                </span>
            </span>
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-2 py-5 space-y-0.5 overflow-y-auto overflow-x-hidden">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               data-tour="dashboard"
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
               data-tour="cats"
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
                        data-tour="applications"
                        :title="!sidebarOpen ? 'Applications' : ''"
                        :class="sidebarOpen ? 'px-3 gap-3' : 'px-[14px]'"
                        class="nav-item flex items-center py-2.5 rounded-xl text-sm font-medium w-full
                               {{ request()->routeIs('admin.adoptions.*') ? 'bg-[#C9A84C] text-white font-semibold' : 'text-[#9A9A9A] hover:bg-[#383838] hover:text-white' }}">
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
                </div>
            </div>

            {{-- Reports Hub --}}
            <a href="{{ route('admin.reporting.index') }}"
               data-tour="reports"
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
                        data-tour="fund"
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
                        data-tour="staff"
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
                        Manage Staff
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
        <header class="bg-white px-6 h-[72px] flex items-center justify-between flex-shrink-0" style="box-shadow:0 1px 0 rgba(0,0,0,0.06)">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen"
                        class="text-gray-400 hover:text-[#C9A84C] transition-colors p-1.5 rounded-lg hover:bg-[#F2EDE3]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/>
                    </svg>
                </button>
                <p class="font-jakarta text-sm font-bold text-[#1C1A17] tracking-wide">Feline Management Console</p>
            </div>
            <div class="flex items-center gap-4">
                <button onclick="window.dispatchEvent(new CustomEvent('tour-relaunch'))"
                        title="Guided Tour"
                        class="relative text-gray-400 hover:text-[#C9A84C] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/>
                    </svg>
                </button>
                <!-- Notification Bell -->
                <div x-data="notificationBell()" class="relative">
                    <button @click="toggle()"
                            class="relative text-gray-400 hover:text-[#C9A84C] transition-colors p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                        </svg>
                        <!-- Badge -->
                        <span x-show="count > 0"
                              x-text="count > 9 ? '9+' : count"
                              class="absolute -top-0.5 -right-0.5 min-w-[16px] h-4 px-0.5 bg-red-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center leading-none">
                        </span>
                    </button>

                    <!-- Dropdown panel -->
                    <div x-show="open"
                         @click.outside="open = false"
                         x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 top-full mt-2 w-80 bg-white rounded-2xl shadow-2xl border border-[#E8E2D8] overflow-hidden z-50"
                         style="transform-origin: top right">

                        <!-- Header -->
                        <div class="px-5 py-3.5 border-b border-[#F0EBE3] flex items-center justify-between">
                            <p class="font-jakarta font-extrabold text-[13px] text-[#1C1A17]">Notifications</p>
                            <span x-show="count > 0"
                                  x-text="count + ' new'"
                                  class="text-[10px] font-bold text-[#C9A84C] bg-[#FAF8F0] px-2 py-0.5 rounded-full border border-[#EDD98A]">
                            </span>
                            <span x-show="count === 0 && !loading"
                                  class="text-[10px] font-medium text-gray-400">
                                All caught up
                            </span>
                        </div>

                        <!-- Loading spinner -->
                        <div x-show="loading" class="py-10 flex items-center justify-center">
                            <div class="w-5 h-5 border-2 border-[#C9A84C] border-t-transparent rounded-full animate-spin"></div>
                        </div>

                        <!-- Empty state -->
                        <div x-show="!loading && items.length === 0"
                             class="py-10 flex flex-col items-center gap-2 text-center px-6">
                            <div class="w-12 h-12 rounded-2xl bg-[#FAF8F0] flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                                </svg>
                            </div>
                            <p class="text-[13px] font-semibold text-gray-500">You're all caught up!</p>
                            <p class="text-[11px] text-gray-400">No pending items right now.</p>
                        </div>

                        <!-- Notification items -->
                        <div x-show="!loading && items.length > 0"
                             class="divide-y divide-[#F5F1EB] max-h-[340px] overflow-y-auto">
                            <template x-for="(item, i) in items" :key="i">
                                <a :href="item.url"
                                   class="flex items-start gap-3 px-5 py-3.5 hover:bg-[#FAF8F5] transition group">
                                    <div class="w-8 h-8 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5"
                                         :class="item.iconBg">
                                        <span x-html="item.icon"></span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-[12px] font-bold text-gray-800 truncate" x-text="item.title"></p>
                                        <p class="text-[11px] text-gray-500 mt-0.5 line-clamp-2 leading-relaxed" x-text="item.subtitle"></p>
                                        <p class="text-[10px] text-gray-400 mt-1" x-text="item.time"></p>
                                    </div>
                                    <svg class="w-3.5 h-3.5 text-gray-300 group-hover:text-[#C9A84C] flex-shrink-0 mt-1 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                    </svg>
                                </a>
                            </template>
                        </div>

                        <!-- Footer -->
                        <div class="px-5 py-3 border-t border-[#F0EBE3] bg-[#FAF8F5] flex items-center justify-between">
                            <a href="{{ route('admin.reporting.index') }}"
                               class="text-[11px] font-bold text-[#C9A84C] hover:text-amber-700 transition">
                                View all activity →
                            </a>
                            <button @click="refresh()"
                                    class="text-[11px] text-gray-400 hover:text-gray-600 transition flex items-center gap-1">
                                <svg class="w-3 h-3" :class="loading ? 'animate-spin' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
                                </svg>
                                Refresh
                            </button>
                        </div>
                    </div>
                </div>
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
        <main class="flex-1 overflow-y-auto p-8" style="background:#F2EDE3">
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
        <footer class="px-8 py-3 bg-white" style="border-top:1px solid rgba(0,0,0,0.06)">
            <p class="text-[10px] text-gray-400 text-center">© {{ date('Y') }} e-Doptcat Administrative Atelier · All systems operational.</p>
        </footer>
    </div>
</div>

<!-- ── Global Confirmation Modal ──────────────────────────────────────── -->
<div x-data="globalConfirmModal()"
     @confirm-modal.window="open($event.detail)"
     x-show="show"
     x-transition:enter="transition ease-out duration-150"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-100"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/40 px-4"
     style="display:none">
    <div x-show="show"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @click.outside="close()"
         class="bg-white rounded-2xl shadow-2xl w-full max-w-xs p-7 text-center">
        <div class="w-14 h-14 rounded-full mx-auto mb-4 flex items-center justify-center" :class="iconBg">
            <span x-html="iconHtml" class="flex items-center justify-center"></span>
        </div>
        <p class="font-jakarta text-lg font-extrabold text-[#1C1A17] mb-1.5" x-text="title"></p>
        <p class="text-sm text-[#A09890] mb-6 leading-relaxed" x-text="message"></p>
        <div class="flex gap-3">
            <button @click="close()"
                    class="flex-1 px-4 py-2.5 text-sm font-semibold text-[#6B6560] border border-[#E8E2D8] rounded-xl hover:bg-[#F2EDE3] transition">
                Cancel
            </button>
            <button @click="doConfirm()"
                    class="flex-1 px-4 py-2.5 text-sm font-semibold text-white rounded-xl transition"
                    :class="confirmClass"
                    x-text="confirmLabel"></button>
        </div>
    </div>
</div>

<!-- ── Admin Guided Tour ─────────────────────────────────────────────────── -->
<div x-data="adminTutorial()"
     @tour-relaunch.window="show = true; step = 0; highlighted = false"
     @resize.window="onResize()">

    {{-- Spotlight ring (highlight box with box-shadow creating the dark overlay) --}}
    <div x-show="show && highlighted"
         x-cloak
         class="fixed z-[9998] rounded-2xl pointer-events-none"
         :style="`top:${highlight.top}px;left:${highlight.left}px;width:${highlight.width}px;height:${highlight.height}px;box-shadow:0 0 0 9999px rgba(0,0,0,0.55);border:2px solid #C9A84C`">
    </div>

    {{-- Tooltip card (appears beside the highlighted element) --}}
    <div x-show="show && highlighted"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed z-[9999] w-72 bg-white rounded-2xl shadow-2xl overflow-hidden"
         :style="`top:${tooltip.top}px;left:${tooltip.left}px`">

        <div class="h-1 bg-gradient-to-r from-[#C9A84C] to-[#E5C272]"></div>
        <div class="p-5">
            {{-- Step counter + skip --}}
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-bold text-[#C9A84C] uppercase tracking-widest"
                      x-text="'Step ' + step + ' of ' + (steps.length - 2)"></span>
                <button @click="skip()"
                        class="text-[11px] font-medium text-gray-400 hover:text-gray-600 transition">
                    Skip Tutorial
                </button>
            </div>

            {{-- Title + description --}}
            <p class="font-jakarta text-[15px] font-extrabold text-[#1C1A17] mb-1.5" x-text="current.title"></p>
            <p class="text-[13px] text-gray-500 leading-relaxed mb-4" x-text="current.desc"></p>

            {{-- Progress dots --}}
            <div class="flex items-center gap-1.5 mb-5">
                <template x-for="(s, i) in steps.slice(1, steps.length - 1)" :key="i">
                    <div class="rounded-full transition-all duration-200"
                         :class="(i + 1) === step ? 'w-5 h-1.5 bg-[#C9A84C]' : 'w-1.5 h-1.5 bg-gray-200'">
                    </div>
                </template>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-2">
                <button x-show="step > 1"
                        @click="prev()"
                        class="px-4 py-2 text-[12px] font-semibold text-gray-500 border border-[#E8E2D8] rounded-xl hover:bg-[#FAF8F5] transition">
                    ← Back
                </button>
                <button @click="next()"
                        class="flex-1 py-2 text-[12px] font-bold text-white bg-[#C9A84C] rounded-xl hover:bg-[#b8963e] transition">
                    <span x-text="step === steps.length - 2 ? 'Finish ✓' : 'Next →'"></span>
                </button>
            </div>
        </div>
    </div>

    {{-- Centered overlay: Welcome card + Done card --}}
    <div x-show="show && !highlighted"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[9997] bg-black/50 flex items-center justify-center px-4">

        {{-- Welcome card --}}
        <div x-show="step === 0"
             x-transition:enter="transition ease-out duration-250"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden text-center">

            <div class="bg-gradient-to-br from-[#FAF8F0] to-[#EFE5CC] px-8 pt-10 pb-7">
                <div class="w-20 h-20 rounded-2xl bg-white shadow-lg mx-auto mb-5 flex items-center justify-center ring-4 ring-[#C9A84C]/20">
                    <svg class="w-11 h-11 text-[#C9A84C]" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M6 4c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm8 0c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zM4 10c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm12 0c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zM12 21c-3.87 0-7-1.57-7-4.5 0-1.5 1-2.8 2.5-3.6.6-.3 1.3-.5 2-.6.8-.1 1.6-.3 2.5-.3s1.7.2 2.5.3c.7.1 1.4.3 2 .6 1.5.8 2.5 2.1 2.5 3.6 0 2.93-3.13 4.5-7 4.5z"/>
                    </svg>
                </div>
                <h2 class="font-jakarta text-[22px] font-extrabold text-[#1C1A17] mb-2">Welcome to e-Doptcat Admin</h2>
                <p class="text-[13px] text-gray-500 leading-relaxed">Take a quick 6-step tour of the key features so you can hit the ground running.</p>
            </div>

            <div class="px-8 py-6">
                <div class="grid grid-cols-2 gap-x-4 gap-y-2.5 mb-6 text-left">
                    <template x-for="label in ['Cat Directory','Applications','Reports Hub','Fund Management','Events & Calendar','Staff & Volunteers']" :key="label">
                        <div class="flex items-center gap-2 text-[12px] text-gray-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C] flex-shrink-0"></span>
                            <span x-text="label"></span>
                        </div>
                    </template>
                </div>

                <button @click="startTour()"
                        class="w-full py-3 bg-[#C9A84C] text-white text-[13px] font-bold rounded-xl hover:bg-[#b8963e] transition mb-3 shadow-md shadow-amber-600/20">
                    Start Tour →
                </button>
                <button @click="skip()"
                        class="w-full py-2 text-[12px] text-gray-400 hover:text-gray-600 font-medium transition">
                    Skip Tutorial
                </button>
            </div>
        </div>

        {{-- Done card --}}
        <div x-show="step === steps.length - 1"
             x-transition:enter="transition ease-out duration-250"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden text-center">

            <div class="bg-gradient-to-br from-[#F0FDFA] to-[#CCFBF1] px-8 pt-10 pb-7">
                <div class="w-20 h-20 rounded-2xl bg-white shadow-lg mx-auto mb-5 flex items-center justify-center ring-4 ring-teal-400/30">
                    <svg class="w-11 h-11 text-teal-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="font-jakarta text-[22px] font-extrabold text-[#1C1A17] mb-2">You're all set!</h2>
                <p class="text-[13px] text-gray-500 leading-relaxed">The admin panel is your sanctuary's control room. Go keep those cats safe and happy!</p>
            </div>

            <div class="px-8 py-7">
                <button @click="done()"
                        class="w-full py-3 bg-[#C9A84C] text-white text-[13px] font-bold rounded-xl hover:bg-[#b8963e] transition shadow-md shadow-amber-600/20">
                    Get Started →
                </button>
            </div>
        </div>
    </div>
</div>

<script>
const _CM_ICONS = {
    delete: {
        bg:    'bg-red-100',
        html:  '<svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>',
        btn:   'bg-red-500 hover:bg-red-600',
        label: 'Delete',
    },
    warning: {
        bg:    'bg-amber-100',
        html:  '<svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>',
        btn:   'bg-amber-500 hover:bg-amber-600',
        label: 'Confirm',
    },
    done: {
        bg:    'bg-green-100',
        html:  '<svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>',
        btn:   'bg-green-500 hover:bg-green-600',
        label: 'Confirm',
    },
};

window._confirmCb = null;
window.showConfirmModal = function (opts) {
    const icon = _CM_ICONS[opts.icon ?? 'delete'];
    window._confirmCb = typeof opts.onConfirm === 'function' ? opts.onConfirm : null;
    window.dispatchEvent(new CustomEvent('confirm-modal', { detail: {
        title:        opts.title        ?? 'Are you sure?',
        message:      opts.message      ?? '',
        iconBg:       icon.bg,
        iconHtml:     icon.html,
        confirmLabel: opts.confirmLabel ?? icon.label,
        confirmClass: opts.confirmClass ?? icon.btn,
        formId:       opts.formId       ?? null,
    }}));
};

function globalConfirmModal() {
    return {
        show: false, title: '', message: '',
        iconBg: 'bg-red-100', iconHtml: '', confirmLabel: 'Delete',
        confirmClass: 'bg-red-500 hover:bg-red-600', _formId: null,
        open(d) {
            this.title = d.title; this.message = d.message;
            this.iconBg = d.iconBg; this.iconHtml = d.iconHtml;
            this.confirmLabel = d.confirmLabel; this.confirmClass = d.confirmClass;
            this._formId = d.formId ?? null;
            this.show = true;
        },
        close()     { this.show = false; },
        doConfirm() {
            this.show = false;
            if (this._formId) { document.getElementById(this._formId)?.submit(); return; }
            if (window._confirmCb) { const cb = window._confirmCb; window._confirmCb = null; cb(); }
        },
    };
}

function notificationBell() {
    return {
        open:    false,
        loading: false,
        fetched: false,
        count:   0,
        items:   [],

        init() {
            // Silently load the badge count on every page
            fetch('{{ route("admin.notifications") }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(r => r.json())
                .then(d => { this.count = d.count; this.items = d.items; this.fetched = true; })
                .catch(() => {});
        },

        async toggle() {
            this.open = !this.open;
            if (this.open && !this.fetched) await this.refresh();
        },

        async refresh() {
            this.loading = true;
            try {
                const r = await fetch('{{ route("admin.notifications") }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                const d = await r.json();
                this.count   = d.count;
                this.items   = d.items;
                this.fetched = true;
            } catch (_) {}
            finally { this.loading = false; }
        },
    };
}

function adminTutorial() {
    return {
        show:        false,
        step:        0,
        highlighted: false,
        steps: [
            { selector: null },
            {
                selector: '[data-tour="dashboard"]',
                title:    'Dashboard',
                desc:     'Your command centre — live KPI cards, adoption trends, donation sparklines, and the next upcoming event, all in one view.',
            },
            {
                selector: '[data-tour="cats"]',
                title:    'Cat Directory',
                desc:     'Every resident lives here. Add new intakes, update medical records, set vaccination status, and toggle availability for adoption.',
            },
            {
                selector: '[data-tour="applications"]',
                title:    'Applications',
                desc:     'Review incoming adoption requests and advance applicants through the pipeline — from first inquiry all the way to an approved home.',
            },
            {
                selector: '[data-tour="reports"]',
                title:    'Reports Hub',
                desc:     'Track incident reports and submitted feedback. Everything is documented so nothing slips through the cracks.',
            },
            {
                selector: '[data-tour="fund"]',
                title:    'Fund Management',
                desc:     'Monitor donations and allocate expenses. Full transaction log with stats and financial health indicators for the sanctuary.',
            },
            {
                selector: '[data-tour="staff"]',
                title:    'Staff & Volunteers',
                desc:     'Coordinate volunteer applications and manage admin accounts — your whole team organised under one roof.',
            },
            { selector: null },
        ],
        highlight:   { top: 0, left: 0, width: 0, height: 0 },
        tooltip:     { top: 0, left: 0 },
        _origSidebar: true,

        init() {
            if (!localStorage.getItem('adminTourDone')) {
                this._origSidebar = JSON.parse(localStorage.getItem('sidebarOpen') ?? 'true');
                this.$nextTick(() => { this.show = true; });
            }
        },

        get current() { return this.steps[this.step] ?? this.steps[0]; },

        startTour() {
            // open sidebar so nav labels are visible, then wait for its 280ms animation
            window.dispatchEvent(new CustomEvent('tour-sidebar', { detail: true }));
            this.step = 1;
            setTimeout(() => {
                this.positionHighlight();
                this.highlighted = true;
            }, 320);
        },

        goTo(index) {
            this.step = index;
            this.$nextTick(() => this.positionHighlight());
        },

        positionHighlight() {
            const s = this.current;
            if (!s?.selector) return;
            const el = document.querySelector(s.selector);
            if (!el) { this.next(); return; }
            const r   = el.getBoundingClientRect();
            const pad = 8;
            this.highlight = {
                top:    r.top    - pad,
                left:   r.left   - pad,
                width:  r.width  + pad * 2,
                height: r.height + pad * 2,
            };
            // tooltip floats to the right of the sidebar, vertically centred on element
            const tH  = 240;
            const top = Math.max(72, Math.min(r.top + r.height / 2 - tH / 2, window.innerHeight - tH - 16));
            this.tooltip = { top, left: r.right + 20 };
        },

        onResize() { if (this.show && this.highlighted) this.positionHighlight(); },

        next() {
            const n = this.step + 1;
            if (n >= this.steps.length - 1) {
                // going to done card — hide spotlight first
                this.highlighted = false;
                this.step = this.steps.length - 1;
                return;
            }
            this.goTo(n);
        },

        prev() { if (this.step > 1) this.goTo(this.step - 1); },

        _end() {
            localStorage.setItem('adminTourDone', '1');
            window.dispatchEvent(new CustomEvent('tour-sidebar', { detail: this._origSidebar }));
            this.show = false;
            this.highlighted = false;
        },

        done() { this._end(); },
        skip() { this._end(); },
    };
}
</script>
</body>
</html>
