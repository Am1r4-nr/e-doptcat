<x-admin-layout>
@php
$total = collect($columns)->sum(fn($c) => $c->count());

$colConfig = [
    'Inquiry'   => ['dot' => 'bg-blue-400',    'count' => 'bg-blue-50 text-blue-600',   'bar' => 'bg-blue-400',   'tag' => 'bg-blue-100 text-blue-700'],
    'Screening' => ['dot' => 'bg-[#C9A84C]',   'count' => 'bg-[#F5EDD8] text-[#C9A84C]','bar' => 'bg-[#C9A84C]', 'tag' => 'bg-amber-100 text-amber-700'],
    'Matching'  => ['dot' => 'bg-purple-400',  'count' => 'bg-purple-50 text-purple-600','bar' => 'bg-purple-400', 'tag' => 'bg-purple-100 text-purple-700'],
    'Approved'  => ['dot' => 'bg-teal-500',    'count' => 'bg-teal-50 text-teal-600',   'bar' => 'bg-teal-500',   'tag' => 'bg-teal-100 text-teal-700'],
];

$stageOrder  = ['Inquiry', 'Screening', 'Matching', 'Approved'];
$avatarColors = ['bg-purple-200 text-purple-700','bg-teal-200 text-teal-700','bg-amber-200 text-amber-700','bg-pink-200 text-pink-700','bg-blue-200 text-blue-700','bg-rose-200 text-rose-700'];
@endphp

<div class="flex h-[calc(100vh-64px)] overflow-hidden" x-data="{ showGuide: false }">

    {{-- Guide Modal --}}
    <div x-show="showGuide"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-6"
         style="display:none">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" @click="showGuide = false"></div>

        {{-- Modal panel --}}
        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-3xl max-h-[88vh] overflow-hidden flex flex-col"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">

            {{-- Modal header --}}
            <div class="flex items-center justify-between px-8 py-6 border-b border-[#F0EBE3] flex-shrink-0">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#F5EDD8] flex items-center justify-center text-[#C9A84C]">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75h4.5M9.75 12h3M11.25 6.75h.008v.008h-.008V6.75z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-[20px] font-bold text-gray-900">Admin Pipeline Guide</h3>
                        <p class="text-[13px] text-gray-500 mt-0.5">Step-by-step instructions for processing adoption applications</p>
                    </div>
                </div>
                <button @click="showGuide = false"
                        class="w-9 h-9 rounded-full hover:bg-gray-100 flex items-center justify-center text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Modal body --}}
            <div class="overflow-y-auto flex-1 px-8 py-6">
                <p class="text-[14px] text-gray-600 mb-8 leading-relaxed">
                    Each adoption application moves through <strong class="text-gray-800">4 stages</strong>. As the admin, your job is to complete every checklist item in the current stage before advancing the application to the next one. The progress bar on each card shows how far along you are.
                </p>

                <div class="flex flex-col gap-6">

                    {{-- Stage 1: Inquiry --}}
                    <div class="rounded-2xl border border-blue-100 bg-blue-50/40 p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-xl bg-blue-400 flex items-center justify-center text-white text-[13px] font-bold">1</div>
                            <div>
                                <h4 class="text-[15px] font-bold text-gray-800">Inquiry</h4>
                                <p class="text-[12px] text-blue-600 font-medium">Initial contact & basic eligibility</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach (['Enquiry Received' => 'Confirm the adoption enquiry has been logged in the system.', 'Acknowledgement Sent' => 'Send a confirmation email to the applicant within 24 hours.', 'Basic Eligibility Check' => 'Verify the applicant meets minimum age and residency requirements.', 'Interview Session' => 'Conduct a short phone or video call to discuss their expectations.'] as $item => $desc)
                            <div class="flex items-start gap-2.5">
                                <div class="w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-3 h-3 text-blue-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div>
                                    <p class="text-[12px] font-bold text-gray-700">{{ $item }}</p>
                                    <p class="text-[11px] text-gray-500 mt-0.5 leading-snug">{{ $desc }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Stage 2: Screening --}}
                    <div class="rounded-2xl border border-amber-100 bg-amber-50/40 p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-xl bg-[#C9A84C] flex items-center justify-center text-white text-[13px] font-bold">2</div>
                            <div>
                                <h4 class="text-[15px] font-bold text-gray-800">Screening</h4>
                                <p class="text-[12px] text-[#C9A84C] font-medium">Documents, home visit & references</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach (['Application Form' => 'Collect and review the completed adoption application form.', 'ID Verification' => 'Verify the applicant\'s identity using a valid government-issued ID.', 'Home Survey' => 'Arrange a home visit to ensure the environment is safe for a cat.', 'Reference Checks' => 'Contact at least one personal or professional reference provided.'] as $item => $desc)
                            <div class="flex items-start gap-2.5">
                                <div class="w-5 h-5 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-3 h-3 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div>
                                    <p class="text-[12px] font-bold text-gray-700">{{ $item }}</p>
                                    <p class="text-[11px] text-gray-500 mt-0.5 leading-snug">{{ $desc }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Stage 3: Matching --}}
                    <div class="rounded-2xl border border-purple-100 bg-purple-50/40 p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-xl bg-purple-400 flex items-center justify-center text-white text-[13px] font-bold">3</div>
                            <div>
                                <h4 class="text-[15px] font-bold text-gray-800">Matching</h4>
                                <p class="text-[12px] text-purple-600 font-medium">Cat selection, meet & compatibility</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach (['Animal Selected' => 'Confirm which cat the applicant will be adopting.', 'Meet & Greet' => 'Facilitate an in-person or virtual introduction between applicant and cat.', 'Trial Visit' => 'Arrange a short-term trial stay to test compatibility at home.', 'Compatibility Confirmed' => 'Admin confirms the match is suitable based on all assessments.'] as $item => $desc)
                            <div class="flex items-start gap-2.5">
                                <div class="w-5 h-5 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-3 h-3 text-purple-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div>
                                    <p class="text-[12px] font-bold text-gray-700">{{ $item }}</p>
                                    <p class="text-[11px] text-gray-500 mt-0.5 leading-snug">{{ $desc }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Stage 4: Approved --}}
                    <div class="rounded-2xl border border-teal-100 bg-teal-50/40 p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-xl bg-teal-500 flex items-center justify-center text-white text-[13px] font-bold">4</div>
                            <div>
                                <h4 class="text-[15px] font-bold text-gray-800">Approved</h4>
                                <p class="text-[12px] text-teal-600 font-medium">Agreement, handover & follow-up</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach (['Agreement Signed' => 'Both parties sign the adoption agreement document.', 'Fee Paid' => 'Confirm the adoption fee has been collected and receipted.', 'Handover Done' => 'The cat has been handed over to the adopter with all documents.', 'Follow-up Scheduled' => 'A 30-day follow-up check-in has been arranged with the adopter.'] as $item => $desc)
                            <div class="flex items-start gap-2.5">
                                <div class="w-5 h-5 rounded-full bg-teal-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-3 h-3 text-teal-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div>
                                    <p class="text-[12px] font-bold text-gray-700">{{ $item }}</p>
                                    <p class="text-[11px] text-gray-500 mt-0.5 leading-snug">{{ $desc }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                {{-- Tip --}}
                <div class="mt-6 flex items-start gap-3 p-4 bg-[#FAF8F5] rounded-2xl border border-[#E8E2D8]">
                    <svg class="w-5 h-5 text-[#C9A84C] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-[12px] text-gray-600 leading-relaxed">
                        <strong class="text-gray-800">Tip:</strong> The <span class="font-semibold text-[#C9A84C]">→ Next Stage</span> button on each card only becomes active once all checklist items for the current stage are ticked. Complete every item before advancing.
                    </p>
                </div>
            </div>

            {{-- Modal footer --}}
            <div class="px-8 py-5 border-t border-[#F0EBE3] flex-shrink-0">
                <button @click="showGuide = false"
                        class="w-full py-2.5 rounded-full bg-[#C9A84C] text-white text-[13px] font-bold hover:bg-[#b8973d] transition">
                    Got it, close guide
                </button>
            </div>

        </div>
    </div>

    {{-- Kanban area --}}
    <div class="flex-1 flex flex-col overflow-hidden px-8 py-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6 flex-shrink-0">
            <div>
                <h2 class="text-[28px] font-bold text-gray-900 tracking-tight">Adoption Pipeline</h2>
                <p class="text-[14px] text-gray-500 mt-0.5">Track applications through every stage — tick checklist items directly on the board.</p>
            </div>
            <div class="flex items-center gap-3">
                <button @click="showGuide = true"
                        class="flex items-center gap-2 px-4 py-2 rounded-full bg-[#F5EDD8] border border-[#E8E2D8] text-[13px] font-bold text-[#C9A84C] hover:bg-[#EBE5DA] transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75h4.5M9.75 12h3M11.25 6.75h.008v.008h-.008V6.75z"/>
                    </svg>
                    Admin Guide
                </button>
                <a href="{{ route('admin.adoptions.index') }}"
                   class="flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-[#E8E2D8] text-[13px] font-bold text-gray-600 hover:bg-[#FAF8F5] transition shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        {{-- Columns --}}
        <div class="flex gap-4 flex-1 overflow-x-auto pb-2">
            @foreach ($columns as $stage => $adoptions)
            @php $cfg = $colConfig[$stage]; $nextStageIndex = array_search($stage, $stageOrder) + 1; $nextStage = $stageOrder[$nextStageIndex] ?? null; @endphp

            <div class="flex flex-col w-80 flex-shrink-0">

                {{-- Column header --}}
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full {{ $cfg['dot'] }}"></span>
                        <span class="text-[13px] font-bold text-gray-700 uppercase tracking-widest">{{ $stage }}</span>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full {{ $cfg['count'] }}">{{ $adoptions->count() }}</span>
                    </div>
                </div>

                {{-- Cards --}}
                <div class="flex flex-col gap-3 overflow-y-auto flex-1 pr-0.5">
                    @forelse ($adoptions as $adoption)
                    @php
                        $stageChecklist = $adoption->checklist[$stage] ?? [];
                        $total4         = count($stageChecklist);
                        $done4          = count(array_filter($stageChecklist));
                        $pct            = $total4 > 0 ? round($done4 / $total4 * 100) : 0;
                        $avatarClass    = $avatarColors[$adoption->id % count($avatarColors)];
                        $initial        = strtoupper(substr($adoption->user->name ?? 'U', 0, 1));
                        $details        = is_array($adoption->application_details) ? $adoption->application_details : (json_decode($adoption->application_details, true) ?? []);
                        $env            = $details['environment'] ?? 'Application';
                    @endphp

                    <div
                        x-data="{
                            stage:     '{{ $stage }}',
                            checklist: {{ json_encode((object)$stageChecklist) }},
                            saving:    false,
                            moved:     false,
                            get progress() {
                                const vals = Object.values(this.checklist);
                                return vals.length ? Math.round(vals.filter(Boolean).length / vals.length * 100) : 0;
                            },
                            get allDone() { return this.progress === 100; },
                            async toggle(key) {
                                this.checklist[key] = !this.checklist[key];
                                this.saving = true;
                                await fetch('{{ route('admin.adoptions.checklist', $adoption) }}', {
                                    method: 'PATCH',
                                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    body: JSON.stringify({ stage: this.stage, checklist: this.checklist })
                                });
                                this.saving = false;
                            },
                            async advance() {
                                @if ($nextStage)
                                this.moved = true;
                                await fetch('{{ route('admin.adoptions.stage', $adoption) }}', {
                                    method: 'PATCH',
                                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    body: JSON.stringify({ stage: '{{ $nextStage }}' })
                                });
                                setTimeout(() => window.location.reload(), 400);
                                @endif
                            }
                        }"
                        x-show="!moved"
                        class="bg-white rounded-2xl shadow-[0_2px_12px_-4px_rgba(0,0,0,0.08)] border border-[#F0EBE3] p-4 hover:shadow-md transition">

                        {{-- Tag + env --}}
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[11px] font-bold px-2.5 py-1 rounded-full {{ $cfg['tag'] }}">{{ $env }}</span>
                            <div class="flex items-center gap-1.5">
                                <span x-show="saving" class="w-3 h-3 border-2 border-gray-300 border-t-[#C9A84C] rounded-full animate-spin"></span>
                                <a href="{{ route('admin.adoptions.show', $adoption) }}"
                                   class="w-6 h-6 rounded-full hover:bg-gray-100 flex items-center justify-center text-gray-400 hover:text-[#C9A84C] transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        {{-- Name + cat --}}
                        <p class="text-[13px] font-bold text-gray-800 mb-0.5 leading-snug">{{ $adoption->user->name ?? '—' }}</p>
                        <p class="text-[12px] text-gray-400 mb-3">
                            Requesting: <span class="font-semibold text-gray-600">{{ $adoption->cat->name ?? '—' }}</span>
                        </p>

                        {{-- Progress bar --}}
                        <div class="mb-2">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Progress</span>
                                <span class="text-[11px] font-bold text-gray-500" x-text="progress + '%'"></span>
                            </div>
                            <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full {{ $cfg['bar'] }} rounded-full transition-all duration-300"
                                     :style="'width: ' + progress + '%'"></div>
                            </div>
                        </div>

                        {{-- Checklist --}}
                        <div class="mt-3 flex flex-col gap-1.5 border-t border-[#F5F1EB] pt-3">
                            @foreach ($stageChecklist as $key => $checked)
                            <label class="flex items-center gap-2.5 cursor-pointer group">
                                <input type="checkbox"
                                       {{ $checked ? 'checked' : '' }}
                                       @change="toggle('{{ $key }}')"
                                       class="w-3.5 h-3.5 rounded border-gray-300 text-[#C9A84C] focus:ring-[#C9A84C] focus:ring-offset-0 cursor-pointer">
                                <span class="text-[12px] text-gray-600 group-hover:text-gray-800 transition leading-tight"
                                      :class="checklist['{{ $key }}'] ? 'line-through text-gray-300' : ''">
                                    {{ ucwords(str_replace('_', ' ', $key)) }}
                                </span>
                            </label>
                            @endforeach
                        </div>

                        {{-- Footer --}}
                        <div class="flex items-center justify-between mt-3 pt-2 border-t border-[#F5F1EB]">
                            <span class="text-[11px] text-gray-400 font-medium flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $adoption->created_at->format('M d') }}
                            </span>

                            <div class="flex items-center gap-2">
                                @if ($nextStage)
                                <button @click="advance()"
                                        :disabled="!allDone || moved"
                                        :class="allDone ? 'bg-[#C9A84C] text-white hover:bg-[#b8973d] cursor-pointer' : 'bg-gray-100 text-gray-400 cursor-not-allowed'"
                                        class="text-[10px] font-bold px-2.5 py-1 rounded-full transition flex items-center gap-1">
                                    {{ $nextStage }}
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                                @endif

                                <div class="w-7 h-7 rounded-full {{ $avatarClass }} flex items-center justify-center text-[11px] font-bold">
                                    {{ $initial }}
                                </div>
                            </div>
                        </div>

                    </div>
                    @empty
                    <div class="flex items-center justify-center h-20 rounded-2xl border-2 border-dashed border-[#E8E2D8] text-[12px] text-gray-400 font-medium">
                        No applications
                    </div>
                    @endforelse
                </div>

            </div>
            @endforeach
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="w-64 flex-shrink-0 border-l border-[#EBE5DA] bg-white overflow-y-auto py-6 px-5 flex flex-col gap-7">

        {{-- Pipeline Progress --}}
        <div>
            <h3 class="text-[12px] font-bold text-gray-500 uppercase tracking-widest mb-4">Pipeline Overview</h3>
            <div class="flex flex-col gap-4">
                @foreach ($columns as $s => $ads)
                @php $cnt = $ads->count(); $pct = $total > 0 ? round($cnt / $total * 100) : 0; @endphp
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-[12px] font-semibold text-gray-700">{{ $s }}</span>
                        <span class="text-[11px] font-bold text-gray-400">{{ $cnt }}/{{ $total }}</span>
                    </div>
                    <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full {{ $colConfig[$s]['bar'] }} rounded-full" style="width: {{ $pct }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Recent --}}
        <div>
            <h3 class="text-[12px] font-bold text-gray-500 uppercase tracking-widest mb-4">Recent Applications</h3>
            <div class="flex flex-col gap-3">
                @forelse ($recent as $adoption)
                @php $ac = $avatarColors[$adoption->id % count($avatarColors)]; @endphp
                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-full {{ $ac }} flex items-center justify-center text-[11px] font-bold flex-shrink-0 mt-0.5">
                        {{ strtoupper(substr($adoption->user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-[12px] font-semibold text-gray-700 truncate leading-tight">{{ $adoption->user->name ?? '—' }}</p>
                        <p class="text-[11px] text-gray-400 truncate">{{ $adoption->cat->name ?? 'a cat' }} · <span class="font-medium text-gray-500">{{ $adoption->pipeline_stage }}</span></p>
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
