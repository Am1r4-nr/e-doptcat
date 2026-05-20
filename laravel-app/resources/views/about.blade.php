<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }
</style>

    <!-- Hero Section -->
    <div class="relative overflow-hidden pt-24" style="background: #E6C697;">
        <div class="absolute inset-0">
            <!-- Wavy background overlay -->
            <div class="absolute top-[20%] left-[-10%] w-[120%] h-[120%] bg-[#FFF4E3] opacity-60 rounded-[50%] transform rotate-12 -z-10"></div>
            <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-1.2.1&auto=format&fit=crop&w=1927&q=80"
                class="w-full h-full object-cover opacity-20 mix-blend-overlay" alt="Cat background">
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 z-20 text-center">
            <h1 class="font-script font-bold text-cozy-brown text-6xl sm:text-7xl lg:text-8xl mb-6">
                About Abu Hurairah
            </h1>
            <p class="mt-4 text-xl text-cozy-brown/80 max-w-3xl mx-auto font-medium leading-relaxed">
                Champions for Compassion, Guardians of Life. Dedicated to the well-being and protection of our feline friends.
            </p>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="py-20 bg-cozy-card overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                <div class="mb-12 lg:mb-0">
                    <h2 class="text-5xl font-script font-bold text-cozy-brown mb-6 relative inline-block">
                        Our Mission
                        <span class="absolute bottom-2 left-0 w-full h-3 bg-[#F5DEB3] -z-10 transform -rotate-1 rounded-full opacity-70"></span>
                    </h2>
                    <p class="text-lg text-cozy-brown/80 leading-relaxed mb-8 text-pretty font-medium">
                        Our primary mission is to rescue, rehabilitate, and rehome stray and abandoned cats. We believe
                        every feline deserves a loving home and a chance at a dignified life. We strive to reduce the
                        stray population through Trap-Neuter-Return (TNR) programs and public education.
                    </p>

                    <h3 class="text-4xl font-script font-bold text-cozy-brown mb-6">Core Values</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-cozy-bg/30 p-4 rounded-3xl shadow-sm border border-cozy-brown/10 flex items-start gap-3">
                            <div class="bg-[#F5DEB3] p-2 rounded-xl text-cozy-brown">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-cozy-brown mt-1">Compassion for all</span>
                        </div>
                        <div class="bg-cozy-bg/30 p-4 rounded-3xl shadow-sm border border-cozy-brown/10 flex items-start gap-3">
                            <div class="bg-[#F5DEB3] p-2 rounded-xl text-cozy-brown">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-cozy-brown mt-1">Transparency</span>
                        </div>
                        <div class="bg-cozy-bg/30 p-4 rounded-3xl shadow-sm border border-cozy-brown/10 flex items-start gap-3">
                            <div class="bg-[#F5DEB3] p-2 rounded-xl text-cozy-brown">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-cozy-brown mt-1">Community</span>
                        </div>
                        <div class="bg-cozy-bg/30 p-4 rounded-3xl shadow-sm border border-cozy-brown/10 flex items-start gap-3">
                            <div class="bg-[#F5DEB3] p-2 rounded-xl text-cozy-brown">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-cozy-brown mt-1">SDG 15 Commit</span>
                        </div>
                    </div>
                </div>
                <!-- Image Grid -->
                <div class="relative">
                    <div class="absolute -top-4 -right-4 w-32 h-32 bg-[#F5DEB3] rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-4 -left-4 w-40 h-40 bg-[#E6C697] rounded-full blur-2xl"></div>
                    <img class="relative rounded-[3rem] shadow-xl w-full h-[450px] object-cover transform rotate-2 hover:rotate-0 transition-transform duration-500 border-8 border-cozy-card blob"
                        src="https://images.unsplash.com/photo-1574158622682-e40e69881006?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                        alt="Team working">
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="bg-cozy-bg py-24 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-[#FFF4E3] rounded-full blur-3xl opacity-50 -mr-20 -mt-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-6xl font-script font-bold text-cozy-brown">Meet Our Team</h2>
                <div class="w-24 h-1.5 bg-cozy-brown/20 mx-auto rounded-full mt-6"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Member 1 -->
                <div class="group text-center bg-cozy-card p-8 rounded-[3rem] shadow-lg border border-cozy-brown/10 transform transition-transform hover:-translate-y-2">
                    <div class="relative w-40 h-40 mx-auto mb-6">
                        <div class="absolute inset-0 bg-[#E6C697] rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform rotate-6 transition-transform group-hover:rotate-12"></div>
                        <div class="relative w-full h-full rounded-[40%_60%_70%_30%/40%_50%_60%_50%] overflow-hidden border-4 border-white shadow-md">
                            <img src="https://ui-avatars.com/api/?name=Sarah+J&background=E6C697&color=6F4E37" alt="Sarah" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <h3 class="text-3xl font-script font-bold text-cozy-brown group-hover:text-cozy-brown/70 transition-colors">Sarah Jenkins</h3>
                    <p class="text-cozy-brown/60 font-bold text-xs mt-2 uppercase tracking-wider">Founder & Director</p>
                </div>
                <!-- Member 2 -->
                <div class="group text-center bg-cozy-card p-8 rounded-[3rem] shadow-lg border border-cozy-brown/10 transform transition-transform hover:-translate-y-2">
                    <div class="relative w-40 h-40 mx-auto mb-6">
                        <div class="absolute inset-0 bg-[#E6C697] rounded-[60%_40%_30%_70%/60%_30%_70%_40%] transform -rotate-3 transition-transform group-hover:-rotate-6"></div>
                        <div class="relative w-full h-full rounded-[60%_40%_30%_70%/60%_30%_70%_40%] overflow-hidden border-4 border-white shadow-md">
                            <img src="https://ui-avatars.com/api/?name=Mike+T&background=F5DEB3&color=6F4E37" alt="Mike" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <h3 class="text-3xl font-script font-bold text-cozy-brown group-hover:text-cozy-brown/70 transition-colors">Mike Thompson</h3>
                    <p class="text-cozy-brown/60 font-bold text-xs mt-2 uppercase tracking-wider">Head Veterinarian</p>
                </div>
                <!-- Member 3 -->
                <div class="group text-center bg-cozy-card p-8 rounded-[3rem] shadow-lg border border-cozy-brown/10 transform transition-transform hover:-translate-y-2">
                    <div class="relative w-40 h-40 mx-auto mb-6">
                        <div class="absolute inset-0 bg-[#E6C697] rounded-[50%_50%_70%_30%/40%_60%_60%_50%] transform rotate-3 transition-transform group-hover:rotate-6"></div>
                        <div class="relative w-full h-full rounded-[50%_50%_70%_30%/40%_60%_60%_50%] overflow-hidden border-4 border-white shadow-md">
                            <img src="https://ui-avatars.com/api/?name=Linda+K&background=FFF4E3&color=6F4E37" alt="Linda" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <h3 class="text-3xl font-script font-bold text-cozy-brown group-hover:text-cozy-brown/70 transition-colors">Linda Khoo</h3>
                    <p class="text-cozy-brown/60 font-bold text-xs mt-2 uppercase tracking-wider">Volunteer Coordinator</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>