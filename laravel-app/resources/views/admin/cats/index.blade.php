<x-admin-layout>
    <!-- Page Header -->
    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-3xl font-cabinet font-semibold text-gray-800">Cat Directory</h1>
            <p class="text-sm text-gray-400 mt-1">Managing the life-cycle and care records of our feline residents<br>with boutique precision and digital transparency.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-center bg-white rounded-2xl px-5 py-3 shadow-sm border border-[#E8E2D8]">
                <p class="text-2xl font-bold text-gray-800">{{ $cats->total() }}</p>
                <p class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold">In Care</p>
            </div>
            <div class="text-center bg-[#C9A84C] rounded-2xl px-5 py-3 shadow-sm">
                <p class="text-2xl font-bold text-white">{{ $cats->where('status', 'Available')->count() }}</p>
                <p class="text-[10px] tracking-widest text-[#E8D5A0] uppercase font-semibold">Available</p>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <form method="GET" action="{{ route('admin.cats.index') }}"
          class="bg-[#3D3D3D] rounded-2xl shadow-sm px-6 py-4 mb-6 flex flex-wrap items-end gap-4">
        <div class="flex flex-col gap-1 min-w-[180px]">
            <label class="text-[10px] font-semibold tracking-widest text-[#9A9A9A] uppercase">Cat Breed</label>
            <select name="breed"
                    class="px-3 py-2 text-sm bg-white border border-[#555555] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] text-gray-800">
                <option value="">All Breeds</option>
                <option value="unknown" {{ request('breed') === 'unknown' ? 'selected' : '' }}>Unknown Breed</option>
                @foreach($breeds as $breed)
                    <option value="{{ $breed }}" {{ request('breed') === $breed ? 'selected' : '' }}>{{ $breed }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col gap-1 min-w-[160px]">
            <label class="text-[10px] font-semibold tracking-widest text-[#9A9A9A] uppercase">Status</label>
            <select name="status"
                    class="px-3 py-2 text-sm bg-white border border-[#555555] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] text-gray-800">
                <option value="">All Statuses</option>
                @foreach(['Available','Adopted','Lost'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col gap-1 min-w-[140px]">
            <label class="text-[10px] font-semibold tracking-widest text-[#9A9A9A] uppercase">Age</label>
            <select name="age"
                    class="px-3 py-2 text-sm bg-white border border-[#555555] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] text-gray-800">
                <option value="">All Ages</option>
                <option value="unknown" {{ request('age') === 'unknown' ? 'selected' : '' }}>Unknown Age</option>
                <option value="kitten"  {{ request('age') === 'kitten'  ? 'selected' : '' }}>Kitten (&lt; 1 yr)</option>
                <option value="young"   {{ request('age') === 'young'   ? 'selected' : '' }}>Young (1–3 yrs)</option>
                <option value="adult"   {{ request('age') === 'adult'   ? 'selected' : '' }}>Adult (4–7 yrs)</option>
                <option value="senior"  {{ request('age') === 'senior'  ? 'selected' : '' }}>Senior (8+ yrs)</option>
            </select>
        </div>

        <div class="flex items-end gap-2 pb-0.5">
            <button type="submit"
                    class="px-5 py-2 bg-[#C9A84C] hover:bg-[#b8963e] text-white text-sm font-semibold rounded-xl transition">
                Apply
            </button>
            @if(request('breed') || request('status') || request('age'))
                <a href="{{ route('admin.cats.index') }}"
                   class="px-4 py-2 text-sm text-white font-semibold border border-white rounded-xl hover:bg-white hover:text-[#3D3D3D] transition">
                    Reset
                </a>
            @endif
        </div>

        <div class="flex flex-col gap-1 ml-auto">
            <label class="text-[10px] font-semibold tracking-widest text-[#9A9A9A] uppercase opacity-0 select-none">Search</label>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <input type="text" id="catSearch" name="search" value="{{ request('search') }}"
                           placeholder="Search cat registry..."
                           class="pl-8 pr-4 py-2 text-sm bg-white border border-[#555555] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] text-gray-800 placeholder-gray-400 w-52">
                    <svg class="absolute left-2.5 top-2.5 w-3.5 h-3.5 text-[#9A9A9A]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                    </svg>
                </div>
                <a href="{{ route('admin.cats.create') }}"
                   class="px-4 py-2 bg-[#C9A84C] hover:bg-[#b8963e] text-white text-sm font-semibold rounded-xl transition whitespace-nowrap">
                    + Add New
                </a>
            </div>
        </div>
    </form>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#E8E2D8] overflow-hidden">
        <!-- Table Header -->

        <table class="w-full">
            <thead>
                <tr class="bg-[#3D3D3D]">
                    <th class="px-6 py-3 text-left text-[10px] font-semibold text-white tracking-widest uppercase">Subject</th>
                    <th class="px-6 py-3 text-left text-[10px] font-semibold text-white tracking-widest uppercase">Breed & Visuals</th>
                    <th class="px-6 py-3 text-left text-[10px] font-semibold text-white tracking-widest uppercase">Age</th>
                    <th class="px-6 py-3 text-left text-[10px] font-semibold text-white tracking-widest uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-[10px] font-semibold text-white tracking-widest uppercase">Registration Date</th>
                    <th class="px-6 py-3 text-left text-[10px] font-semibold text-white tracking-widest uppercase">Last Updated</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#F0EBE3]">
                @forelse ($cats as $cat)
                    @php
                        $statusStyle = match($cat->status) {
                            'Available'    => 'bg-green-100 text-green-700',
                            'Adopted'      => 'bg-blue-100 text-blue-700',
                            'Lost'         => 'bg-red-100 text-red-700',
                            default        => 'bg-gray-100 text-gray-600',
                        };
                    @endphp
                    <tr onclick="window.location='{{ route('admin.cats.show', $cat) }}'"
                        class="hover:bg-[#F5EDD8] transition-colors duration-150 cursor-pointer">
                        <!-- Subject -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-[#F5EDD8] overflow-hidden flex-shrink-0 flex items-center justify-center">
                                    @if($cat->image)
                                        <img src="{{ asset("storage/{$cat->image}") }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-5 h-5 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.233c-.618 0-1.217-.247-1.605-.729A11.95 11.95 0 011 12c0-.43.023-.855.068-1.285C1.18 9.694 2.1 9 3.126 9h3.507z"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ $cat->name }}</p>
                                    <p class="text-[10px] text-gray-400">ID #{{ str_pad($cat->id, 3, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Breed & Visuals -->
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-700">{{ $cat->breed ?? '—' }}</p>
                        </td>

                        <!-- Age -->
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-700">
                                {{ $cat->age ? (is_numeric($cat->age) ? "{$cat->age} " . Str::plural('Year', (int)$cat->age) : $cat->age) : '—' }}
                            </p>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold tracking-wide uppercase {{ $statusStyle }}">
                                {{ $cat->status }}
                            </span>
                        </td>

                        <!-- Registration Date -->
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600">{{ $cat->created_at->format('M d, Y') }}</p>
                            <p class="text-[10px] text-gray-400">{{ $cat->created_at->format('g:i A') }}</p>
                        </td>

                        <!-- Last Updated -->
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600">{{ $cat->updated_at->format('M d, Y') }}</p>
                            <p class="text-[10px] text-gray-400">{{ $cat->updated_at->format('g:i A') }}</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <p class="text-gray-400 font-cabinet italic text-lg">No felines in the registry yet.</p>
                            <a href="{{ route('admin.cats.create') }}" class="mt-4 inline-block text-sm text-[#C9A84C] hover:underline">Add your first cat →</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($cats->hasPages())

            <div class="px-6 py-4 border-t border-[#F0EBE3]">
                {{ $cats->links() }}
            </div>
        @endif
    </div>

<script>
document.getElementById('catSearch').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
</x-admin-layout>
