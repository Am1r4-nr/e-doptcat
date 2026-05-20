@php
    $user = auth()->user();
    $adoptions = $user->adoptions()->with('cat')->latest()->get();
    $donations = $user->donations()->latest()->get();
    $reports = $user->reports()->latest()->get();
    $registrations = $user->eventRegistrations()->with('event')->latest()->get();

    // Total metrics
    $totalAdoptions = $adoptions->count();
    $totalDonationsAmount = $donations->sum('amount');
    $totalReports = $reports->count();

    // Featured cat of the day
    $featuredCat = \App\Models\Cat::where('status', 'Available')->inRandomOrder()->first();
@endphp

<x-app-layout>
<style>
    @keyframes floatSlow {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-12px) rotate(3deg); }
    }
    @keyframes floatSlowReverse {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-8px) rotate(-3deg); }
    }
    @keyframes blobPulse {
        0%, 100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .animate-float-slow { animation: floatSlow 8s ease-in-out infinite; }
    .animate-float-reverse { animation: floatSlowReverse 9s ease-in-out infinite; }
    .blob-organic { animation: blobPulse 12s ease-in-out infinite; }
</style>

<div class="bg-cozy-bg min-h-screen pt-28 pb-20 relative overflow-hidden">
    <!-- Decorative Floating Blobs (LATTE/CREAM/CARAMEL background elements) -->
    <div class="absolute top-[-10%] left-[-10%] w-[45%] h-[45%] bg-cozy-warm/30 blob-organic opacity-50 pointer-events-none"></div>
    <div class="absolute bottom-[-15%] right-[-10%] w-[40%] h-[40%] bg-cozy-accent/15 blob-organic opacity-40 pointer-events-none" style="animation-delay: -6s;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- ── ADMIN BANNER REDESIGNED ── -->
        @if($user->role === 'admin')
        <div class="mb-8 bg-cozy-brown text-cozy-light rounded-3xl p-6 shadow-xl border border-cozy-accent/40 relative overflow-hidden transition-all hover:shadow-2xl">
            <div class="absolute right-0 top-0 w-32 h-32 bg-cozy-accent/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6 relative z-10">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-2xl bg-cozy-accent/20 flex items-center justify-center text-cozy-accent text-2xl shadow-inner">
                        🔑
                    </div>
                    <div>
                        <h3 class="text-xl font-serif font-bold text-white tracking-wide">Administrator Portal Access</h3>
                        <p class="text-cozy-warm/80 text-sm mt-0.5">Manage campus cats, review adoption applications, process donations, and track incidents.</p>
                    </div>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="bg-cozy-accent hover:bg-cozy-gold text-cozy-brown font-bold px-6 py-3 rounded-2xl shadow-lg transition-all hover:-translate-y-0.5 text-sm shrink-0">
                    Go to Admin Dashboard →
                </a>
            </div>
        </div>
        @endif

        <!-- ── HERO HERO HERO ── -->
        <div class="relative bg-cozy-card rounded-[3rem] p-8 lg:p-12 shadow-xl border border-cozy-warm/30 mb-12 flex flex-col lg:flex-row items-center gap-10">
            <!-- Left Side: Title & Greeting -->
            <div class="flex-1 space-y-6 relative">
                <!-- Floating decorative butterfly -->
                <div class="absolute top-[-35px] left-[10px] animate-float-slow opacity-60">
                    <svg class="w-10 h-10 text-cozy-accent" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2v20" />
                        <path d="M12 4.8C10.5 2 3 2 3 9.5c0 3.5 4.5 6 9 8.5" fill="currentColor" fill-opacity="0.15" />
                        <path d="M12 4.8C13.5 2 21 2 21 9.5c0 3.5-4.5 6-9 8.5" fill="currentColor" fill-opacity="0.15" />
                        <path d="M12 11.5c-2.5-1.5-6.5-1.5-6.5 2 0 2 3.5 3 6.5 4.5" fill="currentColor" fill-opacity="0.1" />
                        <path d="M12 11.5c2.5-1.5 6.5-1.5 6.5 2 0 2-3.5 3-6.5 4.5" fill="currentColor" fill-opacity="0.1" />
                    </svg>
                </div>

                <p class="font-script text-3xl md:text-4xl text-cozy-accent mb-1 leading-none">Abu Hurairah Club</p>
                <h1 class="font-serif font-bold text-5xl md:text-7xl text-cozy-brown leading-[1.05] tracking-tight">
                    {{ explode(' ', $user->name)[0] }}'s<br>
                    <span class="font-script text-cozy-accent lowercase">cozy</span> Space
                </h1>
                <p class="text-cozy-brown/65 text-lg font-light leading-relaxed max-w-lg">
                    Welcome to your personal e-Doptcat space. Here, you can track the campus strays you are helping, monitor adoption applications, manage donations, and view recent events. Thank you for making a difference!
                </p>

                <!-- Pinterest-style quick list of campus impact -->
                <div class="border-t border-cozy-warm/40 pt-6 mt-4">
                    <p class="text-xs uppercase tracking-widest font-bold text-cozy-accent mb-3">Campus Cat Safeguards</p>
                    <ul class="grid grid-cols-2 gap-4 text-cozy-brown/70 font-semibold text-sm">
                        <li class="flex items-center gap-2">
                            <span class="text-cozy-accent">🐾</span> {{ $totalAdoptions }} Active Adoptions
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-cozy-accent">🏠</span> {{ $registrations->count() }} Registered Events
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-cozy-accent">💛</span> RM {{ number_format($totalDonationsAmount, 2) }} Donated
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-cozy-accent">🚨</span> {{ $totalReports }} Incident Reports
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Side: Beautiful Organic Fluid Framed Cafe/Cat Scene -->
            <div class="lg:w-[48%] relative flex justify-center lg:justify-end shrink-0 w-full">
                <!-- Golden ring background -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[95%] h-[95%] border-[3px] border-cozy-accent/30 rounded-[3rem] pointer-events-none" style="transform: translate(-46%, -46%) rotate(-3deg);"></div>

                <!-- Organic Shaped Hero Banner Image (Enclosed in a blob) -->
                <div class="relative w-full max-w-md h-[340px] md:h-[380px] overflow-hidden shadow-2xl border-[6px] border-white z-10 transition-all hover:scale-[1.02] duration-500"
                     style="border-radius: 40% 60% 50% 50% / 50% 40% 60% 50%;">
                    <img src="https://images.unsplash.com/photo-1544787219-7f47ccb76574?auto=format&fit=crop&w=800&q=80"
                         alt="Cozy Cat Cafe Scene" class="w-full h-full object-cover">
                    <!-- Overlay shadow/gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-cozy-brown/40 via-transparent to-transparent"></div>

                    <!-- Small float badge on image -->
                    <div class="absolute bottom-5 left-5 bg-cozy-card/95 backdrop-blur-md rounded-2xl px-4 py-3 shadow-lg border border-cozy-warm/50 flex items-center gap-3">
                        <span class="text-2xl animate-bounce">🐱</span>
                        <div>
                            <p class="text-[9px] font-bold text-cozy-brown/50 uppercase tracking-widest leading-none">Caring Campus</p>
                            <p class="font-bold text-cozy-brown text-xs mt-0.5">Abu Hurairah Club</p>
                        </div>
                    </div>
                </div>
                <!-- Scattered micro flower/accent -->
                <div class="absolute bottom-[-15px] left-[20px] animate-float-reverse opacity-80">
                    <svg class="w-8 h-8 text-cozy-accent" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="3" fill="currentColor" fill-opacity="0.2"/>
                        <path d="M12 9c0-2 2-3 2-3s0 3-2 3z"/>
                        <path d="M12 15c0 2-2 3-2 3s0-3 2-3z"/>
                        <path d="M15 12c2 0 3-2 3-2s-3 0-3 2z"/>
                        <path d="M9 12c-2 0-3 2-3 2s3 0 3-2z"/>
                        <path d="M14.1 9.9c1.4-1.4 2.8-1.4 2.8-1.4s-1.4 1.4-2.8 2.8z"/>
                        <path d="M9.9 14.1c-1.4 1.4-2.8 1.4-2.8 1.4s1.4-1.4 2.8-2.8z"/>
                        <path d="M14.1 14.1c1.4 1.4 1.4 2.8 1.4 2.8s-1.4-1.4-2.8-2.8z"/>
                        <path d="M9.9 9.9c-1.4-1.4-1.4-2.8-1.4-2.8s1.4 1.4 2.8 2.8z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- ── ASYMMETRICAL PINTEREST-STYLE GRID ── -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- LEFT COLUMN (Span 5): Small, organic aesthetic cards -->
            <div class="lg:col-span-5 space-y-8">

                <!-- 1. Stats and Quick Links Card -->
                <div class="bg-cozy-card rounded-[2.5rem] p-6 shadow-lg border border-cozy-warm/40 relative">
                    <p class="font-script text-2xl text-cozy-accent mb-4">Quick actions</p>
                    <div class="grid grid-cols-2 gap-4">
                        <a id="quick-link-browse-cats" href="{{ route('cats.index') }}" class="group bg-cozy-light hover:bg-cozy-brown hover:text-cozy-light p-4 rounded-2xl border border-cozy-warm/30 shadow-sm transition-all duration-300 flex flex-col items-center text-center gap-2">
                            <span class="text-3xl group-hover:scale-110 transition-transform">🐾</span>
                            <span class="font-serif font-bold text-sm text-cozy-brown group-hover:text-cozy-light">Browse Cats</span>
                        </a>
                        <a id="quick-link-make-donation" href="{{ route('donations.index') }}" class="group bg-cozy-light hover:bg-cozy-brown hover:text-cozy-light p-4 rounded-2xl border border-cozy-warm/30 shadow-sm transition-all duration-300 flex flex-col items-center text-center gap-2">
                            <span class="text-3xl group-hover:scale-110 transition-transform">💛</span>
                            <span class="font-serif font-bold text-sm text-cozy-brown group-hover:text-cozy-light">Make Donation</span>
                        </a>
                        <a id="quick-link-report-stray" href="{{ route('reports.create') }}" class="group bg-cozy-light hover:bg-cozy-brown hover:text-cozy-light p-4 rounded-2xl border border-cozy-warm/30 shadow-sm transition-all duration-300 flex flex-col items-center text-center gap-2">
                            <span class="text-3xl group-hover:scale-110 transition-transform">🚨</span>
                            <span class="font-serif font-bold text-sm text-cozy-brown group-hover:text-cozy-light">Report Stray</span>
                        </a>
                        <a id="quick-link-cat-tracker" href="{{ route('tracker') }}" class="group bg-cozy-light hover:bg-cozy-brown hover:text-cozy-light p-4 rounded-2xl border border-cozy-warm/30 shadow-sm transition-all duration-300 flex flex-col items-center text-center gap-2">
                            <span class="text-3xl group-hover:scale-110 transition-transform">📍</span>
                            <span class="font-serif font-bold text-sm text-cozy-brown group-hover:text-cozy-light">Cat Tracker</span>
                        </a>
                    </div>
                </div>

                <!-- 2. Adoption Request List Card (Styled exactly like the cream menu in the Pinterest image) -->
                <div class="bg-cozy-card rounded-[2.5rem] p-6 shadow-lg border border-cozy-warm/40 relative overflow-hidden">
                    <div class="absolute right-[-20px] top-[-20px] text-cozy-warm/25 font-bold text-8xl font-serif pointer-events-none select-none">Adopt</div>

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="font-script text-2xl text-cozy-accent">My Requests</p>
                            <h3 class="font-serif font-bold text-xl text-cozy-brown">Adoption Forms</h3>
                        </div>
                        <span class="text-sm bg-cozy-warm/40 text-cozy-brown font-bold px-3 py-1 rounded-full">{{ $totalAdoptions }} total</span>
                    </div>

                    @if($adoptions->count() > 0)
                        <div class="space-y-4">
                            @foreach($adoptions as $adoption)
                            <div class="bg-cozy-light/65 hover:bg-cozy-light p-4 rounded-2xl border border-cozy-warm/30 shadow-sm transition-all flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <!-- Cat Image inside a custom Pinterest organic blob -->
                                    <div class="h-12 w-12 overflow-hidden shadow-inner border border-cozy-accent/30 flex-shrink-0"
                                         style="border-radius: 60% 40% 50% 50% / 50% 30% 70% 50%;">
                                        <img src="{{ $adoption->cat->image }}" alt="{{ $adoption->cat->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="font-serif font-bold text-sm text-cozy-brown">{{ $adoption->cat->name }}</h4>
                                        <p class="text-[10px] font-bold text-cozy-accent uppercase tracking-wider mt-0.5">Stage: {{ $adoption->pipeline_stage ?? 'New' }}</p>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div>
                                    @if($adoption->status === 'Approved')
                                        <span class="bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full border border-green-200">Approved</span>
                                    @elseif($adoption->status === 'Pending')
                                        <span class="bg-amber-100 text-amber-700 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full border border-amber-200">Pending</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-600 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full border border-gray-200">{{ $adoption->status }}</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Zero state empty illustration -->
                        <div class="text-center py-8 bg-cozy-light/40 rounded-3xl border border-dashed border-cozy-warm">
                            <span class="text-4xl block mb-2">🍃</span>
                            <p class="text-sm font-semibold text-cozy-brown/65">No adoption applications yet.</p>
                            <a id="adoption-zero-state-find-cat" href="{{ route('cats.index') }}" class="text-cozy-accent hover:text-cozy-brown font-bold text-xs uppercase tracking-wider mt-2 inline-block">Find a companion →</a>
                        </div>
                    @endif
                </div>

                <!-- 3. Heartwarming Donation Card -->
                <div class="bg-cozy-card rounded-[2.5rem] p-6 shadow-lg border border-cozy-warm/40 relative overflow-hidden">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="h-12 w-12 rounded-2xl bg-cozy-warm/50 flex items-center justify-center text-cozy-brown text-2xl shadow-inner">
                            💝
                        </div>
                        <div>
                            <p class="font-script text-2xl text-cozy-accent leading-none">Heartfelt Support</p>
                            <h3 class="font-serif font-bold text-lg text-cozy-brown mt-0.5">My Donations</h3>
                        </div>
                    </div>

                    <div class="bg-cozy-light/50 p-4 rounded-2xl border border-cozy-warm/30 shadow-inner mb-5 flex justify-between items-center">
                        <div>
                            <p class="text-[10px] font-bold text-cozy-brown/50 uppercase tracking-widest">Total Contributed</p>
                            <p class="text-2xl font-serif font-extrabold text-cozy-brown mt-0.5">RM {{ number_format($totalDonationsAmount, 2) }}</p>
                        </div>
                        <span class="text-xs font-script text-cozy-accent text-lg">Thank you so much!</span>
                    </div>

                    @if($donations->count() > 0)
                        <div class="space-y-3 max-h-48 overflow-y-auto pr-1">
                            @foreach($donations->take(3) as $donation)
                            <div class="flex justify-between items-center text-xs py-2 border-b border-cozy-warm/30 text-cozy-brown/85">
                                <span class="font-semibold">{{ $donation->created_at->format('M d, Y') }}</span>
                                <span class="font-bold">RM {{ number_format($donation->amount, 2) }}</span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-cozy-brown/50 italic text-center py-2">No donations recorded under this account.</p>
                    @endif

                    <a id="quick-donate-button" href="{{ route('donations.index') }}" class="w-full mt-5 inline-flex justify-center items-center gap-2 py-3 bg-cozy-brown hover:bg-cozy-accent text-cozy-light hover:text-cozy-brown font-bold rounded-2xl shadow-md transition-colors text-xs uppercase tracking-wider">
                        Contribute RM 5.00
                    </a>
                </div>

            </div>

            <!-- RIGHT COLUMN (Span 7): Large aesthetic cards mirroring the Tuvkel Cozy Cafe card -->
            <div class="lg:col-span-7 space-y-8">

                <!-- 1. Featured Cat Card (RECREATING THE PINTEREST MAIN IMAGE & TITLE CARD) -->
                @if($featuredCat)
                <div class="bg-cozy-card rounded-[3rem] overflow-hidden shadow-lg border border-cozy-warm/40 relative group transition-all hover:shadow-2xl">
                    <!-- Top section: High quality cat picture framed nicely -->
                    <div class="relative h-72 overflow-hidden">
                        <img src="{{ $featuredCat->image }}" alt="{{ $featuredCat->name }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-cozy-brown/40 via-transparent to-transparent"></div>

                        <!-- Sparkle/Featured badge -->
                        <span class="absolute top-4 left-4 bg-cozy-accent text-cozy-light text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-full shadow-md">
                            Featured Companion
                        </span>
                        <!-- Status badge -->
                        <span class="absolute top-4 right-4 bg-green-500 text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-full shadow-md">
                            {{ $featuredCat->status }}
                        </span>
                    </div>

                    <!-- Bottom section: Cursive script details and cozy description -->
                    <div class="p-8 space-y-5">
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="font-script text-2xl text-cozy-accent leading-none">Cozy Friend of the Day</p>
                                <h3 class="font-serif font-bold text-3xl text-cozy-brown mt-1">{{ $featuredCat->name }}</h3>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-cozy-brown/50 font-bold uppercase tracking-widest">Campus Resident</p>
                                <p class="text-sm font-semibold text-cozy-brown/80 mt-0.5">{{ $featuredCat->location_name ?? 'AIKOL Block' }}</p>
                            </div>
                        </div>

                        <div class="w-16 h-0.5 bg-cozy-accent/40 rounded-full"></div>

                        <p class="text-cozy-brown/65 leading-relaxed text-sm">
                            Meet <span class="font-bold">{{ $featuredCat->name }}</span>, a delightful {{ $featuredCat->breed ?? 'Mixed Breed' }} ({{ $featuredCat->age }} years old). Known for a highly docile, <span class="text-cozy-accent italic">{{ strtolower($featuredCat->personality ?? 'affectionate') }}</span> personality. This adorable campus companion would love to find a forever warm blanket and caring household!
                        </p>

                        <div class="flex items-center justify-between gap-4 pt-2">
                            <div class="flex gap-2">
                                @if($featuredCat->vaccinated)
                                    <span class="bg-cozy-light border border-cozy-warm/50 text-cozy-brown text-[10px] font-bold uppercase tracking-wider px-2.5 py-1.5 rounded-xl">Vaccinated</span>
                                @endif
                                <span class="bg-cozy-light border border-cozy-warm/50 text-cozy-brown text-[10px] font-bold uppercase tracking-wider px-2.5 py-1.5 rounded-xl">{{ $featuredCat->health_status ?? 'Healthy' }}</span>
                            </div>
                            <a id="featured-cat-details-link" href="{{ route('cats.show', $featuredCat) }}" class="bg-cozy-brown hover:bg-cozy-accent text-cozy-light hover:text-cozy-brown font-bold px-6 py-3 rounded-2xl shadow-md transition-colors text-xs uppercase tracking-wider shrink-0">
                                Meet {{ $featuredCat->name }}!
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- 2. Registered Events (Pinterest Style List Card) -->
                <div class="bg-cozy-card rounded-[2.5rem] p-6 shadow-lg border border-cozy-warm/40 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="font-script text-2xl text-cozy-accent">My Attendance</p>
                            <h3 class="font-serif font-bold text-xl text-cozy-brown">Registered Events</h3>
                        </div>
                        <a id="dashboard-all-events-link" href="{{ route('events.index') }}" class="text-xs font-bold text-cozy-accent hover:text-cozy-brown uppercase tracking-wider">All Events →</a>
                    </div>

                    @if($registrations->count() > 0)
                        <div class="space-y-4">
                            @foreach($registrations as $reg)
                            <div class="bg-cozy-light/50 p-4 rounded-2xl border border-cozy-warm/30 flex items-center justify-between gap-4">
                                <div>
                                    <h4 class="font-serif font-bold text-sm text-cozy-brown">{{ $reg->event->title }}</h4>
                                    <p class="text-xs text-cozy-brown/55 mt-1">🗓️ {{ \Carbon\Carbon::parse($reg->event->start_time)->format('M d, Y @ h:i A') }}</p>
                                </div>
                                <span class="bg-cozy-accent text-cozy-light text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full">Registered</span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 bg-cozy-light/40 rounded-3xl border border-dashed border-cozy-warm">
                            <p class="text-xs font-semibold text-cozy-brown/65">You aren't registered for any events currently.</p>
                            <a id="event-zero-state-explore-calendar" href="{{ route('events.index') }}" class="text-cozy-accent hover:text-cozy-brown font-bold text-xs uppercase tracking-wider mt-2 inline-block">Explore calendar →</a>
                        </div>
                    @endif
                </div>

                <!-- 3. Incident Reports Card -->
                <div class="bg-cozy-card rounded-[2.5rem] p-6 shadow-lg border border-cozy-warm/40 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="font-script text-2xl text-cozy-accent">Stray Rescue</p>
                            <h3 class="font-serif font-bold text-xl text-cozy-brown">My Reported incidents</h3>
                        </div>
                        <a id="dashboard-file-report-link" href="{{ route('reports.create') }}" class="text-xs font-bold text-cozy-accent hover:text-cozy-brown uppercase tracking-wider">+ File Report</a>
                    </div>

                    @if($reports->count() > 0)
                        <div class="space-y-4">
                            @foreach($reports as $report)
                            <div class="bg-cozy-light/50 p-4 rounded-2xl border border-cozy-warm/30 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="text-base">🚨</span>
                                        <h4 class="font-serif font-bold text-sm text-cozy-brown">Report #{{ $report->id }}</h4>
                                    </div>
                                    <p class="text-xs text-cozy-brown/60">Location: <span class="font-semibold">{{ $report->location_name ?? 'Campus Location' }}</span></p>
                                    <p class="text-[10px] text-cozy-brown/50">Reported {{ $report->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <!-- Dynamic status text -->
                                    @if($report->status === 'Resolved')
                                        <span class="bg-green-100 text-green-700 border border-green-200 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full">Resolved</span>
                                    @elseif($report->status === 'Investigating')
                                        <span class="bg-blue-100 text-blue-700 border border-blue-200 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full">Investigating</span>
                                    @else
                                        <span class="bg-amber-100 text-amber-700 border border-amber-200 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full">{{ $report->status ?? 'Received' }}</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 bg-cozy-light/40 rounded-3xl border border-dashed border-cozy-warm">
                            <p class="text-xs font-semibold text-cozy-brown/65 text-center">No reports filed from your account.</p>
                        </div>
                    @endif
                </div>

            </div>

        </div>

    </div>
</div>
</x-app-layout>
