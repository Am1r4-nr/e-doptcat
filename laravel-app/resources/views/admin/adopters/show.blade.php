<x-admin-layout>
@php
    $initials     = collect(explode(' ', $user->name))->take(2)->map(fn($w) => strtoupper($w[0]))->implode('');
    $avatarColors = ['bg-purple-200 text-purple-700','bg-teal-200 text-teal-700','bg-amber-200 text-amber-700','bg-pink-200 text-pink-700','bg-blue-200 text-blue-700'];
    $avatarClass  = $avatarColors[$user->id % count($avatarColors)];
    $adoptions    = $user->adoptions ?? collect();
    $totalApps    = $adoptions->count();
    $approved     = $adoptions->where('status','Approved')->count();
    $pending      = $adoptions->where('status','Pending')->count();
    $rejected     = $adoptions->where('status','Rejected')->count();
@endphp

<div class="px-8 py-6 max-w-5xl mx-auto">

    {{-- Back --}}
    <div class="mb-6">
        <a href="{{ route('admin.adopters.index') }}"
           class="inline-flex items-center gap-1.5 text-[13px] font-semibold text-gray-500 hover:text-[#C9A84C] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Adopters
        </a>
    </div>

    {{-- Profile hero card --}}
    <div class="bg-white rounded-3xl border border-[#F0EBE3] shadow-[0_4px_24px_-8px_rgba(0,0,0,0.08)] overflow-hidden mb-6">
        {{-- Top banner --}}
        <div class="h-28 bg-gradient-to-br from-[#EBE5DA] via-[#F5EDD8] to-[#FAF8F5]"></div>

        <div class="px-8 pb-7">
            {{-- Avatar + actions row --}}
            <div class="flex items-end justify-between -mt-12 mb-5">
                <div class="w-20 h-20 rounded-2xl {{ $avatarClass }} flex items-center justify-center text-2xl font-bold shadow-md border-4 border-white">
                    {{ $initials }}
                </div>

                <div class="flex items-center gap-3 mt-2">
                    <a href="{{ route('admin.adoptions.index') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-full text-[13px] font-bold bg-[#FAF8F5] border border-[#E8E2D8] text-gray-600 hover:bg-[#EBE5DA] transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        All Applications
                    </a>
                </div>
            </div>

            {{-- Name + role --}}
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-1">
                    <h1 class="text-[24px] font-bold text-gray-900">{{ $user->name }}</h1>
                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-[#F5EDD8] text-[#C9A84C]">
                        Adopter
                    </span>
                </div>
                <p class="text-[14px] text-gray-500">{{ $user->email }}</p>
            </div>

            {{-- Stats row --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-[#FAF8F5] rounded-2xl p-4">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Joined</p>
                    <p class="text-[14px] font-bold text-gray-700">{{ $user->created_at->format('d M Y') }}</p>
                </div>
                <div class="bg-[#FAF8F5] rounded-2xl p-4">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Total Apps</p>
                    <p class="text-[22px] font-bold text-gray-800 leading-none">{{ $totalApps }}</p>
                </div>
                <div class="bg-[#FAF8F5] rounded-2xl p-4">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Approved</p>
                    <p class="text-[22px] font-bold text-teal-600 leading-none">{{ $approved }}</p>
                </div>
                <div class="bg-[#FAF8F5] rounded-2xl p-4">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Pending</p>
                    <p class="text-[22px] font-bold text-[#C9A84C] leading-none">{{ $pending }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom two columns --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Profile info --}}
        <div class="md:col-span-1 bg-white rounded-3xl border border-[#F0EBE3] shadow-[0_2px_12px_-4px_rgba(0,0,0,0.06)] p-6 flex flex-col gap-5">
            <h3 class="text-[13px] font-bold text-gray-400 uppercase tracking-wider">Profile Info</h3>

            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Full Name</p>
                <p class="text-[14px] font-semibold text-gray-800">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Email Address</p>
                <p class="text-[14px] font-semibold text-gray-800 break-all">{{ $user->email }}</p>
            </div>
            @if ($user->phone)
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Phone</p>
                <p class="text-[14px] font-semibold text-gray-800">{{ $user->phone }}</p>
            </div>
            @endif
            @if ($user->address)
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Address</p>
                <p class="text-[14px] font-semibold text-gray-800">{{ $user->address }}</p>
            </div>
            @endif
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Member Since</p>
                <p class="text-[14px] font-semibold text-gray-800">{{ $user->created_at->format('d M Y') }}</p>
            </div>
            @if ($rejected > 0)
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Rejected</p>
                <p class="text-[14px] font-semibold text-red-500">{{ $rejected }}</p>
            </div>
            @endif
        </div>

        {{-- Adoption history --}}
        <div class="md:col-span-2 bg-white rounded-3xl border border-[#F0EBE3] shadow-[0_2px_12px_-4px_rgba(0,0,0,0.06)] overflow-hidden">
            <div class="px-6 py-5 border-b border-[#F5F1EB]">
                <h3 class="text-[13px] font-bold text-gray-400 uppercase tracking-wider">Adoption Applications</h3>
            </div>

            @if ($adoptions->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 text-center px-6">
                    <div class="w-14 h-14 rounded-2xl bg-[#FAF8F5] flex items-center justify-center mb-3">
                        <svg class="w-7 h-7 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <p class="text-[14px] font-semibold text-gray-500">No adoption applications yet</p>
                    <p class="text-[12px] text-gray-400 mt-1">This adopter hasn't applied to adopt any cats.</p>
                </div>
            @else
                <div class="divide-y divide-[#F5F1EB]">
                    @foreach ($adoptions as $adoption)
                    @php
                        $statusConfig = match($adoption->status) {
                            'Approved' => ['class' => 'bg-teal-50 text-teal-600',    'dot' => 'bg-teal-500'],
                            'Rejected' => ['class' => 'bg-red-50 text-red-500',      'dot' => 'bg-red-400'],
                            'Archived' => ['class' => 'bg-gray-100 text-gray-500',   'dot' => 'bg-gray-400'],
                            default    => ['class' => 'bg-[#F5EDD8] text-[#C9A84C]', 'dot' => 'bg-[#C9A84C]'],
                        };
                        $details = is_string($adoption->application_details)
                            ? json_decode($adoption->application_details, true)
                            : (array)($adoption->application_details ?? []);
                        $env = $details['environment'] ?? null;
                    @endphp
                    <div class="flex items-center gap-4 px-6 py-4 hover:bg-[#FDFAF7] transition">
                        <div class="w-10 h-10 rounded-xl bg-[#F5EDD8] flex items-center justify-center text-[#C9A84C] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0M4.5 12H3m16.5 0H21M12 4.5V3m0 18v-1.5"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[14px] font-bold text-gray-800 truncate">
                                {{ $adoption->cat->name ?? 'Unknown Cat' }}
                            </p>
                            <p class="text-[12px] text-gray-400">
                                {{ $adoption->created_at->format('d M Y') }}
                                @if ($env) · {{ $env }} @endif
                            </p>
                        </div>
                        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full {{ $statusConfig['class'] }} flex-shrink-0">
                            <span class="w-1.5 h-1.5 rounded-full {{ $statusConfig['dot'] }}"></span>
                            <span class="text-[11px] font-bold">{{ $adoption->status }}</span>
                        </div>
                        <a href="{{ route('admin.adoptions.show', $adoption) }}"
                           class="text-[12px] font-bold text-[#C9A84C] hover:underline flex-shrink-0">
                            View
                        </a>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>
</x-admin-layout>
