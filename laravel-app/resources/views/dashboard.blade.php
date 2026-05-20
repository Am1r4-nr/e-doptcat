<x-app-layout>
    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        <!-- Admin Alert if applicable -->
        @if(auth()->user()->role === 'admin')
        <div class="mb-8 bg-[#F5DEB3]/20 border-2 border-cozy-brown p-5 rounded-3xl flex items-center justify-between shadow-sm">
            <div>
                <h3 class="text-xl font-script font-bold text-cozy-brown tracking-wide">Admin Access</h3>
                <p class="text-cozy-brown/70 font-medium mt-1">You have administrative privileges to manage cats and users.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="bg-cozy-brown hover:bg-[#573D2B] text-cozy-card font-bold py-3 px-6 rounded-full transition-all hover:-translate-y-1 shadow-md">
                Admin Panel &rarr;
            </a>
        </div>
        @endif

        <!-- Hero Welcome Section -->
        <div class="relative overflow-hidden bg-[#F5DEB3] rounded-[2.5rem] p-8 md:p-12 mb-10 shadow-lg flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="relative z-10 md:w-1/2">
                <div class="inline-block px-4 py-1.5 rounded-full bg-cozy-bg/50 text-cozy-brown font-bold text-sm mb-4 border border-cozy-brown/10 backdrop-blur-sm">
                    ✨ Welcome back, {{ Auth::user()->name }}
                </div>
                <h1 class="text-5xl md:text-6xl font-script font-black text-cozy-brown leading-tight mb-4 tracking-tighter transform -rotate-2">
                    Find Your<br>Purr-fect Match
                </h1>
                <p class="text-cozy-brown/80 text-lg md:text-xl font-medium mb-8 max-w-md">
                    Explore our available cats and give them a loving forever home. Every cat deserves a chance.
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('cats.index') }}" class="bg-cozy-brown text-cozy-card px-8 py-4 rounded-full font-bold text-lg hover:bg-[#573D2B] transition-all hover:scale-105 shadow-xl flex items-center gap-2">
                        Browse Cats
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="{{ route('tracker') }}" class="bg-cozy-card text-cozy-brown px-8 py-4 rounded-full font-bold text-lg hover:bg-white transition-all hover:scale-105 shadow-md">
                        Track Application
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 relative flex justify-center">
                <!-- Abstract organic shapes decoration -->
                <div class="absolute inset-0 bg-cozy-bg/40 rounded-[60%_40%_30%_70%/60%_30%_70%_40%] blur-3xl transform scale-150" style="animation: blobPulse 8s infinite alternate;"></div>
                <!-- Placeholder for a cat illustration or image -->
                <div class="relative w-72 h-72 md:w-96 md:h-96 bg-cozy-card rounded-[60%_40%_30%_70%/60%_30%_70%_40%] shadow-inner overflow-hidden border-8 border-[#F5DEB3] flex items-center justify-center transform rotate-3 hover:rotate-0 transition-transform duration-500">
                    <div class="text-center p-6">
                        <div class="text-6xl mb-4">☕</div>
                        <div class="font-script text-4xl text-cozy-brown font-bold">Adopt Today</div>
                        <div class="text-cozy-brown/60 font-medium text-sm mt-2">View profiles and start<br>your journey.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Widgets -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Quick Stats -->
            <div class="col-span-1 bg-cozy-card rounded-[2.5rem] p-8 shadow-sm border border-cozy-brown/10">
                <h3 class="text-3xl font-script font-bold text-cozy-brown mb-6">Your Activity</h3>
                <div class="space-y-6">
                    <div class="flex items-center gap-4 bg-cozy-bg/30 p-4 rounded-2xl">
                        <div class="w-12 h-12 bg-[#F5DEB3] text-cozy-brown rounded-full flex items-center justify-center text-xl font-bold">
                            0
                        </div>
                        <div>
                            <div class="font-bold text-cozy-brown text-lg">Applications</div>
                            <div class="text-sm text-cozy-brown/60 font-medium">Pending review</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 bg-cozy-bg/30 p-4 rounded-2xl">
                        <div class="w-12 h-12 bg-[#F5DEB3] text-cozy-brown rounded-full flex items-center justify-center text-xl font-bold">
                            0
                        </div>
                        <div>
                            <div class="font-bold text-cozy-brown text-lg">Saved Cats</div>
                            <div class="text-sm text-cozy-brown/60 font-medium">Your favorites</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- News/Events Card -->
            <div class="col-span-2 bg-cozy-brown rounded-[2.5rem] p-8 shadow-md relative overflow-hidden text-cozy-card flex flex-col justify-between">
                <div class="absolute top-0 right-0 w-64 h-64 bg-[#F5DEB3] rounded-full blur-3xl opacity-20 -mr-20 -mt-20"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-4xl font-script font-bold">Upcoming Events</h3>
                        <span class="bg-[#F5DEB3] text-cozy-brown px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Soon</span>
                    </div>
                    <p class="text-cozy-card/80 text-lg mb-8 max-w-md">
                        Join our weekend adoption drive and meet the wonderful cats waiting for their forever homes.
                    </p>
                </div>
                <div class="relative z-10 flex gap-4 mt-auto">
                    <a href="{{ route('events.index') }}" class="bg-[#F5DEB3] text-cozy-brown px-6 py-3 rounded-full font-bold hover:bg-cozy-card transition-colors">
                        View Events
                    </a>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
