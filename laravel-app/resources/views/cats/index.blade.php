<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }
</style>

<div class="bg-cozy-bg min-h-screen pb-24 relative overflow-hidden">

    <!-- Decorative blobs -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-cozy-warm/40 blob opacity-50 translate-x-1/4 -translate-y-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cozy-accent/15 blob opacity-40 -translate-x-1/4 translate-y-1/4 pointer-events-none" style="animation-delay:-5s;"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 pt-28">

        <!-- Hero heading -->
        <div class="text-center mb-16">
            <p class="font-script text-3xl text-cozy-accent mb-1">Find Your Companion</p>
            <h1 class="font-serif font-bold text-5xl md:text-6xl text-cozy-brown mb-4">Our Rescued Cats</h1>
            <div class="w-24 h-1 bg-cozy-accent/60 mx-auto rounded-full mb-6"></div>
            <p class="text-cozy-brown/60 max-w-xl mx-auto text-lg">Every cat here is waiting for a loving forever home. Could one of them be yours?</p>
        </div>

        <!-- AI Matchmaker -->
        <div class="bg-cozy-card rounded-3xl shadow-xl p-8 mb-16 max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between gap-8 border border-cozy-warm/40 relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-32 h-32 bg-cozy-warm/50 blob opacity-60 pointer-events-none"></div>
            <div class="relative z-10">
                <p class="font-script text-2xl text-cozy-accent mb-1">Powered by AI</p>
                <h3 class="font-serif font-bold text-3xl text-cozy-brown mb-2">AI Matchmaker</h3>
                <p class="text-cozy-brown/60 text-sm">Let our AI recommend the perfect cat based on your lifestyle.</p>
            </div>
            <div x-data class="relative z-10 text-center flex-shrink-0">
                <button @click="$dispatch('open-modal', 'ai-matchmaker')"
                    class="whitespace-nowrap px-8 py-3.5 bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold rounded-full shadow-md transition-colors duration-300">
                    Find My Match ✨
                </button>
            </div>
        </div>

        @if($cats->isEmpty())
        <div class="text-center py-20 bg-cozy-card rounded-3xl max-w-2xl mx-auto shadow-xl border border-cozy-warm/40">
            <p class="font-script text-4xl text-cozy-accent mb-3">No cats yet...</p>
            <h3 class="font-serif text-2xl font-bold text-cozy-brown mb-2">No cats available right now</h3>
            <p class="text-cozy-brown/60">Please check back later or contact us about upcoming rescues.</p>
        </div>
        @else
        <!-- Cats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($cats as $cat)
            <div class="bg-cozy-card rounded-[2rem] shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col border border-cozy-warm/30 overflow-hidden">

                <!-- Image -->
                <div class="relative aspect-square overflow-hidden">
                    @if($cat->image_url)
                        <img src="{{ Storage::url($cat->image_url) }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-cozy-warm/30 flex items-center justify-center text-cozy-brown/40">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </div>
                    @endif

                    @if($cat->status === 'Adopted')
                        <div class="absolute inset-0 bg-white/50 backdrop-blur-[2px] flex items-center justify-center">
                            <span class="px-6 py-2 bg-cozy-brown text-cozy-light font-script text-3xl rotate-[-12deg] shadow-lg rounded-xl">Adopted!</span>
                        </div>
                    @elseif($cat->status === 'Pending')
                        <div class="absolute top-3 right-3 bg-amber-100/90 text-amber-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                            Pending
                        </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="flex-grow flex flex-col p-5">
                    <div class="flex justify-between items-end mb-2 border-b border-cozy-warm/40 pb-3">
                        <h3 class="font-script text-3xl text-cozy-brown">{{ $cat->name }}</h3>
                        <span class="text-xs font-bold text-cozy-brown/60">{{ $cat->age }} {{ Str::plural('yr', (int) $cat->age) }}</span>
                    </div>

                    <div class="flex items-center gap-2 text-xs text-cozy-brown/70 mb-3 font-bold uppercase tracking-wider">
                        <span>{{ $cat->gender }}</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-cozy-accent"></span>
                        <span>{{ $cat->breed ?? 'Mixed Breed' }}</span>
                    </div>

                    <p class="text-sm text-cozy-brown/70 line-clamp-3 mb-5 flex-grow leading-relaxed">{{ $cat->description }}</p>

                    <a href="{{ route('cats.show', $cat) }}"
                       class="block w-full py-3 text-center rounded-full bg-cozy-brown hover:bg-cozy-accent text-cozy-light text-sm font-bold shadow-sm transition-colors duration-300">
                        Meet {{ $cat->name }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        @if($cats instanceof \Illuminate\Pagination\LengthAwarePaginator && $cats->hasPages())
        <div class="mt-16 flex justify-center">
            {{ $cats->links() }}
        </div>
        @endif
        @endif
    </div>

    <!-- AI Matchmaker Modal -->
    <x-modal name="ai-matchmaker" maxWidth="md">
        <div class="p-8 bg-cozy-card relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-cozy-warm/50 blob opacity-60 -translate-y-10 translate-x-10 pointer-events-none"></div>
            <p class="font-script text-2xl text-cozy-accent mb-1 relative z-10">Tell us about yourself</p>
            <h2 class="font-serif font-bold text-3xl text-cozy-brown mb-2 relative z-10">Perfect Match</h2>
            <p class="text-cozy-brown/60 mb-8 relative z-10 text-sm">Answer a few questions and we'll find your ideal companion.</p>

            <form action="{{ route('cats.ai-preferences') }}" method="POST" class="space-y-5 relative z-10 text-sm">
                @csrf
                <div>
                    <label class="block font-bold text-cozy-brown mb-2 text-xs uppercase tracking-wider">Living situation?</label>
                    <select name="living_situation" required
                        class="w-full rounded-2xl border-cozy-warm bg-cozy-light focus:border-cozy-accent focus:ring-0 text-cozy-brown py-3 px-4">
                        <option value="apartment">Apartment</option>
                        <option value="house_no_yard">House (no yard)</option>
                        <option value="house_yard">House (with yard)</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-cozy-brown mb-2 text-xs uppercase tracking-wider">Time daily?</label>
                    <select name="time_commitment" required
                        class="w-full rounded-2xl border-cozy-warm bg-cozy-light focus:border-cozy-accent focus:ring-0 text-cozy-brown py-3 px-4">
                        <option value="low">1–2 hours</option>
                        <option value="medium">3–4 hours</option>
                        <option value="high">5+ hours</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-cozy-brown mb-2 text-xs uppercase tracking-wider">Other pets?</label>
                    <select name="other_pets" required
                        class="w-full rounded-2xl border-cozy-warm bg-cozy-light focus:border-cozy-accent focus:ring-0 text-cozy-brown py-3 px-4">
                        <option value="no">No other pets</option>
                        <option value="cats">Yes, cats</option>
                        <option value="dogs">Yes, dogs</option>
                        <option value="both">Both</option>
                    </select>
                </div>
                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" @click="$dispatch('close')"
                        class="px-6 py-3 rounded-full text-cozy-brown font-bold hover:bg-cozy-warm/30 transition-colors">Cancel</button>
                    <button type="submit"
                        class="px-6 py-3 rounded-full bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold transition-colors shadow-md">Match</button>
                </div>
            </form>
        </div>
    </x-modal>

</div>
</x-app-layout>
