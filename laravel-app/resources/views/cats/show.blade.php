<x-app-layout>
    <div class="py-12 bg-boho-bg min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-8 text-gray-500 text-sm" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center hover:text-boho-brown transition-colors">
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('cats.index') }}"
                                class="ml-1 hover:text-boho-brown transition-colors">Cats</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 text-boho-brown font-semibold">{{ $cat->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div
                class="bg-white overflow-hidden shadow-xl rounded-3xl flex flex-col lg:flex-row border border-boho-light">
                <!-- Image Section -->
                <div class="lg:w-1/2 relative h-96 lg:h-auto min-h-[400px]">
                    <img src="{{ $cat->image }}" alt="{{ $cat->name }}"
                        class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent lg:bg-gradient-to-r">
                    </div>

                    <div class="absolute bottom-6 left-6 text-white lg:hidden">
                        <h1 class="text-4xl font-serif font-bold text-shadow">{{ $cat->name }}</h1>
                        <span class="inline-block bg-boho-orange px-3 py-1 rounded-full text-sm font-bold mt-2">
                            {{ $cat->status }}
                        </span>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="p-8 lg:p-12 lg:w-1/2 flex flex-col">
                    <div class="hidden lg:flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-5xl font-serif font-bold text-boho-brown mb-2">{{ $cat->name }}</h1>
                            <span
                                class="inline-block bg-boho-bg text-boho-brown border border-boho-brown px-4 py-1 rounded-full text-sm font-bold uppercase tracking-wide">
                                {{ $cat->status }}
                            </span>
                        </div>
                        <div class="text-center bg-boho-bg p-4 rounded-xl border border-boho-light">
                            <div class="text-3xl font-bold text-boho-orange">{{ $cat->age }}</div>
                            <div class="text-xs uppercase text-gray-500 tracking-wider">Age</div>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-2 gap-6 mb-8 bg-boho-light/30 p-6 rounded-2xl border border-boho-light">
                        <div>
                            <span
                                class="block text-xs uppercase text-gray-400 font-bold tracking-wider mb-1">Breed</span>
                            <span class="text-lg font-serif text-gray-800">{{ $cat->breed }}</span>
                        </div>
                        <div>
                            <span
                                class="block text-xs uppercase text-gray-400 font-bold tracking-wider mb-1">Gender</span>
                            <span class="text-lg font-serif text-gray-800">{{ $cat->gender }}</span>
                        </div>
                        <div>
                            <span
                                class="block text-xs uppercase text-gray-400 font-bold tracking-wider mb-1">Color</span>
                            <span class="text-lg font-serif text-gray-800">{{ $cat->color }}</span>
                        </div>
                        <div class="lg:hidden">
                            <span class="block text-xs uppercase text-gray-400 font-bold tracking-wider mb-1">Age</span>
                            <span class="text-lg font-serif text-gray-800">{{ $cat->age }}</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <h3 class="font-serif text-xl font-bold text-boho-brown mb-3">About Me</h3>
                        <p class="text-gray-600 leading-relaxed text-lg font-light">
                            {{ $cat->description }}
                        </p>
                    </div>

                    <!-- AI Personality Profile -->
                    @if($cat->ai_profile || $cat->temperament_score)
                    <div class="mb-8 bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-2xl border-2 border-purple-200">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 11-2 0 1 1 0 012 0zm0 3a1 1 0 11-2 0 1 1 0 012 0zm4-1a1 1 0 11-2 0 1 1 0 012 0z"></path>
                            </svg>
                            <h3 class="font-serif text-xl font-bold text-purple-900">AI Personality Profile</h3>
                        </div>

                        @if($cat->temperament_score)
                        <div class="mb-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-semibold text-gray-700">Temperament Score</span>
                                <span class="text-2xl font-bold text-purple-600">{{ $cat->temperament_score }}/10</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full" style="width: {{ ($cat->temperament_score / 10) * 100 }}%"></div>
                            </div>
                        </div>
                        @endif

                        @if($cat->ai_profile)
                        <div class="mb-4">
                            <span class="text-sm font-semibold text-gray-700 block mb-2">Personality Summary</span>
                            <p class="text-gray-700 leading-relaxed text-base">{{ $cat->ai_profile }}</p>
                        </div>
                        @endif

                        @if($cat->ideal_adopters)
                        <div class="mb-4">
                            <span class="text-sm font-semibold text-gray-700 block mb-2">Perfect For</span>
                            <p class="text-gray-700 leading-relaxed text-base">{{ $cat->ideal_adopters }}</p>
                        </div>
                        @endif

                        @if($cat->care_notes)
                        <div>
                            <span class="text-sm font-semibold text-gray-700 block mb-2">Care Recommendations</span>
                            <p class="text-gray-700 leading-relaxed text-base">{{ $cat->care_notes }}</p>
                        </div>
                        @endif
                    </div>
                    @endif

                    <div class="border-t border-boho-light my-6"></div>

                    <!-- Location Wrapper -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-serif font-bold text-lg text-boho-brown flex items-center gap-2">
                                <svg class="w-5 h-5 text-boho-orange" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Current Location
                            </h4>
                            <span class="text-xs text-gray-400">Exact coordinates hidden for safety</span>
                        </div>
                        <div class="relative rounded-2xl overflow-hidden shadow-inner border border-gray-200">
                            <div id="cat-map" class="h-48 w-full z-0"></div>
                            <input type="hidden" id="cat-lat" value="{{ $cat->gps_lat ?? 3.140853 }}">
                            <input type="hidden" id="cat-lng" value="{{ $cat->gps_lng ?? 101.693207 }}">
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-auto flex flex-col sm:flex-row gap-4">
                        <button
                            class="flex-1 bg-boho-brown text-white px-8 py-4 rounded-xl hover:bg-boho-orange hover:shadow-lg transition-all transform hover:-translate-y-1 font-bold text-lg tracking-wide shadow-md">
                            Apply to Adopt
                        </button>

                        <!-- QR Code Toggle -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="h-full px-6 py-3 border-2 border-boho-light text-boho-brown rounded-xl hover:bg-boho-light transition-colors font-bold flex items-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v1m6 11h2m-6 0h-2v4h-4v-4H8m13-4V7a1 1 0 00-1-1H4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span>Share</span>
                            </button>

                            <!-- Dropdown -->
                            <div x-show="open" @click.away="open = false"
                                class="absolute bottom-full right-0 mb-2 p-4 bg-white rounded-xl shadow-xl border border-boho-light z-50 w-48 text-center"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-2" style="display: none;">
                                <div class="mb-2 text-sm text-gray-500 font-bold">Scan to Share</div>
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ route('cats.show', $cat) }}"
                                    alt="QR Code" class="mx-auto rounded border p-1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var lat = parseFloat(document.getElementById('cat-lat').value);
            var lng = parseFloat(document.getElementById('cat-lng').value);

            var map = L.map('cat-map', {
                zoomControl: false,
                dragging: false,
                scrollWheelZoom: false
            }).setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            var icon = L.divIcon({
                className: 'custom-div-icon',
                html: "<div style='background-color:#FF750F; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);'></div>",
                iconSize: [12, 12],
                iconAnchor: [6, 6]
            });

            L.marker([lat, lng], { icon: icon }).addTo(map)
                .bindPopup('<span class="font-bold text-boho-brown">{{ $cat->name }}</span> is around here.')
                .openPopup();
        });
    </script>
</x-app-layout>