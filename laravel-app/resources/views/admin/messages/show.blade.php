<x-admin-layout>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-jakarta text-3xl font-extrabold text-[#1C1A17] tracking-tight">
                Message Details
            </h2>
            <a href="{{ route('admin.messages.index') }}"
                class="text-blue-600 hover:text-blue-900">← Back to List</a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <!-- Message Header -->
            <div class="border-b pb-6 mb-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">From</p>
                        <div class="font-semibold text-gray-900">{{ $message->sender->name }}</div>
                        <div class="text-sm text-gray-500">{{ $message->sender->email }}</div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">To</p>
                        <div class="font-semibold text-gray-900">{{ $message->receiver->name }}</div>
                        <div class="text-sm text-gray-500">{{ $message->receiver->email }}</div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Subject</p>
                        <div class="font-semibold text-gray-900">{{ $message->subject ?? '(No Subject)' }}</div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Date</p>
                        <div class="font-semibold text-gray-900">{{ $message->created_at->format('d M Y H:i:s') }}</div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Status</p>
                        @if ($message->isUnread())
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Unread
                            </span>
                        @else
                            <div>
                                <span class="px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 mr-2">
                                    Read
                                </span>
                                <div class="text-xs text-gray-500 mt-1">{{ $message->read_at->format('d M Y H:i') }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Message Content -->
            <div class="mb-8">
                <p class="text-sm text-gray-600 mb-4">Message Content</p>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 whitespace-pre-wrap text-gray-900 font-sans leading-relaxed">
                    {{ $message->content }}
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                @if ($message->isUnread())
                    <form action="{{ route('admin.messages.markAsRead', $message) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                            Mark as Read
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.messages.markAsUnread', $message) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                            Mark as Unread
                        </button>
                    </form>
                @endif
                <form id="form-del-message" action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            onclick="showConfirmModal({ title: 'Delete Message?', message: 'This action cannot be undone.', formId: 'form-del-message' })"
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        Delete Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
