<x-admin-layout>

<!-- Header -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="font-jakarta text-3xl font-extrabold text-[#1C1A17] tracking-tight">Executive Dashboard</h1>
        <p class="text-sm text-[#A09890] mt-1">Welcome back, <span class="font-semibold text-[#6B6560]">{{ auth()->user()->name }}</span> &mdash; {{ now()->format('F d, Y') }}</p>
    </div>
    @if ($stats['upcoming_event'])
        @php
            $event    = $stats['upcoming_event'];
            $daysLeft = (int) now()->startOfDay()->diffInDays($event->event_date->startOfDay());
        @endphp
        <a href="{{ route('admin.events.index') }}"
           class="flex items-center gap-3 bg-white border border-[rgba(0,0,0,0.08)] rounded-2xl px-4 py-2.5 hover:border-[#C9A84C] transition-all group">
            <div class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(201,168,76,0.12)">
                <svg class="w-4 h-4 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] font-bold tracking-[0.1em] uppercase text-[#A09890]">Upcoming Event</p>
                <p class="text-sm font-bold text-[#1C1A17] truncate max-w-[180px] group-hover:text-[#C9A84C] transition-colors">{{ $event->title }}</p>
                <p class="text-[10px] text-[#A09890]">{{ $event->event_date->format('d M Y') }}</p>
            </div>
            <div class="shrink-0 text-right ml-1">
                <p class="font-jakarta text-2xl font-extrabold text-[#C9A84C] leading-none">{{ $daysLeft }}</p>
                <p class="text-[10px] text-[#A09890] mt-0.5">{{ $daysLeft === 1 ? 'day left' : 'days left' }}</p>
            </div>
        </a>
    @else
        <a href="{{ route('admin.events.index') }}"
           class="flex items-center gap-2 bg-white border border-[rgba(0,0,0,0.08)] rounded-2xl px-4 py-2.5 hover:border-[#C9A84C] transition-all">
            <svg class="w-4 h-4 text-[#A09890]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
            </svg>
            <span class="text-xs font-semibold text-[#A09890]">No upcoming events</span>
        </a>
    @endif
</div>

<!-- KPI Stats Row -->
<div class="grid grid-cols-4 gap-4 mb-6">

    @php
        $kpis = [
            ['label' => 'Total Cats',  'val' => $stats['total_cats'],           'sub' => 'In sanctuary',  'change' => $stats['cat_change'],      'spark' => 'sparkCats'],
            ['label' => 'Adoptions',   'val' => $stats['adoptions_this_month'], 'sub' => 'This month',    'change' => $stats['adoption_change'], 'spark' => 'sparkAdoptions'],
            ['label' => 'Members',     'val' => $stats['total_users'],          'sub' => 'Registered',    'change' => $stats['user_change'],     'spark' => 'sparkUsers'],
        ];
    @endphp

    @foreach ($kpis as $kpi)
    <div class="card-sm">
        <div class="flex items-start justify-between gap-2">
            <div class="flex-1 min-w-0">
                <p class="section-label mb-2">{{ $kpi['label'] }}</p>
                <p class="font-jakarta text-4xl font-extrabold text-[#1C1A17] leading-none">{{ number_format($kpi['val']) }}</p>
                @php $ch = $kpi['change']; @endphp
                <div class="flex items-center gap-1.5 mt-2.5">
                    <span class="text-[11px] font-bold {{ $ch >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                        {{ $ch >= 0 ? '↑' : '↓' }} {{ abs($ch) }}%
                    </span>
                    <span class="text-[10px] text-[#A09890]">vs last month</span>
                </div>
                <p class="text-[10px] text-[#A09890] mt-0.5">{{ $kpi['sub'] }}</p>
            </div>
            <canvas id="{{ $kpi['spark'] }}" width="76" height="40" class="shrink-0 mt-0.5"></canvas>
        </div>
    </div>
    @endforeach

    <!-- Donations – gold card -->
    <div class="card-gold">
        <div class="flex items-start justify-between gap-2">
            <div class="flex-1 min-w-0">
                <p class="text-[10px] font-bold tracking-[0.12em] uppercase text-white/70 mb-2">Donations</p>
                <p class="font-jakarta text-3xl font-extrabold text-white leading-none">RM&nbsp;{{ number_format($stats['total_donations']) }}</p>
                @php $dc = $stats['donation_change']; @endphp
                <div class="flex items-center gap-1.5 mt-2.5">
                    <span class="text-[11px] font-bold text-white/90">{{ $dc >= 0 ? '↑' : '↓' }} {{ abs($dc) }}%</span>
                    <span class="text-[10px] text-white/60">vs last month</span>
                </div>
                <p class="text-[10px] text-white/60 mt-0.5">Total raised</p>
            </div>
            <canvas id="sparkDonations" width="76" height="40" class="shrink-0 mt-0.5"></canvas>
        </div>
    </div>

</div>

<!-- Middle Row -->
<div class="grid grid-cols-3 gap-6 mb-6">

    <!-- Adoption & Intake Trends -->
    <div class="card">
        <div class="flex items-start justify-between mb-4">
            <div>
                <p class="section-label-muted">Adoption Trends</p>
                <p class="text-[11px] text-[#A09890] mt-0.5">Adoptions vs intake · last 6 months</p>
            </div>
            <a href="{{ route('admin.adoptions.index') }}" class="text-[#A09890] hover:text-[#C9A84C] transition-colors mt-0.5" title="View all adoptions">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>
        <div class="relative" style="height:150px">
            <canvas id="trendsChart"></canvas>
        </div>
    </div>

    <!-- By Pipeline Stage -->
    <div class="card">
        <div class="flex items-start justify-between mb-4">
            <div>
                <p class="section-label-muted">By Pipeline Stage</p>
                <p class="text-[11px] text-[#A09890] mt-0.5">Current adoption applications</p>
            </div>
        </div>
        <div class="relative" style="height:150px">
            <canvas id="stageChart"></canvas>
        </div>
    </div>

    <!-- Recent Incidents -->
    <div class="card flex flex-col">
        <div class="flex items-start justify-between mb-4">
            <div>
                <p class="section-label-muted">Recent Incidents</p>
                <p class="text-[11px] text-[#A09890] mt-0.5">Latest reports</p>
            </div>
            <a href="{{ route('admin.reports.index') }}"
               class="text-[10px] text-[#C9A84C] hover:text-[#b8932e] font-bold uppercase tracking-wide transition-colors whitespace-nowrap">View All →</a>
        </div>
        <div class="space-y-3 flex-1">
            @forelse ($stats['recent_reports'] as $i => $report)
                @php
                    $dot    = match($report->status) { 'Resolved' => 'bg-emerald-400', 'Pending' => 'bg-amber-400', default => 'bg-gray-300' };
                    $badge  = $report->status === 'Resolved' ? 'badge-green' : 'badge-gold';
                @endphp
                <div class="flex items-start gap-2.5">
                    <span class="text-[11px] font-bold text-[#A09890] w-4 shrink-0 mt-0.5">{{ $i + 1 }}</span>
                    <span class="w-1.5 h-1.5 rounded-full {{ $dot }} shrink-0 mt-1.5"></span>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-[#1C1A17] font-semibold leading-snug truncate">{{ $report->type }}</p>
                        <p class="text-[10px] text-[#A09890] mt-0.5 truncate">
                            {{ $report->user?->name ?? $report->reporter_name ?? '—' }} · {{ $report->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <span class="badge {{ $badge }} text-[9px] shrink-0">{{ $report->status }}</span>
                </div>
            @empty
                <p class="text-xs text-[#A09890] italic text-center py-6">No recent incidents.</p>
            @endforelse
        </div>
    </div>

</div>

<!-- Bottom Row -->
<div class="grid grid-cols-3 gap-6">

    <!-- Cats by Status -->
    <div class="card">
        <div class="flex items-start justify-between mb-4">
            <div>
                <p class="section-label-muted">Cats by Status</p>
                <p class="text-[11px] text-[#A09890] mt-0.5">Current sanctuary inventory</p>
            </div>
            <a href="{{ route('admin.cats.index') }}" class="text-[#A09890] hover:text-[#C9A84C] transition-colors mt-0.5" title="View cat directory">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>
        <div class="relative" style="height:150px">
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    <!-- Donations by Month (horizontal bar list) -->
    <div class="card">
        <div class="flex items-start justify-between mb-4">
            <div>
                <p class="section-label-muted">Donations by Month</p>
                <p class="text-[11px] text-[#A09890] mt-0.5">Last 6 months · RM</p>
            </div>
        </div>
        @php $dMax = max(array_merge($stats['monthly_donations'], [1])); @endphp
        <div class="space-y-3">
            @foreach ($stats['month_labels'] as $mi => $mLabel)
                @php
                    $dVal = $stats['monthly_donations'][$mi] ?? 0;
                    $dPct = $dMax > 0 ? ($dVal / $dMax * 100) : 0;
                @endphp
                <div class="flex items-center gap-3">
                    <span class="text-[11px] font-medium text-[#6B6560] w-7 shrink-0 text-right">{{ $mLabel }}</span>
                    <div class="flex-1 h-3.5 bg-[rgba(201,168,76,0.1)] rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500"
                             style="width:{{ $dPct }}%; background: linear-gradient(90deg, #C9A84C, #8B6914)"></div>
                    </div>
                    <span class="text-[11px] font-semibold text-[#1C1A17] w-16 shrink-0 text-right">
                        {{ $dVal > 0 ? 'RM '.number_format($dVal) : '—' }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Donors -->
    <div class="card flex flex-col">
        <div class="flex items-start justify-between mb-4">
            <div>
                <p class="section-label-muted">Recent Donors</p>
                <p class="text-[11px] text-[#A09890] mt-0.5">Latest contributions</p>
            </div>
            <a href="{{ route('admin.donations.index') }}"
               class="text-[10px] text-[#C9A84C] hover:text-[#b8932e] font-bold uppercase tracking-wide transition-colors whitespace-nowrap">View All →</a>
        </div>
        <div class="space-y-3 flex-1">
            @forelse ($stats['recent_donors'] as $i => $donation)
                <div class="flex items-center gap-3">
                    <span class="text-[11px] font-bold text-[#A09890] w-4 shrink-0">{{ $i + 1 }}</span>
                    <div class="w-7 h-7 rounded-full bg-[rgba(201,168,76,0.12)] flex items-center justify-center shrink-0">
                        <span class="text-[10px] font-bold text-[#C9A84C]">
                            {{ strtoupper(substr($donation->user?->name ?? 'A', 0, 1)) }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-[#1C1A17] truncate">{{ $donation->user?->name ?? 'Anonymous' }}</p>
                        <p class="text-[10px] text-[#A09890]">{{ $donation->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="text-xs font-bold text-[#C9A84C] shrink-0">RM&nbsp;{{ number_format($donation->amount) }}</span>
                </div>
            @empty
                <p class="text-xs text-[#A09890] italic text-center py-6">No donations yet.</p>
            @endforelse
        </div>
    </div>

</div>

<script>
// ── Sparklines ─────────────────────────────────────────────────────────────
function mkSpark(id, data, color) {
    const el = document.getElementById(id);
    if (!el) return;
    new Chart(el.getContext('2d'), {
        type: 'line',
        data: {
            labels: Array(data.length).fill(''),
            datasets: [{ data, borderColor: color, borderWidth: 1.8, pointRadius: 0, tension: 0.4, fill: false }]
        },
        options: {
            responsive: false, animation: false,
            plugins: { legend: { display: false }, tooltip: { enabled: false } },
            scales: { x: { display: false }, y: { display: false } }
        }
    });
}
mkSpark('sparkCats',      @json($stats['monthly_intake']),    '#C9A84C');
mkSpark('sparkAdoptions', @json($stats['monthly_adoptions']), '#C9A84C');
mkSpark('sparkUsers',     @json($stats['monthly_users']),     '#C9A84C');
mkSpark('sparkDonations', @json($stats['monthly_donations']), 'rgba(255,255,255,0.75)');

// ── Adoption & Intake Trends ────────────────────────────────────────────────
new Chart(document.getElementById('trendsChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: @json($stats['month_labels']),
        datasets: [
            {
                label: 'Adoptions',
                data: @json($stats['monthly_adoptions']),
                borderColor: '#C9A84C', backgroundColor: 'rgba(201,168,76,0.08)',
                fill: true, tension: 0.4, borderWidth: 2.5, pointRadius: 3, pointBackgroundColor: '#C9A84C',
            },
            {
                label: 'Intake',
                data: @json($stats['monthly_intake']),
                borderColor: '#8B6914', backgroundColor: 'rgba(139,105,20,0.06)',
                fill: true, tension: 0.4, borderWidth: 2.5, pointRadius: 3, pointBackgroundColor: '#8B6914',
            }
        ]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: {
            legend: { display: true, position: 'bottom', labels: { usePointStyle: true, padding: 10, font: { size: 10, family: 'Lato' } } }
        },
        scales: {
            y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { size: 10 }, maxTicksLimit: 5 } },
            x: { grid: { display: false }, ticks: { font: { size: 10 } } }
        }
    }
});

// ── Pipeline Stage Bar ──────────────────────────────────────────────────────
@php
    $stageLabels    = array_keys($stats['adoptions_by_stage']);
    $stageCounts    = array_values($stats['adoptions_by_stage']);
    $stageColors    = ['#E8CE92', '#DDB96A', '#C9A84C', '#A07830', '#8B6914'];
@endphp
new Chart(document.getElementById('stageChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: @json($stageLabels),
        datasets: [{
            data: @json($stageCounts),
            backgroundColor: @json($stageColors),
            borderRadius: 5,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { stepSize: 1, font: { size: 10 }, maxTicksLimit: 5 } },
            x: { grid: { display: false }, ticks: { font: { size: 9 } } }
        }
    }
});

// ── Cats by Status Bar ──────────────────────────────────────────────────────
@php
    $statusLabels = collect($stats['cats_by_status'])->keys()->map(fn($s) => ucfirst(str_replace('_', ' ', $s)))->toArray();
    $statusCounts = array_values($stats['cats_by_status']);
    $allColors    = ['#C9A84C', '#8B6914', '#DDB96A', '#A07830', '#E8CE92', '#6B4C10'];
    $statusColors = array_map(fn($i) => $allColors[$i % count($allColors)], range(0, max(0, count($statusLabels) - 1)));
@endphp
new Chart(document.getElementById('statusChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: @json($statusLabels),
        datasets: [{
            data: @json($statusCounts),
            backgroundColor: @json($statusColors),
            borderRadius: 5,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { stepSize: 1, font: { size: 10 }, maxTicksLimit: 5 } },
            x: { grid: { display: false }, ticks: { font: { size: 9 } } }
        }
    }
});
</script>

</x-admin-layout>
