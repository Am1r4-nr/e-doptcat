<x-admin-layout>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">
                Adoption Details
            </h2>
            <a href="{{ route('admin.adoptions.index') }}"
                class="text-blue-600 hover:text-blue-900">← Back to List</a>
        </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-sm text-gray-600">Adopter Name</p>
                        <p class="text-lg font-medium">{{ $adoption->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Adopter Email</p>
                        <p class="text-lg font-medium">{{ $adoption->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Cat Name</p>
                        <p class="text-lg font-medium">{{ $adoption->cat->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                            {{ $adoption->status === 'Approved' ? 'bg-green-100 text-green-800' : 
                               ($adoption->status === 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ $adoption->status }}
                        </span>
                    </div>
                </div>

                @if ($adoption->status === 'Pending')
                    <div class="flex gap-4">
                        <form action="{{ route('admin.adoptions.approve', $adoption) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                {{ __('Approve Adoption') }}
                            </button>
                        </form>
                        <form action="{{ route('admin.adoptions.reject', $adoption) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                {{ __('Reject Adoption') }}
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
