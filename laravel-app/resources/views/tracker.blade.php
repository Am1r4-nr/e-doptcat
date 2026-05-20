<x-app-layout>
    <div class="bg-cozy-bg h-screen overflow-hidden flex flex-col pt-24 pb-6 font-montserrat" x-data="trackerApp()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full overflow-hidden flex flex-col">
            <!-- Header -->
            <div class="text-center py-6 flex-shrink-0">
                <h2 class="font-script font-bold text-5xl text-cozy-brown mb-4">
                    {{ __('Cat Tracker') }}
                </h2>
                <div class="w-24 h-1.5 bg-[#F5DEB3] mx-auto rounded-full"></div>
                <p class="mt-4 text-cozy-brown/80 font-medium max-w-2xl mx-auto text-lg">
                    Real-time GPS tracking of cats in our care. Monitor their location and status.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 flex-1 overflow-hidden">
                <!-- Map Section (Takes up 2 cols on large screens) -->
                <div class="lg:col-span-2 space-y-6 flex flex-col overflow-hidden">
                    <!-- Interactive Map Card -->
                    <div class="bg-cozy-card rounded-[2.5rem] shadow-sm border border-cozy-brown/30 p-6 relative flex-1 flex flex-col overflow-hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-script font-bold text-2xl text-cozy-brown flex items-center gap-2">
                                <svg class="w-7 h-7 text-cozy-brown" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                                Live Map
                            </h3>
                            <button @click="locateMe"
                                class="flex items-center gap-2 px-5 py-2.5 bg-[#F5DEB3]/20 text-cozy-brown font-bold text-sm rounded-full hover:bg-[#F5DEB3]/40 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Find Me
                            </button>
                        </div>

                        <!-- Map Container -->
                        <div
                            class="relative flex-1 w-full rounded-3xl overflow-hidden shadow-inner border border-gray-100">
                            <div id="tracker-map" class="w-full h-full z-0"></div>

                            <!-- Floating Legend -->
                            <div
                                class="absolute bottom-4 left-4 z-[400] bg-cozy-card/90 backdrop-blur-md p-4 rounded-2xl shadow-lg border border-cozy-brown/20">
                                <p class="text-xs font-bold text-cozy-brown/50 uppercase mb-3 tracking-wider">Health Status Legend
                                </p>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 rounded-full bg-green-500 shadow-sm"></span>
                                        <span class="text-xs font-bold text-cozy-brown">Healthy</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 rounded-full bg-orange-500 shadow-sm"></span>
                                        <span class="text-xs font-bold text-cozy-brown">Recovering</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 rounded-full bg-blue-500 shadow-sm"></span>
                                        <span class="text-xs font-bold text-cozy-brown">Treated</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 rounded-full bg-red-500 shadow-sm"></span>
                                        <span class="text-xs font-bold text-cozy-brown">Under Observation</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar List Section -->
                <div class="lg:col-span-1 space-y-6 flex flex-col overflow-hidden">
                    <!-- Tab Toggle -->
                    <div class="bg-cozy-card rounded-[2rem] shadow-sm border border-cozy-brown/30 p-3 flex-shrink-0">
                        <div class="flex gap-2">
                            <button @click="viewMode = 'list'" :class="viewMode === 'list' ? 'bg-u-dark text-u-cream' : 'bg-cozy-bg/50 text-cozy-brown/70 hover:bg-cozy-bg'" class="flex-1 py-3 rounded-2xl font-bold transition-all text-sm">
                                📋 List
                            </button>
                            <button @click="viewMode = 'scanner'" :class="viewMode === 'scanner' ? 'bg-u-dark text-u-cream' : 'bg-cozy-bg/50 text-cozy-brown/70 hover:bg-cozy-bg'" class="flex-1 py-3 rounded-2xl font-bold transition-all text-sm">
                                📸 Scanner
                            </button>
                        </div>
                    </div>

                    <!-- List View -->
                    <div x-show="viewMode === 'list'" class="space-y-6 flex-1 flex flex-col overflow-hidden">
                        <!-- Filters -->
                        <div class="bg-cozy-card rounded-[2rem] shadow-sm border border-cozy-brown/30 p-6 flex-shrink-0">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-script font-bold text-xl text-cozy-brown">Filter Cats</h3>
                                <button @click="resetFilters"
                                    class="text-sm text-cozy-brown/50 font-bold hover:text-cozy-brown transition-colors">Reset</button>
                            </div>
                            <div class="space-y-3">
                                <select x-model="filterStatus"
                                    class="w-full px-4 py-3 bg-cozy-bg/50 border-transparent rounded-2xl text-sm font-bold text-cozy-brown focus:border-u-dark focus:ring-0 cursor-pointer transition-colors">
                                    <option value="all">All Health Statuses</option>
                                    <option value="Healthy">Healthy</option>
                                    <option value="Recovering">Recovering</option>
                                    <option value="Treated">Treated</option>
                                    <option value="Under Observation">Under Observation</option>
                                </select>
                                <div class="text-xs text-center text-cozy-brown/50 font-bold">
                                    Showing <span x-text="filteredCats.length"></span> cats
                                </div>
                            </div>
                        </div>

                        <!-- List -->
                        <div class="space-y-4 flex-1 overflow-y-auto pr-2 custom-scrollbar">
                            <template x-for="cat in filteredCats" :key="cat.id">
                                <div @click="focusCat(cat)"
                                    class="bg-cozy-card group rounded-3xl shadow-sm border border-cozy-brown/30 p-4 flex gap-4 cursor-pointer hover:border-u-dark hover:shadow-md transition-all transform hover:-translate-x-1">

                                    <div class="relative w-16 h-16 flex-shrink-0">
                                        <img :src="cat.image || 'https://via.placeholder.com/150'"
                                            class="w-full h-full object-cover rounded-2xl shadow-sm">
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full border-2 border-white"
                                            :class="{
                                                'bg-green-500': (!cat.health_status || cat.health_status === 'Healthy'),
                                                'bg-orange-500': cat.health_status === 'Recovering',
                                                'bg-blue-500': cat.health_status === 'Treated',
                                                'bg-red-500': cat.health_status === 'Under Observation' || (!['Healthy', 'Recovering', 'Treated'].includes(cat.health_status) && cat.health_status)
                                             }"></div>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-start">
                                            <h4 class="text-lg font-script font-bold text-cozy-brown truncate group-hover:text-cozy-brown transition-colors"
                                                x-text="cat.name"></h4>
                                            <div class="flex gap-1 items-center">
                                                <template x-if="cat.gps_live">
                                                    <span class="inline-block px-2 py-0.5 bg-red-100 text-red-600 text-[9px] font-bold uppercase rounded-full animate-pulse">🔴 LIVE</span>
                                                </template>
                                                <button class="text-cozy-brown/30 hover:text-cozy-brown transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <p class="text-xs text-cozy-brown/60 font-medium mb-2 truncate" x-text="cat.breed"></p>

                                        <div class="flex items-center justify-between mt-2">
                                            <div
                                                class="flex items-center gap-1 text-[10px] text-cozy-brown/50 font-bold uppercase tracking-wider">
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

                            <div x-show="filteredCats.length === 0" class="text-center py-8 text-cozy-brown/50 font-medium">
                                <p>No cats found matching filtering.</p>
                            </div>
                        </div>
                    </div>

                    <!-- QR Scanner View -->
                    <div x-show="viewMode === 'scanner'" class="space-y-6 flex-1 flex flex-col overflow-hidden">
                        <div class="bg-cozy-card rounded-[2.5rem] shadow-sm border border-cozy-brown/30 p-6 flex flex-col items-center flex-1 overflow-y-auto">
                            <div id="reader" style="width: 100%; max-width: 400px; margin-bottom: 1.5rem; border-radius: 1.5rem; overflow: hidden; border: 2px solid #EADFC5;"></div>
                            <div id="result" class="mt-2 font-bold text-lg text-cozy-brown text-center min-h-6"></div>
                            <p class="mt-3 text-sm text-cozy-brown/60 font-medium text-center">Ensure good lighting and hold the camera steady.</p>
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
            background: rgba(234, 223, 197, 0.3); /* u-cream with opacity */
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(168, 185, 129, 0.5); /* u-light with opacity */
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(54, 64, 37, 0.5); /* u-dark with opacity */
        }
    </style>

    <script>
        function trackerApp() {
            return {
                map: null,
                cats: @json($cats),
                filterStatus: 'all',
                markers: [],
                viewMode: 'list',
                scannerInitialized: false,

                init() {
                    this.initMap();
                    this.$watch('viewMode', () => {
                        if (this.viewMode === 'scanner' && !this.scannerInitialized) {
                            this.$nextTick(() => {
                                this.initScanner();
                            });
                        }
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

                initScanner() {
                    if (typeof Html5QrcodeScanner === 'undefined') {
                        console.error('Html5QrcodeScanner library not loaded');
                        return;
                    }

                    function onScanSuccess(decodedText, decodedResult) {
                        document.getElementById('result').innerText = "✓ Found: " + decodedText;

                        // If it's a URL to our cats, redirect
                        if (decodedText.includes('/cats/')) {
                            window.location.href = decodedText;
                        }
                    }

                    function onScanFailure(error) {
                        // Silently fail - keep scanning
                    }

                    let html5QrcodeScanner = new Html5QrcodeScanner(
                        "reader",
                        { fps: 10, qrbox: { width: 250, height: 250 } },
                        false
                    );
                    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                    this.scannerInitialized = true;
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
                                <div class="text-center p-4 min-w-[160px]">
                                    <div class="w-16 h-16 rounded-2xl overflow-hidden mx-auto mb-3 border-2 border-[${this.getColorCode(color)}] shadow-sm">
                                        <img src="${cat.image || 'https://via.placeholder.com/150'}" class="w-full h-full object-cover">
                                    </div>
                                    <h3 class="font-script font-bold text-xl text-[#364025] leading-tight mb-1">${cat.name}</h3>
                                    ${cat.gps_live ? '<span class="inline-block px-2 py-0.5 bg-red-100 text-red-600 text-[9px] font-bold uppercase rounded-full mb-2">🔴 LIVE GPS</span>' : ''}
                                    <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wide text-white" style="background-color: ${this.getColorCode(color)}">${health}</span>
                                    ${cat.gps_battery ? '<div class="text-xs text-[#364025]/70 font-medium mt-2">🔋 Battery: ' + cat.gps_battery + '%</div>' : ''}
                                    <div class="text-xs text-[#364025]/50 font-medium mt-1">${cat.gps_timestamp ? new Date(cat.gps_timestamp).toLocaleTimeString() : 'Unknown time'}</div>
                                    <div class="mt-4">
                                        <a href="/cats/${cat.id}" class="inline-block w-full py-2 bg-[#A8B981] hover:bg-[#364025] text-[#364025] hover:text-[#EADFC5] text-xs font-bold rounded-xl transition-colors">View Profile</a>
                                    </div>
                                </div>
                            `;

                            marker.bindPopup(popupContent, {
                                closeButton: false,
                                className: 'rounded-2xl shadow-2xl border-none font-montserrat'
                            });
                            this.markers.push(marker);
                        }
                    });
                },

                getColorCode(name) {
                    const colors = {
                        'green': '#22c55e',
                        'orange': '#f97316',
                        'blue': '#3b82f6',
                        'red': '#ef4444'
                    };
                    return colors[name] || '#9ca3af';
                },

                focusCat(cat) {
                    if (cat.gps_lat && cat.gps_lng && this.map) {
                        this.map.flyTo([cat.gps_lat, cat.gps_lng], 16, {
                            animate: true,
                            duration: 1.5
                        });

                        // Optional: Highlight marker
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
                    // Short format: "Dec 30, 2:30 PM"
                    return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) + ', ' +
                        date.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
                }
            }
        }
    </script>
</x-app-layout>
