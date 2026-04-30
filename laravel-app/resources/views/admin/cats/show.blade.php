<x-admin-layout>
<div class="max-w-6xl mx-auto">

    <!-- Back -->
    <div class="flex items-center gap-3 mb-7">
        <a href="{{ route('admin.cats.index') }}" class="text-gray-400 hover:text-amber-600 transition text-lg">←</a>
        <p class="text-xs tracking-widest text-amber-500 uppercase font-semibold">Cat Profile</p>
    </div>

    <!-- Top Row -->
    <div class="grid grid-cols-3 gap-6 mb-6">

        <!-- Photo Card -->
        <div class="col-span-1">
            <div class="relative rounded-2xl overflow-hidden shadow-md bg-gray-800 h-72">
                @if($cat->image)
                    <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-500 opacity-30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.75">
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
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-5">
                    @php
                        $badge = match($cat->status) {
                            'Available' => ['ADOPTABLE', 'bg-green-500'],
                            'Adopted'   => ['ADOPTED',   'bg-blue-500'],
                            default     => ['LOST',      'bg-red-500'],
                        };
                    @endphp
                    <span class="inline-block px-2 py-0.5 {{ $badge[1] }} text-white text-[10px] font-bold uppercase rounded mb-2 tracking-wide">
                        {{ $badge[0] }}
                    </span>
                    <p class="text-2xl font-serif font-bold text-white">{{ $cat->name }}</p>
                </div>
            </div>
        </div>

        <!-- Details -->
        <div class="col-span-1 bg-white rounded-2xl border border-amber-100 shadow-sm p-6">
            <p class="text-[10px] tracking-widest text-amber-500 uppercase font-semibold mb-4">Cat Details</p>
            <div class="space-y-3">
                <div class="flex justify-between items-center border-b border-amber-50 pb-2">
                    <span class="text-xs text-gray-400">Breed</span>
                    <span class="text-sm font-semibold text-gray-700">{{ $cat->breed ?? '—' }}</span>
                </div>
                <div class="flex justify-between items-center border-b border-amber-50 pb-2">
                    <span class="text-xs text-gray-400">Age</span>
                    <span class="text-sm font-semibold text-gray-700">
                        {{ $cat->age ? $cat->age . ' ' . Str::plural('Year', $cat->age) : '—' }}
                    </span>
                </div>
                <div class="flex justify-between items-center border-b border-amber-50 pb-2">
                    <span class="text-xs text-gray-400">Color</span>
                    <span class="text-sm font-semibold text-gray-700">{{ $cat->color ?? '—' }}</span>
                </div>
                <div class="flex justify-between items-center border-b border-amber-50 pb-2">
                    <span class="text-xs text-gray-400">Health</span>
                    <span class="text-sm font-semibold text-gray-700">{{ $cat->health_status ?? 'Not recorded' }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-400">Status</span>
                    <span class="flex items-center gap-1.5 text-sm font-semibold text-gray-700">
                        <span class="w-2 h-2 rounded-full {{ $badge[1] }} inline-block"></span>
                        {{ $cat->status }}
                    </span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 space-y-2">
                <a href="{{ route('admin.cats.edit', $cat) }}"
                   class="flex items-center justify-center gap-2 w-full py-2.5 bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold rounded-full transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                    Update Profile
                </a>
                <form action="{{ route('admin.cats.destroy', $cat) }}" method="POST"
                      onsubmit="return confirm('Delete {{ $cat->name }}?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="flex items-center justify-center gap-2 w-full py-2.5 bg-white border border-red-200 text-red-500 hover:bg-red-50 text-sm font-semibold rounded-full transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                        Remove Record
                    </button>
                </form>
            </div>
        </div>

        <!-- Asset Identification -->
        <div class="col-span-1 bg-white rounded-2xl border border-amber-100 shadow-sm p-6 flex flex-col">
            <p class="text-[10px] tracking-widest text-amber-500 uppercase font-semibold mb-4">Asset Identification</p>
            <div class="flex-1 flex flex-col items-center justify-center">
                <div class="w-32 h-32 bg-[#FAF6F0] rounded-xl border border-amber-100 flex items-center justify-center mb-3">
                    <div class="grid grid-cols-5 gap-0.5 opacity-40">
                        @for($i = 0; $i < 25; $i++)
                            <div class="w-2 h-2 {{ rand(0,1) ? 'bg-gray-800' : 'bg-transparent' }} rounded-sm"></div>
                        @endfor
                    </div>
                </div>
                <p class="text-[10px] text-gray-400 text-center">Profile ID: #{{ str_pad($cat->getAttribute('id'), 4, '0', STR_PAD_LEFT) }}</p>
            </div>
            <p class="text-xs text-amber-600 font-semibold text-center mt-4 cursor-pointer hover:underline">
                Download PDF →
            </p>
        </div>
    </div>

    <!-- AI Biological Insights -->
    <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-6 mb-6">
        <p class="text-xs font-bold text-amber-600 mb-5 flex items-center gap-2">
            <span class="w-6 h-6 bg-amber-100 rounded-full flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"/></svg>
                </span>
            AI Biological Insights
        </p>
        <div class="grid grid-cols-3 gap-6">
            <!-- Temperament Score -->
            <div class="bg-[#FAF6F0] rounded-xl p-4">
                <p class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold mb-2">Temperament Score</p>
                <p class="text-3xl font-bold text-gray-800 mb-1">
                    {{ $cat->ai_match_score ?? '—' }}<span class="text-sm text-gray-400">/100</span>
                </p>
                <div class="w-full bg-amber-100 rounded-full h-1.5 mt-2">
                    <div class="bg-amber-500 h-1.5 rounded-full" style="width: {{ min($cat->ai_match_score ?? 0, 100) }}%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-3">
                    {{ $cat->personality ? ucfirst($cat->personality) . ' personality profile.' : 'No personality data recorded yet.' }}
                </p>
            </div>

            <!-- Health Stability -->
            <div class="bg-[#FAF6F0] rounded-xl p-4">
                <p class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold mb-2">Health Stability</p>
                @php
                    $healthLabel = match(strtolower($cat->health_status ?? '')) {
                        'healthy'   => ['Low Risk',    'text-green-600'],
                        'sick'      => ['High Risk',   'text-red-600'],
                        'recovering'=> ['Medium Risk', 'text-amber-600'],
                        default     => ['Unknown',     'text-gray-500'],
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

            <!-- Generated Narrative -->
            <div class="bg-gray-800 rounded-xl p-4">
                <p class="text-[10px] tracking-widest text-amber-400 uppercase font-semibold mb-3">Generated Narrative</p>
                <p class="text-xs text-gray-300 italic leading-relaxed">
                    "{{ $cat->description
                        ? Str::limit($cat->description, 120)
                        : $cat->name . ' is a ' . ($cat->breed ?? 'wonderful') . ' resident awaiting their forever home. Their profile reflects a companion ready for a new chapter.' }}"
                </p>
            </div>
        </div>
    </div>

    <!-- Bottom Row: Description + GPS -->
    <div class="grid grid-cols-2 gap-6">

        <!-- Description / Profile Notes -->
        <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-6">
            <p class="text-[10px] tracking-widest text-amber-500 uppercase font-semibold mb-4">Profile Notes</p>
            @if($cat->description)
                <p class="text-sm text-gray-600 leading-relaxed">{{ $cat->description }}</p>
            @else
                <p class="text-sm text-gray-400 italic">No profile notes have been added yet.</p>
            @endif
            <div class="mt-4 pt-4 border-t border-amber-50 grid grid-cols-2 gap-3 text-xs">
                <div>
                    <p class="text-gray-400">Vaccinated</p>
                    <p class="font-semibold text-gray-700 mt-0.5">{{ $cat->vaccinated ? 'Yes' : 'Not recorded' }}</p>
                </div>
                <div>
                    <p class="text-gray-400">Last Updated</p>
                    <p class="font-semibold text-gray-700 mt-0.5">{{ $cat->getAttribute('updated_at')->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Live Asset Tracking -->
        <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[10px] tracking-widest text-amber-500 uppercase font-semibold">Live Asset Tracking</p>
                <span class="px-3 py-1 bg-amber-600 text-white text-[10px] font-bold rounded-full">Log GPS Location</span>
            </div>

            <!-- Map placeholder -->
            <div class="w-full h-36 bg-[#FAF6F0] rounded-xl border border-amber-100 flex items-center justify-center mb-4">
                @if($cat->gps_lat && $cat->gps_lng)
                    <p class="text-xs text-gray-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                            {{ number_format($cat->gps_lat, 4) }}, {{ number_format($cat->gps_lng, 4) }}
                        </p>
                @else
                    <div class="text-center">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.25" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        <p class="text-xs text-gray-400 mt-2">No GPS data recorded</p>
                    </div>
                @endif
            </div>

            <div>
                <p class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold mb-2">Recent Movement</p>
                @if($cat->location_name)
                    <p class="text-xs text-gray-600 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span>
                        Last seen: {{ $cat->location_name }}
                    </p>
                @else
                    <p class="text-xs text-gray-400 italic">No location data available.</p>
                @endif
            </div>
        </div>
    </div>
</div>
</x-admin-layout>
