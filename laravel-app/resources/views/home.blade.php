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

<div style="background-color: #CBA778;" class="min-h-screen font-pinterest-sans overflow-hidden relative pb-32">
    <!-- Big organic wave bg at the top stretching across right -->
    <div class="absolute right-0 top-0 w-[55vw] h-[120vh] bg-[#4C2E15]" style="border-radius: 40% 0 0 50% / 50% 0 0 60%; transform: scale(1.1) translateY(-5%); transform-origin: right top;"></div>
    
    <!-- Sparks -->
    <svg class="absolute bottom-[40%] left-[8%] w-8 h-8 animate-pulse opacity-70" style="fill: #ebd59e;" viewBox="0 0 24 24"><path d="M12 0l2 8 8 2-8 2-2 8-2-8-8-2 8-2z"/></svg>

    <div class="relative z-10 max-w-7xl mx-auto px-6 h-full flex flex-col">
        <!-- Hero Section -->
        <div class="flex flex-col md:flex-row items-center justify-between min-h-[80vh] gap-8 mb-24">
            <div class="w-full md:w-1/2 flex flex-col justify-center items-start pt-10">
                <h1 class="font-pinterest-script text-8xl md:text-[8rem] text-[#4C2E15] leading-[0.9] drop-shadow-sm font-normal">
                    Our Cozy<br>Cat Club
                </h1>
                
                <p class="font-pinterest-serif text-[#4C2E15]/90 text-xl md:text-2xl mt-12 max-w-md leading-relaxed font-medium">
                    Find comfort, love, and your purrfect feline companion. Every cat deserves a warm lap and a cozy home.
                </p>
                
                <a href="{{ route('cats.index') }}" class="mt-12 bg-[#4C2E15] text-[#f7ead4] px-10 py-4 rounded-full font-pinterest-sans font-bold shadow-lg hover:-translate-y-1 hover:bg-[#3f2513] transition duration-300">
                    Meet Our Cats
                </a>
            </div>
            
            <!-- Right Side: Image in white blob -->
            <div class="w-full md:w-1/2 flex justify-center items-center relative h-[600px]">
                <div class="w-[500px] h-[550px] relative z-20 overflow-hidden border-[8px] border-[#f4ebdf] shadow-2xl translate-x-12" style="border-radius: 40% 60% 70% 30% / 45% 45% 55% 55%;">
                    <img src="https://images.unsplash.com/photo-1543852786-1cf6624b9987?auto=format&fit=crop&w=800&q=80" alt="Cozy Cat" class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <!-- Cards section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-20">
            <!-- Card 1 -->
            <div class="bg-pinterest-card rounded-[2rem] p-6 shadow-xl transform md:translate-y-12 transition-transform hover:-translate-y-2 hover:md:translate-y-8 duration-500">
                <div class="h-48 rounded-[1.5rem] overflow-hidden mb-6 blob-1 border-4 border-white/50">
                    <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=500&q=80" class="w-full h-full object-cover" alt="Cat feature">
                </div>
                <h3 class="font-pinterest-script text-5xl text-pinterest-brown mb-2 mt-4">Our Mission</h3>
                <p class="font-pinterest-sans text-pinterest-brown/90 text-sm font-medium leading-relaxed mb-6">Rescuing campus cats and securing them a bright future. Explore our journey and how you can help.</p>
                <a href="{{ route('about') }}" class="inline-block bg-[#d1a568] text-pinterest-brown px-6 py-3 rounded-full text-xs font-bold w-full text-center hover:bg-pinterest-brown hover:text-pinterest-card shadow-md transition-colors">About Us</a>
            </div>
            
            <!-- Card 2 -->
            <div class="bg-pinterest-card rounded-[2rem] p-6 shadow-xl transform md:-translate-y-8 transition-transform hover:-translate-y-4 hover:md:-translate-y-12 duration-500">
                <div class="h-64 rounded-[1.5rem] overflow-hidden mb-6 blob-2 border-4 border-white/50">
                    <img src="https://images.unsplash.com/photo-1574158622682-e40e69881006?auto=format&fit=crop&w=500&q=80" class="w-full h-full object-cover" alt="Cat feature">
                </div>
                <h3 class="font-pinterest-script text-5xl text-pinterest-brown mb-2 mt-4 border-b-2 border-pinterest-brown/20 pb-2">Adopt</h3>
                <p class="font-pinterest-sans text-pinterest-brown/90 text-sm font-medium leading-relaxed">Many of our furry friends are waiting for a permanent home. Read their stories.</p>
                <a href="{{ route('cats.index') }}" class="mt-4 inline-block bg-pinterest-brown text-pinterest-card px-6 py-3 rounded-full text-xs font-bold w-full text-center shadow-md hover:bg-[#4a2a11] transition-colors">Find a Cat</a>
            </div>
            
            <!-- Card 3 -->
            <div class="bg-pinterest-card rounded-[2rem] p-6 shadow-xl transform md:translate-y-20 transition-transform hover:-translate-y-2 hover:md:translate-y-16 duration-500">
                <div class="h-48 rounded-[1.5rem] overflow-hidden mb-6 blob-3 border-4 border-white/50">
                    <img src="https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?auto=format&fit=crop&w=500&q=80" class="w-full h-full object-cover" alt="Cat feature">
                </div>
                <h3 class="font-pinterest-script text-5xl text-pinterest-brown mb-2 mt-4">Donate</h3>
                <p class="font-pinterest-sans text-pinterest-brown/90 text-sm font-medium leading-relaxed mb-6">Can't adopt? Every small contribution builds a bigger future for our rescues.</p>
                <a href="{{ route('donations.index') }}" class="inline-block bg-[#d1a568] text-pinterest-brown px-6 py-3 rounded-full text-xs font-bold w-full text-center hover:bg-pinterest-brown hover:text-pinterest-card shadow-md transition-colors">Donate Now</a>
            </div>
        </div>
        
        <!-- Bottom decorative wave -->
        <div class="absolute -bottom-40 -left-40 w-[600px] h-[600px] bg-pinterest-card blob-1 opacity-40 mix-blend-overlay pointer-events-none z-0"></div>
    </div>
</div>
</x-app-layout>