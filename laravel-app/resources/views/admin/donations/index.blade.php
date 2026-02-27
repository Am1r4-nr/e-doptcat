<x-admin-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">
            Manage Donations
        </h2>
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Total Donations</div>
                    <div class="text-3xl font-bold text-green-600">RM {{ number_format($stats['total_donations'], 2) }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Number of Donations</div>
                    <div class="text-3xl font-bold text-boho-brown">{{ $stats['donation_count'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Average Donation</div>
                    <div class="text-3xl font-bold text-blue-600">RM {{ number_format($stats['average_donation'], 2) }}</div>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Donor</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($donations as $donation)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">{{ $donation->user->name }}</td>
                                <td class="px-6 py-4">{{ $donation->user->email }}</td>
                                <td class="px-6 py-4 font-semibold text-green-600">RM {{ number_format($donation->amount, 2) }}</td>
                                <td class="px-6 py-4">{{ $donation->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('admin.donations.show', $donation) }}"
                                        class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                    <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No donations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $donations->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
