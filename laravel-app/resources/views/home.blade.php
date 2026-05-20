<x-app-layout>
<style>
    @keyframes floatSlow {
        0%,100% { transform: translateY(0); }
        50%      { transform: translateY(-15px); }
    }
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .float-slow { animation: floatSlow 8s ease-in-out infinite; }
    .blob { animation: blobPulse 12s ease-in-out infinite; }
    .wave-bg {
        background: #E6C697;
    }
    .cozy-text-shadow {
        text-shadow: 2px 2px 4px rgba(111, 78, 55, 0.15);
    }
</style>

<div class="wave-bg min-h-screen pt-24 pb-20 overflow-hidden relative">

    <!-- Top Left Decor -->
    <div class="absolute top-10 left-10 opacity-60 float-slow">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#6F4E37" stroke-width="1.5">
            <path d="M12 2L15 8L21 9L16 14L18 20L12 17L6 20L8 14L3 9L9 8L12 2Z" fill="#FFF4E3" stroke-linejoin="round"/>
        </svg>
    </div>

    <!-- Organic background shapes (mimicking the beige waves) -->
    <div class="absolute top-[40%] left-0 right-0 h-screen bg-[#F5DEB3] opacity-60 rounded-t-[100%] scale-[1.5] -z-10 transform -translate-y-1/2 rotate-12"></div>
    <div class="absolute bottom-0 left-[-20%] w-[150%] h-[60%] bg-white rounded-t-[50%] -z-10"></div>

    <!-- Hero Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col items-center">
        
        <!-- Large Script Title -->
        <h1 class="font-script text-6xl md:text-8xl text-cozy-brown text-center leading-tight mb-8 cozy-text-shadow transform -rotate-2 mt-4">
            E-Doptcat<br>Cozy Companions
        </h1>

        <!-- Hero Image (Blob Shaped) -->
        <div class="relative w-[90%] md:w-[70%] max-w-3xl aspect-[16/9] blob overflow-hidden shadow-2xl border-8 border-[#F5DEB3] mx-auto mb-16">
            <!-- Using a placeholder cat image that fits the cozy vibe -->
            <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?q=80&w=2043&auto=format&fit=crop" 
                 alt="Cozy Cat" class="w-full h-full object-cover">
                 
            <div class="absolute inset-0 bg-gradient-to-t from-cozy-brown/40 to-transparent"></div>
        </div>

        <!-- Floating Info Element (like the flower pot in the image) -->
        <div class="absolute right-[5%] top-[45%] hidden md:block">
            <div class="bg-cozy-brown/10 backdrop-blur-md p-6 rounded-3xl text-cozy-brown w-48 shadow-lg transform rotate-3">
                <h3 class="font-bold text-lg mb-2">Our Mission</h3>
                <ul class="text-sm space-y-1 opacity-80">
                    <li>Rescue Strays</li>
                    <li>Rehabilitate</li>
                    <li>Rehome</li>
                    <li>Cozy Life</li>
                </ul>
            </div>
        </div>

        <!-- Cards Section -->
        <div class="w-full mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
            
            <!-- Card 1 -->
            <div class="bg-cozy-card rounded-[2.5rem] p-6 shadow-xl transform transition-transform hover:-translate-y-2 border border-cozy-brown/10">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-script text-4xl text-cozy-brown">Adopt</h3>
                    <svg class="w-6 h-6 text-cozy-brown/50" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </div>
                <div class="w-full h-40 bg-[#E6C697] rounded-3xl overflow-hidden mb-4 blob">
                    <img src="https://images.unsplash.com/photo-1543852786-1cf6624b9987?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Cat 1">
                </div>
                <p class="text-sm text-cozy-brown/70 font-medium mb-6">
                    Find your purr-fect cozy companion today. Give a stray a forever home.
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('cats.index') }}" class="px-8 py-3 bg-cozy-brown text-cozy-card rounded-full font-bold shadow-md hover:bg-[#573D2B] transition-colors">
                        Meet Cats
                    </a>
                </div>
            </div>

            <!-- Card 2 (Tracker) -->
            <div class="bg-cozy-card rounded-[2.5rem] p-6 shadow-xl transform transition-transform hover:-translate-y-2 border border-cozy-brown/10 md:mt-12">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-script text-4xl text-cozy-brown">Track</h3>
                    <svg class="w-6 h-6 text-cozy-brown/50" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                </div>
                <div class="w-full h-40 bg-[#E6C697] rounded-3xl overflow-hidden mb-4 blob" style="animation-delay: -3s;">
                    <img src="https://images.unsplash.com/photo-1495360010541-f48722b34f7d?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Cat Map">
                </div>
                <p class="text-sm text-cozy-brown/70 font-medium mb-6">
                    Monitor the location and health status of cats in our care using GPS.
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('tracker') }}" class="px-8 py-3 bg-cozy-brown text-cozy-card rounded-full font-bold shadow-md hover:bg-[#573D2B] transition-colors">
                        Live Map
                    </a>
                </div>
            </div>

            <!-- Card 3 (Donate) -->
            <div class="bg-cozy-card rounded-[2.5rem] p-6 shadow-xl transform transition-transform hover:-translate-y-2 border border-cozy-brown/10">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-script text-4xl text-cozy-brown">Donate</h3>
                    <svg class="w-6 h-6 text-cozy-brown/50" fill="currentColor" viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
                </div>
                <div class="w-full h-40 bg-[#E6C697] rounded-3xl overflow-hidden mb-4 blob" style="animation-delay: -6s;">
                    <img src="https://images.unsplash.com/photo-1574144611937-0df059b5ef3e?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Donate">
                </div>
                <p class="text-sm text-cozy-brown/70 font-medium mb-6">
                    Support our mission. Every little bit helps provide food, shelter, and care.
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('donations.index') }}" class="px-8 py-3 bg-cozy-brown text-cozy-card rounded-full font-bold shadow-md hover:bg-[#573D2B] transition-colors">
                        Support Us
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
</x-app-layout>
