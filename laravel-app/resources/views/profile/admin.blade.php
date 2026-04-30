<x-admin-layout>
<div class="max-w-5xl mx-auto" x-data="{ tab: '{{ session('status') === 'password-updated' ? 'security' : 'account' }}' }">

    <!-- Page Header -->
    <div class="mb-8">
        <p class="text-[10px] tracking-widest text-amber-500 uppercase font-semibold mb-1">Administrator</p>
        <h1 class="text-3xl font-serif font-semibold text-gray-800">My Profile</h1>
        <p class="text-sm text-gray-400 mt-1">Manage your admin account credentials and preferences.</p>
    </div>

    <div class="grid grid-cols-3 gap-6">

        <!-- Left: Profile Card -->
        <div class="col-span-1 space-y-4">

            <!-- Identity Card -->
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-6 text-center">
                <!-- Avatar -->
                @if($user->getAttribute('avatar'))
                    <img src="{{ Storage::url($user->getAttribute('avatar')) }}" alt="{{ $user->getAttribute('name') }}"
                         class="w-20 h-20 mx-auto rounded-full object-cover ring-4 ring-amber-100 mb-4">
                @else
                    <div class="w-20 h-20 mx-auto bg-amber-100 text-amber-700 rounded-full flex items-center justify-center text-2xl font-bold mb-4">
                        {{ strtoupper(substr($user->getAttribute('name') ?? 'A', 0, 2)) }}
                    </div>
                @endif

                <p class="text-base font-semibold text-gray-800">{{ $user->getAttribute('name') }}</p>
                <p class="text-xs text-gray-400 mb-3">{{ $user->getAttribute('email') }}</p>

                <span class="inline-block px-3 py-1 bg-amber-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-full">
                    System Administrator
                </span>

                <div class="border-t border-amber-50 mt-5 pt-5 space-y-2.5 text-left">
                    <div class="flex items-center gap-2.5 text-xs text-gray-500">
                        <svg class="w-3.5 h-3.5 text-amber-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                        </svg>
                        {{ $user->getAttribute('phone') ?? 'No phone number' }}
                    </div>
                    <div class="flex items-center gap-2.5 text-xs text-gray-500">
                        <svg class="w-3.5 h-3.5 text-amber-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                        Since {{ $user->getAttribute('created_at')->format('M Y') }}
                    </div>
                </div>
            </div>

            <!-- System Stats -->
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-5">
                <p class="text-[10px] tracking-widest text-amber-500 uppercase font-semibold mb-4">System Overview</p>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400">Cats in Registry</span>
                        <span class="text-sm font-bold text-gray-800">{{ $stats['cats'] }}</span>
                    </div>
                    <div class="w-full bg-amber-50 rounded-full h-1">
                        <div class="bg-amber-400 h-1 rounded-full" style="width: {{ min(($stats['cats'] / max($stats['cats'], 1)) * 100, 100) }}%"></div>
                    </div>
                    <div class="flex items-center justify-between pt-1">
                        <span class="text-xs text-gray-400">Registered Users</span>
                        <span class="text-sm font-bold text-gray-800">{{ $stats['users'] }}</span>
                    </div>
                    <div class="w-full bg-amber-50 rounded-full h-1">
                        <div class="bg-amber-300 h-1 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Tabs -->
        <div class="col-span-2">
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm overflow-hidden">

                <!-- Tab Bar -->
                <div class="flex border-b border-amber-100 px-2 pt-2 gap-1">
                    <button @click="tab = 'account'"
                        :class="tab === 'account' ? 'border-b-2 border-amber-600 text-amber-700 font-semibold' : 'text-gray-400 hover:text-amber-600'"
                        class="px-4 py-2.5 text-xs tracking-wide transition flex items-center gap-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                        </svg>
                        Account Info
                    </button>
                    <button @click="tab = 'security'"
                        :class="tab === 'security' ? 'border-b-2 border-amber-600 text-amber-700 font-semibold' : 'text-gray-400 hover:text-amber-600'"
                        class="px-4 py-2.5 text-xs tracking-wide transition flex items-center gap-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                        </svg>
                        Security
                    </button>
                </div>

                <!-- Account Tab -->
                <div x-show="tab === 'account'" class="p-7">
                    <p class="text-[10px] tracking-widest text-amber-500 uppercase font-semibold mb-5">Account Information</p>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        @method('PATCH')

                        <!-- Avatar -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-2">Profile Picture</label>
                            <div class="flex items-center gap-4">
                                @if($user->getAttribute('avatar'))
                                    <img src="{{ Storage::url($user->getAttribute('avatar')) }}" alt="{{ $user->getAttribute('name') }}"
                                         class="w-14 h-14 rounded-full object-cover ring-2 ring-amber-100">
                                @else
                                    <div class="w-14 h-14 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-lg font-bold">
                                        {{ strtoupper(substr($user->getAttribute('name') ?? 'A', 0, 2)) }}
                                    </div>
                                @endif
                                <div>
                                    <label for="avatar"
                                        class="inline-block px-4 py-2 bg-[#FAF6F0] border border-amber-200 rounded-full text-xs font-semibold text-gray-600 cursor-pointer hover:border-amber-400 transition">
                                        Upload Photo
                                    </label>
                                    <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden">
                                    <p class="text-[10px] text-gray-400 mt-1">PNG, JPG, GIF — max 5MB</p>
                                </div>
                            </div>
                            @error('avatar')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-xs font-semibold text-gray-500 mb-1.5">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->getAttribute('name')) }}" required
                                    class="w-full px-4 py-2.5 text-sm bg-[#FAF6F0] border border-amber-100 rounded-xl focus:outline-none focus:ring-1 focus:ring-amber-300 @error('name') border-red-300 @enderror">
                                @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="email" class="block text-xs font-semibold text-gray-500 mb-1.5">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->getAttribute('email')) }}" required
                                    class="w-full px-4 py-2.5 text-sm bg-[#FAF6F0] border border-amber-100 rounded-xl focus:outline-none focus:ring-1 focus:ring-amber-300 @error('email') border-red-300 @enderror">
                                @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="block text-xs font-semibold text-gray-500 mb-1.5">Phone Number</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->getAttribute('phone')) }}"
                                class="w-full px-4 py-2.5 text-sm bg-[#FAF6F0] border border-amber-100 rounded-xl focus:outline-none focus:ring-1 focus:ring-amber-300">
                        </div>

                        @if(session('status') === 'profile-updated')
                            <div class="px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl">
                                Profile updated successfully.
                            </div>
                        @endif

                        <button type="submit"
                            class="px-6 py-2.5 bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold rounded-full transition">
                            Save Changes
                        </button>
                    </form>
                </div>

                <!-- Security Tab -->
                <div x-show="tab === 'security'" class="p-7">
                    <p class="text-[10px] tracking-widest text-amber-500 uppercase font-semibold mb-5">Change Password</p>

                    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="current_password" class="block text-xs font-semibold text-gray-500 mb-1.5">Current Password</label>
                            <input type="password" id="current_password" name="current_password" autocomplete="current-password"
                                class="w-full px-4 py-2.5 text-sm bg-[#FAF6F0] border border-amber-100 rounded-xl focus:outline-none focus:ring-1 focus:ring-amber-300 @error('current_password', 'updatePassword') border-red-300 @enderror">
                            @error('current_password', 'updatePassword')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="password" class="block text-xs font-semibold text-gray-500 mb-1.5">New Password</label>
                            <input type="password" id="password" name="password" autocomplete="new-password"
                                class="w-full px-4 py-2.5 text-sm bg-[#FAF6F0] border border-amber-100 rounded-xl focus:outline-none focus:ring-1 focus:ring-amber-300 @error('password', 'updatePassword') border-red-300 @enderror">
                            @error('password', 'updatePassword')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-xs font-semibold text-gray-500 mb-1.5">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                                class="w-full px-4 py-2.5 text-sm bg-[#FAF6F0] border border-amber-100 rounded-xl focus:outline-none focus:ring-1 focus:ring-amber-300">
                        </div>

                        @if(session('status') === 'password-updated')
                            <div class="px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl">
                                Password updated successfully.
                            </div>
                        @endif

                        <button type="submit"
                            class="px-6 py-2.5 bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold rounded-full transition">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</x-admin-layout>
