<x-admin-layout>
    <div>
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-4xl font-bold text-blue-600 mb-2">Cat Inventory</h2>
                <p class="text-gray-600">Manage and track your feline residents</p>
            </div>
            <a href="{{ route('admin.cats.create') }}"
                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                + Add New Cat
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search and Filter -->
        <div class="mb-6 flex gap-4">
            <div class="flex-1">
                <input type="text" placeholder="Search by name, breed, or ID..." 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <select class="px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>All Statuses</option>
                <option>Available</option>
                <option>Adopted</option>
                <option>Medical Hold</option>
                <option>Foster</option>
            </select>
        </div>

        <!-- Cats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($cats as $cat)
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition">
                    <!-- Image -->
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        @if($cat->image)
                            <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-5xl">🐱</span>
                        @endif
                    </div>

                    <!-- Status Badge -->
                    <div class="p-4">
                        <div class="mb-3">
                            @php
                                $statusColors = [
                                    'Available' => 'bg-green-500',
                                    'Adopted' => 'bg-blue-500',
                                    'Medical Hold' => 'bg-red-500',
                                    'Foster' => 'bg-orange-500'
                                ];
                                $statusColor = $statusColors[$cat->status] ?? 'bg-gray-500';
                            @endphp
                            <span class="inline-block px-3 py-1 text-white text-xs font-bold rounded-full {{ $statusColor }}">
                                {{ $cat->status }}
                            </span>
                        </div>

                        <!-- Name -->
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $cat->name }}</h3>

                        <!-- Breed -->
                        <p class="text-gray-600 text-sm mb-3">{{ $cat->breed ?? 'Unknown' }}</p>

                        <!-- Details -->
                        <div class="flex items-center gap-4 mb-4 text-sm text-gray-600">
                            <span>{{ $cat->age ?? 'N/A' }} years</span>
                            <span class="text-xl">{{ $cat->personality_match ?? 0 }}%</span>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('admin.cats.edit', $cat) }}"
                                class="flex-1 text-center px-3 py-2 text-blue-600 hover:bg-blue-50 rounded transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.cats.destroy', $cat) }}" method="POST"
                                onsubmit="return confirm('Are you sure?')" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-3 py-2 text-red-600 hover:bg-red-50 rounded transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">No cats found.</p>
                </div>
            @endforelse
        </div>

        {{ $cats->links() }}
    </div>
</x-admin-layout>
