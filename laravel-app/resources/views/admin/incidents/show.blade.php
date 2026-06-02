<x-admin-layout>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-jakarta text-3xl font-extrabold text-[#1C1A17] tracking-tight">
                Incident Details
            </h2>
            <a href="{{ route('admin.incidents.index') }}"
                class="text-blue-600 hover:text-blue-900">← Back to List</a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="text-sm text-gray-600">Type</p>
                    <span class="px-2 py-1 rounded text-sm font-medium
                        {{ $incident->type === 'Injured' ? 'bg-red-100 text-red-800' : 
                           ($incident->type === 'Lost' ? 'bg-yellow-100 text-yellow-800' :
                           ($incident->type === 'Found' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800')) }}">
                        {{ $incident->type }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status</p>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        {{ $incident->status === 'Open' ? 'bg-blue-100 text-blue-800' : 
                           ($incident->status === 'In Progress' ? 'bg-yellow-100 text-yellow-800' :
                           ($incident->status === 'Resolved' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800')) }}">
                        {{ $incident->status }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Severity</p>
                    <span class="px-2 py-1 rounded text-sm font-medium
                        {{ $incident->severity === 'Critical' ? 'bg-red-100 text-red-800' : 
                           ($incident->severity === 'High' ? 'bg-orange-100 text-orange-800' :
                           ($incident->severity === 'Medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800')) }}">
                        {{ $incident->severity }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Reported</p>
                    <p class="text-lg font-medium">{{ $incident->reported_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Location</p>
                    <p class="text-lg font-medium">{{ $incident->location_name ?? 'N/A' }}</p>
                </div>
                @if ($incident->cat)
                    <div>
                        <p class="text-sm text-gray-600">Related Cat</p>
                        <p class="text-lg font-medium">
                            <a href="{{ route('admin.cats.show', $incident->cat) }}" class="text-blue-600 hover:text-blue-900">
                                {{ $incident->cat->name }}
                            </a>
                        </p>
                    </div>
                @endif
                @if ($incident->user)
                    <div>
                        <p class="text-sm text-gray-600">Reported By</p>
                        <p class="text-lg font-medium">{{ $incident->user->name }}</p>
                    </div>
                @endif
                @if ($incident->latitude && $incident->longitude)
                    <div class="col-span-2">
                        <p class="text-sm text-gray-600">Coordinates</p>
                        <p class="text-lg font-medium">{{ $incident->latitude }}, {{ $incident->longitude }}</p>
                    </div>
                @endif
                <div class="col-span-2">
                    <p class="text-sm text-gray-600">Description</p>
                    <p class="text-lg font-medium whitespace-pre-wrap">{{ $incident->description ?? 'N/A' }}</p>
                </div>
                @if ($incident->resolved_at)
                    <div>
                        <p class="text-sm text-gray-600">Resolved At</p>
                        <p class="text-lg font-medium">{{ $incident->resolved_at->format('d M Y H:i') }}</p>
                    </div>
                @endif
            </div>

            <div class="flex gap-4 mt-6">
                <a href="{{ route('admin.incidents.edit', $incident) }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    Edit Incident
                </a>
                <form id="form-del-incident-show" action="{{ route('admin.incidents.destroy', $incident) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            onclick="showConfirmModal({ title: 'Delete Incident?', message: 'This action cannot be undone.', formId: 'form-del-incident-show' })"
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        Delete Incident
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
