<x-admin-layout>
    <div class="px-8 py-6 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-cabinet font-semibold text-[#7A5320]">Donation & Fund Management</h2>
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
            <div class="bg-white rounded-[20px] p-6 shadow-sm border border-[#F0EBE3] relative overflow-hidden">
                <!-- Background decoration icon -->
                <div class="absolute -right-2 -bottom-2 text-gray-50 opacity-50">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                </div>
                <div class="relative z-10">
                    <div class="text-[11px] font-bold text-gray-400 tracking-wider mb-3">TOTAL FUNDS RAISED</div>
                    <div class="text-4xl font-bold text-amber-800 mb-3">RM {{ number_format($stats['total_donations'], 2) }}</div>
                </div>
            </div>
            <!-- Active Cases -->
            <div class="bg-white rounded-[20px] p-6 shadow-sm border border-[#F0EBE3] relative overflow-hidden">
                <div class="absolute -right-2 -bottom-2 text-gray-50 opacity-50">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                </div>
                <div class="relative z-10">
                    <div class="text-[11px] font-bold text-gray-400 tracking-wider mb-3">ACTIVE CASES</div>
                    <div class="text-4xl font-bold text-amber-800 mb-3">{{ $stats['donation_count'] }}</div>
                </div>
            </div>
            <!-- Completed Cases -->
            <div class="bg-white rounded-[20px] p-6 shadow-sm border border-[#F0EBE3] relative overflow-hidden">
                <div class="absolute -right-2 -bottom-2 text-gray-50 opacity-50">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                </div>
                <div class="relative z-10">
                    <div class="text-[11px] font-bold text-gray-400 tracking-wider mb-3">COMPLETED CASES</div>
                    <div class="text-4xl font-bold text-amber-800 mb-3">{{ $stats['completed_cases'] ?? 0 }}</div>
                </div>
            </div>
        </div>

        <!-- Recent Donations -->
        <div class="bg-white rounded-[20px] shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-[#F0EBE3] p-7 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-800 flex items-center gap-2 text-lg">
                    <svg class="w-5 h-5 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Recent Transactions
                </h3>
                <a href="#" class="text-[13px] font-bold text-[#C9A84C] hover:text-[#7A5320] transition">View All History &rsaquo;</a>
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
                            <th class="pb-4 px-4 font-bold">DONOR/ADOPTER</th>
                            <th class="pb-4 px-4 font-bold">TYPE</th>
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
                            @php
                                $isAdoption = $donation->type === 'adoption_payment';
                                $statusMap = [
                                    'success' => ['class' => 'bg-green-100 text-green-600',    'label' => 'SUCCESS'],
                                    'pending' => ['class' => 'bg-[#F5EDD8] text-[#C9A84C]',   'label' => 'PENDING'],
                                    'failed'  => ['class' => 'bg-red-100 text-red-500',        'label' => 'FAILED'],
                                ];
                                $statusKey = in_array($donation->status, array_keys($statusMap)) ? $donation->status : 'success';
                                $statusStyle = $statusMap[$statusKey];
                            @endphp
                            <tr class="hover:bg-gray-50/50 transition duration-150">
                                <td class="py-4 px-4 font-bold text-gray-800">{{ $donation->user->name ?? '—' }}</td>
                                <td class="py-4 px-4">
                                    @if($isAdoption)
                                        <span class="px-2.5 py-1 bg-blue-100 text-blue-600 text-[10px] font-bold rounded-full tracking-wider whitespace-nowrap">Adoption Payment</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-[#F5EDD8] text-[#C9A84C] text-[10px] font-bold rounded-full tracking-wider whitespace-nowrap">Donation</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-gray-500 font-medium">
                                    {{ $donation->cat?->name ?? 'General Support' }}
                                </td>
                                <td class="py-4 px-4 font-bold text-gray-900">{{ number_format($donation->amount, 2) }}</td>
                                <td class="py-4 px-4 text-gray-500 text-xs">
                                    {{ $donation->payment_method === 'fpx' ? 'Online Banking (FPX)' : ($donation->payment_method === 'card' ? 'Credit Card' : ucfirst($donation->payment_method ?? '—')) }}
                                </td>
                                <td class="py-4 px-4 text-gray-400 font-medium text-xs">
                                    {{ $donation->transaction_id ?? 'TXN-' . (998200 + $donation->id) }}
                                </td>
                                <td class="py-4 px-4 text-center">
                                    @php
                                        $statusClass = match(strtolower($donation->status)) {
                                            'completed', 'success' => 'bg-green-100 text-green-600',
                                            'pending' => 'bg-amber-100 text-amber-600',
                                            'failed' => 'bg-red-100 text-red-500',
                                            default => 'bg-gray-100 text-gray-600'
                                        };
                                        $statusLabel = strtoupper($donation->status ?? 'SUCCESS');
                                        if ($statusLabel === 'COMPLETED') $statusLabel = 'SUCCESS';
                                    @endphp
                                    <span class="px-3 py-1 {{ $statusClass }} text-[10px] font-bold rounded-full tracking-wider">{{ $statusLabel }}</span>
                                </td>
                                <td class="py-4 px-4 text-gray-500 font-medium text-xs">{{ $donation->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-8 text-gray-500 italic">No transactions found.</td>
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
        <div class="bg-white rounded-[20px] shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-[#F0EBE3] p-7"
             x-data="{
                 cases: [],
                 showForm: false,
                 deleteIdx: null,
                 form: { title: '', description: '', category: 'Kitten', goal: '', raised: 0 },
                 categories: ['Kitten', 'Senior', 'Adult', 'Stray', 'Medical'],
                 openAdd() { this.form = { title: '', description: '', category: 'Kitten', goal: '', raised: 0 }; this.showForm = true; },
                 save() {
                     if (!this.form.title || !this.form.goal) return;
                     this.cases.unshift({ ...this.form, goal: parseFloat(this.form.goal), raised: parseFloat(this.form.raised) || 0, funded: false });
                     this.showForm = false;
                 },
                 markFunded(i) { this.cases[i].funded = true; },
                 remove(i) { this.cases.splice(i, 1); this.deleteIdx = null; },
                 progress(c) { return c.goal > 0 ? Math.min((c.raised / c.goal) * 100, 100) : 0; },
                 initials(title) { return title.trim().charAt(0).toUpperCase(); },
             }">

            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-gray-800 flex items-center gap-2 text-lg">
                    <svg class="w-5 h-5 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Active Cases Tracking
                    <span class="text-sm font-semibold text-[#C9A84C] bg-[#F5EDD8] px-2 py-0.5 rounded-full" x-text="cases.length + ' cases'"></span>
                </h3>
                <button @click="openAdd()"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#C9A84C] hover:bg-[#b8963e] text-white text-xs font-bold transition shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Add Case
                </button>
            </div>

            <!-- Empty state -->
            <template x-if="cases.length === 0">
                <div class="flex flex-col items-center justify-center py-14 text-center bg-gray-50/50 rounded-[16px] border border-dashed border-gray-200">
                    <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" stroke-width="1.25" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <p class="text-sm text-gray-400 italic">No active cases yet.</p>
                    <p class="text-xs text-gray-300 mt-1">Click <span class="font-semibold">Add Case</span> to create the first funding case.</p>
                </div>
            </template>

            <!-- Cases grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-show="cases.length > 0">
                <template x-for="(c, i) in cases" :key="i">
                    <div class="border border-gray-100 rounded-[16px] p-5 hover:shadow-md transition bg-gray-50/40 relative">

                        <!-- Remove button -->
                        <button @click="deleteIdx = i"
                                class="absolute top-3 right-3 w-6 h-6 rounded-full bg-red-100 hover:bg-red-200 text-red-400 flex items-center justify-center transition">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>

                        <div class="flex items-start gap-4 mb-5 pr-6">
                            <div class="w-14 h-14 bg-[#F5EDD8] rounded-full flex items-center justify-center shrink-0 shadow-sm border border-white">
                                <span class="text-xl font-bold text-[#C9A84C]" x-text="initials(c.title)"></span>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-gray-800 text-[15px] leading-snug" x-text="c.title"></h4>
                                <p class="text-xs text-gray-500 font-medium mt-0.5 leading-snug" x-text="c.description || '—'"></p>
                                <span class="inline-block mt-1.5 px-2.5 py-0.5 bg-gray-200 text-gray-600 text-[10px] font-bold tracking-widest rounded uppercase" x-text="c.category"></span>
                            </div>
                        </div>

                        <div class="flex justify-between text-[11px] font-bold mb-2 tracking-wide">
                            <span class="text-[#C9A84C]">RM <span x-text="Number(c.raised).toFixed(2)"></span> raised</span>
                            <span class="text-gray-400">Goal: RM <span x-text="Number(c.goal).toFixed(2)"></span></span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 mb-5 shadow-inner">
                            <div class="bg-[#b8963e] h-2.5 rounded-full transition-all" :style="'width:' + progress(c) + '%'"></div>
                        </div>

                        <div class="text-center">
                            <template x-if="!c.funded && progress(c) >= 100">
                                <button @click="markFunded(i)"
                                        class="bg-amber-800 text-white text-xs font-bold py-2.5 px-8 rounded-full hover:bg-amber-900 transition shadow-sm">
                                    Mark as Funded
                                </button>
                            </template>
                            <template x-if="c.funded">
                                <span class="inline-block bg-green-100 text-green-600 text-xs font-bold py-2.5 px-8 rounded-full">Funded</span>
                            </template>
                            <template x-if="!c.funded && progress(c) < 100">
                                <span class="inline-block bg-gray-100 text-gray-400 text-xs font-bold py-2.5 px-8 rounded-full">
                                    <span x-text="progress(c).toFixed(0)"></span>% reached
                                </span>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Add Case Modal -->
            <div x-show="showForm" x-transition
                 class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
                <div @click.outside="showForm = false"
                     class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                    <div class="flex items-center justify-between mb-5">
                        <p class="text-sm font-bold text-gray-800">Add Funding Case</p>
                        <button @click="showForm = false" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Case Title <span class="text-red-400">*</span></label>
                            <input type="text" x-model="form.title" placeholder="e.g. Luna's Surgery Fund"
                                   class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300">
                        </div>
                        <div>
                            <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Description</label>
                            <input type="text" x-model="form.description" placeholder="e.g. Post-op recovery supplies"
                                   class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Category</label>
                                <select x-model="form.category"
                                        class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C]">
                                    <template x-for="cat in categories" :key="cat">
                                        <option :value="cat" x-text="cat"></option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Goal (RM) <span class="text-red-400">*</span></label>
                                <input type="number" x-model="form.goal" min="0" step="0.01" placeholder="e.g. 1500"
                                       class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300">
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] tracking-widest text-gray-400 uppercase font-semibold block mb-1">Amount Raised So Far (RM)</label>
                            <input type="number" x-model="form.raised" min="0" step="0.01" placeholder="0.00"
                                   class="w-full px-3 py-2 text-sm border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-300">
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-5">
                        <button @click="showForm = false"
                                class="px-4 py-2 text-xs font-semibold text-gray-500 border border-[#E8E2D8] rounded-xl hover:bg-gray-50 transition">
                            Cancel
                        </button>
                        <button @click="save()" :disabled="!form.title || !form.goal"
                                class="px-4 py-2 text-xs font-semibold text-white bg-[#C9A84C] hover:bg-[#b8963e] rounded-xl transition disabled:opacity-50">
                            Add Case
                        </button>
                    </div>
                </div>
            </div>

            <!-- Delete Confirmation -->
            <div x-show="deleteIdx !== null" x-transition
                 class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
                <div @click.outside="deleteIdx = null"
                     class="bg-white rounded-2xl shadow-xl w-full max-w-xs p-6 text-center">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <p class="text-sm font-bold text-gray-800 mb-1">Remove Case?</p>
                    <p class="text-xs text-gray-400 mb-5" x-text="deleteIdx !== null && cases[deleteIdx] ? cases[deleteIdx].title : ''"></p>
                    <div class="flex gap-2">
                        <button @click="deleteIdx = null"
                                class="flex-1 px-4 py-2 text-xs font-semibold text-gray-500 border border-[#E8E2D8] rounded-xl hover:bg-gray-50 transition">Cancel</button>
                        <button @click="remove(deleteIdx)"
                                class="flex-1 px-4 py-2 text-xs font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl transition">Remove</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</x-admin-layout>
