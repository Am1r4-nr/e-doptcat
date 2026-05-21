<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }
    #reader video {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        border-radius: 1rem;
    }
</style>

<div class="bg-cozy-bg min-h-screen pt-28 pb-20 relative overflow-hidden flex flex-col justify-center" x-data="scannerApp()">
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
            <!-- Custom Camera Container -->
            <div class="relative w-full max-w-[320px] aspect-square rounded-2xl overflow-hidden border border-cozy-warm bg-black shadow-inner mb-5">
                <div id="reader" class="w-full h-full"></div>
                
                <!-- Scanner Scanning Overlay -->
                <div x-show="scannerActive" class="absolute inset-0 pointer-events-none z-10 flex items-center justify-center">
                    <!-- Target Box with corner borders -->
                    <div class="w-48 h-48 relative border-2 border-dashed border-cozy-accent/40 rounded-2xl flex items-center justify-center">
                        <!-- Horizontal laser scanning line -->
                        <div class="absolute w-[90%] h-0.5 bg-cozy-accent shadow-[0_0_8px_#c8956d] animate-[bounce_2s_infinite]"></div>
                    </div>
                </div>
            </div>

            <!-- Scanner Controls / Info -->
            <div class="w-full text-center space-y-4">
                <div id="result" class="font-serif font-bold text-sm text-cozy-accent min-h-6 bg-cozy-light/40 py-2.5 px-4 rounded-xl border border-cozy-warm/20 inline-block max-w-[280px]">
                    Preparing camera...
                </div>
                
                <div class="flex justify-center gap-3">
                    <button @click="startScanner" x-show="!scannerActive" class="px-5 py-2.5 bg-cozy-brown hover:bg-cozy-accent text-cozy-light font-bold text-xs rounded-xl transition-all shadow-sm">
                        Start Camera
                    </button>
                    <button @click="stopScanner" x-show="scannerActive" class="px-5 py-2.5 bg-red-100 hover:bg-red-200 text-red-700 font-bold text-xs rounded-xl transition-all shadow-sm">
                        Stop Camera
                    </button>
                    <label class="px-5 py-2.5 bg-cozy-light hover:bg-cozy-warm/30 text-cozy-brown border border-cozy-warm/40 font-bold text-xs rounded-xl transition-all shadow-sm cursor-pointer flex items-center justify-center gap-1.5">
                        <span>📁 Upload Image</span>
                        <input type="file" accept="image/*" class="hidden" @change="scanUploadedFile($event)">
                    </label>
                </div>
                
                <p class="text-xs text-cozy-brown/55 leading-relaxed max-w-[280px] mx-auto">
                    Ensure good lighting and hold the camera steady.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function scannerApp() {
        return {
            scannerActive: false,
            html5QrCode: null,

            init() {
                this.$nextTick(() => {
                    this.startScanner();
                });
            },

            startScanner() {
                if (typeof Html5Qrcode === 'undefined') {
                    console.error('Html5Qrcode library not loaded');
                    return;
                }
                
                if (!this.html5QrCode) {
                    this.html5QrCode = new Html5Qrcode("reader");
                }

                const resultEl = document.getElementById('result');
                if (resultEl) resultEl.innerText = "Requesting camera access...";

                const config = { fps: 15, qrbox: { width: 200, height: 200 } };

                this.html5QrCode.start(
                    { facingMode: "environment" }, 
                    config,
                    (decodedText, decodedResult) => {
                        this.onScanSuccess(decodedText, decodedResult);
                    },
                    (error) => {
                        // Silently keep scanning
                    }
                ).then(() => {
                    this.scannerActive = true;
                    if (resultEl) resultEl.innerText = "Align QR code inside box";
                }).catch(err => {
                    console.error("Unable to start scanner", err);
                    if (resultEl) resultEl.innerText = "⚠️ Camera access denied or not found";
                    this.scannerActive = false;
                });
            },

            stopScanner() {
                if (this.html5QrCode && this.scannerActive) {
                    this.html5QrCode.stop().then(() => {
                        this.scannerActive = false;
                        const resultEl = document.getElementById('result');
                        if (resultEl) resultEl.innerText = "Camera stopped";
                    }).catch(err => {
                        console.error("Failed to stop scanner", err);
                    });
                }
            },

            onScanSuccess(decodedText, decodedResult) {
                const resultEl = document.getElementById('result');
                if (resultEl) resultEl.innerText = "✓ Found: Redirecting...";

                this.stopScanner();

                // If it's a URL to our cats, redirect
                if (decodedText.includes('/cats/')) {
                    window.location.href = decodedText;
                } else {
                    if (resultEl) resultEl.innerText = "✓ Scanned text: " + decodedText;
                }
            },

            scanUploadedFile(event) {
                const fileList = event.target.files;
                if (fileList.length === 0) {
                    return;
                }

                if (typeof Html5Qrcode === 'undefined') {
                    console.error('Html5Qrcode library not loaded');
                    return;
                }

                if (!this.html5QrCode) {
                    this.html5QrCode = new Html5Qrcode("reader");
                }

                const proceed = () => {
                    const imageFile = fileList[0];
                    const resultEl = document.getElementById('result');
                    if (resultEl) resultEl.innerText = "Analyzing image file...";

                    this.html5QrCode.scanFile(imageFile, true)
                        .then(decodedText => {
                            this.onScanSuccess(decodedText, null);
                        })
                        .catch(err => {
                            console.error("Error scanning file", err);
                            if (resultEl) resultEl.innerText = "❌ No QR code found in this image";
                        });
                };

                if (this.scannerActive) {
                    this.html5QrCode.stop().then(() => {
                        this.scannerActive = false;
                        proceed();
                    }).catch(err => {
                        console.error("Failed to stop scanner before file upload", err);
                        proceed();
                    });
                } else {
                    proceed();
                }
            }
        }
    }
</script>
</x-app-layout>