<x-app-layout>
    <div class="bg-boho-bg font-sans min-h-screen" x-data="{ amount: '', payment_method: 'fpx', cause: 'General Support' }">
        
        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Side -->
            <div class="space-y-8 pr-0 lg:pr-12">
                <h1 class="text-5xl md:text-6xl lg:text-[5.5rem] font-serif font-extrabold text-boho-brown tracking-tight leading-[1.05]">
                    Charity springs from a tender <span class="italic">Heart.</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 leading-relaxed font-medium">
                    Abu Hurairah Club (AHC) community links donors, volunteers, and compassionate individuals across the campus to save lives.
                </p>
                <div class="flex items-center gap-6 pt-4">
                    <button class="flex items-center gap-3 text-boho-brown font-bold hover:text-boho-orange transition-colors">
                        <div class="w-12 h-12 bg-boho-cream rounded-full flex items-center justify-center text-boho-orange shadow-sm hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                        Watch video
                    </button>
                </div>
            </div>

            <!-- Right Side (Donation Card) -->
            <div class="relative z-10" id="donate-form">
                <div class="bg-white rounded-[2rem] shadow-2xl p-8 md:p-10 border border-boho-light">
                    <h2 class="text-3xl font-serif font-bold text-boho-brown mb-3">Donate now!</h2>
                    <p class="text-sm text-gray-500 mb-8 font-medium">
                        By making a donation, you can contribute to our mission of establishing effective and long-lasting support systems.
                    </p>

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('donations.store') }}">
                        @csrf
                        
                        <input type="hidden" name="cause" x-model="cause">

                        <div class="mb-5 flex items-center justify-between bg-boho-bg p-4 rounded-xl border border-boho-light">
                            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Donating to:</span>
                            <span class="px-3 py-1 bg-boho-brown text-white font-bold rounded-lg text-sm shadow-sm" x-text="cause"></span>
                        </div>

                        <!-- Amount Grid -->
                        <div class="grid grid-cols-3 gap-3 mb-6">
                            <button type="button" @click="amount = '10'"
                                :class="amount == '10' ? 'bg-boho-bg border-boho-brown text-boho-brown shadow-inner' : 'bg-white border-gray-200 text-gray-600 hover:border-boho-brown/50'"
                                class="py-3 px-2 rounded-xl border-2 font-bold transition-all text-sm">RM 10</button>
                            <button type="button" @click="amount = '25'"
                                :class="amount == '25' ? 'bg-boho-bg border-boho-brown text-boho-brown shadow-inner' : 'bg-white border-gray-200 text-gray-600 hover:border-boho-brown/50'"
                                class="py-3 px-2 rounded-xl border-2 font-bold transition-all text-sm">RM 25</button>
                            <button type="button" @click="amount = '50'"
                                :class="amount == '50' ? 'bg-boho-bg border-boho-brown text-boho-brown shadow-inner' : 'bg-white border-gray-200 text-gray-600 hover:border-boho-brown/50'"
                                class="py-3 px-2 rounded-xl border-2 font-bold transition-all text-sm">RM 50</button>
                            <button type="button" @click="amount = '75'"
                                :class="amount == '75' ? 'bg-boho-bg border-boho-brown text-boho-brown shadow-inner' : 'bg-white border-gray-200 text-gray-600 hover:border-boho-brown/50'"
                                class="py-3 px-2 rounded-xl border-2 font-bold transition-all text-sm">RM 75</button>
                            <button type="button" @click="amount = '100'"
                                :class="amount == '100' ? 'bg-boho-bg border-boho-brown text-boho-brown shadow-inner' : 'bg-white border-gray-200 text-gray-600 hover:border-boho-brown/50'"
                                class="py-3 px-2 rounded-xl border-2 font-bold transition-all text-sm">RM 100</button>
                            <button type="button" @click="amount = '150'"
                                :class="amount == '150' ? 'bg-boho-bg border-boho-brown text-boho-brown shadow-inner' : 'bg-white border-gray-200 text-gray-600 hover:border-boho-brown/50'"
                                class="py-3 px-2 rounded-xl border-2 font-bold transition-all text-sm">RM 150</button>
                        </div>
                        
                        <!-- Custom Amount Input -->
                        <div class="mb-6">
                            <label class="block text-gray-500 text-xs font-bold mb-2 uppercase tracking-wider">Amount</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 font-bold">RM</span>
                                <input type="number" name="amount" x-model="amount"
                                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-300 focus:border-boho-brown focus:ring-0 transition-colors bg-white font-bold text-gray-800 shadow-sm"
                                    placeholder="Enter custom amount" required min="1">
                            </div>
                        </div>

                        <!-- Payment Method Selection -->
                        <div class="mb-6">
                             <label class="block text-gray-500 text-xs font-bold mb-2 uppercase tracking-wider">Payment Method</label>
                             <select name="payment_method" x-model="payment_method" class="w-full py-3.5 px-4 bg-white border border-gray-300 text-gray-800 font-bold rounded-xl focus:border-boho-brown focus:ring-0 shadow-sm">
                                 <option value="fpx">Online Banking (FPX)</option>
                                 <option value="card">Credit / Debit Card</option>
                             </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-boho-brown hover:bg-boho-orange text-white font-bold py-4 rounded-full shadow-xl transform transition hover:-translate-y-0.5 text-base tracking-wide">
                            Donate Now
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Middle Banner Stats -->
        <div class="bg-boho-brown relative lg:-mt-[150px] lg:pt-[190px] pt-16 pb-12 shadow-inner z-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4 text-white">
                    <div class="flex flex-col md:flex-row items-center md:items-start justify-center gap-4 text-center md:text-left">
                        <svg class="w-10 h-10 text-boho-orange flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        <div>
                            <h3 class="text-3xl lg:text-4xl font-serif font-bold">985+</h3>
                            <p class="text-boho-cream text-sm font-medium mt-1">Donation received</p>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row items-center md:items-start justify-center gap-4 text-center md:text-left">
                        <svg class="w-10 h-10 text-boho-orange flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <div>
                            <h3 class="text-3xl lg:text-4xl font-serif font-bold">RM 100K</h3>
                            <p class="text-boho-cream text-sm font-medium mt-1">Money donated</p>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row items-center md:items-start justify-center gap-4 text-center md:text-left">
                        <svg class="w-10 h-10 text-boho-orange flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                        <div>
                            <h3 class="text-3xl lg:text-4xl font-serif font-bold">12+</h3>
                            <p class="text-boho-cream text-sm font-medium mt-1">Active campaigns</p>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row items-center md:items-start justify-center gap-4 text-center md:text-left">
                        <svg class="w-10 h-10 text-boho-orange flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                        <div>
                            <h3 class="text-3xl lg:text-4xl font-serif font-bold">450+</h3>
                            <p class="text-boho-cream text-sm font-medium mt-1">Cats saved in last year</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section: Mission & Goals Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- Left Title Content -->
                <div class="lg:col-span-5 space-y-6 text-center lg:text-left">
                    <h2 class="text-4xl md:text-5xl font-serif font-extrabold text-boho-brown leading-tight">
                        The mission & goals of our organization
                    </h2>
                    <p class="text-gray-600 leading-relaxed md:text-lg">
                        Select a cause from the cards to make a targeted donation or empower individuals and organizations to transform communities and the world through charity.
                    </p>
                </div>

                <!-- Right Square Grid Cards -->
                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6 p-4">
                    
                    <!-- Card 1 -->
                    <div @click="cause = 'Medical care'; document.getElementById('donate-form').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer bg-[#F0EBE1] p-8 rounded-3xl group hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
                        <div class="w-16 h-16 mb-8 text-boho-orange">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                        </div>
                        <h3 class="text-2xl font-serif font-bold text-boho-brown mb-3 group-hover:text-boho-orange transition-colors">Medical care</h3>
                        <div class="text-boho-brown font-bold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                            Donate to this <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div @click="cause = 'Feline rescue'; document.getElementById('donate-form').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer bg-[#F0EBE1] p-8 rounded-3xl group hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 sm:mt-12 relative overflow-hidden">
                        <div class="w-16 h-16 mb-8 text-boho-orange">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" /></svg>
                        </div>
                        <h3 class="text-2xl font-serif font-bold text-boho-brown mb-3 group-hover:text-boho-orange transition-colors">Feline rescue</h3>
                        <div class="text-boho-brown font-bold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                            Donate to this <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                    
                    <!-- Card 3 -->
                    <div @click="cause = 'Gift supplies'; document.getElementById('donate-form').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer bg-[#F0EBE1] p-8 rounded-3xl group hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
                        <div class="w-16 h-16 mb-8 text-boho-orange">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                        </div>
                        <h3 class="text-2xl font-serif font-bold text-boho-brown mb-3 group-hover:text-boho-orange transition-colors">Gift supplies</h3>
                        <div class="text-boho-brown font-bold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                            Donate to this <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                    
                    <!-- Card 4 -->
                    <div @click="cause = 'Public education'; document.getElementById('donate-form').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer bg-[#F0EBE1] p-8 rounded-3xl group hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 sm:mt-12 relative overflow-hidden">
                        <div class="w-16 h-16 mb-8 text-boho-orange">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" /></svg>
                        </div>
                        <h3 class="text-2xl font-serif font-bold text-boho-brown mb-3 group-hover:text-boho-orange transition-colors">Public education</h3>
                        <div class="text-boho-brown font-bold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                            Donate to this <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</x-app-layout>