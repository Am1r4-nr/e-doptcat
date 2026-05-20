<x-app-layout>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap');
  .font-pinterest-script { font-family: 'Great Vibes', cursive; }
  .font-pinterest-serif { font-family: 'Playfair Display', serif; }
  .font-pinterest-sans { font-family: 'Poppins', sans-serif; }
  .blob-1 { border-radius: 41% 59% 41% 59% / 46% 38% 62% 54%; }
  .blob-2 { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
  .blob-3 { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
  .bg-pinterest-base { background-color: #d1a568; }
  .bg-pinterest-brown { background-color: #5c3516; }
  .bg-pinterest-card { background-color: #f7ead4; }
  .text-pinterest-brown { color: #5c3516; }
  .text-pinterest-card { color: #f7ead4; }
  .fill-sparkle { fill: #f3da74; }
</style>

<div class="bg-pinterest-base min-h-screen font-pinterest-sans overflow-hidden relative pb-32">
    <div class="absolute top-[-10%] right-[-10%] w-[800px] h-[800px] bg-pinterest-card blob-2 opacity-50 z-0"></div>
    <div class="absolute top-[40%] left-[-20%] w-[600px] h-[600px] bg-pinterest-brown blob-3 opacity-90 z-0"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-6 pt-24 text-center">
        <h1 class="font-pinterest-script text-7xl md:text-9xl text-pinterest-brown mb-4 z-20 relative mix-blend-color-burn">About Us</h1>
        <p class="font-pinterest-serif text-pinterest-brown/90 text-xl md:text-3xl max-w-3xl mx-auto mb-16 font-medium">
            Champions for Compassion, Guardians of Life. Dedicated to the well-being and protection of our feline friends.
        </p>
        
        <div class="bg-pinterest-card rounded-[3rem] p-12 max-w-4xl mx-auto shadow-2xl border-8 border-white/40 relative">
            <svg class="absolute -top-6 -right-6 w-12 h-12 fill-sparkle animate-pulse" viewBox="0 0 24 24"><path d="M12 0l2 8 8 2-8 2-2 8-2-8-8-2 8-2z"/></svg>

            <h2 class="font-pinterest-script text-6xl text-pinterest-brown mb-6">Our Mission</h2>
            <p class="text-pinterest-brown/90 font-pinterest-sans leading-relaxed text-lg mb-10">
                Our primary mission is to rescue, rehabilitate, and rehome stray and abandoned cats. We believe every feline deserves a loving home and a chance at a dignified life. We strive to reduce the stray population through Trap-Neuter-Return (TNR) programs and public education.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-pinterest-brown">
                <div class="p-6 bg-white/40 rounded-[2rem] blob-1 shadow-md hover:scale-105 transition-transform duration-500">
                    <div class="text-4xl mb-3">❤️</div>
                    <h3 class="font-pinterest-serif text-xl font-bold mb-2">Compassion</h3>
                    <p class="text-sm">Leading with empathy in every rescue.</p>
                </div>
                <div class="p-6 bg-white/40 rounded-[2rem] blob-2 shadow-md hover:scale-105 transition-transform duration-500">
                    <div class="text-4xl mb-3">🤝</div>
                    <h3 class="font-pinterest-serif text-xl font-bold mb-2">Community</h3>
                    <p class="text-sm">Building a network of care for animals.</p>
                </div>
                <div class="p-6 bg-white/40 rounded-[2rem] blob-3 shadow-md hover:scale-105 transition-transform duration-500">
                    <div class="text-4xl mb-3">🌍</div>
                    <h3 class="font-pinterest-serif text-xl font-bold mb-2">Action</h3>
                    <p class="text-sm">Committed to SDG 15: Life on Land.</p>
                </div>
            </div>
        </div>
        
        <h2 class="font-pinterest-script text-7xl text-pinterest-card mt-28 mb-16 mix-blend-overlay relative z-20">The People Behind the Paws</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12 max-w-5xl mx-auto relative z-20">
            @foreach([
                ['name'=>'Sarah Jenkins','role'=>'Founder & Director','img'=>'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=300&q=80'],
                ['name'=>'Mike Thompson','role'=>'Head Veterinarian','img'=>'https://images.unsplash.com/photo-1511044568932-338cba0ad803?auto=format&fit=crop&w=300&q=80'],
                ['name'=>'Linda Khoo','role'=>'Volunteer Coordinator','img'=>'https://images.unsplash.com/photo-1529566193698-bc3941270f80?auto=format&fit=crop&w=300&q=80']
            ] as $index => $m)
            @php $blobClass = 'blob-' . (($index % 3) + 1); @endphp
            <div class="flex flex-col items-center group">
                <div class="w-56 h-56 mb-8 {{ $blobClass }} overflow-hidden shadow-xl border-[6px] border-pinterest-card group-hover:scale-110 transition-transform duration-500">
                    <img src="{{ $m['img'] }}" alt="{{ $m['name'] }}" class="w-full h-full object-cover filter sepia-[0.4] group-hover:sepia-0 transition-all duration-500">
                </div>
                <div class="bg-pinterest-card/90 backdrop-blur-md px-6 py-3 rounded-full shadow-lg">
                    <h3 class="font-pinterest-serif font-bold text-2xl text-pinterest-brown">{{ $m['name'] }}</h3>
                    <p class="font-pinterest-sans text-xs text-pinterest-brown/80 font-bold tracking-widest uppercase mt-1">{{ $m['role'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</x-app-layout>