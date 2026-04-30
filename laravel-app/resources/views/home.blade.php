<x-app-layout>
    <!-- Background Texture/Overlay -->
    <div class="fixed inset-0 pointer-events-none z-0 opacity-20"
        style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23d4a373\' fill-opacity=\'0.1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
    </div>

    <div class="relative w-full z-10">
        <!-- User Greeting Section -->
        @auth
        <div class="relative bg-gradient-to-r from-boho-orange/10 to-boho-brown/5 pt-6 pb-6">
            <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        @if (Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                class="w-12 h-12 rounded-full object-cover ring-2 ring-boho-orange/50 shadow-md">
                        @else
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-boho-brown flex items-center justify-center text-white text-sm font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <p class="text-sm text-gray-600">Welcome back 👋</p>
                            <p class="text-lg sm:text-xl font-bold text-boho-brown">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-sm font-bold text-boho-orange hover:text-orange-600 transition-colors">
                            Admin Panel
                        </a>
                    @else
                        <a href="{{ route('profile.edit') }}"
                            class="text-sm font-bold text-boho-orange hover:text-orange-600 transition-colors">
                            Edit Profile
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @endauth

        <!-- Hero Section -->
        <div class="relative bg-boho-bg overflow-hidden pt-12 pb-24 sm:pt-24 sm:pb-32">
            <!-- Organic Blobs Background -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
                <svg class="absolute -top-24 -left-24 w-96 h-96 text-boho-brown/5 opacity-50 blur-3xl animate-blob"
                    fill="currentColor" viewBox="0 0 200 200">
                    <path
                        d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,79.6,-46.9C87.4,-34.7,90.1,-20.4,85.8,-7.1C81.5,6.2,70.2,18.5,59.6,29.1C49,39.7,39.1,48.6,27.9,56.6C16.7,64.7,4.2,71.9,-7.4,70.6C-19,69.3,-29.7,59.5,-39.5,49.8C-49.3,40.1,-58.2,30.5,-64.3,19.2C-70.4,7.9,-73.7,-5.1,-70.5,-16.6C-67.3,-28.1,-57.6,-38.1,-46.6,-46.3C-35.6,-54.5,-23.3,-60.9,-10.8,-62.7C1.7,-64.5,14.2,-61.7,26.7,-58.9"
                        transform="translate(100 100)" />
                </svg>
                <svg class="absolute top-1/2 right-0 w-[500px] h-[500px] text-boho-orange/5 opacity-40 blur-3xl animate-blob animation-delay-2000"
                    fill="currentColor" viewBox="0 0 200 200">
                    <path
                        d="M41.7,-72.1C53.6,-66.2,62.8,-55.3,69.5,-43.6C76.2,-31.9,80.4,-19.4,79.8,-7.2C79.2,5,73.8,16.8,66,27.1C58.2,37.4,48,46.2,37.1,52.8C26.2,59.4,14.6,63.8,2.7,59.1C-9.2,54.4,-21.4,40.6,-32.1,28.8C-42.8,17,-52,7.2,-55.1,-4.5C-58.2,-16.2,-55.2,-29.8,-46.7,-40.3C-38.2,-50.8,-24.2,-58.2,-10.7,-60.4C2.8,-62.6,16.3,-59.6,29.8,-56.6"
                        transform="translate(100 100)" />
                </svg>
            </div>

            <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col pt-10 md:flex-row items-center gap-12 relative z-10">
            <!-- Text Content -->
            <div
                class="md:w-1/2 text-left z-10 scroll-animate opacity-0 translate-y-10 transition-all duration-1000 ease-out">
                <h1 class="text-5xl md:text-7xl font-serif font-bold text-boho-brown mb-6 leading-tight">
                    Adopt, <span class="italic text-boho-orange relative inline-block">
                        Don't Shop
                        <svg class="absolute w-full h-3 -bottom-1 left-0 text-boho-orange opacity-40"
                            viewBox="0 0 100 10" preserveAspectRatio="none">
                            <path d="M0 5 Q 50 10 100 5 L 100 8 Q 50 13 0 8 Z" fill="currentColor" />
                        </svg>
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-600 mb-8 font-light leading-relaxed">
                    Join <span class="font-semibold text-boho-brown">Abu Hurairah Club</span> in our mission to rescue,
                    rehabilitate, and rehome stray cats.
                    <br class="hidden md:block">Real-time adoption at your fingertips.
                </p>

                <div class="flex flex-col sm:flex-row gap-5">
                    <a href="{{ route('cats.index') }}"
                        class="group inline-flex justify-center items-center px-8 py-4 bg-boho-brown text-white text-lg font-bold rounded-2xl shadow-lg hover:bg-boho-dark hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        Find a Companion
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="{{ route('donations.index') }}"
                        class="inline-flex justify-center items-center px-8 py-4 bg-white text-boho-brown border-2 border-boho-brown/20 text-lg font-bold rounded-2xl shadow-sm hover:border-boho-brown hover:bg-boho-light/20 transition-all duration-300">
                        Make a Donation
                    </a>
                </div>
            </div>

            <!-- Hero Image -->
            <div
                class="md:w-1/2 relative w-full scroll-animate opacity-0 translate-y-10 transition-all duration-1000 ease-out delay-200">
                <!-- Decorative Elements behind image -->
                <div class="absolute -top-8 -right-8 w-32 h-32 bg-boho-orange/20 rounded-full blur-2xl animate-pulse">
                </div>
                <div class="absolute -bottom-8 -left-8 w-40 h-40 bg-boho-brown/10 rounded-full blur-2xl"></div>

                <div
                    class="relative rounded-[3rem] overflow-hidden shadow-2xl border-[6px] border-white transform rotate-2 hover:rotate-0 transition-all duration-700 group">
                    <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                        alt="Rescue Cat"
                        class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-1000">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-60"></div>

                    <!-- Latest Rescue Badge -->
                    <div
                        class="absolute bottom-6 left-6 bg-white/95 backdrop-blur-md p-4 rounded-2xl shadow-lg flex items-center gap-4 max-w-xs border border-white/50">
                        <div class="bg-green-100 p-2.5 rounded-full relative">
                            <span
                                class="block w-2.5 h-2.5 bg-green-500 rounded-full animate-ping absolute top-0 right-0 -mt-1 -mr-1"></span>
                            <span class="block w-2.5 h-2.5 bg-green-500 rounded-full"></span>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Just Rescued</p>
                            <p class="text-base font-bold text-boho-brown">Whiskers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SDG 15 & About Section -->
    <div class="bg-boho-light/30 py-24 relative z-10">
        <!-- Wave Divider Top -->
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-none transform rotate-180">
            <svg class="relative block w-full h-[50px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="fill-white"></path>
            </svg>
        </div>

        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <!-- SDG 15 Info -->
                <div
                    class="order-2 md:order-1 scroll-animate opacity-0 translate-y-10 transition-all duration-1000 ease-out">
                    <span class="text-boho-orange font-bold tracking-widest uppercase text-sm mb-2 block">Global
                        Goals</span>
                    <h2 class="text-4xl font-bold text-boho-brown mb-6 font-serif">
                        Supporting SDG 15: <br><span class="text-boho-orange">Life on Land</span>
                    </h2>
                    <p class="text-gray-600 mb-8 leading-relaxed text-lg">
                        Our mission aligns with the United Nations Sustainable Development Goal 15. We work tirelessly
                        to protect terrestrial ecosystems by managing stray populations securely and humanely.
                    </p>

                    <div class="space-y-6">
                        <div
                            class="flex items-start gap-4 p-4 bg-white rounded-2xl shadow-sm border border-boho-light/50">
                            <div class="bg-boho-light p-3 rounded-xl text-boho-brown shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Population Control</h4>
                                <p class="text-sm text-gray-600 mt-1">Reducing stray cat populations through ethical
                                    adoption and sterilization programs.</p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-4 p-4 bg-white rounded-2xl shadow-sm border border-boho-light/50">
                            <div class="bg-boho-light p-3 rounded-xl text-boho-brown shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Ecosystem Balance</h4>
                                <p class="text-sm text-gray-600 mt-1">Protecting local biodiversity by managing
                                    uncontrolled feral cat colonies.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- About AHC -->
                <div
                    class="order-1 md:order-2 scroll-animate opacity-0 translate-y-10 transition-all duration-1000 ease-out delay-200">
                    <div
                        class="bg-white p-10 rounded-[3rem] shadow-xl border border-boho-light relative overflow-hidden group hover:shadow-2xl transition-all duration-500">
                        <div
                            class="absolute top-0 right-0 w-40 h-40 bg-boho-light rounded-bl-[100px] opacity-50 transition-transform group-hover:scale-110 duration-700">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-24 h-24 bg-boho-orange/10 rounded-tr-[80px] opacity-50 transition-transform group-hover:scale-125 duration-700">
                        </div>

                        <h2 class="text-3xl font-serif font-bold text-boho-brown mb-6 text-center relative z-10">
                            Who We Are
                        </h2>

                        <div class="w-16 h-1 bg-boho-orange mx-auto rounded-full mb-8"></div>

                        <p class="text-gray-600 mb-8 leading-relaxed text-center relative z-10 font-light text-lg">
                            <span class="font-bold text-boho-brown">Abu Hurairah Club</span> combines modern technology
                            with compassionate care. We are a student-led initiative dedicated to creating a safer,
                            kinder campus for our feline friends.
                        </p>
                        <div class="text-center relative z-10">
                            <a href="{{ route('about') }}"
                                class="inline-block px-8 py-3 border-2 border-boho-brown text-boho-brown font-bold rounded-xl hover:bg-boho-brown hover:text-white transition-all transform hover:-translate-y-1">
                                Meet The Team
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Divider Bottom -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
            <svg class="relative block w-full h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                    class="fill-white"></path>
            </svg>
        </div>
    </div>

    <!-- Our Impact -->
    <div class="py-24 bg-white z-10 relative">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="text-center mb-16 scroll-animate opacity-0 translate-y-10 transition-all duration-1000 ease-out">
                <h2 class="text-4xl font-serif font-bold text-boho-brown mb-4">Our Impact</h2>
                <div class="w-24 h-1 bg-boho-orange mx-auto rounded-full mb-4"></div>
                <p class="text-xl text-gray-500">Making a difference, one cat at a time</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Stat Card 1 -->
                <div class="bg-boho-bg p-8 rounded-[2rem] border border-boho-light flex flex-col items-center justify-center transform hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group scroll-animate opacity-0 translate-y-10 ease-out delay-0"
                    style="transition-duration: 1000ms;">
                    <div
                        class="mb-4 bg-white p-4 rounded-full shadow-sm text-boho-brown group-hover:scale-110 transition-transform group-hover:bg-boho-brown group-hover:text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <div class="text-4xl font-serif font-bold text-gray-800 mb-2">{{ $impact['adopted'] }}</div>
                    <div class="text-gray-500 font-bold uppercase text-xs tracking-wider">Cats Adopted</div>
                </div>

                <!-- Stat Card 2 -->
                <div class="bg-boho-bg p-8 rounded-[2rem] border border-boho-light flex flex-col items-center justify-center transform hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group scroll-animate opacity-0 translate-y-10 ease-out delay-150"
                    style="transition-duration: 1000ms;">
                    <div
                        class="mb-4 bg-white p-4 rounded-full shadow-sm text-boho-orange group-hover:scale-110 transition-transform group-hover:bg-boho-orange group-hover:text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div class="text-4xl font-serif font-bold text-gray-800 mb-2">{{ $impact['rescued'] }}</div>
                    <div class="text-gray-500 font-bold uppercase text-xs tracking-wider">Cats Rescued</div>
                </div>

                <!-- Stat Card 3 -->
                <div class="bg-boho-bg p-8 rounded-[2rem] border border-boho-light flex flex-col items-center justify-center transform hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group scroll-animate opacity-0 translate-y-10 ease-out delay-300"
                    style="transition-duration: 1000ms;">
                    <div
                        class="mb-4 bg-white p-4 rounded-full shadow-sm text-green-600 group-hover:scale-110 transition-transform group-hover:bg-green-600 group-hover:text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-4xl font-serif font-bold text-gray-800 mb-2">RM
                        {{ number_format($impact['raised']) }}</div>
                    <div class="text-gray-500 font-bold uppercase text-xs tracking-wider">Donations</div>
                </div>

                <!-- Stat Card 4 -->
                <div class="bg-boho-bg p-8 rounded-[2rem] border border-boho-light flex flex-col items-center justify-center transform hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group scroll-animate opacity-0 translate-y-10 ease-out delay-450"
                    style="transition-duration: 1000ms;">
                    <div
                        class="mb-4 bg-white p-4 rounded-full shadow-sm text-purple-500 group-hover:scale-110 transition-transform group-hover:bg-purple-500 group-hover:text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z" />
                        </svg>
                    </div>
                    <div class="text-4xl font-serif font-bold text-gray-800 mb-2">94%</div>
                    <div class="text-gray-500 font-bold uppercase text-xs tracking-wider">Success Rate</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Stories (Testimonials) Section (NEW) -->
    <div class="py-24 bg-boho-light/30 relative z-10">
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-none transform">
            <svg class="relative block w-full h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="fill-white"></path>
            </svg>
        </div>

        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
            <div
                class="text-center mb-16 scroll-animate opacity-0 translate-y-10 transition-all duration-1000 ease-out">
                <span class="text-boho-orange font-bold tracking-widest uppercase text-sm mb-2 block">Happy Tails</span>
                <h2 class="text-4xl font-serif font-bold text-boho-brown mb-4">Success Stories</h2>
                <div class="w-16 h-1 bg-boho-orange mx-auto rounded-full mb-8"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-boho-light relative scroll-animate opacity-0 translate-y-10 ease-out delay-0"
                    style="transition-duration: 1000ms;">
                    <div class="absolute -top-5 left-8 bg-boho-orange text-white p-3 rounded-xl shadow-md">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM5.0166 21L5.0166 18C5.0166 16.8954 5.91203 16 7.0166 16H10.0166C10.5689 16 11.0166 15.5523 11.0166 15V9C11.0166 8.44772 10.5689 8 10.0166 8H6.0166C5.46432 8 5.0166 8.44772 5.0166 9V11C5.0166 11.5523 4.56889 12 4.0166 12H3.0166V5H13.0166V15C13.0166 18.3137 10.3303 21 7.0166 21H5.0166Z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-gray-600 italic mb-6 pt-4 text-lg">"Adopting Luna was the best decision I made in
                        University. She brings so much joy to my daily life!"</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Ali&background=random"
                            class="w-12 h-12 rounded-full" alt="User">
                        <div>
                            <h4 class="font-bold text-gray-800">Ahmad Ali</h4>
                            <p class="text-sm text-gray-500">Engineering Student</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-boho-light relative scroll-animate opacity-0 translate-y-10 ease-out delay-150"
                    style="transition-duration: 1000ms;">
                    <div class="absolute -top-5 left-8 bg-boho-orange text-white p-3 rounded-xl shadow-md">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM5.0166 21L5.0166 18C5.0166 16.8954 5.91203 16 7.0166 16H10.0166C10.5689 16 11.0166 15.5523 11.0166 15V9C11.0166 8.44772 10.5689 8 10.0166 8H6.0166C5.46432 8 5.0166 8.44772 5.0166 9V11C5.0166 11.5523 4.56889 12 4.0166 12H3.0166V5H13.0166V15C13.0166 18.3137 10.3303 21 7.0166 21H5.0166Z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-gray-600 italic mb-6 pt-4 text-lg">"The adoption process was seamless. The team cares
                        so much about these cats. Highly recommended!"</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Sarah+Lee&background=random"
                            class="w-12 h-12 rounded-full" alt="User">
                        <div>
                            <h4 class="font-bold text-gray-800">Sarah Lee</h4>
                            <p class="text-sm text-gray-500">Staff Member</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-boho-light relative scroll-animate opacity-0 translate-y-10 ease-out delay-300"
                    style="transition-duration: 1000ms;">
                    <div class="absolute -top-5 left-8 bg-boho-orange text-white p-3 rounded-xl shadow-md">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM5.0166 21L5.0166 18C5.0166 16.8954 5.91203 16 7.0166 16H10.0166C10.5689 16 11.0166 15.5523 11.0166 15V9C11.0166 8.44772 10.5689 8 10.0166 8H6.0166C5.46432 8 5.0166 8.44772 5.0166 9V11C5.0166 11.5523 4.56889 12 4.0166 12H3.0166V5H13.0166V15C13.0166 18.3137 10.3303 21 7.0166 21H5.0166Z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-gray-600 italic mb-6 pt-4 text-lg">"Thank you Abu Hurairah Club for saving Oyen. He's
                        recovered fully and is now the king of my house."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=random"
                            class="w-12 h-12 rounded-full" alt="User">
                        <div>
                            <h4 class="font-bold text-gray-800">John Doe</h4>
                            <p class="text-sm text-gray-500">Alumni</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter Section (NEW) -->
    <div class="bg-boho-brown py-20 relative overflow-hidden text-white">
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div
            class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center scroll-animate opacity-0 translate-y-10 transition-all duration-1000 ease-out">
            <h2 class="text-4xl font-serif font-bold mb-4">Stay Updated</h2>
            <p class="text-boho-bg/80 text-lg mb-8 max-w-2xl mx-auto">Get the latest updates on rescues, adoption
                events, and happy endings delivered straight to your inbox.</p>

            <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                <input type="email" placeholder="Your email address"
                    class="flex-1 px-6 py-4 rounded-xl border-none text-gray-800 focus:ring-4 focus:ring-boho-orange/50 shadow-lg"
                    required>
                <button type="submit"
                    class="px-8 py-4 bg-boho-orange hover:bg-orange-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                    Subscribe
                </button>
            </form>
            <p class="text-sm text-white/40 mt-4">We respect your privacy. Unsubscribe at any time.</p>
        </div>
    </div>

    <!-- Scroll Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            const animatedElements = document.querySelectorAll('.scroll-animate');
            animatedElements.forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
</x-app-layout>