<x-admin-layout>

<!-- Header -->
<div class="mb-8 flex items-start justify-between">
    <div>
        <h1 class="text-3xl font-cabinet font-semibold text-gray-800">Event Management</h1>
        <p class="text-sm text-gray-400 mt-1">Create and manage sanctuary events</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('home') }}" target="_blank"
           class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-semibold hover:bg-gray-50 transition">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253M3 12c0 .778.099 1.533.284 2.253"/>
            </svg>
            Preview Website
        </a>
        <a href="{{ route('admin.events.create') }}"
           class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#C9A84C] text-white text-sm font-semibold hover:bg-[#b8963e] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            New Event
        </a>
    </div>
</div>

<!-- Stats -->
<div class="grid grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-[#E8E2D8]">
        <p class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold mb-2">Total Events</p>
        <p class="text-4xl font-bold text-gray-800">{{ $total }}</p>
        <p class="text-xs text-gray-400 mt-1">All time</p>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-[#E8E2D8]">
        <p class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold mb-2">Upcoming</p>
        <p class="text-4xl font-bold text-[#C9A84C]">{{ $upcoming }}</p>
        <p class="text-xs text-gray-400 mt-1">Scheduled ahead</p>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-[#E8E2D8]">
        <p class="text-[10px] tracking-widest text-[#C9A84C] uppercase font-semibold mb-2">Completed</p>
        <p class="text-4xl font-bold text-teal-600">{{ $completed }}</p>
        <p class="text-xs text-gray-400 mt-1">Successfully held</p>
    </div>
    <div class="bg-[#C9A84C] rounded-2xl p-5 shadow-sm">
        <p class="text-[10px] tracking-widest text-[#E8D5A0] uppercase font-semibold mb-2">Cancelled</p>
        <p class="text-4xl font-bold text-white">{{ $cancelled }}</p>
        <p class="text-xs text-amber-300 mt-1">Called off</p>
    </div>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-teal-50 border border-teal-100 text-teal-700 rounded-2xl text-sm font-semibold">
        {{ session('success') }}
    </div>
@endif

<!-- Table -->
<div class="bg-white rounded-2xl shadow-sm border border-[#E8E2D8] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-[#FAF8F5]">
                <tr>
                    <th class="py-4 px-6 text-left text-[11px] font-bold text-gray-500 uppercase tracking-widest">Event</th>
                    <th class="py-4 px-6 text-left text-[11px] font-bold text-gray-500 uppercase tracking-widest">Date</th>
                    <th class="py-4 px-6 text-left text-[11px] font-bold text-gray-500 uppercase tracking-widest">Location</th>
                    <th class="py-4 px-6 text-center text-[11px] font-bold text-gray-500 uppercase tracking-widest">Registrations</th>
                    <th class="py-4 px-6 text-left text-[11px] font-bold text-gray-500 uppercase tracking-widest">Status</th>
                    <th class="py-4 px-6 text-right text-[11px] font-bold text-gray-500 uppercase tracking-widest">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($events as $event)
                    @php
                        $badge = match($event->status) {
                            'Upcoming'  => 'bg-[#FAF8F0] text-[#C9A84C]',
                            'Completed' => 'bg-teal-50 text-teal-700',
                            'Cancelled' => 'bg-red-50 text-red-600',
                            default     => 'bg-gray-100 text-gray-600',
                        };
                    @endphp
                    <tr class="hover:bg-[#FAF8F0]/40 transition">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                @if($event->image)
                                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}"
                                         class="w-10 h-10 rounded-xl object-cover flex-shrink-0">
                                @else
                                    <div class="w-10 h-10 rounded-xl bg-[#FAF8F0] flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $event->title }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ Str::limit($event->description, 45) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-600 whitespace-nowrap">
                            {{ $event->event_date->format('d M Y') }}
                            <p class="text-xs text-gray-400">{{ $event->event_date->format('g:i A') }}</p>
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-600">{{ $event->location ?? '—' }}</td>
                        <td class="py-4 px-6 text-center">
                            <span class="text-sm font-bold text-gray-700">{{ $event->registrations_count }}</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $badge }}">
                                {{ $event->status }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.events.edit', $event) }}"
                                   class="text-xs font-semibold text-[#C9A84C] hover:text-amber-800 transition">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.events.destroy', $event) }}"
                                      onsubmit="return confirm('Delete this event?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold text-red-400 hover:text-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-sm text-gray-400 italic font-cabinet">
                            No events yet. <a href="{{ route('admin.events.create') }}" class="text-[#C9A84C] not-italic font-semibold">Create one →</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($events->hasPages())
        <div class="px-6 py-4 border-t border-[#F0EBE3] flex items-center justify-between bg-[#FAF8F5]">
            <p class="text-xs text-gray-500 font-medium">
                Showing {{ $events->firstItem() }}–{{ $events->lastItem() }} of {{ $events->total() }} events
            </p>
            <div class="flex items-center gap-1">
                @if($events->onFirstPage())
                    <span class="w-8 h-8 flex items-center justify-center rounded-full text-gray-300 bg-white shadow-sm">&lsaquo;</span>
                @else
                    <a href="{{ $events->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 bg-white shadow-sm hover:bg-gray-50">&lsaquo;</a>
                @endif
                @foreach($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                    @if($page == $events->currentPage())
                        <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#C9A84C] text-white text-xs font-bold shadow">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 bg-white shadow-sm text-xs font-bold hover:bg-gray-50">{{ $page }}</a>
                    @endif
                @endforeach
                @if($events->hasMorePages())
                    <a href="{{ $events->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 bg-white shadow-sm hover:bg-gray-50">&rsaquo;</a>
                @else
                    <span class="w-8 h-8 flex items-center justify-center rounded-full text-gray-300 bg-white shadow-sm">&rsaquo;</span>
                @endif
            </div>
        </div>
    @endif
</div>

</x-admin-layout>
