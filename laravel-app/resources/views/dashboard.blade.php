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

    // Messages
    $messages = $user->receivedMessages()->with('sender')->latest()->get();
    $unreadCount = $messages->filter(fn($m) => $m->isUnread())->count();

    // Smart notifications derived from existing data
    $notifications = collect();

    foreach ($adoptions as $a) {
        $notifications->push([
            'icon'  => '🐾',
            'color' => $a->status === 'Approved' ? 'green' : ($a->status === 'Rejected' ? 'red' : 'amber'),
            'title' => 'Adoption Application — ' . ($a->cat->name ?? 'Cat'),
            'body'  => 'Status: ' . $a->status . ' · Stage: ' . ($a->pipeline_stage ?? 'New'),
            'time'  => $a->updated_at,
        ]);
    }
    foreach ($registrations as $r) {
        $notifications->push([
            'icon'  => '🗓️',
            'color' => 'blue',
            'title' => 'Event Registered — ' . ($r->event->title ?? 'Event'),
            'body'  => 'You are registered for ' . (\Carbon\Carbon::parse($r->event->start_time ?? now())->format('M d, Y')),
            'time'  => $r->created_at,
        ]);
    }
    foreach ($donations->take(3) as $d) {
        $notifications->push([
            'icon'  => '💛',
            'color' => 'yellow',
            'title' => 'Donation Received',
            'body'  => 'RM ' . number_format($d->amount, 2) . ' — Thank you for your generosity!',
            'time'  => $d->created_at,
        ]);
    }
    foreach ($reports as $r) {
        $notifications->push([
            'icon'  => '🚨',
            'color' => $r->status === 'Resolved' ? 'green' : 'amber',
            'title' => 'Incident Report #' . $r->id,
            'body'  => 'Status: ' . ($r->status ?? 'Received') . ' · ' . ($r->location_name ?? 'Campus'),
            'time'  => $r->updated_at,
        ]);
    }
    $notifications = $notifications->sortByDesc('time')->values();
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

        <!-- ── NOTIFICATION BOARD (full-width) ── -->
        <div class="mb-8" x-data="{ open: true }">
            <div class="bg-cozy-card rounded-[2.5rem] shadow-lg border border-cozy-warm/40 overflow-hidden">
                <!-- Header -->
                <button @click="open = !open" class="w-full flex items-center justify-between px-8 py-5 hover:bg-cozy-warm/10 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-2xl bg-cozy-warm/50 flex items-center justify-center text-xl">🔔</div>
                        <div class="text-left">
                            <p class="font-script text-xl text-cozy-accent leading-none">What's New</p>
                            <h3 class="font-serif font-bold text-lg text-cozy-brown mt-0.5">Notification Board</h3>
                        </div>
                        @if($notifications->count() > 0)
                        <span class="bg-cozy-accent text-cozy-light text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full">
                            {{ $notifications->count() }} updates
                        </span>
                        @endif
                    </div>
                    <svg class="w-5 h-5 text-cozy-brown/50 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    @if($notifications->count() > 0)
                    <div class="px-8 pb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">
                            @foreach($notifications as $notif)
                            @php
                                $colorMap = [
                                    'green'  => 'bg-green-50 border-green-200 text-green-700',
                                    'amber'  => 'bg-amber-50 border-amber-200 text-amber-700',
                                    'red'    => 'bg-red-50 border-red-200 text-red-600',
                                    'blue'   => 'bg-blue-50 border-blue-200 text-blue-700',
                                    'yellow' => 'bg-yellow-50 border-yellow-200 text-yellow-700',
                                ];
                                $cls = $colorMap[$notif['color']] ?? 'bg-cozy-light border-cozy-warm/40 text-cozy-brown';
                            @endphp
                            <div class="flex items-start gap-3 p-4 rounded-2xl border {{ $cls }} transition-all hover:shadow-sm">
                                <span class="text-xl flex-shrink-0 mt-0.5">{{ $notif['icon'] }}</span>
                                <div class="min-w-0">
                                    <p class="font-bold text-sm font-sans truncate">{{ $notif['title'] }}</p>
                                    <p class="text-xs mt-0.5 opacity-80 font-sans">{{ $notif['body'] }}</p>
                                    <p class="text-[10px] mt-1 opacity-50 font-sans">{{ \Carbon\Carbon::parse($notif['time'])->diffForHumans() }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="px-8 pb-8 text-center">
                        <span class="text-4xl block mb-2">🍃</span>
                        <p class="text-sm font-semibold text-cozy-brown/60 font-sans">All caught up! No new notifications.</p>
                    </div>
                    @endif
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

                <!-- 1. Registered Events (Pinterest Style List Card) -->
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

                <!-- 4. Messages Card -->
                <div class="bg-cozy-card rounded-[2.5rem] shadow-lg border border-cozy-warm/40 overflow-hidden"
                     x-data="{ tab: 'inbox' }">

                    <!-- Card Header -->
                    <div class="px-6 pt-6 pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="font-script text-2xl text-cozy-accent leading-none">AHC Team</p>
                                <h3 class="font-serif font-bold text-xl text-cozy-brown mt-0.5">Messages</h3>
                            </div>
                            @if($unreadCount > 0)
                            <span class="bg-cozy-accent text-cozy-light text-[10px] font-bold px-2.5 py-1 rounded-full">
                                {{ $unreadCount }} unread
                            </span>
                            @endif
                        </div>

                        <!-- Tab Pills -->
                        <div class="flex gap-2 bg-cozy-bg rounded-2xl p-1">
                            <button @click="tab = 'inbox'"
                                    :class="tab === 'inbox' ? 'bg-cozy-brown text-cozy-light shadow-sm' : 'text-cozy-brown/60 hover:text-cozy-brown'"
                                    class="flex-1 py-2 px-4 rounded-xl text-xs font-bold font-sans transition-all">
                                Inbox ({{ $messages->count() }})
                            </button>
                            <button @click="tab = 'compose'"
                                    :class="tab === 'compose' ? 'bg-cozy-brown text-cozy-light shadow-sm' : 'text-cozy-brown/60 hover:text-cozy-brown'"
                                    class="flex-1 py-2 px-4 rounded-xl text-xs font-bold font-sans transition-all">
                                + New Message
                            </button>
                        </div>
                    </div>

                    <!-- Flash: message sent -->
                    @if(session('message_sent'))
                    <div class="mx-6 mb-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl px-4 py-3 text-xs font-sans font-bold flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ session('message_sent') }}
                    </div>
                    @endif

                    <!-- INBOX TAB -->
                    <div x-show="tab === 'inbox'" class="px-6 pb-6">
                        @if($messages->count() > 0)
                        <div class="space-y-3 max-h-80 overflow-y-auto pr-1">
                            @foreach($messages as $msg)
                            <div class="rounded-2xl border p-4 transition-all {{ $msg->isUnread() ? 'bg-cozy-warm/20 border-cozy-accent/40' : 'bg-cozy-light/50 border-cozy-warm/30' }}"
                                 x-data="{ expanded: false }">
                                <div class="flex items-start justify-between gap-3 cursor-pointer" @click="expanded = !expanded">
                                    <div class="flex items-start gap-3 min-w-0">
                                        <!-- Sender avatar -->
                                        <div class="w-8 h-8 rounded-full bg-cozy-brown flex items-center justify-center text-cozy-light text-xs font-bold flex-shrink-0">
                                            {{ strtoupper(substr($msg->sender->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <p class="font-bold text-xs text-cozy-brown font-sans truncate">{{ $msg->sender->name ?? 'AHC Team' }}</p>
                                                @if($msg->isUnread())
                                                <span class="w-2 h-2 rounded-full bg-cozy-accent flex-shrink-0"></span>
                                                @endif
                                            </div>
                                            <p class="text-xs text-cozy-brown/70 font-sans truncate">{{ $msg->subject ?? 'No Subject' }}</p>
                                            <p class="text-[10px] text-cozy-brown/40 font-sans mt-0.5">{{ $msg->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <svg class="w-4 h-4 text-cozy-brown/40 flex-shrink-0 transition-transform mt-1" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>

                                <!-- Expanded body -->
                                <div x-show="expanded" x-transition class="mt-3 pt-3 border-t border-cozy-warm/30" x-cloak>
                                    <p class="text-xs text-cozy-brown/70 font-sans leading-relaxed">{{ $msg->content }}</p>
                                    @if($msg->isUnread())
                                    <form method="POST" action="{{ route('messages.read', $msg) }}" class="mt-3">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="text-[10px] font-bold text-cozy-accent hover:text-cozy-brown uppercase tracking-wider font-sans">
                                            Mark as read ✓
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-8 bg-cozy-light/40 rounded-3xl border border-dashed border-cozy-warm">
                            <span class="text-3xl block mb-2">✉️</span>
                            <p class="text-xs font-semibold text-cozy-brown/60 font-sans">Your inbox is empty.</p>
                            <button @click="tab = 'compose'" class="text-cozy-accent hover:text-cozy-brown font-bold text-xs uppercase tracking-wider mt-2 inline-block font-sans">
                                Send a message →
                            </button>
                        </div>
                        @endif
                    </div>

                    <!-- COMPOSE TAB -->
                    <div x-show="tab === 'compose'" class="px-6 pb-6" x-cloak>
                        <form method="POST" action="{{ route('messages.store') }}" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-[10px] font-bold text-cozy-brown/50 uppercase tracking-wider mb-1.5 font-sans">To</label>
                                <div class="flex items-center gap-2 bg-cozy-bg rounded-2xl px-4 py-3 border border-cozy-warm/40">
                                    <div class="w-6 h-6 rounded-full bg-cozy-brown flex items-center justify-center text-cozy-light text-[10px] font-bold">A</div>
                                    <span class="text-xs font-bold text-cozy-brown font-sans">AHC Admin Team</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-cozy-brown/50 uppercase tracking-wider mb-1.5 font-sans">Subject</label>
                                <input type="text" name="subject" value="{{ old('subject') }}"
                                       class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-2.5 text-xs text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition"
                                       placeholder="What's this about?">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-cozy-brown/50 uppercase tracking-wider mb-1.5 font-sans">Message <span class="text-red-400">*</span></label>
                                <textarea name="content" rows="4"
                                          class="w-full rounded-2xl border border-cozy-warm/60 bg-cozy-bg px-4 py-2.5 text-xs text-cozy-brown font-sans focus:outline-none focus:ring-2 focus:ring-cozy-accent/50 focus:border-cozy-accent transition resize-none @error('content') border-red-400 @enderror"
                                          placeholder="Write your message to the AHC team...">{{ old('content') }}</textarea>
                                @error('content') <p class="mt-1 text-xs text-red-500 font-sans">{{ $message }}</p> @enderror
                            </div>
                            <button type="submit"
                                    class="w-full py-3 bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold rounded-2xl text-xs uppercase tracking-wider font-sans transition-colors flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                Send Message
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
</x-app-layout>
