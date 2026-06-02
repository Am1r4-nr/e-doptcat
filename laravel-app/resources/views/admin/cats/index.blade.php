<x-admin-layout>
<div class="max-w-7xl mx-auto">

    <!-- Page Header -->
    <div class="flex items-start justify-between mb-5">
        <div>
            <h1 class="font-jakarta text-3xl font-extrabold text-[#1C1A17] tracking-tight">Cat Directory</h1>
            <p class="text-[15px] font-medium text-gray-500 mt-1 max-w-2xl">Managing the life-cycle and care records of our feline residents with boutique precision and digital transparency.</p>
        </div>
        <a href="{{ route('admin.cats.create') }}"
           class="px-6 py-2.5 rounded-full bg-[#C9A84C] text-white text-sm font-bold shadow-md shadow-amber-600/20 hover:bg-[#b8963e] transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Add New Cat
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
            <div>
                <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">Total In Care</div>
                <div class="text-4xl font-bold text-gray-900">{{ $cats->total() }}</div>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-[#C9A84C]">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/><path d="M8.5 6.5c.83 0 1.5-.67 1.5-1.5S9.33 3.5 8.5 3.5 7 4.17 7 5s.67 1.5 1.5 1.5zm7 0c.83 0 1.5-.67 1.5-1.5S16.33 3.5 15.5 3.5 14 4.17 14 5s.67 1.5 1.5 1.5zM12 8c-2.33 0-7 1.17-7 3.5V13h14v-1.5C19 9.17 14.33 8 12 8z"/></svg>
            </div>
        </div>
        <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
            <div>
                <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">Available</div>
                <div class="text-4xl font-bold text-[#C9A84C]">{{ $cats->getCollection()->where('status', 'Available')->count() }}</div>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-[#C9A84C]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
            <div>
                <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">Adopted</div>
                <div class="text-4xl font-bold text-gray-900">{{ $cats->getCollection()->where('status', 'Adopted')->count() }}</div>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-[#C9A84C]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <form method="GET" action="{{ route('admin.cats.index') }}"
          class="flex items-center gap-4 mb-6 px-1 flex-wrap">

        <select name="breed"
                onchange="this.form.submit()"
                class="pl-4 pr-8 py-2 rounded-full text-[13px] font-bold border-0 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 transition cursor-pointer appearance-none {{ request('breed') ? 'bg-[#C9A84C] text-white' : 'bg-[#EBE5DA] text-gray-700' }}">
            <option value="">All Breeds</option>
            <option value="unknown" {{ request('breed') === 'unknown' ? 'selected' : '' }}>Unknown Breed</option>
            @foreach($breeds as $breed)
                <option value="{{ $breed }}" {{ request('breed') === $breed ? 'selected' : '' }}>{{ $breed }}</option>
            @endforeach
        </select>

        <select name="status"
                onchange="this.form.submit()"
                class="pl-4 pr-8 py-2 rounded-full text-[13px] font-bold border-0 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 transition cursor-pointer appearance-none {{ request('status') ? 'bg-[#C9A84C] text-white' : 'bg-[#EBE5DA] text-gray-700' }}">
            <option value="">All Statuses</option>
            @foreach(['Available','Adopted','Lost'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>

        <select name="age"
                onchange="this.form.submit()"
                class="pl-4 pr-8 py-2 rounded-full text-[13px] font-bold border-0 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 transition cursor-pointer appearance-none {{ request('age') ? 'bg-[#C9A84C] text-white' : 'bg-[#EBE5DA] text-gray-700' }}">
            <option value="">All Ages</option>
            <option value="unknown" {{ request('age') === 'unknown' ? 'selected' : '' }}>Unknown Age</option>
            <option value="kitten"  {{ request('age') === 'kitten'  ? 'selected' : '' }}>Kitten (&lt; 1 yr)</option>
            <option value="young"   {{ request('age') === 'young'   ? 'selected' : '' }}>Young (1–3 yrs)</option>
            <option value="adult"   {{ request('age') === 'adult'   ? 'selected' : '' }}>Adult (4–7 yrs)</option>
            <option value="senior"  {{ request('age') === 'senior'  ? 'selected' : '' }}>Senior (8+ yrs)</option>
        </select>

        @if(request('breed') || request('status') || request('age') || request('search'))
            <a href="{{ route('admin.cats.index') }}"
               class="text-[12px] font-bold text-gray-400 hover:text-gray-600 underline underline-offset-2">
                Clear all
            </a>
        @endif

        <div class="ml-auto flex items-center gap-3">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search cat registry..."
                       class="pl-9 pr-4 py-2 rounded-full text-[13px] bg-white border border-[#E8E2D8] text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] w-52 transition">
                <svg class="absolute left-3 top-2.5 w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                </svg>
            </div>
            <button type="submit" class="px-5 py-2 rounded-full bg-[#C9A84C] hover:bg-[#b8963e] text-white text-[13px] font-bold transition shadow-md shadow-amber-600/20">
                Search
            </button>
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


</div>{{-- end max-w-7xl --}}
</x-admin-layout>
