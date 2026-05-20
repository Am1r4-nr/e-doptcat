@php
$navLinks = [
    ['label' => 'Home',     'route' => 'home',            'match' => 'home'],
    ['label' => 'About',    'route' => 'about',           'match' => 'about'],
    ['label' => 'Our Cats', 'route' => 'cats.index',      'match' => 'cats.*'],
    ['label' => 'Tracker',  'route' => 'tracker',         'match' => 'tracker'],
    ['label' => 'Events',   'route' => 'events.index',    'match' => 'events.*'],
    ['label' => 'Donate',   'route' => 'donations.index', 'match' => 'donations.*'],
];
@endphp

<nav x-data="{ open: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 60 })"
     :class="scrolled ? 'bg-cozy-bg/95 backdrop-blur-xl shadow-md py-2' : 'bg-cozy-card py-4'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 border-b border-cozy-warm/20">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">

            {{-- Logo --}}
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

            {{-- Desktop nav links --}}
            <div class="hidden space-x-1 sm:-my-px sm:ms-6 sm:flex">
                @foreach ($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-xl transition-all duration-200
                              {{ request()->routeIs($link['match']) ? 'text-cozy-brown bg-cozy-warm/40' : 'text-cozy-brown/70 hover:text-cozy-brown hover:bg-cozy-warm/20' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Desktop auth area --}}
            <div class="hidden sm:flex sm:items-center sm:gap-3">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-semibold rounded-xl hover:bg-cozy-warm/20 focus:outline-none transition ease-in-out duration-200 gap-3 group">
                                @if (Auth::user()->avatar)
                                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                        class="w-8 h-8 rounded-full object-cover ring-2 ring-cozy-accent/40 shadow-sm group-hover:ring-cozy-accent transition-all">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cozy-accent to-cozy-brown flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <span class="text-cozy-brown/80 group-hover:text-cozy-brown transition-colors">{{ Auth::user()->name }}</span>
                                <svg class="fill-current h-4 w-4 text-cozy-brown/50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-cozy-brown hover:bg-cozy-bg transition-colors">Profile</a>
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-cozy-brown hover:bg-cozy-bg transition-colors">Admin Panel</a>
                            @endif
                            <div class="my-1 border-t border-cozy-brown/10"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm font-semibold text-red-500 hover:bg-red-50 transition-colors">Log Out</button>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                       class="text-sm font-semibold text-cozy-brown/70 hover:text-cozy-brown transition-colors">
                        Log in
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-5 py-2.5 rounded-full bg-cozy-brown text-cozy-card text-sm font-bold hover:bg-[#573D2B] transition-colors shadow-sm hover:shadow-md hover:-translate-y-px transform duration-200">
                        Register
                    </a>
                @endauth
            </div>

            {{-- Mobile hamburger --}}
            <button @click="open = !open"
                class="sm:hidden p-2 rounded-xl hover:bg-cozy-warm/20 transition-colors"
                aria-label="Toggle menu">
                <svg class="h-6 w-6 text-cozy-brown" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-cozy-card/95 backdrop-blur-xl border-t border-cozy-warm/20">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @foreach ($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="block px-4 py-3 text-sm font-semibold rounded-xl
                          {{ request()->routeIs($link['match']) ? 'text-cozy-brown bg-cozy-warm/30' : 'text-cozy-brown/70 hover:bg-cozy-warm/20' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        <div class="pt-4 pb-1 border-t border-cozy-warm/20 px-4">
            @auth
                <div class="px-4 flex items-center gap-3 mb-4">
                    @if (Auth::user()->avatar)
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                            class="w-10 h-10 rounded-full object-cover ring-2 ring-cozy-accent/30 shadow-sm">
                    @else
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cozy-accent to-cozy-brown flex items-center justify-center text-white text-sm font-bold">
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
