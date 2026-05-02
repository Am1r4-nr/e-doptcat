<x-admin-layout>

<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-serif font-semibold text-gray-800">Adopters</h1>
    <p class="text-sm text-gray-400 mt-1">Registered users who have submitted adoption applications</p>
</div>

<!-- Stats -->
<div class="grid grid-cols-3 gap-5 mb-8">
    <div class="bg-[#FAF8F5] rounded-3xl p-7 flex items-center justify-between">
        <div>
            <p class="text-[11px] font-bold text-gray-500 tracking-wider uppercase mb-1">Total Adopters</p>
            <p class="text-4xl font-bold text-gray-800">{{ $totalAdopters }}</p>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center text-amber-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
            </svg>
        </div>
    </div>

    <div class="bg-white rounded-3xl p-7 flex items-center justify-between border-2 border-teal-50 shadow-[0_4px_20px_-5px_rgba(20,184,166,0.1)]">
        <div>
            <p class="text-[11px] font-bold text-gray-500 tracking-wider uppercase mb-1">Approved</p>
            <p class="text-4xl font-bold text-teal-600">{{ $approvedAdopters }}</p>
        </div>
        <div class="w-12 h-12 rounded-full border-2 border-teal-100 flex items-center justify-center text-teal-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
    </div>

    <div class="bg-[#FAF8F5] rounded-3xl p-7 flex items-center justify-between">
        <div>
            <p class="text-[11px] font-bold text-gray-500 tracking-wider uppercase mb-1">Pending Review</p>
            <p class="text-4xl font-bold text-amber-600">{{ $pendingAdopters }}</p>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center text-amber-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-teal-50 border border-teal-100 text-teal-700 rounded-2xl text-sm font-semibold">
        {{ session('success') }}
    </div>
@endif

<!-- Search + Filter bar -->
<div class="flex items-center gap-4 mb-6 bg-[#FAF8F5] px-4 py-3 rounded-full">
    <div class="relative flex-1 max-w-sm">
        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </span>
        <input id="adopterSearch" type="text" placeholder="Search by name or email..."
               class="w-full pl-10 pr-4 py-2.5 bg-transparent border-transparent focus:border-transparent focus:ring-0 text-sm font-medium text-gray-700 placeholder-gray-400">
    </div>
    <div class="ml-auto flex items-center gap-2">
        <select id="adopterStatusFilter"
                class="px-4 py-2.5 rounded-full bg-white border-transparent text-xs font-bold text-gray-600 shadow-sm focus:outline-none focus:ring-0">
            <option value="">All Statuses</option>
            <option value="approved">Has Approved</option>
            <option value="pending">Has Pending</option>
        </select>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-3xl shadow-[0_2px_20px_-5px_rgba(0,0,0,0.05)] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left" id="adopterTable">
            <thead class="bg-[#FAF8F5]">
                <tr>
                    <th class="py-5 px-6 text-[11px] font-bold text-gray-500 uppercase tracking-widest">Adopter</th>
                    <th class="py-5 px-6 text-[11px] font-bold text-gray-500 uppercase tracking-widest">Contact</th>
                    <th class="py-5 px-6 text-[11px] font-bold text-gray-500 uppercase tracking-widest text-center">Applications</th>
                    <th class="py-5 px-6 text-[11px] font-bold text-gray-500 uppercase tracking-widest text-center">Approved</th>
                    <th class="py-5 px-6 text-[11px] font-bold text-gray-500 uppercase tracking-widest text-center">Pending</th>
                    <th class="py-5 px-6 text-[11px] font-bold text-gray-500 uppercase tracking-widest">Last Applied</th>
                    <th class="py-5 px-6 text-[11px] font-bold text-gray-500 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50" id="adopterBody">
                @forelse($adopters as $user)
                    @php
                        $initials = collect(explode(' ', $user->name))
                            ->map(fn($s) => strtoupper(substr($s, 0, 1)))
                            ->take(2)->implode('');
                        $colors = ['bg-orange-100 text-orange-700','bg-cyan-100 text-cyan-700','bg-purple-100 text-purple-700','bg-amber-100 text-amber-700','bg-rose-100 text-rose-700'];
                        $color  = $colors[$loop->index % count($colors)];
                        $last   = $user->adoptions->first();
                        $hasApproved = $user->approved_count > 0;
                        $hasPending  = $user->pending_count  > 0;
                    @endphp
                    <tr class="hover:bg-gray-50/50 transition adopter-row"
                        data-name="{{ strtolower($user->name) }}"
                        data-email="{{ strtolower($user->email) }}"
                        data-approved="{{ $hasApproved ? 'approved' : '' }}"
                        data-pending="{{ $hasPending ? 'pending' : '' }}">

                        <td class="py-5 px-6">
                            <div class="flex items-center gap-3">
                                @if($user->avatar)
                                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}"
                                         class="w-10 h-10 rounded-full object-cover flex-shrink-0">
                                @else
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm {{ $color }} flex-shrink-0">
                                        {{ $initials }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-bold text-sm text-gray-900">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Joined {{ $user->created_at->format('M Y') }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="py-5 px-6">
                            <p class="text-sm text-gray-600 font-medium">{{ $user->email }}</p>
                            @if($user->phone)
                                <p class="text-xs text-gray-400 mt-0.5">{{ $user->phone }}</p>
                            @endif
                        </td>

                        <td class="py-5 px-6 text-center">
                            <span class="text-sm font-bold text-gray-800">{{ $user->adoptions_count }}</span>
                        </td>

                        <td class="py-5 px-6 text-center">
                            @if($user->approved_count > 0)
                                <span class="inline-flex items-center gap-1 text-xs font-bold text-teal-700 bg-teal-50 px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500 inline-block"></span>
                                    {{ $user->approved_count }}
                                </span>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>

                        <td class="py-5 px-6 text-center">
                            @if($user->pending_count > 0)
                                <span class="inline-flex items-center gap-1 text-xs font-bold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 inline-block"></span>
                                    {{ $user->pending_count }}
                                </span>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>

                        <td class="py-5 px-6 text-sm text-gray-500 font-medium">
                            {{ $last?->created_at->format('M d, Y') ?? '—' }}
                        </td>

                        <td class="py-5 px-6 text-right">
                            <a href="{{ route('admin.users.show', $user) }}"
                               class="inline-flex items-center gap-1 text-xs font-bold text-amber-700 hover:text-amber-900 transition">
                                View Profile
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-gray-400 italic font-serif text-sm">
                            No adopters found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination footer -->
    <div class="flex items-center justify-between px-6 py-5 bg-[#FAF8F5] border-t border-gray-100">
        <p class="text-xs font-medium text-gray-500">
            Showing <span class="font-bold">{{ $adopters->firstItem() }}–{{ $adopters->lastItem() }}</span>
            of <span class="font-bold">{{ $adopters->total() }}</span> adopters
        </p>
        <div class="flex items-center gap-1">
            @if($adopters->onFirstPage())
                <span class="w-8 h-8 flex items-center justify-center rounded-full text-gray-300 bg-white shadow-sm">&lsaquo;</span>
            @else
                <a href="{{ $adopters->previousPageUrl() }}"
                   class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 bg-white shadow-sm hover:bg-gray-50">&lsaquo;</a>
            @endif

            @foreach($adopters->getUrlRange(1, $adopters->lastPage()) as $page => $url)
                @if($page == $adopters->currentPage())
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-amber-700 text-white text-xs font-bold shadow">{{ $page }}</span>
                @else
                    <a href="{{ $url }}"
                       class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 bg-white shadow-sm text-xs font-bold hover:bg-gray-50">{{ $page }}</a>
                @endif
            @endforeach

            @if($adopters->hasMorePages())
                <a href="{{ $adopters->nextPageUrl() }}"
                   class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 bg-white shadow-sm hover:bg-gray-50">&rsaquo;</a>
            @else
                <span class="w-8 h-8 flex items-center justify-center rounded-full text-gray-300 bg-white shadow-sm">&rsaquo;</span>
            @endif
        </div>
    </div>
</div>

<script>
const searchInput  = document.getElementById('adopterSearch');
const statusFilter = document.getElementById('adopterStatusFilter');

function filterAdopters() {
    const q      = searchInput.value.toLowerCase();
    const status = statusFilter.value;
    document.querySelectorAll('.adopter-row').forEach(row => {
        const matchName   = row.dataset.name.includes(q) || row.dataset.email.includes(q);
        const matchStatus = !status || row.dataset[status] === status;
        row.style.display = matchName && matchStatus ? '' : 'none';
    });
}

searchInput.addEventListener('input', filterAdopters);
statusFilter.addEventListener('change', filterAdopters);
</script>

</x-admin-layout>
