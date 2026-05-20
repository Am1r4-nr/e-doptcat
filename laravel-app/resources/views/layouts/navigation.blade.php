<nav x-data="{ open: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 60 })"
<<<<<<< HEAD
     :class="scrolled ? 'bg-cozy-bg/95 backdrop-blur-xl shadow-md py-2' : 'bg-cozy-card py-4'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 border-b border-cozy-warm/20">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        @if(file_exists(public_path('images/logo.jpg')))
                            <img src="{{ asset('images/logo.jpg') }}" alt="e-Doptcat" class="h-10 w-10 rounded-full object-cover shadow-sm ring-2 ring-cozy-warm/50 group-hover:ring-cozy-accent transition-all">
                        @else
                            <div class="h-10 w-10 rounded-full bg-cozy-brown flex items-center justify-center text-white font-bold text-sm shadow-sm">🐱</div>
                        @endif
                        <span class="font-script text-2xl text-cozy-brown group-hover:text-cozy-accent transition-colors hidden sm:block">e-Doptcat</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-8 sm:flex">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-xl transition-all duration-200
                              {{ request()->routeIs('home') ? 'text-cozy-brown bg-cozy-warm/40' : 'text-cozy-brown/70 hover:text-cozy-brown hover:bg-cozy-warm/20' }}">
                        {{ __('Home') }}
                    </a>
                    <a href="{{ route('about') }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-xl transition-all duration-200
                              {{ request()->routeIs('about') ? 'text-cozy-brown bg-cozy-warm/40' : 'text-cozy-brown/70 hover:text-cozy-brown hover:bg-cozy-warm/20' }}">
                        {{ __('About') }}
                    </a>
                    <a href="{{ route('cats.index') }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-xl transition-all duration-200
                              {{ request()->routeIs('cats.*') ? 'text-cozy-brown bg-cozy-warm/40' : 'text-cozy-brown/70 hover:text-cozy-brown hover:bg-cozy-warm/20' }}">
                        {{ __('Our Cats') }}
                    </a>
                    <a href="{{ route('tracker') }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-xl transition-all duration-200
                              {{ request()->routeIs('tracker') ? 'text-cozy-brown bg-cozy-warm/40' : 'text-cozy-brown/70 hover:text-cozy-brown hover:bg-cozy-warm/20' }}">
                        {{ __('Tracker') }}
                    </a>
                    <a href="{{ route('events.index') }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-xl transition-all duration-200
                              {{ request()->routeIs('events.*') ? 'text-cozy-brown bg-cozy-warm/40' : 'text-cozy-brown/70 hover:text-cozy-brown hover:bg-cozy-warm/20' }}">
                        {{ __('Events') }}
                    </a>
                    <a href="{{ route('donations.index') }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-xl transition-all duration-200
                              {{ request()->routeIs('donations.*') ? 'text-cozy-brown bg-cozy-warm/40' : 'text-cozy-brown/70 hover:text-cozy-brown hover:bg-cozy-warm/20' }}">
                        {{ __('Donate') }}
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 text-sm leading-4 font-semibold rounded-xl hover:bg-cozy-warm/20 focus:outline-none transition ease-in-out duration-200 gap-3 group">
                                @if (Auth::user()->avatar)
                                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                        class="w-8 h-8 rounded-full object-cover ring-2 ring-cozy-accent/40 shadow-sm group-hover:ring-cozy-accent transition-all">
                                @else
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-br from-cozy-accent to-cozy-brown flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <div class="text-cozy-brown/80 group-hover:text-cozy-brown transition-colors">{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4 text-cozy-brown/50" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
=======
     :class="scrolled ? 'bg-cozy-bg/95 backdrop-blur-xl border-b border-cozy-brown/10 py-3' : 'bg-transparent py-5'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-in-out">

    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
            <svg viewBox="0 0 100 100" class="w-9 h-9 flex-shrink-0" style="color:#6F4E37;">
                <path d="M30,85 L30,45 Q30,20 55,20 Q80,20 80,45 L80,55 Q80,75 60,75 Q45,75 40,65 L30,85Z" fill="currentColor"/>
                <path d="M48,38 L44,28 Q43,26 45,27 L50,32Z" fill="currentColor"/>
                <path d="M62,38 L58,32 Q57,27 59,28 L66,38Z" fill="currentColor"/>
                <circle cx="48" cy="46" r="3.5" fill="#FFF4E3"/>
                <circle cx="62" cy="46" r="3.5" fill="#FFF4E3"/>
                <path d="M52,54 Q55,57 58,54" stroke="#FFF4E3" stroke-width="2" fill="none" stroke-linecap="round"/>
            </svg>
            <span class="font-script text-[26px] font-bold text-cozy-brown tracking-tight group-hover:text-cozy-brown/80 transition-colors">
                e-Doptcat
            </span>
        </a>

        {{-- Desktop links --}}
        <div class="hidden md:flex items-center gap-7">
            @php
                $navLinks = [
                    ['label' => 'Home',      'route' => 'home',           'match' => 'home'],
                    ['label' => 'About',     'route' => 'about',          'match' => 'about'],
                    ['label' => 'Our Cats',  'route' => 'cats.index',     'match' => 'cats.*'],
                    ['label' => 'Tracker',   'route' => 'tracker',        'match' => 'tracker'],
                    ['label' => 'Events',    'route' => 'events.index',   'match' => 'events.*'],
                    ['label' => 'Donate',    'route' => 'donations.index','match' => 'donations.*'],
                ];
            @endphp
            @foreach ($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="text-[12px] font-bold uppercase tracking-widest transition-colors
                       {{ request()->routeIs($link['match'])
                           ? 'text-cozy-brown'
                           : 'text-cozy-brown/60 hover:text-cozy-brown' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        {{-- Auth area --}}
        <div class="hidden md:flex items-center gap-4">
            @auth
                <div x-data="{ drop: false }" class="relative">
                    <button @click="drop = !drop" @keydown.escape.window="drop = false"
                        class="flex items-center gap-2.5 px-4 py-2 rounded-full hover:bg-cozy-brown/10 transition-colors group">
                        @if (Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                class="w-8 h-8 rounded-full object-cover ring-2 ring-cozy-brown/30">
                        @else
                                     :class="scrolled ? 'bg-cozy-bg/95 backdrop-blur-xl border-b border-cozy-brown/10 py-3' : 'bg-transparent py-5'"
                                     class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-in-out">
                            </div>
                        @endif
                        <span class="text-[13px] font-bold text-cozy-brown">{{ Auth::user()->name }}</span>
                        <svg class="w-3.5 h-3.5 text-cozy-brown/60 transition-transform duration-200" :class="drop ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="drop" @click.outside="drop = false"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-cozy-card border border-cozy-brown/10 rounded-[1.5rem] shadow-xl overflow-hidden py-1"
                         x-cloak>
                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-[13px] font-bold text-cozy-brown hover:bg-cozy-bg transition-colors">
                            <svg class="w-4 h-4 text-cozy-brown/60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Profile
                        </a>
                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-[13px] font-bold text-cozy-brown hover:bg-cozy-bg transition-colors">
                            <svg class="w-4 h-4 text-cozy-brown/60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Admin Panel
                        </a>
                        @endif
                        <div class="my-1 border-t border-cozy-brown/10"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-2.5 text-[13px] font-bold text-red-500 hover:bg-red-50 transition-colors text-left">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Log Out
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                   class="text-[13px] font-bold text-cozy-brown/70 hover:text-cozy-brown transition-colors">
                    Log in
                </a>
                <a href="{{ route('register') }}"
                   class="px-5 py-2.5 rounded-full bg-cozy-brown text-cozy-card text-[13px] font-bold hover:bg-[#573D2B] transition-colors shadow-sm hover:shadow-md hover:-translate-y-px transform duration-200">
                    Register
                </a>
            @endguest
        </div>

        {{-- Mobile burger --}}
        <button @click="open = !open"
            class="md:hidden p-2 rounded-xl hover:bg-cozy-brown/10 transition-colors"
            aria-label="Toggle menu">
            <svg class="w-6 h-6 text-cozy-brown" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" x-cloak/>
            </svg>
        </button>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden border-t border-cozy-brown/10 bg-cozy-bg/98 backdrop-blur-xl"
         x-cloak>
        <div class="max-w-7xl mx-auto px-6 py-5 flex flex-col gap-1">
            @foreach ($navLinks as $link)
                <a href="{{ route($link['route']) }}" @click="open = false"
                   class="px-3 py-2.5 rounded-[1rem] text-[14px] font-bold transition-colors
                       {{ request()->routeIs($link['match'])
                           ? 'bg-cozy-brown/10 text-cozy-brown'
                           : 'text-cozy-brown/80 hover:bg-cozy-brown/5' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach

            <div class="mt-3 pt-4 border-t border-cozy-brown/10">
                @auth
                    <div class="flex items-center gap-3 px-3 py-2 mb-3">
                        @if (Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-cozy-brown/30" alt="">
                        @else
                            <div class="w-10 h-10 rounded-full bg-cozy-brown/15 flex items-center justify-center text-cozy-brown text-sm font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div class="text-[14px] font-bold text-cozy-brown">{{ Auth::user()->name }}</div>
                            <div class="text-[12px] text-cozy-brown/60">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2.5 rounded-[1rem] text-[14px] font-bold text-cozy-brown hover:bg-cozy-brown/10 transition-colors">Profile</a>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2.5 rounded-[1rem] text-[14px] font-bold text-cozy-brown hover:bg-cozy-brown/10 transition-colors">Admin Panel</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="mt-1">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2.5 rounded-[1rem] text-[14px] font-bold text-red-500 hover:bg-red-50 transition-colors">Log Out</button>
                    </form>
                @else
<<<<<<< HEAD
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}"
                            class="text-sm font-semibold text-cozy-brown/70 hover:text-cozy-brown px-4 py-2 rounded-xl hover:bg-cozy-warm/20 transition-all">Log in</a>
                        <a href="{{ route('register') }}"
                            class="px-5 py-2.5 text-sm font-bold text-white bg-cozy-brown rounded-full hover:bg-cozy-brown/90 shadow-md shadow-cozy-brown/20 hover:shadow-lg transition-all duration-200 hover:-translate-y-0.5">Register</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-xl text-cozy-brown/60 hover:text-cozy-brown hover:bg-cozy-warm/20 focus:outline-none transition duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-cozy-card/95 backdrop-blur-xl border-t border-cozy-warm/20">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('home') }}" class="block px-4 py-3 text-sm font-semibold rounded-xl {{ request()->routeIs('home') ? 'text-cozy-brown bg-cozy-warm/30' : 'text-cozy-brown/70 hover:bg-cozy-warm/20' }}">
                {{ __('Home') }}
            </a>
            <a href="{{ route('about') }}" class="block px-4 py-3 text-sm font-semibold rounded-xl {{ request()->routeIs('about') ? 'text-cozy-brown bg-cozy-warm/30' : 'text-cozy-brown/70 hover:bg-cozy-warm/20' }}">
                {{ __('About') }}
            </a>
            <a href="{{ route('cats.index') }}" class="block px-4 py-3 text-sm font-semibold rounded-xl {{ request()->routeIs('cats.*') ? 'text-cozy-brown bg-cozy-warm/30' : 'text-cozy-brown/70 hover:bg-cozy-warm/20' }}">
                {{ __('Our Cats') }}
            </a>
            <a href="{{ route('tracker') }}" class="block px-4 py-3 text-sm font-semibold rounded-xl {{ request()->routeIs('tracker') ? 'text-cozy-brown bg-cozy-warm/30' : 'text-cozy-brown/70 hover:bg-cozy-warm/20' }}">
                {{ __('Tracker') }}
            </a>
            <a href="{{ route('events.index') }}" class="block px-4 py-3 text-sm font-semibold rounded-xl {{ request()->routeIs('events.*') ? 'text-cozy-brown bg-cozy-warm/30' : 'text-cozy-brown/70 hover:bg-cozy-warm/20' }}">
                {{ __('Events') }}
            </a>
            <a href="{{ route('donations.index') }}" class="block px-4 py-3 text-sm font-semibold rounded-xl {{ request()->routeIs('donations.*') ? 'text-cozy-brown bg-cozy-warm/30' : 'text-cozy-brown/70 hover:bg-cozy-warm/20' }}">
                {{ __('Donate') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-cozy-warm/20 px-4">
            @auth
                <div class="px-4 flex items-center gap-3 mb-4">
                    @if (Auth::user()->avatar)
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                            class="w-10 h-10 rounded-full object-cover ring-2 ring-cozy-accent/30 shadow-sm">
                    @else
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-br from-cozy-accent to-cozy-brown flex items-center justify-center text-white text-sm font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <div class="font-semibold text-base text-cozy-brown">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-cozy-brown/50">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm font-semibold rounded-xl text-cozy-brown/70 hover:bg-cozy-warm/20">
                        {{ __('Profile') }}
                    </a>

                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-sm font-semibold rounded-xl text-cozy-brown/70 hover:bg-cozy-warm/20">
                            {{ __('Admin Panel') }}
                        </a>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                           class="block px-4 py-3 text-sm font-semibold rounded-xl text-cozy-brown/70 hover:bg-cozy-warm/20">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1 pb-4">
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-sm font-semibold rounded-xl text-cozy-brown/70 hover:bg-cozy-warm/20">
                        {{ __('Log in') }}
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-3 text-sm font-bold rounded-xl text-white bg-cozy-brown text-center">
                        {{ __('Register') }}
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
=======
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('login') }}" class="px-3 py-2.5 rounded-[1rem] text-[14px] font-bold text-cozy-brown hover:bg-cozy-brown/10 transition-colors">Log in</a>
                        <a href="{{ route('register') }}" class="px-5 py-3 rounded-full bg-cozy-brown text-cozy-card text-[14px] font-bold text-center hover:bg-[#573D2B] transition-colors">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
