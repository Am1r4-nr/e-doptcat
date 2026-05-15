<x-admin-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">
                Manage Incidents
            </h2>
            <a href="{{ route('admin.incidents.create') }}"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                + New Incident
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filters -->
        <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
            <form method="GET" action="{{ route('admin.incidents.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        <option value="">All Statuses</option>
                        <option value="Open" {{ request('status') === 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="In Progress" {{ request('status') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Resolved" {{ request('status') === 'Resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="Closed" {{ request('status') === 'Closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Severity</label>
                    <select name="severity" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        <option value="">All Severities</option>
                        <option value="Low" {{ request('severity') === 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ request('severity') === 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ request('severity') === 'High' ? 'selected' : '' }}>High</option>
                        <option value="Critical" {{ request('severity') === 'Critical' ? 'selected' : '' }}>Critical</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                    <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        <option value="">All Types</option>
                        <option value="Injured" {{ request('type') === 'Injured' ? 'selected' : '' }}>Injured</option>
                        <option value="Lost" {{ request('type') === 'Lost' ? 'selected' : '' }}>Lost</option>
                        <option value="Found" {{ request('type') === 'Found' ? 'selected' : '' }}>Found</option>
                        <option value="Missing" {{ request('type') === 'Missing' ? 'selected' : '' }}>Missing</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" name="search" placeholder="Location or description..." value="{{ request('search') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="w-full px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition">
                        Filter
                    </button>
                    <a href="{{ route('admin.incidents.index') }}" class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition text-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Incidents Table -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Severity</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Reported</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($incidents as $incident)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">
                                <span class="px-2 py-1 rounded text-sm font-medium
                                    {{ $incident->type === 'Injured' ? 'bg-red-100 text-red-800' : 
                                       ($incident->type === 'Lost' ? 'bg-yellow-100 text-yellow-800' :
                                       ($incident->type === 'Found' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800')) }}">
                                    {{ $incident->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $incident->location_name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-sm font-medium
                                    {{ $incident->severity === 'Critical' ? 'bg-red-100 text-red-800' : 
                                       ($incident->severity === 'High' ? 'bg-orange-100 text-orange-800' :
                                       ($incident->severity === 'Medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800')) }}">
                                    {{ $incident->severity }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    {{ $incident->status === 'Open' ? 'bg-blue-100 text-blue-800' : 
                                       ($incident->status === 'In Progress' ? 'bg-yellow-100 text-yellow-800' :
                                       ($incident->status === 'Resolved' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800')) }}">
                                    {{ $incident->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $incident->reported_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('admin.incidents.show', $incident) }}"
                                    class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                <a href="{{ route('admin.incidents.edit', $incident) }}"
                                    class="text-green-600 hover:text-green-900 text-sm">Edit</a>
                                <form action="{{ route('admin.incidents.destroy', $incident) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No incidents found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $incidents->links() }}
        </div>
    </div>
</x-admin-layout>
