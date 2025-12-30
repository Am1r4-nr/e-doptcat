<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-boho-brown leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Total Cats</div>
                    <div class="text-3xl font-bold text-boho-brown">{{ $stats['total_cats'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Available Cats</div>
                    <div class="text-3xl font-bold text-boho-brown">{{ $stats['available_cats'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Total Donations</div>
                    <div class="text-3xl font-bold text-green-600">RM {{ number_format($stats['total_donations'], 2) }}
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Pending Adoptions</div>
                    <div class="text-3xl font-bold text-orange-500">{{ $stats['pending_adoptions'] }}</div>
                </div>
            </div>

            <!-- Monthly Donations Chart (Mockup using tables for simplicity, ideally Chart.js) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                <h3 class="text-lg font-bold text-boho-brown mb-4">Monthly Donations ({{ date('Y') }})</h3>
                <div class="flex items-end space-x-2 h-40">
                    @foreach($stats['monthly_donations'] as $month => $total)
                        @php $height = ($total / (max($stats['monthly_donations']) + 1)) * 100; @endphp
                        <div class="flex flex-col items-center flex-1">
                            <div class="w-full bg-boho-cream hover:bg-boho-brown transition-colors rounded-t"
                                style="height: {{ $height }}%"></div>
                            <div class="text-xs text-gray-500 mt-1">{{ date('M', mktime(0, 0, 0, $month, 10)) }}</div>
                        </div>
                    @endforeach
                    @if(empty($stats['monthly_donations']))
                        <p class="text-gray-500 w-full text-center py-10">No donation data yet.</p>
                    @endif
                </div>
            </div>

            <!-- Recent Reports -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-boho-brown mb-4">Recent Reports</h3>
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Type</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Reporter</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Date</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats['recent_reports'] as $report)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $report->type }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $report->reporter_name }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $report->created_at->format('d M Y') }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                        <span class="relative">{{ $report->status }}</span>
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">No
                                    recent reports.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>