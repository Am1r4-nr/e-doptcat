<x-app-layout>
<<<<<<< HEAD
    <div class="pt-24 pb-12 bg-cozy-bg min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
=======
    <div class="pt-24 pb-12 bg-cozy-bg min-h-screen relative overflow-hidden">
        
        <!-- Decorative background blobs -->
        <div class="absolute top-[-10%] right-[-5%] w-[40%] h-[50%] bg-[#F5DEB3] opacity-60 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] blur-3xl pointer-events-none -z-10"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
            <!-- Breadcrumb -->
            <nav class="flex mb-8 text-cozy-brown/60 text-sm font-bold ml-4 sm:ml-0" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
<<<<<<< HEAD
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center hover:text-cozy-brown transition-colors">
                            Home
                        </a>
=======
                        <a href="{{ route('home') }}" class="inline-flex items-center hover:text-cozy-brown transition-colors">Home</a>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
<<<<<<< HEAD
                            <a href="{{ route('cats.index') }}"
                                class="ml-1 hover:text-cozy-brown transition-colors">Cats</a>
=======
                            <a href="{{ route('cats.index') }}" class="ml-1 hover:text-cozy-brown transition-colors">Cats</a>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
<<<<<<< HEAD
                            <span class="ml-1 text-cozy-brown font-semibold">{{ $cat->name }}</span>
=======
                            <span class="ml-1 text-cozy-brown">{{ $cat->name }}</span>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                        </div>
                    </li>
                </ol>
            </nav>

<<<<<<< HEAD
            <div
                class="bg-cozy-card overflow-hidden shadow-xl rounded-3xl flex flex-col lg:flex-row border border-cozy-warm/40">
=======
            <div class="bg-cozy-card overflow-hidden shadow-2xl rounded-[3rem] flex flex-col lg:flex-row border border-cozy-brown/10 relative p-4 sm:p-8 lg:p-12 gap-8">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                <!-- Image Section -->
                <div class="lg:w-1/2 relative min-h-[400px] lg:min-h-[600px] rounded-[60%_40%_30%_70%/60%_30%_70%_40%] overflow-hidden bg-[#E6C697] border-8 border-[#F5DEB3] shadow-inner blob-slow">
                    <img src="{{ $cat->image }}" alt="{{ $cat->name }}" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-cozy-brown/40 to-transparent"></div>

<<<<<<< HEAD
                    <div class="absolute bottom-6 left-6 text-white lg:hidden">
                        <h1 class="text-4xl font-serif font-bold text-shadow">{{ $cat->name }}</h1>
                        <span class="inline-block bg-cozy-accent px-3 py-1 rounded-full text-sm font-bold mt-2">
=======
                    <div class="absolute bottom-8 left-8 text-white lg:hidden">
                        <h1 class="text-5xl font-script font-bold text-shadow">{{ $cat->name }}</h1>
                        <span class="inline-block bg-[#F5DEB3] text-cozy-brown px-4 py-1.5 rounded-full text-sm font-bold mt-2 shadow-md">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                            {{ $cat->status }}
                        </span>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="lg:w-1/2 flex flex-col pt-4 lg:pt-0">
                    <div class="hidden lg:flex justify-between items-start mb-8">
                        <div>
<<<<<<< HEAD
                            <h1 class="text-5xl font-serif font-bold text-cozy-brown mb-2">{{ $cat->name }}</h1>
                            <span
                                class="inline-block bg-cozy-bg text-cozy-brown border border-cozy-brown px-4 py-1 rounded-full text-sm font-bold uppercase tracking-wide">
                                {{ $cat->status }}
                            </span>
                        </div>
                        <div class="text-center bg-cozy-bg p-4 rounded-xl border border-cozy-warm/40">
                            <div class="text-3xl font-bold text-cozy-accent">{{ $cat->age }}</div>
                            <div class="text-xs uppercase text-gray-500 tracking-wider">Age</div>
=======
                            <h1 class="text-6xl font-script font-bold text-cozy-brown mb-2">{{ $cat->name }}</h1>
                            <span class="inline-block bg-cozy-bg text-cozy-brown border border-cozy-brown/10 px-5 py-2 rounded-full text-sm font-bold uppercase tracking-wide shadow-sm">
                                {{ $cat->status }}
                            </span>
                        </div>
                        <div class="text-center bg-[#F5DEB3] p-5 rounded-[1.5rem] border border-cozy-brown/10 shadow-sm transform rotate-3">
                            <div class="text-3xl font-bold text-cozy-brown">{{ $cat->age }}</div>
                            <div class="text-xs uppercase text-cozy-brown/70 tracking-wider font-bold mt-1">Age</div>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                        </div>
                    </div>

                    <!-- Details Grid -->
<<<<<<< HEAD
                    <div class="grid grid-cols-2 gap-6 mb-8 bg-cozy-warm/20 p-6 rounded-2xl border border-cozy-warm/40">
                        <div>
                            <span
                                class="block text-xs uppercase text-cozy-brown/40 font-bold tracking-wider mb-1">Breed</span>
                            <span class="text-lg font-serif text-cozy-brown">{{ $cat->breed }}</span>
                        </div>
                        <div>
                            <span
                                class="block text-xs uppercase text-cozy-brown/40 font-bold tracking-wider mb-1">Gender</span>
                            <span class="text-lg font-serif text-cozy-brown">{{ $cat->gender }}</span>
                        </div>
                        <div>
                            <span
                                class="block text-xs uppercase text-cozy-brown/40 font-bold tracking-wider mb-1">Color</span>
                            <span class="text-lg font-serif text-cozy-brown">{{ $cat->color }}</span>
                        </div>
                        <div class="lg:hidden">
                            <span class="block text-xs uppercase text-cozy-brown/40 font-bold tracking-wider mb-1">Age</span>
                            <span class="text-lg font-serif text-cozy-brown">{{ $cat->age }}</span>
=======
                    <div class="grid grid-cols-2 gap-6 mb-10 bg-cozy-bg/50 p-8 rounded-[2rem] border border-cozy-brown/10">
                        <div>
                            <span class="block text-xs uppercase text-cozy-brown/60 font-bold tracking-wider mb-1">Breed</span>
                            <span class="text-xl font-bold text-cozy-brown">{{ $cat->breed }}</span>
                        </div>
                        <div>
                            <span class="block text-xs uppercase text-cozy-brown/60 font-bold tracking-wider mb-1">Gender</span>
                            <span class="text-xl font-bold text-cozy-brown">{{ $cat->gender }}</span>
                        </div>
                        <div>
                            <span class="block text-xs uppercase text-cozy-brown/60 font-bold tracking-wider mb-1">Color</span>
                            <span class="text-xl font-bold text-cozy-brown">{{ $cat->color }}</span>
                        </div>
                        <div class="lg:hidden">
                            <span class="block text-xs uppercase text-cozy-brown/60 font-bold tracking-wider mb-1">Age</span>
                            <span class="text-xl font-bold text-cozy-brown">{{ $cat->age }}</span>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                        </div>
                    </div>

                    <!-- Description -->
<<<<<<< HEAD
                    <div class="mb-8">
                        <h3 class="font-serif text-xl font-bold text-cozy-brown mb-3">About Me</h3>
                        <p class="text-cozy-brown/60 leading-relaxed text-lg font-light">
=======
                    <div class="mb-10">
                        <h3 class="font-script text-4xl font-bold text-cozy-brown mb-4">About Me</h3>
                        <p class="text-cozy-brown/80 leading-relaxed text-lg font-medium">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                            {{ $cat->description }}
                        </p>
                    </div>

                    <!-- AI Personality Profile -->
                    @if($cat->ai_profile || $cat->temperament_score)
                    <div class="mb-10 bg-[#FFF4E3] p-8 rounded-[2.5rem] border border-cozy-brown/10 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-[#F5DEB3] rounded-full blur-2xl opacity-50 -mr-10 -mt-10"></div>
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="text-3xl">✨</span>
                                <h3 class="font-script text-3xl font-bold text-cozy-brown">AI Personality Profile</h3>
                            </div>
<<<<<<< HEAD
                            <div class="w-full bg-cozy-warm/40 rounded-full h-3">
                                <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full" style="width: {{ ($cat->temperament_score / 10) * 100 }}%"></div>
=======

                            @if($cat->temperament_score)
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-bold text-cozy-brown/80">Temperament Score</span>
                                    <span class="text-2xl font-bold text-cozy-brown">{{ $cat->temperament_score }}/10</span>
                                </div>
                                <div class="w-full bg-cozy-bg rounded-full h-3">
                                    <div class="bg-cozy-brown h-3 rounded-full" style="width: {{ ($cat->temperament_score / 10) * 100 }}%"></div>
                                </div>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                            </div>
                            @endif

                            @if($cat->ai_profile)
                            <div class="mb-4">
                                <span class="text-sm font-bold text-cozy-brown/80 block mb-1">Personality Summary</span>
                                <p class="text-cozy-brown leading-relaxed font-medium">{{ $cat->ai_profile }}</p>
                            </div>
                            @endif

                            @if($cat->ideal_adopters)
                            <div class="mb-4">
                                <span class="text-sm font-bold text-cozy-brown/80 block mb-1">Perfect For</span>
                                <p class="text-cozy-brown leading-relaxed font-medium">{{ $cat->ideal_adopters }}</p>
                            </div>
                            @endif

                            @if($cat->care_notes)
                            <div>
                                <span class="text-sm font-bold text-cozy-brown/80 block mb-1">Care Recommendations</span>
                                <p class="text-cozy-brown leading-relaxed font-medium">{{ $cat->care_notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

<<<<<<< HEAD
                    <div class="border-t border-cozy-warm/40 my-6"></div>
=======
                    <div class="border-t border-cozy-brown/10 my-8"></div>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c

                    <!-- Location Wrapper -->
                    <div class="mb-10">
                        <div class="flex items-center justify-between mb-4">
<<<<<<< HEAD
                            <h4 class="font-serif font-bold text-lg text-cozy-brown flex items-center gap-2">
                                <svg class="w-5 h-5 text-cozy-accent" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Current Location
                            </h4>
                            <span class="text-xs text-cozy-brown/40">Exact coordinates hidden for safety</span>
                        </div>
                        <div class="relative rounded-2xl overflow-hidden shadow-inner border border-cozy-warm/40">
                            <div id="cat-map" class="h-48 w-full z-0"></div>
=======
                            <h4 class="font-script font-bold text-3xl text-cozy-brown flex items-center gap-2">
                                <svg class="w-6 h-6 text-cozy-brown/50" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                Current Location
                            </h4>
                            <span class="text-xs text-cozy-brown/60 font-bold bg-[#F5DEB3] px-3 py-1 rounded-full">Coordinates hidden for safety</span>
                        </div>
                        <div class="relative rounded-[2rem] overflow-hidden shadow-inner border border-cozy-brown/10">
                            <div id="cat-map" class="h-64 w-full z-0"></div>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                            <input type="hidden" id="cat-lat" value="{{ $cat->gps_lat ?? 3.140853 }}">
                            <input type="hidden" id="cat-lng" value="{{ $cat->gps_lng ?? 101.693207 }}">
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-auto flex flex-col sm:flex-row gap-4">
<<<<<<< HEAD
                        <button
                            class="flex-1 bg-cozy-brown text-cozy-light px-8 py-4 rounded-xl hover:bg-cozy-accent hover:shadow-lg transition-all transform hover:-translate-y-1 font-bold text-lg tracking-wide shadow-md">
=======
                        <button class="flex-1 bg-cozy-brown text-cozy-card px-8 py-4 rounded-[1.5rem] hover:bg-[#573D2B] transition-all transform hover:-translate-y-1 font-bold text-lg shadow-md flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                            Apply to Adopt
                        </button>

                        <!-- QR Code Toggle -->
                        <div x-data="{ open: false }" class="relative">
<<<<<<< HEAD
                            <button @click="open = !open"
                                class="h-full px-6 py-3 border-2 border-cozy-warm text-cozy-brown rounded-xl hover:bg-cozy-warm/30 transition-colors font-bold flex items-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v1m6 11h2m-6 0h-2v4h-4v-4H8m13-4V7a1 1 0 00-1-1H4a1 1 0 00-1 1v3M4 7h16" />
=======
                            <button @click="open = !open" class="w-full sm:w-auto h-full px-8 py-4 bg-[#F5DEB3] text-cozy-brown rounded-[1.5rem] hover:bg-[#E6C697] transition-colors font-bold flex items-center justify-center gap-2 shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4h-4v-4H8m13-4V7a1 1 0 00-1-1H4a1 1 0 00-1 1v3M4 7h16" />
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                </svg>
                                <span>Share</span>
                            </button>

                            <!-- Dropdown -->
                            <div x-show="open" @click.away="open = false"
<<<<<<< HEAD
                                class="absolute bottom-full right-0 mb-2 p-4 bg-cozy-card rounded-xl shadow-xl border border-cozy-warm z-50 w-48 text-center"
=======
                                class="absolute bottom-full right-0 mb-4 p-5 bg-cozy-card rounded-[2rem] shadow-2xl border border-cozy-brown/10 z-50 w-56 text-center"
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-4"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
<<<<<<< HEAD
                                x-transition:leave-end="opacity-0 translate-y-2" style="display: none;">
                                <div class="mb-2 text-sm text-cozy-brown/50 font-bold">Scan to Share</div>
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ route('cats.show', $cat) }}"
                                    alt="QR Code" class="mx-auto rounded border p-1">
=======
                                x-transition:leave-end="opacity-0 translate-y-4" style="display: none;">
                                <div class="mb-3 text-sm text-cozy-brown font-bold">Scan to Share</div>
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ route('cats.show', $cat) }}"
                                    alt="QR Code" class="mx-auto rounded-xl shadow-sm p-2 bg-white">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-shadow {
            text-shadow: 2px 2px 8px rgba(111, 78, 55, 0.4);
        }
        @keyframes blobPulseSlow {
            0%,100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50%      { border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%; }
        }
        .blob-slow { animation: blobPulseSlow 12s ease-in-out infinite; }
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
<<<<<<< HEAD
                html: "<div style='background-color:#C8956D; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);'></div>",
                iconSize: [12, 12],
                iconAnchor: [6, 6]
=======
                html: "<div style='background-color:#6F4E37; width: 16px; height: 16px; border-radius: 50%; border: 3px solid #FFF4E3; box-shadow: 0 4px 6px rgba(111,78,55,0.4);'></div>",
                iconSize: [16, 16],
                iconAnchor: [8, 8]
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
            });

            L.marker([lat, lng], { icon: icon }).addTo(map)
                .bindPopup('<span class="font-bold text-cozy-brown">{{ $cat->name }}</span> is around here.')
                .openPopup();
        });
    </script>
</x-app-layout>