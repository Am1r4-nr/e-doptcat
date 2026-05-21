<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }
</style>

<div class="bg-cozy-bg min-h-screen relative overflow-hidden pb-24">

    <!-- Decorative blobs -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-cozy-warm/40 blob opacity-50 translate-x-1/4 -translate-y-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cozy-accent/15 blob opacity-40 -translate-x-1/4 translate-y-1/4 pointer-events-none" style="animation-delay:-5s;"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-6 pt-32 pb-16">

        <!-- Hero heading -->
        <div class="text-center mb-16">
            <p class="font-script text-3xl text-cozy-gold mb-2">Everything You Need to Know</p>
            <h1 class="font-serif font-bold text-5xl text-cozy-brown mb-4">Adoption Guide</h1>
            <p class="font-sans text-gray-500 text-[16px] max-w-xl mx-auto leading-relaxed">
                We want every adoption to be a joyful, lasting match. Read through the guide below before submitting your application.
            </p>
        </div>

        <!-- Step-by-step process -->
        <div class="bg-white rounded-3xl shadow-sm border border-cozy-warm/30 p-8 md:p-10 mb-10">
            <h2 class="font-serif font-bold text-2xl text-cozy-brown mb-6">The Adoption Process</h2>
            <ol class="space-y-6">
                @foreach ([
                    ['Browse & Choose',     'Visit our Adopt a Cat page and find a resident whose personality and needs feel like a good fit for your lifestyle.'],
                    ['Submit Application',  'Complete the online adoption form. Be honest — the more we know about your home and experience, the better we can match you.'],
                    ['Screening Review',    'Our team reviews your application within 3–5 working days. We may reach out for a short follow-up chat or home visit.'],
                    ['Meet & Greet',        'You\'ll be invited to campus for a supervised meet-and-greet with your chosen cat to make sure the bond feels right.'],
                    ['Approval & Adoption', 'Once approved, we prepare the handover paperwork. Your new companion goes home with you — and a lifelong journey begins.'],
                ] as [$title, $desc])
                <li class="flex gap-5">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-cozy-gold/15 text-cozy-gold font-bold text-sm flex items-center justify-center mt-0.5">
                        {{ $loop->iteration }}
                    </div>
                    <div>
                        <p class="font-serif font-bold text-[16px] text-cozy-brown mb-1">{{ $title }}</p>
                        <p class="font-sans text-gray-500 text-[14px] leading-relaxed">{{ $desc }}</p>
                    </div>
                </li>
                @endforeach
            </ol>
        </div>

        <!-- Requirements -->
        <div class="bg-white rounded-3xl shadow-sm border border-cozy-warm/30 p-8 md:p-10 mb-10">
            <h2 class="font-serif font-bold text-2xl text-cozy-brown mb-2">Eligibility Requirements</h2>
            <p class="font-sans text-gray-400 text-[13px] mb-6">All applicants must meet the following criteria to be considered.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ([
                    ['Age',             'Minimum 18 years old.'],
                    ['Citizenship',     'Must be a Malaysian citizen.'],
                    ['Accommodation',   'Must reside in accommodation that permits pets (off-campus or family home). Hostel/dormitory residents are not eligible.'],
                    ['Household',       'All household members must agree to the adoption.'],
                    ['Prior Pets',      'Households may have a maximum of 5 pets. All existing pets must be vaccinated and non-aggressive toward cats.'],
                    ['Commitment',      'Must commit to providing proper food, veterinary care, and a safe indoor environment for the cat\'s lifetime.'],
                ] as [$label, $text])
                <div class="flex gap-3 bg-[#FAF8F5] rounded-2xl p-4">
                    <div class="flex-shrink-0 w-5 h-5 rounded-full bg-teal-100 flex items-center justify-center mt-0.5">
                        <svg class="w-3 h-3 text-teal-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-[13px] text-cozy-brown">{{ $label }}</p>
                        <p class="text-[12px] text-gray-500 mt-0.5 leading-relaxed">{{ $text }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- What to prepare -->
        <div class="bg-white rounded-3xl shadow-sm border border-cozy-warm/30 p-8 md:p-10 mb-10">
            <h2 class="font-serif font-bold text-2xl text-cozy-brown mb-2">What to Prepare</h2>
            <p class="font-sans text-gray-400 text-[13px] mb-6">Have these ready before and after your application is approved.</p>
            <div class="space-y-3">
                @foreach ([
                    ['Before applying',  'Valid student / staff ID, basic details about your home (type, floor, outdoor access), names of all household members.'],
                    ['During screening', 'Be available for a short call or Whatsapp chat. We may request photos of your home environment.'],
                    ['Before pick-up',   'Purchase a carrier box, litter tray, food & water bowls, and a starter supply of cat food ahead of the handover day.'],
                    ['After adoption',   'Register the cat with a nearby vet within 30 days. Send us a short update photo within the first month — we love hearing how they\'re settling in!'],
                ] as [$stage, $detail])
                <div class="flex gap-4 items-start">
                    <span class="flex-shrink-0 mt-1 w-2 h-2 rounded-full bg-cozy-gold"></span>
                    <div>
                        <span class="font-bold text-[13px] text-cozy-brown">{{ $stage }}: </span>
                        <span class="text-[13px] text-gray-500 leading-relaxed">{{ $detail }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- FAQ -->
        <div class="bg-cozy-brown rounded-3xl p-8 md:p-10 mb-12" x-data="{ open: null }">
            <h2 class="font-serif font-bold text-2xl text-cozy-light mb-6">Frequently Asked Questions</h2>
            <div class="space-y-3">
                @foreach ([
                    ['Can I adopt if I live in a hostel?',        'Unfortunately no — hostel and dormitory environments don\'t allow pets and can be stressful for cats. Applicants must live in off-campus or family accommodation.'],
                    ['Is there an adoption fee?',                  'There is no adoption fee. We ask that you cover the cost of spay/neuter if the cat has not yet been fixed, and initial vaccinations if due.'],
                    ['How long does the whole process take?',      'Typically 1–2 weeks from application to handover, depending on screening availability and your meet-and-greet schedule.'],
                    ['Can I adopt more than one cat?',             'Yes! Some cats are bonded pairs and do better together. Let us know in your application if you\'re open to adopting two.'],
                    ['What if the adoption doesn\'t work out?',   'We have a return policy — no questions asked. The cat\'s welfare comes first and we will work with you to find the best outcome.'],
                ] as $i => [$q, $a])
                <div class="border border-cozy-warm/20 rounded-2xl overflow-hidden">
                    <button @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                            class="w-full flex items-center justify-between px-6 py-4 text-left">
                        <span class="font-bold text-[14px] text-cozy-light">{{ $q }}</span>
                        <svg class="w-4 h-4 text-cozy-gold flex-shrink-0 transition-transform duration-200"
                             :class="open === {{ $i }} ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === {{ $i }}" x-transition class="px-6 pb-5">
                        <p class="text-[13px] text-cozy-warm/80 leading-relaxed">{{ $a }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- CTA -->
        <div class="text-center">
            <p class="font-sans text-gray-500 text-[14px] mb-5">Ready to give a campus cat a loving home?</p>
            <a href="{{ route('cats.index') }}"
               class="inline-block bg-cozy-brown text-cozy-light font-bold px-10 py-4 rounded-full shadow-lg hover:bg-cozy-accent hover:scale-105 transition-all duration-300 font-sans text-[15px]">
                Adopt a Cat Now
            </a>
        </div>

    </div>
</div>
</x-app-layout>
