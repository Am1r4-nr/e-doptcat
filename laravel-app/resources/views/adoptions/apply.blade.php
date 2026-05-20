<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }
</style>

<div class="bg-cozy-bg min-h-screen relative overflow-hidden pb-24">

    <!-- Decorative blobs -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-cozy-warm/40 blob opacity-50 translate-x-1/4 -translate-y-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cozy-accent/15 blob opacity-40 -translate-x-1/4 translate-y-1/4 pointer-events-none" style="animation-delay:-5s;"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-6 pt-28">

        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-cozy-brown/60 text-sm font-bold" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-cozy-brown transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                        <a href="{{ route('cats.index') }}" class="hover:text-cozy-brown transition-colors">Cats</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                        <a href="{{ route('cats.show', $cat) }}" class="hover:text-cozy-brown transition-colors">{{ $cat->name }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                        <span class="ml-1 text-cozy-brown font-semibold">Apply to Adopt</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="text-center mb-12 space-y-3">
            <p class="font-script text-3xl text-cozy-accent">Give a Forever Home</p>
            <h1 class="font-serif font-bold text-5xl text-cozy-brown">Adopt {{ $cat->name }}</h1>
            <div class="w-24 h-1 bg-cozy-accent/60 mx-auto rounded-full"></div>
            <p class="font-sans text-cozy-brown/60 text-lg max-w-xl mx-auto">Fill out the form below and our team will review your application and be in touch soon.</p>
        </div>

        <!-- Already Applied Notice -->
        @if($existingApplication)
        <div class="bg-amber-50 border border-amber-200 rounded-3xl p-6 mb-8 flex items-start gap-4">
            <svg class="w-6 h-6 text-amber-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div>
                <p class="font-bold text-amber-800 font-sans">You already applied for {{ $cat->name }}!</p>
                <p class="text-amber-700 text-sm font-sans mt-1">Your application is currently <span class="font-bold">{{ $existingApplication->pipeline_stage }}</span>. Our team will contact you soon.</p>
            </div>
        </div>
        @endif

        <!-- Cat Preview Card -->
        <div class="bg-cozy-card rounded-3xl shadow-xl border border-cozy-warm/40 p-6 mb-10 flex items-center gap-6">
            <div class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-cozy-warm/40 flex-shrink-0 bg-cozy-warm/30">
                @if($cat->image_url)
                    <img src="{{ Storage::url($cat->image_url) }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-cozy-brown/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                @endif
            </div>
            <div>
                <h3 class="font-serif font-bold text-2xl text-cozy-brown">{{ $cat->name }}</h3>
                <p class="font-sans text-cozy-brown/60 text-sm mt-1">{{ $cat->breed }} · {{ $cat->gender }} · {{ $cat->age }} yr old</p>
                <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase tracking-wide">{{ $cat->status }}</span>
            </div>
        </div>

        <!-- Application Form -->
        @if(!$existingApplication)
        <form method="POST" action="{{ route('adoptions.store', $cat) }}" class="space-y-8">
            @csrf

            <!-- Section 1: Personal Info -->
            <div class="bg-cozy-card rounded-3xl shadow-xl border border-cozy-warm/40 p-8 space-y-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 bg-cozy-warm/60 text-cozy-accent rounded-full flex items-center justify-center font-bold text-sm">1</div>
                    <h2 class="font-serif font-bold text-2xl text-cozy-brown">Personal Information</h2>
                </div>
                <div class="w-full h-px bg-cozy-warm/40"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-bold text-cozy-brown/70 mb-2 font-sans uppercase tracking-wider">Full Name <span class="text-red-400">*</span></label>
                        <input type="text" name="full_name" value="{{ old('full_name', auth()->user()->name) }}"
                               class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-3 text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition @error('full_name') border-red-400 @enderror"
                               placeholder="Your full name">
                        @error('full_name') <p class="mt-1 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-bold text-cozy-brown/70 mb-2 font-sans uppercase tracking-wider">Phone Number <span class="text-red-400">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-3 text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition @error('phone') border-red-400 @enderror"
                               placeholder="e.g. 012-3456789">
                        @error('phone') <p class="mt-1 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label class="block text-sm font-bold text-cozy-brown/70 mb-2 font-sans uppercase tracking-wider">Home Address <span class="text-red-400">*</span></label>
                    <textarea name="address" rows="3"
                              class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-3 text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition resize-none @error('address') border-red-400 @enderror"
                              placeholder="Your full home address">{{ old('address') }}</textarea>
                    @error('address') <p class="mt-1 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
                </div>

                <!-- Living Situation -->
                <div>
                    <label class="block text-sm font-bold text-cozy-brown/70 mb-2 font-sans uppercase tracking-wider">Living Situation <span class="text-red-400">*</span></label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3" x-data="{ selected: '{{ old('living_situation') }}' }">
                        @foreach(['house' => 'House', 'apartment' => 'Apartment', 'condo' => 'Condo', 'other' => 'Other'] as $value => $label)
                        <label class="relative cursor-pointer">
                            <input type="radio" name="living_situation" value="{{ $value }}" class="sr-only peer"
                                   {{ old('living_situation') === $value ? 'checked' : '' }}>
                            <div class="w-full py-3 px-4 rounded-2xl border-2 border-cozy-warm/60 text-center font-sans text-cozy-brown/70 text-sm font-bold transition-all peer-checked:border-cozy-accent peer-checked:bg-cozy-accent/10 peer-checked:text-cozy-accent hover:border-cozy-accent/60">
                                {{ $label }}
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('living_situation') <p class="mt-1 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Section 2: About You & Your Home -->
            <div class="bg-cozy-card rounded-3xl shadow-xl border border-cozy-warm/40 p-8 space-y-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 bg-cozy-warm/60 text-cozy-accent rounded-full flex items-center justify-center font-bold text-sm">2</div>
                    <h2 class="font-serif font-bold text-2xl text-cozy-brown">About You & Your Home</h2>
                </div>
                <div class="w-full h-px bg-cozy-warm/40"></div>

                <!-- Reason for Adopting -->
                <div>
                    <label class="block text-sm font-bold text-cozy-brown/70 mb-2 font-sans uppercase tracking-wider">Why do you want to adopt {{ $cat->name }}? <span class="text-red-400">*</span></label>
                    <textarea name="reason" rows="4"
                              class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-3 text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition resize-none @error('reason') border-red-400 @enderror"
                              placeholder="Tell us about your lifestyle, why you'd be a great match, and what kind of home {{ $cat->name }} will have...">{{ old('reason') }}</textarea>
                    @error('reason') <p class="mt-1 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
                </div>

                <!-- Pet Experience -->
                <div>
                    <label class="block text-sm font-bold text-cozy-brown/70 mb-2 font-sans uppercase tracking-wider">Experience with Pets <span class="text-red-400">*</span></label>
                    <textarea name="pet_experience" rows="3"
                              class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-3 text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition resize-none @error('pet_experience') border-red-400 @enderror"
                              placeholder="Have you owned cats or other pets before? Describe your experience...">{{ old('pet_experience') }}</textarea>
                    @error('pet_experience') <p class="mt-1 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
                </div>

                <!-- Other Pets -->
                <div>
                    <label class="block text-sm font-bold text-cozy-brown/70 mb-2 font-sans uppercase tracking-wider">Other Pets at Home</label>
                    <input type="text" name="other_pets" value="{{ old('other_pets') }}"
                           class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-3 text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition"
                           placeholder="e.g. 1 dog, 2 cats — or leave blank if none">
                </div>
            </div>

            <!-- Section 3: Terms -->
            <div class="bg-cozy-card rounded-3xl shadow-xl border border-cozy-warm/40 p-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-cozy-warm/60 text-cozy-accent rounded-full flex items-center justify-center font-bold text-sm">3</div>
                    <h2 class="font-serif font-bold text-2xl text-cozy-brown">Terms & Agreement</h2>
                </div>
                <div class="w-full h-px bg-cozy-warm/40 mb-6"></div>

                <div class="bg-cozy-bg rounded-2xl p-6 border border-cozy-warm/40 mb-6 space-y-3 text-cozy-brown/70 font-sans text-sm leading-relaxed">
                    <p>By submitting this application, you confirm that:</p>
                    <ul class="list-disc list-inside space-y-2 ml-2">
                        <li>All information provided is accurate and truthful.</li>
                        <li>You understand that submitting an application does not guarantee adoption approval.</li>
                        <li>You agree to a home visit or interview as part of the screening process.</li>
                        <li>You commit to providing a safe, loving, and permanent home for the cat.</li>
                        <li>You will comply with all adoption policies set by the Abu Hurairah Club (AHC).</li>
                    </ul>
                </div>

                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" name="agree_terms" value="1"
                           class="mt-1 w-5 h-5 rounded border-cozy-warm/60 text-cozy-accent focus:ring-cozy-accent/50 @error('agree_terms') border-red-400 @enderror">
                    <span class="font-sans text-cozy-brown/70 text-sm">
                        I have read and agree to the terms above. I understand that my application will be reviewed by the AHC team. <span class="text-red-400">*</span>
                    </span>
                </label>
                @error('agree_terms') <p class="mt-2 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
            </div>

            <!-- Submit -->
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('cats.show', $cat) }}"
                   class="inline-flex items-center justify-center px-8 py-4 bg-cozy-card border-2 border-cozy-warm hover:border-cozy-brown text-cozy-brown font-bold rounded-full transition-all hover:bg-cozy-warm/20 font-sans">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center justify-center px-10 py-4 bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold rounded-full shadow-lg hover:-translate-y-1 transition-all duration-300 font-sans text-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    Submit Application
                </button>
            </div>
        </form>
        @else
        <div class="text-center py-8">
            <a href="{{ route('cats.show', $cat) }}"
               class="inline-flex items-center gap-2 px-8 py-4 bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold rounded-full shadow-lg transition-all duration-300 font-sans">
                Back to {{ $cat->name }}'s Profile
            </a>
        </div>
        @endif

    </div>
</div>
</x-app-layout>
