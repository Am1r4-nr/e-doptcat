<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }
</style>

<div class="pt-28 pb-20 bg-cozy-bg min-h-screen flex items-center justify-center relative overflow-hidden">
    <div class="absolute top-0 left-0 w-72 h-72 bg-cozy-warm/40 blob opacity-50 -translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-cozy-accent/20 blob opacity-40 translate-x-1/3 translate-y-1/3 pointer-events-none" style="animation-delay:-5s;"></div>

    <div class="relative z-10 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Success Icon -->
        <div class="mb-8 relative">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 relative z-10 animate-bounce">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-24 h-24 bg-green-200 rounded-full blur-xl opacity-50 animate-pulse"></div>
        </div>

        <p class="font-script text-2xl text-cozy-accent mb-2">From our hearts to yours</p>
        <h1 class="font-serif font-bold text-5xl text-cozy-brown mb-4">Thank You for Your Support!</h1>
        <div class="w-24 h-1 bg-cozy-accent/60 mx-auto rounded-full mb-8"></div>

        <p class="text-xl text-cozy-brown/60 mb-10 leading-relaxed">
            Your generous donation of <span class="font-bold text-cozy-brown text-2xl">RM {{ $amount }}</span> has been received successfully.
            Because of you, we can continue providing a safe haven for cats in need.
        </p>

        <!-- Donation Details Card -->
        <div class="bg-cozy-card rounded-3xl shadow-xl p-8 border border-cozy-warm/40 mb-12 transform transition hover:scale-[1.02]">
            <div class="grid grid-cols-2 gap-4 text-left">
                <div>
                    <p class="text-xs text-cozy-brown/40 uppercase tracking-widest mb-1">Transaction ID</p>
                    <p class="text-sm font-mono text-cozy-brown/70 truncate">{{ $transaction_id }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-cozy-brown/40 uppercase tracking-widest mb-1">Date</p>
                    <p class="text-sm font-semibold text-cozy-brown">{{ now()->format('M d, Y') }}</p>
                </div>
                <div class="col-span-2 pt-4 border-t border-cozy-warm/30 mt-2">
                    <div class="flex justify-between items-center">
                        <span class="text-cozy-brown/60 font-medium">Payment Status</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase tracking-wide">Completed</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('cats.index') }}"
               class="inline-flex items-center justify-center px-8 py-4 bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold rounded-2xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl text-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Meet More Cats
            </a>
            <a href="{{ route('home') }}"
               class="inline-flex items-center justify-center px-8 py-4 bg-cozy-card border-2 border-cozy-warm hover:border-cozy-brown text-cozy-brown font-bold rounded-2xl transition-all hover:bg-cozy-warm/20">
                Go to Home
            </a>
        </div>

        <p class="mt-12 text-sm text-cozy-brown/40 italic">
            A confirmation receipt has been sent to your registered email address.
        </p>
    </div>
</div>
</x-app-layout>
