<x-admin-layout>

<!-- Page Header -->
<div class="mb-8">
    <h1 class="font-jakarta text-3xl font-extrabold text-[#1C1A17] tracking-tight">Dashboard</h1>
    <p class="text-sm text-[#A09890] mt-1">Welcome back, <span class="font-semibold text-[#6B6560]">{{ auth()->user()->name }}</span> &mdash; {{ now()->format('l, F d, Y') }}</p>
</div>

<!-- Stats Row -->
<div class="grid grid-cols-4 gap-4 mb-8">
    <div class="card-sm">
        <p class="section-label mb-2">Total Cats</p>
        <p class="font-jakarta text-4xl font-extrabold text-[#1C1A17] leading-none">{{ $stats['total_cats'] ?? 0 }}</p>
        <p class="text-xs text-[#A09890] mt-1.5">In the system</p>
    </div>
    <div class="card-sm">
        <p class="section-label mb-2">Adoptions</p>
        <p class="font-jakarta text-4xl font-extrabold text-[#1C1A17] leading-none">{{ $stats['adoptions_this_month'] ?? 0 }}</p>
        <p class="text-xs text-[#A09890] mt-1.5">This month</p>
    </div>
    <div class="card-sm">
        <p class="section-label mb-2">Users</p>
        <p class="font-jakarta text-4xl font-extrabold text-[#1C1A17] leading-none">{{ $stats['total_users'] ?? 0 }}</p>
        <p class="text-xs text-[#A09890] mt-1.5">Registered members</p>
    </div>
    <div class="card-gold">
        <p class="text-[10px] font-bold tracking-[0.12em] uppercase text-white/70 mb-2">Donations</p>
        <p class="font-jakarta text-4xl font-extrabold text-white leading-none">RM {{ number_format($stats['total_donations'] ?? 0) }}</p>
        <p class="text-xs text-white/60 mt-1.5">Total raised</p>
    </div>
</div>

<!-- Charts + Activity Row -->
<div class="grid grid-cols-3 gap-6">
    <!-- Chart -->
    <div class="col-span-2 card">
        <p class="section-label-muted mb-6">Adoption vs Intake Trends</p>
        <canvas id="trendsChart" height="90"></canvas>
    </div>

    <!-- Recent Reports -->
    <div class="card flex flex-col">
        <p class="section-label-muted mb-5">Recent Incidents</p>
        <div class="space-y-4 flex-1 overflow-y-auto">
            @forelse ($stats['recent_reports'] as $report)
                @php
                    $dot = match($report->status) {
                        'Pending'  => 'bg-amber-400',
                        'Resolved' => 'bg-green-400',
                        default    => 'bg-gray-300',
                    };
                @endphp
                <div class="flex gap-3">
                    <span class="w-2 h-2 rounded-full {{ $dot }} mt-1.5 flex-shrink-0"></span>
                    <div>
                        <p class="text-sm text-[#1C1A17] leading-snug">{{ $report->type }} — {{ Str::limit($report->description, 45) }}</p>
                        <p class="text-[11px] text-[#A09890] mt-0.5">
                            {{ $report->user?->name ?? $report->reporter_name }} &middot; {{ $report->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-[#A09890] italic">No recent reports.</p>
            @endforelse
        </div>
        <a href="{{ route('admin.reports.index') }}" class="text-xs text-[#C9A84C] hover:text-[#b8932e] font-bold mt-5 tracking-wide uppercase transition-colors">
            View All Reports &rarr;
        </a>
    </div>
</div>

<!-- Bottom Cards -->
<div class="grid grid-cols-3 gap-6 mt-6">
    <div class="card-sm">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center mb-3" style="background:rgba(201,168,76,0.12)">
            <svg class="w-5 h-5 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
        </div>
        <p class="font-jakarta text-sm font-bold text-[#1C1A17]">Health Metrics</p>
        <p class="text-xs text-[#A09890] mt-1 leading-relaxed">Track veterinary screenings and health records for all residents.</p>
        <a href="{{ route('admin.cats.index') }}" class="text-xs text-[#C9A84C] hover:text-[#b8932e] font-bold mt-3 inline-block uppercase tracking-wide transition-colors">View Directory &rarr;</a>
    </div>
    <div class="card-sm">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center mb-3" style="background:rgba(201,168,76,0.12)">
            <svg class="w-5 h-5 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
        </div>
        <p class="font-jakarta text-sm font-bold text-[#1C1A17]">Upcoming Adoptions</p>
        <p class="text-xs text-[#A09890] mt-1 leading-relaxed">{{ $stats['adoptions_this_month'] ?? 0 }} adoptions processed this month.</p>
        <a href="{{ route('admin.adoptions.index') }}" class="text-xs text-[#C9A84C] hover:text-[#b8932e] font-bold mt-3 inline-block uppercase tracking-wide transition-colors">View All &rarr;</a>
    </div>
    <div class="card-gold">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center mb-3" style="background:rgba(255,255,255,0.15)">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"/></svg>
        </div>
        <p class="font-jakarta text-sm font-bold text-white">AI Care Suggestion</p>
        <p class="text-xs text-white/70 mt-1 leading-relaxed">System suggests reviewing adoption matches based on recent activity data.</p>
        <a href="{{ route('admin.cats.index') }}" class="text-xs text-white/90 hover:text-white font-bold mt-3 inline-block uppercase tracking-wide transition-colors">Review Now &rarr;</a>
    </div>
</div>

<script>
const ctx = document.getElementById('trendsChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [
            {
                label: 'Adoptions',
                data: [5, 6, 8, 12, 15, 14, 18],
                borderColor: '#C9A84C',
                backgroundColor: 'rgba(201,168,76,0.08)',
                fill: true, tension: 0.4, borderWidth: 2.5, pointRadius: 0,
            },
            {
                label: 'Intake',
                data: [5, 4, 7, 9, 11, 10, 13],
                borderColor: '#8B6914',
                backgroundColor: 'rgba(139,105,20,0.06)',
                fill: true, tension: 0.4, borderWidth: 2.5, pointRadius: 0,
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: { position: 'top', labels: { usePointStyle: true, padding: 16, font: { size: 11, family: 'Lato' } } }
        },
        scales: {
            y: { beginAtZero: true, grid: { color: 'rgba(201,168,76,0.08)' }, ticks: { font: { size: 11, family: 'Lato' } } },
            x: { grid: { display: false }, ticks: { font: { size: 11, family: 'Lato' } } }
        }
    }
});
</script>

</x-admin-layout>
