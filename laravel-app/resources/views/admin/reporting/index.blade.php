<x-admin-layout>

<!-- Page Header -->
<div class="mb-6 flex items-start justify-between">
    <div>
        <h1 class="text-3xl font-cabinet font-semibold text-gray-800">Reporting Hub</h1>
        <p class="text-sm text-gray-400 mt-1">Review and manage sanctuary reports</p>
    </div>
</div>

<!-- Lost & Found Reports -->
<div class="bg-white rounded-2xl shadow-sm border border-[#E8E2D8] overflow-hidden mt-6">
    <div class="px-6 py-4 border-b border-[#E8E2D8] flex items-center justify-between">
        <div>
            <p class="text-base font-semibold text-gray-800">Lost &amp; Found Reports</p>
            <p class="text-xs text-gray-400 mt-0.5">Review and manage lost and found cat reports</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="px-6 py-3 border-b border-[#F0EBE3] flex items-center gap-3">
        <select id="lfFilter"
                class="text-sm text-gray-600 bg-[#FAF6F0] border border-gray-200 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-[#C9A84C] min-w-[130px]">
            <option value="">All Reports</option>
            <option value="Lost">Lost</option>
            <option value="Found">Found</option>
        </select>
        <input id="lfSearch" type="text" placeholder="Search by name, location..."
               class="flex-1 max-w-sm text-sm bg-gray-50 border border-gray-200 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-400">
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm" id="lfTable">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500">Type</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Cat Name/Description</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Reporter</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Location</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Date Reported</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Status</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50" id="lfBody">
                @forelse($lostFoundReports as $r)
                    @php
                        $isLost     = strtolower($r->type) === 'lost';
                        $isResolved = $r->status === 'Resolved';
                        $reporter   = $r->user?->name ?? $r->reporter_name ?? 'Unknown';
                        $contact    = $r->user?->email ?? $r->reporter_contact ?? '';
                    @endphp
                    <tr class="hover:bg-gray-50 transition lf-row"
                        data-type="{{ $r->type }}"
                        data-search="{{ strtolower($r->description . ' ' . $r->location . ' ' . $reporter) }}">
                        <td class="px-6 py-3.5">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full text-white {{ $isLost ? 'bg-red-500' : 'bg-green-500' }}">
                                {{ $r->type }}
                            </span>
                        </td>
                        <td class="px-4 py-3.5">
                            <p class="font-semibold text-gray-800 text-sm">{{ Str::title(explode(',', $r->description)[0] ?? 'Unknown') }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ Str::limit($r->description, 35) }}</p>
                        </td>
                        <td class="px-4 py-3.5">
                            <p class="font-semibold text-gray-800 text-sm">{{ $reporter }}</p>
                            <p class="text-xs text-[#C9A84C] mt-0.5">{{ $contact }}</p>
                        </td>
                        <td class="px-4 py-3.5 text-sm text-gray-600">{{ $r->location ?? '—' }}</td>
                        <td class="px-4 py-3.5 text-sm text-[#C9A84C] whitespace-nowrap">{{ $r->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3.5">
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full border {{ $isResolved ? 'border-gray-300 text-gray-500 bg-gray-50' : 'border-gray-300 text-gray-600 bg-white' }}">
                                {{ $isResolved ? 'Resolved' : 'Active' }}
                            </span>
                        </td>
                        <td class="px-4 py-3.5">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.reports.show', $r) }}"
                                   class="text-xs font-medium px-3 py-1.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition whitespace-nowrap">
                                    View Details
                                </a>
                                @if(!$isResolved)
                                    <form method="POST" action="{{ route('admin.reports.status', $r) }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="Resolved">
                                        <button type="submit"
                                                class="text-xs font-medium px-3 py-1.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition whitespace-nowrap">
                                            Mark Resolved
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-sm text-gray-400 italic font-cabinet">
                            No lost or found reports yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Live Map -->
<div class="mt-6 mb-6 bg-white rounded-2xl shadow-sm border border-[#E8E2D8] overflow-hidden">
    <div class="px-6 py-4 border-b border-[#E8E2D8]">
        <p class="text-base font-semibold text-gray-800">Live Map</p>
        <p class="text-xs text-gray-400 mt-0.5">Real-time GPS locations of sanctuary cats</p>
    </div>
    <div class="flex" style="height: 480px;">
        <!-- Map -->
        <div class="flex-1 relative">
            <div id="liveMap" class="w-full h-full"></div>
            <!-- Find Me button -->
            <button onclick="locateMe()"
                    class="absolute top-3 right-3 z-[999] flex items-center gap-1.5 bg-white border border-gray-200 text-xs font-medium text-gray-600 px-3 py-1.5 rounded-lg shadow-sm hover:bg-gray-50 transition">
                <svg class="w-3.5 h-3.5 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                </svg>
                Find Me
            </button>
            <!-- Legend -->
            <div class="absolute bottom-4 left-3 z-[999] bg-white border border-gray-200 rounded-xl px-4 py-3 shadow-sm text-xs space-y-1.5">
                <p class="font-semibold text-gray-600 uppercase tracking-widest text-[10px] mb-2">Status Legend</p>
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-green-500 inline-block"></span>Healthy</div>
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-orange-400 inline-block"></span>Recovering</div>
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-red-500 inline-block"></span>Attention Needed</div>
            </div>
        </div>

        <!-- Cat List Sidebar -->
        <div class="w-72 flex-shrink-0 border-l border-[#E8E2D8] flex flex-col">
            <!-- Header + Filter -->
            <div class="px-4 py-3 border-b border-[#F0EBE3] space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex gap-1">
                        <button id="btnList" onclick="setView('list')"
                                class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#FAF8F0]0 text-white transition">
                            List
                        </button>
                        <button id="btnScanner" onclick="setView('scanner')"
                                class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-gray-200 transition">
                            Scanner
                        </button>
                    </div>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold mb-1">Filter Cats</p>
                    <select id="mapFilter" onchange="filterMapCats()"
                            class="w-full text-sm text-gray-600 bg-[#FAF6F0] border border-[#E8E2D8] rounded-lg px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-[#C9A84C]">
                        <option value="">All Statuses</option>
                        <option value="Healthy">Healthy</option>
                        <option value="Recovering">Recovering</option>
                        <option value="Attention Needed">Attention Needed</option>
                    </select>
                    <p class="text-[11px] text-gray-400 mt-1.5" id="mapCatCount">Showing {{ $catsWithGps->count() }} cats</p>
                </div>
            </div>

            <!-- Cat list -->
            <div class="flex-1 overflow-y-auto divide-y divide-[#F0EBE3]" id="mapCatList">
                @forelse($catsWithGps as $cat)
                    @php
                        $dot = match($cat->health_status ?? 'Healthy') {
                            'Recovering'       => 'bg-orange-400',
                            'Attention Needed' => 'bg-red-500',
                            default            => 'bg-green-500',
                        };
                    @endphp
                    <div class="flex items-center gap-3 px-4 py-3 hover:bg-[#FAF8F0] cursor-pointer transition map-cat-item"
                         data-health="{{ $cat->health_status ?? 'Healthy' }}"
                         data-lat="{{ $cat->gps_lat }}"
                         data-lng="{{ $cat->gps_lng }}"
                         onclick="focusCat({{ $cat->gps_lat }}, {{ $cat->gps_lng }})">
                        @if($cat->image)
                            <img src="{{ Storage::url($cat->image) }}" alt="{{ $cat->name }}"
                                 class="w-10 h-10 rounded-full object-cover flex-shrink-0 ring-2 ring-amber-100">
                        @else
                            <div class="w-10 h-10 rounded-full bg-[#F5EDD8] flex items-center justify-center flex-shrink-0 ring-2 ring-amber-100">
                                <svg class="w-5 h-5 text-[#C9A84C]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21c-3.87 0-7-1.57-7-4.5 0-1.5 1-2.8 2.5-3.6.6-.3 1.3-.5 2-.6.8-.1 1.6-.3 2.5-.3s1.7.2 2.5.3c.7.1 1.4.3 2 .6 1.5.8 2.5 2.1 2.5 3.6 0 2.93-3.13 4.5-7 4.5z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 truncate">{{ $cat->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ $cat->breed }}</p>
                            <div class="flex items-center gap-1 mt-0.5">
                                <span class="w-2 h-2 rounded-full {{ $dot }} inline-block"></span>
                                <span class="text-[10px] text-gray-500">{{ $cat->location_name ?? now()->format('M d, g:i A') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-4 py-8 text-center text-sm text-gray-400 italic font-cabinet">
                        No cats with GPS data.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>

// ---------- Lost & Found filter ----------
document.getElementById('lfFilter').addEventListener('change', filterLF);
document.getElementById('lfSearch').addEventListener('input', filterLF);

function filterLF() {
    const type   = document.getElementById('lfFilter').value.toLowerCase();
    const search = document.getElementById('lfSearch').value.toLowerCase();
    document.querySelectorAll('.lf-row').forEach(row => {
        const matchType   = !type   || row.dataset.type.toLowerCase() === type;
        const matchSearch = !search || row.dataset.search.includes(search);
        row.style.display = matchType && matchSearch ? '' : 'none';
    });
}

// ---------- Live Map (Leaflet) ----------
const cats = @json($catsWithGps);

// Only init map if container exists
const mapEl = document.getElementById('liveMap');
let map, markers = [];

if (mapEl && cats.length > 0) {
    // Load Leaflet dynamically
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
    document.head.appendChild(link);

    const script = document.createElement('script');
    script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
    script.onload = initMap;
    document.head.appendChild(script);
} else if (mapEl) {
    mapEl.innerHTML = '<div class="flex items-center justify-center h-full text-sm text-gray-400 italic font-cabinet">No GPS data available for cats yet.</div>';
}

function colorFor(health) {
    if (health === 'Recovering')       return '#fb923c';
    if (health === 'Attention Needed') return '#ef4444';
    return '#22c55e';
}

function initMap() {
    const center = cats.length
        ? [parseFloat(cats[0].gps_lat), parseFloat(cats[0].gps_lng)]
        : [3.139, 101.687];

    map = L.map('liveMap', { zoomControl: false }).setView(center, 14);
    L.control.zoom({ position: 'bottomright' }).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap',
        maxZoom: 19,
    }).addTo(map);

    cats.forEach(cat => {
        const lat    = parseFloat(cat.gps_lat);
        const lng    = parseFloat(cat.gps_lng);
        const color  = colorFor(cat.health_status);
        const icon   = L.divIcon({
            className: '',
            html: `<div style="width:14px;height:14px;border-radius:50%;background:${color};border:2.5px solid white;box-shadow:0 1px 4px rgba(0,0,0,.3)"></div>`,
            iconSize: [14, 14],
            iconAnchor: [7, 7],
        });
        const m = L.marker([lat, lng], { icon })
            .addTo(map)
            .bindPopup(`<strong>${cat.name}</strong><br>${cat.breed ?? ''}<br><span style="color:#6b7280;font-size:11px">${cat.health_status ?? 'Healthy'}</span>`);
        m.catHealth = cat.health_status ?? 'Healthy';
        markers.push(m);
    });
}

function focusCat(lat, lng) {
    if (!map) return;
    map.setView([lat, lng], 16);
}

function locateMe() {
    if (!map || !navigator.geolocation) return;
    navigator.geolocation.getCurrentPosition(pos => {
        map.setView([pos.coords.latitude, pos.coords.longitude], 15);
        L.circleMarker([pos.coords.latitude, pos.coords.longitude], {
            radius: 8, color: '#d97706', fillColor: '#f59e0b', fillOpacity: 0.8
        }).addTo(map).bindPopup('You are here').openPopup();
    });
}

function filterMapCats() {
    const val   = document.getElementById('mapFilter').value;
    const items = document.querySelectorAll('.map-cat-item');
    let shown   = 0;
    items.forEach(item => {
        const match = !val || item.dataset.health === val;
        item.style.display = match ? '' : 'none';
        if (match) shown++;
    });
    document.getElementById('mapCatCount').textContent = `Showing ${shown} cats`;
    if (map) {
        markers.forEach(m => {
            const match = !val || m.catHealth === val;
            match ? map.addLayer(m) : map.removeLayer(m);
        });
    }
}

function setView(v) {
    document.getElementById('btnList').className    = v === 'list'    ? 'px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#FAF8F0]0 text-white transition' : 'px-3 py-1.5 rounded-lg text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-gray-200 transition';
    document.getElementById('btnScanner').className = v === 'scanner' ? 'px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#FAF8F0]0 text-white transition' : 'px-3 py-1.5 rounded-lg text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-gray-200 transition';
}
</script>

</x-admin-layout>
