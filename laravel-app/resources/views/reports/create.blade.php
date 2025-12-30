<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-boho-brown leading-tight">
            {{ __('Report an Issue') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('reports.store') }}" enctype="multipart/form-data"
                    class="max-w-lg mx-auto">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Report Type</label>
                        <select name="type"
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="Injury">Injured Cat</option>
                            <option value="Missing">Missing Cat</option>
                            <option value="Stray">Stray Sighting</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                        <textarea name="description" rows="4"
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Location (Click Map to Select)</label>
                        <div id="report-map" class="h-64 w-full rounded mb-2 border"></div>
                        <input type="text" id="location-input" name="location" readonly
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline placeholder-gray-400"
                            placeholder="Selected coordinates will appear here...">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Photo</label>
                        <input type="file" name="photo"
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <button
                        class="bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full"
                        type="submit">
                        Submit Report
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

            // Try HTML5 Geolocation
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    lat = position.coords.latitude;
                    lng = position.coords.longitude;
                    map.setView([lat, lng], 15);
                    marker.setLatLng([lat, lng]);
                    document.getElementById('location-input').value = lat + ', ' + lng;
                });
            }

            var map = L.map('report-map').setView([lat, lng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([lat, lng], { draggable: true }).addTo(map);

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