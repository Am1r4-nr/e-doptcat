<x-admin-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">
            Manage Adoptions
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
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">User</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Cat</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($adoptions as $adoption)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">{{ $adoption->user->name }}</td>
                                <td class="px-6 py-4">{{ $adoption->cat->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                        {{ $adoption->status === 'Approved' ? 'bg-green-100 text-green-800' : 
                                           ($adoption->status === 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ $adoption->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $adoption->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('admin.adoptions.show', $adoption) }}"
                                        class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                    @if ($adoption->status === 'Pending')
                                        <form action="{{ route('admin.adoptions.approve', $adoption) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-600 hover:text-green-900 text-sm">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.adoptions.reject', $adoption) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Reject</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.adoptions.destroy', $adoption) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No adoptions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $adoptions->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
