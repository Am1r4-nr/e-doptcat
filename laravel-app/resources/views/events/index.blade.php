<x-app-layout>
    <div class="py-12 bg-boho-bg min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="font-serif font-bold text-4xl text-boho-brown mb-4">
                    {{ __('Upcoming Events') }}
                </h2>
                <div class="w-24 h-1 bg-boho-orange mx-auto rounded-full"></div>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                    Join us in our mission to help cats find loving homes. Participate in adoption drives, workshops,
                    and community meetups.
                </p>
            </div>

            <div class="space-y-8">
                @forelse($events as $event)
                    <div
                        class="bg-white group overflow-hidden shadow-sm hover:shadow-md transition-shadow rounded-3xl border border-boho-light flex flex-col md:flex-row">
                        <!-- Date Badge Section -->
                        <div
                            class="md:w-48 bg-boho-light/30 border-r border-boho-light p-6 flex flex-col items-center justify-center text-center group-hover:bg-boho-cream transition-colors">
                            <span class="block text-5xl font-serif font-bold text-boho-brown mb-1">
                                {{ $event->event_date->format('d') }}
                            </span>
                            <span class="block text-lg font-bold text-boho-orange uppercase tracking-widest">
                                {{ $event->event_date->format('M') }}
                            </span>
                            <span class="block text-sm text-gray-400 mt-1">
                                {{ $event->event_date->format('Y') }}
                            </span>
                        </div>

                        <!-- Content Section -->
                        <div class="p-8 flex-1 flex flex-col justify-center">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-4">
                                <div>
                                    <h3
                                        class="text-2xl font-serif font-bold text-gray-800 mb-2 group-hover:text-boho-brown transition-colors">
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
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-boho-light text-boho-brown border border-boho-brown/10">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $event->event_date->format('h:i A') }}
                                </span>
                            </div>

                            <p class="text-gray-600 mb-6 leading-relaxed border-l-4 border-boho-light pl-4">
                                {{ $event->description }}
                            </p>

                            <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between">
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
        </div>
    </div>
</x-app-layout>