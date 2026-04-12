<x-app-layout>
    <div class="bg-boho-bg h-screen overflow-hidden flex flex-col" x-data="trackerApp()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full overflow-hidden flex flex-col">
            <!-- Header -->
            <div class="text-center py-6 flex-shrink-0">
                <h2 class="font-serif font-bold text-4xl text-boho-brown mb-4">
                    {{ __('Cat Tracker') }}
                </h2>
                <div class="w-24 h-1 bg-boho-orange mx-auto rounded-full"></div>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                    Real-time GPS tracking of cats in our care. Monitor their location and status.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 flex-1 overflow-hidden">
                <!-- Map Section (Takes up 2 cols on large screens) -->
                <div class="lg:col-span-2 space-y-6 flex flex-col overflow-hidden">
                    <!-- Interactive Map Card -->
                    <div class="bg-white rounded-3xl shadow-sm border border-boho-light p-6 relative flex-1 flex flex-col overflow-hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-serif font-bold text-xl text-boho-brown flex items-center gap-2">
                                <svg class="w-6 h-6 text-boho-orange" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                                Live Map
                            </h3>
                            <button @click="locateMe"
                                class="flex items-center gap-2 px-4 py-2 bg-boho-light text-boho-brown font-bold text-sm rounded-xl hover:bg-boho-cream transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Find Me
                            </button>
                        </div>

                        <!-- Map Container -->
                        <div
                            class="relative flex-1 w-full rounded-2xl overflow-hidden shadow-inner border border-gray-100">
                            <div id="tracker-map" class="w-full h-full z-0"></div>

                            <!-- Floating Legend -->
                            <div
                                class="absolute bottom-4 left-4 z-[400] bg-white/95 backdrop-blur-sm p-4 rounded-xl shadow-lg border border-boho-light">
                                <p class="text-xs font-bold text-gray-400 uppercase mb-3 tracking-wider">Status Legend
                                </p>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 rounded-full bg-green-500 shadow-sm"></span>
                                        <span class="text-xs font-bold text-gray-600">Healthy</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 rounded-full bg-orange-500 shadow-sm"></span>
                                        <span class="text-xs font-bold text-gray-600">Recovering</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 rounded-full bg-red-500 shadow-sm"></span>
                                        <span class="text-xs font-bold text-gray-600">Attention Needed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar List Section -->
                <div class="lg:col-span-1 space-y-6 flex flex-col overflow-hidden">
                    <!-- Tab Toggle -->
                    <div class="bg-white rounded-3xl shadow-sm border border-boho-light p-4 flex-shrink-0">
                        <div class="flex gap-2">
                            <button @click="viewMode = 'list'" :class="viewMode === 'list' ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-700'" class="flex-1 py-2 rounded-lg font-bold transition-all text-sm">
                                📋 List
                            </button>
                            <button @click="viewMode = 'scanner'" :class="viewMode === 'scanner' ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-700'" class="flex-1 py-2 rounded-lg font-bold transition-all text-sm">
                                📸 Scanner
                            </button>
                        </div>
                    </div>

                    <!-- List View -->
                    <div x-show="viewMode === 'list'" class="space-y-6 flex-1 flex flex-col overflow-hidden">
                        <!-- Filters -->
                        <div class="bg-white rounded-3xl shadow-sm border border-boho-light p-6 flex-shrink-0">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-serif font-bold text-lg text-boho-brown">Filter Cats</h3>
                                <button @click="resetFilters"
                                    class="text-xs text-boho-orange font-bold hover:underline">Reset</button>
                            </div>
                            <div class="space-y-3">
                                <select x-model="filterStatus"
                                    class="w-full px-4 py-3 bg-boho-light border-transparent rounded-xl text-sm font-bold text-gray-700 focus:border-boho-brown focus:ring-0 cursor-pointer">
                                    <option value="all">All Statuses</option>
                                    <option value="Available">Available (Healthy)</option>
                                    <option value="Adopted">Adopted</option>
                                    <option value="Pending">Pending (Recovering)</option>
                                </select>
                                <div class="text-xs text-center text-gray-400 font-medium">
                                    Showing <span x-text="filteredCats.length"></span> cats
                                </div>
                            </div>
                        </div>

                        <!-- List -->
                        <div class="space-y-4 flex-1 overflow-y-auto pr-2 custom-scrollbar">
                            <template x-for="cat in filteredCats" :key="cat.id">
                                <div @click="focusCat(cat)"
                                    class="bg-white group rounded-2xl shadow-sm border border-boho-light p-4 flex gap-4 cursor-pointer hover:border-boho-orange hover:shadow-md transition-all transform hover:-translate-x-1">

                                    <div class="relative w-16 h-16 flex-shrink-0">
                                        <img :src="cat.image || 'https://via.placeholder.com/150'"
                                            class="w-full h-full object-cover rounded-xl shadow-sm">
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full border-2 border-white"
                                            :class="{
                                                'bg-green-500': cat.status === 'Available',
                                                'bg-orange-500': cat.status === 'Pending',
                                                'bg-blue-500': cat.status === 'Adopted',
                                                'bg-red-500': !['Available', 'Pending', 'Adopted'].includes(cat.status)
                                             }"></div>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-start">
                                            <h4 class="text-lg font-serif font-bold text-gray-800 truncate group-hover:text-boho-orange transition-colors"
                                                x-text="cat.name"></h4>
                                            <div class="flex gap-1 items-center">
                                                <template x-if="cat.gps_live">
                                                    <span class="inline-block px-2 py-0.5 bg-red-100 text-red-600 text-[9px] font-bold uppercase rounded-full animate-pulse">🔴 LIVE</span>
                                                </template>
                                                <button class="text-gray-300 hover:text-boho-brown transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-2 truncate" x-text="cat.breed"></p>

                                        <div class="flex items-center justify-between mt-2">
                                            <div
                                                class="flex items-center gap-1 text-[10px] text-gray-400 font-bold uppercase tracking-wide">
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

                            <div x-show="filteredCats.length === 0" class="text-center py-8 text-gray-500">
                                <p>No cats found matching filtering.</p>
                            </div>
                        </div>
                    </div>

                    <!-- QR Scanner View -->
                    <div x-show="viewMode === 'scanner'" class="space-y-6 flex-1 flex flex-col overflow-hidden">
                        <div class="bg-white rounded-3xl shadow-sm border border-boho-light p-6 flex flex-col items-center flex-1 overflow-y-auto">
                            <div id="reader" style="width: 100%; max-width: 400px; margin-bottom: 1.5rem;"></div>
                            <div id="result" class="mt-2 font-bold text-lg text-boho-brown text-center min-h-6"></div>
                            <p class="mt-3 text-sm text-gray-500 text-center">Ensure good lighting and hold the camera steady.</p>
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
            background: #f1f1f1;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
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
                    return this.cats.filter(cat => cat.status === this.filterStatus);
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
                            var color = 'green'; // Available / Healthy
                            if (cat.status === 'Pending') color = 'orange'; // Recovering
                            if (cat.status === 'Adopted') color = 'blue';
                            if (!['Available', 'Pending', 'Adopted'].includes(cat.status)) color = 'red';

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
                                <div class="text-center p-3 min-w-[150px]">
                                    <div class="w-16 h-16 rounded-full overflow-hidden mx-auto mb-3 border-2 border-[${this.getColorCode(color)}] shadow-sm">
                                        <img src="${cat.image || 'https://via.placeholder.com/150'}" class="w-full h-full object-cover">
                                    </div>
                                    <h3 class="font-serif font-bold text-lg text-gray-800 leading-tight mb-1">${cat.name}</h3>
                                    ${cat.gps_live ? '<span class="inline-block px-2 py-0.5 bg-red-100 text-red-600 text-[9px] font-bold uppercase rounded-full mb-2">🔴 LIVE GPS</span>' : ''}
                                    <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide text-white" style="background-color: ${this.getColorCode(color)}">${cat.status}</span>
                                    ${cat.gps_battery ? '<div class="text-xs text-gray-600 mt-1">🔋 Battery: ' + cat.gps_battery + '%</div>' : ''}
                                    <div class="text-xs text-gray-500 mt-1">${cat.gps_timestamp ? new Date(cat.gps_timestamp).toLocaleTimeString() : 'Unknown time'}</div>
                                    <div class="mt-3">
                                        <a href="/cats/${cat.id}" class="inline-block w-full py-1.5 bg-boho-brown hover:bg-boho-orange text-white text-xs font-bold rounded-lg transition-colors">View Profile</a>
                                    </div>
                                </div>
                            `;

                            marker.bindPopup(popupContent, {
                                closeButton: false,
                                className: 'rounded-xl shadow-xl border-none'
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