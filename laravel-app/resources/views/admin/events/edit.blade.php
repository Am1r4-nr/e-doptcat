<x-admin-layout>

<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.events.index') }}" class="text-gray-400 hover:text-amber-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
        </svg>
    </a>
    <div>
        <h1 class="text-3xl font-serif font-semibold text-gray-800">Edit Event</h1>
        <p class="text-sm text-gray-400 mt-0.5">{{ $event->title }}</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
    @csrf @method('PATCH')

    <div class="grid grid-cols-3 gap-6">
        <!-- Main fields -->
        <div class="col-span-2 space-y-5">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-amber-100 space-y-5">

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1.5">Event Title *</label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-300 @error('title') border-red-300 @enderror">
                    @error('title')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1.5">Description</label>
                    <textarea name="description" rows="5"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-300 resize-none">{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1.5">Date & Time *</label>
                        <input type="datetime-local" name="event_date"
                               value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" required
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-300 @error('event_date') border-red-300 @enderror">
                        @error('event_date')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1.5">Location</label>
                        <input type="text" name="location" value="{{ old('location', $event->location) }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-300">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar fields -->
        <div class="space-y-5">
            <!-- Status -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-amber-100">
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1.5">Status *</label>
                <select name="status" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-300">
                    @foreach(['Upcoming','Completed','Cancelled'] as $s)
                        <option value="{{ $s }}" {{ old('status', $event->status) === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Cover image -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-amber-100">
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2">Cover Image</label>
                @if($event->image)
                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}"
                         class="w-full h-28 object-cover rounded-xl mb-3">
                @endif
                <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-amber-200 rounded-xl cursor-pointer hover:border-amber-400 hover:bg-amber-50 transition">
                    <span class="text-xs text-gray-400">{{ $event->image ? 'Replace image' : 'Upload image' }}</span>
                    <input type="file" name="image" accept="image/*" class="hidden">
                </label>
                @error('image')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Actions -->
            <div class="flex gap-3">
                <a href="{{ route('admin.events.index') }}"
                   class="flex-1 text-center px-4 py-2.5 rounded-full border border-gray-200 text-sm font-semibold text-gray-600 hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="flex-1 px-4 py-2.5 rounded-full bg-amber-600 text-white text-sm font-semibold hover:bg-amber-700 transition">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</form>

</x-admin-layout>
