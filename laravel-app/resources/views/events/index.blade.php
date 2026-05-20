<x-app-layout>
    <div class="py-12 bg-boho-bg min-h-screen" x-data="{ activeTab: 'upcoming' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-24 pt-8">
                <!-- Left Content -->
                <div class="space-y-4 md:space-y-6 z-10 relative">
                    <span class="inline-block px-5 py-2.5 rounded-full bg-[#fde9d4] text-[#865917] text-xs md:text-sm font-bold tracking-wider uppercase">
                        COMMUNITY & CONNECTION
                    </span>
                    <h1 class="text-6xl md:text-[5rem] lg:text-[6rem] font-sans font-extrabold text-gray-900 leading-[1.05] tracking-tight">
                        Events for a<br>
                        <span class="font-serif italic text-[#8B5A2B] font-medium text-[1.1em]">Cause</span>
                    </h1>
                    <p class="text-gray-600 text-lg md:text-xl leading-relaxed max-w-md pt-2">
                        Join our nurturing atelier events. From sun-drenched adoption drives to boutique fundraisers, every moment spent here helps find a forever home.
                    </p>
                </div>

                <!-- Right Images -->
                <div class="relative mt-16 lg:mt-0 font-sans px-4 md:px-0">
                    <!-- Main Big Image -->
                    <div class="w-full lg:w-[90%] md:max-w-lg ml-auto rounded-[3rem] shadow-2xl relative z-0">
                        <!-- Example placeholder image matching the cat on chair -->
                        <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Cat on a brown chair" class="w-full h-[400px] md:h-[550px] object-cover rounded-[3rem]">
                    </div>
                    <!-- Small Overlapping Image -->
                    <div class="absolute -bottom-12 left-0 md:left-4 lg:-left-12 w-48 h-48 md:w-64 md:h-64 rounded-[2rem] shadow-xl border-[6px] md:border-8 border-boho-bg overflow-hidden z-10 transform -rotate-3 hover:rotate-0 transition-transform duration-500 bg-white">
                        <!-- Example placeholder image matching women playing with kitten -->
                        <img src="https://images.unsplash.com/photo-1548247661-bc1959b85c18?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Connecting with cute kitten" class="w-full h-full object-cover scale-110">
                    </div>
                </div>
            </div>

            <!-- Header & Filters for Events -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-6">
                <div>
                    <h2 class="text-3xl font-sans font-bold text-gray-900 mb-2">Upcoming Gatherings</h2>
                    <p class="text-gray-500 text-sm md:text-base max-w-lg">
                        Mark your calendars for our upcoming sanctuary activities and special fundraising moments.
                    </p>
                </div>
                <!-- Controls mapped to existing upcoming/completed data for functionality -->
                <div class="flex gap-3 bg-[#F0EBE1] p-1.5 rounded-full">
                    <button @click="activeTab = 'upcoming'" 
                        :class="activeTab === 'upcoming' ? 'bg-[#E3DCD1] text-gray-900 shadow-sm' : 'bg-transparent text-gray-600 hover:text-gray-900'" 
                        class="px-5 py-2 rounded-full font-bold transition-all text-xs md:text-sm tracking-wide">
                        Filter All
                    </button>
                    <button @click="activeTab = 'completed'" 
                        :class="activeTab === 'completed' ? 'bg-[#E3DCD1] text-gray-900 shadow-sm' : 'bg-transparent text-gray-600 hover:text-gray-900'" 
                        class="px-5 py-2 rounded-full font-bold transition-all text-xs md:text-sm tracking-wide whitespace-nowrap">
                        Completed
                    </button>
                </div>
            </div>

            <!-- Upcoming Events Section -->
            <div x-show="activeTab === 'upcoming'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($upcomingEvents as $event)
                    <div class="bg-white rounded-[2rem] p-4 flex flex-col shadow-sm border border-[#EBE5D9] hover:shadow-md transition-shadow group">
                        <!-- Image & Badge -->
                        <div class="relative h-56 w-full rounded-[1.5rem] overflow-hidden mb-5 bg-boho-light/30">
                            @if($event->image)
                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <img src="https://images.unsplash.com/photo-1548247661-bc1959b85c18?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Placeholder" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @endif
                            <span class="absolute top-4 left-4 bg-gradient-to-r from-[#FFB84D] to-[#ffa424] text-[#865917] text-[10px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                EVENT
                            </span>
                        </div>
                        
                        <!-- Meta info -->
                        <div class="flex items-center text-[#995913] font-bold text-sm mb-3">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            {{ $event->event_date->format('M d, Y') }} &bull; {{ $event->event_date->format('h:i A') }}
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-900 mb-2 leading-tight">
                            {{ $event->title }}
                        </h3>

                        <!-- Location -->
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            {{ $event->location }}
                        </div>

                        <!-- Description -->
                        <p class="text-gray-500 text-sm mb-6 flex-grow leading-relaxed">
                            {{ Str::limit($event->description, 120) }}
                        </p>

                        <!-- Button -->
                        <form method="POST" action="{{ route('events.register', $event) }}" class="mt-auto">
                            @csrf
                            <button type="submit" class="w-full py-3 rounded-full bg-[#EBE5D9] text-[#865917] font-bold text-sm hover:bg-[#865917] hover:text-white transition-colors">
                                View Details
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-3xl shadow-sm border border-dashed border-boho-brown/30">
                        <div class="mx-auto w-24 h-24 bg-boho-light rounded-full flex items-center justify-center mb-6 text-boho-brown">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-serif font-bold text-gray-800">No Upcoming Events</h3>
                        <p class="text-gray-500 mt-2">Check back later for new updates!</p>
                    </div>
                @endforelse
            </div>

            <!-- Completed Events Section -->
            <div x-show="activeTab === 'completed'" class="space-y-8" style="display: none;">
                @forelse($completedEvents as $event)
                    <div
                        class="bg-white group overflow-hidden shadow-sm hover:shadow-md transition-shadow rounded-3xl border border-boho-light/70 p-6 flex flex-col md:flex-row items-center md:items-stretch gap-6">
                        <!-- Image / Date Badge Section (Fixed 48x48 on desktop) -->
                        <div class="relative w-full h-48 md:w-48 md:h-48 flex-shrink-0 overflow-hidden rounded-2xl bg-boho-light/30 border border-boho-light/50 shadow-sm">
                            @if($event->image)
                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}"
                                    class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105">
                                <!-- Floating Date Badge over Image -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex flex-col items-start justify-end p-4">
                                    <div class="bg-white/95 backdrop-blur-sm rounded-xl px-3 py-1.5 text-center shadow-md">
                                        <span class="block text-xl font-serif font-bold text-boho-brown leading-none">
                                            {{ $event->event_date->format('d') }}
                                        </span>
                                        <span class="block text-[9px] font-bold text-boho-orange uppercase tracking-wider mt-0.5">
                                            {{ $event->event_date->format('M') }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <!-- Fallback Pure Date Badge (Exact same size) -->
                                <div class="w-full h-full p-4 flex flex-col items-center justify-center text-center bg-boho-light/10 group-hover:bg-boho-cream transition-colors">
                                    <span class="block text-4xl font-serif font-bold text-boho-brown mb-0.5">
                                        {{ $event->event_date->format('d') }}
                                    </span>
                                    <span class="block text-sm font-bold text-boho-orange uppercase tracking-widest">
                                        {{ $event->event_date->format('M') }}
                                    </span>
                                    <span class="block text-xs text-gray-400 mt-1">
                                        {{ $event->event_date->format('Y') }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Content Section -->
                        <div class="flex-1 flex flex-col justify-between py-1">
                            <div>
                                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-3">
                                    <div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <h3 class="text-2xl font-serif font-bold text-gray-800 transition-colors group-hover:text-boho-brown">
                                                {{ $event->title }}
                                            </h3>
                                            <span class="px-2.5 py-0.5 bg-gray-200 text-gray-600 text-[10px] font-bold uppercase rounded-full tracking-wider">
                                                Ended
                                            </span>
                                        </div>
                                        <div class="flex items-center text-gray-500 text-sm font-medium">
                                            <svg class="w-4 h-4 mr-2 text-boho-orange" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $event->location }}
                                        </div>
                                    </div>

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-boho-light text-boho-brown border border-boho-brown/10 self-start">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $event->event_date->format('h:i A') }}
                                    </span>
                                </div>

                                <p class="text-gray-600 mb-6 leading-relaxed border-l-4 border-boho-light pl-4 text-sm md:text-base">
                                    {{ $event->description }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-xs text-gray-500 font-medium italic">
                                    Hope you had a great time!
                                </span>
                                <button disabled
                                    class="inline-flex items-center px-6 py-2.5 bg-gray-200 border border-transparent rounded-xl font-bold text-xs text-gray-400 uppercase tracking-widest cursor-not-allowed">
                                    Completed
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white/50 rounded-3xl shadow-sm border border-dashed border-gray-300">
                        <div
                            class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6 text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-serif font-bold text-gray-500">No Completed Events</h3>
                        <p class="text-gray-400 mt-2">All completed events will be recorded here.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>