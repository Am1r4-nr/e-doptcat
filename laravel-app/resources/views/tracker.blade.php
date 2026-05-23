<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }
    #reader video {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        border-radius: 1rem;
    }
</style>

<div class="bg-cozy-bg min-h-screen pt-28 pb-20 relative overflow-hidden flex flex-col" x-data="trackerApp()">
    <!-- Decorative Ambient Blobs -->
    <div class="absolute top-0 right-0 w-80 h-80 bg-cozy-warm/40 blob opacity-60 translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-cozy-accent/15 blob opacity-40 -translate-x-1/3 translate-y-1/3 pointer-events-none" style="animation-delay:-3s;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10 flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <div class="text-center pb-8 flex-shrink-0">
            <p class="font-script text-3xl text-cozy-accent mb-1">Community Care</p>
            <h2 class="font-serif font-bold text-4xl md:text-5xl text-cozy-brown mb-4">
                {{ __('Lost & Found') }}
            </h2>
            <div class="w-20 h-1 bg-cozy-accent/60 mx-auto rounded-full mb-4"></div>
            <p class="text-cozy-brown/60 max-w-xl mx-auto text-base">
                Report and track lost, missing, or injured cats in our community. Help us reunite them with their families.
            </p>
        </div>

        <!-- ── User Guide ── -->
        <div class="mb-8 flex-shrink-0">
            <div class="bg-cozy-card rounded-3xl shadow-md border border-cozy-warm/40 overflow-hidden">
                <!-- Guide Header (collapsible) -->
                <button @click="guideOpen = !guideOpen"
                        class="w-full flex items-center justify-between px-7 py-5 text-left hover:bg-cozy-warm/10 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-cozy-accent/10 flex items-center justify-center text-cozy-accent flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-lg text-cozy-brown">How to Use This Page</h3>
                            <p class="text-[12px] text-cozy-brown/50 font-medium mt-0.5">A quick guide to the Lost &amp; Found features</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-cozy-brown/40 transition-transform duration-300"
                         :class="guideOpen ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                    </svg>
                </button>

                <!-- Guide Content -->
                <div x-show="guideOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="px-7 pb-7">
                    <div class="h-px bg-cozy-warm/40 mb-6"></div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                        <!-- Step 1: Live Map -->
                        <div class="bg-cozy-bg rounded-2xl p-5 border border-cozy-warm/40">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-8 h-8 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                                </div>
                                <div>
                                    <span class="text-[9px] font-bold text-amber-500 uppercase tracking-widest">Step 1</span>
                                    <p class="font-bold text-[13px] text-cozy-brown leading-none mt-0.5">Browse the Map</p>
                                </div>
                            </div>
                            <p class="text-[12px] text-cozy-brown/60 leading-relaxed">
                                Coloured dots mark each tracked cat's last known location. Click any dot to see the cat's name and health status, then tap <strong class="text-cozy-brown/80">View Profile</strong> for full details.
                            </p>
                            <div class="mt-3 flex flex-wrap gap-1.5">
                                <span class="flex items-center gap-1 text-[10px] text-cozy-brown/60 font-semibold"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500 flex-shrink-0"></span>Healthy</span>
                                <span class="flex items-center gap-1 text-[10px] text-cozy-brown/60 font-semibold"><span class="w-2.5 h-2.5 rounded-full bg-amber-500 flex-shrink-0"></span>Recovering</span>
                                <span class="flex items-center gap-1 text-[10px] text-cozy-brown/60 font-semibold"><span class="w-2.5 h-2.5 rounded-full bg-blue-500 flex-shrink-0"></span>Treated</span>
                                <span class="flex items-center gap-1 text-[10px] text-cozy-brown/60 font-semibold"><span class="w-2.5 h-2.5 rounded-full bg-red-500 flex-shrink-0"></span>Observe</span>
                            </div>
                        </div>

                        <!-- Step 2: List -->
                        <div class="bg-cozy-bg rounded-2xl p-5 border border-cozy-warm/40">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-8 h-8 rounded-xl bg-teal-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                                </div>
                                <div>
                                    <span class="text-[9px] font-bold text-teal-500 uppercase tracking-widest">Step 2</span>
                                    <p class="font-bold text-[13px] text-cozy-brown leading-none mt-0.5">Use the List</p>
                                </div>
                            </div>
                            <p class="text-[12px] text-cozy-brown/60 leading-relaxed">
                                The <strong class="text-cozy-brown/80">List</strong> tab in the sidebar shows all tracked companions. Filter by health status using the dropdown, then click any cat card to fly the map to their location.
                            </p>
                            <p class="text-[11px] text-cozy-brown/40 font-semibold mt-3">
                                Tip: A <span class="text-red-500">🔴 LIVE</span> badge means real-time GPS tracking is active.
                            </p>
                        </div>

                        <!-- Step 3: Scanner -->
                        <div class="bg-cozy-bg rounded-2xl p-5 border border-cozy-warm/40">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-8 h-8 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z"/></svg>
                                </div>
                                <div>
                                    <span class="text-[9px] font-bold text-purple-500 uppercase tracking-widest">Step 3</span>
                                    <p class="font-bold text-[13px] text-cozy-brown leading-none mt-0.5">Scan a QR Code</p>
                                </div>
                            </div>
                            <p class="text-[12px] text-cozy-brown/60 leading-relaxed">
                                Every registered cat wears a collar with a QR code. Switch to <strong class="text-cozy-brown/80">Scanner</strong>, tap <em>Start Camera</em>, and point it at the collar. You'll be taken straight to the cat's profile.
                            </p>
                            <p class="text-[11px] text-cozy-brown/40 font-semibold mt-3">
                                No collar nearby? Use <strong class="text-cozy-brown/60">Upload Image</strong> to scan from a photo instead.
                            </p>
                        </div>

                        <!-- Step 4: Report -->
                        <div class="bg-cozy-bg rounded-2xl p-5 border border-cozy-warm/40">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-8 h-8 rounded-xl bg-rose-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                                </div>
                                <div>
                                    <span class="text-[9px] font-bold text-rose-500 uppercase tracking-widest">Step 4</span>
                                    <p class="font-bold text-[13px] text-cozy-brown leading-none mt-0.5">File a Report</p>
                                </div>
                            </div>
                            <p class="text-[12px] text-cozy-brown/60 leading-relaxed">
                                Spotted a lost, injured, or stray cat? Tap the <strong class="text-cozy-brown/80">Report</strong> button in the sidebar to submit a sighting with a description and your location. Our team reviews every report.
                            </p>
                            <a href="{{ route('reports.create') }}"
                               class="mt-3 inline-flex items-center gap-1.5 text-[11px] font-bold text-cozy-accent hover:underline">
                                File a report now
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 flex-1 overflow-hidden">
            <!-- Map Section (Takes up 2 cols on large screens) -->
            <div class="lg:col-span-2 space-y-6 flex flex-col overflow-hidden h-[500px] lg:h-auto">
                <!-- Interactive Map Card -->
                <div class="bg-cozy-card rounded-3xl shadow-lg border border-cozy-warm/40 p-6 relative flex-1 flex flex-col overflow-hidden">
                    <div class="flex justify-between items-center mb-4 flex-shrink-0">
                        <h3 class="font-serif font-bold text-xl text-cozy-brown flex items-center gap-2">
                            <svg class="w-6 h-6 text-cozy-accent" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            Live Map
                        </h3>
                        <button id="btn-locate-me" @click="locateMe"
                            class="flex items-center gap-2 px-4 py-2 bg-cozy-light hover:bg-cozy-warm/30 text-cozy-brown font-bold text-sm rounded-xl border border-cozy-warm/40 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Find Me
                        </button>
                    </div>

                    <!-- Map Container -->
                    <div
                        class="relative flex-1 w-full rounded-2xl overflow-hidden shadow-inner border border-cozy-warm/30 bg-cozy-bg min-h-[300px]">
                        <div id="tracker-map" class="w-full h-full z-0"></div>

                        <!-- Floating Legend -->
                        <div
                            class="absolute bottom-4 left-4 z-[400] bg-cozy-card/95 backdrop-blur-md p-4 rounded-2xl shadow-lg border border-cozy-warm/50 max-w-[180px]">
                            <p class="text-[9px] font-bold text-cozy-brown/50 uppercase mb-3 tracking-widest">Health Status</p>
                            <div class="space-y-2">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-sm"></span>
                                    <span class="text-xs font-bold text-cozy-brown/85">Healthy</span>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <span class="w-3 h-3 rounded-full bg-amber-500 shadow-sm"></span>
                                    <span class="text-xs font-bold text-cozy-brown/85">Recovering</span>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <span class="w-3 h-3 rounded-full bg-blue-500 shadow-sm"></span>
                                    <span class="text-xs font-bold text-cozy-brown/85">Treated</span>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <span class="w-3 h-3 rounded-full bg-red-500 shadow-sm"></span>
                                    <span class="text-xs font-bold text-cozy-brown/85">Observe</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar List Section -->
            <div class="lg:col-span-1 space-y-6 flex flex-col overflow-hidden">
                <!-- Tab Toggle -->
                <div class="bg-cozy-card rounded-3xl shadow-md border border-cozy-warm/40 p-3 flex-shrink-0">
                    <div class="flex gap-2">
                        <button id="toggle-view-list" @click="viewMode = 'list'" :class="viewMode === 'list' ? 'bg-cozy-brown text-cozy-light' : 'bg-cozy-light text-cozy-brown/70 hover:bg-cozy-warm/20'" class="flex-1 py-2.5 rounded-xl font-bold transition-all text-sm shadow-sm">
                            📋 List
                        </button>
                        <button id="toggle-view-scanner" @click="viewMode = 'scanner'" :class="viewMode === 'scanner' ? 'bg-cozy-brown text-cozy-light' : 'bg-cozy-light text-cozy-brown/70 hover:bg-cozy-warm/20'" class="flex-1 py-2.5 rounded-xl font-bold transition-all text-sm shadow-sm">
                            📸 Scanner
                        </button>
                        <a id="btn-redirect-report" href="{{ route('reports.create') }}" class="flex-1 py-2.5 rounded-xl font-bold transition-all text-sm shadow-sm bg-cozy-light text-cozy-brown/70 hover:bg-cozy-warm/20 flex items-center justify-center gap-1.5">
                            📢 Report
                        </a>
                    </div>
                </div>

                <!-- List View -->
                <div x-show="viewMode === 'list'" class="space-y-6 flex-1 flex flex-col overflow-hidden">
                    <!-- Filters -->
                    <div class="bg-cozy-card rounded-3xl shadow-md border border-cozy-warm/40 p-5 flex-shrink-0">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-serif font-bold text-lg text-cozy-brown">Filter Cats</h3>
                            <button id="btn-reset-filters" @click="resetFilters"
                                class="text-xs text-cozy-accent font-bold hover:underline">Reset</button>
                        </div>
                        <div class="space-y-3">
                            <select id="select-status-filter" x-model="filterStatus"
                                class="w-full px-4 py-3 bg-cozy-light border-0 rounded-xl text-sm font-bold text-cozy-brown focus:ring-2 focus:ring-cozy-accent focus:bg-cozy-card transition-colors cursor-pointer">
                                <option value="all">All Health Statuses</option>
                                <option value="Healthy">Healthy</option>
                                <option value="Recovering">Recovering</option>
                                <option value="Treated">Treated</option>
                                <option value="Under Observation">Under Observation</option>
                            </select>
                            <div class="text-[10px] text-center text-cozy-brown/50 font-bold uppercase tracking-wider">
                                Showing <span x-text="filteredCats.length" class="text-cozy-accent"></span> companions
                            </div>
                        </div>
                    </div>

                    <!-- List -->
                    <div class="space-y-4 flex-1 overflow-y-auto pr-2 custom-scrollbar">
                        <template x-for="cat in filteredCats" :key="cat.id">
                            <div :id="'cat-list-item-' + cat.id" @click="focusCat(cat)"
                                class="bg-cozy-card group rounded-2xl shadow-sm border border-cozy-warm/30 p-4 flex gap-4 cursor-pointer hover:border-cozy-accent hover:shadow-md transition-all transform hover:-translate-x-1">

                                <div class="relative w-16 h-16 flex-shrink-0">
                                    <!-- Custom Pinterest Style organic thumbnail blob for cat picture -->
                                    <div class="w-full h-full overflow-hidden shadow-inner border border-cozy-accent/30"
                                         style="border-radius: 60% 40% 50% 50% / 50% 30% 70% 50%;">
                                        <img :src="cat.image || 'https://via.placeholder.com/150'"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full border-2 border-white"
                                        :class="{
                                            'bg-emerald-500': (!cat.health_status || cat.health_status === 'Healthy'),
                                            'bg-amber-500': cat.health_status === 'Recovering',
                                            'bg-blue-500': cat.health_status === 'Treated',
                                            'bg-red-500': cat.health_status === 'Under Observation' || (!['Healthy', 'Recovering', 'Treated'].includes(cat.health_status) && cat.health_status)
                                         }"></div>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start">
                                        <h4 class="text-base font-serif font-bold text-cozy-brown truncate group-hover:text-cozy-accent transition-colors"
                                            x-text="cat.name"></h4>
                                        <div class="flex gap-1 items-center">
                                            <template x-if="cat.gps_live">
                                                <span class="inline-block px-2 py-0.5 bg-red-100 text-red-600 text-[8px] font-bold uppercase rounded-full animate-pulse">🔴 LIVE</span>
                                            </template>
                                            <button class="text-cozy-brown/40 hover:text-cozy-accent transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="text-xs text-cozy-brown/50 mb-2 truncate" x-text="cat.breed || 'Mixed Breed'"></p>

                                    <div class="flex items-center justify-between mt-2">
                                        <div
                                            class="flex items-center gap-1 text-[9px] text-cozy-brown/40 font-bold uppercase tracking-wider">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span x-text="formatDate(cat.updated_at)"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <div x-show="filteredCats.length === 0" class="text-center py-10 bg-cozy-card/40 rounded-3xl border border-dashed border-cozy-warm p-4">
                            <span class="text-3xl block mb-2">🍃</span>
                            <p class="text-xs font-semibold text-cozy-brown/65">No companions found.</p>
                        </div>
                    </div>
                </div>

                <!-- QR Scanner View -->
                <div x-show="viewMode === 'scanner'" class="space-y-6 flex-1 flex flex-col overflow-hidden">
                    <div class="bg-cozy-card rounded-3xl shadow-md border border-cozy-warm/40 p-6 flex flex-col items-center flex-1 overflow-y-auto">
                        <!-- Custom Camera Container -->
                        <div class="relative w-full max-w-[320px] aspect-square rounded-2xl overflow-hidden border border-cozy-warm bg-black shadow-inner mb-5">
                            <div id="reader" class="w-full h-full"></div>
                            
                            <!-- Scanner Scanning Overlay -->
                            <div x-show="scannerActive" class="absolute inset-0 pointer-events-none z-10 flex items-center justify-center">
                                <!-- Target Box with corner borders -->
                                <div class="w-48 h-48 relative border-2 border-dashed border-cozy-accent/40 rounded-2xl flex items-center justify-center">
                                    <!-- Horizontal laser scanning line -->
                                    <div class="absolute w-[90%] h-0.5 bg-cozy-accent shadow-[0_0_8px_#c8956d] animate-[bounce_2s_infinite]"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Scanner Controls / Info -->
                        <div class="w-full text-center space-y-4">
                            <div id="result" class="font-serif font-bold text-sm text-cozy-accent min-h-6 bg-cozy-light/40 py-2.5 px-4 rounded-xl border border-cozy-warm/20 inline-block max-w-[280px]">
                                Preparing camera...
                            </div>
                            
                            <div class="flex justify-center gap-3">
                                <button @click="startScanner" x-show="!scannerActive" class="px-5 py-2.5 bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold text-xs rounded-xl transition-all shadow-sm">
                                    Start Camera
                                </button>
                                <button @click="stopScanner" x-show="scannerActive" class="px-5 py-2.5 bg-red-100 hover:bg-red-200 text-red-700 font-bold text-xs rounded-xl transition-all shadow-sm">
                                    Stop Camera
                                </button>
                                <label class="px-5 py-2.5 bg-cozy-light hover:bg-cozy-warm/30 text-cozy-brown border border-cozy-warm/40 font-bold text-xs rounded-xl transition-all shadow-sm cursor-pointer flex items-center justify-center gap-1.5">
                                    <span>📁 Upload Image</span>
                                    <input type="file" accept="image/*" class="hidden" @change="scanUploadedFile($event)">
                                </label>
                            </div>
                            
                            <p class="text-xs text-cozy-brown/55 leading-relaxed max-w-[280px] mx-auto">
                                Scan QR codes located on cat collars to immediately view their location and full safety profiles.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #fdf6ec;
        border-radius: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e8c9a0;
        border-radius: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #c8956d;
    }
</style>

<script>
    function trackerApp() {
        return {
            map: null,
            guideOpen: false,
            cats: @json($cats).map(c => ({
                ...c,
                image: c.image ? `/storage/${c.image}` : null
            })),
            filterStatus: 'all',
            markers: [],
            viewMode: 'list',
            scannerActive: false,
            html5QrCode: null,

            init() {
                this.initMap();
                this.$watch('viewMode', (value) => {
                    this.toggleScanner(value);
                });
            },

            get filteredCats() {
                if (this.filterStatus === 'all') {
                    return this.cats;
                }
                return this.cats.filter(cat => (cat.health_status || 'Healthy') === this.filterStatus);
            },

            initMap() {
                this.map = L.map('tracker-map', {
                    zoomControl: false
                }).setView([3.2535, 101.7323], 15); // IIUM Gombak Center

                L.control.zoom({ position: 'bottomright' }).addTo(this.map);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(this.map);

                this.updateMarkers();

                // Watch for filter changes to update map
                this.$watch('filterStatus', () => {
                    this.updateMarkers();
                });
            },

            toggleScanner(mode) {
                if (mode === 'scanner') {
                    this.$nextTick(() => {
                        this.startScanner();
                    });
                } else {
                    this.stopScanner();
                }
            },

            startScanner() {
                if (typeof Html5Qrcode === 'undefined') {
                    console.error('Html5Qrcode library not loaded');
                    return;
                }
                
                if (!this.html5QrCode) {
                    this.html5QrCode = new Html5Qrcode("reader");
                }

                const resultEl = document.getElementById('result');
                if (resultEl) resultEl.innerText = "Requesting camera access...";

                const config = { fps: 15, qrbox: { width: 200, height: 200 } };

                this.html5QrCode.start(
                    { facingMode: "environment" }, 
                    config,
                    (decodedText, decodedResult) => {
                        this.onScanSuccess(decodedText, decodedResult);
                    },
                    (error) => {
                        // Silently keep scanning
                    }
                ).then(() => {
                    this.scannerActive = true;
                    if (resultEl) resultEl.innerText = "Align QR code inside box";
                }).catch(err => {
                    console.error("Unable to start scanner", err);
                    if (resultEl) resultEl.innerText = "⚠️ Camera access denied or not found";
                    this.scannerActive = false;
                });
            },

            stopScanner() {
                if (this.html5QrCode && this.scannerActive) {
                    this.html5QrCode.stop().then(() => {
                        this.scannerActive = false;
                        const resultEl = document.getElementById('result');
                        if (resultEl) resultEl.innerText = "Camera stopped";
                    }).catch(err => {
                        console.error("Failed to stop scanner", err);
                    });
                }
            },

            onScanSuccess(decodedText, decodedResult) {
                const resultEl = document.getElementById('result');
                if (resultEl) resultEl.innerText = "✓ Found: Redirecting...";

                this.stopScanner();

                // If it's a URL to our cats, redirect
                if (decodedText.includes('/cats/')) {
                    window.location.href = decodedText;
                } else {
                    if (resultEl) resultEl.innerText = "✓ Scanned text: " + decodedText;
                }
            },

            scanUploadedFile(event) {
                const fileList = event.target.files;
                if (fileList.length === 0) {
                    return;
                }

                if (typeof Html5Qrcode === 'undefined') {
                    console.error('Html5Qrcode library not loaded');
                    return;
                }

                if (!this.html5QrCode) {
                    this.html5QrCode = new Html5Qrcode("reader");
                }

                const proceed = () => {
                    const imageFile = fileList[0];
                    const resultEl = document.getElementById('result');
                    if (resultEl) resultEl.innerText = "Analyzing image file...";

                    this.html5QrCode.scanFile(imageFile, true)
                        .then(decodedText => {
                            this.onScanSuccess(decodedText, null);
                        })
                        .catch(err => {
                            console.error("Error scanning file", err);
                            if (resultEl) resultEl.innerText = "❌ No QR code found in this image";
                        });
                };

                if (this.scannerActive) {
                    this.html5QrCode.stop().then(() => {
                        this.scannerActive = false;
                        proceed();
                    }).catch(err => {
                        console.error("Failed to stop scanner before file upload", err);
                        proceed();
                    });
                } else {
                    proceed();
                }
            },

            updateMarkers() {
                // Clear existing markers
                this.markers.forEach(marker => this.map.removeLayer(marker));
                this.markers = [];

                this.filteredCats.forEach(cat => {
                    if (cat.gps_lat && cat.gps_lng) {
                        var health = cat.health_status || 'Healthy';
                        var color = 'green'; // Healthy
                        if (health === 'Recovering') color = 'orange';
                        if (health === 'Treated') color = 'blue';
                        if (health === 'Under Observation') color = 'red';
                        if (!['Healthy', 'Recovering', 'Treated', 'Under Observation'].includes(health)) color = 'red';

                        var markerHtmlStyles = `
                            background-color: ${this.getColorCode(color)};
                            width: 1.5rem;
                            height: 1.5rem;
                            display: block;
                            left: -0.5rem;
                            top: -0.5rem;
                            position: relative;
                            border-radius: 50%;
                            border: 3px solid #FFFFFF;
                            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
                        `;

                        var icon = L.divIcon({
                            className: "custom-pin",
                            iconAnchor: [0, 0],
                            labelAnchor: [-6, 0],
                            popupAnchor: [6, -10],
                            html: `<div style="${markerHtmlStyles}"></div>`
                        });

                        var marker = L.marker([cat.gps_lat, cat.gps_lng], {
                            icon: icon
                        }).addTo(this.map);

                        const popupContent = `
                            <div class="text-center p-3 min-w-[150px] bg-fdf6ec rounded-2xl">
                                <div class="w-16 h-16 rounded-full overflow-hidden mx-auto mb-3 border-2 border-[${this.getColorCode(color)}] shadow-sm">
                                    <img src="${cat.image || 'https://via.placeholder.com/150'}" class="w-full h-full object-cover">
                                </div>
                                <h3 class="font-serif font-bold text-base text-gray-800 leading-tight mb-1">${cat.name}</h3>
                                ${cat.gps_live ? '<span class="inline-block px-2 py-0.5 bg-red-100 text-red-600 text-[8px] font-bold uppercase rounded-full mb-2">🔴 LIVE GPS</span>' : ''}
                                <div class="mb-1"><span class="inline-block px-2 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider text-white" style="background-color: ${this.getColorCode(color)}">${health}</span></div>
                                ${cat.gps_battery ? '<div class="text-[10px] text-gray-600 mt-1">🔋 Battery: ' + cat.gps_battery + '%</div>' : ''}
                                <div class="text-[9px] text-gray-400 mt-1">${cat.gps_timestamp ? new Date(cat.gps_timestamp).toLocaleTimeString() : 'Unknown time'}</div>
                                <div class="mt-3">
                                    <a href="/cats/${cat.id}" class="inline-block w-full py-1.5 bg-cozy-brown hover:bg-cozy-accent text-white hover:text-cozy-brown text-[10px] font-bold rounded-xl transition-all">View Profile</a>
                                </div>
                            </div>
                        `;

                        marker.bindPopup(popupContent, {
                            closeButton: false,
                            className: 'rounded-2xl shadow-xl border-none'
                        });
                        this.markers.push(marker);
                    }
                });
            },

            getColorCode(name) {
                const colors = {
                    'green': '#10b981', // emerald-500
                    'orange': '#f59e0b', // amber-500
                    'blue': '#3b82f6', // blue-500
                    'red': '#ef4444' // red-500
                };
                return colors[name] || '#9ca3af';
            },

            focusCat(cat) {
                if (cat.gps_lat && cat.gps_lng && this.map) {
                    this.map.flyTo([cat.gps_lat, cat.gps_lng], 16, {
                        animate: true,
                        duration: 1.5
                    });
                }
            },

            locateMe() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition((position) => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        this.map.flyTo([lat, lng], 15);
                        L.marker([lat, lng]).addTo(this.map).bindPopup("You are here").openPopup();
                    }, () => {
                        alert("Unable to retrieve your location");
                    });
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
            },

            resetFilters() {
                this.filterStatus = 'all';
            },

            formatDate(dateString) {
                if (!dateString) return 'Unknown';
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) + ', ' +
                    date.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
            }
        }
    }
</script>
</x-app-layout>
