<x-admin-layout>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">
                Create New Incident
            </h2>
            <a href="{{ route('admin.incidents.index') }}"
                class="text-blue-600 hover:text-blue-900">← Back to List</a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('admin.incidents.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                    <select name="type" required
                        class="w-full px-3 py-2 border @error('type') border-red-500 @else border-gray-300 @enderror rounded-lg">
                        <option value="">-- Select Type --</option>
                        <option value="Injured" {{ old('type') === 'Injured' ? 'selected' : '' }}>Injured</option>
                        <option value="Lost" {{ old('type') === 'Lost' ? 'selected' : '' }}>Lost</option>
                        <option value="Found" {{ old('type') === 'Found' ? 'selected' : '' }}>Found</option>
                        <option value="Missing" {{ old('type') === 'Missing' ? 'selected' : '' }}>Missing</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Severity *</label>
                    <select name="severity" required
                        class="w-full px-3 py-2 border @error('severity') border-red-500 @else border-gray-300 @enderror rounded-lg">
                        <option value="">-- Select Severity --</option>
                        <option value="Low" {{ old('severity') === 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ old('severity') === 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ old('severity') === 'High' ? 'selected' : '' }}>High</option>
                        <option value="Critical" {{ old('severity') === 'Critical' ? 'selected' : '' }}>Critical</option>
                    </select>
                    @error('severity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" required
                        class="w-full px-3 py-2 border @error('status') border-red-500 @else border-gray-300 @enderror rounded-lg">
                        <option value="">-- Select Status --</option>
                        <option value="Open" {{ old('status') === 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="In Progress" {{ old('status') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Resolved" {{ old('status') === 'Resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="Closed" {{ old('status') === 'Closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Location Name</label>
                    <input type="text" name="location_name" value="{{ old('location_name') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg @error('location_name') border-red-500 @enderror"
                        placeholder="e.g., Central Park">
                    @error('location_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                        <input type="number" name="latitude" value="{{ old('latitude') }}" step="0.00000001"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg @error('latitude') border-red-500 @enderror"
                            placeholder="e.g., 40.7128">
                        @error('latitude')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                        <input type="number" name="longitude" value="{{ old('longitude') }}" step="0.00000001"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg @error('longitude') border-red-500 @enderror"
                            placeholder="e.g., -74.0060">
                        @error('longitude')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Related Cat</label>
                    <select name="cat_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        <option value="">-- Select Cat (Optional) --</option>
                        @foreach ($cats as $cat)
                            <option value="{{ $cat->id }}" {{ old('cat_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('cat_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg @error('description') border-red-500 @enderror"
                        placeholder="Detailed description of the incident...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        Create Incident
                    </button>
                    <a href="{{ route('admin.incidents.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
