<x-admin-layout>
<div class="mb-8">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">📅 Calendar Management</h2>
            <p class="text-gray-600 mt-1">Manage events and schedule activities</p>
        </div>
        <a href="{{ route('admin.calendar.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-lg hover:shadow-xl transition">
            <span>➕</span> New Event
        </a>
    </div>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-4 gap-4 mb-8">
    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-200">
        <div class="text-2xl font-bold text-blue-700">{{ DB::table('events')->where('status', 'Scheduled')->count() }}</div>
        <p class="text-sm text-blue-600">Scheduled</p>
    </div>
    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 border border-green-200">
        <div class="text-2xl font-bold text-green-700">{{ DB::table('events')->where('status', 'Ongoing')->count() }}</div>
        <p class="text-sm text-green-600">Ongoing</p>
    </div>
    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 border border-purple-200">
        <div class="text-2xl font-bold text-purple-700">{{ DB::table('events')->where('status', 'Completed')->count() }}</div>
        <p class="text-sm text-purple-600">Completed</p>
    </div>
    <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border border-red-200">
        <div class="text-2xl font-bold text-red-700">{{ DB::table('events')->count() }}</div>
        <p class="text-sm text-red-600">Total Events</p>
    </div>
</div>

<!-- Tabs for View Mode -->
<div class="mb-6 flex gap-2 border-b border-gray-200">
    <button class="px-4 py-2 border-b-2 border-blue-500 text-blue-600 font-medium" onclick="showView('list')">📋 List View</button>
    <button class="px-4 py-2 text-gray-600 font-medium hover:text-blue-600" onclick="showView('upcoming')">🕐 Upcoming Events</button>
</div>

<!-- Filters Section -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-8 border border-gray-100">
    <form method="GET" action="{{ route('admin.calendar.index') }}" class="flex gap-4 items-end flex-wrap">
        <!-- Search -->
        <div class="flex-1 min-w-xs">
            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search events..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Status Filter -->
        <div class="w-48">
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">All Statuses</option>
                <option value="Scheduled" {{ request('status') === 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                <option value="Ongoing" {{ request('status') === 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Cancelled" {{ request('status') === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <!-- Buttons -->
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow hover:shadow-lg transition">
            Filter
        </button>
        <a href="{{ route('admin.calendar.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-900 font-bold py-2 px-6 rounded-lg">
            Reset
        </a>
    </form>
</div>

<!-- List View -->
<div id="list-view" class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
    <table class="min-w-full">
        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">📌 Title</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">📅 Date & Time</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">📍 Location</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">🏷️ Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">👥 Registrations</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">⚙️ Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($events as $event)
            <tr class="hover:bg-blue-50 transition">
                <td class="px-6 py-4">
                    <div class="font-medium text-gray-900">{{ $event->title }}</div>
                    <div class="text-sm text-gray-500 line-clamp-1">{{ Str::limit($event->description, 50) }}</div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    <span class="font-medium">{{ $event->event_date->format('M d, Y') }}</span><br>
                    <span class="text-xs text-gray-500">{{ $event->event_date->format('H:i A') }}</span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    {{ $event->location ?? '—' }}
                </td>
                <td class="px-6 py-4">
                    <form action="{{ route('admin.calendar.updateStatus', $event) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()" class="text-xs rounded-lg border-0 px-3 py-2 font-semibold cursor-pointer {{ $event->status === 'Scheduled' ? 'bg-blue-100 text-blue-800' : ($event->status === 'Ongoing' ? 'bg-green-100 text-green-800' : ($event->status === 'Completed' ? 'bg-purple-100 text-purple-800' : 'bg-red-100 text-red-800')) }}">
                            <option value="Scheduled" {{ $event->status === 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="Ongoing" {{ $event->status === 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="Completed" {{ $event->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ $event->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="inline-block bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $event->registrations_count ?? 0 }}
                    </span>
                </td>
                <td class="px-6 py-4 flex gap-3">
                    <a href="{{ route('admin.calendar.show', $event) }}" class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-900 hover:bg-blue-50 px-2 py-1 rounded transition font-medium text-sm">👁️ View</a>
                    <a href="{{ route('admin.calendar.edit', $event) }}" class="inline-flex items-center gap-1 text-green-600 hover:text-green-900 hover:bg-green-50 px-2 py-1 rounded transition font-medium text-sm">✏️ Edit</a>
                    <form action="{{ route('admin.calendar.destroy', $event) }}" method="POST" onsubmit="return confirm('Delete this event?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 hover:bg-red-50 px-2 py-1 rounded transition font-medium text-sm">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-16 text-center">
                    <div class="text-4xl mb-3">📭</div>
                    <div class="text-lg font-semibold text-gray-700">No events found</div>
                    <p class="text-gray-500 mt-2">Create your first event to get started!</p>
                    <a href="{{ route('admin.calendar.create') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Create Event</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-8">
    {{ $events->links() }}
</div>

<script>
function showView(view) {
    const listView = document.getElementById('list-view');
    const buttons = document.querySelectorAll('button[onclick^="showView"]');
    
    buttons.forEach(btn => btn.classList.remove('border-b-2', 'border-blue-500', 'text-blue-600'));
    
    if (view === 'list') {
        listView.style.display = 'block';
        event.target.classList.add('border-b-2', 'border-blue-500', 'text-blue-600');
    }
}
</script>
</x-admin-layout>
