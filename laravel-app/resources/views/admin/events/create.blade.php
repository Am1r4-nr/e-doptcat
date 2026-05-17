<x-admin-layout>

<div class="flex items-center justify-between mb-7 bg-[#3D3D3D] rounded-2xl px-5 py-3 shadow-sm">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.events.index') }}"
           class="w-8 h-8 flex items-center justify-center rounded-lg text-[#9A9A9A] hover:bg-[#4A4A4A] hover:text-white transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
        </a>
        <div class="w-px h-4 bg-[#555555]"></div>
        <p class="text-xs tracking-widest text-[#C9A84C] uppercase font-semibold">Events</p>
        <span class="text-sm text-[#555555]">·</span>
        <p class="text-sm font-semibold text-white">New Event</p>
        <span class="text-sm text-[#555555]">·</span>
        <p class="text-xs text-[#9A9A9A]">Fill in the details to create a sanctuary event</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-3 gap-6">
        <!-- Main fields -->
        <div class="col-span-2 space-y-5">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#E8E2D8] space-y-5">

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1.5">Event Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] @error('title') border-red-300 @enderror"
                           placeholder="e.g. Annual Adoption Fair">
                    @error('title')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1.5">Description</label>
                    <textarea name="description" rows="5"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] resize-none"
                              placeholder="Describe the event...">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1.5">Date & Time *</label>
                        <input type="datetime-local" name="event_date" value="{{ old('event_date') }}" required
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] @error('event_date') border-red-300 @enderror">
                        @error('event_date')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1.5">Location</label>
                        <input type="text" name="location" value="{{ old('location') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]"
                               placeholder="e.g. KL Convention Centre">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar fields -->
        <div class="space-y-5">
            <!-- Status -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#E8E2D8]">
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1.5">Status *</label>
                <select name="status" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
                    <option value="Upcoming" {{ old('status', 'Upcoming') === 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="Completed" {{ old('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Cancelled" {{ old('status') === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <!-- Image -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#E8E2D8]">
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1.5">Cover Image</label>
                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-amber-200 rounded-xl cursor-pointer hover:border-amber-400 hover:bg-[#FAF8F0] transition">
                    <svg class="w-7 h-7 text-amber-300 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                    </svg>
                    <span class="text-xs text-gray-400">Click to upload (max 2MB)</span>
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
                        class="flex-1 px-4 py-2.5 rounded-full bg-[#C9A84C] text-white text-sm font-semibold hover:bg-[#b8963e] transition">
                    Create Event
                </button>
            </div>
        </div>
    </div>
</form>

</x-admin-layout>
