<x-admin-layout>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">
                User Details
            </h2>
            <a href="{{ route('admin.users.index') }}"
                class="text-blue-600 hover:text-blue-900">← Back to List</a>
        </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="text-lg font-medium">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="text-lg font-medium">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Role</p>
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Joined</p>
                        <p class="text-lg font-medium">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                    @if ($user->phone)
                        <div>
                            <p class="text-sm text-gray-600">Phone</p>
                            <p class="text-lg font-medium">{{ $user->phone }}</p>
                        </div>
                    @endif
                    @if ($user->address)
                        <div>
                            <p class="text-sm text-gray-600">Address</p>
                            <p class="text-lg font-medium">{{ $user->address }}</p>
                        </div>
                    @endif
                </div>

                <div class="flex gap-4">
                    @if (auth()->id() !== $user->id)
                        <form action="{{ route('admin.users.role', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="role" value="{{ $user->role === 'admin' ? 'user' : 'admin' }}">
                            <button type="submit"
                                class="px-4 py-2 {{ $user->role === 'admin' ? 'bg-blue-500 hover:bg-blue-600' : 'bg-red-500 hover:bg-red-600' }} text-white rounded-lg transition">
                                {{ $user->role === 'admin' ? 'Remove Admin' : 'Make Admin' }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
