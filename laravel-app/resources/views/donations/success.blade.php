<x-app-layout>
    <div class="py-20 bg-boho-bg min-h-screen flex items-center justify-center">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Animated Success Icon -->
            <div class="mb-8 relative">
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 relative z-10 animate-bounce">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-24 h-24 bg-green-200 rounded-full blur-xl opacity-50 animate-pulse"></div>
            </div>

            <!-- Content -->
            <h1 class="font-serif font-bold text-5xl text-boho-brown mb-6">
                Thank You for Your Support!
            </h1>
            
            <div class="w-24 h-1 bg-boho-orange mx-auto rounded-full mb-8"></div>

            <p class="text-xl text-gray-600 mb-10 leading-relaxed">
                Your generous donation of <span class="font-bold text-boho-brown text-2xl">RM {{ $amount }}</span> has been received successfully. 
                Because of you, we can continue providing a safe haven for cats in need.
            </p>

            <!-- Donation Details Card -->
            <div class="bg-white rounded-3xl shadow-xl p-8 border border-boho-light mb-12 transform transition hover:scale-[1.02]">
                <div class="grid grid-cols-2 gap-4 text-left">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Transaction ID</p>
                        <p class="text-sm font-mono text-gray-600 truncate">{{ $transaction_id }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Date</p>
                        <p class="text-sm font-semibold text-gray-700">{{ now()->format('M d, Y') }}</p>
                    </div>
                    <div class="col-span-2 pt-4 border-t border-gray-100 mt-2">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Payment Status</span>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase tracking-wide">Completed</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('cats.index') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-boho-orange hover:bg-orange-600 text-white font-bold rounded-2xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl text-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Meet More Cats
                </a>
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-white border-2 border-boho-light hover:border-boho-brown text-boho-brown font-bold rounded-2xl transition-all hover:bg-boho-light/10">
                    Go to Dashboard
                </a>
            </div>

            <p class="mt-12 text-sm text-gray-400 italic">
                A confirmation receipt has been sent to your registered email address.
            </p>
        </div>
    </div>
</x-app-layout>
