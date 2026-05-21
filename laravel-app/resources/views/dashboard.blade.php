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
    $sentMessages = $user->sentMessages()->with('receiver')->latest()->get();
    $chatMessages = $messages->merge($sentMessages)->sortBy('created_at')->values();
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

        <!-- ── UNIFIED TABBED CARD ── -->
        <div class="bg-cozy-card rounded-[2.5rem] shadow-xl border border-cozy-warm/40 overflow-hidden" x-data="{ tab: 'notifications', msgTab: 'inbox' }">

            <!-- Tab Bar -->
            <div class="flex items-center gap-2 p-4 overflow-x-auto border-b border-cozy-warm/30">
                @foreach([
                    ['key' => 'notifications', 'label' => 'Notifications', 'icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.437L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9'],
                    ['key' => 'messages',      'label' => 'Messages',      'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                    ['key' => 'actions',       'label' => 'Quick Actions', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                    ['key' => 'adoptions',     'label' => 'Adoptions',     'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                    ['key' => 'donations',     'label' => 'Donations',     'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['key' => 'events',        'label' => 'Events',        'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                    ['key' => 'reports',       'label' => 'Reports',       'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                ] as $t)
                <button @click="tab = '{{ $t['key'] }}'"
                        :class="tab === '{{ $t['key'] }}' ? 'bg-cozy-brown text-cozy-light shadow-md' : 'bg-cozy-bg text-cozy-brown/60 hover:text-cozy-brown hover:bg-cozy-warm/30'"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-full text-xs font-bold font-sans uppercase tracking-wider transition-all duration-200 whitespace-nowrap flex-shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $t['icon'] }}"/></svg>
                    {{ $t['label'] }}
                </button>
                @endforeach
            </div>

            <div class="border-t border-cozy-warm/30 px-8 py-8">

                <!-- TAB: Notifications -->
                <div x-show="tab === 'notifications'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                    @php
                        $colorMap = [
                            'green'  => ['bg' => 'bg-green-50',  'border' => 'border-green-200',  'badge' => 'bg-green-100 text-green-700 border-green-200'],
                            'amber'  => ['bg' => 'bg-amber-50',  'border' => 'border-amber-200',  'badge' => 'bg-amber-100 text-amber-700 border-amber-200'],
                            'blue'   => ['bg' => 'bg-sky-50',    'border' => 'border-sky-200',    'badge' => 'bg-sky-100 text-sky-700 border-sky-200'],
                            'yellow' => ['bg' => 'bg-yellow-50', 'border' => 'border-yellow-200', 'badge' => 'bg-yellow-100 text-yellow-700 border-yellow-200'],
                            'red'    => ['bg' => 'bg-red-50',    'border' => 'border-red-200',    'badge' => 'bg-red-100 text-red-700 border-red-200'],
                        ];
                    @endphp
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="font-script text-2xl text-cozy-accent mb-0.5">Activity Feed</p>
                            <h3 class="font-serif font-bold text-2xl text-cozy-brown">Notifications</h3>
                        </div>
                        <span class="bg-cozy-brown text-cozy-light text-xs font-bold px-4 py-1.5 rounded-full">{{ $notifications->count() }} total</span>
                    </div>
                    @if($notifications->count() > 0)
                        <div class="space-y-3">
                            @foreach($notifications as $notif)
                            @php $c = $colorMap[$notif['color']] ?? $colorMap['amber']; @endphp
                            <div class="flex items-start gap-4 px-5 py-4 rounded-2xl border {{ $c['bg'] }} {{ $c['border'] }} transition-all hover:shadow-sm">
                                <span class="text-2xl mt-0.5 flex-shrink-0">{{ $notif['icon'] }}</span>
                                <div class="flex-1 min-w-0">
                                    <p class="font-serif font-bold text-sm text-cozy-brown leading-snug">{{ $notif['title'] }}</p>
                                    <p class="text-xs text-cozy-brown/55 font-sans mt-0.5">{{ $notif['body'] }}</p>
                                </div>
                                <span class="text-[10px] text-cozy-brown/40 font-sans whitespace-nowrap flex-shrink-0 mt-1">
                                    {{ \Carbon\Carbon::parse($notif['time'])->diffForHumans() }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16 bg-cozy-light/40 rounded-3xl border border-dashed border-cozy-warm">
                            <span class="text-5xl block mb-3">🔔</span>
                            <p class="font-serif font-bold text-cozy-brown/60 text-lg">No notifications yet.</p>
                            <p class="text-sm text-cozy-brown/40 font-sans mt-1">Activity from adoptions, events, donations and reports will appear here.</p>
                        </div>
                    @endif
                </div>

                <!-- TAB: Messages -->
                <div x-show="tab === 'messages'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    <!-- Chat Layout: extends to card edges -->
                    <div class="-mx-8 -mb-8 flex" style="height: 560px;">

                        <!-- ── LEFT SIDEBAR ── -->
                        <div class="w-72 flex-shrink-0 flex flex-col border-r border-cozy-warm/30 bg-cozy-bg">

                            <!-- Conversation List -->
                            <div class="flex-1 overflow-y-auto p-3 space-y-1">
                                <p class="text-[9px] font-bold uppercase tracking-widest text-cozy-brown/35 px-2 mb-2 mt-1">Conversations</p>

                                <!-- AHC Team -->
                                <button class="w-full flex items-center gap-3 p-3 rounded-2xl bg-cozy-brown/10 border border-cozy-brown/15 text-left transition-all">
                                    <div class="w-11 h-11 rounded-2xl bg-cozy-accent/20 flex items-center justify-center text-xl flex-shrink-0">🐾</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-1">
                                            <p class="font-serif font-bold text-sm text-cozy-brown truncate">AHC Team</p>
                                            <span class="text-[10px] text-cozy-brown/35 font-sans flex-shrink-0">
                                                @if($chatMessages->count() > 0)
                                                    {{ $chatMessages->last()->created_at->format('h:i A') }}
                                                @else
                                                    now
                                                @endif
                                            </span>
                                        </div>
                                        <p class="text-xs text-cozy-brown/45 font-sans truncate mt-0.5">
                                            @if($chatMessages->count() > 0)
                                                {{ Str::limit($chatMessages->last()->content, 32) }}
                                            @else
                                                Welcome to e-Doptcat! 🐱
                                            @endif
                                        </p>
                                    </div>
                                    @if($unreadCount > 0)
                                        <span class="w-5 h-5 bg-cozy-accent text-white text-[10px] font-bold rounded-full flex items-center justify-center flex-shrink-0">{{ $unreadCount }}</span>
                                    @endif
                                </button>
                            </div>
                        </div>

                        <!-- ── RIGHT CHAT AREA ── -->
                        <div class="flex-1 flex flex-col min-w-0">

                            <!-- Chat Header -->
                            <div class="flex items-center gap-3 px-6 py-4 border-b border-cozy-warm/30 bg-cozy-card flex-shrink-0">
                                <div class="w-10 h-10 rounded-2xl bg-cozy-accent/20 flex items-center justify-center text-lg">🐾</div>
                                <div class="flex-1">
                                    <p class="font-serif font-bold text-sm text-cozy-brown leading-tight">AHC Team</p>
                                    <p class="text-[10px] text-cozy-accent font-bold uppercase tracking-wider">Abu Hurairah Club</p>
                                </div>
                            </div>

                            <!-- Message Bubbles -->
                            <div class="flex-1 overflow-y-auto px-6 py-5 space-y-4 bg-cozy-bg/60" id="chat-messages-scroll">

                                <!-- Static welcome bubble -->
                                <div class="flex gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-cozy-accent/20 flex items-center justify-center text-sm flex-shrink-0 mt-1">🐾</div>
                                    <div class="max-w-[70%]">
                                        <div class="bg-cozy-card border border-cozy-warm/30 rounded-2xl rounded-tl-sm px-4 py-3 shadow-sm space-y-2 text-sm text-cozy-brown/80 font-sans leading-relaxed">
                                            <p>Assalamualaikum! Welcome to <strong class="text-cozy-brown">e-Doptcat</strong> 🐱</p>
                                            <p>We are glad to have you here. Feel free to browse our cats, make a donation, report strays, or reach out to us anytime using the box below!</p>
                                            <p class="text-cozy-brown/50 text-xs">With love, <strong>The AHC Team</strong> 🌿</p>
                                        </div>
                                        <p class="text-[10px] text-cozy-brown/35 mt-1 ml-1 font-sans">AHC Team</p>
                                    </div>
                                </div>

                                @foreach($chatMessages as $msg)
                                    @php $isOwn = $msg->sender_id === $user->id; @endphp

                                    @if($isOwn)
                                    <!-- Outgoing (right) -->
                                    <div class="flex justify-end">
                                        <div class="max-w-[70%]">
                                            <div class="bg-cozy-brown text-cozy-light rounded-2xl rounded-tr-sm px-4 py-3 shadow-sm text-sm font-sans leading-relaxed space-y-2">
                                                <p>{{ $msg->content }}</p>
                                                @if($msg->attachment)
                                                    @php $ext = pathinfo($msg->attachment_name ?? '', PATHINFO_EXTENSION); $isImg = in_array(strtolower($ext), ['jpg','jpeg','png','gif','webp']); @endphp
                                                    @if($isImg)
                                                        <img src="{{ Storage::url($msg->attachment) }}" alt="attachment" class="rounded-xl max-w-full max-h-40 object-cover mt-1 border border-white/20">
                                                    @else
                                                        <a href="{{ Storage::url($msg->attachment) }}" target="_blank" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 rounded-xl px-3 py-2 transition-colors mt-1">
                                                            <span>📎</span>
                                                            <span class="text-xs truncate">{{ $msg->attachment_name }}</span>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                            <p class="text-[10px] text-cozy-brown/35 mt-1 text-right font-sans">{{ $msg->created_at->format('M d, h:i A') }}</p>
                                        </div>
                                    </div>
                                    @else
                                    <!-- Incoming (left) -->
                                    <div class="flex gap-3">
                                        <div class="w-8 h-8 rounded-xl bg-cozy-accent/20 flex items-center justify-center text-sm flex-shrink-0 mt-1">🐾</div>
                                        <div class="max-w-[70%]">
                                            <div class="bg-cozy-card border border-cozy-warm/30 rounded-2xl rounded-tl-sm px-4 py-3 shadow-sm text-sm text-cozy-brown/80 font-sans leading-relaxed space-y-2">
                                                <p>{{ $msg->content }}</p>
                                                @if($msg->attachment)
                                                    @php $ext = pathinfo($msg->attachment_name ?? '', PATHINFO_EXTENSION); $isImg = in_array(strtolower($ext), ['jpg','jpeg','png','gif','webp']); @endphp
                                                    @if($isImg)
                                                        <img src="{{ Storage::url($msg->attachment) }}" alt="attachment" class="rounded-xl max-w-full max-h-40 object-cover mt-1 border border-cozy-warm/30">
                                                    @else
                                                        <a href="{{ Storage::url($msg->attachment) }}" target="_blank" class="flex items-center gap-2 bg-cozy-warm/30 hover:bg-cozy-warm/50 rounded-xl px-3 py-2 transition-colors mt-1">
                                                            <span>📎</span>
                                                            <span class="text-xs truncate text-cozy-brown">{{ $msg->attachment_name }}</span>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="flex items-center gap-2 mt-1 ml-1">
                                                <p class="text-[10px] text-cozy-brown/35 font-sans">{{ $msg->sender->name ?? 'AHC Team' }} · {{ $msg->created_at->format('M d, h:i A') }}</p>
                                                @if($msg->isUnread())
                                                <form method="POST" action="{{ route('messages.read', $msg) }}" class="inline">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="text-[9px] font-bold text-cozy-accent hover:text-cozy-brown uppercase tracking-wider font-sans leading-none">Mark read</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach

                                @if(session('message_sent'))
                                <div class="flex justify-center">
                                    <span class="bg-green-50 border border-green-200 text-green-600 text-xs font-sans px-4 py-1.5 rounded-full">✓ Message sent</span>
                                </div>
                                @endif
                            </div>

                            <!-- Compose Input -->
                            <div class="flex-shrink-0 px-5 py-4 border-t border-cozy-warm/30 bg-cozy-card"
                                 x-data="{
                                    fileName: null,
                                    fileIsImage: false,
                                    showEmoji: false,
                                    sending: false,
                                    errorMsg: null,
                                    emojis: ['😊','😂','🥰','😍','🤩','😎','😢','😅','🙏','👍','❤️','🔥','✨','🎉','🐱','🐾','🌿','💛','🌸','🍵','😺','🐈','🌙','⭐','💬','📎','✉️','🤝','💪','🌟'],
                                    pickEmoji(e) {
                                        const ta = document.getElementById('msg-textarea');
                                        const start = ta.selectionStart;
                                        ta.value = ta.value.slice(0, start) + e + ta.value.slice(start);
                                        ta.focus();
                                        ta.selectionStart = ta.selectionEnd = start + e.length;
                                        this.showEmoji = false;
                                    },
                                    onFile(ev) {
                                        const f = ev.target.files[0];
                                        if (!f) return;
                                        this.fileName = f.name;
                                        this.fileIsImage = f.type.startsWith('image/');
                                    },
                                    clearFile() {
                                        this.fileName = null;
                                        this.fileIsImage = false;
                                        document.getElementById('msg-file-input').value = '';
                                        document.getElementById('msg-image-input').value = '';
                                    },
                                    async sendMessage(form) {
                                        this.showEmoji = false;
                                        this.errorMsg = null;
                                        const ta = document.getElementById('msg-textarea');
                                        const content = ta.value.trim();
                                        if (content.length < 5 || this.sending) return;
                                        this.sending = true;

                                        /* build FormData — include whichever file input has a file */
                                        const fd = new FormData(form);
                                        const imgInput  = document.getElementById('msg-image-input');
                                        const fileInput = document.getElementById('msg-file-input');
                                        const file = imgInput.files[0] || fileInput.files[0] || null;
                                        if (file) fd.set('attachment', file);

                                        /* optimistic bubble */
                                        const chatArea = document.getElementById('chat-messages-scroll');
                                        const now = new Date();
                                        const ts  = now.toLocaleString('en-US',{month:'short',day:'numeric',hour:'numeric',minute:'2-digit'});
                                        const safe = content.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>');
                                        let attachHtml = '';
                                        if (file && file.type.startsWith('image/')) {
                                            const objUrl = URL.createObjectURL(file);
                                            attachHtml = `<img src='${objUrl}' class='rounded-xl max-w-full max-h-40 object-cover mt-1 border border-white/20'>`;
                                        } else if (file) {
                                            attachHtml = `<div class='flex items-center gap-2 bg-white/10 rounded-xl px-3 py-2 mt-1'><span>📎</span><span class='text-xs truncate'>${file.name}</span></div>`;
                                        }
                                        const bubble = document.createElement('div');
                                        bubble.className = 'flex justify-end transition-opacity duration-300';
                                        bubble.innerHTML = `<div class='max-w-[70%]'><div class='bg-cozy-brown text-cozy-light rounded-2xl rounded-tr-sm px-4 py-3 shadow-sm text-sm font-sans leading-relaxed space-y-2'><p>${safe}</p>${attachHtml}</div><p class='text-[10px] text-cozy-brown/35 mt-1 text-right font-sans'>${ts}</p></div>`;
                                        chatArea.appendChild(bubble);
                                        chatArea.scrollTop = chatArea.scrollHeight;

                                        /* clear inputs */
                                        ta.value = '';
                                        this.fileName = null;
                                        this.fileIsImage = false;
                                        if (imgInput)  imgInput.value  = '';
                                        if (fileInput) fileInput.value = '';

                                        /* send */
                                        try {
                                            const res = await fetch(form.action, {
                                                method: 'POST',
                                                body: fd,
                                                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                                            });
                                            if (!res.ok) {
                                                const data = await res.json().catch(() => ({}));
                                                this.errorMsg = data.message ?? 'Failed to send. Please try again.';
                                                bubble.style.opacity = '0.4';
                                            }
                                        } catch(e) {
                                            this.errorMsg = 'Network error. Please try again.';
                                            bubble.style.opacity = '0.4';
                                        } finally {
                                            this.sending = false;
                                        }
                                    }
                                 }">

                                <!-- Error banner -->
                                <p x-show="errorMsg" x-text="errorMsg" class="text-red-500 text-xs font-sans mb-2"></p>

                                <!-- Hidden file inputs (outside form, referenced manually) -->
                                <input type="file" id="msg-image-input" accept="image/*" class="hidden" @change="onFile($event)">
                                <input type="file" id="msg-file-input" accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx,.txt" class="hidden" @change="onFile($event)">

                                <form method="POST" action="{{ route('messages.store') }}"
                                      enctype="multipart/form-data"
                                      class="flex items-end gap-3"
                                      @submit.prevent="sendMessage($el)">
                                    @csrf
                                    <input type="hidden" name="subject" value="Message from Dashboard">

                                    <div class="flex-1 bg-cozy-bg border border-cozy-warm/40 rounded-2xl px-4 py-3 focus-within:border-cozy-accent/60 focus-within:ring-2 focus-within:ring-cozy-accent/20 transition-all relative">

                                        <textarea id="msg-textarea" name="content" rows="1" maxlength="2000"
                                                  placeholder="Type your message here…"
                                                  class="w-full bg-transparent text-sm text-cozy-brown font-sans placeholder-cozy-brown/35 focus:outline-none resize-none leading-relaxed"></textarea>

                                        <!-- Attachment preview -->
                                        <div x-show="fileName" class="flex items-center gap-2 mt-2 bg-cozy-warm/30 rounded-xl px-3 py-1.5">
                                            <span class="text-sm" x-text="fileIsImage ? '🖼️' : '📎'"></span>
                                            <span class="text-xs text-cozy-brown font-sans truncate flex-1" x-text="fileName"></span>
                                            <button type="button" @click="clearFile()" class="text-cozy-brown/40 hover:text-cozy-brown text-xs font-bold">✕</button>
                                        </div>

                                        <!-- Toolbar -->
                                        <div class="flex items-center gap-3 mt-2 pt-2 border-t border-cozy-warm/20">
                                            <!-- Image -->
                                            <button type="button" @click="document.getElementById('msg-image-input').click()"
                                                    :class="fileName && fileIsImage ? 'text-cozy-accent' : 'text-cozy-brown/35 hover:text-cozy-brown'"
                                                    class="transition-colors" title="Attach image">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </button>
                                            <!-- Attach file -->
                                            <button type="button" @click="document.getElementById('msg-file-input').click()"
                                                    :class="fileName && !fileIsImage ? 'text-cozy-accent' : 'text-cozy-brown/35 hover:text-cozy-brown'"
                                                    class="transition-colors" title="Attach file">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                            </button>
                                            <!-- Emoji toggle -->
                                            <div class="relative">
                                                <button type="button" @click="showEmoji = !showEmoji"
                                                        :class="showEmoji ? 'text-cozy-accent' : 'text-cozy-brown/35 hover:text-cozy-brown'"
                                                        class="transition-colors" title="Emoji">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                </button>
                                                <!-- Emoji picker -->
                                                <div x-show="showEmoji" x-transition
                                                     @click.outside="showEmoji = false"
                                                     class="absolute bottom-8 left-0 z-50 bg-cozy-card border border-cozy-warm/40 rounded-2xl shadow-xl p-3 w-52">
                                                    <div class="grid grid-cols-6 gap-1">
                                                        <template x-for="e in emojis" :key="e">
                                                            <button type="button" @click="pickEmoji(e)"
                                                                    class="text-lg hover:bg-cozy-warm/40 rounded-lg p-1 transition-colors leading-none"
                                                                    x-text="e"></button>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" :disabled="sending"
                                            :class="sending ? 'opacity-50 cursor-not-allowed' : 'hover:bg-cozy-accent'"
                                            class="w-11 h-11 bg-cozy-brown text-cozy-light rounded-2xl flex items-center justify-center flex-shrink-0 transition-colors shadow-md self-end">
                                        <svg x-show="!sending" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                        <svg x-show="sending" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/></svg>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- TAB: Quick Actions -->
                <div x-show="tab === 'actions'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                    <p class="font-script text-2xl text-cozy-accent mb-1">Get Started</p>
                    <h3 class="font-serif font-bold text-2xl text-cozy-brown mb-6">Quick Actions</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('cats.index') }}" class="group bg-cozy-light hover:bg-cozy-brown p-6 rounded-3xl border border-cozy-warm/30 shadow-sm transition-all duration-300 flex flex-col items-center text-center gap-3">
                            <span class="text-4xl group-hover:scale-110 transition-transform">🐾</span>
                            <span class="font-serif font-bold text-sm text-cozy-brown group-hover:text-cozy-light">Browse Cats</span>
                        </a>
                        <a href="{{ route('donations.index') }}" class="group bg-cozy-light hover:bg-cozy-brown p-6 rounded-3xl border border-cozy-warm/30 shadow-sm transition-all duration-300 flex flex-col items-center text-center gap-3">
                            <span class="text-4xl group-hover:scale-110 transition-transform">💛</span>
                            <span class="font-serif font-bold text-sm text-cozy-brown group-hover:text-cozy-light">Make Donation</span>
                        </a>
                        <a href="{{ route('reports.create') }}" class="group bg-cozy-light hover:bg-cozy-brown p-6 rounded-3xl border border-cozy-warm/30 shadow-sm transition-all duration-300 flex flex-col items-center text-center gap-3">
                            <span class="text-4xl group-hover:scale-110 transition-transform">🚨</span>
                            <span class="font-serif font-bold text-sm text-cozy-brown group-hover:text-cozy-light">Report Stray</span>
                        </a>
                        <a id="quick-link-cat-tracker" href="{{ route('tracker') }}" class="group bg-cozy-light hover:bg-cozy-brown p-6 rounded-3xl border border-cozy-warm/30 shadow-sm transition-all duration-300 flex flex-col items-center text-center gap-3">
                            <span class="text-4xl group-hover:scale-110 transition-transform">📍</span>
                            <span class="font-serif font-bold text-sm text-cozy-brown group-hover:text-cozy-light">Lost & Found</span>
                        </a>
                    </div>
                </div>

                <!-- TAB: Adoptions -->
                <div x-show="tab === 'adoptions'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="font-script text-2xl text-cozy-accent mb-0.5">My Requests</p>
                            <h3 class="font-serif font-bold text-2xl text-cozy-brown">Adoption Applications</h3>
                        </div>
                        <span class="bg-cozy-warm/40 text-cozy-brown font-bold text-sm px-4 py-1.5 rounded-full">{{ $totalAdoptions }} total</span>
                    </div>
                    @if($adoptions->count() > 0)
                        <div class="space-y-3">
                            @foreach($adoptions as $adoption)
                            <div class="bg-cozy-light/70 hover:bg-cozy-light p-4 rounded-2xl border border-cozy-warm/30 transition-all flex items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="h-12 w-12 overflow-hidden shadow-inner border border-cozy-accent/30 flex-shrink-0 rounded-2xl">
                                        <img src="{{ $adoption->cat->image }}" alt="{{ $adoption->cat->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="font-serif font-bold text-sm text-cozy-brown">{{ $adoption->cat->name }}</h4>
                                        <p class="text-[10px] font-bold text-cozy-accent uppercase tracking-wider mt-0.5">Stage: {{ $adoption->pipeline_stage ?? 'New' }}</p>
                                    </div>
                                </div>
                                @if($adoption->status === 'Approved')
                                    <span class="bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full border border-green-200">Approved</span>
                                @elseif($adoption->status === 'Pending')
                                    <span class="bg-amber-100 text-amber-700 text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full border border-amber-200">Pending</span>
                                @else
                                    <span class="bg-gray-100 text-gray-600 text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full border border-gray-200">{{ $adoption->status }}</span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16 bg-cozy-light/40 rounded-3xl border border-dashed border-cozy-warm">
                            <span class="text-5xl block mb-3">🍃</span>
                            <p class="font-serif font-bold text-cozy-brown/60 text-lg">No adoption applications yet.</p>
                            <a href="{{ route('cats.index') }}" class="text-cozy-accent hover:text-cozy-brown font-bold text-sm uppercase tracking-wider mt-3 inline-block">Find a companion →</a>
                        </div>
                    @endif
                </div>

                <!-- TAB: Donations -->
                <div x-show="tab === 'donations'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="font-script text-2xl text-cozy-accent mb-0.5">Heartfelt Support</p>
                            <h3 class="font-serif font-bold text-2xl text-cozy-brown">My Donations</h3>
                        </div>
                        <div class="text-right bg-cozy-light/60 px-5 py-3 rounded-2xl border border-cozy-warm/30">
                            <p class="text-[10px] font-bold text-cozy-brown/50 uppercase tracking-widest">Total Contributed</p>
                            <p class="text-xl font-serif font-extrabold text-cozy-brown">RM {{ number_format($totalDonationsAmount, 2) }}</p>
                        </div>
                    </div>
                    @if($donations->count() > 0)
                        <div class="space-y-3">
                            @foreach($donations as $donation)
                            <div class="flex justify-between items-center px-5 py-3.5 bg-cozy-light/60 rounded-2xl border border-cozy-warm/30">
                                <div class="flex items-center gap-3">
                                    <span class="text-xl">💛</span>
                                    <p class="text-sm font-semibold text-cozy-brown font-sans">{{ $donation->created_at->format('M d, Y') }}</p>
                                </div>
                                <span class="font-bold text-cozy-brown font-sans">RM {{ number_format($donation->amount, 2) }}</span>
                            </div>
                            @endforeach
                        </div>
                        <a href="{{ route('donations.index') }}" class="mt-6 inline-flex items-center justify-center w-full py-3.5 bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold rounded-2xl text-sm uppercase tracking-wider font-sans transition-colors">
                            Donate Again
                        </a>
                    @else
                        <div class="text-center py-16 bg-cozy-light/40 rounded-3xl border border-dashed border-cozy-warm">
                            <span class="text-5xl block mb-3">💛</span>
                            <p class="font-serif font-bold text-cozy-brown/60 text-lg">No donations yet.</p>
                            <a href="{{ route('donations.index') }}" class="text-cozy-accent hover:text-cozy-brown font-bold text-sm uppercase tracking-wider mt-3 inline-block">Make your first donation →</a>
                        </div>
                    @endif
                </div>

                <!-- TAB: Events -->
                <div x-show="tab === 'events'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="font-script text-2xl text-cozy-accent mb-0.5">My Attendance</p>
                            <h3 class="font-serif font-bold text-2xl text-cozy-brown">Registered Events</h3>
                        </div>
                        <a href="{{ route('events.index') }}" class="text-sm font-bold text-cozy-accent hover:text-cozy-brown uppercase tracking-wider font-sans">All Events →</a>
                    </div>
                    @if($registrations->count() > 0)
                        <div class="space-y-3">
                            @foreach($registrations as $reg)
                            <div class="flex items-center justify-between px-5 py-4 bg-cozy-light/60 rounded-2xl border border-cozy-warm/30">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-cozy-warm/50 rounded-2xl flex items-center justify-center text-xl flex-shrink-0">🗓️</div>
                                    <div>
                                        <h4 class="font-serif font-bold text-sm text-cozy-brown">{{ $reg->event->title }}</h4>
                                        <p class="text-xs text-cozy-brown/55 mt-0.5">{{ \Carbon\Carbon::parse($reg->event->start_time)->format('M d, Y @ h:i A') }}</p>
                                    </div>
                                </div>
                                <span class="bg-cozy-accent text-cozy-light text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">Registered</span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16 bg-cozy-light/40 rounded-3xl border border-dashed border-cozy-warm">
                            <div class="w-16 h-16 bg-cozy-warm/40 rounded-3xl flex items-center justify-center mx-auto mb-4 text-3xl">🗓️</div>
                            <p class="font-serif font-bold text-cozy-brown/60 text-lg">Upcoming Attendance</p>
                            <p class="text-sm text-cozy-brown/40 font-sans mt-1">You are registered to attend:</p>
                            <p class="font-serif font-bold text-2xl text-cozy-brown mt-2">0 Campaign Events</p>
                            <a href="{{ route('events.index') }}" class="text-cozy-accent hover:text-cozy-brown font-bold text-sm uppercase tracking-wider mt-4 inline-block">Explore events →</a>
                        </div>
                    @endif
                </div>

                <!-- TAB: Reports -->
                <div x-show="tab === 'reports'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="font-script text-2xl text-cozy-accent mb-0.5">Stray Rescue</p>
                            <h3 class="font-serif font-bold text-2xl text-cozy-brown">My Incident Reports</h3>
                        </div>
                        <a href="{{ route('reports.create') }}" class="text-sm font-bold text-cozy-accent hover:text-cozy-brown uppercase tracking-wider font-sans">+ File Report</a>
                    </div>
                    @if($reports->count() > 0)
                        <div class="space-y-3">
                            @foreach($reports as $report)
                            <div class="flex items-center justify-between px-5 py-4 bg-cozy-light/60 rounded-2xl border border-cozy-warm/30">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-red-50 rounded-2xl flex items-center justify-center text-xl flex-shrink-0">🚨</div>
                                    <div>
                                        <h4 class="font-serif font-bold text-sm text-cozy-brown">Report #{{ $report->id }}</h4>
                                        <p class="text-xs text-cozy-brown/55 mt-0.5">{{ $report->location_name ?? 'Campus Location' }} · {{ $report->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @if($report->status === 'Resolved')
                                    <span class="bg-green-100 text-green-700 border border-green-200 text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full">Resolved</span>
                                @elseif($report->status === 'Investigating')
                                    <span class="bg-blue-100 text-blue-700 border border-blue-200 text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full">Investigating</span>
                                @else
                                    <span class="bg-amber-100 text-amber-700 border border-amber-200 text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full">{{ $report->status ?? 'Received' }}</span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16 bg-cozy-light/40 rounded-3xl border border-dashed border-cozy-warm">
                            <span class="text-5xl block mb-3">🍃</span>
                            <p class="font-serif font-bold text-cozy-brown/60 text-lg">No reports filed yet.</p>
                            <a href="{{ route('reports.create') }}" class="text-cozy-accent hover:text-cozy-brown font-bold text-sm uppercase tracking-wider mt-3 inline-block">File a report →</a>
                        </div>
                    @endif
                </div>

            </div>
        </div>

    </div>
</div>
</x-app-layout>
