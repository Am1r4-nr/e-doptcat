<x-admin-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">
            Manage Reports
        </h2>
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Reporter</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($reports as $report)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">{{ $report->type }}</td>
                                <td class="px-6 py-4">{{ $report->user->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                        {{ $report->status === 'Resolved' ? 'bg-green-100 text-green-800' : 
                                           ($report->status === 'Closed' ? 'bg-gray-100 text-gray-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ $report->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $report->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('admin.reports.show', $report) }}"
                                        class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                    <form action="{{ route('admin.reports.destroy', $report) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No reports found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
