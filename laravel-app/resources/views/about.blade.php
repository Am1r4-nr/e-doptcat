<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-cozy-brown overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-cozy-brown opacity-90 z-10"></div>
            <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-1.2.1&auto=format&fit=crop&w=1927&q=80"
                class="w-full h-full object-cover text-gray-400" alt="Cat background">
        </div>
        <div class="relative max-w-7xl mx-auto py-32 pt-40 px-4 sm:px-6 lg:px-8 z-20 text-center">
            <p class="font-script text-2xl text-cozy-warm mb-4">Our Story</p>
            <h1 class="text-4xl font-serif font-bold tracking-tight text-white sm:text-5xl lg:text-6xl mb-6">
                About Abu Hurairah Club
            </h1>
            <p class="mt-4 text-xl text-cozy-warm/80 max-w-3xl mx-auto font-light leading-relaxed">
                Champions for Compassion, Guardians of Life. Dedicated to the well-being and protection of our feline friends.
            </p>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="py-20 bg-cozy-bg overflow-hidden relative">
        <div class="absolute top-0 right-0 w-72 h-72 bg-cozy-warm/40 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 bg-cozy-accent/15 rounded-full blur-3xl -translate-x-1/3 translate-y-1/3 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                <div class="mb-12 lg:mb-0">
                    <h2 class="text-3xl font-serif font-bold text-cozy-brown mb-6 relative inline-block">
                        Our Mission
                        <span class="absolute bottom-1 left-0 w-full h-2 bg-cozy-accent/30 -z-10 transform -rotate-1 rounded-full"></span>
                    </h2>
                    <p class="text-lg text-cozy-brown/70 leading-relaxed mb-8 text-pretty">
                        Our primary mission is to rescue, rehabilitate, and rehome stray and abandoned cats. We believe
                        every feline deserves a loving home and a chance at a dignified life. We strive to reduce the
                        stray population through Trap-Neuter-Return (TNR) programs and public education.
                    </p>
                    <h3 class="text-xl font-serif font-bold text-cozy-brown mb-6">Core Values</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach([['icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z','label'=>'Compassion for all'],['icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z','label'=>'Transparency'],['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z','label'=>'Community'],['icon'=>'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z','label'=>'SDG 15 Commit']] as $v)
                        <div class="bg-cozy-card p-4 rounded-xl shadow-sm border border-cozy-warm/30 flex items-start gap-3">
                            <div class="bg-cozy-warm/40 p-2 rounded-lg text-cozy-brown">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $v['icon'] }}"/></svg>
                            </div>
                            <span class="text-sm font-bold text-cozy-brown/80 mt-1">{{ $v['label'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-cozy-accent/30 rounded-full blur-xl"></div>
                    <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-cozy-warm/40 rounded-full blur-xl"></div>
                    <img class="relative rounded-3xl shadow-xl w-full h-[400px] object-cover transform rotate-1 hover:rotate-0 transition-transform duration-500"
                        src="https://images.unsplash.com/photo-1574158622682-e40e69881006?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Team working">
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="bg-cozy-card py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <p class="font-script text-xl text-cozy-accent mb-2">The people behind the paws</p>
                <h2 class="text-3xl font-serif font-bold text-cozy-brown">Meet Our Team</h2>
                <div class="w-16 h-1 bg-cozy-accent mx-auto rounded-full mt-4"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach([['name'=>'Sarah Jenkins','role'=>'Founder & Director','initials'=>'Sarah+J'],['name'=>'Mike Thompson','role'=>'Head Veterinarian','initials'=>'Mike+T'],['name'=>'Linda Khoo','role'=>'Volunteer Coordinator','initials'=>'Linda+K']] as $m)
                <div class="group text-center">
                    <div class="relative w-40 h-40 mx-auto mb-6">
                        <div class="absolute inset-0 bg-cozy-accent/30 rounded-full transform rotate-6 transition-transform group-hover:rotate-12"></div>
                        <div class="relative w-full h-full rounded-full overflow-hidden border-4 border-cozy-card shadow-lg">
                            <img src="https://ui-avatars.com/api/?name={{ $m['initials'] }}&background=E8C9A0&color=3C2415&size=200" alt="{{ $m['name'] }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-cozy-brown group-hover:text-cozy-accent transition-colors">{{ $m['name'] }}</h3>
                    <p class="text-cozy-brown/50 font-medium text-sm mt-1 uppercase tracking-wide">{{ $m['role'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>