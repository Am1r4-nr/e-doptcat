<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }
</style>

<div class="bg-cozy-bg min-h-screen pt-28 pb-20 relative overflow-hidden flex flex-col justify-center">
    <!-- Decorative Ambient Blobs -->
    <div class="absolute top-0 right-0 w-80 h-80 bg-cozy-warm/40 blob opacity-60 translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-cozy-accent/15 blob opacity-40 -translate-x-1/3 translate-y-1/3 pointer-events-none" style="animation-delay:-3s;"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
        <!-- Header -->
        <div class="text-center pb-8 flex-shrink-0">
            <p class="font-script text-3xl text-cozy-accent mb-1">Stray Rescue Sighting</p>
            <h2 class="font-serif font-bold text-4xl md:text-5xl text-cozy-brown mb-4">
                {{ __('Report an Incident') }}
            </h2>
            <div class="w-20 h-1 bg-cozy-accent/60 mx-auto rounded-full mb-4"></div>
            <p class="text-cozy-brown/60 max-w-md mx-auto text-base">
                Spotted a stray cat in distress, injured, or missing? File a report so our community responders can assist immediately.
            </p>
        </div>

        <div class="bg-cozy-card overflow-hidden shadow-xl rounded-[2.5rem] p-8 border border-cozy-warm/40 max-w-xl mx-auto">
            <form method="POST" action="{{ route('reports.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-cozy-brown text-xs font-bold mb-2 uppercase tracking-wider">Report Type</label>
                    <div class="relative">
                        <select name="type"
                            class="w-full appearance-none py-3.5 px-5 rounded-2xl border-0 bg-cozy-light text-cozy-brown font-medium focus:ring-2 focus:ring-cozy-accent cursor-pointer text-sm">
                            <option value="Injury">🏥 Injured Cat</option>
                            <option value="Missing">🔍 Missing Cat</option>
                            <option value="Stray">🐈 Stray Sighting</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-cozy-brown/50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-cozy-brown text-xs font-bold mb-2 uppercase tracking-wider">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full py-3.5 px-5 rounded-2xl border-0 bg-cozy-light text-cozy-brown font-medium focus:ring-2 focus:ring-cozy-accent text-sm placeholder-cozy-brown/30"
                        placeholder="Please describe the cat's condition, colors, temperament, or immediate surroundings..."
                        required></textarea>
                </div>

                <div>
                    <label class="block text-cozy-brown text-xs font-bold mb-2 uppercase tracking-wider">Location (Drag marker or click to select)</label>
                    <div id="report-map" class="h-56 w-full rounded-2xl mb-3 border border-cozy-warm/30 overflow-hidden shadow-inner bg-cozy-light z-0"></div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-cozy-brown/40 text-xs font-bold">📍</span>
                        <input type="text" id="location-input" name="location" readonly
                            class="w-full pl-10 pr-4 py-3.5 rounded-2xl border-0 bg-cozy-light text-cozy-brown font-bold text-xs focus:ring-0 cursor-not-allowed placeholder-cozy-brown/30"
                            placeholder="Selected coordinates will appear here...">
                    </div>
                </div>

                <div>
                    <label class="block text-cozy-brown text-xs font-bold mb-2 uppercase tracking-wider font-semibold">Incident Photograph (Optional)</label>
                    <div class="bg-cozy-light rounded-2xl p-4 border border-dashed border-cozy-warm/50 text-center hover:border-cozy-accent transition-colors relative cursor-pointer group">
                        <input type="file" name="photo" id="report-photo-input"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="flex flex-col items-center justify-center gap-1">
                            <span class="text-2xl group-hover:scale-110 transition-transform">📸</span>
                            <span class="text-xs font-bold text-cozy-brown/70">Upload image</span>
                            <span class="text-[10px] text-cozy-brown/40">PNG, JPG or JPEG files</span>
                        </div>
                    </div>
                </div>

                <button id="btn-submit-report"
                    class="w-full bg-cozy-brown hover:bg-cozy-accent text-cozy-light hover:text-cozy-brown font-bold py-4 px-6 rounded-2xl shadow-md transition-all uppercase tracking-wider text-xs"
                    type="submit">
                    🚨 Submit Emergency Report
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Default: KL City Centre
        var lat = 3.140853;
        var lng = 101.693207;

        var map = L.map('report-map', {
            zoomControl: false
        }).setView([lat, lng], 13);
        
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([lat, lng], { draggable: true }).addTo(map);

        // Try HTML5 Geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                lat = position.coords.latitude;
                lng = position.coords.longitude;
                map.setView([lat, lng], 15);
                marker.setLatLng([lat, lng]);
                document.getElementById('location-input').value = lat.toFixed(6) + ', ' + lng.toFixed(6);
            });
        }

        // Update input on drag
        marker.on('dragend', function (event) {
            var position = marker.getLatLng();
            document.getElementById('location-input').value = position.lat.toFixed(6) + ', ' + position.lng.toFixed(6);
        });

        // Update marker on click
        map.on('click', function (e) {
            marker.setLatLng(e.latlng);
            document.getElementById('location-input').value = e.latlng.lat.toFixed(6) + ', ' + e.latlng.lng.toFixed(6);
        });
    });
</script>
</x-app-layout>