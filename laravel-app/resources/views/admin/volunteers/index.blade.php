<x-admin-layout>
    <div class="px-8 py-6 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex items-start justify-between mb-10 border-b pb-8 border-amber-100/50">
            <div>
                <h2 class="text-[32px] font-bold text-gray-900 tracking-tight">Volunteer Applications</h2>
                <p class="text-[15px] font-medium text-gray-500 mt-1 max-w-2xl">
                    Review and coordinate the compassionate individuals joining our rescue mission.
                </p>
            </div>
            <button class="px-6 py-2.5 rounded-full bg-amber-600 text-white text-sm font-bold shadow-md shadow-amber-600/20 hover:bg-amber-700 transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                New Opening
            </button>
        </div>

        <!-- 3 Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- ACTIVE VOLUNTEERS -->
            <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-amber-50">
                <div>
                    <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">ACTIVE VOLUNTEERS</div>
                    <div class="text-4xl font-bold text-amber-850">48</div>
                </div>
                <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-amber-850">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V7H4v3H1v2h3v3h2v-3h3v-2H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
            </div>

            <!-- PENDING APPLICATIONS -->
            <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-amber-50">
                <div>
                    <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">PENDING APPLICATIONS</div>
                    <div class="text-4xl font-bold text-amber-600">12</div>
                </div>
                <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-amber-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                </div>
            </div>

            <!-- ON-BOARDING -->
            <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-amber-50">
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
        <div class="flex items-center gap-4 mb-6 px-1">
            <button class="bg-[#EBE5DA] px-4 py-2 rounded-full text-[13px] font-bold text-gray-700 flex items-center gap-2 pr-5">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                All Skills
                <svg class="w-3.5 h-3.5 ml-1 text-gray-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <button class="bg-[#EBE5DA] px-4 py-2 rounded-full text-[13px] font-bold text-gray-700 flex items-center gap-2 pr-5">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Any Availability
                <svg class="w-3.5 h-3.5 ml-1 text-gray-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>

            <div class="flex items-center gap-2 ml-4">
                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest pl-2">ACTIVE FILTERS:</span>
                <span class="px-3 py-1 bg-amber-100/70 text-amber-800 text-[12px] font-bold rounded-full flex items-center gap-1.5 border border-amber-200 ml-1">
                    Fostering
                    <button class="hover:text-amber-900"><svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                </span>
            </div>

            <div class="ml-auto flex items-center gap-3">
                <button class="p-1.5 text-gray-400 hover:text-amber-850 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                </button>
                <button class="p-1.5 text-amber-850 bg-amber-100 rounded-md transition shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
            </div>
        </div>

        <!-- Fake Header Row matching card columns -->
        <div class="grid grid-cols-[3fr_2fr_2fr_2fr] gap-4 mb-3 px-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
            <div>APPLICANT PROFILE</div>
            <div>EXPERTISE & SKILLS</div>
            <div>AVAILABILITY</div>
            <div class="text-right">STATUS</div>
        </div>

        <!-- Data Rows via Cards -->
        <div class="space-y-4">

            <!-- Row 1 -->
            <div class="bg-white rounded-full flex items-center px-6 py-5 shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-amber-50">
                <!-- Profile -->
                <div class="flex items-center gap-4 w-[35%]">
                    <img src="https://i.pravatar.cc/150?u=sarah" alt="Sarah" class="w-12 h-12 rounded-full border-2 border-[#FAF6F0] object-cover">
                    <div>
                        <div class="font-bold text-[15px] text-gray-900">Sarah Jenkins</div>
                        <div class="text-[12.5px] text-gray-400 font-medium">Applied Oct 12, 2023</div>
                    </div>
                </div>

                <!-- Skills -->
                <div class="w-[25%] flex flex-col gap-1.5">
                    <div class="flex items-center">
                        <span class="inline-flex items-center gap-1.5 bg-[#F2EDE4] px-2.5 py-1 rounded-[8px] text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            FOSTERING
                        </span>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-flex items-center gap-1.5 bg-[#F2EDE4] px-2.5 py-1 rounded-[8px] text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            PHOTOGRAPHY
                        </span>
                    </div>
                </div>

                <!-- Availability -->
                <div class="w-[20%] flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-800" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-[13.5px] font-bold text-gray-700">Weekends</span>
                </div>

                <!-- Status & Action -->
                <div class="w-[20%] flex flex-col items-end gap-2 pr-2">
                    <div class="inline-flex">
                        <span class="px-2.5 py-1 bg-amber-50 text-amber-700 text-[10px] font-bold rounded-l-lg tracking-wider uppercase border border-r-0 border-amber-100">
                            INTERVIEWING
                        </span>
                        <a href="#" class="px-3 py-1 bg-[#EBE5DA] text-gray-600 text-[10px] font-bold rounded-r-lg tracking-wider uppercase hover:bg-[#dfd7ca] transition border border-l-0 border-[#dfd7ca]">
                            PROFILE
                        </a>
                    </div>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="bg-white rounded-full flex items-center px-6 py-5 shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-amber-50">
                <!-- Profile -->
                <div class="flex items-center gap-4 w-[35%]">
                    <img src="https://i.pravatar.cc/150?u=michael" alt="Michael" class="w-12 h-12 rounded-full border-2 border-[#FAF6F0] object-cover">
                    <div>
                        <div class="font-bold text-[15px] text-gray-900">Michael Chen</div>
                        <div class="text-[12.5px] text-gray-400 font-medium">Applied Oct 15, 2023</div>
                    </div>
                </div>

                <!-- Skills -->
                <div class="w-[25%] flex flex-col gap-1.5">
                    <div class="flex items-center">
                        <span class="inline-flex items-center gap-1.5 bg-[#F2EDE4] px-2.5 py-1 rounded-[8px] text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            EVENT SUPPORT
                        </span>
                    </div>
                </div>

                <!-- Availability -->
                <div class="w-[20%] flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-800" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span class="text-[13.5px] font-bold text-gray-700">Flexible</span>
                </div>

                <!-- Status & Action -->
                <div class="w-[20%] flex flex-col items-end gap-2 pr-2">
                    <div class="inline-flex">
                        <span class="px-2.5 py-1 bg-cyan-50 text-cyan-600 text-[10px] font-bold rounded-l-lg tracking-wider uppercase border border-r-0 border-cyan-100">
                            PENDING
                        </span>
                        <a href="#" class="px-3 py-1 bg-[#EBE5DA] text-gray-600 text-[10px] font-bold rounded-r-lg tracking-wider uppercase hover:bg-[#dfd7ca] transition border border-l-0 border-[#dfd7ca]">
                            PROFILE
                        </a>
                    </div>
                </div>
            </div>

            <!-- Row 3 -->
            <div class="bg-white rounded-full flex items-center px-6 py-5 shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-amber-50">
                <!-- Profile -->
                <div class="flex items-center gap-4 w-[35%]">
                    <img src="https://i.pravatar.cc/150?u=elena" alt="Elena" class="w-12 h-12 rounded-full border-2 border-[#FAF6F0] object-cover">
                    <div>
                        <div class="font-bold text-[15px] text-gray-900">Elena Rodriguez</div>
                        <div class="text-[12.5px] text-gray-400 font-medium">Applied Oct 09, 2023</div>
                    </div>
                </div>

                <!-- Skills -->
                <div class="w-[25%] flex flex-col gap-1.5">
                    <div class="flex items-center">
                        <span class="inline-flex items-center gap-1.5 bg-[#F2EDE4] px-2.5 py-1 rounded-[8px] text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" /></svg>
                            SOCIAL MEDIA
                        </span>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-flex items-center gap-1.5 bg-[#F2EDE4] px-2.5 py-1 rounded-[8px] text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>
                            DESIGN
                        </span>
                    </div>
                </div>

                <!-- Availability -->
                <div class="w-[20%] flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-800" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-[13.5px] font-bold text-gray-700">Weekdays</span>
                </div>

                <!-- Status & Action -->
                <div class="w-[20%] flex flex-col items-end gap-2 pr-2">
                    <div class="inline-flex">
                        <span class="px-2.5 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-l-lg tracking-wider uppercase border border-r-0 border-green-100">
                            APPROVED
                        </span>
                        <a href="#" class="px-3 py-1 bg-[#EBE5DA] text-gray-600 text-[10px] font-bold rounded-r-lg tracking-wider uppercase hover:bg-[#dfd7ca] transition border border-l-0 border-[#dfd7ca]">
                            PROFILE
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pagination -->
        <div class="mt-8 flex items-center justify-between px-2">
            <div class="text-[12px] font-medium text-gray-500">
                Showing 3 of 12 pending applications
            </div>
            <div class="flex items-center gap-1.5">
                <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 bg-[#EBE5DA] hover:bg-gray-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                </button>
                <button class="w-8 h-8 flex items-center justify-center rounded-full bg-amber-850 text-white text-[13px] font-bold shadow-md">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 bg-[#EBE5DA] hover:bg-gray-200 transition text-[13px] font-bold">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 bg-[#EBE5DA] hover:bg-gray-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </button>
            </div>
        </div>

    </div>
</x-admin-layout>
