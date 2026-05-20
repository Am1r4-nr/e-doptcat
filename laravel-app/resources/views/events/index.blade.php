<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }
</style>

<div class="bg-cozy-bg min-h-screen relative overflow-hidden pb-24" x-data="{ activeTab: 'upcoming' }">

    <!-- Decorative blobs -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-cozy-warm/40 blob opacity-50 translate-x-1/4 -translate-y-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cozy-accent/15 blob opacity-40 -translate-x-1/4 translate-y-1/4 pointer-events-none" style="animation-delay:-5s;"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 pt-28">

        <!-- Hero Header -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-24">

            <!-- Left Content -->
            <div class="space-y-5 z-10 relative">
                <span class="inline-block px-5 py-2.5 rounded-full bg-cozy-warm/60 text-cozy-brown text-sm font-bold tracking-wider uppercase font-sans">
                    COMMUNITY & CONNECTION
                </span>
                <p class="font-script text-3xl text-cozy-accent">Join Us</p>
                <h1 class="font-serif font-bold text-5xl md:text-6xl text-cozy-brown leading-tight">
                    Events for a<br>
                    <span class="italic text-cozy-accent">Cause</span>
                </h1>
                <div class="w-24 h-1 bg-cozy-accent/60 rounded-full"></div>
                <p class="font-sans text-cozy-brown/70 text-lg md:text-xl leading-relaxed max-w-md">
                    Join our nurturing events. From sun-drenched adoption drives to boutique fundraisers, every moment spent here helps find a forever home.
                </p>
            </div>

            <!-- Right Images -->
            <div class="relative mt-16 lg:mt-0">
                <!-- Main Big Image -->
                <div class="w-full lg:w-[90%] ml-auto rounded-[3rem] shadow-2xl overflow-hidden border-4 border-cozy-warm/40">
                    <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                         alt="Cat at event"
                         class="w-full h-[400px] md:h-[520px] object-cover">
                </div>
                <!-- Small Overlapping Image -->
                <div class="absolute -bottom-12 left-0 md:left-4 lg:-left-12 w-48 h-48 md:w-64 md:h-64 rounded-[2rem] shadow-xl border-[6px] border-cozy-bg overflow-hidden z-10 transform -rotate-3 hover:rotate-0 transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1548247661-bc1959b85c18?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                         alt="Kitten at event"
                         class="w-full h-full object-cover scale-110">
                </div>
            </div>
        </div>

        <!-- Section Header & Tab Filter -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-6">
            <div>
                <p class="font-script text-2xl text-cozy-accent mb-1">What's On</p>
                <h2 class="font-serif font-bold text-3xl text-cozy-brown mb-2">Upcoming Gatherings</h2>
                <div class="w-20 h-1 bg-cozy-accent/60 rounded-full mb-3"></div>
                <p class="font-sans text-cozy-brown/60 text-sm md:text-base max-w-lg">
                    Mark your calendars for our upcoming sanctuary activities and special fundraising moments.
                </p>
            </div>

            <!-- Tab Controls -->
            <div class="flex gap-2 bg-cozy-card border border-cozy-warm/40 p-1.5 rounded-full shadow-md">
                <button @click="activeTab = 'upcoming'"
                    :class="activeTab === 'upcoming' ? 'bg-cozy-brown text-cozy-light shadow-sm' : 'bg-transparent text-cozy-brown/60 hover:text-cozy-brown'"
                    class="px-5 py-2 rounded-full font-bold transition-all text-sm font-sans tracking-wide">
                    Upcoming
                </button>
                <button @click="activeTab = 'completed'"
                    :class="activeTab === 'completed' ? 'bg-cozy-brown text-cozy-light shadow-sm' : 'bg-transparent text-cozy-brown/60 hover:text-cozy-brown'"
                    class="px-5 py-2 rounded-full font-bold transition-all text-sm font-sans tracking-wide whitespace-nowrap">
                    Completed
                </button>
            </div>
        </div>

        <!-- Upcoming Events Grid -->
        <div x-show="activeTab === 'upcoming'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($upcomingEvents as $event)
                <div class="bg-cozy-card rounded-3xl shadow-xl border border-cozy-warm/40 p-4 flex flex-col hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group">

                    <!-- Image & Badge -->
                    <div class="relative h-56 w-full rounded-2xl overflow-hidden mb-5 bg-cozy-warm/20">
                        @if($event->image)
                            <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                            <img src="https://images.unsplash.com/photo-1548247661-bc1959b85c18?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                 alt="Placeholder"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @endif
                        <span class="absolute top-4 left-4 bg-cozy-gold text-cozy-brown text-[10px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm font-sans">
                            EVENT
                        </span>
                    </div>

                    <!-- Date / Time -->
                    <div class="flex items-center text-cozy-accent font-bold text-sm mb-3 font-sans">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $event->event_date->format('M d, Y') }} &bull; {{ $event->event_date->format('h:i A') }}
                    </div>

                    <!-- Title -->
                    <h3 class="font-serif font-bold text-xl text-cozy-brown mb-2 leading-tight">
                        {{ $event->title }}
                    </h3>

                    <!-- Location -->
                    <div class="flex items-center text-cozy-brown/60 text-sm mb-4 font-sans">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $event->location }}
                    </div>

                    <!-- Description -->
                    <p class="font-sans text-cozy-brown/60 text-sm mb-6 flex-grow leading-relaxed">
                        {{ Str::limit($event->description, 120) }}
                    </p>

                    <!-- Register Button -->
                    <form method="POST" action="{{ route('events.register', $event) }}" class="mt-auto">
                        @csrf
                        <button type="submit"
                            class="w-full py-3 rounded-full bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold text-sm transition-colors duration-300 font-sans">
                            View Details
                        </button>
                    </form>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-cozy-card rounded-3xl shadow-xl border border-dashed border-cozy-accent/30">
                    <div class="mx-auto w-24 h-24 bg-cozy-warm/40 rounded-full flex items-center justify-center mb-6 text-cozy-brown/50">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-cozy-brown mb-2">No Upcoming Events</h3>
                    <p class="font-sans text-cozy-brown/50">Check back later for new updates!</p>
                </div>
            @endforelse
        </div>

        <!-- Completed Events List -->
        <div x-show="activeTab === 'completed'" class="space-y-8" style="display: none;">
            @forelse($completedEvents as $event)
                <div class="bg-cozy-card group overflow-hidden shadow-xl hover:shadow-2xl transition-shadow rounded-3xl border border-cozy-warm/40 p-6 flex flex-col md:flex-row items-center md:items-stretch gap-6">

                    <!-- Image / Date Badge -->
                    <div class="relative w-full h-48 md:w-48 md:h-48 flex-shrink-0 overflow-hidden rounded-2xl bg-cozy-warm/20 border border-cozy-warm/40 shadow-sm">
                        @if($event->image)
                            <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}"
                                 class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105">
                            <!-- Floating Date Badge -->
                            <div class="absolute inset-0 bg-gradient-to-t from-cozy-brown/60 via-transparent to-transparent flex flex-col items-start justify-end p-4">
                                <div class="bg-cozy-light/95 backdrop-blur-sm rounded-xl px-3 py-1.5 text-center shadow-md">
                                    <span class="block font-serif font-bold text-xl text-cozy-brown leading-none">
                                        {{ $event->event_date->format('d') }}
                                    </span>
                                    <span class="block text-[9px] font-bold text-cozy-accent uppercase tracking-wider mt-0.5">
                                        {{ $event->event_date->format('M') }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <!-- Fallback Date Badge -->
                            <div class="w-full h-full p-4 flex flex-col items-center justify-center text-center bg-cozy-warm/20 group-hover:bg-cozy-warm/40 transition-colors">
                                <span class="block font-serif font-bold text-4xl text-cozy-brown mb-0.5">
                                    {{ $event->event_date->format('d') }}
                                </span>
                                <span class="block font-sans font-bold text-sm text-cozy-accent uppercase tracking-widest">
                                    {{ $event->event_date->format('M') }}
                                </span>
                                <span class="block font-sans text-xs text-cozy-brown/40 mt-1">
                                    {{ $event->event_date->format('Y') }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="flex-1 flex flex-col justify-between py-1">
                        <div>
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-3">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="font-serif font-bold text-2xl text-cozy-brown transition-colors group-hover:text-cozy-accent">
                                            {{ $event->title }}
                                        </h3>
                                        <span class="px-2.5 py-0.5 bg-cozy-warm/60 text-cozy-brown/70 text-[10px] font-bold uppercase rounded-full tracking-wider font-sans">
                                            Ended
                                        </span>
                                    </div>
                                    <div class="flex items-center text-cozy-brown/60 text-sm font-medium font-sans">
                                        <svg class="w-4 h-4 mr-2 text-cozy-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $event->location }}
                                    </div>
                                </div>

                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-cozy-warm/50 text-cozy-brown border border-cozy-warm self-start font-sans">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $event->event_date->format('h:i A') }}
                                </span>
                            </div>

                            <p class="font-sans text-cozy-brown/60 mb-6 leading-relaxed border-l-4 border-cozy-warm pl-4 text-sm md:text-base">
                                {{ $event->description }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-cozy-warm/40 flex items-center justify-between">
                            <span class="font-sans text-xs text-cozy-brown/40 font-medium italic">
                                Hope you had a great time!
                            </span>
                            <button disabled
                                class="inline-flex items-center px-6 py-2.5 bg-cozy-warm/40 border border-transparent rounded-xl font-bold text-xs text-cozy-brown/40 uppercase tracking-widest cursor-not-allowed font-sans">
                                Completed
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-cozy-card rounded-3xl shadow-xl border border-dashed border-cozy-accent/30">
                    <div class="mx-auto w-24 h-24 bg-cozy-warm/40 rounded-full flex items-center justify-center mb-6 text-cozy-brown/40">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-cozy-brown mb-2">No Completed Events</h3>
                    <p class="font-sans text-cozy-brown/50">All completed events will be recorded here.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
</x-app-layout>
