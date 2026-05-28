<x-admin-layout>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-jakarta text-3xl font-extrabold text-[#1C1A17] tracking-tight">
                Donation Details
            </h2>
            <a href="{{ route('admin.donations.index') }}"
                class="text-blue-600 hover:text-blue-900">← Back to List</a>
        </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-sm text-gray-600">Donor Name</p>
                        <p class="text-lg font-medium">{{ $donation->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="text-lg font-medium">{{ $donation->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Amount</p>
                        <p class="text-lg font-bold text-green-600">RM {{ number_format($donation->amount, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Date</p>
                        <p class="text-lg font-medium">{{ $donation->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                @if ($donation->message)
                    <div class="mb-6">
                        <p class="text-sm text-gray-600">Message</p>
                        <p class="mt-2 text-gray-700">{{ $donation->message }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
