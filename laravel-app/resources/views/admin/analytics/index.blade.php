<x-admin-layout>

<!-- Page Header -->
<div class="mb-6 flex items-start justify-between">
    <div>
        <h1 class="text-3xl font-cabinet font-bold text-gray-800">Hello, {{ auth()->user()->name }}</h1>
        <p class="text-sm text-gray-400 mt-1">Strategic insights for the feline sanctuary</p>
    </div>
    <div class="flex items-center gap-3">
        <button onclick="window.print()"
                class="flex items-center gap-2 px-4 py-2 rounded-full border border-amber-200 text-[#C9A84C] text-sm font-medium hover:bg-[#FAF8F0] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
            </svg>
            Download Report
        </button>
        <a href="{{ route('admin.analytics.index') }}"
           class="flex items-center gap-2 px-4 py-2 rounded-full bg-[#C9A84C] text-white text-sm font-medium hover:bg-[#b8963e] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            New Custom Report
        </a>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-2xl border border-[#E8E2D8] shadow-sm px-5 py-4 mb-6 flex flex-wrap items-center gap-4">
    <div class="flex flex-col gap-1 min-w-[160px]">
        <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold">Report Type</label>
        <select class="text-sm text-gray-700 bg-[#FAF6F0] border border-[#E8E2D8] rounded-lg px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-[#C9A84C]">
            <option>Adoption Summary</option>
            <option>Donation Summary</option>
            <option>Population Report</option>
            <option>Incident Report</option>
        </select>
    </div>
    <div class="flex flex-col gap-1">
        <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold">Start Date</label>
        <input type="date" class="text-sm text-gray-700 bg-[#FAF6F0] border border-[#E8E2D8] rounded-lg px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-[#C9A84C]">
    </div>
    <div class="flex flex-col gap-1">
        <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold">End Date</label>
        <input type="date" class="text-sm text-gray-700 bg-[#FAF6F0] border border-[#E8E2D8] rounded-lg px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-[#C9A84C]">
    </div>
    <div class="flex flex-col gap-1 min-w-[140px]">
        <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold">Analysis Status</label>
        <select class="text-sm text-gray-700 bg-[#FAF6F0] border border-[#E8E2D8] rounded-lg px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-[#C9A84C]">
            <option>All Statuses</option>
            <option>Approved</option>
            <option>Pending</option>
            <option>Rejected</option>
        </select>
    </div>
    <div class="flex flex-col justify-end pt-4">
        <button class="px-4 py-1.5 rounded-lg bg-[#FAF8F0]0 text-white text-sm font-medium hover:bg-[#C9A84C] transition">
            Apply
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-[#E8E2D8]">
        <p class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold mb-2">Total Records</p>
        <div class="flex items-end gap-2">
            <p class="text-4xl font-bold text-gray-800">{{ number_format($totalRecords) }}</p>
            <span class="text-xs text-green-500 font-semibold mb-1">+3%</span>
        </div>
        <p class="text-xs text-gray-400 mt-1">Cats in the system</p>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-[#E8E2D8]">
        <p class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold mb-2">Total Adoptions</p>
        <p class="text-4xl font-bold text-gray-800">{{ number_format($totalAdoptions) }}</p>
        <p class="text-xs text-gray-400 mt-1">Active approved</p>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-[#E8E2D8]">
        <p class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold mb-2">Donations YTD</p>
        <p class="text-4xl font-bold text-gray-800">{{ number_format($donationsYtd) }}</p>
        <p class="text-xs text-gray-400 mt-1">RM this year</p>
    </div>
    <div class="bg-[#C9A84C] rounded-2xl p-5 shadow-sm">
        <p class="text-[10px] tracking-widest text-[#E8D5A0] uppercase font-semibold mb-2">Effectiveness</p>
        <p class="text-4xl font-bold text-white">{{ $effectiveness }}%</p>
        <p class="text-xs text-amber-300 mt-1">Target: 90%</p>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-3 gap-6 mb-6">
    <!-- Monthly Adoption Trends (bar) -->
    <div class="col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-[#E8E2D8]">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-xs font-semibold text-gray-700 tracking-widest uppercase">Monthly Adoption Trends</p>
                <p class="text-[11px] text-gray-400 mt-0.5">Showing adoption data for the past 7 months</p>
            </div>
            <div class="flex gap-1">
                <button class="w-2.5 h-2.5 rounded-full bg-[#FAF8F0]0"></button>
                <button class="w-2.5 h-2.5 rounded-full bg-amber-200"></button>
            </div>
        </div>
        <canvas id="adoptionBar" height="110"></canvas>
    </div>

    <!-- Population Status (donut) -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#E8E2D8] flex flex-col">
        <p class="text-xs font-semibold text-gray-700 tracking-widest uppercase mb-1">Population Status</p>
        <p class="text-[11px] text-gray-400 mb-4">Current distribution by status</p>
        <div class="flex-1 flex items-center justify-center">
            <canvas id="populationDonut" width="160" height="160"></canvas>
        </div>
        <div class="mt-4 space-y-2">
            <div class="flex items-center justify-between text-xs">
                <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block"></span>Available</span>
                <span class="font-semibold text-gray-700">{{ $available }}</span>
            </div>
            <div class="flex items-center justify-between text-xs">
                <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-teal-400 inline-block"></span>Adopted</span>
                <span class="font-semibold text-gray-700">{{ $adopted }}</span>
            </div>
            <div class="flex items-center justify-between text-xs">
                <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-gray-300 inline-block"></span>In Treatment</span>
                <span class="font-semibold text-gray-700">{{ $treatment }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Second Charts Row -->
<div class="grid grid-cols-2 gap-6 mb-6">
    <!-- Incident Heatmap placeholder -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#E8E2D8]">
        <p class="text-xs font-semibold text-gray-700 tracking-widest uppercase mb-1">Rescued Incident Heatmap</p>
        <p class="text-[11px] text-gray-400 mb-5">Concentration of rescue activity incidents</p>
        <div id="heatmap" class="grid gap-1" style="grid-template-columns: repeat(13, 1fr);">
            @php
                $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec',''];
                $days   = 7;
                $max    = 8;
            @endphp
            @foreach($months as $m)
                <div class="text-[9px] text-gray-400 text-center pb-1">{{ $m }}</div>
            @endforeach
            @for($d = 0; $d < $days; $d++)
                @for($w = 0; $w < 13; $w++)
                    @php
                        $intensity = rand(0, $max);
                        $bg = match(true) {
                            $intensity === 0 => 'bg-[#FAF8F0]',
                            $intensity <= 2  => 'bg-[#F5EDD8]',
                            $intensity <= 4  => 'bg-amber-200',
                            $intensity <= 6  => 'bg-amber-400',
                            default          => 'bg-[#C9A84C]',
                        };
                    @endphp
                    <div class="h-4 rounded-sm {{ $bg }}" title="{{ $intensity }} incidents"></div>
                @endfor
            @endfor
        </div>
        <div class="flex items-center gap-2 mt-3">
            <span class="text-[10px] text-gray-400">Less</span>
            <div class="flex gap-1">
                <div class="w-3 h-3 rounded-sm bg-[#FAF8F0] border border-[#E8E2D8]"></div>
                <div class="w-3 h-3 rounded-sm bg-[#F5EDD8]"></div>
                <div class="w-3 h-3 rounded-sm bg-amber-200"></div>
                <div class="w-3 h-3 rounded-sm bg-amber-400"></div>
                <div class="w-3 h-3 rounded-sm bg-[#C9A84C]"></div>
            </div>
            <span class="text-[10px] text-gray-400">More</span>
        </div>
    </div>

    <!-- Donation Growth (line) -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#E8E2D8]">
        <div class="flex items-center justify-between mb-1">
            <p class="text-xs font-semibold text-gray-700 tracking-widest uppercase">Donation Growth</p>
            <span class="text-[10px] text-[#C9A84C] font-semibold bg-[#FAF8F0] px-2 py-0.5 rounded-full">+{{ round(($monthlyDonations[6] - $monthlyDonations[0]) > 0 ? (($monthlyDonations[6] - $monthlyDonations[0]) / max($monthlyDonations[0], 1) * 100) : 0) }}% vs prior</span>
        </div>
        <p class="text-[11px] text-gray-400 mb-5">Monthly donation amount trend</p>
        <canvas id="donationLine" height="130"></canvas>
    </div>
</div>

<!-- Activity Log Table -->
<div class="bg-white rounded-2xl shadow-sm border border-[#E8E2D8] overflow-hidden">
    <div class="px-6 py-4 border-b border-[#E8E2D8] flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-gray-700 tracking-widest uppercase">Detailed Activity Log</p>
            <p class="text-[11px] text-gray-400 mt-0.5">Aggregated actions for the current time set</p>
        </div>
        <button class="text-gray-400 hover:text-gray-600">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/></svg>
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#F0EBE3]">
                    <th class="px-6 py-3 text-left text-[10px] tracking-widest text-gray-400 uppercase font-semibold">Reference</th>
                    <th class="px-4 py-3 text-left text-[10px] tracking-widest text-gray-400 uppercase font-semibold">Date</th>
                    <th class="px-4 py-3 text-left text-[10px] tracking-widest text-gray-400 uppercase font-semibold">Category</th>
                    <th class="px-4 py-3 text-left text-[10px] tracking-widest text-gray-400 uppercase font-semibold">Details</th>
                    <th class="px-4 py-3 text-left text-[10px] tracking-widest text-gray-400 uppercase font-semibold">Fund</th>
                    <th class="px-4 py-3 text-left text-[10px] tracking-widest text-gray-400 uppercase font-semibold">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#F0EBE3]">
                @forelse($activityLog as $adoption)
                    @php
                        $statusColor = match($adoption->status) {
                            'Approved'  => 'bg-green-100 text-green-700',
                            'Pending'   => 'bg-[#F5EDD8] text-[#C9A84C]',
                            'Rejected'  => 'bg-red-100 text-red-700',
                            default     => 'bg-gray-100 text-gray-600',
                        };
                    @endphp
                    <tr class="hover:bg-[#FAF8F0] transition">
                        <td class="px-6 py-3 font-mono text-xs text-gray-500">#ADO-{{ str_pad($adoption->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-4 py-3 text-xs text-gray-500">{{ $adoption->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs bg-blue-50 text-blue-600 font-semibold px-2 py-0.5 rounded-full">Adoption</span>
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-600 max-w-[200px] truncate">
                            {{ $adoption->cat?->name ?? 'Unknown Cat' }} — {{ Str::limit($adoption->user?->name ?? 'Unknown', 20) }}
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-500">N/A</td>
                        <td class="px-4 py-3">
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $statusColor }}">
                                {{ $adoption->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-400 italic font-cabinet">No activity recorded yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-3 border-t border-[#F0EBE3] text-[11px] text-gray-400">
        Showing {{ $activityLog->count() }} of latest entries
    </div>
</div>

<script>
const labels = @json($monthlyLabels);
const adoptions = @json($monthlyAdoptions);
const donations = @json($monthlyDonations);

// Bar chart — Monthly Adoptions
new Chart(document.getElementById('adoptionBar').getContext('2d'), {
    type: 'bar',
    data: {
        labels,
        datasets: [{
            label: 'Adoptions',
            data: adoptions,
            backgroundColor: labels.map((_, i) =>
                i === labels.length - 1 ? '#b45309' : 'rgba(217,119,6,0.25)'
            ),
            borderRadius: 6,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, grid: { color: '#fef3c7' }, ticks: { font: { size: 11 } } },
            x: { grid: { display: false }, ticks: { font: { size: 11 } } }
        }
    }
});

// Donut chart — Population Status
const total = {{ $available + $adopted + $treatment }} || 1;
new Chart(document.getElementById('populationDonut').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: ['Available', 'Adopted', 'In Treatment'],
        datasets: [{
            data: [{{ $available }}, {{ $adopted }}, {{ $treatment }}],
            backgroundColor: ['#fbbf24', '#2dd4bf', '#d1d5db'],
            borderWidth: 0,
            hoverOffset: 4,
        }]
    },
    options: {
        cutout: '70%',
        plugins: {
            legend: { display: false },
            tooltip: { callbacks: {
                label: ctx => ` ${ctx.label}: ${ctx.raw} (${Math.round(ctx.raw / total * 100)}%)`
            }}
        }
    },
    plugins: [{
        id: 'centerText',
        beforeDraw(chart) {
            const { ctx, chartArea: { left, top, width, height } } = chart;
            ctx.save();
            ctx.font = 'bold 22px Lato, sans-serif';
            ctx.fillStyle = '#1f2937';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText('100%', left + width / 2, top + height / 2);
            ctx.restore();
        }
    }]
});

// Line chart — Donation Growth
new Chart(document.getElementById('donationLine').getContext('2d'), {
    type: 'line',
    data: {
        labels,
        datasets: [{
            label: 'Donations (RM)',
            data: donations,
            borderColor: '#b45309',
            backgroundColor: 'rgba(180,83,9,0.07)',
            fill: true,
            tension: 0.45,
            borderWidth: 2.5,
            pointRadius: 3,
            pointBackgroundColor: '#b45309',
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, grid: { color: '#fef3c7' }, ticks: { font: { size: 11 } } },
            x: { grid: { display: false }, ticks: { font: { size: 11 } } }
        }
    }
});
</script>

</x-admin-layout>
