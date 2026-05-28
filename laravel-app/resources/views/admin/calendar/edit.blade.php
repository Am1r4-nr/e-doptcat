<x-admin-layout>
<!-- Page Header -->
<div class="mb-8">
    <h2 class="font-jakarta text-3xl font-extrabold text-[#1C1A17] tracking-tight">Edit Event</h2>
    <p class="text-gray-600 mt-1">Update event details</p>
</div>

<!-- Form Card -->
<div class="bg-white rounded-lg shadow-sm border border-gray-100 max-w-2xl">
    <form action="{{ route('admin.calendar.update', $event) }}" method="POST" enctype="multipart/form-data" class="p-8">
        @csrf
        @method('PUT')

        <!-- Event Title -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Event Title <span class="text-red-500">*</span></label>
            <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}" placeholder="e.g., Cat Adoption Drive" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('title') ? 'border-red-500' : '' }}" required>
            @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Event Description -->
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea id="description" name="description" rows="5" placeholder="Describe the event details, activities, and what attendees can expect..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('description') ? 'border-red-500' : '' }}">{{ old('description', $event->description) }}</textarea>
            @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Event Date -->
        <div class="mb-6">
            <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">Event Date & Time <span class="text-red-500">*</span></label>
            <input type="datetime-local" id="event_date" name="event_date" value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('event_date') ? 'border-red-500' : '' }}" required>
            @error('event_date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Location -->
        <div class="mb-6">
            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
            <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}" placeholder="e.g., Central Park, Main Hall" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('location') ? 'border-red-500' : '' }}">
            @error('location')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Event Status -->
        <div class="mb-6">
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
            <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('status') ? 'border-red-500' : '' }}" required>
                <option value="">Select a status</option>
                <option value="Scheduled" {{ old('status', $event->status) === 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                <option value="Ongoing" {{ old('status', $event->status) === 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="Completed" {{ old('status', $event->status) === 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Cancelled" {{ old('status', $event->status) === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            @error('status')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Event Image -->
        <div class="mb-8">
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Event Image</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition cursor-pointer" id="imageDropZone">
                <input type="file" id="image" name="image" accept="image/*" class="hidden" onchange="displayImagePreview(event)">
                <div id="imagePlaceholder" {{ $event->image ? 'class=hidden' : '' }}>
                    <div class="text-4xl mb-2">📸</div>
                    <p class="text-gray-600">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB</p>
                </div>
                <div id="imagePreview" {{ $event->image ? '' : 'class=hidden' }}>
                    <img id="previewImage" src="{{ $event->image ? asset('storage/' . $event->image) : '' }}" alt="Preview" class="max-h-64 mx-auto rounded">
                    <button type="button" onclick="removeImagePreview()" class="mt-2 text-red-600 hover:text-red-800 text-sm font-medium">Remove</button>
                </div>
            </div>
            @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Form Actions -->
        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                Update Event
            </button>
            <a href="{{ route('admin.calendar.show', $event) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-900 font-bold py-2 px-6 rounded">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
    const imageDropZone = document.getElementById('imageDropZone');
    const imageInput = document.getElementById('image');

    imageDropZone.addEventListener('click', () => imageInput.click());

    imageDropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        imageDropZone.classList.add('border-blue-500');
    });

    imageDropZone.addEventListener('dragleave', () => {
        imageDropZone.classList.remove('border-blue-500');
    });

    imageDropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        imageDropZone.classList.remove('border-blue-500');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            displayImagePreview({ target: { files } });
        }
    });

    function displayImagePreview(event) {
        const files = event.target.files || event;
        if (files.length > 0) {
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('imagePlaceholder').classList.add('hidden');
                document.getElementById('imagePreview').classList.remove('hidden');
                document.getElementById('previewImage').src = e.target.result;
            };
            reader.readAsDataURL(files[0]);
        }
    }

    function removeImagePreview() {
        imageInput.value = '';
        document.getElementById('imagePlaceholder').classList.remove('hidden');
        document.getElementById('imagePreview').classList.add('hidden');
    }
</script>
</x-admin-layout>
