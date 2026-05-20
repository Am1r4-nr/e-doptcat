<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
<<<<<<< HEAD
    .blob { animation: blobPulse 10s ease-in-out infinite; }
</style>

<div class="bg-cozy-bg min-h-screen">
    <!-- Cozy Hero -->
    <div class="relative pt-28 pb-16 overflow-hidden">
        <div class="absolute top-0 left-0 w-80 h-80 bg-cozy-warm/50 blob opacity-60 -translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
        <div class="absolute top-10 right-0 w-64 h-64 bg-cozy-accent/20 blob opacity-40 translate-x-1/3 pointer-events-none" style="animation-delay:-4s;"></div>
        <div class="relative z-10 text-center px-4">
            <p class="font-script text-3xl text-cozy-accent mb-2">Find Your Companion</p>
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-cozy-brown mb-4">Our Cats</h1>
            <div class="w-20 h-1 bg-cozy-accent/60 mx-auto rounded-full mb-4"></div>
            <p class="text-cozy-brown/60 max-w-xl mx-auto text-lg">
                Browse our lovely cats waiting for a forever home. Find your perfect match!
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">

            <!-- AI-Powered Recommendations Section -->
            <div class="mb-12 flex justify-center" id="aiRecommendationSection">
                <div class="bg-cozy-card p-8 rounded-2xl shadow-md border-2 border-cozy-warm/60 w-full max-w-6xl">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-cozy-accent" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <div>
                                <h3 class="text-2xl font-bold text-cozy-brown">AI-Powered Recommendations</h3>
                                <p class="text-cozy-brown/60 text-sm">Based on your preferences and home environment</p>
=======
    .blob { animation: blobPulse 8s ease-in-out infinite; }
</style>

    <div class="py-24 bg-cozy-bg min-h-screen relative overflow-hidden">
        
        <!-- Decorative blobs -->
        <div class="absolute top-0 right-[-10%] w-96 h-96 bg-[#F5DEB3] rounded-full blur-3xl opacity-50 -z-10"></div>
        <div class="absolute bottom-0 left-[-10%] w-96 h-96 bg-[#FFF4E3] rounded-full blur-3xl opacity-60 -z-10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="font-script font-bold text-6xl text-cozy-brown mb-4">
                    {{ __('Meet Our Cats') }}
                </h2>
                <div class="w-24 h-1 bg-cozy-brown/20 mx-auto rounded-full"></div>
                <p class="mt-6 text-cozy-brown/80 font-medium text-lg max-w-2xl mx-auto">
                    Browse our lovely companions waiting for a forever home. Find your perfect match today!
                </p>
            </div>

            <!-- AI-Powered Recommendations Section -->
            <div class="mb-12 flex justify-center" id="aiRecommendationSection">
                <div class="bg-[#F5DEB3] p-8 rounded-[2.5rem] shadow-lg border border-cozy-brown/10 w-full max-w-6xl relative overflow-hidden">
                    <!-- Abstract blob inside banner -->
                    <div class="absolute top-[-50%] right-[-20%] w-96 h-96 bg-[#E6C697] rounded-full blur-3xl opacity-60"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="bg-cozy-card p-3 rounded-2xl shadow-sm text-cozy-brown">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-3xl font-script font-bold text-cozy-brown">AI-Powered Matches</h3>
                                <p class="text-cozy-brown/80 font-medium">Based on your preferences and lifestyle</p>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                            </div>
                        </div>
                        <button type="button" onclick="toggleQuestionnaire()" class="bg-cozy-brown hover:bg-[#573D2B] text-cozy-card font-bold py-3 px-8 rounded-full transition-all shadow-md hover:-translate-y-1">
                            Find My Match
                        </button>
                    </div>

                    <!-- Questionnaire Form (Initially Hidden) -->
                    <form id="aiQuestionnaireForm" class="space-y-6 hidden relative z-10" method="POST" action="{{ route('cats.ai-preferences') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Energy Level Question -->
<<<<<<< HEAD
                            <div class="bg-cozy-bg p-6 rounded-xl border border-cozy-warm/40 shadow-sm">
                                <label class="block text-sm font-bold text-cozy-brown mb-4">⚡ On a scale of 1 to 5, what energy level are you looking for in a cat?</label>
                                <div class="space-y-3">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="energy_level" value="1" class="form-radio h-4 w-4 text-cozy-accent" required>
                                        <span class="ml-3 text-cozy-brown/80">1 - A 'chill' couch potato</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="energy_level" value="2" class="form-radio h-4 w-4 text-cozy-accent">
                                        <span class="ml-3 text-cozy-brown/80">2 - Mostly relaxed</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="energy_level" value="3" class="form-radio h-4 w-4 text-cozy-accent">
                                        <span class="ml-3 text-cozy-brown/80">3 - Balanced energy</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="energy_level" value="4" class="form-radio h-4 w-4 text-cozy-accent">
                                        <span class="ml-3 text-cozy-brown/80">4 - Quite playful</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="energy_level" value="5" class="form-radio h-4 w-4 text-cozy-accent">
                                        <span class="ml-3 text-cozy-brown/80">5 - High-energy explorer who loves to climb and play</span>
=======
                            <div class="bg-cozy-card p-6 rounded-[2rem] border border-cozy-brown/10 shadow-sm">
                                <label class="block text-sm font-bold text-cozy-brown mb-4">⚡ On a scale of 1 to 5, what energy level are you looking for?</label>
                                <div class="space-y-3">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="energy_level" value="1" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown" required>
                                        <span class="ml-3 text-cozy-brown/80 font-medium">1 - A 'chill' couch potato</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="energy_level" value="2" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown">
                                        <span class="ml-3 text-cozy-brown/80 font-medium">2 - Mostly relaxed</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="energy_level" value="3" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown">
                                        <span class="ml-3 text-cozy-brown/80 font-medium">3 - Balanced energy</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="energy_level" value="4" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown">
                                        <span class="ml-3 text-cozy-brown/80 font-medium">4 - Quite playful</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="energy_level" value="5" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown">
                                        <span class="ml-3 text-cozy-brown/80 font-medium">5 - High-energy explorer</span>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                    </label>
                                </div>
                            </div>

                            <!-- Ideal Bond Question -->
<<<<<<< HEAD
                            <div class="bg-cozy-bg p-6 rounded-xl border border-cozy-warm/40 shadow-sm">
                                <label class="block text-sm font-bold text-cozy-brown mb-4">💕 How would you describe your ideal bond?</label>
                                <div class="space-y-3">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="ideal_bond" value="velcro" class="form-radio h-4 w-4 text-cozy-accent" required>
                                        <span class="ml-3 text-cozy-brown/80">I want a 'velcro' cat that follows me everywhere</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="ideal_bond" value="independent" class="form-radio h-4 w-4 text-cozy-accent">
                                        <span class="ml-3 text-cozy-brown/80">I prefer a cat that is independent but enjoys occasional chin rubs</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="ideal_bond" value="challenge" class="form-radio h-4 w-4 text-cozy-accent">
                                        <span class="ml-3 text-cozy-brown/80">I enjoy the challenge of winning over a cautious cat</span>
=======
                            <div class="bg-cozy-card p-6 rounded-[2rem] border border-cozy-brown/10 shadow-sm">
                                <label class="block text-sm font-bold text-cozy-brown mb-4">💕 How would you describe your ideal bond?</label>
                                <div class="space-y-3">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="ideal_bond" value="velcro" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown" required>
                                        <span class="ml-3 text-cozy-brown/80 font-medium">I want a 'velcro' cat that follows me everywhere</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="ideal_bond" value="independent" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown">
                                        <span class="ml-3 text-cozy-brown/80 font-medium">I prefer a cat that is independent but enjoys occasional chin rubs</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="ideal_bond" value="challenge" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown">
                                        <span class="ml-3 text-cozy-brown/80 font-medium">I enjoy the challenge of winning over a cautious cat</span>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                    </label>
                                </div>
                            </div>

                            <!-- Talkative Cat Question -->
<<<<<<< HEAD
                            <div class="bg-cozy-bg p-6 rounded-xl border border-cozy-warm/40 shadow-sm">
                                <label class="block text-sm font-bold text-cozy-brown mb-4">🗣️ How do you feel about a 'talkative' cat?</label>
                                <div class="space-y-3">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="talkative_preference" value="loves_vocal" class="form-radio h-4 w-4 text-cozy-accent" required>
                                        <span class="ml-3 text-cozy-brown/80">I love a cat that communicates and meows frequently</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="talkative_preference" value="quiet" class="form-radio h-4 w-4 text-cozy-accent">
                                        <span class="ml-3 text-cozy-brown/80">I prefer a quiet companion who stays silent</span>
=======
                            <div class="bg-cozy-card p-6 rounded-[2rem] border border-cozy-brown/10 shadow-sm">
                                <label class="block text-sm font-bold text-cozy-brown mb-4">🗣️ How do you feel about a 'talkative' cat?</label>
                                <div class="space-y-3">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="talkative_preference" value="loves_vocal" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown" required>
                                        <span class="ml-3 text-cozy-brown/80 font-medium">I love a cat that communicates and meows frequently</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="talkative_preference" value="quiet" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown">
                                        <span class="ml-3 text-cozy-brown/80 font-medium">I prefer a quiet companion who stays silent</span>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                    </label>
                                </div>
                            </div>

                            <!-- Other Pets Question -->
<<<<<<< HEAD
                            <div class="bg-cozy-bg p-6 rounded-xl border border-cozy-warm/40 shadow-sm">
                                <label class="block text-sm font-bold text-cozy-brown mb-4">🐕 Does your household have other pets?</label>
                                <div class="space-y-3">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="other_pets" value="yes_seeking_feline_friends" class="form-radio h-4 w-4 text-cozy-accent" required>
                                        <span class="ml-3 text-cozy-brown/80">Yes, and I'm looking for a cat that proactively seeks out feline friends</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="other_pets" value="yes_independent" class="form-radio h-4 w-4 text-cozy-accent">
                                        <span class="ml-3 text-cozy-brown/80">Yes, but I need a cat that's comfortable being independent</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="other_pets" value="no" class="form-radio h-4 w-4 text-cozy-accent">
                                        <span class="ml-3 text-cozy-brown/80">No, this will be my only pet</span>
=======
                            <div class="bg-cozy-card p-6 rounded-[2rem] border border-cozy-brown/10 shadow-sm">
                                <label class="block text-sm font-bold text-cozy-brown mb-4">🐕 Does your household have other pets?</label>
                                <div class="space-y-3">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="other_pets" value="yes_seeking_feline_friends" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown" required>
                                        <span class="ml-3 text-cozy-brown/80 font-medium">Yes, looking for a cat that seeks out feline friends</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="other_pets" value="yes_independent" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown">
                                        <span class="ml-3 text-cozy-brown/80 font-medium">Yes, but I need a cat that's comfortable being independent</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="other_pets" value="no" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown">
                                        <span class="ml-3 text-cozy-brown/80 font-medium">No, this will be my only pet</span>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                    </label>
                                </div>
                            </div>

                            <!-- Medication & Personality Question -->
<<<<<<< HEAD
                            <div class="bg-cozy-bg p-6 rounded-xl border border-cozy-warm/40 shadow-sm md:col-span-2">
                                <label class="block text-sm font-bold text-cozy-brown mb-4">💊 Are you comfortable administering medication or handling a cat with a 'strong' personality?</label>
                                <div class="space-y-3">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="medication_comfort" value="yes_experienced" class="form-radio h-4 w-4 text-cozy-accent" required>
                                        <span class="ml-3 text-cozy-brown/80">Yes, I can handle a cat with an attitude</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="medication_comfort" value="no_docile" class="form-radio h-4 w-4 text-cozy-accent">
                                        <span class="ml-3 text-cozy-brown/80">No, I need a cat that is very docile and easy-going</span>
=======
                            <div class="bg-cozy-card p-6 rounded-[2rem] border border-cozy-brown/10 shadow-sm md:col-span-2">
                                <label class="block text-sm font-bold text-cozy-brown mb-4">💊 Are you comfortable administering medication or handling a cat with a 'strong' personality?</label>
                                <div class="space-y-3">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="medication_comfort" value="yes_experienced" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown" required>
                                        <span class="ml-3 text-cozy-brown/80 font-medium">Yes, I can handle a cat with an attitude</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="medication_comfort" value="no_docile" class="form-radio h-4 w-4 text-cozy-brown focus:ring-cozy-brown">
                                        <span class="ml-3 text-cozy-brown/80 font-medium">No, I need a cat that is very docile and easy-going</span>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-4 justify-end mt-8">
<<<<<<< HEAD
                            <button type="button" onclick="toggleQuestionnaire()" class="px-6 py-3 border-2 border-cozy-warm text-cozy-brown hover:border-cozy-brown hover:bg-cozy-warm/20 font-bold rounded-xl transition-all">
                                Cancel
                            </button>
                            <button type="submit" class="bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold py-3 px-8 rounded-xl transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
=======
                            <button type="button" onclick="toggleQuestionnaire()" class="px-6 py-3 bg-cozy-bg text-cozy-brown font-bold rounded-full transition-all hover:bg-cozy-brown/10">
                                Cancel
                            </button>
                            <button type="submit" class="bg-cozy-brown hover:bg-[#573D2B] text-cozy-card font-bold py-3 px-8 rounded-full transition-all shadow-md hover:-translate-y-1">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                Get AI Recommendations
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Filter -->
            <div class="mb-12 flex justify-center">
<<<<<<< HEAD
                <form method="GET" action="{{ route('cats.index') }}" class="bg-cozy-card p-6 rounded-2xl shadow-md border border-cozy-warm/40 w-full max-w-6xl">
                    <div class="flex flex-col sm:flex-row gap-3 items-end">
                        <!-- Breed Filter -->
                        <div class="relative flex-1">
                            <label class="block text-sm font-semibold text-cozy-brown mb-2">Breed</label>
                            <select name="breed" class="appearance-none w-full bg-cozy-bg border-0 text-cozy-brown py-2 px-4 pr-8 rounded-lg focus:ring-2 focus:ring-cozy-accent focus:bg-cozy-card transition-colors cursor-pointer">
=======
                <form method="GET" action="{{ route('cats.index') }}" class="bg-cozy-card p-6 rounded-[2.5rem] shadow-lg border border-cozy-brown/10 w-full max-w-6xl">
                    <div class="flex flex-col sm:flex-row gap-4 items-end">
                        <!-- Breed Filter -->
                        <div class="relative flex-1">
                            <label class="block text-sm font-bold text-cozy-brown mb-2">Breed</label>
                            <select name="breed" class="appearance-none w-full bg-[#F5DEB3] border border-cozy-brown/10 text-cozy-brown font-medium py-3 px-4 pr-10 rounded-2xl focus:ring-2 focus:ring-cozy-brown focus:bg-white transition-colors cursor-pointer">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                <option value="">All Breeds</option>
                                <option value="Siamese" {{ request('breed') == 'Siamese' ? 'selected' : '' }}>Siamese</option>
                                <option value="Persian" {{ request('breed') == 'Persian' ? 'selected' : '' }}>Persian</option>
                                <option value="Bengal" {{ request('breed') == 'Bengal' ? 'selected' : '' }}>Bengal</option>
                                <option value="Maine Coon" {{ request('breed') == 'Maine Coon' ? 'selected' : '' }}>Maine Coon</option>
                                <option value="Ragdoll" {{ request('breed') == 'Ragdoll' ? 'selected' : '' }}>Ragdoll</option>
                                <option value="Sphynx" {{ request('breed') == 'Sphynx' ? 'selected' : '' }}>Sphynx</option>
                                <option value="British Shorthair" {{ request('breed') == 'British Shorthair' ? 'selected' : '' }}>British Shorthair</option>
                                <option value="Domestic Shorthair" {{ request('breed') == 'Domestic Shorthair' ? 'selected' : '' }}>Domestic Shorthair</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 top-8 flex items-center text-cozy-brown/60">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                            </div>
                        </div>

                        <!-- Health Status Filter -->
                        <div class="relative flex-1">
<<<<<<< HEAD
                            <label class="block text-sm font-semibold text-cozy-brown mb-2">Health Status</label>
                            <select name="health_status" class="appearance-none w-full bg-cozy-bg border-0 text-cozy-brown py-2 px-4 pr-8 rounded-lg focus:ring-2 focus:ring-cozy-accent focus:bg-cozy-card transition-colors cursor-pointer">
=======
                            <label class="block text-sm font-bold text-cozy-brown mb-2">Health Status</label>
                            <select name="health_status" class="appearance-none w-full bg-[#F5DEB3] border border-cozy-brown/10 text-cozy-brown font-medium py-3 px-4 pr-10 rounded-2xl focus:ring-2 focus:ring-cozy-brown focus:bg-white transition-colors cursor-pointer">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                <option value="">All Status</option>
                                <option value="Healthy" {{ request('health_status') == 'Healthy' ? 'selected' : '' }}>Healthy</option>
                                <option value="Recovering" {{ request('health_status') == 'Recovering' ? 'selected' : '' }}>Recovering</option>
                                <option value="Treated" {{ request('health_status') == 'Treated' ? 'selected' : '' }}>Treated</option>
                                <option value="Under Observation" {{ request('health_status') == 'Under Observation' ? 'selected' : '' }}>Under Observation</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 top-8 flex items-center text-cozy-brown/60">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                            </div>
                        </div>

                        <!-- Vaccinated Filter -->
                        <div class="relative flex-1">
<<<<<<< HEAD
                            <label class="block text-sm font-semibold text-cozy-brown mb-2">Vaccinated</label>
                            <select name="vaccinated" class="appearance-none w-full bg-cozy-bg border-0 text-cozy-brown py-2 px-4 pr-8 rounded-lg focus:ring-2 focus:ring-cozy-accent focus:bg-cozy-card transition-colors cursor-pointer">
=======
                            <label class="block text-sm font-bold text-cozy-brown mb-2">Vaccinated</label>
                            <select name="vaccinated" class="appearance-none w-full bg-[#F5DEB3] border border-cozy-brown/10 text-cozy-brown font-medium py-3 px-4 pr-10 rounded-2xl focus:ring-2 focus:ring-cozy-brown focus:bg-white transition-colors cursor-pointer">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                <option value="">All Cats</option>
                                <option value="1" {{ request('vaccinated') == '1' ? 'selected' : '' }}>Vaccinated</option>
                                <option value="0" {{ request('vaccinated') == '0' ? 'selected' : '' }}>Not Vaccinated</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 top-8 flex items-center text-cozy-brown/60">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                            </div>
                        </div>

                        <!-- Location Filter -->
                        <div class="relative flex-1">
<<<<<<< HEAD
                            <label class="block text-sm font-semibold text-cozy-brown mb-2">Location</label>
                            <select name="location" class="appearance-none w-full bg-cozy-bg border-0 text-cozy-brown py-2 px-4 pr-8 rounded-lg focus:ring-2 focus:ring-cozy-accent focus:bg-cozy-card transition-colors cursor-pointer">
=======
                            <label class="block text-sm font-bold text-cozy-brown mb-2">Location</label>
                            <select name="location" class="appearance-none w-full bg-[#F5DEB3] border border-cozy-brown/10 text-cozy-brown font-medium py-3 px-4 pr-10 rounded-2xl focus:ring-2 focus:ring-cozy-brown focus:bg-white transition-colors cursor-pointer">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                <option value="">All Locations</option>
                                <option value="Cafe Asiah" {{ request('location') == 'Cafe Asiah' ? 'selected' : '' }}>Cafe Asiah</option>
                                <option value="AIKOL Building" {{ request('location') == 'AIKOL Building' ? 'selected' : '' }}>AIKOL Building</option>
                                <option value="IRK Building" {{ request('location') == 'IRK Building' ? 'selected' : '' }}>IRK Building</option>
                                <option value="Medical Center" {{ request('location') == 'Medical Center' ? 'selected' : '' }}>Medical Center</option>
                                <option value="Library Dar Al-Hikmah" {{ request('location') == 'Library Dar Al-Hikmah' ? 'selected' : '' }}>Library Dar Al-Hikmah</option>
                                <option value="Engineering Block" {{ request('location') == 'Engineering Block' ? 'selected' : '' }}>Engineering Block</option>
                                <option value="Rectory Building" {{ request('location') == 'Rectory Building' ? 'selected' : '' }}>Rectory Building</option>
                                <option value="Mahallah Ali" {{ request('location') == 'Mahallah Ali' ? 'selected' : '' }}>Mahallah Ali</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 top-8 flex items-center text-cozy-brown/60">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                            </div>
                        </div>

                        <!-- Filter Button -->
<<<<<<< HEAD
                        <button type="submit" class="bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold py-2 px-8 rounded-lg transition-all shadow-md whitespace-nowrap h-10">
                            🔍 Filter
=======
                        <button type="submit" class="bg-cozy-brown hover:bg-[#573D2B] text-cozy-card font-bold py-3 px-8 rounded-2xl transition-all shadow-md whitespace-nowrap h-12 flex items-center justify-center hover:-translate-y-1">
                            Filter
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                        </button>

                        <!-- Clear Button -->
                        @if(request('breed') || request('health_status') || request('vaccinated') || request('location'))
<<<<<<< HEAD
                            <a href="{{ route('cats.index') }}" class="flex items-center justify-center px-6 py-2 text-cozy-brown/60 hover:bg-cozy-warm/30 rounded-lg transition-colors font-semibold h-10 whitespace-nowrap">
                                ✕ Clear
=======
                            <a href="{{ route('cats.index') }}" class="flex items-center justify-center px-6 py-3 text-cozy-brown hover:bg-cozy-brown/10 rounded-2xl transition-colors font-bold h-12 whitespace-nowrap">
                                Clear
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(request('recommended') == 'true')
                    <div class="lg:col-span-3 mb-4 bg-[#F5DEB3] border border-cozy-brown/10 p-5 rounded-[2rem] flex items-center gap-3">
                        <span class="text-2xl">✨</span>
                        <p class="text-cozy-brown font-bold text-lg">Showing {{ count($cats) }} of your top AI-recommended matches!</p>
                    </div>
                @endif

                @forelse($cats as $cat)
<<<<<<< HEAD
                    <div class="bg-cozy-card rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-cozy-warm/40 flex flex-col h-full">
=======
                    <div class="bg-cozy-card rounded-[2.5rem] p-5 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-cozy-brown/10 flex flex-col h-full group">
                        
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                        <!-- Image Section -->
                        <div class="relative h-64 overflow-hidden rounded-[2rem] bg-[#E6C697] blob mb-6">
                            <img src="{{ $cat->image }}" alt="{{ $cat->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            <!-- AI Match Badge - Top Left -->
                            @if($cat->ai_match_score > 0)
<<<<<<< HEAD
                                <div class="absolute top-4 left-4 group">
                                    <div class="bg-cozy-accent text-cozy-light px-4 py-2 rounded-full text-sm font-bold flex items-center gap-2 shadow-lg hover:bg-cozy-brown cursor-help transition-colors">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
=======
                                <div class="absolute top-4 left-4 group/badge">
                                    <div class="bg-cozy-bg/90 backdrop-blur text-cozy-brown border border-cozy-brown/20 px-4 py-2 rounded-full text-sm font-bold flex items-center gap-2 shadow-lg">
                                        <svg class="w-4 h-4 fill-current text-cozy-brown" viewBox="0 0 20 20">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        {{ $cat->ai_match_score }}% Match
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Available Badge - Bottom Right -->
                            <div class="absolute bottom-4 right-4 bg-cozy-card text-cozy-brown px-4 py-2 rounded-full text-xs font-bold uppercase shadow-lg border border-cozy-brown/10">
                                {{ $cat->status }}
                            </div>
                        </div>
                        
                        <!-- Content Section -->
                        <div class="flex flex-col flex-grow px-2">
                            <!-- Name & Vaccinated -->
<<<<<<< HEAD
                            <div class="flex justify-between items-start mb-6">
                                <h3 class="text-3xl font-serif font-bold text-cozy-brown">
                                    {{ $cat->name }}
                                </h3>
                                @if($cat->vaccinated)
                                    <span class="bg-cozy-warm/30 text-cozy-brown text-sm font-semibold px-4 py-2 rounded-full border border-cozy-warm">
=======
                            <div class="flex justify-between items-end mb-4">
                                <h3 class="text-4xl font-script font-bold text-cozy-brown">
                                    {{ $cat->name }}
                                </h3>
                                @if($cat->vaccinated)
                                    <span class="bg-[#F5DEB3] text-cozy-brown text-xs font-bold px-3 py-1.5 rounded-full border border-cozy-brown/10">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                        Vaccinated
                                    </span>
                                @endif
                            </div>
                            
                            <div class="space-y-3 flex-grow mb-6">
                                <div class="flex flex-wrap gap-2">
                                    <span class="bg-cozy-bg text-cozy-brown text-xs font-bold px-3 py-1 rounded-lg">Age: {{ $cat->age }}</span>
                                    <span class="bg-cozy-bg text-cozy-brown text-xs font-bold px-3 py-1 rounded-lg">Health: {{ $cat->health_status ?? 'Healthy' }}</span>
                                </div>
                                
                                <p class="text-cozy-brown/80 flex items-center gap-2 font-medium text-sm mt-3">
                                    <svg class="w-4 h-4 text-cozy-brown/50" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $cat->location_name ?? 'Campus Location' }}
                                </p>
                            </div>
                            
                            <!-- Action Buttons -->
<<<<<<< HEAD
                            <div class="flex gap-4 mt-8 pt-6 border-t border-cozy-warm/40">
                                <button onclick="adoptCat({{ $cat->id }})" class="flex-1 bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold py-3 px-6 rounded-2xl transition-all flex items-center justify-center gap-2 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                    </svg>
                                    Adopt
                                </button>
                                <a href="{{ route('cats.show', $cat) }}" class="flex-1 border-2 border-cozy-warm text-cozy-brown hover:border-cozy-brown hover:bg-cozy-warm/20 font-bold py-3 px-6 rounded-2xl transition-all text-center">
=======
                            <div class="flex gap-3 mt-auto">
                                <button onclick="adoptCat({{ $cat->id }})" class="flex-1 bg-cozy-brown hover:bg-[#573D2B] text-cozy-card font-bold py-3 px-4 rounded-2xl transition-all flex items-center justify-center gap-2 shadow-md">
                                    Adopt
                                </button>
                                <a href="{{ route('cats.show', $cat) }}" class="flex-[0.5] bg-[#F5DEB3] hover:bg-[#E6C697] text-cozy-brown font-bold py-3 px-4 rounded-2xl transition-all text-center">
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                                    Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
<<<<<<< HEAD
                    <div class="lg:col-span-2 text-center py-16">
                        <div class="inline-block p-6 rounded-full bg-cozy-warm/30 mb-4 text-cozy-brown/50">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-serif font-bold text-cozy-brown mb-2">No cats found</h3>
                        <p class="text-gray-600 mb-6">Try adjusting your filter or check back later.</p>
=======
                    <div class="lg:col-span-3 text-center py-24 bg-cozy-card rounded-[3rem] border border-cozy-brown/10 shadow-lg">
                        <div class="inline-block p-6 rounded-full bg-[#F5DEB3] mb-6 text-cozy-brown/60">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-4xl font-script font-bold text-cozy-brown mb-3">No cats found</h3>
                        <p class="text-cozy-brown/80 mb-8 font-medium">Try adjusting your filter or check back later.</p>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                        @if(request('breed'))
                             <a href="{{ route('cats.index') }}" class="inline-block bg-cozy-brown text-cozy-card font-bold px-8 py-3 rounded-full hover:bg-[#573D2B]">View all cats</a>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function adoptCat(catId) {
            window.location.href = '/cats/' + catId + '/adopt';
        }

        function toggleQuestionnaire() {
            const form = document.getElementById('aiQuestionnaireForm');
            const section = document.getElementById('aiRecommendationSection');
            
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                form.classList.add('hidden');
            }
        }

        document.getElementById('aiQuestionnaireForm').addEventListener('submit', function(e) {
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            sessionStorage.setItem('aiPreferences', JSON.stringify(data));
        });
    </script>
</x-app-layout>