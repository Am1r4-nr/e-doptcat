<x-admin-layout>
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-5">
            <div>
                <h2 class="font-jakarta text-3xl font-extrabold text-[#1C1A17] tracking-tight">Expense Tracking & Allocation</h2>
                <p class="text-sm text-gray-500 mt-1 pl-1">Manage and audit the financial flow of your sanctuary cases.</p>
            </div>
            <div>
                <button class="bg-[#C9A84C] hover:bg-[#b8963e] text-white font-semibold py-2.5 px-6 rounded-full text-sm shadow-sm transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                    New Expense
                </button>
            </div>
        </div>

        <!-- 3 Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Funds Spent -->
            <div class="bg-white rounded-[24px] p-7 shadow-sm border border-[#F0EBE3]">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center text-orange-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <span class="px-3 py-1 bg-green-50 text-green-700 text-[11px] font-bold rounded-full">Within Budget</span>
                </div>
                <div class="text-[12px] font-bold text-gray-400 tracking-wider mb-1">Total Funds Spent</div>
                <div class="text-3xl font-bold text-gray-900">RM 12,450.00</div>
            </div>

            <!-- Remaining Budget -->
            <div class="bg-white rounded-[24px] p-7 shadow-sm border border-cyan-50">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-10 h-10 rounded-xl bg-cyan-100 flex items-center justify-center text-cyan-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                </div>
                <div class="text-[12px] font-bold text-gray-400 tracking-wider mb-1">Remaining Budget</div>
                <div class="text-3xl font-bold text-gray-900 mb-3">RM 8,550.00</div>
                <div class="w-full bg-gray-100 rounded-full h-1.5">
                    <div class="bg-teal-600 h-1.5 rounded-full w-[60%]"></div>
                </div>
            </div>

            <!-- Active Rescue Cases -->
            <div class="bg-white rounded-[24px] p-7 shadow-sm border border-gray-100">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>
                <div class="text-[12px] font-bold text-gray-400 tracking-wider mb-1">Active Rescue Cases</div>
                <div class="text-3xl font-bold text-gray-900 mb-4">12</div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-[24px] shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-gray-100 p-8 mb-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="text-[10px] text-gray-400 uppercase font-bold tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="pb-4 px-4">DATE</th>
                            <th class="pb-4 px-4">CASE NAME</th>
                            <th class="pb-4 px-4">CATEGORY</th>
                            <th class="pb-4 px-4">AMOUNT (RM)</th>
                            <th class="pb-4 px-4">RECIPIENT</th>
                            <th class="pb-4 px-4">STATUS</th>
                            <th class="pb-4 px-4 text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <!-- Row 1 -->
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-5 px-4 font-medium text-gray-500 text-xs">May 12,<br>2026</td>
                            <td class="py-5 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center font-bold text-amber-700">B</div>
                                    <div>
                                        <div class="font-bold text-gray-900">Bits (Rescue #882)</div>
                                        <div class="text-[11px] text-gray-500 font-medium">GPS Tracker Installation</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5 px-4">
                                <span class="px-2.5 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold rounded tracking-wide uppercase">EQUIPMENT</span>
                            </td>
                            <td class="py-5 px-4 font-bold text-gray-900">250.00</td>
                            <td class="py-5 px-4 text-gray-500 text-xs font-medium">SafeTrack Solutions</td>
                            <td class="py-5 px-4">
                                <span class="flex items-center gap-1.5 text-green-600 font-bold text-xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Approved
                                </span>
                            </td>
                            <td class="py-5 px-4 text-center text-gray-400">
                                <button class="hover:text-gray-600"><svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></button>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-5 px-4 font-medium text-gray-500 text-xs">May 10,<br>2026</td>
                            <td class="py-5 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center font-bold text-orange-700">M</div>
                                    <div>
                                        <div class="font-bold text-gray-900">Bits's Diet Case</div>
                                        <div class="text-[11px] text-gray-500 font-medium">Specialized Kidney Food</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5 px-4">
                                <span class="px-2.5 py-1 bg-orange-50 text-orange-600 text-[10px] font-bold rounded tracking-wide uppercase">FOOD</span>
                            </td>
                            <td class="py-5 px-4 font-bold text-gray-900">420.00</td>
                            <td class="py-5 px-4 text-gray-500 text-xs font-medium">PetMart Supplies</td>
                            <td class="py-5 px-4">
                                <span class="flex items-center gap-1.5 text-[#C9A84C] font-bold text-xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#FAF8F0]0"></span> Pending
                                </span>
                            </td>
                            <td class="py-5 px-4 text-center text-gray-400">
                                <button class="hover:text-gray-600"><svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></button>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-5 px-4 font-medium text-gray-500 text-xs">May 05,<br>2026</td>
                            <td class="py-5 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center font-bold text-purple-700">S</div>
                                    <div>
                                        <div class="font-bold text-gray-900">Shelter Upgrade</div>
                                        <div class="text-[11px] text-gray-500 font-medium">Ventilation System Fix</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5 px-4">
                                <span class="px-2.5 py-1 bg-purple-50 text-purple-600 text-[10px] font-bold rounded tracking-wide uppercase">MAINTENANCE</span>
                            </td>
                            <td class="py-5 px-4 font-bold text-gray-900">1,850.00</td>
                            <td class="py-5 px-4 text-gray-500 text-xs font-medium">BuildSafe Engineering</td>
                            <td class="py-5 px-4">
                                <span class="flex items-center gap-1.5 text-green-600 font-bold text-xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Approved
                                </span>
                            </td>
                            <td class="py-5 px-4 text-center text-gray-400">
                                <button class="hover:text-gray-600"><svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between mt-6 pt-6 border-t border-gray-50">
                <div class="text-[10px] font-bold text-gray-400 tracking-wider uppercase">
                    SHOWING 3 OF 3 TRANSACTIONS
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center text-[10px] font-medium text-gray-400 px-2 mt-12 pb-4">
            <div>&copy; 2023 Financial Sanctuary - An e-Doptcat Premium Management Service</div>
            <div class="flex gap-4">
                <a href="#" class="hover:text-gray-600">Privacy Protocol</a>
                <a href="#" class="hover:text-gray-600">Audit Logs</a>
                <a href="#" class="hover:text-gray-600">System Status</a>
            </div>
        </div>

    </div>
</x-admin-layout>
