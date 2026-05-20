<x-app-layout>
    <!-- Section 1: Hero -->
    <div class="bg-boho-bg py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-6">
                    <span class="inline-block px-4 py-1.5 rounded-full bg-[#fae8d4] text-[#a66a33] text-sm font-bold tracking-widest uppercase">
                        OUR JOURNEY
                    </span>
                    <h1 class="text-5xl md:text-7xl font-sans font-extrabold text-gray-900 tracking-tight">
                        About e-Doptcat
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-600 leading-snug font-medium max-w-lg">
                        A real-time cat adoption and rescue management system by the Abu Hurairah Club (AHC), IIUM.
                    </p>
                    
                    <div class="bg-[#f5ebd9] border-l-4 border-[#b7791f] p-6 rounded-r-3xl mt-8">
                        <p class="italic text-gray-700 text-lg">
                            "AHC is a student-run organisation at IIUM dedicated to rescuing, caring for, and rehoming stray and abandoned cats on campus."
                        </p>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="relative w-full h-[500px] md:h-[600px] lg:w-[90%] ml-auto">
                    <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Orange Cat" 
                         class="w-full h-full object-cover rounded-[3rem] shadow-2xl">
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Our Story -->
    <div class="bg-boho-bg py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
            <h2 class="text-4xl font-sans font-bold text-gray-900">Our Story</h2>
            
            <div class="text-gray-600 text-lg md:text-xl leading-relaxed space-y-8 text-left md:text-center px-4">
                <p>
                    For years, the Abu Hurairah Club (AHC) worked tirelessly to manage campus cat welfare through fragmented channels. Our volunteers navigated manual processes, tracking rescues via social media DMs and spreadsheets that couldn't keep up with the urgency of campus needs. The lack of a centralized hub often delayed vital medical care and slowed down the rehoming of our furry friends.
                </p>
                <p>
                    Recognizing this challenge, the vision for <span class="font-bold text-gray-800">e-Doptcat</span> was born. We needed more than just a website; we needed a dedicated digital sanctuary. By moving away from manual bottlenecks to a real-time management system, we empowered our community to respond faster, track health history accurately, and connect hopeful adopters with their perfect feline matches seamlessly.
                </p>
            </div>
        </div>
    </div>

    <!-- Section 3: Mission & Values -->
    <div class="bg-boho-bg py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 space-y-4">
                <h2 class="text-4xl font-sans font-bold text-gray-900">Our Mission & Values</h2>
                <p class="text-gray-500 text-lg">The pillars that support every rescue and every purr.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-[#f0ece5] rounded-3xl p-8 text-center space-y-4 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 mx-auto bg-[#fae8d4] text-[#a66a33] rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2c-5.33 0-8 3.48-8 7 0 2.2 1.48 4.29 4 5l1.6 3.6c.2.46.74.68 1.23.49L12 17.5l1.17.59c.49.19 1.03-.03 1.23-.49L16 14c2.52-.71 4-2.8 4-5 0-3.52-2.67-7-8-7zm0 2c3.54 0 6 2.45 6 5 0 1.43-.88 2.92-2.82 3.62l-1.37 3.08-.81-.41-1 .5-.81.41-1.37-3.08C6.88 11.42 6 9.93 6 9c0-2.55 2.46-5 6-5z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Cat Welfare</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Prioritizing the health, safety, and happiness of every campus feline under our care.</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-[#f0ece5] rounded-3xl p-8 text-center space-y-4 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 mx-auto bg-[#fae8d4] text-[#a66a33] rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Transparency</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Ensuring every donation and rescue action is tracked and visible to our supporters.</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-[#f0ece5] rounded-3xl p-8 text-center space-y-4 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 mx-auto bg-[#fae8d4] text-[#a66a33] rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Community</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Fostering a nurturing ecosystem of student volunteers and animal lovers at IIUM.</p>
                </div>
                <!-- Card 4 -->
                <div class="bg-[#f0ece5] rounded-3xl p-8 text-center space-y-4 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 mx-auto bg-[#fae8d4] text-[#a66a33] rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Tech-Enabled Care</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Leveraging modern platforms like e-Doptcat to optimize rescue logistics and outreach.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 4: Meet The Team -->
    <div class="bg-boho-bg py-16 pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 space-y-2">
                <h2 class="text-4xl font-sans font-bold text-gray-900">Meet the Team</h2>
                <p class="text-gray-500 text-lg">The passionate hearts behind the platform.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Team Member 1 -->
                <div class="space-y-4">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=600" alt="Nur Amira Nabila" class="w-full h-96 lg:h-[450px] object-cover rounded-[2.5rem] shadow-md grayscale">
                    <div>
                        <h3 class="font-bold text-xl text-gray-900">Nur Amira Nabila Binti Mohd Ab Rahman</h3>
                        <p class="text-[#a66a33] font-medium">Developer</p>
                    </div>
                </div>
                <!-- Team Member 2 -->
                <div class="space-y-4">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=600" alt="Nurul Nasreen" class="w-full h-96 lg:h-[450px] object-cover rounded-[2.5rem] shadow-md grayscale">
                    <div>
                        <h3 class="font-bold text-xl text-gray-900">Nurul Nasreen Binti Abdul Malik</h3>
                        <p class="text-[#a66a33] font-medium">Developer</p>
                    </div>
                </div>
                <!-- Team Member 3 -->
                <div class="space-y-4">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=600" alt="Dr Mohd Khairul Azmi" class="w-full h-96 lg:h-[450px] object-cover rounded-[2.5rem] shadow-md grayscale">
                    <div>
                        <h3 class="font-bold text-xl text-gray-900">Dr. Mohd Khairul Azmi Bin Hassan</h3>
                        <p class="text-[#a66a33] font-medium">Supervisor</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 5: CTA Banner -->
    <div class="bg-boho-bg pb-24">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-[#995913] to-[#e68a2e] rounded-[3rem] p-12 lg:p-16 text-center text-white shadow-2xl relative overflow-hidden">
                <div class="relative z-10 space-y-6">
                    <h2 class="text-4xl md:text-5xl font-bold font-sans">
                        Want to make a difference for campus cats?
                    </h2>
                    <p class="text-lg text-white/90 max-w-2xl mx-auto font-medium">
                        Join our growing community of volunteers and help us create a better world for every stray at IIUM.
                    </p>
                    <div class="pt-4">
                        <a href="{{ Route::has('volunteers.register') ? route('volunteers.register') : '#' }}" class="inline-block bg-[#fcf8f2] text-[#995913] font-bold px-8 py-4 rounded-full shadow hover:bg-white hover:scale-105 transition-all">
                            Become a Volunteer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>