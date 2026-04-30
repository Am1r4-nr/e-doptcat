<x-admin-layout>
<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.cats.show', $cat) }}" class="text-gray-400 hover:text-amber-600 transition text-lg">←</a>
        <div>
            <p class="text-[10px] tracking-widest text-amber-500 uppercase font-semibold">Edit Record</p>
            <h1 class="text-3xl font-serif font-semibold text-gray-800">Update Feline Profile</h1>
            <p class="text-sm text-gray-400 mt-1">Modify the details for <span class="font-semibold text-gray-600">{{ $cat->name }}</span>.</p>
        </div>
    </div>

    <div class="grid grid-cols-5 gap-8">

        <!-- Form -->
        <div class="col-span-3">
            <form action="{{ route('admin.cats.update', $cat) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-7 space-y-5">

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 mb-1.5"><svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg> Name</label>
                            <input type="text" name="name" id="previewName" value="{{ old('name', $cat->name) }}" required
                                oninput="updatePreview()"
                                class="w-full px-4 py-2.5 text-sm bg-[#FAF6F0] border border-amber-100 rounded-xl focus:outline-none focus:ring-1 focus:ring-amber-300 @error('name') border-red-300 @enderror">
                            @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 mb-1.5"><svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/></svg> Breed</label>
                            <input type="text" name="breed" value="{{ old('breed', $cat->breed) }}" required
                                class="w-full px-4 py-2.5 text-sm bg-[#FAF6F0] border border-amber-100 rounded-xl focus:outline-none focus:ring-1 focus:ring-amber-300 @error('breed') border-red-300 @enderror">
                            @error('breed')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 mb-1.5"><svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z"/></svg> Colour</label>
                            <input type="text" name="color" id="previewColor" value="{{ old('color', $cat->color) }}"
                                oninput="updatePreview()"
                                class="w-full px-4 py-2.5 text-sm bg-[#FAF6F0] border border-amber-100 rounded-xl focus:outline-none focus:ring-1 focus:ring-amber-300">
                        </div>
                        <div>
                            <label class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 mb-1.5"><svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg> Age (yrs)</label>
                            <input type="number" name="age" value="{{ old('age', $cat->age) }}" required min="0"
                                class="w-full px-4 py-2.5 text-sm bg-[#FAF6F0] border border-amber-100 rounded-xl focus:outline-none focus:ring-1 focus:ring-amber-300 @error('age') border-red-300 @enderror">
                            @error('age')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 mb-1.5"><svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg> Status</label>
                            <select name="status" required
                                class="w-full px-4 py-2.5 text-sm bg-[#FAF6F0] border border-amber-100 rounded-xl focus:outline-none focus:ring-1 focus:ring-amber-300 @error('status') border-red-300 @enderror">
                                <option value="Available" {{ old('status', $cat->status) === 'Available' ? 'selected' : '' }}>Available</option>
                                <option value="Adopted"   {{ old('status', $cat->status) === 'Adopted'   ? 'selected' : '' }}>Adopted</option>
                                <option value="Lost"      {{ old('status', $cat->status) === 'Lost'      ? 'selected' : '' }}>Lost</option>
                            </select>
                            @error('status')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 mb-1.5"><svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg> Description</label>
                        <textarea name="description" rows="3"
                            class="w-full px-4 py-2.5 text-sm bg-[#FAF6F0] border border-amber-100 rounded-xl focus:outline-none focus:ring-1 focus:ring-amber-300 resize-none">{{ old('description', $cat->description) }}</textarea>
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 mb-1.5"><svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"/></svg> Profile Photography</label>
                        @if($cat->image)
                            <div class="mb-3 flex items-center gap-3">
                                <img src="{{ asset('storage/' . $cat->image) }}" class="w-16 h-16 rounded-xl object-cover border border-amber-100">
                                <p class="text-xs text-gray-400">Current photo. Upload a new one to replace it.</p>
                            </div>
                        @endif
                        <label for="image"
                            class="flex flex-col items-center justify-center gap-2 w-full h-28 bg-[#FAF6F0] border-2 border-dashed border-amber-200 rounded-xl cursor-pointer hover:border-amber-400 transition">
                            <svg class="w-9 h-9 text-amber-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                            <p class="text-sm font-medium text-gray-500">Upload new portrait</p>
                            <input type="file" id="image" name="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                        </label>
                        @error('image')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                            class="flex-1 py-3 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-full transition shadow-sm shadow-amber-200">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.cats.show', $cat) }}"
                            class="flex-1 py-3 text-center bg-[#FAF6F0] hover:bg-amber-50 text-gray-600 font-semibold rounded-full border border-amber-100 transition">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Preview -->
        <div class="col-span-2">
            <div class="bg-gray-800 rounded-2xl overflow-hidden shadow-lg">
                <div class="relative h-52 bg-gray-700 flex items-center justify-center">
                    @if($cat->image)
                        <img id="previewImg" src="{{ asset('storage/' . $cat->image) }}" class="w-full h-full object-cover">
                    @else
                        <img id="previewImg" src="" class="w-full h-full object-cover hidden">
                        <div id="previewPlaceholder" class="flex items-center justify-center">
                            <svg class="w-20 h-20 text-gray-500 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.75">
                                <path d="M8 4.5 L6.5 1.5 L11 5.5"/>
                                <path d="M16 4.5 L17.5 1.5 L13 5.5"/>
                                <circle cx="12" cy="13.5" r="7.5"/>
                                <circle cx="9.5" cy="12" r="1.2" fill="currentColor" stroke="none"/>
                                <circle cx="14.5" cy="12" r="1.2" fill="currentColor" stroke="none"/>
                                <path d="M10.5 15.5 Q12 17 13.5 15.5" stroke-linecap="round"/>
                                <line x1="2.5" y1="13.5" x2="6.5" y2="14"/>
                                <line x1="2.5" y1="15.5" x2="6.5" y2="15"/>
                                <line x1="21.5" y1="13.5" x2="17.5" y2="14"/>
                                <line x1="21.5" y1="15.5" x2="17.5" y2="15"/>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-gray-900/80 to-transparent p-4">
                        <p class="text-[10px] tracking-widest text-amber-400 uppercase font-semibold">Profile Preview</p>
                        <p class="text-xl font-serif font-semibold text-white" id="previewNameDisplay">{{ $cat->name }}</p>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex gap-2 mb-3">
                        <span id="previewColorTag" class="px-2.5 py-0.5 bg-gray-600 text-gray-200 text-[10px] font-bold uppercase rounded-full tracking-wide">{{ $cat->color ?? 'Colour' }}</span>
                        <span class="px-2.5 py-0.5 bg-amber-600 text-white text-[10px] font-bold uppercase rounded-full tracking-wide">{{ $cat->status }}</span>
                    </div>
                    <p class="text-xs text-gray-400 italic leading-relaxed">
                        "{{ $cat->description ? Str::limit($cat->description, 100) : 'Every feline has a story waiting to be written in a forever home.' }}"
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updatePreview() {
    const name = document.getElementById('previewName').value;
    const color = document.getElementById('previewColor').value;
    document.getElementById('previewNameDisplay').textContent = name || 'New Resident';
    document.getElementById('previewColorTag').textContent = color || 'Colour';
}
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('previewImg');
            img.src = e.target.result;
            img.classList.remove('hidden');
            const ph = document.getElementById('previewPlaceholder');
            if (ph) ph.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</x-admin-layout>
