<x-admin-layout>
@php
    $user       = $adoption->user;
    $cat        = $adoption->cat;
    $details    = is_array($adoption->application_details)
                    ? $adoption->application_details
                    : (json_decode($adoption->application_details, true) ?? []);
    $checklist  = $adoption->checklist ?? \App\Models\Adoption::defaultChecklist();
    $stage      = $adoption->pipeline_stage ?? 'Inquiry';

    // Derive gender from IC last digit (odd = LELAKI, even = PEREMPUAN)
    $icRaw    = preg_replace('/[^0-9]/', '', $details['ic_number'] ?? '');
    $icGender = strlen($icRaw) === 12
                    ? ((int) substr($icRaw, -1) % 2 !== 0 ? 'LELAKI' : 'PEREMPUAN')
                    : null;

    $stageOrder = ['New', 'Inquiry', 'Screening', 'Matching', 'Approved'];
    $stageIdx   = array_search($stage, $stageOrder);

    $stageCfg = [
        'New'       => ['dot' => 'bg-orange-400', 'ring' => 'ring-orange-200', 'text' => 'text-orange-600', 'bg' => 'bg-orange-50'],
        'Inquiry'   => ['dot' => 'bg-blue-400',   'ring' => 'ring-blue-200',   'text' => 'text-blue-600',   'bg' => 'bg-blue-50'],
        'Screening' => ['dot' => 'bg-[#C9A84C]',  'ring' => 'ring-amber-200',  'text' => 'text-[#C9A84C]',  'bg' => 'bg-amber-50'],
        'Matching'  => ['dot' => 'bg-purple-400', 'ring' => 'ring-purple-200', 'text' => 'text-purple-600', 'bg' => 'bg-purple-50'],
        'Approved'  => ['dot' => 'bg-teal-500',   'ring' => 'ring-teal-200',   'text' => 'text-teal-600',   'bg' => 'bg-teal-50'],
    ];

    $initials     = collect(explode(' ', $user->name ?? 'U'))->take(2)->map(fn($w) => strtoupper($w[0]))->implode('');
    $avatarColors = ['bg-purple-200 text-purple-700','bg-teal-200 text-teal-700','bg-amber-200 text-amber-700','bg-pink-200 text-pink-700','bg-blue-200 text-blue-700'];
    $avatarClass  = $avatarColors[($user->id ?? 0) % count($avatarColors)];

    $stageChecklist = $checklist[$stage] ?? [];
    $done = count(array_filter($stageChecklist));
    $total = count($stageChecklist);
    $pct  = $total > 0 ? round($done / $total * 100) : 0;
@endphp

<div class="px-8 py-6 max-w-5xl mx-auto">

    {{-- Back --}}
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('admin.adoptions.index') }}"
           class="inline-flex items-center gap-1.5 text-[13px] font-semibold text-gray-500 hover:text-[#C9A84C] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Applications
        </a>
        <span class="text-gray-300">/</span>
        <a href="{{ route('admin.adoptions.pipeline') }}"
           class="inline-flex items-center gap-1.5 text-[13px] font-semibold text-gray-500 hover:text-[#C9A84C] transition">
            Pipeline
        </a>
    </div>

    {{-- Hero card --}}
    <div class="bg-white rounded-3xl border border-[#F0EBE3] shadow-[0_4px_24px_-8px_rgba(0,0,0,0.08)] overflow-hidden mb-6">
        <div class="h-24 bg-gradient-to-br from-[#EBE5DA] via-[#F5EDD8] to-[#FAF8F5]"></div>

        <div class="px-8 pb-7">
            <div class="flex items-end justify-between -mt-10 mb-5">
                <div class="w-20 h-20 rounded-2xl {{ $avatarClass }} flex items-center justify-center text-2xl font-bold shadow-md border-4 border-white">
                    {{ $initials }}
                </div>

                {{-- Pipeline stage stepper --}}
                <div class="flex items-center gap-1 mt-2">
                    @foreach ($stageOrder as $i => $s)
                    @php $cfg = $stageCfg[$s]; $active = $s === $stage; $past = $i < $stageIdx; @endphp
                    <div class="flex items-center gap-1">
                        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold transition
                            {{ $active ? $cfg['bg'] . ' ' . $cfg['text'] . ' ring-2 ' . $cfg['ring'] : ($past ? 'bg-gray-100 text-gray-400' : 'bg-gray-50 text-gray-300') }}">
                            <span class="w-2 h-2 rounded-full {{ $active ? $cfg['dot'] : ($past ? 'bg-gray-300' : 'bg-gray-200') }}"></span>
                            {{ $s }}
                        </div>
                        @if ($i < count($stageOrder) - 1)
                        <svg class="w-3 h-3 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Name + meta --}}
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-1">
                    <h1 class="text-[24px] font-bold text-gray-900">{{ $user->name ?? '—' }}</h1>
                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider
                        {{ $adoption->status === 'Approved' ? 'bg-teal-50 text-teal-600' : ($adoption->status === 'Rejected' ? 'bg-red-50 text-red-500' : 'bg-[#F5EDD8] text-[#C9A84C]') }}">
                        {{ $adoption->status }}
                    </span>
                </div>
                <p class="text-[14px] text-gray-500">{{ $user->email ?? '' }}</p>
            </div>

            {{-- Quick stats --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-[#FAF8F5] rounded-2xl p-4">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Cat Requested</p>
                    <p class="text-[14px] font-bold text-gray-800">{{ $cat->name ?? '—' }}</p>
                </div>
                <div class="bg-[#FAF8F5] rounded-2xl p-4">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Submitted</p>
                    <p class="text-[14px] font-bold text-gray-800">{{ $adoption->created_at->format('d M Y') }}</p>
                </div>
                <div class="bg-[#FAF8F5] rounded-2xl p-4">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Current Stage</p>
                    <p class="text-[14px] font-bold {{ $stageCfg[$stage]['text'] }}">{{ $stage }}</p>
                </div>
                <div class="bg-[#FAF8F5] rounded-2xl p-4">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Stage Progress</p>
                    <p class="text-[14px] font-bold text-gray-800">{{ $done }}/{{ $total }} <span class="text-gray-400 font-normal text-[12px]">items</span></p>
                </div>
            </div>
        </div>
    </div>

    {{-- Main grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Left: Application details --}}
        <div class="md:col-span-2 flex flex-col gap-6">

            {{-- Applicant info --}}
            <div class="bg-white rounded-3xl border border-[#F0EBE3] shadow-[0_2px_12px_-4px_rgba(0,0,0,0.06)] p-6">
                <h3 class="text-[13px] font-bold text-gray-400 uppercase tracking-wider mb-5">Applicant Information</h3>

                {{-- MyKad widget --}}
                @if (!empty($details['ic_number']))
                @php
                    $icAddress = 'NO. ' . (($user->id ?? 5) * 7 % 99 + 1) . ', JALAN SETIA MURNI';
                    $icCities  = ['KUALA LUMPUR', 'PETALING JAYA', 'SHAH ALAM', 'JOHOR BAHRU', 'KOTA KINABALU'];
                    $icCity    = $icCities[($user->id ?? 0) % count($icCities)];
                @endphp
                <div x-data="{ showIC: false }" class="mb-6">

                    {{-- Thumbnail trigger --}}
                    <button @click="showIC = true" type="button"
                        class="group relative w-full rounded-2xl overflow-hidden shadow-md border border-sky-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:ring-offset-2"
                        style="background: linear-gradient(160deg, #a8d8f0 0%, #c2e8ff 35%, #b5dff5 65%, #8fc8e8 100%);">

                        {{-- Halftone overlay --}}
                        <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle, #1a6fa8 1px, transparent 1px); background-size: 8px 8px;"></div>

                        {{-- Hover expand overlay --}}
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all duration-200 z-20 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-all duration-200 bg-black/50 rounded-full px-4 py-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                                <span class="text-white text-[12px] font-bold">View ID Card</span>
                            </div>
                        </div>

                        {{-- Purple header --}}
                        <div class="relative z-10 px-4 py-2 flex items-center justify-between" style="background: linear-gradient(90deg, #7c5cb4 0%, #9b7dd4 40%, #8468c0 70%, #7055aa 100%);">
                            <div>
                                <p class="text-white font-black text-[10px] tracking-widest leading-none uppercase">Kad Pengenalan</p>
                                <p class="text-white font-black text-[18px] tracking-widest leading-tight" style="letter-spacing: 0.15em;">MALAYSIA</p>
                                <p class="text-white/70 text-[8px] tracking-widest uppercase">Identity Card</p>
                            </div>
                            <div class="text-right leading-none">
                                <span class="font-black text-[16px]" style="color: #e8352a;">My</span><span class="font-black text-[16px] text-gray-900">Kad</span>
                                <div class="flex justify-end mt-0.5">
                                    <svg class="h-4" viewBox="0 0 50 30" fill="none">
                                        <rect width="50" height="30" fill="#CC0001"/>
                                        <rect width="50" height="15" fill="#fff"/>
                                        <circle cx="25" cy="15" r="11" fill="#CC0001"/>
                                        <path d="M29 10.5L27 14h4l-2 5.5L31 21l-6-3.5L25 21l1.5-5.5H23l4-5z" fill="#FFCC00"/>
                                        <path d="M36 8a5 5 0 010 14" stroke="#FFCC00" stroke-width="1.5" fill="none"/>
                                        <path d="M38 11a2.5 2.5 0 010 8" stroke="#FFCC00" stroke-width="1" fill="none"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Card body --}}
                        <div class="relative z-10 flex gap-3 px-4 pt-3 pb-4">
                            <div class="flex-1 min-w-0">
                                <div class="w-11 h-8 rounded mb-3 relative overflow-hidden" style="background: linear-gradient(135deg, #c8920a, #f0c840, #b07808, #e8b820); border: 1px solid #a06808; box-shadow: inset 0 1px 2px rgba(255,255,255,0.4);">
                                    <div class="absolute inset-1 grid grid-cols-3 gap-px">
                                        <div class="bg-yellow-700/40 rounded-[1px]"></div><div class="bg-yellow-700/30 rounded-[1px]"></div><div class="bg-yellow-700/40 rounded-[1px]"></div>
                                        <div class="bg-yellow-700/30 rounded-[1px]"></div><div class="bg-yellow-600/20 rounded-[1px]"></div><div class="bg-yellow-700/30 rounded-[1px]"></div>
                                        <div class="bg-yellow-700/40 rounded-[1px]"></div><div class="bg-yellow-700/30 rounded-[1px]"></div><div class="bg-yellow-700/40 rounded-[1px]"></div>
                                    </div>
                                </div>
                                <p class="text-gray-900 font-black text-[15px] tracking-widest mb-2" style="font-family: 'Courier New', monospace;">{{ $details['ic_number'] }}</p>
                                <p class="text-gray-900 font-bold text-[12px] uppercase leading-tight mb-1 truncate">{{ $user->name ?? '—' }}</p>
                                <p class="text-gray-700 text-[10px] leading-snug">{{ $icAddress }}</p>
                                <p class="text-gray-700 text-[10px]">{{ $icCity }}</p>
                            </div>
                            <div class="flex flex-col items-center justify-between flex-shrink-0" style="width: 70px;">
                                <div class="w-16 h-20 rounded-sm border-2 border-white/80 overflow-hidden shadow-sm {{ $avatarClass }} flex items-center justify-center text-2xl font-black">
                                    {{ $initials }}
                                </div>
                                <div class="text-center mt-2">
                                    <p class="text-[8px] font-bold text-gray-800 uppercase tracking-wider leading-none">WARGANEGARA</p>
                                    @if ($icGender)
                                    <p class="text-[9px] font-black text-gray-900 uppercase tracking-wider mt-0.5">{{ $icGender }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="absolute bottom-3 right-20 w-5 h-5 rounded-full border-2 border-red-500 flex items-center justify-center">
                                <span class="text-[9px] font-black text-red-500">K</span>
                            </div>
                        </div>
                    </button>

                    {{-- Full-size modal --}}
                    <div x-show="showIC"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         @keydown.escape.window="showIC = false"
                         @click.self="showIC = false"
                         class="fixed inset-0 z-50 flex items-center justify-center p-6"
                         style="background: rgba(0,0,0,0.65); backdrop-filter: blur(4px);"
                         x-cloak>

                        <div x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="relative w-full max-w-lg">

                            {{-- Close button --}}
                            <button @click="showIC = false" type="button"
                                class="absolute -top-4 -right-4 z-10 w-9 h-9 rounded-full bg-white shadow-lg flex items-center justify-center text-gray-500 hover:text-gray-800 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>

                            {{-- Full-size card --}}
                            <div class="rounded-2xl overflow-hidden shadow-2xl border border-sky-200"
                                 style="background: linear-gradient(160deg, #a8d8f0 0%, #c2e8ff 35%, #b5dff5 65%, #8fc8e8 100%); position: relative;">

                                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, #1a6fa8 1px, transparent 1px); background-size: 10px 10px;"></div>

                                {{-- Purple header --}}
                                <div class="relative z-10 px-6 py-3 flex items-center justify-between" style="background: linear-gradient(90deg, #7c5cb4 0%, #9b7dd4 40%, #8468c0 70%, #7055aa 100%);">
                                    <div>
                                        <p class="text-white font-black text-[12px] tracking-widest leading-none uppercase">Kad Pengenalan</p>
                                        <p class="text-white font-black text-[26px] tracking-widest leading-tight" style="letter-spacing: 0.15em;">MALAYSIA</p>
                                        <p class="text-white/70 text-[10px] tracking-widest uppercase">Identity Card</p>
                                    </div>
                                    <div class="text-right leading-none">
                                        <span class="font-black text-[22px]" style="color: #e8352a;">My</span><span class="font-black text-[22px] text-gray-900">Kad</span>
                                        <div class="flex justify-end mt-1">
                                            <svg class="h-6" viewBox="0 0 50 30" fill="none">
                                                <rect width="50" height="30" fill="#CC0001"/>
                                                <rect width="50" height="15" fill="#fff"/>
                                                <circle cx="25" cy="15" r="11" fill="#CC0001"/>
                                                <path d="M29 10.5L27 14h4l-2 5.5L31 21l-6-3.5L25 21l1.5-5.5H23l4-5z" fill="#FFCC00"/>
                                                <path d="M36 8a5 5 0 010 14" stroke="#FFCC00" stroke-width="1.5" fill="none"/>
                                                <path d="M38 11a2.5 2.5 0 010 8" stroke="#FFCC00" stroke-width="1" fill="none"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card body --}}
                                <div class="relative z-10 flex gap-5 px-6 pt-5 pb-6">
                                    <div class="flex-1 min-w-0">
                                        <div class="w-14 h-10 rounded-md mb-4 relative overflow-hidden" style="background: linear-gradient(135deg, #c8920a, #f0c840, #b07808, #e8b820); border: 1px solid #a06808; box-shadow: inset 0 1px 3px rgba(255,255,255,0.4);">
                                            <div class="absolute inset-1 grid grid-cols-3 gap-px">
                                                <div class="bg-yellow-700/40 rounded-[1px]"></div><div class="bg-yellow-700/30 rounded-[1px]"></div><div class="bg-yellow-700/40 rounded-[1px]"></div>
                                                <div class="bg-yellow-700/30 rounded-[1px]"></div><div class="bg-yellow-600/20 rounded-[1px]"></div><div class="bg-yellow-700/30 rounded-[1px]"></div>
                                                <div class="bg-yellow-700/40 rounded-[1px]"></div><div class="bg-yellow-700/30 rounded-[1px]"></div><div class="bg-yellow-700/40 rounded-[1px]"></div>
                                            </div>
                                        </div>
                                        <p class="text-gray-900 font-black text-[20px] tracking-widest mb-3" style="font-family: 'Courier New', monospace; letter-spacing: 0.2em;">{{ $details['ic_number'] }}</p>
                                        <p class="text-gray-900 font-bold text-[16px] uppercase leading-tight mb-2">{{ $user->name ?? '—' }}</p>
                                        <p class="text-gray-700 text-[13px] leading-snug">{{ $icAddress }}</p>
                                        <p class="text-gray-700 text-[13px] mb-1">{{ $icCity }}</p>
                                    </div>
                                    <div class="flex flex-col items-center justify-between flex-shrink-0" style="width: 90px;">
                                        <div class="w-20 h-24 rounded border-2 border-white/80 overflow-hidden shadow-md {{ $avatarClass }} flex items-center justify-center text-3xl font-black">
                                            {{ $initials }}
                                        </div>
                                        <div class="text-center mt-3">
                                            <p class="text-[10px] font-bold text-gray-800 uppercase tracking-wider leading-none">WARGANEGARA</p>
                                            @if ($icGender)
                                            <p class="text-[11px] font-black text-gray-900 uppercase tracking-wider mt-1">{{ $icGender }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="absolute bottom-5 right-24 w-6 h-6 rounded-full border-2 border-red-500 flex items-center justify-center">
                                        <span class="text-[11px] font-black text-red-500">K</span>
                                    </div>
                                </div>
                            </div>

                            <p class="text-center text-white/60 text-[11px] mt-3">Press <kbd class="bg-white/20 px-1.5 py-0.5 rounded text-white text-[10px] font-mono">Esc</kbd> or click outside to close</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Full Name</p>
                        <p class="text-[14px] font-semibold text-gray-800">{{ $user->name ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Email</p>
                        <p class="text-[14px] font-semibold text-gray-800 break-all">{{ $user->email ?? '—' }}</p>
                    </div>
                    @if (!empty($details['ic_number']))
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">IC Number</p>
                        <p class="text-[14px] font-semibold text-gray-800 font-mono">{{ $details['ic_number'] }}</p>
                    </div>
                    @endif
                    @if (!empty($details['occupation']))
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Occupation</p>
                        <p class="text-[14px] font-semibold text-gray-800">{{ $details['occupation'] }}</p>
                    </div>
                    @endif
                    @if (!empty($details['environment']))
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Home Environment</p>
                        <p class="text-[14px] font-semibold text-gray-800">{{ $details['environment'] }}</p>
                    </div>
                    @endif
                    @if (isset($details['has_children']))
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Has Children</p>
                        <p class="text-[14px] font-semibold text-gray-800">{{ $details['has_children'] }}</p>
                    </div>
                    @endif
                    @if (isset($details['other_pets']))
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Other Pets</p>
                        <p class="text-[14px] font-semibold text-gray-800">{{ $details['other_pets'] }}</p>
                    </div>
                    @endif
                </div>
                @if (!empty($details['reason']))
                <div class="mt-5 pt-5 border-t border-[#F5F1EB]">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Reason for Adoption</p>
                    <p class="text-[14px] text-gray-700 leading-relaxed">{{ $details['reason'] }}</p>
                </div>
                @endif
            </div>

            {{-- Cat info --}}
            <div class="bg-white rounded-3xl border border-[#F0EBE3] shadow-[0_2px_12px_-4px_rgba(0,0,0,0.06)] p-6">
                <h3 class="text-[13px] font-bold text-gray-400 uppercase tracking-wider mb-5">Requested Cat</h3>
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-14 h-14 rounded-2xl bg-[#F5EDD8] flex items-center justify-center text-[#C9A84C]">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0M4.5 12H3m16.5 0H21M12 4.5V3m0 18v-1.5"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[18px] font-bold text-gray-900">{{ $cat->name ?? '—' }}</p>
                        @if ($cat->breed)<p class="text-[13px] text-gray-500">{{ $cat->breed }}</p>@endif
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    @if ($cat->gender)
                    <div class="bg-[#FAF8F5] rounded-xl p-3">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Gender</p>
                        <p class="text-[13px] font-bold text-gray-700">{{ ucfirst($cat->gender) }}</p>
                    </div>
                    @endif
                    @if ($cat->age)
                    <div class="bg-[#FAF8F5] rounded-xl p-3">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Age</p>
                        <p class="text-[13px] font-bold text-gray-700">{{ $cat->age }} yr{{ $cat->age != 1 ? 's' : '' }}</p>
                    </div>
                    @endif
                    @if ($cat->color)
                    <div class="bg-[#FAF8F5] rounded-xl p-3">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Color</p>
                        <p class="text-[13px] font-bold text-gray-700">{{ $cat->color }}</p>
                    </div>
                    @endif
                </div>
                @if ($cat->personality)
                <div class="mt-4 pt-4 border-t border-[#F5F1EB]">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Personality</p>
                    <p class="text-[13px] text-gray-600">{{ $cat->personality }}</p>
                </div>
                @endif
            </div>


        </div>

        {{-- Right: Pipeline checklist --}}
        <div class="md:col-span-1 flex flex-col gap-6">

            {{-- Stage progress --}}
            <div class="bg-white rounded-3xl border border-[#F0EBE3] shadow-[0_2px_12px_-4px_rgba(0,0,0,0.06)] p-6">
                <h3 class="text-[13px] font-bold text-gray-400 uppercase tracking-wider mb-5">Stage Checklist</h3>

                {{-- Current stage label --}}
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-2.5 h-2.5 rounded-full {{ $stageCfg[$stage]['dot'] }}"></span>
                    <span class="text-[13px] font-bold text-gray-700">{{ $stage }}</span>
                </div>

                {{-- Progress bar --}}
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-[11px] font-bold text-gray-400">Completion</span>
                        <span class="text-[11px] font-bold text-gray-600">{{ $pct }}%</span>
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full {{ $stageCfg[$stage]['dot'] }} rounded-full transition-all" style="width: {{ $pct }}%"></div>
                    </div>
                </div>

                {{-- Checklist items --}}
                <div class="flex flex-col gap-2.5">
                    @foreach ($stageChecklist as $key => $checked)
                    <div class="flex items-center gap-2.5">
                        <div class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0
                            {{ $checked ? $stageCfg[$stage]['bg'] : 'bg-gray-100' }}">
                            @if ($checked)
                            <svg class="w-3 h-3 {{ $stageCfg[$stage]['text'] }}" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            @endif
                        </div>
                        <span class="text-[12px] {{ $checked ? 'line-through text-gray-400' : 'text-gray-600' }} font-medium">
                            {{ ucwords(str_replace('_', ' ', $key)) }}
                        </span>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('admin.adoptions.pipeline') }}"
                   class="mt-5 flex items-center justify-center gap-1.5 w-full py-2 rounded-full bg-[#F5EDD8] text-[#C9A84C] text-[12px] font-bold hover:bg-[#EBE5DA] transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7"/>
                    </svg>
                    View in Pipeline
                </a>
            </div>

            {{-- All stages overview --}}
            <div class="bg-white rounded-3xl border border-[#F0EBE3] shadow-[0_2px_12px_-4px_rgba(0,0,0,0.06)] p-6">
                <h3 class="text-[13px] font-bold text-gray-400 uppercase tracking-wider mb-4">All Stages</h3>
                <div class="flex flex-col gap-3">
                    @foreach ($stageOrder as $i => $s)
                    @php
                        $sc   = $checklist[$s] ?? [];
                        $d    = count(array_filter($sc));
                        $t    = count($sc);
                        $p    = $t > 0 ? round($d / $t * 100) : 0;
                        $cfg  = $stageCfg[$s];
                        $isActive = $s === $stage;
                        $isPast   = $i < $stageIdx;
                    @endphp
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0
                            {{ $isPast ? 'bg-teal-100' : ($isActive ? $cfg['bg'] : 'bg-gray-100') }}">
                            @if ($isPast)
                            <svg class="w-3 h-3 text-teal-500" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            @else
                            <span class="text-[9px] font-bold {{ $isActive ? $cfg['text'] : 'text-gray-400' }}">{{ $i + 1 }}</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-0.5">
                                <span class="text-[12px] font-bold {{ $isActive ? $cfg['text'] : ($isPast ? 'text-gray-500' : 'text-gray-300') }}">{{ $s }}</span>
                                <span class="text-[10px] text-gray-400">{{ $d }}/{{ $t }}</span>
                            </div>
                            <div class="h-1 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full rounded-full {{ $isPast ? 'bg-teal-400' : $cfg['dot'] }}" style="width: {{ $p }}%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
</x-admin-layout>
