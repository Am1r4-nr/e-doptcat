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
            <div class="w-24 h-24 bg-cozy-warm/60 rounded-full flex items-center justify-center mx-auto mb-4 relative z-10">
                <svg class="w-12 h-12 text-cozy-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-24 h-24 bg-cozy-accent/20 rounded-full blur-xl opacity-60 animate-pulse"></div>
        </div>

        <p class="font-script text-2xl text-cozy-accent mb-2">Application Received</p>
        <h1 class="font-serif font-bold text-5xl text-cozy-brown mb-4">You're One Step Closer!</h1>
        <div class="w-24 h-1 bg-cozy-accent/60 mx-auto rounded-full mb-8"></div>

        <p class="text-xl text-cozy-brown/60 mb-10 leading-relaxed font-sans">
            Your adoption application for <span class="font-bold text-cozy-brown">{{ $cat->name }}</span> has been submitted successfully.
            Our team will review it and reach out to you soon.
        </p>

        <!-- What Happens Next -->
        <div class="bg-cozy-card rounded-3xl shadow-xl p-8 border border-cozy-warm/40 mb-12 text-left">
            <h2 class="font-serif font-bold text-xl text-cozy-brown mb-6 text-center">What Happens Next?</h2>
            <div class="space-y-5">
                @foreach([
                    ['step' => '1', 'title' => 'Application Review', 'desc' => 'The AHC team will review your application details within 3–5 business days.'],
                    ['step' => '2', 'title' => 'Screening & Interview', 'desc' => 'You may be contacted for a brief interview or home environment assessment.'],
                    ['step' => '3', 'title' => 'Meet & Greet', 'desc' => 'Arrange a visit to meet ' . $cat->name . ' and see if it\'s the right match.'],
                    ['step' => '4', 'title' => 'Adoption Approval', 'desc' => 'Once approved, we\'ll finalize the adoption agreement and arrange handover.'],
                ] as $item)
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 bg-cozy-warm/60 text-cozy-accent rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 mt-0.5">{{ $item['step'] }}</div>
                    <div>
                        <p class="font-bold text-cozy-brown font-sans">{{ $item['title'] }}</p>
                        <p class="text-cozy-brown/60 text-sm font-sans mt-0.5">{{ $item['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('cats.index') }}"
               class="inline-flex items-center justify-center px-8 py-4 bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold rounded-full shadow-lg transition-all duration-300 hover:-translate-y-1 font-sans text-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Meet More Cats
            </a>
            <a href="{{ route('home') }}"
               class="inline-flex items-center justify-center px-8 py-4 bg-cozy-card border-2 border-cozy-warm hover:border-cozy-brown text-cozy-brown font-bold rounded-full transition-all hover:bg-cozy-warm/20 font-sans">
                Go to Home
            </a>
        </div>

        <p class="mt-12 text-sm text-cozy-brown/40 italic font-sans">
            A confirmation will be sent to your registered email address.
        </p>
    </div>
</div>
</x-app-layout>
