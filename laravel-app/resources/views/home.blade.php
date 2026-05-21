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

        <!-- Hero Section -->
        <div class="flex flex-col md:flex-row items-center justify-between min-h-[80vh] gap-12 mb-24">

            <!-- Left Content -->
            <div class="w-full md:w-1/2 flex flex-col justify-center items-start">
                <p class="font-script text-3xl text-cozy-accent mb-2">Welcome to</p>
                <h1 class="font-serif font-bold text-6xl md:text-7xl text-cozy-brown leading-tight mb-6">
                    Our Cozy<br>Cat Club
                </h1>
                <div class="w-24 h-1 bg-cozy-accent/60 rounded-full mb-6"></div>
                <p class="text-cozy-brown/70 text-xl md:text-2xl leading-relaxed font-sans max-w-md mb-10">
                    Find comfort, love, and your purrfect feline companion. Every cat deserves a warm lap and a cozy home.
                </p>
                <a href="{{ route('cats.index') }}"
                   class="bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold px-10 py-4 rounded-full shadow-lg transition-colors duration-300 hover:-translate-y-1 transform font-sans">
                    Meet Our Cats
                </a>
            </div>

            <!-- Right Side: Cat image in blob frame -->
            <div class="w-full md:w-1/2 flex justify-center items-center relative h-[540px]">
                <div class="w-[460px] h-[500px] relative z-20 overflow-hidden border-[8px] border-cozy-warm/60 shadow-2xl"
                     style="border-radius: 40% 60% 70% 30% / 45% 45% 55% 55%;">
                    <img src="https://images.unsplash.com/photo-1543852786-1cf6624b9987?auto=format&fit=crop&w=800&q=80"
                         alt="Cozy Cat"
                         class="w-full h-full object-cover">
                </div>
                <!-- Small accent blob behind image -->
                <div class="absolute -bottom-8 -right-8 w-64 h-64 bg-cozy-gold/30 blob opacity-50 pointer-events-none" style="animation-delay:-3s;"></div>
            </div>
        </div>

        <!-- Feature Cards Section -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <p class="font-script text-3xl text-cozy-accent mb-1">Explore</p>
                <h2 class="font-serif font-bold text-4xl text-cozy-brown mb-4">How We Help</h2>
                <div class="w-24 h-1 bg-cozy-accent/60 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Card 1: Mission -->
                <div class="bg-cozy-card rounded-3xl shadow-xl border border-cozy-warm/40 p-6 flex flex-col hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="h-48 rounded-2xl overflow-hidden mb-6 border-2 border-cozy-warm/40">
                        <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=500&q=80"
                             class="w-full h-full object-cover" alt="Our Mission">
                    </div>
                    <p class="font-script text-2xl text-cozy-accent mb-1">Our Purpose</p>
                    <h3 class="font-serif font-bold text-2xl text-cozy-brown mb-3">Our Mission</h3>
                    <p class="font-sans text-cozy-brown/70 text-sm leading-relaxed mb-6 flex-grow">
                        Rescuing campus cats and securing them a bright future. Explore our journey and how you can help.
                    </p>
                    <a href="{{ route('about') }}"
                       class="bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold rounded-full px-6 py-3 text-sm text-center transition-colors duration-300 font-sans">
                        About Us
                    </a>
                </div>

                <!-- Card 2: Adopt -->
                <div class="bg-cozy-card rounded-3xl shadow-xl border border-cozy-warm/40 p-6 flex flex-col hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 md:-translate-y-6">
                    <div class="h-64 rounded-2xl overflow-hidden mb-6 border-2 border-cozy-warm/40">
                        <img src="https://images.unsplash.com/photo-1574158622682-e40e69881006?auto=format&fit=crop&w=500&q=80"
                             class="w-full h-full object-cover" alt="Adopt a Cat">
                    </div>
                    <p class="font-script text-2xl text-cozy-accent mb-1">Give a Home</p>
                    <h3 class="font-serif font-bold text-2xl text-cozy-brown mb-3">Adopt</h3>
                    <div class="w-16 h-0.5 bg-cozy-accent/40 rounded-full mb-3"></div>
                    <p class="font-sans text-cozy-brown/70 text-sm leading-relaxed mb-6 flex-grow">
                        Many of our furry friends are waiting for a permanent home. Read their stories.
                    </p>
                    <a href="{{ route('cats.index') }}"
                       class="bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold rounded-full px-6 py-3 text-sm text-center transition-colors duration-300 font-sans">
                        Find a Cat
                    </a>
                </div>

                <!-- Card 3: Donate -->
                <div class="bg-cozy-card rounded-3xl shadow-xl border border-cozy-warm/40 p-6 flex flex-col hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 md:translate-y-6">
                    <div class="h-48 rounded-2xl overflow-hidden mb-6 border-2 border-cozy-warm/40">
                        <img src="https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?auto=format&fit=crop&w=500&q=80"
                             class="w-full h-full object-cover" alt="Donate">
                    </div>
                    <p class="font-script text-2xl text-cozy-accent mb-1">Give Back</p>
                    <h3 class="font-serif font-bold text-2xl text-cozy-brown mb-3">Donate</h3>
                    <p class="font-sans text-cozy-brown/70 text-sm leading-relaxed mb-6 flex-grow">
                        Can't adopt? Every small contribution builds a bigger future for our rescues.
                    </p>
                    <a href="{{ route('donations.index') }}"
                       class="bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold rounded-full px-6 py-3 text-sm text-center transition-colors duration-300 font-sans">
                        Donate Now
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="bg-cozy-brown rounded-3xl shadow-2xl p-10 md:p-14 mb-16">
            <div class="text-center mb-10">
                <p class="font-script text-3xl text-cozy-gold mb-1">Our Impact</p>
                <h2 class="font-serif font-bold text-4xl text-cozy-light">By The Numbers</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="font-serif font-bold text-4xl text-cozy-gold mb-1">{{ $impact['rescued'] }}+</p>
                    <p class="font-sans text-cozy-warm/80 text-sm">Cats Rescued</p>
                </div>
                <div>
                    <p class="font-serif font-bold text-4xl text-cozy-gold mb-1">{{ $impact['donations'] }}+</p>
                    <p class="font-sans text-cozy-warm/80 text-sm">Donations Received</p>
                </div>
                <div>
                    <p class="font-serif font-bold text-4xl text-cozy-gold mb-1">RM {{ number_format($impact['raised'], 0) }}</p>
                    <p class="font-sans text-cozy-warm/80 text-sm">Money Raised</p>
                </div>
                <div>
                    <p class="font-serif font-bold text-4xl text-cozy-gold mb-1">{{ $impact['campaigns'] }}+</p>
                    <p class="font-sans text-cozy-warm/80 text-sm">Active Campaigns</p>
                </div>
            </div>
        </div>

        <!-- How Adoption Works -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <p class="font-script text-3xl text-cozy-gold mb-1">Ready to Adopt?</p>
                <h2 class="font-serif font-bold text-4xl text-cozy-brown">How Adoption Works</h2>
                <p class="font-sans text-gray-500 mt-3 max-w-xl mx-auto text-[15px]">Giving a campus cat a forever home is simple. Here's what the journey looks like.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
                <!-- Connecting line (desktop only) -->
                <div class="hidden md:block absolute top-10 left-[12.5%] right-[12.5%] h-px bg-cozy-warm/40 z-0"></div>

                <!-- Step 1 -->
                <div class="relative z-10 bg-[#FAF8F5] rounded-3xl p-7 text-center flex flex-col items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-cozy-gold/15 flex items-center justify-center">
                        <svg class="w-6 h-6 text-cozy-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <div class="w-7 h-7 rounded-full bg-cozy-gold text-white text-xs font-bold flex items-center justify-center -mt-2">1</div>
                    <h3 class="font-serif font-bold text-[17px] text-cozy-brown">Browse Cats</h3>
                    <p class="font-sans text-gray-500 text-[13px] leading-relaxed">Explore our available residents and find a cat whose personality matches yours.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 bg-[#FAF8F5] rounded-3xl p-7 text-center flex flex-col items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-cozy-gold/15 flex items-center justify-center">
                        <svg class="w-6 h-6 text-cozy-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="w-7 h-7 rounded-full bg-cozy-gold text-white text-xs font-bold flex items-center justify-center -mt-2">2</div>
                    <h3 class="font-serif font-bold text-[17px] text-cozy-brown">Submit Application</h3>
                    <p class="font-sans text-gray-500 text-[13px] leading-relaxed">Fill in a short form about your home environment and experience with cats.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 bg-[#FAF8F5] rounded-3xl p-7 text-center flex flex-col items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-cozy-gold/15 flex items-center justify-center">
                        <svg class="w-6 h-6 text-cozy-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <div class="w-7 h-7 rounded-full bg-cozy-gold text-white text-xs font-bold flex items-center justify-center -mt-2">3</div>
                    <h3 class="font-serif font-bold text-[17px] text-cozy-brown">Screening & Meet</h3>
                    <p class="font-sans text-gray-500 text-[13px] leading-relaxed">Our team reviews your application and arranges a meet-and-greet with your chosen cat.</p>
                </div>

                <!-- Step 4 -->
                <div class="relative z-10 bg-cozy-brown rounded-3xl p-7 text-center flex flex-col items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-cozy-gold/30 flex items-center justify-center">
                        <svg class="w-6 h-6 text-cozy-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <div class="w-7 h-7 rounded-full bg-cozy-gold text-white text-xs font-bold flex items-center justify-center -mt-2">4</div>
                    <h3 class="font-serif font-bold text-[17px] text-cozy-light">Welcome Home!</h3>
                    <p class="font-sans text-cozy-warm/70 text-[13px] leading-relaxed">Once approved, your new companion comes home — a lifelong bond begins.</p>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('cats.index') }}"
                   class="inline-block bg-cozy-brown text-cozy-light font-bold px-10 py-3.5 rounded-full shadow hover:bg-cozy-accent hover:scale-105 transition-all duration-300 font-sans text-[14px]">
                    Start Browsing Cats
                </a>
            </div>
        </div>

        <!-- CTA Banner -->
        <div class="bg-gradient-to-r from-cozy-brown to-cozy-accent rounded-3xl shadow-2xl p-12 lg:p-16 text-center text-cozy-light relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-cozy-warm/20 blob opacity-50 pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-cozy-gold/20 blob opacity-50 pointer-events-none -translate-x-1/3 translate-y-1/3" style="animation-delay:-4s;"></div>
            <div class="relative z-10 space-y-6">
                <p class="font-script text-3xl text-cozy-warm">Join the Family</p>
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
