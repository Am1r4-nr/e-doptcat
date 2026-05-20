<nav x-data="{ open: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 60 })"
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
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if(Auth::user()->role === 'admin')
                                <x-dropdown-link :href="route('admin.dashboard')">
                                    {{ __('Admin Panel') }}
                                </x-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
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