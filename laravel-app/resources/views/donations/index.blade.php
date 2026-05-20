<x-app-layout>
<style>
<<<<<<< HEAD
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }
</style>

<div class="bg-cozy-bg min-h-screen">

    <!-- Cozy Hero -->
    <div class="relative pt-28 pb-16 overflow-hidden">
        <div class="absolute top-0 right-0 w-72 h-72 bg-cozy-warm/50 blob opacity-50 translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 bg-cozy-accent/20 blob opacity-40 -translate-x-1/3 translate-y-1/3 pointer-events-none" style="animation-delay:-3s;"></div>
        <div class="relative z-10 text-center px-4">
            <p class="font-script text-3xl text-cozy-accent mb-2">Make a Difference</p>
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-cozy-brown mb-4">Support Our Cause</h1>
            <div class="w-20 h-1 bg-cozy-accent/60 mx-auto rounded-full mb-4"></div>
            <p class="text-cozy-brown/60 max-w-xl mx-auto text-lg">
                Your contribution helps us rescue, treat, and find homes for stray cats. Every ringgit counts.
            </p>
=======
    @keyframes slowFloat {
        0%,100% { transform: translateY(0) rotate(0deg); }
        50%      { transform: translateY(-15px) rotate(2deg); }
    }
    .float-anim { animation: slowFloat 8s ease-in-out infinite; }
</style>

    <div class="pt-24 pb-12 bg-cozy-bg min-h-screen relative overflow-hidden">
        
        <!-- Decorative Backgrounds -->
        <div class="absolute top-[5%] left-[-10%] w-[60%] h-[60%] bg-[#F5DEB3] opacity-60 rounded-[60%_40%_30%_70%/60%_30%_70%_40%] blur-3xl pointer-events-none float-anim"></div>
        <div class="absolute bottom-[-5%] right-[-10%] w-[50%] h-[50%] bg-[#FFF4E3] opacity-50 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] blur-3xl pointer-events-none float-anim" style="animation-delay: -4s;"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="font-script font-bold text-6xl text-cozy-brown mb-4">
                    {{ __('Support Our Cause') }}
                </h2>
                <div class="w-32 h-1.5 bg-cozy-brown/20 mx-auto rounded-full"></div>
                <p class="mt-6 text-cozy-brown/80 font-medium text-lg max-w-2xl mx-auto">
                    Your contribution helps us rescue, treat, and find homes for stray cats. Every cup of coffee's worth counts.
                </p>
            </div>

            <!-- Impact Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Card 1 -->
                <div class="bg-cozy-card p-8 rounded-[2.5rem] shadow-lg border border-cozy-brown/10 text-center transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group">
                    <div class="w-20 h-20 bg-[#F5DEB3] rounded-full flex items-center justify-center mx-auto mb-6 text-cozy-brown group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-script text-4xl font-bold text-cozy-brown mb-3">RM 10</h4>
                    <p class="text-sm font-medium text-cozy-brown/70 leading-relaxed">Provides cozy food for one cat for a week.</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-cozy-card p-8 rounded-[2.5rem] shadow-lg border border-cozy-brown/10 text-center transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl md:-translate-y-4 group">
                    <div class="w-20 h-20 bg-[#F5DEB3] rounded-full flex items-center justify-center mx-auto mb-6 text-cozy-brown group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h4 class="font-script text-4xl font-bold text-cozy-brown mb-3">RM 50</h4>
                    <p class="text-sm font-medium text-cozy-brown/70 leading-relaxed">Covers essential vaccinations and medical checks.</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-cozy-card p-8 rounded-[2.5rem] shadow-lg border border-cozy-brown/10 text-center transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group">
                    <div class="w-20 h-20 bg-[#F5DEB3] rounded-full flex items-center justify-center mx-auto mb-6 text-cozy-brown group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <h4 class="font-script text-4xl font-bold text-cozy-brown mb-3">RM 100+</h4>
                    <p class="text-sm font-medium text-cozy-brown/70 leading-relaxed">Helps with shelter maintenance and rescues.</p>
                </div>
            </div>

            <div class="bg-cozy-card overflow-hidden shadow-2xl rounded-[3rem] p-8 md:p-12 border border-cozy-brown/10 relative">
                <!-- Abstract corner blob inside form -->
                <div class="absolute top-0 left-0 w-48 h-48 bg-[#F5DEB3] rounded-full blur-3xl opacity-40 -ml-10 -mt-10 pointer-events-none"></div>

                @if(session('success'))
                    <div class="bg-[#F5DEB3] border border-cozy-brown/20 text-cozy-brown font-bold px-6 py-4 rounded-2xl relative mb-8 flex items-center gap-3 shadow-sm">
                        <svg class="w-6 h-6 text-cozy-brown" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('donations.store') }}" class="max-w-2xl mx-auto relative z-10" x-data="{ amount: '' }">
                    @csrf

                    <div class="mb-10">
                        <label class="block text-cozy-brown font-bold mb-5 uppercase tracking-wider text-sm">Choose Amount (MYR)</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <button type="button" @click="amount = '10'"
                                :class="amount == '10' ? 'bg-cozy-brown text-cozy-card shadow-md scale-105 border-transparent' : 'bg-transparent text-cozy-brown border-cozy-brown/20 hover:border-cozy-brown/50 hover:bg-cozy-bg'"
                                class="py-4 px-4 rounded-[1.5rem] border-2 font-bold transition-all text-lg">RM 10</button>
                            <button type="button" @click="amount = '30'"
                                :class="amount == '30' ? 'bg-cozy-brown text-cozy-card shadow-md scale-105 border-transparent' : 'bg-transparent text-cozy-brown border-cozy-brown/20 hover:border-cozy-brown/50 hover:bg-cozy-bg'"
                                class="py-4 px-4 rounded-[1.5rem] border-2 font-bold transition-all text-lg">RM 30</button>
                            <button type="button" @click="amount = '50'"
                                :class="amount == '50' ? 'bg-cozy-brown text-cozy-card shadow-md scale-105 border-transparent' : 'bg-transparent text-cozy-brown border-cozy-brown/20 hover:border-cozy-brown/50 hover:bg-cozy-bg'"
                                class="py-4 px-4 rounded-[1.5rem] border-2 font-bold transition-all text-lg">RM 50</button>
                            <button type="button" @click="amount = '100'"
                                :class="amount == '100' ? 'bg-cozy-brown text-cozy-card shadow-md scale-105 border-transparent' : 'bg-transparent text-cozy-brown border-cozy-brown/20 hover:border-cozy-brown/50 hover:bg-cozy-bg'"
                                class="py-4 px-4 rounded-[1.5rem] border-2 font-bold transition-all text-lg">RM 100</button>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-6 text-cozy-brown/60 font-bold text-lg">RM</span>
                            <input type="number" name="amount" x-model="amount"
                                class="w-full pl-16 pr-6 py-5 rounded-[1.5rem] border-cozy-brown/20 focus:border-cozy-brown focus:ring focus:ring-cozy-brown/20 transition-all bg-cozy-bg/50 text-2xl font-bold text-cozy-brown placeholder-cozy-brown/30"
                                placeholder="Enter custom amount" required min="1">
                        </div>
                    </div>

                    <div class="mb-10">
                        <label class="block text-cozy-brown font-bold mb-5 uppercase tracking-wider text-sm">Payment Method</label>
                        <div class="relative">
                            <select name="payment_method"
                                class="w-full appearance-none py-5 px-6 rounded-[1.5rem] border-cozy-brown/20 focus:border-cozy-brown focus:ring focus:ring-cozy-brown/20 bg-cozy-bg/50 text-cozy-brown font-bold text-lg cursor-pointer transition-all">
                                <option value="fpx">Online Banking (FPX)</option>
                                <option value="card">Credit / Debit Card</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-6 text-cozy-brown/60">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <button class="w-full bg-cozy-brown hover:bg-[#573D2B] text-cozy-card font-bold py-5 px-8 rounded-[1.5rem] shadow-lg transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl text-xl tracking-wide" type="submit">
                        Donate Now
                    </button>

                    <p class="text-center text-sm font-bold text-cozy-brown/50 mt-8 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Secure Payment Processing
                    </p>
                </form>
            </div>
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">

        <!-- Impact Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-cozy-card p-6 rounded-2xl shadow-sm border border-cozy-warm/40 text-center transform transition hover:-translate-y-1 hover:shadow-md">
                <div class="w-16 h-16 bg-cozy-warm/40 rounded-full flex items-center justify-center mx-auto mb-4 text-cozy-brown">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h4 class="font-bold text-lg text-cozy-brown mb-2">RM 10</h4>
                <p class="text-sm text-cozy-brown/50">Provides food for one cat for a week.</p>
            </div>
            <div class="bg-cozy-card p-6 rounded-2xl shadow-sm border border-cozy-warm/40 text-center transform transition hover:-translate-y-1 hover:shadow-md">
                <div class="w-16 h-16 bg-cozy-warm/40 rounded-full flex items-center justify-center mx-auto mb-4 text-cozy-brown">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                </div>
                <h4 class="font-bold text-lg text-cozy-brown mb-2">RM 50</h4>
                <p class="text-sm text-cozy-brown/50">Covers essential vaccinations and medical checks.</p>
            </div>
            <div class="bg-cozy-card p-6 rounded-2xl shadow-sm border border-cozy-warm/40 text-center transform transition hover:-translate-y-1 hover:shadow-md">
                <div class="w-16 h-16 bg-cozy-warm/40 rounded-full flex items-center justify-center mx-auto mb-4 text-cozy-brown">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
                <h4 class="font-bold text-lg text-cozy-brown mb-2">RM 100+</h4>
                <p class="text-sm text-cozy-brown/50">Helps with shelter maintenance and emergency rescues.</p>
            </div>
        </div>

        <!-- Donation Form -->
        <div class="bg-cozy-card overflow-hidden shadow-xl rounded-3xl p-8 border border-cozy-warm/40">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('donations.store') }}" class="max-w-xl mx-auto" x-data="{ amount: '' }">
                @csrf

                <div class="mb-8">
                    <label class="block text-cozy-brown text-sm font-bold mb-4 uppercase tracking-wider">Choose Amount (MYR)</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                        <button type="button" @click="amount = '10'"
                            :class="amount == '10' ? 'bg-cozy-brown text-cozy-light border-cozy-brown' : 'bg-cozy-bg text-cozy-brown border-cozy-warm hover:border-cozy-brown'"
                            class="py-3 px-4 rounded-xl border-2 font-bold transition-all">RM 10</button>
                        <button type="button" @click="amount = '30'"
                            :class="amount == '30' ? 'bg-cozy-brown text-cozy-light border-cozy-brown' : 'bg-cozy-bg text-cozy-brown border-cozy-warm hover:border-cozy-brown'"
                            class="py-3 px-4 rounded-xl border-2 font-bold transition-all">RM 30</button>
                        <button type="button" @click="amount = '50'"
                            :class="amount == '50' ? 'bg-cozy-brown text-cozy-light border-cozy-brown' : 'bg-cozy-bg text-cozy-brown border-cozy-warm hover:border-cozy-brown'"
                            class="py-3 px-4 rounded-xl border-2 font-bold transition-all">RM 50</button>
                        <button type="button" @click="amount = '100'"
                            :class="amount == '100' ? 'bg-cozy-brown text-cozy-light border-cozy-brown' : 'bg-cozy-bg text-cozy-brown border-cozy-warm hover:border-cozy-brown'"
                            class="py-3 px-4 rounded-xl border-2 font-bold transition-all">RM 100</button>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-cozy-brown/50 font-bold">RM</span>
                        <input type="number" name="amount" x-model="amount"
                            class="w-full pl-12 pr-4 py-4 rounded-xl border-cozy-warm focus:border-cozy-brown focus:ring focus:ring-cozy-brown/20 transition-shadow bg-cozy-bg text-lg font-bold text-cozy-brown placeholder-cozy-brown/30"
                            placeholder="Enter custom amount" required min="1">
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-cozy-brown text-sm font-bold mb-4 uppercase tracking-wider">Payment Method</label>
                    <div class="relative">
                        <select name="payment_method"
                            class="w-full appearance-none py-4 px-6 rounded-xl border-cozy-warm focus:border-cozy-brown focus:ring focus:ring-cozy-brown/20 bg-cozy-bg text-cozy-brown font-medium cursor-pointer">
                            <option value="fpx">Online Banking (FPX)</option>
                            <option value="card">Credit / Debit Card</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-cozy-brown/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                <button class="w-full bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold py-4 px-6 rounded-xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl text-lg tracking-wide" type="submit">
                    Donate Now
                </button>

                <p class="text-center text-xs text-cozy-brown/40 mt-6 flex items-center justify-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Secure Payment Processing
                </p>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
