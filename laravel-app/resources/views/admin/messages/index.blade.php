<x-admin-layout>
<div x-data="chatApp()" class="flex -mx-8 -my-8 h-full gap-0 bg-[#FAF6F0] overflow-hidden border-t border-[#E8E2D8]">

    <!-- ─── LEFT PANEL ─── -->
    <div class="w-80 flex flex-col bg-white border-r border-[#E8E2D8] flex-shrink-0 min-h-0 overflow-hidden">

        <!-- Search -->
        <div class="px-4 pt-5 pb-3">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" x-model="search" placeholder="Search"
                       class="w-full pl-9 pr-4 py-2 bg-[#FAF6F0] border border-[#E8E2D8] rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-400">
            </div>
        </div>

        <div class="flex-1 overflow-y-auto px-3 pb-4 space-y-5">

            <!-- Groups -->
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest px-1 mb-2">Groups</p>
                <div class="space-y-0.5">
                    <template x-for="conv in filteredGroups" :key="conv.id">
                        <button @click="selectConv(conv)"
                                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl transition text-left"
                                :class="active?.id === conv.id ? 'bg-[#F5EDD8]' : 'hover:bg-[#FAF6F0]'">
                            <div class="relative flex-shrink-0">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm"
                                     :style="'background:' + conv.color">
                                    <span x-text="conv.initials"></span>
                                </div>
                                <span x-show="conv.online"
                                      class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-400 rounded-full border-2 border-white"></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-baseline">
                                    <p class="text-sm font-semibold text-gray-800 truncate" x-text="conv.name"></p>
                                    <p class="text-[10px] text-gray-400 flex-shrink-0 ml-1" x-text="conv.time"></p>
                                </div>
                                <p class="text-xs text-gray-400 truncate" x-text="conv.preview"></p>
                            </div>
                            <span x-show="conv.unread > 0"
                                  class="flex-shrink-0 w-5 h-5 bg-[#C9A84C] text-white text-[10px] font-bold rounded-full flex items-center justify-center"
                                  x-text="conv.unread"></span>
                        </button>
                    </template>
                </div>
            </div>

            <!-- People -->
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest px-1 mb-2">People</p>
                <div class="space-y-0.5">
                    <template x-for="conv in filteredPeople" :key="conv.id">
                        <button @click="selectConv(conv)"
                                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl transition text-left"
                                :class="active?.id === conv.id ? 'bg-[#F5EDD8]' : 'hover:bg-[#FAF6F0]'">
                            <div class="relative flex-shrink-0">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm"
                                     :style="'background:' + conv.color">
                                    <span x-text="conv.initials"></span>
                                </div>
                                <span x-show="conv.online"
                                      class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-400 rounded-full border-2 border-white"></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-baseline">
                                    <p class="text-sm font-semibold text-gray-800 truncate" x-text="conv.name"></p>
                                    <p class="text-[10px] text-gray-400 flex-shrink-0 ml-1" x-text="conv.time"></p>
                                </div>
                                <p class="text-xs text-gray-400 truncate" x-text="conv.preview"></p>
                            </div>
                            <span x-show="conv.unread > 0"
                                  class="flex-shrink-0 w-5 h-5 bg-[#C9A84C] text-white text-[10px] font-bold rounded-full flex items-center justify-center"
                                  x-text="conv.unread"></span>
                        </button>
                    </template>
                </div>
            </div>

        </div>
    </div>

    <!-- ─── RIGHT PANEL ─── -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- No conversation selected -->
        <template x-if="!active">
            <div class="flex-1 flex flex-col items-center justify-center text-center text-gray-400 bg-[#FAF6F0]">
                <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.25" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/></svg>
                <p class="font-semibold text-gray-500">Select a conversation</p>
                <p class="text-sm mt-1">Choose from Groups or People on the left.</p>
            </div>
        </template>

        <!-- Active conversation -->
        <template x-if="active">
            <div class="flex flex-col flex-1 min-h-0">

                <!-- Chat Header -->
                <div class="flex items-center justify-between px-5 py-3.5 bg-white border-b border-[#E8E2D8] flex-shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0"
                             :style="'background:' + active.color">
                            <span x-text="active.initials"></span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800" x-text="active.name"></p>
                            <p class="text-[11px]" :class="active.online ? 'text-green-500' : 'text-gray-400'"
                               x-text="active.online ? 'Online' : 'Offline'"></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1">
                        <button class="w-8 h-8 rounded-full hover:bg-[#FAF6F0] text-gray-400 hover:text-[#C9A84C] flex items-center justify-center transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                        </button>
                        <button class="w-8 h-8 rounded-full hover:bg-[#FAF6F0] text-gray-400 hover:text-[#C9A84C] flex items-center justify-center transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/></svg>
                        </button>
                        <button class="w-8 h-8 rounded-full hover:bg-[#FAF6F0] text-gray-400 hover:text-[#C9A84C] flex items-center justify-center transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Messages -->
                <div class="flex-1 overflow-y-auto px-5 py-4 space-y-3 bg-[#FAF6F0]"
                     x-ref="msgArea"
                     x-init="$watch('active.messages.length', () => $nextTick(() => { $refs.msgArea.scrollTop = $refs.msgArea.scrollHeight }))">
                    <template x-for="(msg, i) in active.messages" :key="i">
                        <div class="flex" :class="msg.sent ? 'justify-end' : 'justify-start'">
                            <template x-if="!msg.sent">
                                <div class="flex items-end gap-2 max-w-[70%]">
                                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0 mb-0.5"
                                         :style="'background:' + active.color" x-text="active.initials"></div>
                                    <div>
                                        <div class="bg-white text-gray-800 text-sm px-4 py-2.5 rounded-2xl rounded-bl-sm shadow-sm border border-[#E8E2D8]"
                                             x-text="msg.text"></div>
                                        <p class="text-[10px] text-gray-400 mt-1 ml-1" x-text="msg.time"></p>
                                    </div>
                                </div>
                            </template>
                            <template x-if="msg.sent">
                                <div class="max-w-[70%]">
                                    <div class="bg-[#C9A84C] text-white text-sm px-4 py-2.5 rounded-2xl rounded-br-sm shadow-sm"
                                         x-text="msg.text"></div>
                                    <p class="text-[10px] text-gray-400 mt-1 text-right mr-1" x-text="msg.time"></p>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>

                <!-- Input -->
                <div class="px-4 py-3 bg-white border-t border-[#E8E2D8] flex items-center gap-3 flex-shrink-0">
                    <button class="text-gray-400 hover:text-[#C9A84C] transition flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"/></svg>
                    </button>
                    <input type="text" x-model="draft"
                           @keydown.enter="sendMessage()"
                           placeholder="Type your message here..."
                           class="flex-1 text-sm px-4 py-2.5 bg-[#FAF6F0] border border-[#E8E2D8] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#C9A84C] placeholder-gray-400">
                    <button class="text-gray-400 hover:text-[#C9A84C] transition flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/></svg>
                    </button>
                    <button class="text-gray-400 hover:text-[#C9A84C] transition flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"/></svg>
                    </button>
                    <button @click="sendMessage()"
                            class="w-9 h-9 flex-shrink-0 bg-[#C9A84C] hover:bg-[#b8963e] text-white rounded-full flex items-center justify-center transition shadow-sm">
                        <svg class="w-4 h-4 rotate-90" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.269 20.876L5.999 12zm0 0h7.5"/></svg>
                    </button>
                </div>

            </div>
        </template>
    </div>
</div>

<script>
function chatApp() {
    const now = () => {
        const d = new Date();
        return d.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
    };
    return {
        search: '',
        draft: '',
        active: null,
        conversations: [
            {
                id: 1, type: 'group', name: 'Volunteers', initials: 'VO', color: '#C9A84C', online: true,
                time: 'Today', preview: 'New intake this weekend!', unread: 3,
                messages: [
                    { text: 'Hey team, we have 3 new kittens coming in.', sent: false, time: 'Today, 9:00am' },
                    { text: 'I can help on Saturday!', sent: true, time: 'Today, 9:05am' },
                    { text: 'New intake this weekend!', sent: false, time: 'Today, 9:10am' },
                ]
            },
            {
                id: 2, type: 'group', name: 'Foster Families', initials: 'FF', color: '#8B7355', online: false,
                time: 'Yesterday', preview: 'Luna is doing great 🐱', unread: 0,
                messages: [
                    { text: 'Luna is doing great 🐱', sent: false, time: 'Yesterday, 6:30pm' },
                    { text: 'That is wonderful to hear!', sent: true, time: 'Yesterday, 6:35pm' },
                ]
            },
            {
                id: 3, type: 'group', name: 'Medical Team', initials: 'MT', color: '#6B8E6B', online: true,
                time: 'Wednesday', preview: 'Checkup scheduled for Milo', unread: 1,
                messages: [
                    { text: 'Checkup scheduled for Milo on Friday.', sent: false, time: 'Wednesday, 11:00am' },
                    { text: 'Noted, I will prepare the records.', sent: true, time: 'Wednesday, 11:15am' },
                ]
            },
            {
                id: 4, type: 'people', name: 'Amirah', initials: 'AM', color: '#C9A84C', online: true,
                time: 'Today', preview: 'Is the adoption form ready?', unread: 2,
                messages: [
                    { text: 'Hello! I want to adopt Bits.', sent: false, time: 'Today, 10:00am' },
                    { text: 'Hi Amirah! Sure, let me check availability.', sent: true, time: 'Today, 10:05am' },
                    { text: 'Is the adoption form ready?', sent: false, time: 'Today, 10:10am' },
                ]
            },
            {
                id: 5, type: 'people', name: 'Razif', initials: 'RZ', color: '#7B6B8E', online: false,
                time: 'Today', preview: 'Thank you!', unread: 0,
                messages: [
                    { text: 'I made a donation earlier.', sent: false, time: 'Today, 8:00am' },
                    { text: 'Thank you so much for your support!', sent: true, time: 'Today, 8:05am' },
                    { text: 'Thank you!', sent: false, time: 'Today, 8:06am' },
                ]
            },
            {
                id: 6, type: 'people', name: 'Sarah', initials: 'SR', color: '#8E6B6B', online: true,
                time: 'Today', preview: 'Can I visit this Sunday?', unread: 1,
                messages: [
                    { text: 'Can I visit the sanctuary this Sunday?', sent: false, time: 'Today, 7:30am' },
                    { text: 'Of course! We open at 10am.', sent: true, time: 'Today, 7:45am' },
                    { text: 'Can I visit this Sunday?', sent: false, time: 'Today, 7:50am' },
                ]
            },
            {
                id: 7, type: 'people', name: 'Hafiz', initials: 'HF', color: '#6B7B8E', online: false,
                time: 'Yesterday', preview: 'Got it, thanks!', unread: 0,
                messages: [
                    { text: 'Is Snowy still available for adoption?', sent: false, time: 'Yesterday, 3:00pm' },
                    { text: 'Snowy was just adopted today, sorry!', sent: true, time: 'Yesterday, 3:15pm' },
                    { text: 'Got it, thanks!', sent: false, time: 'Yesterday, 3:20pm' },
                ]
            },
        ],
        get filteredGroups() {
            return this.conversations.filter(c => c.type === 'group' && c.name.toLowerCase().includes(this.search.toLowerCase()));
        },
        get filteredPeople() {
            return this.conversations.filter(c => c.type === 'people' && c.name.toLowerCase().includes(this.search.toLowerCase()));
        },
        selectConv(conv) {
            this.active = conv;
            conv.unread = 0;
        },
        sendMessage() {
            if (!this.draft.trim() || !this.active) return;
            this.active.messages.push({ text: this.draft.trim(), sent: true, time: now() });
            this.active.preview = this.draft.trim();
            this.active.time = 'Now';
            this.draft = '';
        },
    };
}
</script>
</x-admin-layout>
