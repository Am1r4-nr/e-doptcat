<x-admin-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">
                Manage Messages
            </h2>
            <div class="text-sm text-gray-600">
                <span class="font-semibold">{{ $stats['total'] }}</span> Total | 
                <span class="font-semibold text-red-600">{{ $stats['unread'] }}</span> Unread
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filters -->
        <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
            <form method="GET" action="{{ route('admin.messages.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        <option value="">All Messages</option>
                        <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread Only</option>
                        <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read Only</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" name="search" placeholder="Sender, receiver, subject..." value="{{ request('search') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="w-full px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition">
                        Filter
                    </button>
                    <a href="{{ route('admin.messages.index') }}" class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition text-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Messages Table -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">From</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">To</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Preview</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($messages as $message)
                        <tr class="hover:bg-gray-50 {{ $message->isUnread() ? 'bg-blue-50' : '' }}">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $message->sender->name }}</div>
                                <div class="text-xs text-gray-500">{{ $message->sender->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $message->receiver->name }}</div>
                                <div class="text-xs text-gray-500">{{ $message->receiver->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold">{{ $message->subject ?? '(No Subject)' }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-sm">
                                {{ Str::limit($message->content, 50) }}
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $message->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4">
                                @if ($message->isUnread())
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Unread
                                    </span>
                                @else
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Read
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('admin.messages.show', $message) }}"
                                    class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                @if ($message->isUnread())
                                    <form action="{{ route('admin.messages.markAsRead', $message) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 text-sm">Mark Read</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.messages.markAsUnread', $message) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-yellow-600 hover:text-yellow-900 text-sm">Mark Unread</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">No messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    </div>
</x-admin-layout>
