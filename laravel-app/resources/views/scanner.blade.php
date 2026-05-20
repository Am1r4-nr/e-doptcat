<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }
</style>

<div class="bg-cozy-bg min-h-screen pt-28 pb-20 relative overflow-hidden flex flex-col justify-center">
    <!-- Decorative Ambient Blobs -->
    <div class="absolute top-0 right-0 w-80 h-80 bg-cozy-warm/40 blob opacity-60 translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-cozy-accent/15 blob opacity-40 -translate-x-1/3 translate-y-1/3 pointer-events-none" style="animation-delay:-3s;"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
        <!-- Header -->
        <div class="text-center pb-8 flex-shrink-0">
            <p class="font-script text-3xl text-cozy-accent mb-1">Companion Scanner</p>
            <h2 class="font-serif font-bold text-4xl md:text-5xl text-cozy-brown mb-4">
                {{ __('Scan QR Code') }}
            </h2>
            <div class="w-20 h-1 bg-cozy-accent/60 mx-auto rounded-full mb-4"></div>
            <p class="text-cozy-brown/60 max-w-md mx-auto text-base">
                Scan QR codes located on cat collars to immediately view their location and full safety profiles.
            </p>
        </div>

        <div class="bg-cozy-card overflow-hidden shadow-xl rounded-[2.5rem] p-8 border border-cozy-warm/40 flex flex-col items-center max-w-xl mx-auto">
            <div id="reader" style="width: 100%; max-width: 400px; margin-bottom: 1.5rem;" class="overflow-hidden rounded-2xl border border-cozy-warm bg-cozy-light"></div>
            <div id="result" class="mt-2 font-serif font-bold text-lg text-cozy-brown text-center min-h-8"></div>
            <p class="mt-3 text-xs text-cozy-brown/55 text-center leading-relaxed">Ensure good lighting and hold the camera steady.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code matched = ${decodedText}`, decodedResult);
            document.getElementById('result').innerText = "✓ Found: " + decodedText;

            // If it's a URL to our cats, redirect
            if (decodedText.includes('/cats/')) {
                window.location.href = decodedText;
            }
        }

        function onScanFailure(error) {
            // Silently fail - keep scanning
        }

        if (typeof Html5QrcodeScanner !== 'undefined') {
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                { fps: 10, qrbox: { width: 250, height: 250 } },
                /* verbose= */ false
            );
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        } else {
            console.error('Html5QrcodeScanner library not loaded');
        }
    });
</script>
</x-app-layout>