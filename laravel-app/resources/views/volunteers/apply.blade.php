<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }

    input[type="checkbox"].skill-check:checked + label,
    input[type="radio"]:checked + div {
        border-color: #C8956D;
        background-color: rgba(200, 149, 109, 0.1);
        color: #C8956D;
    }
</style>

<div class="bg-cozy-bg min-h-screen relative overflow-hidden pb-24">

    <!-- Decorative blobs -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-cozy-warm/40 blob opacity-50 translate-x-1/4 -translate-y-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cozy-accent/15 blob opacity-40 -translate-x-1/4 translate-y-1/4 pointer-events-none" style="animation-delay:-5s;"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-6 pt-28">

        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-cozy-brown/60 text-sm font-bold">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('home') }}" class="hover:text-cozy-brown transition-colors">Home</a></li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                        <a href="{{ route('about') }}" class="hover:text-cozy-brown transition-colors">About</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                        <span class="text-cozy-brown font-semibold">Volunteer Registration</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="text-center mb-12 space-y-3">
            <p class="font-script text-3xl text-cozy-accent">Join the Family</p>
            <h1 class="font-serif font-bold text-5xl text-cozy-brown">Become a Volunteer</h1>
            <div class="w-24 h-1 bg-cozy-accent/60 mx-auto rounded-full"></div>
            <p class="font-sans text-cozy-brown/60 text-lg max-w-xl mx-auto">
                Help us care for campus cats. Whether you have an hour or a whole weekend, your time makes a real difference.
            </p>
        </div>

        <!-- Perks Banner -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">
            @foreach([
                ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'title' => 'Make a Difference', 'desc' => 'Directly improve the lives of campus cats in need.'],
                ['icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'title' => 'Join a Community', 'desc' => 'Connect with fellow animal lovers at IIUM.'],
                ['icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'title' => 'Earn Recognition', 'desc' => 'Receive a certificate of volunteership from AHC.'],
            ] as $perk)
            <div class="bg-cozy-card rounded-3xl border border-cozy-warm/40 p-6 text-center shadow-md">
                <div class="w-12 h-12 mx-auto bg-cozy-warm/60 text-cozy-accent rounded-full flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $perk['icon'] }}"/></svg>
                </div>
                <h3 class="font-serif font-bold text-cozy-brown text-lg mb-1">{{ $perk['title'] }}</h3>
                <p class="font-sans text-cozy-brown/60 text-sm">{{ $perk['desc'] }}</p>
            </div>
            @endforeach
        </div>

        <!-- Application Form -->
        <form method="POST" action="{{ route('volunteers.store') }}" class="space-y-8">
            @csrf

            <!-- Section 1: Personal Info -->
            <div class="bg-cozy-card rounded-3xl shadow-xl border border-cozy-warm/40 p-8 space-y-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 bg-cozy-warm/60 text-cozy-accent rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">1</div>
                    <h2 class="font-serif font-bold text-2xl text-cozy-brown">Personal Information</h2>
                </div>
                <div class="w-full h-px bg-cozy-warm/40"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-cozy-brown/60 mb-2 font-sans uppercase tracking-wider">Full Name <span class="text-red-400">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-3 text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition @error('name') border-red-400 @enderror"
                               placeholder="Your full name as per IC / student ID">
                        @error('name') <p class="mt-1 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
                    </div>

                    <!-- Matric -->
                    <div>
                        <label class="block text-xs font-bold text-cozy-brown/60 mb-2 font-sans uppercase tracking-wider">Matric No. <span class="text-cozy-brown/30 font-normal normal-case">(IIUM students)</span></label>
                        <input type="text" name="matric" value="{{ old('matric') }}"
                               class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-3 text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition"
                               placeholder="e.g. 2110000">
                    </div>

                    <!-- Program -->
                    <div>
                        <label class="block text-xs font-bold text-cozy-brown/60 mb-2 font-sans uppercase tracking-wider">Programme / Faculty</label>
                        <input type="text" name="program" value="{{ old('program') }}"
                               class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-3 text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition"
                               placeholder="e.g. Computer Science, KICT">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-bold text-cozy-brown/60 mb-2 font-sans uppercase tracking-wider">Email Address <span class="text-red-400">*</span></label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}"
                               class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-3 text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition @error('email') border-red-400 @enderror"
                               placeholder="your@email.com">
                        @error('email') <p class="mt-1 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-xs font-bold text-cozy-brown/60 mb-2 font-sans uppercase tracking-wider">Phone Number <span class="text-red-400">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-3 text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition @error('phone') border-red-400 @enderror"
                               placeholder="e.g. 012-3456789">
                        @error('phone') <p class="mt-1 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Section 2: Availability -->
            <div class="bg-cozy-card rounded-3xl shadow-xl border border-cozy-warm/40 p-8 space-y-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 bg-cozy-warm/60 text-cozy-accent rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">2</div>
                    <h2 class="font-serif font-bold text-2xl text-cozy-brown">Availability</h2>
                </div>
                <div class="w-full h-px bg-cozy-warm/40"></div>

                <!-- Days -->
                <div>
                    <label class="block text-xs font-bold text-cozy-brown/60 mb-3 font-sans uppercase tracking-wider">Which days can you volunteer? <span class="text-red-400">*</span></label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @foreach(['weekday' => 'Weekdays', 'weekend' => 'Weekends', 'both' => 'Both', 'flexible' => 'Flexible'] as $val => $label)
                        <label class="relative cursor-pointer">
                            <input type="radio" name="availability" value="{{ $val }}" class="sr-only peer"
                                   {{ old('availability') === $val ? 'checked' : '' }}>
                            <div class="w-full py-3 px-4 rounded-2xl border-2 border-cozy-warm/60 text-center font-sans text-cozy-brown/70 text-sm font-bold transition-all peer-checked:border-cozy-accent peer-checked:bg-cozy-accent/10 peer-checked:text-cozy-accent hover:border-cozy-accent/60">
                                {{ $label }}
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('availability') <p class="mt-1 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
                </div>

                <!-- Time of Day -->
                <div>
                    <label class="block text-xs font-bold text-cozy-brown/60 mb-3 font-sans uppercase tracking-wider">Preferred time of day <span class="text-red-400">*</span></label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @foreach(['morning' => 'Morning', 'afternoon' => 'Afternoon', 'evening' => 'Evening', 'anytime' => 'Anytime'] as $val => $label)
                        <label class="relative cursor-pointer">
                            <input type="radio" name="avail_time" value="{{ $val }}" class="sr-only peer"
                                   {{ old('avail_time') === $val ? 'checked' : '' }}>
                            <div class="w-full py-3 px-4 rounded-2xl border-2 border-cozy-warm/60 text-center font-sans text-cozy-brown/70 text-sm font-bold transition-all peer-checked:border-cozy-accent peer-checked:bg-cozy-accent/10 peer-checked:text-cozy-accent hover:border-cozy-accent/60">
                                {{ $label }}
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('avail_time') <p class="mt-1 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Section 3: Skills & Experience -->
            <div class="bg-cozy-card rounded-3xl shadow-xl border border-cozy-warm/40 p-8 space-y-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 bg-cozy-warm/60 text-cozy-accent rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">3</div>
                    <h2 class="font-serif font-bold text-2xl text-cozy-brown">Skills & Experience</h2>
                </div>
                <div class="w-full h-px bg-cozy-warm/40"></div>

                <!-- Skills checkboxes -->
                <div>
                    <label class="block text-xs font-bold text-cozy-brown/60 mb-3 font-sans uppercase tracking-wider">Relevant skills <span class="text-cozy-brown/30 font-normal normal-case">(select all that apply)</span></label>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['Cat Handling', 'Photography', 'Social Media', 'Veterinary Knowledge', 'Event Planning', 'Graphic Design', 'Fundraising', 'Transportation', 'First Aid', 'Teaching / Outreach'] as $skill)
                        <label class="cursor-pointer">
                            <input type="checkbox" name="skills[]" value="{{ $skill }}" class="sr-only peer"
                                   {{ in_array($skill, old('skills', [])) ? 'checked' : '' }}>
                            <span class="inline-block px-4 py-2 rounded-full border-2 border-cozy-warm/60 text-cozy-brown/60 text-sm font-sans font-bold transition-all peer-checked:border-cozy-accent peer-checked:bg-cozy-accent/10 peer-checked:text-cozy-accent hover:border-cozy-accent/50 select-none">
                                {{ $skill }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Past Experience -->
                <div>
                    <label class="block text-xs font-bold text-cozy-brown/60 mb-2 font-sans uppercase tracking-wider">Previous volunteer / animal care experience</label>
                    <textarea name="experience" rows="3"
                              class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-3 text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition resize-none"
                              placeholder="Tell us about any relevant experience — animal shelters, vet clinics, previous volunteering, etc. Leave blank if none.">{{ old('experience') }}</textarea>
                </div>

                <!-- Motivation / Bio -->
                <div>
                    <label class="block text-xs font-bold text-cozy-brown/60 mb-2 font-sans uppercase tracking-wider">Why do you want to volunteer with AHC? <span class="text-red-400">*</span></label>
                    <textarea name="bio" rows="4"
                              class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-3 text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition resize-none @error('bio') border-red-400 @enderror"
                              placeholder="Share your motivation, what you hope to contribute, and what makes you a great fit for our team...">{{ old('bio') }}</textarea>
                    @error('bio') <p class="mt-1 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Section 4: Terms -->
            <div class="bg-cozy-card rounded-3xl shadow-xl border border-cozy-warm/40 p-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-cozy-warm/60 text-cozy-accent rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">4</div>
                    <h2 class="font-serif font-bold text-2xl text-cozy-brown">Commitment & Agreement</h2>
                </div>
                <div class="w-full h-px bg-cozy-warm/40 mb-6"></div>

                <div class="bg-cozy-bg rounded-2xl p-6 border border-cozy-warm/40 mb-6 text-cozy-brown/70 font-sans text-sm leading-relaxed space-y-2">
                    <p>By submitting this form, you agree to:</p>
                    <ul class="list-disc list-inside space-y-1 ml-2">
                        <li>Attend an orientation session before your first shift.</li>
                        <li>Handle all animals with care and follow AHC's welfare guidelines.</li>
                        <li>Maintain respectful conduct towards fellow volunteers and team members.</li>
                        <li>Notify the team in advance if you are unable to fulfil a scheduled shift.</li>
                        <li>Understand that this is a voluntary role and does not constitute employment.</li>
                    </ul>
                </div>

                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" name="agree_terms" value="1"
                           class="mt-1 w-5 h-5 rounded border-cozy-warm/60 text-cozy-accent focus:ring-cozy-accent/50 @error('agree_terms') border-red-400 @enderror">
                    <span class="font-sans text-cozy-brown/70 text-sm">
                        I have read and agree to the volunteer commitments above. I understand my application will be reviewed by the AHC team. <span class="text-red-400">*</span>
                    </span>
                </label>
                @error('agree_terms') <p class="mt-2 text-sm text-red-500 font-sans">{{ $message }}</p> @enderror
            </div>

            <!-- Submit -->
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('about') }}"
                   class="inline-flex items-center justify-center px-8 py-4 bg-cozy-card border-2 border-cozy-warm hover:border-cozy-brown text-cozy-brown font-bold rounded-full transition-all hover:bg-cozy-warm/20 font-sans">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center justify-center px-10 py-4 bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold rounded-full shadow-lg hover:-translate-y-1 transition-all duration-300 font-sans text-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Submit Application
                </button>
            </div>
        </form>

    </div>
</div>
</x-app-layout>
