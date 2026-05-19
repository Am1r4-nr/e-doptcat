<x-admin-layout>
    <div class="px-8 py-6 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-start justify-between">
            <div>
                <h2 class="text-[32px] font-bold text-gray-900 tracking-tight">Adopter Applications</h2>
                <p class="text-[15px] font-medium text-gray-500 mt-1 max-w-2xl">
                    Review and manage incoming feline adoption requests with the care and attention our residents deserve.
                </p>
            </div>
            <a href="{{ route('admin.adoptions.pipeline') }}"
               class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#C9A84C] text-white text-[13px] font-bold hover:bg-[#b8973d] transition shadow-sm mt-1 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                </svg>
                Adoption Pipeline
            </a>
        </div>

        <!-- 3 Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- PENDING -->
            <div class="bg-[#FAF8F5] rounded-3xl p-7 flex items-center justify-between">
                <div>
                    <div class="text-[12px] font-bold text-gray-500 tracking-wider mb-1 uppercase">PENDING</div>
                    <div class="text-4xl font-bold text-[#C9A84C]">24</div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-[#F5EDD8] flex items-center justify-center text-[#C9A84C]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
            </div>

            <!-- APPROVED -->
            <div class="bg-white rounded-3xl p-7 flex items-center justify-between border-2 border-teal-50 shadow-[0_4px_20px_-5px_rgba(20,184,166,0.1)]">
                <div>
                    <div class="text-[12px] font-bold text-gray-500 tracking-wider mb-1 uppercase">APPROVED</div>
                    <div class="text-4xl font-bold text-teal-600">142</div>
                </div>
                <div class="w-12 h-12 rounded-full border-2 border-teal-100 flex items-center justify-center text-teal-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                </div>
            </div>

            <!-- ARCHIVED -->
            <div class="bg-[#FAF8F5] rounded-3xl p-7 flex items-center justify-between">
                <div>
                    <div class="text-[12px] font-bold text-gray-500 tracking-wider mb-1 uppercase">ARCHIVED</div>
                    <div class="text-4xl font-bold text-gray-800">12</div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-white border border-gray-200 flex items-center justify-center text-gray-500 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="flex items-center gap-4 mb-8 bg-[#FAF8F5] p-3 rounded-full">
            <div class="relative flex-1 max-w-sm">
                <span class="absolute inset-y-0 left-0 pl-5 flex items-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" class="w-full pl-12 pr-4 py-2.5 bg-transparent border-transparent focus:border-transparent focus:ring-0 text-[14px] font-medium text-gray-700 placeholder-gray-400" placeholder="Search applicant names...">
            </div>

            <div class="ml-auto flex items-center gap-3">
                <button class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-white border-transparent text-[13px] font-bold text-gray-600 hover:bg-gray-50 shadow-sm">
                    All Statuses
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <button class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-white border-transparent text-[13px] font-bold text-gray-600 hover:bg-gray-50 shadow-sm">
                    All Breeds
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <button class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-gray-600 shadow-sm hover:bg-gray-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-teal-50 border border-teal-100 text-teal-700 rounded-2xl text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-3xl shadow-[0_2px_20px_-5px_rgba(0,0,0,0.05)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-[#FAF8F5]">
                        <tr>
                            <th class="py-5 px-6 font-bold text-[11px] text-gray-500 uppercase tracking-widest">APPLICANT NAME</th>
                            <th class="py-5 px-6 font-bold text-[11px] text-gray-500 uppercase tracking-widest">CAT REQUESTED</th>
                            <th class="py-5 px-6 font-bold text-[11px] text-gray-500 uppercase tracking-widest">DATE SUBMITTED</th>
                            <th class="py-5 px-6 font-bold text-[11px] text-gray-500 uppercase tracking-widest">ENVIRONMENT</th>
                            <th class="py-5 px-6 font-bold text-[11px] text-gray-500 uppercase tracking-widest">STATUS</th>
                            <th class="py-5 px-6 font-bold text-[11px] text-gray-500 uppercase tracking-widest text-right">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($adoptions as $adoption)
                            @php
                                // Mocking data for the UI since the real app might not have all these columns yet
                                $initials = collect(explode(' ', $adoption->user->name))->map(function($segment) { return strtoupper(substr($segment, 0, 1)); })->take(2)->implode('');
                                $colorClasses = ['bg-orange-100 text-orange-700', 'bg-cyan-100 text-cyan-700', 'bg-purple-100 text-purple-700', 'bg-[#F5EDD8] text-[#C9A84C]'];
                                $initialBadgeColor = $colorClasses[$loop->index % count($colorClasses)];

                                $catBreeds = ['Ragdoll', 'Sphynx', 'Ginger', 'Calico', 'Persian', 'Mixed'];
                                $mockBreed = $catBreeds[$adoption->cat_id % count($catBreeds)] ?? 'Mixed';

                                $environments = ['2BR Apt', 'Single Home', 'Studio', '3BR House'];
                                $mockEnv = $environments[$adoption->id % count($environments)];

                                $stageLabels = [
                                    'New'       => ['label' => 'New',       'dot' => 'bg-orange-400', 'text' => 'text-orange-600'],
                                    'Inquiry'   => ['label' => 'Inquiry',   'dot' => 'bg-blue-400',   'text' => 'text-blue-600'],
                                    'Screening' => ['label' => 'Screening', 'dot' => 'bg-[#C9A84C]',  'text' => 'text-[#C9A84C]'],
                                    'Matching'  => ['label' => 'Matching',  'dot' => 'bg-purple-400', 'text' => 'text-purple-600'],
                                    'Approved'  => ['label' => 'Approved',  'dot' => 'bg-teal-500',   'text' => 'text-teal-600'],
                                ];
                                $mappedStatus = $stageLabels[$adoption->pipeline_stage ?? 'New'] ?? ['label' => $adoption->pipeline_stage, 'dot' => 'bg-gray-400', 'text' => 'text-gray-600'];

                                // A little randomization for the specific mock screenshot layout if needed, but we'll stick to logic above mostly
                            @endphp
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm tracking-wide {{ $initialBadgeColor }}">
                                            {{ $initials }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-[14px] text-gray-900">{{ $adoption->user->name }}</div>
                                            <div class="text-[12px] text-gray-400 mt-0.5">{{ strtolower(str_replace(' ', '.', $adoption->user->name)) }}@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <div class="text-[13px]">
                                        <span class="text-gray-900 font-bold">{{ $adoption->cat->name }}</span>
                                        <span class="text-gray-400 font-medium">({{ $mockBreed }})</span>
                                    </div>
                                </td>
                                <td class="py-5 px-6 text-[13px] text-gray-500 font-medium">
                                    {{ $adoption->created_at->format('M d, Y') }}
                                </td>
                                <td class="py-5 px-6">
                                    <span class="px-3 py-1 bg-[#FAF8F5] text-gray-500 text-[11px] font-bold rounded-full tracking-wide">
                                        {{ $mockEnv }}
                                    </span>
                                </td>
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-2">
                                        <div class="w-1.5 h-1.5 rounded-full {{ $mappedStatus['dot'] }}"></div>
                                        <span class="text-[13px] font-bold {{ $mappedStatus['text'] }}">
                                            {{ $mappedStatus['label'] }}
                                        </span>
                                    </div>
                                </td>
                                <td class="py-5 px-6 text-right">
                                    <a href="{{ route('admin.adoptions.show', $adoption) }}"
                                       class="inline-flex flex-col items-end group">
                                        <span class="text-[12px] font-bold text-[#C9A84C] group-hover:text-[#7A5320] transition flex items-center gap-1">
                                            View Full
                                        </span>
                                        <span class="text-[12px] font-bold text-[#C9A84C] group-hover:text-[#7A5320] transition flex items-center gap-1">
                                            Application
                                            <svg class="w-3 h-3 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-10 text-center text-gray-500 font-medium">No adoptions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination footer -->
            <div class="flex items-center justify-between px-6 py-5 bg-[#FAF8F5] border-t border-gray-100">
                <div class="text-[12px] font-medium text-gray-500">
                    Showing <span class="font-bold">1-{{ min(4, count($adoptions)) }}</span> of {{ $adoptions->total() ?? 24 }} applications
                </div>
                <div class="flex items-center gap-1">
                    <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 bg-white shadow-sm hover:bg-gray-50">&lsaquo;</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-full bg-[#b8963e] text-white text-[13px] font-bold shadow">1</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 bg-white shadow-sm text-[13px] font-bold hover:bg-gray-50">2</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 bg-white shadow-sm text-[13px] font-bold hover:bg-gray-50">3</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 bg-white shadow-sm hover:bg-gray-50">&rsaquo;</button>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
