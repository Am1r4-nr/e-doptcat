<x-admin-layout>
<div class="px-8 py-6 max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex items-start justify-between mb-10 border-b pb-8 border-[#E8E2D8]/50">
        <div>
            <h2 class="text-[32px] font-bold text-gray-900 tracking-tight">Manage Users</h2>
            <p class="text-[15px] font-medium text-gray-500 mt-1 max-w-2xl">
                Oversee all registered members and administrators of the sanctuary platform.
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
            <div>
                <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">Total Users</div>
                <div class="text-4xl font-bold text-gray-900">{{ $stats['total'] }}</div>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-[#C9A84C]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            </div>
        </div>

        <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
            <div>
                <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">Administrators</div>
                <div class="text-4xl font-bold text-[#C9A84C]">{{ $stats['admins'] }}</div>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-[#C9A84C]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            </div>
        </div>

        <div class="bg-white rounded-[28px] p-7 flex items-center justify-between shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">
            <div>
                <div class="text-[12px] font-bold text-gray-500 tracking-widest mb-1 uppercase">Members</div>
                <div class="text-4xl font-bold text-gray-900">{{ $stats['members'] }}</div>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#FAF6F0] flex items-center justify-center text-[#C9A84C]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V7H4v3H1v2h3v3h2v-3h3v-2H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="currentColor" stroke="none"/></svg>
            </div>
        </div>
    </div>

    <!-- Column Headers -->
    <div class="grid grid-cols-[3fr_2fr_2fr_2fr] gap-4 mb-3 px-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
        <div>User Profile</div>
        <div>Email</div>
        <div>Joined</div>
        <div class="text-right">Role / Actions</div>
    </div>

    <!-- User Rows -->
    <div class="space-y-3">
        @forelse($users as $user)
        <div class="bg-white rounded-full flex items-center px-6 py-4 shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] border border-[#F0EBE3]">

            <!-- Profile -->
            <div class="flex items-center gap-4 w-[35%]">
                @if($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}"
                         class="w-11 h-11 rounded-full object-cover border-2 border-[#FAF6F0] flex-shrink-0">
                @else
                    <div class="w-11 h-11 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0
                                {{ $user->role === 'admin' ? 'bg-[#C9A84C]' : 'bg-[#8B7355]' }}">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                @endif
                <div>
                    <div class="font-bold text-[14px] text-gray-900">{{ $user->name }}</div>
                    @if($user->phone)
                        <div class="text-[12px] text-gray-400 font-medium">{{ $user->phone }}</div>
                    @else
                        <div class="text-[12px] text-gray-300 font-medium italic">No phone</div>
                    @endif
                </div>
            </div>

            <!-- Email -->
            <div class="w-[25%] text-[13px] text-gray-600 truncate pr-4">
                {{ $user->email }}
            </div>

            <!-- Joined -->
            <div class="w-[20%] flex items-center gap-2 text-[13px] text-gray-600">
                <svg class="w-3.5 h-3.5 text-[#C9A84C] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $user->created_at->format('d M Y') }}
            </div>

            <!-- Role + Actions -->
            <div class="w-[20%] flex items-center justify-end gap-2 pr-2">
                <!-- Role badge -->
                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full uppercase tracking-wider
                    {{ $user->role === 'admin' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-gray-100 text-gray-500 border border-gray-200' }}">
                    {{ ucfirst($user->role) }}
                </span>

                <!-- Role toggle form (disabled for own account) -->
                @if(auth()->id() !== $user->id)
                <form action="{{ route('admin.users.role', $user) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <select name="role" onchange="this.form.submit()"
                            class="text-[12px] rounded-lg border border-[#E8E2D8] bg-[#FAF6F0] text-gray-600 px-2 py-1 focus:outline-none focus:ring-1 focus:ring-[#C9A84C] cursor-pointer">
                        <option value="user"  {{ $user->role === 'user'  ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </form>
                @endif

                <!-- View -->
                <a href="{{ route('admin.users.show', $user) }}"
                   class="w-8 h-8 flex items-center justify-center rounded-full bg-[#FAF6F0] hover:bg-[#F5EDD8] text-[#C9A84C] transition"
                   title="View profile">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </a>

                <!-- Delete -->
                @if(auth()->id() !== $user->id)
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                      onsubmit="return confirm('Delete {{ addslashes($user->name) }}? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-red-50 hover:bg-red-100 text-red-400 hover:text-red-600 transition"
                            title="Delete user">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                    </button>
                </form>
                @endif
            </div>

        </div>
        @empty
        <div class="bg-white rounded-[28px] py-16 flex flex-col items-center justify-center text-center border border-[#F0EBE3]">
            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" stroke-width="1.25" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            <p class="text-gray-500 font-semibold">No users found</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex items-center justify-between px-2">
        <div class="text-[12px] font-medium text-gray-500">
            Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }} users
        </div>
        <div>
            {{ $users->links() }}
        </div>
    </div>

</div>
</x-admin-layout>
