<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    @keyframes floatY {
        0%,100% { transform: translateY(0px); }
        50%      { transform: translateY(-12px); }
    }
    @keyframes floatY2 {
        0%,100% { transform: translateY(0px) rotate(2deg); }
        50%      { transform: translateY(-8px) rotate(-1deg); }
    }
    .blob-anim { animation: blobPulse 12s ease-in-out infinite; }
    .float-1   { animation: floatY  7s  ease-in-out infinite; }
    .float-2   { animation: floatY2 9s  ease-in-out 1s infinite; }
    .float-3   { animation: floatY  11s ease-in-out 2s infinite; }
    .scroll-reveal { opacity:0; transform:translateY(28px); transition: opacity .9s cubic-bezier(.22,1,.36,1), transform .9s cubic-bezier(.22,1,.36,1); }
    .scroll-reveal.visible { opacity:1; transform:translateY(0); }
</style>

{{-- ═══════════════════════ HERO ═══════════════════════ --}}
<section class="relative min-h-screen bg-white overflow-hidden flex items-center">

    {{-- Primary tan blob — the dominant visual --}}
    <div class="absolute top-0 left-0 w-[68%] h-[95%] bg-cozy-bg blob-anim pointer-events-none"
         style="border-radius:0 55% 45% 0/0 45% 55% 0; animation-duration:14s;"></div>

    {{-- Secondary accent blob --}}
    <div class="absolute bottom-[-8%] right-[-5%] w-[38%] h-[55%] bg-cozy-warm/70 blob-anim pointer-events-none"
         style="animation-delay:-6s; animation-duration:18s;"></div>

    {{-- Dot pattern on blob --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.035]"
         style="background-image:radial-gradient(circle,#3C2415 1px,transparent 1px);background-size:24px 24px;"></div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-10 pt-28 pb-16 flex flex-col lg:flex-row items-center gap-8 lg:gap-0">

        {{-- ── Left: text ── --}}
        <div class="lg:w-[52%] scroll-reveal">
            <p class="font-script text-3xl md:text-4xl text-cozy-accent mb-1 leading-none">Abu Hurairah Club</p>
            <h1 class="font-serif font-bold text-6xl md:text-8xl text-cozy-brown leading-[1.02] mb-6">
                Adopt,<br>
                <em class="not-italic text-cozy-accent">Don't Shop</em>
            </h1>
            <p class="text-cozy-brown/60 text-lg md:text-xl font-light leading-relaxed max-w-md mb-10">
                Rescue, rehabilitate, and rehome stray cats.<br>
                Real-time adoption at your fingertips.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('cats.index') }}"
                   class="inline-flex items-center gap-2 px-8 py-4 bg-cozy-brown text-cozy-light font-bold rounded-2xl shadow-xl hover:bg-cozy-accent hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 text-[15px]">
                    Find a Companion
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('donations.index') }}"
                   class="inline-flex items-center gap-2 px-8 py-4 bg-transparent border-2 border-cozy-brown text-cozy-brown font-bold rounded-2xl hover:bg-cozy-brown hover:text-cozy-light transition-all duration-300 text-[15px]">
                    Make a Donation
                </a>
            </div>

            {{-- Floating mini stat cards --}}
            <div class="mt-14 flex flex-wrap gap-4">
                @foreach([['🐾','200+','Cats Adopted'],['🏠','50+','Happy Homes'],['❤️','94%','Success Rate']] as $s)
                <div class="bg-cozy-card/90 backdrop-blur-sm border border-cozy-warm/60 rounded-2xl px-5 py-3 shadow-md flex items-center gap-3 float-{{ ['1','2','3'][array_search($s, [['🐾','200+','Cats Adopted'],['🏠','50+','Happy Homes'],['❤️','94%','Success Rate']])] }}">
                    <span class="text-2xl">{{ $s[0] }}</span>
                    <div>
                        <p class="text-xl font-serif font-bold text-cozy-brown leading-none">{{ $s[1] }}</p>
                        <p class="text-[11px] text-cozy-brown/50 uppercase tracking-wider font-semibold">{{ $s[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── Right: overlapping image ── --}}
        <div class="lg:w-[48%] relative flex justify-center lg:justify-end scroll-reveal" style="transition-delay:.15s">

            {{-- Decorative ring --}}
            <div class="absolute top-1/2 right-4 -translate-y-1/2 w-[90%] h-[90%] border-[3px] border-cozy-warm/50 rounded-[3rem] pointer-events-none" style="transform:translateY(-48%) rotate(4deg);"></div>

            {{-- Main cat image --}}
            <div class="relative w-full max-w-sm lg:max-w-none lg:w-[88%] rounded-[2.5rem] overflow-hidden shadow-2xl border-[5px] border-cozy-card float-2">
                <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=900&q=80"
                     alt="Rescue cat" class="w-full h-[460px] object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>

                {{-- Live rescue badge --}}
                <div class="absolute bottom-5 left-5 bg-cozy-card/95 backdrop-blur-md rounded-2xl px-4 py-3 shadow-lg flex items-center gap-3 border border-cozy-warm/50">
                    <div class="relative">
                        <span class="block w-3 h-3 bg-green-500 rounded-full"></span>
                        <span class="block w-3 h-3 bg-green-400 rounded-full absolute inset-0 animate-ping"></span>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-cozy-brown/50 uppercase tracking-widest">Just Rescued</p>
                        <p class="font-bold text-cozy-brown text-sm">Whiskers</p>
                    </div>
                </div>
            </div>

            {{-- Floating secondary card --}}
            <div class="absolute -bottom-6 -left-6 bg-cozy-warm rounded-3xl p-4 shadow-xl w-36 float-3 border border-cozy-warm/80">
                <p class="font-script text-cozy-brown text-xl mb-1">Meet</p>
                <img src="https://images.unsplash.com/photo-1574158622682-e40e69881006?auto=format&fit=crop&w=200&q=80"
                     class="w-full h-20 object-cover rounded-2xl mb-2" alt="cat">
                <p class="text-[11px] font-bold text-cozy-brown uppercase tracking-wider">Our Cats →</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════ STATS STRIP ═══════════════════════ --}}
<section class="relative bg-cozy-brown py-14 overflow-hidden">
    <div class="absolute inset-0 opacity-[0.06]"
         style="background-image:radial-gradient(#fff 1px,transparent 1px);background-size:20px 20px;"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        @php $stats = [
            ['value'=>$impact['adopted'], 'label'=>'Cats Adopted',  'icon'=>'🐾'],
            ['value'=>$impact['rescued'], 'label'=>'Cats Rescued',  'icon'=>'🏠'],
            ['value'=>'RM '.number_format($impact['raised']), 'label'=>'Donations Raised', 'icon'=>'💛'],
            ['value'=>'94%',              'label'=>'Success Rate',  'icon'=>'✅'],
        ]; @endphp
        @foreach($stats as $s)
        <div class="scroll-reveal">
            <p class="text-3xl mb-1">{{ $s['icon'] }}</p>
            <p class="font-serif font-bold text-4xl text-cozy-light">{{ $s['value'] }}</p>
            <p class="text-cozy-warm/70 text-xs uppercase tracking-wider font-semibold mt-1">{{ $s['label'] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ═══════════════════════ WHO WE ARE ═══════════════════════ --}}
<section class="relative py-28 overflow-hidden bg-white">
    {{-- Blob left --}}
    <div class="absolute top-0 left-0 w-[45%] h-full bg-cozy-bg/80 blob-anim pointer-events-none"
         style="border-radius:0 60% 40% 0/0 50% 50% 0; animation-duration:16s; animation-delay:-3s;"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

        {{-- Image side --}}
        <div class="relative scroll-reveal">
            <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-cozy-card w-full max-w-md mx-auto float-1">
                <img src="https://images.unsplash.com/photo-1574158622682-e40e69881006?auto=format&fit=crop&w=700&q=80"
                     alt="Team" class="w-full h-80 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-cozy-brown/30 to-transparent"></div>
            </div>
            {{-- Floating quote card --}}
            <div class="absolute -bottom-6 -right-4 bg-cozy-card rounded-2xl p-4 shadow-xl border border-cozy-warm/50 max-w-[180px] float-2">
                <p class="font-script text-cozy-accent text-lg mb-1">Our mission</p>
                <p class="text-xs text-cozy-brown/60 leading-relaxed">Every cat deserves a loving home</p>
            </div>
        </div>

        {{-- Text side --}}
        <div class="scroll-reveal" style="transition-delay:.1s">
            <p class="font-script text-3xl text-cozy-accent mb-2">Our Story</p>
            <h2 class="font-serif font-bold text-4xl md:text-5xl text-cozy-brown mb-6 leading-tight">
                Abu Hurairah Club
            </h2>
            <div class="w-16 h-1 bg-cozy-accent rounded-full mb-6"></div>
            <p class="text-cozy-brown/60 text-lg leading-relaxed mb-8">
                A student-led initiative combining modern technology with compassionate care — dedicated to rescuing, rehabilitating, and rehoming stray cats across campus.
            </p>
            <div class="space-y-4 mb-8">
                @foreach([
                    ['🐱','Rescue & Rehome','We rescue strays and find them loving permanent homes.'],
                    ['💉','Medical Care','Every cat gets vaccinations and full health checks.'],
                    ['🌿','SDG 15 Aligned','Supporting Life on Land through ethical population control.'],
                ] as $item)
                <div class="flex items-start gap-4 bg-cozy-light rounded-2xl p-4 border border-cozy-warm/30">
                    <span class="text-2xl">{{ $item[0] }}</span>
                    <div>
                        <h4 class="font-bold text-cozy-brown text-sm">{{ $item[1] }}</h4>
                        <p class="text-xs text-cozy-brown/50 mt-0.5">{{ $item[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <a href="{{ route('about') }}"
               class="inline-flex items-center gap-2 px-7 py-3.5 border-2 border-cozy-brown text-cozy-brown font-bold rounded-xl hover:bg-cozy-brown hover:text-cozy-light transition-all">
                Meet the Team
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════ CATS SHOWCASE ═══════════════════════ --}}
<section class="relative py-24 bg-cozy-bg overflow-hidden">
    {{-- Blob right --}}
    <div class="absolute bottom-0 right-0 w-[40%] h-[70%] bg-cozy-warm/60 blob-anim pointer-events-none"
         style="border-radius:60% 0 0 40%/50% 0 0 50%; animation-duration:15s; animation-delay:-7s;"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10">
        <div class="text-center mb-14 scroll-reveal">
            <p class="font-script text-3xl text-cozy-accent mb-1">Looking for love</p>
            <h2 class="font-serif font-bold text-4xl md:text-5xl text-cozy-brown mb-3">Meet Our Cats</h2>
            <div class="w-20 h-1 bg-cozy-accent/60 mx-auto rounded-full"></div>
        </div>

        {{-- Organic card layout --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
            $featuredCats = isset($cats) ? $cats->take(3) : collect();
            $placeholders = [
                ['name'=>'Luna','age'=>'2 years','tag'=>'Playful & Sweet','img'=>'https://images.unsplash.com/photo-1543852786-1cf6624b9987?auto=format&fit=crop&w=400&q=80'],
                ['name'=>'Simba','age'=>'1 year','tag'=>'Energetic & Bold','img'=>'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=400&q=80'],
                ['name'=>'Bella','age'=>'3 years','tag'=>'Calm & Cuddly','img'=>'https://images.unsplash.com/photo-1574158622682-e40e69881006?auto=format&fit=crop&w=400&q=80'],
            ];
            @endphp
            @if($featuredCats->count() > 0)
                @foreach($featuredCats as $i => $cat)
                <div class="group bg-cozy-card rounded-[2rem] overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-cozy-warm/40 scroll-reveal {{ $i === 1 ? 'lg:mt-8' : '' }}" style="transition-delay:{{ $i * 100 }}ms">
                    <div class="relative h-60 overflow-hidden">
                        <img src="{{ $cat->image }}" alt="{{ $cat->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-cozy-brown/50 to-transparent"></div>
                        <span class="absolute top-4 right-4 bg-cozy-accent text-cozy-light text-[11px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">
                            {{ $cat->status ?? 'Available' }}
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif font-bold text-2xl text-cozy-brown mb-1">{{ $cat->name }}</h3>
                        <p class="text-cozy-brown/50 text-sm mb-4">{{ $cat->age }} · {{ $cat->breed ?? 'Mixed Breed' }}</p>
                        <a href="{{ route('cats.show', $cat) }}"
                           class="w-full inline-flex justify-center items-center gap-2 py-3 bg-cozy-brown text-cozy-light font-bold rounded-xl hover:bg-cozy-accent transition-colors text-sm">
                            Meet {{ $cat->name }}
                        </a>
                    </div>
                </div>
                @endforeach
            @else
                @foreach($placeholders as $i => $p)
                <div class="group bg-cozy-card rounded-[2rem] overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-cozy-warm/40 scroll-reveal {{ $i === 1 ? 'lg:mt-8' : '' }}" style="transition-delay:{{ $i * 100 }}ms">
                    <div class="relative h-60 overflow-hidden">
                        <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-cozy-brown/50 to-transparent"></div>
                        <span class="absolute top-4 right-4 bg-cozy-accent text-cozy-light text-[11px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">Available</span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif font-bold text-2xl text-cozy-brown mb-1">{{ $p['name'] }}</h3>
                        <p class="text-cozy-brown/50 text-sm mb-4">{{ $p['age'] }} · {{ $p['tag'] }}</p>
                        <a href="{{ route('cats.index') }}"
                           class="w-full inline-flex justify-center items-center gap-2 py-3 bg-cozy-brown text-cozy-light font-bold rounded-xl hover:bg-cozy-accent transition-colors text-sm">
                            Meet {{ $p['name'] }}
                        </a>
                    </div>
                </div>
                @endforeach
            @endif
        </div>

        <div class="text-center mt-12 scroll-reveal">
            <a href="{{ route('cats.index') }}"
               class="inline-flex items-center gap-2 px-8 py-4 bg-cozy-brown text-cozy-light font-bold rounded-2xl shadow-lg hover:bg-cozy-accent transition-all hover:-translate-y-1">
                See All Cats
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════ TESTIMONIALS ═══════════════════════ --}}
<section class="relative py-24 bg-white overflow-hidden">
    {{-- Big blob top-right --}}
    <div class="absolute top-0 right-0 w-[50%] h-[80%] bg-cozy-bg blob-anim pointer-events-none"
         style="border-radius:60% 0 0 50%/50% 0 0 60%; animation-duration:13s; animation-delay:-4s;"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10">
        <div class="mb-14 scroll-reveal">
            <p class="font-script text-3xl text-cozy-accent mb-1">Happy Tails</p>
            <h2 class="font-serif font-bold text-4xl md:text-5xl text-cozy-brown">Success Stories</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php $testimonials = [
                ['quote'=>'Adopting Luna was the best decision I made. She brings so much joy to my daily life!','name'=>'Ahmad Ali','role'=>'Engineering Student'],
                ['quote'=>'The adoption process was seamless. The team cares so much about these cats.','name'=>'Sarah Lee','role'=>'Staff Member'],
                ['quote'=>'Thank you Abu Hurairah Club for saving Oyen. He\'s now the king of my house.','name'=>'John Doe','role'=>'Alumni'],
            ]; @endphp
            @foreach($testimonials as $i => $t)
            <div class="bg-cozy-card p-8 rounded-3xl shadow-sm border border-cozy-warm/40 relative scroll-reveal {{ $i === 1 ? 'md:mt-8' : '' }}" style="transition-delay:{{ $i * 120 }}ms">
                <div class="absolute -top-5 left-8 bg-cozy-accent text-cozy-light p-3 rounded-xl shadow-md">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-3a2.017 2.017 0 012-2h3a1 1 0 001-1V9a1 1 0 00-1-1h-4a1 1 0 00-1 1v2a1 1 0 01-1 1h-1V5h10v10a6 6 0 01-6 6h-2zm-9 0v-3a2 2 0 012-2h3a1 1 0 001-1V9a1 1 0 00-1-1H6a1 1 0 00-1 1v2a1 1 0 01-1 1H3V5h10v10a6 6 0 01-6 6H5z"/></svg>
                </div>
                <p class="text-cozy-brown/60 italic mb-6 pt-4 text-[15px] leading-relaxed">"{{ $t['quote'] }}"</p>
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($t['name']) }}&background=E8C9A0&color=3C2415" class="w-11 h-11 rounded-full" alt="{{ $t['name'] }}">
                    <div>
                        <h4 class="font-bold text-cozy-brown text-sm">{{ $t['name'] }}</h4>
                        <p class="text-xs text-cozy-brown/50">{{ $t['role'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════ NEWSLETTER ═══════════════════════ --}}
<section class="bg-cozy-brown py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-[0.06]"
         style="background-image:radial-gradient(#fff 1px,transparent 1px);background-size:22px 22px;"></div>
    <div class="absolute top-0 left-0 w-64 h-64 bg-cozy-accent/30 blob-anim pointer-events-none" style="animation-delay:-2s;"></div>
    <div class="absolute bottom-0 right-0 w-48 h-48 bg-cozy-warm/20 blob-anim pointer-events-none" style="animation-delay:-8s;"></div>

    <div class="relative z-10 max-w-2xl mx-auto px-6 text-center scroll-reveal">
        <p class="font-script text-3xl text-cozy-warm mb-2">Join our community</p>
        <h2 class="font-serif font-bold text-4xl text-white mb-4">Stay Updated</h2>
        <div class="w-16 h-1 bg-cozy-accent mx-auto rounded-full mb-6"></div>
        <p class="text-cozy-warm/70 text-lg mb-8 leading-relaxed">
            Latest rescues, adoption events, and happy endings — straight to your inbox.
        </p>
        <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
            <input type="email" placeholder="your@email.com"
                   class="flex-1 px-5 py-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-cozy-accent/60" required>
            <button type="submit"
                    class="px-7 py-4 bg-cozy-accent hover:bg-cozy-gold text-white font-bold rounded-xl shadow-lg hover:-translate-y-0.5 transition-all">
                Subscribe
            </button>
        </form>
        <p class="text-white/30 text-xs mt-4">Unsubscribe at any time.</p>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
        });
    }, { threshold: 0.12 });
    document.querySelectorAll('.scroll-reveal').forEach(el => io.observe(el));
});
</script>
</x-app-layout>
