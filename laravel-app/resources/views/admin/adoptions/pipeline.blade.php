<x-admin-layout>
@php
$total = collect($columns)->sum(fn($c) => $c->count());

$colConfig = [
    'Pending'  => [
        'label'      => 'Pending',
        'dot'        => 'bg-[#C9A84C]',
        'count_bg'   => 'bg-[#F5EDD8] text-[#C9A84C]',
        'tag_colors' => ['bg-purple-100 text-purple-600', 'bg-blue-100 text-blue-600', 'bg-amber-100 text-amber-700'],
        'bar'        => 'bg-[#C9A84C]',
    ],
    'Approved' => [
        'label'      => 'Approved',
        'dot'        => 'bg-teal-500',
        'count_bg'   => 'bg-teal-50 text-teal-600',
        'tag_colors' => ['bg-teal-100 text-teal-700', 'bg-green-100 text-green-700', 'bg-cyan-100 text-cyan-700'],
        'bar'        => 'bg-teal-500',
    ],
    'Rejected' => [
        'label'      => 'Rejected',
        'dot'        => 'bg-red-400',
        'count_bg'   => 'bg-red-50 text-red-500',
        'tag_colors' => ['bg-red-100 text-red-600', 'bg-pink-100 text-pink-600', 'bg-orange-100 text-orange-600'],
        'bar'        => 'bg-red-400',
    ],
    'Archived' => [
        'label'      => 'Archived',
        'dot'        => 'bg-gray-400',
        'count_bg'   => 'bg-gray-100 text-gray-500',
        'tag_colors' => ['bg-gray-100 text-gray-600', 'bg-slate-100 text-slate-600', 'bg-zinc-100 text-zinc-600'],
        'bar'        => 'bg-gray-400',
    ],
];

$avatarColors = ['bg-purple-200 text-purple-700','bg-teal-200 text-teal-700','bg-amber-200 text-amber-700','bg-pink-200 text-pink-700','bg-blue-200 text-blue-700','bg-rose-200 text-rose-700'];
@endphp

<div class="flex h-[calc(100vh-64px)] overflow-hidden">

    {{-- Kanban area --}}
    <div class="flex-1 flex flex-col overflow-hidden px-8 py-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6 flex-shrink-0">
            <div>
                <h2 class="text-[28px] font-bold text-gray-900 tracking-tight">Adoption Pipeline</h2>
                <p class="text-[14px] text-gray-500 mt-0.5">Track all adoption applications across every stage.</p>
            </div>
            <a href="{{ route('admin.adoptions.index') }}"
               class="flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-[#E8E2D8] text-[13px] font-bold text-gray-600 hover:bg-[#FAF8F5] transition shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to List
            </a>
        </div>

        {{-- Columns --}}
        <div class="flex gap-4 flex-1 overflow-x-auto pb-2">
            @foreach ($columns as $status => $adoptions)
            @php
                $cfg = $colConfig[$status];
                $tagPalette = $cfg['tag_colors'];
            @endphp
            <div class="flex flex-col w-72 flex-shrink-0">

                {{-- Column header --}}
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full {{ $cfg['dot'] }}"></span>
                        <span class="text-[13px] font-bold text-gray-700 uppercase tracking-widest">{{ $cfg['label'] }}</span>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full {{ $cfg['count_bg'] }}">
                            {{ $adoptions->count() }}
                        </span>
                    </div>
                    <button class="w-7 h-7 rounded-full hover:bg-white flex items-center justify-center text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="5" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/>
                        </svg>
                    </button>
                </div>

                {{-- Cards --}}
                <div class="flex flex-col gap-3 overflow-y-auto flex-1 pr-0.5">
                    @forelse ($adoptions as $adoption)
                    @php
                        $tagClass  = $tagPalette[$adoption->id % count($tagPalette)];
                        $avatarClass = $avatarColors[$adoption->id % count($avatarColors)];
                        $initial   = strtoupper(substr($adoption->user->name ?? 'U', 0, 1));
                        $details   = is_string($adoption->application_details)
                                        ? json_decode($adoption->application_details, true)
                                        : (array)($adoption->application_details ?? []);
                        $env       = $details['environment'] ?? $details['living'] ?? null;
                    @endphp
                    <div class="bg-white rounded-2xl shadow-[0_2px_12px_-4px_rgba(0,0,0,0.08)] border border-[#F0EBE3] p-4 hover:shadow-md transition group">

                        {{-- Tag + menu --}}
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[11px] font-bold px-2.5 py-1 rounded-full {{ $tagClass }}">
                                {{ $env ? ucwords($env) : 'Cat Adoption' }}
                            </span>
                            <a href="{{ route('admin.adoptions.show', $adoption) }}"
                               class="opacity-0 group-hover:opacity-100 w-6 h-6 rounded-full hover:bg-gray-100 flex items-center justify-center text-gray-400 hover:text-[#C9A84C] transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>

                        {{-- Name --}}
                        <p class="text-[13px] font-bold text-gray-800 mb-0.5 leading-snug">
                            {{ $adoption->user->name ?? '—' }}
                        </p>
                        <p class="text-[12px] text-gray-400 mb-3 truncate">
                            Requesting: <span class="font-semibold text-gray-600">{{ $adoption->cat->name ?? 'Unknown Cat' }}</span>
                        </p>

                        {{-- Footer --}}
                        <div class="flex items-center justify-between pt-2 border-t border-[#F5F1EB]">
                            <span class="text-[11px] text-gray-400 font-medium flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $adoption->created_at->format('M d') }}
                            </span>
                            <div class="w-7 h-7 rounded-full {{ $avatarClass }} flex items-center justify-center text-[11px] font-bold">
                                {{ $initial }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="flex items-center justify-center h-20 rounded-2xl border-2 border-dashed border-[#E8E2D8] text-[12px] text-gray-400 font-medium">
                        No applications
                    </div>
                    @endforelse
                </div>

                {{-- Add card footer --}}
                <a href="{{ route('admin.adoptions.index') }}"
                   class="mt-3 flex items-center gap-1.5 text-[12px] font-semibold text-gray-400 hover:text-[#C9A84C] transition py-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Application
                </a>

            </div>
            @endforeach
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="w-64 flex-shrink-0 border-l border-[#EBE5DA] bg-white overflow-y-auto py-6 px-5 flex flex-col gap-7">

        {{-- Pipeline Progress --}}
        <div>
            <h3 class="text-[12px] font-bold text-gray-500 uppercase tracking-widest mb-4">Pipeline Progress</h3>
            <div class="flex flex-col gap-4">
                @foreach ($columns as $status => $adoptions)
                @php
                    $cfg   = $colConfig[$status];
                    $count = $adoptions->count();
                    $pct   = $total > 0 ? round(($count / $total) * 100) : 0;
                @endphp
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-[12px] font-semibold text-gray-700">{{ $cfg['label'] }}</span>
                        <span class="text-[11px] font-bold text-gray-400">{{ $count }}/{{ $total }}</span>
                    </div>
                    <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full {{ $cfg['bar'] }} rounded-full transition-all" style="width: {{ $pct }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Recent Activity --}}
        <div>
            <h3 class="text-[12px] font-bold text-gray-500 uppercase tracking-widest mb-4">Recent Applications</h3>
            <div class="flex flex-col gap-3">
                @forelse ($recent as $adoption)
                @php
                    $avatarClass = $avatarColors[$adoption->id % count($avatarColors)];
                    $initial     = strtoupper(substr($adoption->user->name ?? 'U', 0, 1));
                @endphp
                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-full {{ $avatarClass }} flex items-center justify-center text-[11px] font-bold flex-shrink-0 mt-0.5">
                        {{ $initial }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-[12px] font-semibold text-gray-700 truncate leading-tight">{{ $adoption->user->name ?? '—' }}</p>
                        <p class="text-[11px] text-gray-400 truncate">applied for <span class="text-gray-500 font-medium">{{ $adoption->cat->name ?? 'a cat' }}</span></p>
                        <p class="text-[10px] text-gray-300 mt-0.5">{{ $adoption->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <p class="text-[12px] text-gray-400 italic">No recent activity.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>
</x-admin-layout>
