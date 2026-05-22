<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }
</style>

<div class="bg-cozy-bg min-h-screen relative overflow-hidden pb-24"
     x-data="{ amount: '', payment_method: 'fpx', cause: 'General Support' }">

    <!-- Decorative blobs -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-cozy-warm/40 blob opacity-50 translate-x-1/4 -translate-y-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cozy-accent/15 blob opacity-40 -translate-x-1/4 translate-y-1/4 pointer-events-none" style="animation-delay:-5s;"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 pt-28">

        <!-- Hero Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">

            <!-- Left Side -->
            <div class="space-y-8 pr-0 lg:pr-12">
                <span class="inline-block px-4 py-1.5 rounded-full bg-cozy-warm/60 text-cozy-brown text-sm font-bold tracking-widest uppercase font-sans">
                    GIVE WITH LOVE
                </span>
                <p class="font-script text-3xl text-cozy-accent">Make a Difference</p>
                <h1 class="font-serif font-bold text-5xl md:text-6xl lg:text-[5.5rem] text-cozy-brown tracking-tight leading-[1.05]">
                    Charity springs from a tender <span class="italic text-cozy-accent">Heart.</span>
                </h1>
                <div class="w-24 h-1 bg-cozy-accent/60 rounded-full"></div>
                <p class="font-sans text-cozy-brown/70 text-lg md:text-xl leading-relaxed">
                    Abu Hurairah Club (AHC) community links donors, volunteers, and compassionate individuals across the campus to save lives.
                </p>

            </div>

            <!-- Right Side: Donation Card -->
            <div class="relative z-10" id="donate-form">
                <div class="bg-cozy-card rounded-3xl shadow-2xl p-8 md:p-10 border border-cozy-warm/40">
                    <p class="font-script text-2xl text-cozy-accent mb-1">Support Us</p>
                    <h2 class="font-serif font-bold text-3xl text-cozy-brown mb-3">Donate now!</h2>
                    <div class="w-16 h-1 bg-cozy-accent/60 rounded-full mb-4"></div>
                    <p class="font-sans text-sm text-cozy-brown/60 mb-8">
                        By making a donation, you can contribute to our mission of establishing effective and long-lasting support systems.
                    </p>

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-6 flex items-center gap-2 font-sans">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6 flex items-center gap-2 font-sans">
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

                        <!-- Cause Display -->
                        <div class="mb-5 flex items-center justify-between bg-cozy-bg p-4 rounded-xl border border-cozy-warm/60">
                            <span class="font-sans text-xs font-bold text-cozy-brown/60 uppercase tracking-wider">Donating to:</span>
                            <span class="px-3 py-1 bg-cozy-brown text-cozy-light font-bold rounded-lg text-sm shadow-sm font-sans" x-text="cause"></span>
                        </div>

                        <!-- Amount Grid -->
                        <div class="grid grid-cols-3 gap-3 mb-6">
                            <button type="button" @click="amount = '10'"
                                :class="amount == '10' ? 'bg-cozy-warm border-cozy-brown text-cozy-brown shadow-inner' : 'bg-white border-cozy-warm/60 text-cozy-brown/70 hover:border-cozy-accent/60'"
                                class="py-3 px-2 rounded-xl border-2 font-bold transition-all text-sm font-sans">RM 10</button>
                            <button type="button" @click="amount = '25'"
                                :class="amount == '25' ? 'bg-cozy-warm border-cozy-brown text-cozy-brown shadow-inner' : 'bg-white border-cozy-warm/60 text-cozy-brown/70 hover:border-cozy-accent/60'"
                                class="py-3 px-2 rounded-xl border-2 font-bold transition-all text-sm font-sans">RM 25</button>
                            <button type="button" @click="amount = '50'"
                                :class="amount == '50' ? 'bg-cozy-warm border-cozy-brown text-cozy-brown shadow-inner' : 'bg-white border-cozy-warm/60 text-cozy-brown/70 hover:border-cozy-accent/60'"
                                class="py-3 px-2 rounded-xl border-2 font-bold transition-all text-sm font-sans">RM 50</button>
                            <button type="button" @click="amount = '75'"
                                :class="amount == '75' ? 'bg-cozy-warm border-cozy-brown text-cozy-brown shadow-inner' : 'bg-white border-cozy-warm/60 text-cozy-brown/70 hover:border-cozy-accent/60'"
                                class="py-3 px-2 rounded-xl border-2 font-bold transition-all text-sm font-sans">RM 75</button>
                            <button type="button" @click="amount = '100'"
                                :class="amount == '100' ? 'bg-cozy-warm border-cozy-brown text-cozy-brown shadow-inner' : 'bg-white border-cozy-warm/60 text-cozy-brown/70 hover:border-cozy-accent/60'"
                                class="py-3 px-2 rounded-xl border-2 font-bold transition-all text-sm font-sans">RM 100</button>
                            <button type="button" @click="amount = '150'"
                                :class="amount == '150' ? 'bg-cozy-warm border-cozy-brown text-cozy-brown shadow-inner' : 'bg-white border-cozy-warm/60 text-cozy-brown/70 hover:border-cozy-accent/60'"
                                class="py-3 px-2 rounded-xl border-2 font-bold transition-all text-sm font-sans">RM 150</button>
                        </div>

                        <!-- Custom Amount Input -->
                        <div class="mb-6">
                            <label class="block font-sans text-cozy-brown/60 text-xs font-bold mb-2 uppercase tracking-wider">Amount</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 font-sans text-cozy-brown/60 font-bold">RM</span>
                                <input type="number" name="amount" x-model="amount"
                                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-cozy-warm focus:border-cozy-brown focus:ring-0 transition-colors bg-white font-bold text-cozy-brown shadow-sm font-sans"
                                    placeholder="Enter custom amount" required min="1">
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-6">
                            <label class="block font-sans text-cozy-brown/60 text-xs font-bold mb-2 uppercase tracking-wider">Payment Method</label>
                            <select name="payment_method" x-model="payment_method"
                                class="w-full py-3.5 px-4 bg-white border border-cozy-warm text-cozy-brown font-bold rounded-xl focus:border-cozy-brown focus:ring-0 shadow-sm font-sans">
                                <option value="fpx">Online Banking (FPX)</option>
                                <option value="card">Credit / Debit Card</option>
                            </select>
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                            class="w-full bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold py-4 rounded-full shadow-xl transform transition hover:-translate-y-0.5 text-base tracking-wide font-sans">
                            Donate Now
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Stats Banner -->
        <div class="bg-cozy-brown rounded-3xl shadow-2xl p-10 md:p-14 mb-20">
            <div class="text-center mb-10">
                <p class="font-script text-3xl text-cozy-gold mb-1">Our Impact</p>
                <h2 class="font-serif font-bold text-4xl text-cozy-light">Your Generosity in Numbers</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <!-- Stat 1 -->
                <div class="flex flex-col items-center text-center gap-3">
                    <svg class="w-10 h-10 text-cozy-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <div>
                        <h3 class="font-serif font-bold text-3xl lg:text-4xl text-cozy-light">985+</h3>
                        <p class="font-sans text-cozy-warm/80 text-sm mt-1">Donations received</p>
                    </div>
                </div>
                <!-- Stat 2 -->
                <div class="flex flex-col items-center text-center gap-3">
                    <svg class="w-10 h-10 text-cozy-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <div>
                        <h3 class="font-serif font-bold text-3xl lg:text-4xl text-cozy-light">RM 100K</h3>
                        <p class="font-sans text-cozy-warm/80 text-sm mt-1">Money donated</p>
                    </div>
                </div>
                <!-- Stat 3 -->
                <div class="flex flex-col items-center text-center gap-3">
                    <svg class="w-10 h-10 text-cozy-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                    <div>
                        <h3 class="font-serif font-bold text-3xl lg:text-4xl text-cozy-light">12+</h3>
                        <p class="font-sans text-cozy-warm/80 text-sm mt-1">Active campaigns</p>
                    </div>
                </div>
                <!-- Stat 4 -->
                <div class="flex flex-col items-center text-center gap-3">
                    <svg class="w-10 h-10 text-cozy-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/>
                    </svg>
                    <div>
                        <h3 class="font-serif font-bold text-3xl lg:text-4xl text-cozy-light">450+</h3>
                        <p class="font-sans text-cozy-warm/80 text-sm mt-1">Cats saved last year</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission & Cause Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            <!-- Left Title -->
            <div class="lg:col-span-5 space-y-6 text-center lg:text-left">
                <p class="font-script text-3xl text-cozy-accent">Choose a Cause</p>
                <h2 class="font-serif font-bold text-4xl md:text-5xl text-cozy-brown leading-tight">
                    The mission &amp; goals of our organization
                </h2>
                <div class="w-24 h-1 bg-cozy-accent/60 rounded-full mx-auto lg:mx-0"></div>
                <p class="font-sans text-cozy-brown/70 leading-relaxed md:text-lg">
                    Select a cause from the cards to make a targeted donation or empower individuals and organizations to transform communities and the world through charity.
                </p>
            </div>

            <!-- Right Cause Cards -->
            <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6 p-4">

                <!-- Card 1: Medical care -->
                <div @click="cause = 'Medical care'; document.getElementById('donate-form').scrollIntoView({behavior: 'smooth'})"
                     class="cursor-pointer bg-cozy-card p-8 rounded-3xl group hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-cozy-warm/40 relative overflow-hidden">
                    <div class="w-16 h-16 mb-8 text-cozy-accent">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-2xl text-cozy-brown mb-3 group-hover:text-cozy-accent transition-colors">Medical care</h3>
                    <div class="font-sans text-cozy-brown font-bold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                        Donate to this
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>

                <!-- Card 2: Feline rescue -->
                <div @click="cause = 'Feline rescue'; document.getElementById('donate-form').scrollIntoView({behavior: 'smooth'})"
                     class="cursor-pointer bg-cozy-card p-8 rounded-3xl group hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-cozy-warm/40 relative overflow-hidden sm:mt-12">
                    <div class="w-16 h-16 mb-8 text-cozy-accent">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/>
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-2xl text-cozy-brown mb-3 group-hover:text-cozy-accent transition-colors">Feline rescue</h3>
                    <div class="font-sans text-cozy-brown font-bold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                        Donate to this
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>

                <!-- Card 3: Gift supplies -->
                <div @click="cause = 'Gift supplies'; document.getElementById('donate-form').scrollIntoView({behavior: 'smooth'})"
                     class="cursor-pointer bg-cozy-card p-8 rounded-3xl group hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-cozy-warm/40 relative overflow-hidden">
                    <div class="w-16 h-16 mb-8 text-cozy-accent">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-2xl text-cozy-brown mb-3 group-hover:text-cozy-accent transition-colors">Gift supplies</h3>
                    <div class="font-sans text-cozy-brown font-bold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                        Donate to this
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>

                <!-- Card 4: Public education -->
                <div @click="cause = 'Public education'; document.getElementById('donate-form').scrollIntoView({behavior: 'smooth'})"
                     class="cursor-pointer bg-cozy-card p-8 rounded-3xl group hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-cozy-warm/40 relative overflow-hidden sm:mt-12">
                    <div class="w-16 h-16 mb-8 text-cozy-accent">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-2xl text-cozy-brown mb-3 group-hover:text-cozy-accent transition-colors">Public education</h3>
                    <div class="font-sans text-cozy-brown font-bold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                        Donate to this
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
</x-app-layout>
