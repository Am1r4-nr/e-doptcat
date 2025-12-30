<x-app-layout>
    <div class="py-12 bg-boho-bg min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="font-serif font-bold text-4xl text-boho-brown mb-4">
                    {{ __('Support Our Cause') }}
                </h2>
                <div class="w-24 h-1 bg-boho-orange mx-auto rounded-full"></div>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                    Your contribution helps us rescue, treat, and find homes for stray cats. Every ringgit counts.
                </p>
            </div>

            <!-- Impact Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Card 1 -->
                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-boho-light text-center transform transition hover:-translate-y-1 hover:shadow-md">
                    <div
                        class="w-16 h-16 bg-boho-light rounded-full flex items-center justify-center mx-auto mb-4 text-boho-brown">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg text-boho-brown mb-2">RM 10</h4>
                    <p class="text-sm text-gray-500">Provides food for one cat for a week.</p>
                </div>
                <!-- Card 2 -->
                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-boho-light text-center transform transition hover:-translate-y-1 hover:shadow-md">
                    <div
                        class="w-16 h-16 bg-boho-light rounded-full flex items-center justify-center mx-auto mb-4 text-boho-brown">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg text-boho-brown mb-2">RM 50</h4>
                    <p class="text-sm text-gray-500">Covers essential vaccinations and medical checks.</p>
                </div>
                <!-- Card 3 -->
                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-boho-light text-center transform transition hover:-translate-y-1 hover:shadow-md">
                    <div
                        class="w-16 h-16 bg-boho-light rounded-full flex items-center justify-center mx-auto mb-4 text-boho-brown">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg text-boho-brown mb-2">RM 100+</h4>
                    <p class="text-sm text-gray-500">Helps with shelter maintenance and emergency rescues.</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl rounded-3xl p-8 border border-boho-light">
                @if(session('success'))
                    <div
                        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('donations.store') }}" class="max-w-xl mx-auto"
                    x-data="{ amount: '' }">
                    @csrf

                    <div class="mb-8">
                        <label class="block text-gray-700 text-sm font-bold mb-4 uppercase tracking-wider">Choose Amount
                            (MYR)</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                            <button type="button" @click="amount = '10'"
                                :class="amount == '10' ? 'bg-boho-brown text-white border-boho-brown' : 'bg-white text-gray-600 border-gray-300 hover:border-boho-brown'"
                                class="py-3 px-4 rounded-xl border-2 font-bold transition-all">RM 10</button>
                            <button type="button" @click="amount = '30'"
                                :class="amount == '30' ? 'bg-boho-brown text-white border-boho-brown' : 'bg-white text-gray-600 border-gray-300 hover:border-boho-brown'"
                                class="py-3 px-4 rounded-xl border-2 font-bold transition-all">RM 30</button>
                            <button type="button" @click="amount = '50'"
                                :class="amount == '50' ? 'bg-boho-brown text-white border-boho-brown' : 'bg-white text-gray-600 border-gray-300 hover:border-boho-brown'"
                                class="py-3 px-4 rounded-xl border-2 font-bold transition-all">RM 50</button>
                            <button type="button" @click="amount = '100'"
                                :class="amount == '100' ? 'bg-boho-brown text-white border-boho-brown' : 'bg-white text-gray-600 border-gray-300 hover:border-boho-brown'"
                                class="py-3 px-4 rounded-xl border-2 font-bold transition-all">RM 100</button>
                        </div>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 font-bold">RM</span>
                            <input type="number" name="amount" x-model="amount"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border-gray-300 focus:border-boho-brown focus:ring focus:ring-boho-brown/20 transition-shadow bg-boho-light/30 text-lg font-bold text-gray-800 placeholder-gray-400"
                                placeholder="Enter custom amount" required min="1">
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-gray-700 text-sm font-bold mb-4 uppercase tracking-wider">Payment
                            Method</label>
                        <div class="relative">
                            <select name="payment_method"
                                class="w-full appearance-none py-4 px-6 rounded-xl border-gray-300 focus:border-boho-brown focus:ring focus:ring-boho-brown/20 bg-white text-gray-700 font-medium cursor-pointer">
                                <option value="toyyibpay">ToyyibPay (FPX / Card)</option>
                                <option value="fpx">Online Banking (FPX)</option>
                                <option value="card">Credit / Debit Card</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <button
                        class="w-full bg-boho-orange hover:bg-orange-600 text-white font-bold py-4 px-6 rounded-xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl text-lg tracking-wide"
                        type="submit">
                        Donate Now
                    </button>

                    <p class="text-center text-xs text-gray-400 mt-6 flex items-center justify-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        Secure Payment Processing
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>