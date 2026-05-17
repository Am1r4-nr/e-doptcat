<x-admin-layout>
<div x-data="volunteerApp()" class="relative">
    <div class="px-8 py-6 max-w-7xl mx-auto">

        <!-- Header Section -->
        <div class="flex items-start justify-between mb-10 border-b pb-8 border-[#E8E2D8]/50">
            <div>
                <h2 class="text-[32px] font-bold text-gray-900 tracking-tight">Volunteer Applications</h2>
                <p class="text-[15px] font-medium text-gray-500 mt-1 max-w-2xl">
                    Review and coordinate the compassionate individuals joining our rescue mission.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <!-- Excel import -->
                <input type="file" id="excelUpload" accept=".xlsx,.xls" class="hidden" @change="importExcel($event)">
                <button onclick="document.getElementById('excelUpload').click()"
                        class="px-5 py-2.5 rounded-full text-sm font-bold bg-white border border-[#E8E2D8] text-gray-600 hover:bg-[#FAF6F0] hover:border-[#C9A84C] hover:text-[#C9A84C] transition flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                    + Add Excel
                </button>
                <button @click="openNewOpening()"
                        class="px-6 py-2.5 rounded-full bg-[#C9A84C] text-white text-sm font-bold shadow-md shadow-amber-600/20 hover:bg-[#b8963e] transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    New Opening
                </button>
            </div>
        </div>

        <!-- 3 Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
                <div>
                    <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">ACTIVE VOLUNTEERS</div>
                    <div class="text-4xl font-bold text-amber-850">48</div>
                </div>
                <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-amber-850">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V7H4v3H1v2h3v3h2v-3h3v-2H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
            </div>
            <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
                <div>
                    <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">PENDING APPLICATIONS</div>
                    <div class="text-4xl font-bold text-[#C9A84C]">12</div>
                </div>
                <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-[#C9A84C]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                </div>
            </div>
            <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
                <div>
                    <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">ON-BOARDING</div>
                    <div class="text-4xl font-bold text-amber-850">5</div>
                </div>
                <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-amber-850">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
            </div>
        </div>

        <!-- Filters Row -->
        <div class="flex items-center gap-4 mb-6 px-1 flex-wrap">

            <!-- All Skills dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @keydown.escape="open = false"
                        class="px-4 py-2 rounded-full text-[13px] font-bold flex items-center gap-2 pr-5 transition"
                        :class="selectedSkills.length ? 'bg-[#C9A84C] text-white' : 'bg-[#EBE5DA] text-gray-700'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span x-text="selectedSkills.length ? selectedSkills.join(', ') : 'All Skills'"></span>
                    <svg class="w-3.5 h-3.5 ml-1 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" @click.outside="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute top-full mt-2 left-0 bg-white rounded-2xl shadow-lg border border-[#F0EBE3] py-2 w-48 z-10"
                     style="display:none">
                    <template x-for="skill in allSkills" :key="skill">
                        <button @click="toggleSkill(skill)"
                                class="w-full flex items-center justify-between px-4 py-2 text-[13px] font-semibold text-gray-700 hover:bg-[#FAF6F0] transition">
                            <span x-text="skill"></span>
                            <svg x-show="selectedSkills.includes(skill)" class="w-4 h-4 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </template>
                    <div class="border-t border-[#F0EBE3] mt-1 pt-1">
                        <button @click="selectedSkills = []; open = false"
                                class="w-full px-4 py-2 text-[12px] font-bold text-gray-400 hover:text-gray-600 hover:bg-[#FAF6F0] transition text-left">
                            Clear
                        </button>
                    </div>
                </div>
            </div>

            <!-- Any Availability dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @keydown.escape="open = false"
                        class="px-4 py-2 rounded-full text-[13px] font-bold flex items-center gap-2 pr-5 transition"
                        :class="selectedAvailability ? 'bg-[#C9A84C] text-white' : 'bg-[#EBE5DA] text-gray-700'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span x-text="selectedAvailability || 'Any Availability'"></span>
                    <svg class="w-3.5 h-3.5 ml-1 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" @click.outside="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute top-full mt-2 left-0 bg-white rounded-2xl shadow-lg border border-[#F0EBE3] py-2 w-44 z-10"
                     style="display:none">
                    <template x-for="avail in allAvailabilities" :key="avail">
                        <button @click="selectedAvailability = (selectedAvailability === avail ? null : avail); open = false"
                                class="w-full flex items-center justify-between px-4 py-2 text-[13px] font-semibold text-gray-700 hover:bg-[#FAF6F0] transition">
                            <span x-text="avail"></span>
                            <svg x-show="selectedAvailability === avail" class="w-4 h-4 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </template>
                    <div class="border-t border-[#F0EBE3] mt-1 pt-1">
                        <button @click="selectedAvailability = null; open = false"
                                class="w-full px-4 py-2 text-[12px] font-bold text-gray-400 hover:text-gray-600 hover:bg-[#FAF6F0] transition text-left">
                            Clear
                        </button>
                    </div>
                </div>
            </div>

            <!-- Program dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @keydown.escape="open = false"
                        class="px-4 py-2 rounded-full text-[13px] font-bold flex items-center gap-2 pr-5 transition"
                        :class="selectedProgram ? 'bg-[#C9A84C] text-white' : 'bg-[#EBE5DA] text-gray-700'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                    <span x-text="selectedProgram ? selectedProgram : 'All Programs'" class="truncate max-w-[120px]"></span>
                    <svg class="w-3.5 h-3.5 ml-1 flex-shrink-0 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" @click.outside="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute top-full mt-2 left-0 bg-white rounded-2xl shadow-lg border border-[#F0EBE3] py-2 w-56 z-10"
                     style="display:none">
                    <template x-for="prog in allPrograms" :key="prog">
                        <button @click="selectedProgram = (selectedProgram === prog ? null : prog); open = false"
                                class="w-full flex items-center justify-between px-4 py-2 text-[13px] font-semibold text-gray-700 hover:bg-[#FAF6F0] transition text-left gap-2">
                            <span x-text="prog"></span>
                            <svg x-show="selectedProgram === prog" class="w-4 h-4 text-[#C9A84C] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </template>
                    <div class="border-t border-[#F0EBE3] mt-1 pt-1">
                        <button @click="selectedProgram = null; open = false"
                                class="w-full px-4 py-2 text-[12px] font-bold text-gray-400 hover:text-gray-600 hover:bg-[#FAF6F0] transition text-left">
                            Clear
                        </button>
                    </div>
                </div>
            </div>

            <!-- Active filter tags -->
            <div class="flex items-center gap-2 flex-wrap" x-show="selectedSkills.length || selectedAvailability || selectedProgram">
                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest pl-2">ACTIVE FILTERS:</span>
                <template x-for="skill in selectedSkills" :key="skill">
                    <span class="px-3 py-1 bg-[#F5EDD8]/70 text-amber-800 text-[12px] font-bold rounded-full flex items-center gap-1.5 border border-amber-200">
                        <span x-text="skill"></span>
                        <button @click="toggleSkill(skill)" class="hover:text-[#7A5320]">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </span>
                </template>
                <template x-if="selectedAvailability">
                    <span class="px-3 py-1 bg-[#F5EDD8]/70 text-amber-800 text-[12px] font-bold rounded-full flex items-center gap-1.5 border border-amber-200">
                        <span x-text="selectedAvailability"></span>
                        <button @click="selectedAvailability = null" class="hover:text-[#7A5320]">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </span>
                </template>
                <template x-if="selectedProgram">
                    <span class="px-3 py-1 bg-[#F5EDD8]/70 text-amber-800 text-[12px] font-bold rounded-full flex items-center gap-1.5 border border-amber-200">
                        <span x-text="selectedProgram"></span>
                        <button @click="selectedProgram = null" class="hover:text-[#7A5320]">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </span>
                </template>
                <button @click="selectedSkills = []; selectedAvailability = null; selectedProgram = null"
                        class="text-[11px] font-bold text-gray-400 hover:text-gray-600 underline underline-offset-2 ml-1">
                    Clear all
                </button>
            </div>

            <div class="ml-auto flex items-center gap-3">
                <button @click="viewMode = 'grid'"
                        :class="viewMode === 'grid' ? 'text-[#C9A84C] bg-[#F5EDD8] rounded-md shadow-sm' : 'text-gray-400 hover:text-[#C9A84C]'"
                        class="p-1.5 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                </button>
                <button @click="viewMode = 'list'"
                        :class="viewMode === 'list' ? 'text-[#C9A84C] bg-[#F5EDD8] rounded-md shadow-sm' : 'text-gray-400 hover:text-[#C9A84C]'"
                        class="p-1.5 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
            </div>
        </div>

        <!-- LIST VIEW — Table -->
        <div x-show="viewMode === 'list'" class="bg-white rounded-[20px] overflow-hidden shadow-[0_2px_15px_-5px_rgba(0,0,0,0.07)] border border-[#F0EBE3]">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-[#2F2F2F]">
                        <th class="text-left px-6 py-4 text-[11px] font-bold text-white uppercase tracking-widest rounded-tl-[20px]">Applicant Profile</th>
                        <th class="text-left px-6 py-4 text-[11px] font-bold text-white uppercase tracking-widest">Matric No.</th>
                        <th class="text-left px-6 py-4 text-[11px] font-bold text-white uppercase tracking-widest">Expertise & Skills</th>
                        <th class="text-left px-6 py-4 text-[11px] font-bold text-white uppercase tracking-widest">Volunteer Program</th>
                        <th class="text-left px-6 py-4 text-[11px] font-bold text-white uppercase tracking-widest">Availability</th>
                        <th class="text-left px-6 py-4 text-[11px] font-bold text-white uppercase tracking-widest rounded-tr-[20px]">Status</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- Empty state -->
                    <template x-if="filteredVolunteers.length === 0">
                        <tr>
                            <td colspan="6" class="py-16 text-center">
                                <svg class="w-10 h-10 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0012.016 15a4.486 4.486 0 00-3.198 1.318M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/></svg>
                                <p class="text-gray-500 font-semibold text-sm">No volunteers match these filters.</p>
                                <button @click="selectedSkills = []; selectedAvailability = null"
                                        class="mt-3 text-[#C9A84C] text-sm font-bold hover:underline">Clear filters</button>
                            </td>
                        </tr>
                    </template>

                    <template x-for="(v, index) in filteredVolunteers" :key="v.id">
                        <tr class="border-t border-[#F0EBE3] hover:bg-[#FDFAF6] transition"
                            :class="selected?.id === v.id ? 'bg-[#FDF8EE]' : ''">

                            <!-- Profile -->
                            <td class="px-6 py-4">
                                <div class="font-bold text-[14px] text-gray-900" x-text="v.name"></div>
                                <div class="text-[12px] text-gray-400 font-medium mt-0.5" x-text="'Applied ' + v.applied"></div>
                            </td>

                            <!-- Matric No. -->
                            <td class="px-6 py-4 text-[13px] font-semibold text-gray-600" x-text="v.matric"></td>

                            <!-- Skills -->
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1.5">
                                    <template x-for="skill in v.skills" :key="skill.label">
                                        <span class="inline-flex bg-[#F2EDE4] px-2.5 py-1 rounded-[8px] text-[10px] font-bold text-gray-600 uppercase tracking-wider"
                                              x-text="skill.label"></span>
                                    </template>
                                </div>
                            </td>

                            <!-- Program -->
                            <td class="px-6 py-4 text-[13px] font-semibold text-gray-700" x-text="v.program"></td>

                            <!-- Availability -->
                            <td class="px-6 py-4">
                                <div class="text-[13px] font-bold text-gray-700" x-text="v.availability"></div>
                                <div class="text-[11px] text-gray-400 font-medium mt-0.5" x-text="v.availTime"></div>
                            </td>

                            <!-- Status & Action -->
                            <td class="px-6 py-4">
                                <div class="inline-flex">
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-l-lg tracking-wider uppercase border border-r-0"
                                          :class="v.statusClass" x-text="v.status"></span>
                                    <button @click="openProfile(v)"
                                            class="px-3 py-1 bg-[#EBE5DA] text-gray-600 text-[10px] font-bold rounded-r-lg tracking-wider uppercase hover:bg-[#C9A84C] hover:text-white transition border border-l-0 border-[#dfd7ca]">
                                        PROFILE
                                    </button>
                                </div>
                            </td>

                        </tr>
                    </template>

                </tbody>
            </table>
        </div>

        <!-- GRID VIEW -->
        <div x-show="viewMode === 'grid'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <template x-for="v in filteredVolunteers" :key="v.id">
                <div class="bg-white rounded-[24px] border border-[#F0EBE3] shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] flex flex-col overflow-hidden"
                     :class="selected?.id === v.id ? 'ring-2 ring-[#C9A84C]/40' : ''">

                    <!-- Card top -->
                    <div class="bg-[#FAF6F0] px-5 pt-6 pb-4 flex flex-col items-center text-center">
                        <div class="font-bold text-[15px] text-gray-900" x-text="v.name"></div>
                        <div class="text-[11px] text-gray-400 font-medium mt-0.5" x-text="'Applied ' + v.applied"></div>
                        <span class="mt-2.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider border"
                              :class="v.statusClass" x-text="v.status"></span>
                    </div>

                    <!-- Card body -->
                    <div class="px-5 py-4 flex flex-col gap-3 flex-1">

                        <!-- Skills -->
                        <div class="flex flex-wrap gap-1.5">
                            <template x-for="skill in v.skills" :key="skill.label">
                                <span class="bg-[#F2EDE4] px-2.5 py-1 rounded-[8px] text-[10px] font-bold text-gray-600 uppercase tracking-wider"
                                      x-text="skill.label"></span>
                            </template>
                        </div>

                        <!-- Program -->
                        <div class="flex items-center gap-2 text-[12px] text-gray-600 font-semibold">
                            <svg class="w-3.5 h-3.5 text-[#C9A84C] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                            <span x-text="v.program"></span>
                        </div>

                        <!-- Availability -->
                        <div class="flex items-center gap-2 text-[12px] text-gray-600 font-semibold">
                            <svg class="w-3.5 h-3.5 text-[#C9A84C] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span x-text="v.availability + ' · ' + v.availTime"></span>
                        </div>

                    </div>

                    <!-- Card footer -->
                    <div class="px-5 pb-5">
                        <button @click="openProfile(v)"
                                class="w-full py-2 rounded-full bg-[#EBE5DA] text-gray-700 text-[12px] font-bold hover:bg-[#C9A84C] hover:text-white transition">
                            View Profile
                        </button>
                    </div>

                </div>
            </template>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex items-center justify-between px-2">
            <div class="text-[12px] font-medium text-gray-500">Showing 3 of 12 pending applications</div>
            <div class="flex items-center gap-1.5">
                <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 bg-[#EBE5DA] hover:bg-gray-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                </button>
                <button class="w-8 h-8 flex items-center justify-center rounded-full bg-[#C9A84C] text-white text-[13px] font-bold shadow-md">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 bg-[#EBE5DA] hover:bg-gray-200 transition text-[13px] font-bold">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 bg-[#EBE5DA] hover:bg-gray-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </button>
            </div>
        </div>

    </div>

    <!-- ── BACKDROP ── -->
    <div x-show="open || showNewOpening || showManageSkills"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false; showNewOpening = false; showManageSkills = false"
         class="fixed inset-0 bg-black/20 backdrop-blur-[2px] z-40"
         style="display:none"></div>

    <!-- ── NEW OPENING MODAL ── -->
    <div x-show="showNewOpening"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-6"
         style="display:none">
        <div class="bg-white rounded-[28px] shadow-2xl w-full max-w-lg max-h-[90vh] flex flex-col" @click.stop>

            <!-- Modal Header -->
            <div class="flex items-center justify-between px-7 py-5 border-b border-[#F0EBE3]">
                <div>
                    <h3 class="text-[18px] font-bold text-gray-900">New Volunteer Opening</h3>
                    <p class="text-[13px] text-gray-400 mt-0.5">Create a new position for volunteers to apply to</p>
                </div>
                <button @click="showNewOpening = false"
                        class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#FAF6F0] text-gray-400 hover:text-gray-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="flex-1 overflow-y-auto px-7 py-6 space-y-5">

                <!-- Program Name -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Program Name <span class="text-red-400">*</span></label>
                    <input type="text" x-model="newOpening.program"
                           placeholder="e.g. Semester Break Cat Care"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] placeholder-gray-400">
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Description</label>
                    <textarea x-model="newOpening.description" rows="3"
                              placeholder="Describe what volunteers will be doing in this role..."
                              class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] placeholder-gray-400 resize-none"></textarea>
                </div>

                <!-- Skills Required -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Skills Required</label>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="skill in allSkills" :key="skill">
                            <span class="inline-flex items-center rounded-lg text-[11px] font-bold uppercase tracking-wider border overflow-hidden transition"
                                  :class="newOpening.skills.includes(skill)
                                      ? 'bg-[#C9A84C] text-white border-[#C9A84C]'
                                      : 'bg-[#F2EDE4] text-gray-600 border-transparent hover:border-[#C9A84C]'">
                                <button type="button"
                                        @click="toggleNewSkill(skill)"
                                        class="px-3 py-1.5"
                                        x-text="skill"></button>
                                <button type="button"
                                        @click.stop="removeSkill(skill)"
                                        class="pr-2 pl-0.5 py-1.5 transition"
                                        :class="newOpening.skills.includes(skill) ? 'text-white/60 hover:text-white' : 'text-gray-400 hover:text-red-500'"
                                        :title="'Remove ' + skill">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </span>
                        </template>

                        <!-- Add Skill inline -->
                        <button x-show="!showAddSkillInModal" type="button"
                                @click="showAddSkillInModal = true"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[11px] font-bold uppercase tracking-wider bg-white border border-dashed border-[#C9A84C] text-[#C9A84C] hover:bg-[#FAF6F0] transition">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Add Skill
                        </button>
                        <div x-show="showAddSkillInModal" class="flex items-center gap-1.5" style="display:none">
                            <input type="text"
                                   x-model="newSkillInput"
                                   @keydown.enter.prevent="addSkill(); showAddSkillInModal = false"
                                   @keydown.escape="showAddSkillInModal = false; newSkillInput = ''"
                                   placeholder="New skill..."
                                   class="px-3 py-1.5 rounded-lg border border-[#C9A84C] bg-[#FAF6F0] text-[11px] text-gray-700 focus:outline-none w-28 placeholder-gray-400">
                            <button type="button"
                                    @click="addSkill(); showAddSkillInModal = false"
                                    class="px-3 py-1.5 rounded-lg bg-[#C9A84C] text-white text-[11px] font-bold hover:bg-[#b8963e] transition">
                                Add
                            </button>
                            <button type="button"
                                    @click="showAddSkillInModal = false; newSkillInput = ''"
                                    class="px-3 py-1.5 rounded-lg bg-[#F2EDE4] text-gray-500 text-[11px] font-bold hover:bg-gray-200 transition">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Availability Days -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Availability <span class="text-red-400">*</span></label>
                    <div class="flex gap-2">
                        <template x-for="avail in allAvailabilities" :key="avail">
                            <button type="button"
                                    @click="newOpening.availability = avail"
                                    class="flex-1 py-2 rounded-xl text-[12px] font-bold transition border"
                                    :class="newOpening.availability === avail
                                        ? 'bg-[#C9A84C] text-white border-[#C9A84C]'
                                        : 'bg-[#FAF6F0] text-gray-600 border-[#E8E2D8] hover:border-[#C9A84C]'"
                                    x-text="avail"></button>
                        </template>
                    </div>
                </div>

                <!-- Time Range -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Start Time</label>
                        <input type="time" x-model="newOpening.startTime"
                               class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">End Time</label>
                        <input type="time" x-model="newOpening.endTime"
                               class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                    </div>
                </div>

                <!-- Spots Available -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Spots Available</label>
                    <input type="number" x-model="newOpening.spots" min="1" max="50"
                           placeholder="e.g. 5"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] placeholder-gray-400">
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="px-7 py-5 border-t border-[#F0EBE3] flex gap-3">
                <button @click="showNewOpening = false"
                        class="flex-1 py-2.5 rounded-full border border-[#E8E2D8] text-[13px] font-bold text-gray-500 hover:bg-[#FAF6F0] transition">
                    Cancel
                </button>
                <button @click="saveNewOpening()"
                        class="flex-1 py-2.5 rounded-full bg-[#C9A84C] text-white text-[13px] font-bold hover:bg-[#b8963e] transition shadow-md shadow-amber-600/20">
                    Create Opening
                </button>
            </div>

        </div>
    </div>

    <!-- ── MANAGE SKILLS MODAL ── -->
    <div x-show="showManageSkills"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-6"
         style="display:none">
        <div class="bg-white rounded-[28px] shadow-2xl w-full max-w-md flex flex-col max-h-[80vh]" @click.stop>

            <!-- Header -->
            <div class="flex items-center justify-between px-7 py-5 border-b border-[#F0EBE3] flex-shrink-0">
                <div>
                    <h3 class="text-[18px] font-bold text-gray-900">Manage Skills</h3>
                    <p class="text-[13px] text-gray-400 mt-0.5">Add or remove volunteer skill tags</p>
                </div>
                <button @click="showManageSkills = false"
                        class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#FAF6F0] text-gray-400 hover:text-gray-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Body -->
            <div class="flex-1 overflow-y-auto px-7 py-6">

                <!-- Add new skill input -->
                <div class="mb-5">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Add New Skill</label>
                    <div class="flex gap-2">
                        <input type="text"
                               x-model="newSkillInput"
                               @keydown.enter.prevent="addSkill()"
                               placeholder="e.g. Fundraising"
                               class="flex-1 px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] placeholder-gray-400">
                        <button @click="addSkill()"
                                class="px-4 py-2.5 rounded-xl bg-[#C9A84C] text-white text-[13px] font-bold hover:bg-[#b8963e] transition">
                            Add
                        </button>
                    </div>
                </div>

                <!-- Existing skills list -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-3">Current Skills (<span x-text="allSkills.length"></span>)</label>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="skill in allSkills" :key="skill">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#F2EDE4] text-gray-700 text-[11px] font-bold rounded-lg uppercase tracking-wider">
                                <span x-text="skill"></span>
                                <button @click="removeSkill(skill)"
                                        class="w-4 h-4 flex items-center justify-center rounded-full hover:bg-red-100 hover:text-red-500 text-gray-400 transition flex-shrink-0"
                                        :title="'Remove ' + skill">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </span>
                        </template>
                    </div>
                    <p x-show="allSkills.length === 0" class="text-[13px] text-gray-400 italic mt-2">No skills defined yet.</p>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-7 py-5 border-t border-[#F0EBE3] flex-shrink-0">
                <button @click="showManageSkills = false"
                        class="w-full py-2.5 rounded-full bg-[#C9A84C] text-white text-[13px] font-bold hover:bg-[#b8963e] transition shadow-md shadow-amber-600/20">
                    Done
                </button>
            </div>

        </div>
    </div>

    <!-- ── PROFILE SLIDE-OVER ── -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed top-0 right-0 h-full w-[420px] bg-white shadow-2xl z-50 flex flex-col"
         style="display:none">

        <template x-if="selected">
            <div class="flex flex-col flex-1 min-h-0">

            <!-- Header bar -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-[#F0EBE3] flex-shrink-0">
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest"
                   x-text="editing ? 'Edit Profile' : 'Volunteer Profile'"></p>
                <div class="flex items-center gap-2">
                    <!-- Edit toggle button (hidden while editing) -->
                    <button x-show="!editing" @click="startEdit()"
                            class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#FAF6F0] text-gray-400 hover:text-[#C9A84C] transition" title="Edit Profile">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                    </button>
                    <button @click="open = false; editing = false"
                            class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#FAF6F0] text-gray-400 hover:text-gray-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <!-- Avatar + name (view mode) -->
            <div x-show="!editing" class="flex flex-col items-center pt-8 pb-6 px-6 bg-[#FAF6F0] flex-shrink-0">
                <div class="w-20 h-20 rounded-full bg-[#E8E0D0] flex items-center justify-center text-[#8B7355] font-bold text-2xl mb-4 border-4 border-white shadow-lg"
                     x-text="selected.name.split(' ').filter((_,i)=>i<2).map(w=>w[0]).join('')"></div>
                <h3 class="text-xl font-bold text-gray-900 text-center" x-text="selected.name"></h3>
                <p class="text-sm text-gray-400 mt-0.5" x-text="'Applied ' + selected.applied"></p>
                <span class="mt-3 px-3 py-1 text-[11px] font-bold rounded-full uppercase tracking-wider"
                      :class="selected.statusClass" x-text="selected.status"></span>
            </div>

            <!-- ── VIEW MODE body ── -->
            <div x-show="!editing" class="flex-1 overflow-y-auto px-6 py-5 space-y-6">

                <!-- Matric + Contact row -->
                <div class="bg-[#FAF6F0] rounded-2xl px-4 py-4 border border-[#F0EBE3] space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center flex-shrink-0 border border-[#E8E2D8]">
                            <svg class="w-4 h-4 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"/></svg>
                        </div>
                        <div>
                            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Matric No.</div>
                            <div class="text-sm font-bold text-gray-800" x-text="selected.matric || '—'"></div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center flex-shrink-0 border border-[#E8E2D8]">
                            <svg class="w-4 h-4 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                        </div>
                        <div class="min-w-0">
                            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Email</div>
                            <div class="text-sm text-gray-700 truncate" x-text="selected.email || '—'"></div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center flex-shrink-0 border border-[#E8E2D8]">
                            <svg class="w-4 h-4 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                        </div>
                        <div>
                            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Phone</div>
                            <div class="text-sm text-gray-700" x-text="selected.phone || '—'"></div>
                        </div>
                    </div>
                </div>

                <!-- Program & Availability -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-[#FAF6F0] rounded-2xl px-4 py-3 border border-[#F0EBE3]">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Program</div>
                        <div class="text-sm font-bold text-gray-800" x-text="selected.program || '—'"></div>
                    </div>
                    <div class="bg-[#FAF6F0] rounded-2xl px-4 py-3 border border-[#F0EBE3]">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Availability</div>
                        <div class="text-sm font-bold text-gray-800" x-text="selected.availability || '—'"></div>
                        <div class="text-[11px] text-gray-500" x-text="selected.availTime"></div>
                    </div>
                </div>

                <!-- Skills -->
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3">Skills & Expertise</p>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="skill in selected.skills" :key="skill.label">
                            <span class="px-3 py-1.5 bg-[#F2EDE4] text-gray-700 text-[11px] font-bold rounded-lg uppercase tracking-wider"
                                  x-text="skill.label"></span>
                        </template>
                        <p x-show="selected.skills.length === 0" class="text-sm text-gray-400 italic">No skills listed.</p>
                    </div>
                </div>

                <!-- Bio -->
                <div x-show="selected.bio">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3">About</p>
                    <p class="text-sm text-gray-600 leading-relaxed" x-text="selected.bio"></p>
                </div>

                <!-- Experience -->
                <div x-show="selected.experience">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3">Experience</p>
                    <p class="text-sm text-gray-600 leading-relaxed" x-text="selected.experience"></p>
                </div>

            </div>

            <!-- ── EDIT MODE body ── -->
            <div x-show="editing" class="flex-1 overflow-y-auto px-6 py-5 space-y-4">

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Full Name</label>
                    <input type="text" x-model="editForm.name"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Matric No.</label>
                    <input type="text" x-model="editForm.matric"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Email</label>
                    <input type="email" x-model="editForm.email"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Phone Number</label>
                    <input type="text" x-model="editForm.phone"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Volunteer Program</label>
                    <input type="text" x-model="editForm.program"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Availability</label>
                    <div class="flex gap-2">
                        <template x-for="opt in ['Weekdays','Weekends','Flexible']" :key="opt">
                            <button type="button" @click="editForm.availability = opt"
                                    class="flex-1 py-2 rounded-xl text-[12px] font-bold transition border"
                                    :class="editForm.availability === opt ? 'bg-[#C9A84C] text-white border-[#C9A84C]' : 'bg-[#FAF6F0] text-gray-600 border-[#E8E2D8] hover:border-[#C9A84C]'"
                                    x-text="opt"></button>
                        </template>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Status</label>
                    <select x-model="editForm.status"
                            class="w-full px-4 py-2.5 rounded-xl border border-[#E8E2D8] bg-[#FAF6F0] text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C]">
                        <option value="PENDING">Pending</option>
                        <option value="INTERVIEWING">Interviewing</option>
                        <option value="APPROVED">Approved</option>
                    </select>
                </div>

            </div>

            <!-- Footer: action buttons (view) / save-cancel (edit) -->
            <div class="px-6 py-4 border-t border-[#F0EBE3] bg-white flex gap-3 flex-shrink-0">

                <!-- View mode actions -->
                <template x-if="!editing">
                    <div class="flex gap-3 w-full">
                        <button @click="updateStatus('APPROVED')"
                                class="flex-1 py-2.5 rounded-full text-[13px] font-bold transition border"
                                :class="selected.status === 'APPROVED'
                                    ? 'bg-green-100 text-green-800 border-green-300 cursor-default'
                                    : 'bg-green-50 text-green-700 hover:bg-green-100 border-green-200'">
                            Approve
                        </button>
                        <button @click="updateStatus('INTERVIEWING')"
                                class="flex-1 py-2.5 rounded-full text-[13px] font-bold transition border"
                                :class="selected.status === 'INTERVIEWING'
                                    ? 'bg-[#F5EDD8] text-[#8B6914] border-[#C9A84C] cursor-default'
                                    : 'bg-[#FAF6F0] text-[#C9A84C] hover:bg-[#F5EDD8] border-[#E8E2D8]'">
                            Schedule Interview
                        </button>
                        <button @click="updateStatus('REJECTED')"
                                class="py-2.5 px-4 rounded-full text-[13px] font-bold transition border"
                                :class="selected.status === 'REJECTED'
                                    ? 'bg-red-100 text-red-600 border-red-300 cursor-default'
                                    : 'bg-red-50 text-red-400 hover:bg-red-100 border-red-100'">
                            Reject
                        </button>
                    </div>
                </template>

                <!-- Edit mode actions -->
                <template x-if="editing">
                    <div class="flex gap-3 w-full">
                        <button @click="editing = false"
                                class="flex-1 py-2.5 rounded-full border border-[#E8E2D8] text-[13px] font-bold text-gray-500 hover:bg-[#FAF6F0] transition">
                            Cancel
                        </button>
                        <button @click="saveVolunteerEdit()"
                                class="flex-1 py-2.5 rounded-full bg-[#C9A84C] text-white text-[13px] font-bold hover:bg-[#b8963e] transition shadow-md shadow-amber-600/20">
                            Save Changes
                        </button>
                    </div>
                </template>

            </div>

            </div><!-- end x-if root -->
        </template>
    </div>

</div>

<script>
const _csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
const _api  = (url, method, body) => fetch(url, {
    method,
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _csrf },
    body: body ? JSON.stringify(body) : undefined,
}).then(r => r.json());

function volunteerApp() {
    return {
        open: false,
        selected: null,
        editing: false,
        editForm: {},
        viewMode: 'list',
        showNewOpening: false,
        showManageSkills: false,
        showAddSkillInModal: false,
        newSkillInput: '',
        newOpening: { program: '', description: '', skills: [], availability: '', startTime: '', endTime: '', spots: '' },
        selectedSkills: [],
        selectedAvailability: null,
        selectedProgram: null,
        allSkills: [
            'Fostering', 'Photography', 'Event Support', 'Social Media', 'Design',
            'Secretary', 'Treasurer', 'Programme Coordinator', 'Multimedia and Publicity',
            'Logistics', 'Safety and Welfare', 'Special Tasks', 'Transportation'
        ],
        allAvailabilities: ['Weekdays', 'Weekends', 'Flexible'],
        allPrograms: ['Semester Break Cat Care', 'Weekend Foster Care', 'Medical Assistance', 'Events & Adoption Drive', 'Social Media & Outreach'],
        volunteers: @json($volunteers),
        get filteredVolunteers() {
            return this.volunteers.filter(v => {
                const skillMatch = this.selectedSkills.length === 0 ||
                    this.selectedSkills.every(s => (v.skills||[]).some(sk => sk.label?.toLowerCase() === s.toLowerCase()));
                const availMatch = !this.selectedAvailability ||
                    (v.availability||'').toLowerCase() === this.selectedAvailability.toLowerCase();
                const programMatch = !this.selectedProgram || v.program === this.selectedProgram;
                return skillMatch && availMatch && programMatch;
            });
        },
        toggleSkill(skill) {
            const i = this.selectedSkills.findIndex(s => s.toLowerCase() === skill.toLowerCase());
            if (i === -1) this.selectedSkills.push(skill);
            else this.selectedSkills.splice(i, 1);
        },
        openNewOpening() {
            this.newOpening = { program: '', description: '', skills: [], availability: '', startTime: '09:00', endTime: '17:00', spots: '' };
            this.showAddSkillInModal = false;
            this.newSkillInput = '';
            this.showNewOpening = true;
        },
        toggleNewSkill(skill) {
            const i = this.newOpening.skills.indexOf(skill);
            if (i === -1) this.newOpening.skills.push(skill);
            else this.newOpening.skills.splice(i, 1);
        },
        saveNewOpening() {
            if (!this.newOpening.program.trim() || !this.newOpening.availability) {
                alert('Please fill in Program Name and Availability.');
                return;
            }
            if (!this.allPrograms.includes(this.newOpening.program)) {
                this.allPrograms.push(this.newOpening.program);
            }
            this.showNewOpening = false;
            alert('Opening "' + this.newOpening.program + '" created successfully!');
        },
        addSkill() {
            const skill = this.newSkillInput.trim();
            if (!skill) return;
            const exists = this.allSkills.some(s => s.toLowerCase() === skill.toLowerCase());
            if (!exists) this.allSkills.push(skill);
            this.newSkillInput = '';
        },
        removeSkill(skill) {
            this.allSkills = this.allSkills.filter(s => s !== skill);
            this.selectedSkills = this.selectedSkills.filter(s => s !== skill);
            this.newOpening.skills = this.newOpening.skills.filter(s => s !== skill);
        },
        openProfile(volunteer) {
            this.selected = volunteer;
            this.editing = false;
            this.open = true;
        },
        async updateStatus(status) {
            const res = await _api(`/admin/volunteers/${this.selected.id}/status`, 'PATCH', { status });
            if (!res.success) return;
            const idx = this.volunteers.findIndex(v => v.id === this.selected.id);
            if (idx !== -1) {
                const updated = { ...this.volunteers[idx], status, statusClass: res.statusClass };
                this.volunteers[idx] = updated;
                this.selected = updated;
            }
        },
        startEdit() {
            this.editForm = {
                name:         this.selected.name,
                matric:       this.selected.matric,
                email:        this.selected.email,
                phone:        this.selected.phone,
                program:      this.selected.program,
                availability: this.selected.availability,
                avail_time:   this.selected.availTime,
                status:       this.selected.status,
            };
            this.editing = true;
        },
        async saveVolunteerEdit() {
            if (!this.editForm.name.trim()) { alert('Name is required.'); return; }
            const res = await _api(`/admin/volunteers/${this.selected.id}`, 'PATCH', this.editForm);
            if (!res.success) return;
            const idx = this.volunteers.findIndex(v => v.id === this.selected.id);
            if (idx !== -1) {
                const updated = {
                    ...this.volunteers[idx],
                    name:         this.editForm.name,
                    matric:       this.editForm.matric,
                    email:        this.editForm.email,
                    phone:        this.editForm.phone,
                    program:      this.editForm.program,
                    availability: this.editForm.availability,
                    availTime:    this.editForm.avail_time,
                    status:       this.editForm.status,
                    statusClass:  res.statusClass,
                };
                this.volunteers[idx] = updated;
                this.selected = updated;
            }
            this.editing = false;
        },
        importExcel(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = async (e) => {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, { type: 'array' });
                const sheet = workbook.Sheets[workbook.SheetNames[0]];
                const rows = XLSX.utils.sheet_to_json(sheet, { defval: '' });

                const col = (row, ...candidates) => {
                    const keys = Object.keys(row);
                    for (const c of candidates) {
                        const match = keys.find(k => k.trim().toLowerCase() === c.trim().toLowerCase());
                        if (match !== undefined && row[match] !== '') return row[match].toString().trim();
                    }
                    return '';
                };

                const payload = [];
                rows.forEach(row => {
                    const name = col(row, 'Name', 'Full Name', 'FULL NAME', 'Nama', 'Nama Penuh');
                    if (!name) return;
                    const statusRaw = (col(row, 'Status', 'STATUS') || 'PENDING').toUpperCase();
                    payload.push({
                        name,
                        matric:       col(row, 'Matric', 'Matric No', 'Matric No.', 'Matric Number', 'MATRIC', 'No Matrik', 'No. Matrik', 'Nombor Matrik', 'matric_no'),
                        email:        col(row, 'email', 'Email', 'E-mail', 'EMAIL', 'Email Address', 'Emel'),
                        phone:        col(row, 'phone number', 'Phone Number', 'Phone', 'Phone No', 'Phone No.', 'No Phone', 'No. Phone', 'Tel', 'Telephone', 'PHONE', 'Telefon'),
                        availability: col(row, 'Availability', 'Available', 'AVAILABILITY', 'Ketersediaan'),
                        availTime:    col(row, 'Time', 'Time Range', 'Available Time', 'TIME'),
                        program:      col(row, 'Program', 'Programme', 'Volunteer Program', 'PROGRAM', 'Program Sukarela'),
                        status:       ['APPROVED','INTERVIEWING','REJECTED'].includes(statusRaw) ? statusRaw : 'PENDING',
                    });
                });

                event.target.value = '';
                if (!payload.length) { alert('No valid rows found. Make sure your Excel has a "Name" column.'); return; }

                const res = await _api('{{ route('admin.volunteers.import') }}', 'POST', { volunteers: payload });
                if (res.volunteers) {
                    this.volunteers.push(...res.volunteers);
                    alert(res.imported + ' volunteer(s) imported and saved to database.');
                }
            };
            reader.readAsArrayBuffer(file);
        },
    };
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</x-admin-layout>
