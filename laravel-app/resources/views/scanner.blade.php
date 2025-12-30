<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-boho-brown leading-tight">
            {{ __('Scan QR Code') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center">
                <div id="reader" style="width: 500px"></div>
                <div id="result" class="mt-4 font-bold text-lg text-boho-brown"></div>
                <p class="mt-2 text-sm text-gray-500">Ensure good lighting and hold the camera steady.</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function onScanSuccess(decodedText, decodedResult) {
                // Handle the scanned code as you like, for example:
                console.log(`Code matched = ${decodedText}`, decodedResult);
                document.getElementById('result').innerText = "Found: " + decodedText;

                // If it's a URL to our cats, redirect
                if (decodedText.includes('/cats/')) {
                    window.location.href = decodedText;
                }
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning.
                // console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                { fps: 10, qrbox: { width: 250, height: 250 } },
                /* verbose= */ false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });
    </script>
</x-app-layout>