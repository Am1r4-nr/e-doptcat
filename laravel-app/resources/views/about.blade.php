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

    <div class="relative z-10 max-w-7xl mx-auto px-6 pt-28">

        <!-- Section 1: Hero -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-24">

            <!-- Left Content -->
            <div class="space-y-6">
                <span class="inline-block px-4 py-1.5 rounded-full bg-cozy-warm/60 text-cozy-brown text-sm font-bold tracking-widest uppercase font-sans">
                    OUR JOURNEY
                </span>
                <p class="font-script text-3xl text-cozy-accent">Learn More</p>
                <h1 class="font-serif font-bold text-5xl md:text-6xl text-cozy-brown tracking-tight">
                    About e-Doptcat
                </h1>
                <div class="w-24 h-1 bg-cozy-accent/60 rounded-full"></div>
                <p class="font-sans text-cozy-brown/70 text-xl md:text-2xl leading-snug max-w-lg">
                    A real-time cat adoption and rescue management system by the Abu Hurairah Club (AHC), IIUM.
                </p>

                <div class="bg-cozy-card border-l-4 border-cozy-accent p-6 rounded-r-3xl shadow-md">
                    <p class="italic font-sans text-cozy-brown/80 text-lg">
                        "AHC is a student-run organisation at IIUM dedicated to rescuing, caring for, and rehoming stray and abandoned cats on campus."
                    </p>
                </div>
            </div>

            <!-- Right Image -->
            <div class="relative w-full h-[500px] md:h-[580px] lg:w-[90%] ml-auto">
                <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                     alt="Orange Cat"
                     class="w-full h-full object-cover rounded-[3rem] shadow-2xl border-4 border-cozy-warm/40">
            </div>
        </div>

        <!-- Section 2: Our Story -->
        <div class="mb-24">
            <div class="max-w-4xl mx-auto text-center space-y-8">
                <p class="font-script text-3xl text-cozy-accent">How It Started</p>
                <h2 class="font-serif font-bold text-4xl text-cozy-brown">Our Story</h2>
                <div class="w-24 h-1 bg-cozy-accent/60 mx-auto rounded-full"></div>

                <div class="bg-cozy-card rounded-3xl shadow-xl border border-cozy-warm/40 p-10 text-left space-y-6">
                    <p class="font-sans text-cozy-brown/70 text-lg md:text-xl leading-relaxed">
                        For years, the Abu Hurairah Club (AHC) worked tirelessly to manage campus cat welfare through fragmented channels. Our volunteers navigated manual processes, tracking rescues via social media DMs and spreadsheets that couldn't keep up with the urgency of campus needs. The lack of a centralized hub often delayed vital medical care and slowed down the rehoming of our furry friends.
                    </p>
                    <p class="font-sans text-cozy-brown/70 text-lg md:text-xl leading-relaxed">
                        Recognizing this challenge, the vision for <span class="font-bold text-cozy-brown">e-Doptcat</span> was born. We needed more than just a website; we needed a dedicated digital sanctuary. By moving away from manual bottlenecks to a real-time management system, we empowered our community to respond faster, track health history accurately, and connect hopeful adopters with their perfect feline matches seamlessly.
                    </p>
                </div>
            </div>
        </div>

        <!-- Section 3: Mission & Values -->
        <div class="mb-24">
            <div class="text-center mb-12 space-y-3">
                <p class="font-script text-3xl text-cozy-accent">What We Stand For</p>
                <h2 class="font-serif font-bold text-4xl text-cozy-brown">Our Mission & Values</h2>
                <div class="w-24 h-1 bg-cozy-accent/60 mx-auto rounded-full"></div>
                <p class="font-sans text-cozy-brown/60 text-lg">The pillars that support every rescue and every purr.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Card 1: Cat Welfare -->
                <div class="bg-cozy-card rounded-3xl p-8 text-center space-y-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-cozy-warm/40 shadow-md">
                    <div class="w-14 h-14 mx-auto bg-cozy-warm/60 text-cozy-accent rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2c-5.33 0-8 3.48-8 7 0 2.2 1.48 4.29 4 5l1.6 3.6c.2.46.74.68 1.23.49L12 17.5l1.17.59c.49.19 1.03-.03 1.23-.49L16 14c2.52-.71 4-2.8 4-5 0-3.52-2.67-7-8-7zm0 2c3.54 0 6 2.45 6 5 0 1.43-.88 2.92-2.82 3.62l-1.37 3.08-.81-.41-1 .5-.81.41-1.37-3.08C6.88 11.42 6 9.93 6 9c0-2.55 2.46-5 6-5z"/></svg>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-cozy-brown">Cat Welfare</h3>
                    <p class="font-sans text-cozy-brown/60 text-sm leading-relaxed">Prioritizing the health, safety, and happiness of every campus feline under our care.</p>
                </div>

                <!-- Card 2: Transparency -->
                <div class="bg-cozy-card rounded-3xl p-8 text-center space-y-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-cozy-warm/40 shadow-md">
                    <div class="w-14 h-14 mx-auto bg-cozy-warm/60 text-cozy-accent rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-cozy-brown">Transparency</h3>
                    <p class="font-sans text-cozy-brown/60 text-sm leading-relaxed">Ensuring every donation and rescue action is tracked and visible to our supporters.</p>
                </div>

                <!-- Card 3: Community -->
                <div class="bg-cozy-card rounded-3xl p-8 text-center space-y-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-cozy-warm/40 shadow-md">
                    <div class="w-14 h-14 mx-auto bg-cozy-warm/60 text-cozy-accent rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-cozy-brown">Community</h3>
                    <p class="font-sans text-cozy-brown/60 text-sm leading-relaxed">Fostering a nurturing ecosystem of student volunteers and animal lovers at IIUM.</p>
                </div>

                <!-- Card 4: Tech-Enabled Care -->
                <div class="bg-cozy-card rounded-3xl p-8 text-center space-y-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-cozy-warm/40 shadow-md">
                    <div class="w-14 h-14 mx-auto bg-cozy-warm/60 text-cozy-accent rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-cozy-brown">Tech-Enabled Care</h3>
                    <p class="font-sans text-cozy-brown/60 text-sm leading-relaxed">Leveraging modern platforms like e-Doptcat to optimize rescue logistics and outreach.</p>
                </div>
            </div>
        </div>


        <!-- Section 5: CTA Banner -->
        <div class="bg-gradient-to-r from-cozy-brown to-cozy-accent rounded-3xl shadow-2xl p-12 lg:p-16 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-cozy-warm/20 blob opacity-50 pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-cozy-gold/20 blob opacity-50 pointer-events-none -translate-x-1/3 translate-y-1/3" style="animation-delay:-4s;"></div>
            <div class="relative z-10 space-y-6">
                <p class="font-script text-3xl text-cozy-warm">Get Involved</p>
                <h2 class="font-serif font-bold text-4xl md:text-5xl text-cozy-light">
                    Want to make a difference for campus cats?
                </h2>
                <p class="font-sans text-cozy-light/80 text-lg max-w-2xl mx-auto">
                    Join our growing community of volunteers and help us create a better world for every stray at IIUM.
                </p>
                <div class="pt-2">
                    <a href="{{ Route::has('volunteers.register') ? route('volunteers.register') : '#' }}"
                       class="inline-block bg-cozy-light text-cozy-brown font-bold px-10 py-4 rounded-full shadow-lg hover:bg-cozy-warm hover:scale-105 transition-all duration-300 font-sans">
                        Become a Volunteer
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
</x-app-layout>
