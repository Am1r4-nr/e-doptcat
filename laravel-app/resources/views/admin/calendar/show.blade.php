<x-admin-layout>
<!-- Page Header -->
<div class="mb-8 flex justify-between items-start">
    <div>
        <h2 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h2>
        <p class="text-gray-600 mt-1">Event Details</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.calendar.edit', $event) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2">
            <span>✏️</span> Edit
        </a>
        <form action="{{ route('admin.calendar.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2">
                <span>🗑️</span> Delete
            </button>
        </form>
    </div>
</div>

<div class="grid grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="col-span-2 space-y-6">
        <!-- Event Image -->
        @if($event->image)
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-96 object-cover">
        </div>
        @endif

        <!-- Description -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">About This Event</h3>
            <p class="text-gray-700 leading-relaxed">
                {{ $event->description ?? 'No description provided.' }}
            </p>
        </div>

        <!-- Registrations -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Registrations</h3>
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-bold">
                    {{ $event->registrations->count() ?? 0 }} Total
                </span>
            </div>

            @if($event->registrations && $event->registrations->count() > 0)
            <div class="space-y-3">
                @foreach($event->registrations as $registration)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-100">
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">{{ $registration->name ?? 'Unknown' }}</p>
                        <p class="text-sm text-gray-500">{{ $registration->email ?? $registration->user->email ?? 'N/A' }}</p>
                    </div>
                    <div class="text-right">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded text-xs font-bold">Registered</span>
                        <p class="text-xs text-gray-500 mt-1">{{ $registration->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <p class="text-gray-500">No registrations yet</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Status Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h4 class="font-semibold text-gray-900 mb-4">Event Status</h4>
            <form action="{{ route('admin.calendar.updateStatus', $event) }}" method="POST">
                @csrf
                @method('PATCH')
                <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $event->status === 'Scheduled' ? 'bg-blue-50 text-blue-700' : ($event->status === 'Ongoing' ? 'bg-green-50 text-green-700' : ($event->status === 'Completed' ? 'bg-gray-50 text-gray-700' : 'bg-red-50 text-red-700')) }} font-bold">
                    <option value="Scheduled" {{ $event->status === 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="Ongoing" {{ $event->status === 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="Completed" {{ $event->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Cancelled" {{ $event->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </form>
        </div>

        <!-- Date & Time -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h4 class="font-semibold text-gray-900 mb-4">📅 Date & Time</h4>
            <div class="space-y-3">
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold">Date</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $event->event_date->format('l, F d, Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold">Time</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $event->event_date->format('H:i A') }}</p>
                </div>
            </div>
        </div>

        <!-- Location -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h4 class="font-semibold text-gray-900 mb-4">📍 Location</h4>
            <p class="text-gray-700 font-medium">
                {{ $event->location ?? 'Not specified' }}
            </p>
        </div>

        <!-- Event Meta -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h4 class="font-semibold text-gray-900 mb-4">Event Info</h4>
            <div class="space-y-3 text-sm">
                <div>
                    <p class="text-gray-500">Created</p>
                    <p class="text-gray-900 font-medium">{{ $event->created_at->format('M d, Y - H:i A') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Last Updated</p>
                    <p class="text-gray-900 font-medium">{{ $event->updated_at->format('M d, Y - H:i A') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Event ID</p>
                    <p class="text-gray-900 font-medium font-mono">{{ $event->id }}</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-blue-50 rounded-lg border border-blue-200 p-6">
            <h4 class="font-semibold text-blue-900 mb-3">Quick Actions</h4>
            <div class="space-y-2">
                <a href="{{ route('admin.calendar.edit', $event) }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Event
                </a>
                <a href="{{ route('admin.calendar.index') }}" class="block w-full text-center bg-gray-300 hover:bg-gray-400 text-gray-900 font-bold py-2 px-4 rounded">
                    Back to Calendar
                </a>
            </div>
        </div>
    </div>
</div>
</x-admin-layout>
