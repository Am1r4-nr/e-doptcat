<x-admin-layout>
<script>
function healthRecordsData() {
    return {
        open: null,
        editing: null,
        todos: [],
        vaccines: {
            'Vaccinated': [
                { title: 'FVRCP (Combo Shot)',   note: 'Herpesvirus, Calicivirus, Panleukopenia', tag: 'Core' },
                { title: 'Rabies',               note: 'Fatal if untreated, transmissible to humans', tag: 'Core' },
                { title: 'FeLV',                 note: 'Feline Leukemia Virus, recommended under 1yr', tag: 'Recommended' },
                { title: 'Bordetella',           note: 'Shelter or multi-cat households', tag: 'Optional' },
                { title: 'Chlamydia',            note: 'Crowded or rescue environments', tag: 'Optional' },
                { title: 'FIV',                  note: 'Outdoor or fighting-risk cats', tag: 'Optional' },
            ],
            'Booster': [
                { title: 'FVRCP Booster',  note: 'Every 1-3 years after initial series', tag: 'Core' },
                { title: 'Rabies Booster', note: 'Annual or every 3 years by law', tag: 'Core' },
                { title: 'FeLV Booster',   note: 'Annual for at-risk cats', tag: 'Recommended' },
            ],
            'Neutered': [
                { title: 'Neuter / Spay', note: 'Ideal at 4-6 months, after first vaccines', tag: 'Procedure' },
            ],
            'Additional Treatment': [
                { title: 'Deworming',          note: 'Every 3 months, especially for outdoor cats', tag: 'Recommended' },
                { title: 'Flea Treatment',     note: 'Monthly topical or oral preventative', tag: 'Recommended' },
                { title: 'Dental Cleaning',    note: 'Annual professional scaling under anaesthesia', tag: 'Optional' },
                { title: 'Microchipping',      note: 'Permanent ID implant, one-time procedure', tag: 'Procedure' },
                { title: 'Ear Mite Treatment', note: 'Topical or systemic if infestation detected', tag: 'Optional' },
                { title: 'Eye / Ear Drops',    note: 'For recurring infection or discharge', tag: 'Optional' },
            ],
            'Accident / Injury': [
                { title: 'Wound Care',            note: 'Cleaning, suturing, or bandaging of injuries', tag: 'Emergency' },
                { title: 'Fracture Treatment',    note: 'Splinting, casting, or surgical repair', tag: 'Emergency' },
                { title: 'Trauma Stabilisation',  note: 'IV fluids, pain relief, oxygen support', tag: 'Emergency' },
                { title: 'Post-Surgery Care',     note: 'Follow-up and recovery monitoring after procedure', tag: 'Optional' },
            ],
        },
        add(title) {
            if (!this.todos.find(t => t.title === title)) {
                this.todos.push({ title, clinic: '', volunteer: '', date: '', notes: '', status: 'Pending', files: [] });
            }
            this.open = null;
        },
        remove(title) {
            this.todos = this.todos.filter(t => t.title !== title);
            if (this.editing && this.editing.title === title) this.editing = null;
        },
        openEdit(item) {
            this.editing = { ...item, files: [...(item.files || [])] };
        },
        saveEdit() {
            const idx = this.todos.findIndex(t => t.title === this.editing.title);
            if (idx !== -1) this.todos[idx] = { ...this.editing };
            this.editing = null;
        },
        handleFiles(event) {
            Array.from(event.target.files).forEach(f => {
                const reader = new FileReader();
                reader.onload = e => {
                    this.editing.files.push({ name: f.name, url: e.target.result, type: f.type });
                };
                reader.readAsDataURL(f);
            });
            event.target.value = '';
        },
        removeFile(idx) {
            this.editing.files.splice(idx, 1);
        },
    };
}

function catShowPage() {
    return {
        gallery: false,
        galleryFiles: [],
        sectionEdit: null,
        sectionSaving: false,
        catFields: {
            name:   {!! json_encode($cat->name) !!},
            breed:  {!! json_encode($cat->breed) !!},
            gender: {!! json_encode($cat->gender) !!},
            age:    {!! json_encode($cat->age) !!},
            color:  {!! json_encode($cat->color) !!},
            weight: {!! json_encode($cat->weight) !!},
            status: {!! json_encode($cat->status) !!},
        },
        notesFields: {
            description:     {!! json_encode($cat->description) !!},
            medical_history: {!! json_encode($cat->medical_history) !!},
        },
        async saveSection(fields) {
            this.sectionSaving = true;
            try {
                const res = await fetch({!! json_encode(route('admin.cats.updateFields', $cat)) !!}, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(fields)
                });
                if (res.ok) { this.sectionEdit = null; window.location.reload(); }
            } finally {
                this.sectionSaving = false;
            }
        },
        handleGallery(e) {
            Array.from(e.target.files).forEach(f => {
                const r = new FileReader();
                r.onload = ev => this.galleryFiles.push({ name: f.name, url: ev.target.result, type: f.type });
                r.readAsDataURL(f);
            });
            e.target.value = '';
        }
    };
}
</script>
<div class="max-w-6xl mx-auto" x-data="catShowPage()">

    <!-- Back -->
    <div class="flex items-center justify-between mb-7 bg-[#3D3D3D] rounded-2xl px-5 py-3 shadow-sm">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.cats.index') }}"
               class="w-8 h-8 flex items-center justify-center rounded-lg text-[#9A9A9A] hover:bg-[#4A4A4A] hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
            </a>
            <div class="w-px h-4 bg-[#555555]"></div>
            <p class="text-xs tracking-widest text-[#C9A84C] uppercase font-semibold">Cat Profile</p>
            <span class="text-sm text-[#555555]">·</span>
            <p class="text-sm font-semibold text-white">{{ $cat->name }}</p>
            <span class="text-sm text-[#555555]">·</span>
            <p class="text-xs text-[#9A9A9A]">Updated {{ $cat->updated_at->format('M d, Y') }}</p>
        </div>
        <div class="flex items-center gap-1.5">
            <button @click="gallery = true"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg bg-[#4A4A4A] hover:bg-[#5A5A5A] text-white text-xs font-semibold transition" title="Gallery">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                Gallery
            </button>
            <form action="{{ route('admin.cats.destroy', $cat) }}" method="POST"
                  onsubmit="return confirm('Delete {{ $cat->name }}?')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white text-xs font-semibold transition" title="Delete">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    @php
        $badge = match($cat->status) {
            'Available' => ['ADOPTABLE', 'bg-green-500'],
            'Adopted'   => ['ADOPTED',   'bg-blue-500'],
            default     => ['LOST',      'bg-red-500'],
        };
    @endphp

    <div class="grid grid-cols-3 gap-6">

        <!-- LEFT COLUMN: Combined card -->
        <div class="col-span-1">
            <div class="bg-white rounded-2xl border border-[#E8E2D8] shadow-sm overflow-hidden">

                <!-- Photo -->
                <div class="relative bg-gray-800 h-64">
                    @if($cat->image)
                        <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-20 h-20 text-gray-500 opacity-30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.75">
                                <path d="M8 4.5 L6.5 1.5 L11 5.5"/>
                                <path d="M16 4.5 L17.5 1.5 L13 5.5"/>
                                <circle cx="12" cy="13.5" r="7.5"/>
                                <circle cx="9.5" cy="12" r="1.2" fill="currentColor" stroke="none"/>
                                <circle cx="14.5" cy="12" r="1.2" fill="currentColor" stroke="none"/>
                                <path d="M10.5 15.5 Q12 17 13.5 15.5" stroke-linecap="round"/>
                                <line x1="2.5" y1="13.5" x2="6.5" y2="14"/>
                                <line x1="2.5" y1="15.5" x2="6.5" y2="15"/>
                                <line x1="21.5" y1="13.5" x2="17.5" y2="14"/>
                                <line x1="21.5" y1="15.5" x2="17.5" y2="15"/>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <span class="inline-block px-2 py-0.5 {{ $badge[1] }} text-white text-[10px] font-bold uppercase rounded mb-1.5 tracking-wide">
                            {{ $badge[0] }}
                        </span>
                        <p class="text-xl font-cabinet font-bold text-white">{{ $cat->name }}</p>
                    </div>
                </div>

                <!-- Cat Details -->
                <div class="px-5 pt-5 pb-4 border-b border-[#F0EBE3]">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold">Cat Details</p>
                        <button @click="sectionEdit = 'catDetails'"
                                class="w-6 h-6 rounded-full bg-[#F5EDD8] hover:bg-[#C9A84C] text-[#C9A84C] hover:text-white flex items-center justify-center transition">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                        </button>
                    </div>
                    <div class="space-y-2.5">
                        <div class="flex justify-between items-center border-b border-[#F0EBE3] pb-2">
                            <span class="text-sm text-gray-500">Breed</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $cat->breed ?? '—' }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-[#F0EBE3] pb-2">
                            <span class="text-sm text-gray-500">Age</span>
                            <span class="text-sm font-semibold text-gray-800">
                                {{ $cat->age ? $cat->age . ' ' . Str::plural('Year', $cat->age) : '—' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center border-b border-[#F0EBE3] pb-2">
                            <span class="text-sm text-gray-500">Color</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $cat->color ?? '—' }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-[#F0EBE3] pb-2">
                            <span class="text-sm text-gray-500">Weight</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $cat->weight ? $cat->weight . ' kg' : '—' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Status</span>
                            <span class="flex items-center gap-1.5 text-sm font-semibold text-gray-800">
                                <span class="w-2 h-2 rounded-full {{ $badge[1] }} inline-block"></span>
                                {{ $cat->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Asset Identification -->
                <div class="px-5 pt-4 pb-5 border-b border-[#F0EBE3] flex flex-col items-center">
                    <p class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold mb-3 self-start">Asset Identification</p>
                    <div class="w-24 h-24 bg-[#FAF6F0] rounded-xl border border-[#E8E2D8] flex items-center justify-center mb-2">
                        <div class="grid grid-cols-5 gap-0.5 opacity-40">
                            @for($i = 0; $i < 25; $i++)
                                <div class="w-1.5 h-1.5 {{ rand(0,1) ? 'bg-gray-800' : 'bg-transparent' }} rounded-sm"></div>
                            @endfor
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-400 text-center mb-3">Profile ID: #{{ str_pad($cat->getAttribute('id'), 4, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-xs text-[#C9A84C] font-semibold cursor-pointer hover:underline">Download PDF &rarr;</p>
                </div>

                <!-- Live Asset Tracking -->
                <div class="px-5 pt-4 pb-5">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold">Live Asset Tracking</p>
                        <span class="px-2.5 py-1 bg-[#C9A84C] text-white text-[10px] font-bold rounded-full cursor-pointer">Log GPS</span>
                    </div>
                    <div class="w-full h-28 bg-[#FAF6F0] rounded-xl border border-[#E8E2D8] flex items-center justify-center mb-3">
                        @if($cat->gps_lat && $cat->gps_lng)
                            <p class="text-xs text-gray-500 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-[#C9A84C] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                {{ number_format($cat->gps_lat, 4) }}, {{ number_format($cat->gps_lng, 4) }}
                            </p>
                        @else
                            <div class="text-center">
                                <svg class="w-8 h-8 text-gray-300 mx-auto" fill="none" stroke="currentColor" stroke-width="1.25" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                <p class="text-xs text-gray-400 mt-1.5">No GPS data recorded</p>
                            </div>
                        @endif
                    </div>
                    <p class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold mb-1.5">Recent Movement</p>
                    @if($cat->location_name)
                        <p class="text-xs text-gray-600 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-green-400 rounded-full flex-shrink-0"></span>
                            Last seen: {{ $cat->location_name }}
                        </p>
                    @else
                        <p class="text-xs text-gray-400 italic">No location data available.</p>
                    @endif
                </div>

            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-span-2 space-y-5">

            <!-- Summary -->
            <div class="bg-white rounded-2xl border border-[#E8E2D8] shadow-sm p-6">
                <p class="text-xs font-bold text-[#C9A84C] mb-5 flex items-center gap-2">
                    <span class="w-6 h-6 bg-[#F5EDD8] rounded-full flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"/></svg>
                    </span>
                    Summary
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-[#FAF6F0] rounded-xl p-4">
                        <p class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold mb-2">Temperament Score</p>
                        <p class="text-3xl font-bold text-gray-800 mb-1">
                            {{ $cat->ai_match_score ?? '&mdash;' }}<span class="text-sm text-gray-400">/100</span>
                        </p>
                        <div class="w-full bg-[#F5EDD8] rounded-full h-1.5 mt-2">
                            <div class="bg-[#C9A84C] h-1.5 rounded-full" style="width: {{ min($cat->ai_match_score ?? 0, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-3">
                            {{ $cat->personality ? ucfirst($cat->personality) . ' personality profile.' : 'No personality data recorded yet.' }}
                        </p>
                    </div>
                    <div class="bg-[#FAF6F0] rounded-xl p-4">
                        <p class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold mb-2">Health Stability</p>
                        @php
                            $healthLabel = match(strtolower($cat->health_status ?? '')) {
                                'healthy'    => ['Low Risk',    'text-green-600'],
                                'sick'       => ['High Risk',   'text-red-600'],
                                'recovering' => ['Medium Risk', 'text-[#C9A84C]'],
                                default      => ['Unknown',     'text-gray-500'],
                            };
                        @endphp
                        <p class="text-2xl font-bold {{ $healthLabel[1] }} mb-1">{{ $healthLabel[0] }}</p>
                        <div class="w-full bg-green-100 rounded-full h-1.5 mt-2">
                            <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ $cat->health_status === 'Healthy' ? '85' : '40' }}%"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-3">
                            {{ $cat->medical_history ? Str::limit($cat->medical_history, 80) : 'No medical records on file.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Profile Notes -->
            <div class="bg-white rounded-2xl border border-[#E8E2D8] shadow-sm p-6">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold">Profile Notes</p>
                    <button @click="sectionEdit = 'notes'"
                            class="w-6 h-6 rounded-full bg-[#F5EDD8] hover:bg-[#C9A84C] text-[#C9A84C] hover:text-white flex items-center justify-center transition">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                    </button>
                </div>
                @if($cat->description)
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $cat->description }}</p>
                @else
                    <p class="text-sm text-gray-400 italic">No profile notes have been added yet.</p>
                @endif
                <div class="mt-4 pt-4 border-t border-[#F0EBE3] text-xs">
                    <p class="text-gray-400 mb-1">Additional Note</p>
                    <p class="font-semibold text-gray-700">{{ $cat->medical_history ?? 'Not recorded' }}</p>
                </div>
            </div>

            <!-- Health Records -->
            <div class="bg-white rounded-2xl border border-[#E8E2D8] shadow-sm p-6"
                 x-data="healthRecordsData()">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-base font-bold text-gray-800">Health Records</h2>
                </div>

                @php
                    $medStatuses = [
                        ['key' => 'Vaccinated',            'done' => (bool) $cat->vaccinated],
                        ['key' => 'Booster',               'done' => false],
                        ['key' => 'Neutered',              'done' => false],
                        ['key' => 'Additional Treatment',  'done' => false],
                        ['key' => 'Accident / Injury',     'done' => false],
                    ];
                @endphp

                <div class="grid grid-cols-3 gap-4">

                    <!-- Col 1: Medical status checklist -->
                    <div class="bg-[#FAF6F0] rounded-2xl p-4 self-start">
                        <p class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold mb-3">Medical Status</p>
                        <div>
                            @foreach($medStatuses as $status)
                                <div>
                                    <div class="flex items-center justify-between py-2 border-b border-[#EDE8DE]">
                                        <span class="text-sm text-gray-700 font-medium">{{ $status['key'] }}</span>
                                        <div class="flex items-center gap-1.5">
                                            @if($status['done'])
                                                <span class="flex items-center gap-1 text-[10px] font-bold text-green-600 bg-green-100 px-2 py-0.5 rounded-full">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                                    Done
                                                </span>
                                            @else
                                                <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">Not yet</span>
                                            @endif
                                            <button @click="open = open === '{{ $status['key'] }}' ? null : '{{ $status['key'] }}'"
                                                    class="w-5 h-5 rounded-full bg-[#C9A84C] hover:bg-[#b8963e] text-white flex items-center justify-center transition flex-shrink-0">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Expanded vaccine list -->
                                    <div x-show="open === '{{ $status['key'] }}'" x-transition class="mt-1.5 mb-2 space-y-1.5">
                                        <template x-for="v in vaccines['{{ $status['key'] }}']" :key="v.title">
                                            <div class="flex items-start justify-between gap-2 bg-white border border-[#E8E2D8] rounded-xl px-3 py-2">
                                                <div class="min-w-0">
                                                    <p class="text-xs font-semibold text-gray-700" x-text="v.title"></p>
                                                    <p class="text-[10px] text-gray-400 mt-0.5 leading-snug" x-text="v.note"></p>
                                                    <span class="inline-block mt-1 text-[9px] font-bold uppercase tracking-wide px-1.5 py-0.5 rounded"
                                                          :class="{
                                                              'bg-amber-100 text-amber-700': v.tag === 'Core',
                                                              'bg-blue-100 text-blue-600':   v.tag === 'Recommended',
                                                              'bg-gray-100 text-gray-500':   v.tag === 'Optional',
                                                              'bg-purple-100 text-purple-600': v.tag === 'Procedure'
                                                          }"
                                                          x-text="v.tag"></span>
                                                </div>
                                                <button @click="add(v.title)"
                                                        class="flex-shrink-0 w-6 h-6 rounded-full bg-[#C9A84C] hover:bg-[#b8963e] text-white flex items-center justify-center mt-0.5 transition">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Col 2-3: To-Do Examinations -->
                    <div class="col-span-2">
                        <p class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold mb-2.5">To-Do Examinations</p>

                        <template x-if="todos.length === 0">
                            <div class="flex flex-col items-center justify-center bg-[#FAF6F0] rounded-2xl py-10 text-center">
                                <svg class="w-10 h-10 text-gray-300 mb-3" fill="none" stroke="currentColor" stroke-width="1.25" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
                                <p class="text-sm text-gray-400 italic">No examinations added yet.</p>
                                <p class="text-xs text-gray-300 mt-1">Use the + buttons on the left to add.</p>
                            </div>
                        </template>

                        <div class="space-y-2.5">
                            <template x-for="(item, i) in todos" :key="i">
                                <div class="flex items-center gap-3 bg-[#FAF6F0] rounded-2xl px-4 py-3">
                                    <div class="w-2 h-2 rounded-full bg-[#C9A84C] flex-shrink-0"></div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-gray-800" x-text="item.title"></p>
                                        <div class="flex items-center gap-2 mt-0.5 flex-wrap">
                                            <span class="text-[10px] font-bold"
                                                  :class="{
                                                      'text-amber-600': item.status === 'Pending',
                                                      'text-blue-500':  item.status === 'Scheduled',
                                                      'text-green-600': item.status === 'Done',
                                                  }"
                                                  x-text="item.status.toUpperCase()"></span>
                                            <span x-show="item.date" class="text-[10px] text-gray-400" x-text="item.date"></span>
                                            <span x-show="item.clinic" class="text-[10px] text-gray-400" x-text="'@ ' + item.clinic"></span>
                                            <span x-show="item.volunteer" class="text-[10px] text-gray-400" x-text="'· ' + item.volunteer"></span>
                                        </div>
                                        <p x-show="item.notes" class="text-[10px] text-gray-400 mt-0.5 italic" x-text="item.notes"></p>
                                        <div x-show="item.files && item.files.length > 0" class="flex gap-1 mt-1.5 flex-wrap">
                                            <template x-for="(f, fi) in item.files" :key="fi">
                                                <div class="w-8 h-8 rounded-lg overflow-hidden border border-[#E8E2D8] bg-[#FAF6F0] flex items-center justify-center flex-shrink-0">
                                                    <template x-if="f.type && f.type.startsWith('image/')">
                                                        <img :src="f.url" class="w-full h-full object-cover">
                                                    </template>
                                                    <template x-if="!f.type || !f.type.startsWith('image/')">
                                                        <svg class="w-4 h-4 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                                    </template>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                    <button @click="openEdit(item)"
                                            class="w-6 h-6 rounded-full bg-[#F5EDD8] hover:bg-[#C9A84C] text-[#C9A84C] hover:text-white flex items-center justify-center transition flex-shrink-0">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                    </button>
                                    <button @click="remove(item.title)"
                                            class="w-6 h-6 rounded-full bg-red-100 hover:bg-red-200 text-red-500 flex items-center justify-center transition flex-shrink-0">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                </div>

                <!-- Edit Modal -->
                <div x-show="editing" x-transition
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
                    <div @click.outside="editing = null"
                         class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-sm font-bold text-gray-800" x-text="editing ? editing.title : ''"></h3>
                            <button @click="editing = null" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <div class="space-y-4 overflow-y-auto max-h-[70vh] pr-1" x-show="editing">
                            <div>
                                <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Status</label>
                                <select x-model="editing.status"
                                        class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C]">
                                    <option>Pending</option>
                                    <option>Scheduled</option>
                                    <option>Done</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Clinic / Vet</label>
                                <input type="text" x-model="editing.clinic" placeholder="e.g. PetCare Clinic KL"
                                       class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300">
                            </div>
                            <div>
                                <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Volunteer</label>
                                <input type="text" x-model="editing.volunteer" placeholder="e.g. Sara Abdullah"
                                       class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300">
                            </div>
                            <div>
                                <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Appointment Date</label>
                                <input type="date" x-model="editing.date"
                                       @click="$el.showPicker()"
                                       class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] cursor-pointer">
                            </div>
                            <div>
                                <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Notes</label>
                                <textarea x-model="editing.notes" rows="2" placeholder="Any remarks or instructions..."
                                          class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300 resize-none"></textarea>
                            </div>
                            <!-- Evidence / Attachments -->
                            <div>
                                <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-2">Evidence / Attachments</label>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="(f, fi) in editing.files" :key="fi">
                                        <div class="relative w-16 h-16 rounded-xl overflow-hidden border border-[#E8E2D8] bg-[#FAF6F0] flex items-center justify-center group">
                                            <template x-if="f.type && f.type.startsWith('image/')">
                                                <img :src="f.url" class="w-full h-full object-cover">
                                            </template>
                                            <template x-if="!f.type || !f.type.startsWith('image/')">
                                                <div class="flex flex-col items-center justify-center p-1 w-full">
                                                    <svg class="w-5 h-5 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                                    <p class="text-[8px] text-gray-400 mt-0.5 truncate w-full text-center px-1" x-text="f.name"></p>
                                                </div>
                                            </template>
                                            <button @click.prevent="removeFile(fi)"
                                                    class="absolute top-0.5 right-0.5 w-4 h-4 bg-red-500 rounded-full text-white items-center justify-center hidden group-hover:flex">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </div>
                                    </template>
                                    <label class="w-16 h-16 rounded-xl border-2 border-dashed border-[#E8E2D8] bg-[#FAF6F0] hover:border-[#C9A84C] hover:bg-[#F5EDD8] flex items-center justify-center cursor-pointer transition group">
                                        <input type="file" class="hidden" multiple accept="image/*,.pdf,.doc,.docx"
                                               @change="handleFiles($event)">
                                        <svg class="w-5 h-5 text-[#C9A84C] group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                    </label>
                                </div>
                                <p class="text-[10px] text-gray-300 mt-1.5">Images, PDF, or documents accepted.</p>
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 mt-5">
                            <button @click="editing = null"
                                    class="px-4 py-2 text-xs font-semibold text-gray-500 border border-[#E8E2D8] rounded-xl hover:bg-gray-50 transition">
                                Cancel
                            </button>
                            <button @click="saveEdit()"
                                    class="px-4 py-2 text-xs font-semibold text-white bg-[#C9A84C] hover:bg-[#b8963e] rounded-xl transition">
                                Save
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Cat Details + Asset Identification Edit Modal -->
    <div x-show="sectionEdit === 'catDetails'" x-transition
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
        <div @click.outside="sectionEdit = null"
             class="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6 max-h-[90vh] flex flex-col">
            <div class="flex items-center justify-between mb-5 flex-shrink-0">
                <div>
                    <p class="text-sm font-bold text-gray-800">Edit Profile</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">Cat Details & Asset Identification</p>
                </div>
                <button @click="sectionEdit = null" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="space-y-4 overflow-y-auto flex-1 pr-0.5">
                <!-- Asset Identification -->
                <div>
                    <p class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold mb-2.5">Asset Identification</p>
                    <div>
                        <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Cat Name</label>
                        <input type="text" x-model="catFields.name" placeholder="e.g. Bits"
                               class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300">
                    </div>
                </div>

                <div class="border-t border-[#F0EBE3] pt-4">
                    <p class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold mb-2.5">Cat Details</p>
                    <div class="space-y-3">
                        <div>
                            <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Breed</label>
                            <input type="text" x-model="catFields.breed" placeholder="e.g. Persian"
                                   class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Age (yrs)</label>
                                <input type="number" x-model="catFields.age" min="0" placeholder="—"
                                       class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300">
                            </div>
                            <div>
                                <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Weight (kg)</label>
                                <input type="number" x-model="catFields.weight" min="0" step="0.01" placeholder="—"
                                       class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Color</label>
                                <input type="text" x-model="catFields.color" placeholder="e.g. Orange"
                                       class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300">
                            </div>
                            <div>
                                <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Gender</label>
                                <select x-model="catFields.gender"
                                        class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C]">
                                    <option value="">—</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Status</label>
                            <select x-model="catFields.status"
                                    class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C]">
                                <option>Available</option>
                                <option>Adopted</option>
                                <option>Lost</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-5 flex-shrink-0">
                <button @click="sectionEdit = null"
                        class="px-4 py-2 text-xs font-semibold text-gray-500 border border-[#E8E2D8] rounded-xl hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button @click="saveSection(catFields)" :disabled="sectionSaving"
                        class="px-4 py-2 text-xs font-semibold text-white bg-[#C9A84C] hover:bg-[#b8963e] rounded-xl transition disabled:opacity-60">
                    <span x-text="sectionSaving ? 'Saving…' : 'Save'"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Profile Notes Edit Modal -->
    <div x-show="sectionEdit === 'notes'" x-transition
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
        <div @click.outside="sectionEdit = null"
             class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 flex flex-col max-h-[90vh]">
            <div class="flex items-center justify-between mb-5 flex-shrink-0">
                <div>
                    <p class="text-sm font-bold text-gray-800">Edit Profile Notes</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">Profile Notes & Additional Note</p>
                </div>
                <button @click="sectionEdit = null" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="space-y-4 overflow-y-auto flex-1 pr-0.5">
                <div>
                    <label class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold block mb-1.5">Profile Notes</label>
                    <textarea x-model="notesFields.description" rows="5"
                              placeholder="Describe the cat's background, behaviour, how it was found..."
                              class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300 resize-none leading-relaxed"></textarea>
                </div>
                <div class="border-t border-[#F0EBE3] pt-4">
                    <label class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold block mb-1.5">Additional Note</label>
                    <textarea x-model="notesFields.medical_history" rows="5"
                              placeholder="Medical history, vet visits, treatments..."
                              class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300 resize-none leading-relaxed"></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-2 mt-5 flex-shrink-0">
                <button @click="sectionEdit = null"
                        class="px-4 py-2 text-xs font-semibold text-gray-500 border border-[#E8E2D8] rounded-xl hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button @click="saveSection(notesFields)" :disabled="sectionSaving"
                        class="px-4 py-2 text-xs font-semibold text-white bg-[#C9A84C] hover:bg-[#b8963e] rounded-xl transition disabled:opacity-60">
                    <span x-text="sectionSaving ? 'Saving…' : 'Save'"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Gallery Modal -->
    <div x-show="gallery" x-transition
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
        <div @click.outside="gallery = false"
             class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 flex flex-col max-h-[85vh]">

            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-5 flex-shrink-0">
                <div>
                    <h3 class="text-sm font-bold text-gray-800">Photo Gallery</h3>
                    <p class="text-[10px] text-gray-400 mt-0.5">Additional photos for <span class="text-[#C9A84C] font-semibold">{{ $cat->name }}</span></p>
                </div>
                <button @click="gallery = false" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Photo Grid -->
            <div class="flex-1 overflow-y-auto pr-1">
                <div class="grid grid-cols-3 gap-3">
                    <!-- Existing main photo -->
                    @if($cat->image)
                        <div class="relative aspect-square rounded-xl overflow-hidden border border-[#E8E2D8] group">
                            <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition"></div>
                            <span class="absolute bottom-1.5 left-1.5 text-[9px] font-bold text-white bg-[#C9A84C] px-1.5 py-0.5 rounded uppercase tracking-wide">Main</span>
                        </div>
                    @endif

                    <!-- Uploaded gallery photos -->
                    <template x-for="(f, fi) in galleryFiles" :key="fi">
                        <div class="relative aspect-square rounded-xl overflow-hidden border border-[#E8E2D8] group">
                            <template x-if="f.type && f.type.startsWith('image/')">
                                <img :src="f.url" :alt="f.name" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!f.type || !f.type.startsWith('image/')">
                                <div class="w-full h-full bg-[#FAF6F0] flex flex-col items-center justify-center gap-1 p-2">
                                    <svg class="w-8 h-8 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    <p class="text-[10px] text-gray-500 truncate w-full text-center px-1" x-text="f.name"></p>
                                </div>
                            </template>
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition"></div>
                            <button @click="galleryFiles.splice(fi, 1)"
                                    class="absolute top-1.5 right-1.5 w-6 h-6 bg-red-500 rounded-full text-white items-center justify-center hidden group-hover:flex transition shadow">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </template>

                    <!-- Add photo tile -->
                    <label class="aspect-square rounded-xl border-2 border-dashed border-[#E8E2D8] bg-[#FAF6F0] hover:border-[#C9A84C] hover:bg-[#F5EDD8] flex flex-col items-center justify-center cursor-pointer transition group">
                        <input type="file" class="hidden" multiple accept="image/*"
                               @change="handleGallery($event)">
                        <div class="w-10 h-10 rounded-full bg-white border border-[#E8E2D8] group-hover:border-[#C9A84C] flex items-center justify-center mb-2 transition">
                            <svg class="w-5 h-5 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        </div>
                        <p class="text-xs font-semibold text-[#C9A84C]">Add Photo</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">Click to upload</p>
                    </label>
                </div>

                <template x-if="galleryFiles.length === 0 && !{{ $cat->image ? 'true' : 'false' }}">
                    <p class="text-center text-sm text-gray-400 italic mt-4">No photos yet. Add the first one!</p>
                </template>
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-between mt-5 pt-4 border-t border-[#F0EBE3] flex-shrink-0">
                <p class="text-[10px] text-gray-400">
                    <span x-text="galleryFiles.length"></span> photo(s) added this session
                </p>
                <div class="flex gap-2">
                    <button @click="gallery = false"
                            class="px-4 py-2 text-xs font-semibold text-gray-500 border border-[#E8E2D8] rounded-xl hover:bg-gray-50 transition">
                        Close
                    </button>
                    <button class="px-4 py-2 text-xs font-semibold text-white bg-[#C9A84C] hover:bg-[#b8963e] rounded-xl transition">
                        Save Gallery
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
</x-admin-layout>
