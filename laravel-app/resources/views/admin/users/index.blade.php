<x-admin-layout>
<div x-data="staffApp()" class="px-8 py-6 max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex items-start justify-between mb-10 border-b pb-8 border-[#E8E2D8]/50">
        <div>
            <h2 class="text-[32px] font-bold text-gray-900 tracking-tight">Staff & Volunteers</h2>
            <p class="text-[15px] font-medium text-gray-500 mt-1 max-w-2xl">
                Club advisors, high committee members, and active volunteers of AHC.
            </p>
        </div>
        <div x-show="activeTab === 'staff'" class="flex items-center gap-3">
            <!-- Import button -->
            <input type="file" id="staffImportFile" accept=".xlsx,.xls,.pdf" class="hidden" @change="importStaffFile($event)">
            <button @click="document.getElementById('staffImportFile').click()"
                    class="px-5 py-2.5 rounded-full bg-white border border-[#E8E2D8] text-gray-600 text-sm font-bold hover:bg-[#FAF6F0] hover:border-[#C9A84C] hover:text-[#C9A84C] transition flex items-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Import PDF / XLSX
            </button>
            <!-- Add Staff button -->
            <button @click="openAddStaff()"
                    class="px-6 py-2.5 rounded-full bg-[#C9A84C] text-white text-sm font-bold shadow-md shadow-amber-600/20 hover:bg-[#b8963e] transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Staff
            </button>
        </div>

        <!-- Import toast -->
        <div x-show="importToast.show" x-transition
             class="fixed bottom-6 right-6 z-50 flex items-center gap-3 px-5 py-3.5 rounded-2xl shadow-xl text-sm font-bold"
             :class="importToast.ok ? 'bg-teal-600 text-white' : 'bg-red-500 text-white'"
             style="display:none">
            <svg x-show="importToast.ok" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <svg x-show="!importToast.ok" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            <span x-text="importToast.msg"></span>
        </div>
    </div>

    <!-- Stats Cards — Staff -->
    <div x-show="activeTab === 'staff'" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
            <div>
                <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">Total Staff</div>
                <div class="text-4xl font-bold text-gray-900" x-text="lecturers.length + committee.length"></div>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-[#C9A84C]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            </div>
        </div>
        <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
            <div>
                <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">Lecturers</div>
                <div class="text-4xl font-bold text-[#C9A84C]" x-text="lecturers.length"></div>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-[#C9A84C]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/></svg>
            </div>
        </div>
        <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
            <div>
                <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">High Committee</div>
                <div class="text-4xl font-bold text-gray-900" x-text="committee.length"></div>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-[#C9A84C]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            </div>
        </div>
    </div>

    <!-- Stats Cards — Volunteers -->
    <div x-show="activeTab === 'volunteers'" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10" style="display:none">
        <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
            <div>
                <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">Total Volunteers</div>
                <div class="text-4xl font-bold text-gray-900" x-text="volunteers.length"></div>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-[#C9A84C]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            </div>
        </div>
        <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
            <div>
                <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">Approved</div>
                <div class="text-4xl font-bold text-[#C9A84C]" x-text="volunteers.filter(v => v.status === 'APPROVED').length"></div>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-[#C9A84C]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
            <div>
                <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">Pending</div>
                <div class="text-4xl font-bold text-gray-900" x-text="volunteers.filter(v => v.status === 'PENDING').length"></div>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-[#C9A84C]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="flex gap-1 mb-8 bg-[#EBE5DA] rounded-full p-1 w-fit">
        <button @click="activeTab = 'staff'"
                class="px-6 py-2 rounded-full text-sm font-bold transition"
                :class="activeTab === 'staff' ? 'bg-white shadow-sm text-gray-900' : 'text-gray-500 hover:text-gray-700'">
            Staff
        </button>
        <button @click="activeTab = 'volunteers'"
                class="px-6 py-2 rounded-full text-sm font-bold transition"
                :class="activeTab === 'volunteers' ? 'bg-white shadow-sm text-gray-900' : 'text-gray-500 hover:text-gray-700'">
            Volunteers
        </button>
    </div>

    <!-- ── STAFF TAB ── -->
    <div x-show="activeTab === 'staff'">

        <!-- Lecturers -->
        <div class="mb-10">
            <div class="flex items-center gap-3 mb-5">
                <span class="px-3 py-1 bg-amber-50 border border-amber-200 text-amber-700 text-[11px] font-bold uppercase tracking-widest rounded-full">Lecturers / Club Advisors</span>
                <div class="h-px flex-1 bg-[#E8E2D8]"></div>
            </div>

            <div class="grid grid-cols-[3fr_2fr_2fr_auto] gap-4 mb-3 px-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                <div>Profile</div>
                <div>Department</div>
                <div>Contact</div>
                <div></div>
            </div>

            <div class="space-y-3">
                <template x-for="p in lecturers" :key="p.id">
                    <div class="bg-white rounded-full grid grid-cols-[3fr_2fr_2fr_auto] items-center gap-4 px-6 py-4 shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-11 h-11 rounded-full bg-[#8B7355] flex items-center justify-center text-white font-bold text-sm flex-shrink-0"
                                 x-text="p.name.split(' ').filter((_,i)=>i<2).map(w=>w[0]).join('')"></div>
                            <div class="min-w-0">
                                <div class="font-bold text-[14px] text-gray-900 truncate" x-text="p.name"></div>
                                <div class="text-[12px] text-[#C9A84C] font-semibold">Lecturer · Club Advisor</div>
                            </div>
                        </div>
                        <div class="text-[13px] text-gray-600 truncate pr-2" x-text="p.department"></div>
                        <div class="text-[13px] text-gray-600 truncate pr-2" x-text="p.email"></div>
                        <div class="flex items-center gap-2 pr-1">
                            <button @click="openEdit(p, 'lecturer')"
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-[#FAF6F0] hover:bg-[#F5EDD8] text-[#C9A84C] transition" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                            </button>
                            <button @click="deleteStaff(p, 'lecturer')"
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-red-50 hover:bg-red-100 text-red-400 hover:text-red-600 transition" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- High Committee -->
        <div>
            <div class="flex items-center gap-3 mb-5">
                <span class="px-3 py-1 bg-[#FAF6F0] border border-[#E8E2D8] text-[#8B7355] text-[11px] font-bold uppercase tracking-widest rounded-full">High Committee · AHC</span>
                <div class="h-px flex-1 bg-[#E8E2D8]"></div>
            </div>

            <div class="grid grid-cols-[2.5fr_1.5fr_2fr_2fr_auto] gap-4 mb-3 px-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                <div>Profile</div>
                <div>Position</div>
                <div>Department</div>
                <div>Contact</div>
                <div></div>
            </div>

            <div class="space-y-3">
                <template x-for="p in committee" :key="p.id">
                    <div class="bg-white rounded-full grid grid-cols-[2.5fr_1.5fr_2fr_2fr_auto] items-center gap-4 px-6 py-4 shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-11 h-11 rounded-full bg-[#C9A84C] flex items-center justify-center text-white font-bold text-sm flex-shrink-0"
                                 x-text="p.name.split(' ').filter((_,i)=>i<2).map(w=>w[0]).join('')"></div>
                            <div class="min-w-0">
                                <div class="font-bold text-[14px] text-gray-900 truncate" x-text="p.name"></div>
                                <div class="text-[12px] text-gray-400 font-medium" x-text="p.email"></div>
                            </div>
                        </div>
                        <div>
                            <span class="px-2.5 py-1 text-[10px] font-bold rounded-full uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200"
                                  x-text="p.position"></span>
                        </div>
                        <div class="text-[13px] text-gray-600 truncate pr-2" x-text="p.department || '—'"></div>
                        <div class="text-[13px] text-gray-600 truncate pr-2" x-text="p.phone"></div>
                        <div class="flex items-center gap-2 pr-1">
                            <button @click="openEdit(p, 'committee')"
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-[#FAF6F0] hover:bg-[#F5EDD8] text-[#C9A84C] transition" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                            </button>
                            <button @click="deleteStaff(p, 'committee')"
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-red-50 hover:bg-red-100 text-red-400 hover:text-red-600 transition" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

    </div>

    <!-- ── VOLUNTEERS TAB ── -->
    <div x-show="activeTab === 'volunteers'" style="display:none">

        <div class="flex items-center justify-between mb-6">
            <p class="text-[13px] text-gray-500 font-medium">Active volunteers currently serving the sanctuary.</p>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.volunteers.index') }}"
                   class="px-5 py-2 rounded-full text-[13px] font-bold bg-[#FAF6F0] border border-[#E8E2D8] text-[#C9A84C] hover:bg-[#F5EDD8] transition flex items-center gap-2">
                    View All Applications
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-[20px] border border-[#F0EBE3] overflow-hidden shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)]">
            <!-- Table Header -->
            <div class="grid grid-cols-[2.5fr_1fr_1.5fr_1.5fr_1fr_0.9fr] gap-x-4 bg-gray-900 text-white text-[11px] font-bold uppercase tracking-widest px-6 py-4">
                <div>Applicant Profile</div>
                <div>Matric No.</div>
                <div>Expertise & Skills</div>
                <div>Volunteer Program</div>
                <div>Availability</div>
                <div class="text-right">Status</div>
            </div>

            <!-- Empty State -->
            <template x-if="volunteers.length === 0">
                <div class="py-14 flex flex-col items-center text-center">
                    <svg class="w-10 h-10 text-gray-200 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                    <p class="text-gray-400 font-semibold text-sm">No volunteers yet.</p>
                    <p class="text-gray-400 text-[12px] mt-1">Add manually or upload an Excel file.</p>
                </div>
            </template>

            <!-- Rows -->
            <template x-for="(v, i) in volunteers" :key="v.id">
                <div class="grid grid-cols-[2.5fr_1fr_1.5fr_1.5fr_1fr_0.9fr] gap-x-4 items-center px-6 py-4 hover:bg-[#FAF6F0] transition"
                     :class="i < volunteers.length - 1 ? 'border-b border-[#F0EBE3]' : ''">
                    <div class="min-w-0">
                        <div class="font-semibold text-[14px] text-gray-900 truncate capitalize" style="text-transform: capitalize" x-text="v.name.toLowerCase()"></div>
                        <div class="text-[12px] text-gray-400 mt-0.5" x-text="v.applied ? 'Applied ' + v.applied : 'Applied May 17, 2026'"></div>
                    </div>
                    <div class="text-[13px] text-gray-600 truncate" x-text="v.matric || '—'"></div>
                    <div class="flex flex-wrap gap-1">
                        <template x-if="!v.skills || v.skills.length === 0">
                            <span class="text-[13px] text-gray-400">—</span>
                        </template>
                        <template x-for="sk in (v.skills || [])" :key="sk">
                            <span class="px-2 py-0.5 bg-[#F2EDE4] text-gray-600 text-[10px] font-bold rounded-md uppercase tracking-wider" x-text="sk"></span>
                        </template>
                    </div>
                    <div class="text-[13px] text-gray-600 truncate" x-text="v.program || '—'"></div>
                    <div class="text-[13px] text-gray-600 truncate" x-text="v.availability || '—'"></div>
                    <div class="flex justify-end">
                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-full uppercase tracking-wider"
                              :class="v.statusClass" x-text="v.status"></span>
                    </div>
                </div>
            </template>
        </div>

    </div>

    <!-- ── BACKDROP ── -->
    <div x-show="showAddStaff || showEditStaff || showAddVolunteer"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="showAddStaff = false; showEditStaff = false"
         class="fixed inset-0 bg-black/20 backdrop-blur-[2px] z-40"
         style="display:none"></div>

    <!-- ── EDIT STAFF MODAL ── -->
    <div x-show="showEditStaff"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-6"
         style="display:none">
        <div class="bg-white rounded-[28px] shadow-2xl w-full max-w-md flex flex-col max-h-[90vh]" @click.stop>

            <!-- Header -->
            <div class="flex items-center justify-between px-7 py-5 border-b border-[#F0EBE3] flex-shrink-0">
                <div>
                    <h3 class="text-[18px] font-bold text-gray-900">Edit Staff Member</h3>
                    <p class="text-[13px] text-gray-400 mt-0.5" x-text="editStaff.type === 'lecturer' ? 'Lecturer / Club Advisor' : 'High Committee · AHC'"></p>
                </div>
                <button @click="showEditStaff = false"
                        class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#FAF6F0] text-gray-400 hover:text-gray-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Body -->
            <div class="flex-1 overflow-y-auto px-7 py-6 space-y-5">

                <!-- Full Name -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Full Name <span class="text-red-400">*</span></label>
                    <input type="text" x-model="editStaff.name"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                </div>

                <!-- Position (committee only) -->
                <div x-show="editStaff.type === 'committee'">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Position <span class="text-red-400">*</span></label>
                    <select x-model="editStaff.position"
                            class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                        <option value="" disabled>Select a position…</option>
                        <option>President</option>
                        <option>Vice President</option>
                        <option>Secretary</option>
                        <option>Treasurer</option>
                        <option>Module</option>
                        <option>Multimedia & Publicity</option>
                        <option>Economy</option>
                        <option>Safety & Welfare</option>
                        <option>Special Tasks</option>
                    </select>
                </div>

                <!-- Department -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Department <span class="text-red-400">*</span></label>
                    <input type="text" x-model="editStaff.department"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Email <span class="text-red-400">*</span></label>
                    <input type="email" x-model="editStaff.email"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Phone</label>
                    <input type="text" x-model="editStaff.phone"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                </div>

            </div>

            <!-- Footer -->
            <div class="px-7 py-5 border-t border-[#F0EBE3] flex gap-3 flex-shrink-0">
                <button @click="showEditStaff = false"
                        class="flex-1 py-2.5 rounded-full border border-[#E8E2D8] text-[13px] font-bold text-gray-500 hover:bg-[#FAF6F0] transition">
                    Cancel
                </button>
                <button @click="saveEdit()"
                        class="flex-1 py-2.5 rounded-full bg-[#C9A84C] text-white text-[13px] font-bold hover:bg-[#b8963e] transition shadow-md shadow-amber-600/20">
                    Save Changes
                </button>
            </div>

        </div>
    </div>

    <!-- ── ADD STAFF MODAL ── -->
    <div x-show="showAddStaff"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-6"
         style="display:none">
        <div class="bg-white rounded-[28px] shadow-2xl w-full max-w-md flex flex-col max-h-[90vh]" @click.stop>

            <!-- Modal Header -->
            <div class="flex items-center justify-between px-7 py-5 border-b border-[#F0EBE3] flex-shrink-0">
                <div>
                    <h3 class="text-[18px] font-bold text-gray-900">Add Staff Member</h3>
                    <p class="text-[13px] text-gray-400 mt-0.5">Add a lecturer or committee member</p>
                </div>
                <button @click="showAddStaff = false"
                        class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#FAF6F0] text-gray-400 hover:text-gray-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="flex-1 overflow-y-auto px-7 py-6 space-y-5">

                <!-- Staff Type Toggle -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Staff Type <span class="text-red-400">*</span></label>
                    <div class="flex gap-1 bg-[#EBE5DA] rounded-full p-1">
                        <button type="button" @click="newStaff.type = 'lecturer'"
                                class="flex-1 py-2 rounded-full text-[13px] font-bold transition"
                                :class="newStaff.type === 'lecturer' ? 'bg-white shadow-sm text-gray-900' : 'text-gray-500 hover:text-gray-700'">
                            Lecturer
                        </button>
                        <button type="button" @click="newStaff.type = 'committee'"
                                class="flex-1 py-2 rounded-full text-[13px] font-bold transition"
                                :class="newStaff.type === 'committee' ? 'bg-white shadow-sm text-gray-900' : 'text-gray-500 hover:text-gray-700'">
                            High Committee
                        </button>
                    </div>
                </div>

                <!-- Full Name -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Full Name <span class="text-red-400">*</span></label>
                    <input type="text" x-model="newStaff.name"
                           placeholder="e.g. Dr. Amirah Hassan"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] placeholder-gray-400">
                </div>

                <!-- Department -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Department <span class="text-red-400">*</span></label>
                    <input type="text" x-model="newStaff.department"
                           placeholder="e.g. Faculty of Veterinary Medicine"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] placeholder-gray-400">
                </div>

                <!-- Position (Committee only) -->
                <div x-show="newStaff.type === 'committee'">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Position <span class="text-red-400">*</span></label>
                    <select x-model="newStaff.position"
                            class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                        <option value="" disabled>Select a position…</option>
                        <option>President</option>
                        <option>Vice President</option>
                        <option>Secretary</option>
                        <option>Treasurer</option>
                        <option>Module</option>
                        <option>Multimedia & Publicity</option>
                        <option>Economy</option>
                        <option>Safety & Welfare</option>
                        <option>Special Tasks</option>
                    </select>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Email <span class="text-red-400">*</span></label>
                    <input type="email" x-model="newStaff.email"
                           placeholder="e.g. name@university.edu.my"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] placeholder-gray-400">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Phone</label>
                    <input type="text" x-model="newStaff.phone"
                           placeholder="e.g. +60 12-345 6789"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] placeholder-gray-400">
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="px-7 py-5 border-t border-[#F0EBE3] flex gap-3 flex-shrink-0">
                <button @click="showAddStaff = false"
                        class="flex-1 py-2.5 rounded-full border border-[#E8E2D8] text-[13px] font-bold text-gray-500 hover:bg-[#FAF6F0] transition">
                    Cancel
                </button>
                <button @click="saveStaff()"
                        class="flex-1 py-2.5 rounded-full bg-[#C9A84C] text-white text-[13px] font-bold hover:bg-[#b8963e] transition shadow-md shadow-amber-600/20">
                    Add Member
                </button>
            </div>

        </div>
    </div>

    <!-- ── ADD VOLUNTEER MODAL ── -->
    <div x-show="showAddVolunteer"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-6"
         style="display:none">
        <div class="bg-white rounded-[28px] shadow-2xl w-full max-w-md flex flex-col max-h-[90vh]" @click.stop>

            <!-- Header -->
            <div class="flex items-center justify-between px-7 py-5 border-b border-[#F0EBE3] flex-shrink-0">
                <div>
                    <h3 class="text-[18px] font-bold text-gray-900">Add Volunteer</h3>
                    <p class="text-[13px] text-gray-400 mt-0.5">Manually register a new volunteer</p>
                </div>
                <button @click="showAddVolunteer = false"
                        class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#FAF6F0] text-gray-400 hover:text-gray-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Body -->
            <div class="flex-1 overflow-y-auto px-7 py-6 space-y-5">

                <!-- Full Name -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Full Name <span class="text-red-400">*</span></label>
                    <input type="text" x-model="newVolunteer.name" placeholder="e.g. Amirah Hassan"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] placeholder-gray-400">
                </div>

                <!-- Matric No. -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Matric No. <span class="text-red-400">*</span></label>
                    <input type="text" x-model="newVolunteer.matric" placeholder="e.g. 2021123456"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] placeholder-gray-400">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Email <span class="text-red-400">*</span></label>
                    <input type="email" x-model="newVolunteer.email" placeholder="e.g. name@student.edu.my"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] placeholder-gray-400">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Phone</label>
                    <input type="text" x-model="newVolunteer.phone" placeholder="e.g. +60 12-345 6789"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] placeholder-gray-400">
                </div>

                <!-- Program -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Volunteer Program <span class="text-red-400">*</span></label>
                    <input type="text" x-model="newVolunteer.program" placeholder="e.g. Semester Break Cat Care"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] placeholder-gray-400">
                </div>

                <!-- Availability -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Availability <span class="text-red-400">*</span></label>
                    <div class="flex gap-2">
                        <template x-for="opt in ['Weekdays','Weekends','Flexible']" :key="opt">
                            <button type="button" @click="newVolunteer.availability = opt"
                                    class="flex-1 py-2 rounded-xl text-[12px] font-bold transition border"
                                    :class="newVolunteer.availability === opt ? 'bg-[#C9A84C] text-white border-[#C9A84C]' : 'bg-[#FAF6F0] text-gray-600 border-[#E8E2D8] hover:border-[#C9A84C]'"
                                    x-text="opt"></button>
                        </template>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Status</label>
                    <select x-model="newVolunteer.status"
                            class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                        <option value="PENDING">Pending</option>
                        <option value="INTERVIEWING">Interviewing</option>
                        <option value="APPROVED">Approved</option>
                    </select>
                </div>

            </div>

            <!-- Footer -->
            <div class="px-7 py-5 border-t border-[#F0EBE3] flex gap-3 flex-shrink-0">
                <button @click="showAddVolunteer = false"
                        class="flex-1 py-2.5 rounded-full border border-[#E8E2D8] text-[13px] font-bold text-gray-500 hover:bg-[#FAF6F0] transition">
                    Cancel
                </button>
                <button @click="saveVolunteer()"
                        class="flex-1 py-2.5 rounded-full bg-[#C9A84C] text-white text-[13px] font-bold hover:bg-[#b8963e] transition shadow-md shadow-amber-600/20">
                    Add Volunteer
                </button>
            </div>

        </div>
    </div>

</div>

<script>
function staffApp() {
    return {
        activeTab: 'staff',
        showAddStaff: false,
        showEditStaff: false,
        showAddVolunteer: false,
        importToast: { show: false, ok: true, msg: '' },
        newStaff: { type: 'lecturer', name: '', department: '', position: '', email: '', phone: '' },
        newVolunteer: { name: '', matric: '', email: '', phone: '', program: '', availability: '', status: 'PENDING' },
        editStaff: { id: null, type: '', name: '', department: '', position: '', email: '', phone: '' },
        lecturers: @json($lecturers),
        committee: @json($committee),
        showToast(ok, msg) {
            this.importToast = { show: true, ok, msg };
            setTimeout(() => this.importToast.show = false, 4000);
        },
        async importStaffFile(event) {
            const file = event.target.files[0];
            event.target.value = '';
            if (!file) return;

            const ext = file.name.split('.').pop().toLowerCase();

            /* ── PDF: upload to server for storage ── */
            if (ext === 'pdf') {
                const fd = new FormData();
                fd.append('file', file);
                fd.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                try {
                    const res = await fetch('{{ route("admin.users.importStaff") }}', { method: 'POST', body: fd });
                    const data = await res.json();
                    if (data.success) {
                        this.showToast(true, `PDF "${data.name}" uploaded for reference.`);
                    } else {
                        this.showToast(false, 'Upload failed. Please try again.');
                    }
                } catch (e) {
                    this.showToast(false, 'Upload failed. Please try again.');
                }
                return;
            }

            /* ── XLSX / XLS: parse with SheetJS and batch-save to DB ── */
            if (!window.XLSX) {
                this.showToast(false, 'XLSX library not loaded. Please refresh.');
                return;
            }
            const reader = new FileReader();
            reader.onload = async (e) => {
                try {
                    const wb   = XLSX.read(e.target.result, { type: 'array' });
                    const ws   = wb.Sheets[wb.SheetNames[0]];
                    const rows = XLSX.utils.sheet_to_json(ws, { defval: '' });

                    const staffRows = rows.map(row => {
                        const r = Object.fromEntries(Object.entries(row).map(([k,v]) => [k.toLowerCase().trim(), String(v).trim()]));
                        const type = (r.type || r.role || 'committee').toLowerCase();
                        const name  = r.name || r['full name'] || '';
                        const email = r.email || r['e-mail'] || '';
                        if (!name || !email) return null;
                        return {
                            type:       (type === 'lecturer' || type === 'advisor') ? 'lecturer' : 'committee',
                            name,
                            email,
                            department: r.department || r.faculty || '',
                            phone:      r.phone || r['phone number'] || '',
                            position:   r.position || '',
                        };
                    }).filter(Boolean);

                    if (staffRows.length === 0) {
                        this.showToast(false, 'No valid rows found. Ensure the file has name and email columns.');
                        return;
                    }

                    const res = await fetch('{{ route("admin.staff.batch") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({ rows: staffRows }),
                    });
                    const data = await res.json();
                    if (data.success) {
                        data.staff.forEach(s => {
                            if (s.type === 'lecturer') this.lecturers.push(s);
                            else this.committee.push(s);
                        });
                        this.showToast(true, `Imported ${data.count} staff member${data.count !== 1 ? 's' : ''} from "${file.name}".`);
                    } else {
                        this.showToast(false, 'Import failed. Please check the file format.');
                    }
                } catch (err) {
                    this.showToast(false, 'Could not parse file. Check the format and try again.');
                }
            };
            reader.readAsArrayBuffer(file);
        },
        async deleteStaff(person, type) {
            if (!confirm(`Delete ${person.name}? This cannot be undone.`)) return;
            try {
                const res = await fetch(`{{ url('admin/staff') }}/${person.id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                });
                const data = await res.json();
                if (data.success) {
                    if (type === 'lecturer') this.lecturers = this.lecturers.filter(p => p.id !== person.id);
                    else this.committee = this.committee.filter(p => p.id !== person.id);
                }
            } catch (e) {
                alert('Failed to delete. Please try again.');
            }
        },
        openEdit(person, type) {
            this.editStaff = {
                id: person.id,
                type: type,
                name: person.name,
                department: person.department || '',
                position: person.position || '',
                email: person.email,
                phone: person.phone || '',
            };
            this.showEditStaff = true;
        },
        async saveEdit() {
            if (!this.editStaff.name.trim() || !this.editStaff.email.trim() || !this.editStaff.department.trim()) {
                alert('Please fill in Name, Department, and Email.');
                return;
            }
            if (this.editStaff.type === 'committee' && !this.editStaff.position) {
                alert('Please select a Position.');
                return;
            }
            try {
                const res = await fetch(`{{ url('admin/staff') }}/${this.editStaff.id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        name:       this.editStaff.name.trim(),
                        email:      this.editStaff.email.trim(),
                        department: this.editStaff.department.trim(),
                        position:   this.editStaff.position || null,
                        phone:      this.editStaff.phone.trim(),
                    }),
                });
                const data = await res.json();
                if (data.success) {
                    const list = this.editStaff.type === 'lecturer' ? this.lecturers : this.committee;
                    const idx = list.findIndex(p => p.id === this.editStaff.id);
                    if (idx !== -1) {
                        list[idx] = data.staff;
                        if (this.editStaff.type === 'lecturer') this.lecturers = [...this.lecturers];
                        else this.committee = [...this.committee];
                    }
                    this.showEditStaff = false;
                }
            } catch (e) {
                alert('Failed to save. Please try again.');
            }
        },
        openAddStaff() {
            this.newStaff = { type: 'lecturer', name: '', department: '', position: '', email: '', phone: '' };
            this.showAddStaff = true;
        },
        openAddVolunteer() {
            this.newVolunteer = { name: '', matric: '', email: '', phone: '', program: '', availability: '', status: 'PENDING' };
            this.showAddVolunteer = true;
        },
        saveVolunteer() {
            if (!this.newVolunteer.name.trim() || !this.newVolunteer.matric.trim() || !this.newVolunteer.program.trim() || !this.newVolunteer.availability) {
                alert('Please fill in Name, Matric No., Program and Availability.');
                return;
            }
            const statusMap = {
                'APPROVED':    'bg-green-50 text-green-600 border border-green-100',
                'PENDING':     'bg-cyan-50 text-cyan-600 border border-cyan-100',
                'INTERVIEWING':'bg-[#FAF8F0] text-[#C9A84C] border border-[#E8E2D8]',
            };
            this.volunteers.push({
                id: Date.now(),
                name: this.newVolunteer.name,
                matric: this.newVolunteer.matric,
                email: this.newVolunteer.email,
                phone: this.newVolunteer.phone,
                program: this.newVolunteer.program,
                availability: this.newVolunteer.availability,
                availTime: '',
                status: this.newVolunteer.status,
                statusClass: statusMap[this.newVolunteer.status] || statusMap['PENDING'],
                skills: [],
                applied: new Date().toLocaleDateString('en-GB', { day:'2-digit', month:'short', year:'numeric' }),
            });
            this.showAddVolunteer = false;
        },
        async saveStaff() {
            if (!this.newStaff.name.trim() || !this.newStaff.email.trim()) {
                alert('Please fill in Name and Email.');
                return;
            }
            if (!this.newStaff.department.trim()) { alert('Please fill in Department.'); return; }
            if (this.newStaff.type === 'committee' && !this.newStaff.position) {
                alert('Please select a Position.');
                return;
            }
            try {
                const res = await fetch('{{ route("admin.staff.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        type:       this.newStaff.type,
                        name:       this.newStaff.name.trim(),
                        email:      this.newStaff.email.trim(),
                        department: this.newStaff.department.trim(),
                        position:   this.newStaff.position || null,
                        phone:      this.newStaff.phone.trim(),
                    }),
                });
                const data = await res.json();
                if (data.success) {
                    if (data.staff.type === 'lecturer') this.lecturers.push(data.staff);
                    else this.committee.push(data.staff);
                    this.showAddStaff = false;
                }
            } catch (e) {
                alert('Failed to save. Please try again.');
            }
        },
        volunteers: @json($volunteers),
    };
}
</script>
<script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
</x-admin-layout>
