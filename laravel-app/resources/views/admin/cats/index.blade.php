<x-admin-layout>
    <!-- Page Header -->
    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-3xl font-serif font-semibold text-gray-800">Cat Directory</h1>
            <p class="text-sm text-gray-400 mt-1">Managing the life-cycle and care records of our feline residents<br>with boutique precision and digital transparency.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-center bg-white rounded-2xl px-5 py-3 shadow-sm border border-amber-100">
                <p class="text-2xl font-bold text-gray-800">{{ $cats->total() }}</p>
                <p class="text-[10px] tracking-widest text-amber-500 uppercase font-semibold">In Care</p>
            </div>
            <div class="text-center bg-amber-600 rounded-2xl px-5 py-3 shadow-sm">
                <p class="text-2xl font-bold text-white">{{ $cats->where('status', 'Available')->count() }}</p>
                <p class="text-[10px] tracking-widest text-amber-200 uppercase font-semibold">Available</p>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-amber-100 overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-amber-50 flex items-center justify-between gap-4">
            <p class="text-xs font-semibold text-gray-400 tracking-widest uppercase flex-shrink-0">Feline Registry</p>
            <div class="flex items-center gap-3 ml-auto">
                <div class="relative">
                    <input type="text" id="catSearch" placeholder="Search cat registry..."
                           class="pl-8 pr-4 py-1.5 text-sm bg-[#FAF6F0] border border-amber-100 rounded-full focus:outline-none focus:ring-1 focus:ring-amber-300 w-52">
                    <svg class="absolute left-2.5 top-2 w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                </div>
                <a href="{{ route('admin.cats.create') }}"
                   class="px-4 py-1.5 bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold rounded-full transition flex-shrink-0">
                    + Add New
                </a>
            </div>
        </div>

        <table class="w-full">
            <thead>
                <tr class="border-b border-amber-50">
                    <th class="px-6 py-3 text-left text-[10px] font-semibold text-gray-400 tracking-widest uppercase">Subject</th>
                    <th class="px-6 py-3 text-left text-[10px] font-semibold text-gray-400 tracking-widest uppercase">Breed & Visuals</th>
                    <th class="px-6 py-3 text-left text-[10px] font-semibold text-gray-400 tracking-widest uppercase">Age & Status</th>
                    <th class="px-6 py-3 text-left text-[10px] font-semibold text-gray-400 tracking-widest uppercase">Last Synced</th>
                    <th class="px-6 py-3 text-left text-[10px] font-semibold text-gray-400 tracking-widest uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-amber-50">
                @forelse ($cats as $cat)
                    @php
                        $statusStyle = match($cat->status) {
                            'Available'    => 'bg-green-100 text-green-700',
                            'Adopted'      => 'bg-blue-100 text-blue-700',
                            'Lost'         => 'bg-red-100 text-red-700',
                            default        => 'bg-gray-100 text-gray-600',
                        };
                        $dotColor = match($cat->status) {
                            'Available' => 'bg-green-400',
                            'Adopted'   => 'bg-blue-400',
                            'Lost'      => 'bg-red-400',
                            default     => 'bg-gray-400',
                        };
                    @endphp
                    <tr class="hover:bg-amber-50/40 transition">
                        <!-- Subject -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-amber-100 overflow-hidden flex-shrink-0 flex items-center justify-center">
                                    @if($cat->image)
                                        <img src="{{ asset("storage/{$cat->image}") }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.233c-.618 0-1.217-.247-1.605-.729A11.95 11.95 0 011 12c0-.43.023-.855.068-1.285C1.18 9.694 2.1 9 3.126 9h3.507z"/></svg>
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
                            <span class="inline-block w-2.5 h-2.5 rounded-full mt-1 {{ $dotColor }}"></span>
                        </td>

                        <!-- Age & Status -->
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-700 mb-1">
                                {{ $cat->age ? (is_numeric($cat->age) ? "{$cat->age} " . Str::plural('Year', (int)$cat->age) : $cat->age) : '—' }}
                                {{ $cat->age ? $cat->age . ' ' . Str::plural('Year', (int)$cat->age) : '—' }}
                            </p>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold tracking-wide uppercase {{ $statusStyle }}">
                                {{ $cat->status }}
                            </span>
                        </td>

                        <!-- Last Synced -->
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600">{{ $cat->updated_at->format('M d, Y') }}</p>
                            <p class="text-[10px] text-gray-400">{{ $cat->updated_at->format('g:i A') }}</p>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.cats.show', $cat) }}"
                                   class="p-1.5 rounded-lg text-gray-400 hover:bg-amber-50 hover:text-amber-600 transition" title="View">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </a>
                                <a href="{{ route('admin.cats.edit', $cat) }}"
                                   class="p-1.5 rounded-lg text-amber-600 hover:bg-amber-50 transition" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                                </a>
                                <form action="{{ route('admin.cats.destroy', $cat) }}" method="POST"
                                      onsubmit="return confirm('Delete {{ $cat->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-red-400 hover:bg-red-50 transition" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <p class="text-gray-400 font-serif italic text-lg">No felines in the registry yet.</p>
                            <a href="{{ route('admin.cats.create') }}" class="mt-4 inline-block text-sm text-amber-600 hover:underline">Add your first cat →</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($cats->hasPages())

            <div class="px-6 py-4 border-t border-amber-50">
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
