<x-admin-layout>
    <div class="px-8 py-6 max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-serif font-semibold text-amber-900">Expense Tracking & Allocation</h2>
                <p class="text-sm text-gray-500 mt-1 pl-1">Manage and audit the financial flow of your sanctuary cases.</p>
            </div>
            <div>
                <button class="bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2.5 px-6 rounded-full text-sm shadow-sm transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                    New Expense
                </button>
            </div>
        </div>

        <!-- 3 Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Funds Spent -->
            <div class="bg-white rounded-[24px] p-7 shadow-sm border border-amber-50">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center text-orange-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <span class="px-3 py-1 bg-amber-50 text-amber-700 text-[11px] font-bold rounded-full">+12% vs last mo</span>
                </div>
                <div class="text-[12px] font-bold text-gray-400 tracking-wider mb-1">Total Funds Spent</div>
                <div class="text-3xl font-bold text-gray-900">RM 42,850</div>
            </div>

            <!-- Remaining Budget -->
            <div class="bg-white rounded-[24px] p-7 shadow-sm border border-cyan-50">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-10 h-10 rounded-xl bg-cyan-100 flex items-center justify-center text-cyan-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                </div>
                <div class="text-[12px] font-bold text-gray-400 tracking-wider mb-1">Remaining Budget</div>
                <div class="text-3xl font-bold text-gray-900 mb-3">RM 15,200</div>
                <div class="w-full bg-gray-100 rounded-full h-1.5">
                    <div class="bg-teal-600 h-1.5 rounded-full w-[70%]"></div>
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
                <div class="text-3xl font-bold text-gray-900 mb-4">24</div>
                <div class="flex -space-x-2">
                    <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://ui-avatars.com/api/?name=Luna&background=random" alt=""/>
                    <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://ui-avatars.com/api/?name=Milo&background=random" alt=""/>
                    <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://ui-avatars.com/api/?name=Oscar&background=random" alt=""/>
                    <div class="inline-flex h-6 w-6 items-center justify-center rounded-full ring-2 ring-white bg-gray-100 text-[10px] font-medium text-gray-500">+21</div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="flex items-center gap-4 mb-6 bg-white p-4 rounded-full shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-gray-100">
            <div class="relative flex-1 max-w-md">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" class="w-full pl-10 pr-4 py-2 bg-gray-50 border-transparent focus:border-amber-300 focus:bg-white focus:ring-0 rounded-full text-sm placeholder-gray-400" placeholder="Search by case name or vendor...">
            </div>

            <div class="relative">
                <select class="appearance-none bg-gray-50 border-transparent py-2 pl-4 pr-10 rounded-full text-sm text-gray-600 focus:ring-0 focus:border-amber-300 font-medium">
                    <option>All Categories</option>
                </select>
                <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </span>
            </div>

            <div class="relative">
                <select class="appearance-none bg-gray-50 border-transparent py-2 pl-4 pr-10 rounded-full text-sm text-gray-600 focus:ring-0 focus:border-amber-300 font-medium">
                    <option>Last 30 Days</option>
                </select>
                <span class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </span>
            </div>

            <button class="ml-auto w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
            </button>
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
                            <td class="py-5 px-4 font-medium text-gray-500 text-xs">Oct 24,<br>2023</td>
                            <td class="py-5 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Luna&background=f3f4f6&color=374151" class="w-10 h-10 rounded-full" alt="Luna">
                                    <div>
                                        <div class="font-bold text-gray-900">Luna (Rescue #402)</div>
                                        <div class="text-[11px] text-gray-500 font-medium">Dental Surgery</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5 px-4">
                                <span class="px-2.5 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold rounded tracking-wide uppercase">MEDICAL</span>
                            </td>
                            <td class="py-5 px-4 font-bold text-gray-900">1,240.00</td>
                            <td class="py-5 px-4 text-gray-500 text-xs font-medium">Vet Care Specialists</td>
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
                            <td class="py-5 px-4 font-medium text-gray-500 text-xs">Oct 22,<br>2023</td>
                            <td class="py-5 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Milo&background=fed7aa&color=c2410c" class="w-10 h-10 rounded-full" alt="Milo">
                                    <div>
                                        <div class="font-bold text-gray-900">Milo (Rescue #405)</div>
                                        <div class="text-[11px] text-gray-500 font-medium">Premium Kitten Starter</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5 px-4">
                                <span class="px-2.5 py-1 bg-orange-50 text-orange-600 text-[10px] font-bold rounded tracking-wide uppercase">FOOD</span>
                            </td>
                            <td class="py-5 px-4 font-bold text-gray-900">350.00</td>
                            <td class="py-5 px-4 text-gray-500 text-xs font-medium">Feline Nutrition Ltd.</td>
                            <td class="py-5 px-4">
                                <span class="flex items-center gap-1.5 text-amber-600 font-bold text-xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                </span>
                            </td>
                            <td class="py-5 px-4 text-center text-gray-400 relative">
                                <div class="absolute right-8 top-1/2 -translate-y-1/2">
                                    <button class="w-10 h-10 rounded-full bg-amber-800 text-white flex items-center justify-center shadow-lg hover:bg-amber-900 transition-colors z-10 relative">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </button>
                                </div>
                                <button class="hover:text-gray-600 opacity-0 pointer-events-none"><svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></button>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-5 px-4 font-medium text-gray-500 text-xs">Oct 20,<br>2023</td>
                            <td class="py-5 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Oscar&background=e5e7eb&color=374151" class="w-10 h-10 rounded-full" alt="Oscar">
                                    <div>
                                        <div class="font-bold text-gray-900">Oscar (Rescue #398)</div>
                                        <div class="text-[11px] text-gray-500 font-medium">Shelter Maintenance</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5 px-4">
                                <span class="px-2.5 py-1 bg-purple-50 text-purple-600 text-[10px] font-bold rounded tracking-wide uppercase">SHELTER</span>
                            </td>
                            <td class="py-5 px-4 font-bold text-gray-900">2,800.00</td>
                            <td class="py-5 px-4 text-gray-500 text-xs font-medium">Sanctuary BuildCo.</td>
                            <td class="py-5 px-4">
                                <span class="flex items-center gap-1.5 text-green-600 font-bold text-xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Approved
                                </span>
                            </td>
                            <td class="py-5 px-4 text-center text-gray-400">
                                <button class="hover:text-gray-600"><svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></button>
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr class="hover:bg-gray-50/50 transition border-b-transparent">
                            <td class="py-5 px-4 font-medium text-gray-500 text-xs">Oct 18,<br>2023</td>
                            <td class="py-5 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Bella&background=ffedd5&color=9a3412" class="w-10 h-10 rounded-full" alt="Bella">
                                    <div>
                                        <div class="font-bold text-gray-900">Bella (Rescue #410)</div>
                                        <div class="text-[11px] text-gray-500 font-medium">Adoption Campaign</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5 px-4">
                                <span class="px-2.5 py-1 bg-pink-50 text-pink-600 text-[10px] font-bold rounded tracking-wide uppercase">MARKETING</span>
                            </td>
                            <td class="py-5 px-4 font-bold text-gray-900">1,100.00</td>
                            <td class="py-5 px-4 text-gray-500 text-xs font-medium">Purrfect Media Agency</td>
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
                    SHOWING 1 - 10 OF 142 TRANSACTIONS
                </div>
                <div class="flex items-center gap-1">
                    <button class="w-7 h-7 flex items-center justify-center rounded text-gray-400 hover:bg-gray-50">&lsaquo;</button>
                    <button class="w-7 h-7 flex items-center justify-center rounded-full bg-amber-800 text-white text-xs font-bold shadow">1</button>
                    <button class="w-7 h-7 flex items-center justify-center rounded text-gray-500 text-xs font-medium hover:bg-gray-50">2</button>
                    <button class="w-7 h-7 flex items-center justify-center rounded text-gray-500 text-xs font-medium hover:bg-gray-50">3</button>
                    <button class="w-7 h-7 flex items-center justify-center rounded text-gray-400 hover:bg-gray-50">&rsaquo;</button>
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
