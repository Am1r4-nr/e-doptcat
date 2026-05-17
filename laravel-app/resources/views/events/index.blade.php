<x-app-layout>
    <div class="py-12 bg-boho-bg min-h-screen" x-data="{ activeTab: 'upcoming' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="font-serif font-bold text-4xl text-boho-brown mb-4">
                    {{ __('Events & Gatherings') }}
                </h2>
                <div class="w-24 h-1 bg-boho-orange mx-auto rounded-full"></div>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                    Join us in our mission to help cats find loving homes. Participate in adoption drives, workshops,
                    and community meetups.
                </p>
            </div>

            <!-- Tab Switcher Buttons -->
            <div class="flex justify-center gap-4 mb-12">
                <button @click="activeTab = 'upcoming'" 
                    :class="activeTab === 'upcoming' ? 'bg-boho-orange text-white shadow-lg scale-105' : 'bg-white text-boho-brown border border-boho-light hover:bg-boho-light/30'" 
                    class="px-8 py-3.5 rounded-2xl font-bold transition-all transform duration-200 text-sm flex items-center gap-2">
                    <span>📅</span> Upcoming Events
                    <span class="ml-1 px-2.5 py-0.5 text-xs bg-white/20 text-white rounded-full" :class="activeTab === 'upcoming' ? '' : 'bg-boho-light text-boho-brown'">
                        {{ count($upcomingEvents) }}
                    </span>
                </button>
                <button @click="activeTab = 'completed'" 
                    :class="activeTab === 'completed' ? 'bg-boho-orange text-white shadow-lg scale-105' : 'bg-white text-boho-brown border border-boho-light hover:bg-boho-light/30'" 
                    class="px-8 py-3.5 rounded-2xl font-bold transition-all transform duration-200 text-sm flex items-center gap-2">
                    <span>🏆</span> Completed Events
                    <span class="ml-1 px-2.5 py-0.5 text-xs bg-white/20 text-white rounded-full" :class="activeTab === 'completed' ? '' : 'bg-boho-light text-boho-brown'">
                        {{ count($completedEvents) }}
                    </span>
                </button>
            </div>

            <!-- Upcoming Events Section -->
            <div x-show="activeTab === 'upcoming'" class="space-y-8">
                @forelse($upcomingEvents as $event)
                    <div
                        class="bg-white group overflow-hidden shadow-sm hover:shadow-md transition-shadow rounded-3xl border border-boho-light p-6 flex flex-col md:flex-row items-center md:items-stretch gap-6">
                        <!-- Image / Date Badge Section (Fixed 48x48 on desktop) -->
                        <div class="relative w-full h-48 md:w-48 md:h-48 flex-shrink-0 overflow-hidden rounded-2xl bg-boho-light/30 border border-boho-light shadow-sm">
                            @if($event->image)
                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
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
                                        <h3
                                            class="text-2xl font-serif font-bold text-gray-800 mb-1 group-hover:text-boho-brown transition-colors">
                                            {{ $event->title }}
                                        </h3>
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
                                <span class="text-xs text-gray-400 font-medium">
                                    * Limited spots available
                                </span>
                                <form method="POST" action="{{ route('events.register', $event) }}">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-6 py-2.5 bg-boho-brown border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-boho-orange active:bg-boho-brown focus:outline-none focus:border-boho-brown focus:ring ring-boho-brown disabled:opacity-25 transition ease-in-out duration-150 shadow-sm hover:shadow">
                                        Register Now
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-dashed border-boho-brown/30">
                        <div
                            class="mx-auto w-24 h-24 bg-boho-light rounded-full flex items-center justify-center mb-6 text-boho-brown">
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
                        class="bg-white/80 group overflow-hidden shadow-sm hover:shadow-md transition-shadow rounded-3xl border border-boho-light/70 p-6 flex flex-col md:flex-row items-center md:items-stretch gap-6 opacity-90">
                        <!-- Image / Date Badge Section (Fixed 48x48 on desktop, Greyed/Muted) -->
                        <div class="relative w-full h-48 md:w-48 md:h-48 flex-shrink-0 overflow-hidden rounded-2xl bg-gray-100 border border-boho-light/50 shadow-sm">
                            @if($event->image)
                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}"
                                    class="w-full h-full object-cover filter grayscale opacity-60 transition-all duration-500 group-hover:grayscale-0 group-hover:opacity-80">
                                <!-- Floating Date Badge over Image -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent flex flex-col items-start justify-end p-4">
                                    <div class="bg-gray-100/90 backdrop-blur-sm rounded-xl px-3 py-1.5 text-center shadow-md">
                                        <span class="block text-xl font-serif font-bold text-gray-500 leading-none">
                                            {{ $event->event_date->format('d') }}
                                        </span>
                                        <span class="block text-[9px] font-bold text-gray-400 uppercase tracking-wider mt-0.5">
                                            {{ $event->event_date->format('M') }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <!-- Fallback Pure Date Badge (Exact same size) -->
                                <div class="w-full h-full p-4 flex flex-col items-center justify-center text-center bg-gray-50 group-hover:bg-gray-100/50 transition-colors">
                                    <span class="block text-4xl font-serif font-bold text-gray-500 mb-0.5">
                                        {{ $event->event_date->format('d') }}
                                    </span>
                                    <span class="block text-sm font-bold text-gray-400 uppercase tracking-widest">
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
                                            <h3 class="text-2xl font-serif font-bold text-gray-600 line-through decoration-gray-400/50">
                                                {{ $event->title }}
                                            </h3>
                                            <span class="px-2.5 py-0.5 bg-gray-200 text-gray-600 text-[10px] font-bold uppercase rounded-full tracking-wider">
                                                Ended
                                            </span>
                                        </div>
                                        <div class="flex items-center text-gray-400 text-sm font-medium">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
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
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500 border border-gray-200 self-start">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $event->event_date->format('h:i A') }}
                                    </span>
                                </div>

                                <p class="text-gray-500 mb-6 leading-relaxed border-l-4 border-gray-300 pl-4 text-sm md:text-base">
                                    {{ $event->description }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-xs text-gray-400 font-medium italic">
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