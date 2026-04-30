<x-admin-layout>
    <div class="px-8 py-6 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-serif font-semibold text-amber-900">Donation & Fund Management</h2>
                <p class="text-sm text-gray-500 mt-1 pl-1">Real-time overview of kitten rescue contributions</p>
            </div>
            <!-- Search placeholder -->
            <div class="relative hidden sm:block">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" class="pl-10 pr-4 py-2 border border-gray-100 bg-gray-50 rounded-full text-sm focus:ring-amber-500 focus:bg-white w-64 shadow-sm" placeholder="Search transactions...">
                <div class="absolute inset-y-0 right-1 flex items-center pr-2">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Admin" class="w-7 h-7 rounded-full ml-2">
                </div>
            </div>
        </div>

        <!-- 3 Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Funds -->
            <div class="bg-white rounded-[20px] p-6 shadow-sm border border-amber-50 relative overflow-hidden">
                <!-- Background decoration icon -->
                <div class="absolute -right-2 -bottom-2 text-gray-50 opacity-50">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                </div>
                <div class="relative z-10">
                    <div class="text-[11px] font-bold text-gray-400 tracking-wider mb-3">TOTAL FUNDS RAISED</div>
                    <div class="text-4xl font-bold text-amber-800 mb-3">RM {{ number_format($stats['total_donations'], 2) }}</div>
                    <div class="text-xs text-green-500 font-semibold flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        12% from last month
                    </div>
                </div>
            </div>
            <!-- Active Cases -->
            <div class="bg-white rounded-[20px] p-6 shadow-sm border border-amber-50 relative overflow-hidden">
                <div class="absolute -right-2 -bottom-2 text-gray-50 opacity-50">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                </div>
                <div class="relative z-10">
                    <div class="text-[11px] font-bold text-gray-400 tracking-wider mb-3">ACTIVE CASES</div>
                    <div class="text-4xl font-bold text-amber-800 mb-3">{{ $stats['donation_count'] }}</div>
                    <div class="text-xs text-gray-400 font-medium tracking-wide">18 kittens awaiting full funding</div>
                </div>
            </div>
            <!-- Completed Cases -->
            <div class="bg-white rounded-[20px] p-6 shadow-sm border border-amber-50 relative overflow-hidden">
                <div class="absolute -right-2 -bottom-2 text-gray-50 opacity-50">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                </div>
                <div class="relative z-10">
                    <div class="text-[11px] font-bold text-gray-400 tracking-wider mb-3">COMPLETED CASES</div>
                    <div class="text-4xl font-bold text-amber-800 mb-3">156</div>
                    <div class="text-xs text-gray-400 font-medium tracking-wide">Fully adopted & medical bills cleared</div>
                </div>
            </div>
        </div>

        <!-- Recent Donations -->
        <div class="bg-white rounded-[20px] shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-amber-50 p-7 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-800 flex items-center gap-2 text-lg">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Recent Donations
                </h3>
                <a href="#" class="text-[13px] font-bold text-amber-700 hover:text-amber-900 transition">View All History &rsaquo;</a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 text-green-700 rounded-xl text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="text-[11px] text-gray-400 uppercase font-bold tracking-wider">
                        <tr>
                            <th class="pb-4 px-4 font-bold">DONOR NAME</th>
                            <th class="pb-4 px-4 font-bold">CAT CASE</th>
                            <th class="pb-4 px-4 font-bold">AMOUNT (RM)</th>
                            <th class="pb-4 px-4 font-bold">METHOD</th>
                            <th class="pb-4 px-4 font-bold">TRANSACTION ID</th>
                            <th class="pb-4 px-4 font-bold text-center">STATUS</th>
                            <th class="pb-4 px-4 font-bold">DATE</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($donations as $donation)
                            <tr class="hover:bg-gray-50/50 transition duration-150">
                                <td class="py-4 px-4 font-bold text-gray-800">{{ $donation->user->name }}</td>
                                <td class="py-4 px-4 text-gray-500 font-medium">
                                    {{-- Use dummy data or real case if available --}}
                                    {{ ['Luna\'s Surgery', 'Winter Recovery', 'Shelter Kibbles', 'Felix Eye Care'][array_rand(['Luna\'s Surgery', 'Winter Recovery', 'Shelter Kibbles', 'Felix Eye Care'])] }}
                                </td>
                                <td class="py-4 px-4 font-bold text-gray-900">{{ number_format($donation->amount, 2) }}</td>
                                <td class="py-4 px-4 text-gray-500 text-xs">
                                    {{-- Use dummy text --}}
                                    {{ ['Online Banking', 'Credit Card', 'E-Wallet'][$donation->id % 3] }}
                                </td>
                                <td class="py-4 px-4 text-gray-400 font-medium text-xs">TXN-{{ 998200 + $donation->id }}</td>
                                <td class="py-4 px-4 text-center">
                                    @php
                                        $statuses = [
                                            ['class' => 'bg-green-100 text-green-600', 'label' => 'SUCCESS'],
                                            ['class' => 'bg-amber-100 text-amber-600', 'label' => 'PENDING'],
                                            ['class' => 'bg-red-100 text-red-500', 'label' => 'FAILED']
                                        ];
                                        $status = $statuses[$donation->id % 3 == 0 ? array_rand($statuses) : 0]; // heavily favor SUCCESS
                                    @endphp
                                    <span class="px-3 py-1 {{ $status['class'] }} text-[10px] font-bold rounded-full tracking-wider">{{ $status['label'] }}</span>
                                </td>
                                <td class="py-4 px-4 text-gray-500 font-medium text-xs">{{ $donation->created_at->format('M d, Y') }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-8 text-gray-500">No donations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $donations->links() }}
            </div>
        </div>

        <!-- Active Cases Tracking -->
        <div class="bg-white rounded-[20px] shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-amber-50 p-7">
            <h3 class="font-bold text-gray-800 flex items-center gap-2 mb-6 text-lg">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Active Cases Tracking
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Case 1 -->
                <div class="border border-gray-100 rounded-[16px] p-5 hover:shadow-md transition bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTAgMGgyNHYyNEgweiIgZmlsbD0ibm9uZSIvPjwvc3ZnPg==')] bg-gray-50/40">
                    <div class="flex justify-between items-start mb-5">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-amber-100 rounded-full overflow-hidden shrink-0 shadow-sm border border-white">
                                <!-- Uses unstyled UI avatar as placeholder -->
                                <img src="https://ui-avatars.com/api/?name=M&background=fde68a&color=92400e" alt="Milo" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-[15px]">Milo's Specialized Diet Fund</h4>
                                <p class="text-xs text-gray-500 font-medium mt-0.5">Post-op kidney care supplies</p>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 bg-gray-200 text-gray-600 text-[10px] font-bold tracking-widest rounded shrink-0 uppercase">KITTEN</span>
                    </div>
                    <div class="flex justify-between text-[11px] font-bold mb-2.5 tracking-wide">
                        <span class="text-amber-700">RM 2,850.00 raised</span>
                        <span class="text-gray-400">Goal: RM 3,000.00</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2.5 mb-5 shadow-inner">
                        <div class="bg-amber-700 h-2.5 rounded-full" style="width: 95%"></div>
                    </div>
                    <div class="text-center">
                        <button class="bg-amber-800 text-white text-xs font-bold py-2.5 px-8 rounded-full hover:bg-amber-900 transition shadow-sm">Mark as Funded</button>
                    </div>
                </div>

                <!-- Case 2 -->
                <div class="border border-gray-100 rounded-[16px] p-5 hover:shadow-md transition bg-gray-50/40">
                    <div class="flex justify-between items-start mb-5">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-gray-200 rounded-full overflow-hidden shrink-0 shadow-sm border border-white">
                                <img src="https://ui-avatars.com/api/?name=S&background=e5e7eb&color=374151" alt="Snowy" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-[15px]">Snowy's Dental Treatment</h4>
                                <p class="text-xs text-gray-500 font-medium mt-0.5">Advanced molar extraction</p>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 bg-gray-200 text-gray-600 text-[10px] font-bold tracking-widest rounded shrink-0 uppercase">SENIOR</span>
                    </div>
                    <div class="flex justify-between text-[11px] font-bold mb-2.5 tracking-wide">
                        <span class="text-amber-700">RM 420.00 raised</span>
                        <span class="text-gray-400">Goal: RM 1,200.00</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2.5 mb-5 shadow-inner">
                        <div class="bg-amber-700 h-2.5 rounded-full" style="width: 35%"></div>
                    </div>
                    <div class="text-center">
                        <button class="bg-gray-100 text-gray-400 text-xs font-bold py-2.5 px-8 rounded-full cursor-not-allowed">Goal not reached</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
