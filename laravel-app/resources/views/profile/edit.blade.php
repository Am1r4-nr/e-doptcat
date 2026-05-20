<x-app-layout>
<style>
    @keyframes blobPulse {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
        50%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
    }
    .blob { animation: blobPulse 10s ease-in-out infinite; }
</style>

<div class="bg-cozy-bg min-h-screen pt-28 pb-20 relative overflow-hidden flex flex-col justify-center" x-data="{ tab: 'profile' }">
    <!-- Decorative Ambient Blobs -->
    <div class="absolute top-0 right-0 w-80 h-80 bg-cozy-warm/40 blob opacity-60 translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-cozy-accent/15 blob opacity-40 -translate-x-1/3 translate-y-1/3 pointer-events-none" style="animation-delay:-3s;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
        <!-- Header -->
        <div class="text-center pb-8 flex-shrink-0">
            <p class="font-script text-3xl text-cozy-accent mb-1">My Information</p>
            <h2 class="font-serif font-bold text-4xl md:text-5xl text-cozy-brown mb-4">
                {{ __('My Profile') }}
            </h2>
            <div class="w-20 h-1 bg-cozy-accent/60 mx-auto rounded-full mb-4"></div>
            <p class="text-cozy-brown/60 max-w-xl mx-auto text-base">
                Manage your credentials, update your campus contact details, and review your history with our stray rescues.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <!-- Left Column: Summary Card -->
            <div class="w-full lg:w-1/3">
                <div class="bg-cozy-card rounded-[2.5rem] shadow-lg p-8 text-center border border-cozy-warm/40 relative overflow-hidden">
                    <!-- Avatar with organic mask -->
                    <div class="relative w-28 h-28 mx-auto mb-5 overflow-hidden shadow-md border-2 border-cozy-accent/30"
                         style="border-radius: 60% 40% 50% 50% / 50% 30% 70% 50%;">
                        @if (Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-cozy-accent to-cozy-brown flex items-center justify-center text-cozy-light text-2xl font-bold">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                        @endif
                    </div>

                    <h3 class="text-xl font-serif font-bold text-cozy-brown">{{ Auth::user()->name }}</h3>
                    <p class="text-cozy-brown/50 text-xs mt-1">{{ Auth::user()->email }}</p>

                    <div class="w-12 h-[1px] bg-cozy-warm/60 mx-auto my-5"></div>

                    <!-- Contact Details -->
                    <div class="space-y-3.5 text-left text-xs text-cozy-brown/85">
                        <div class="flex items-center gap-3 bg-cozy-light/40 p-2.5 rounded-xl border border-cozy-warm/20">
                            <span class="text-lg">📞</span>
                            <span class="font-medium truncate">{{ Auth::user()->phone ?? 'No phone number' }}</span>
                        </div>
                        <div class="flex items-center gap-3 bg-cozy-light/40 p-2.5 rounded-xl border border-cozy-warm/20">
                            <span class="text-lg">📍</span>
                            <span class="font-medium truncate">{{ Auth::user()->address ?? 'No address set' }}</span>
                        </div>
                        <div class="flex items-center gap-3 bg-cozy-light/40 p-2.5 rounded-xl border border-cozy-warm/20">
                            <span class="text-lg">🗓️</span>
                            <span class="font-medium">Joined {{ Auth::user()->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <div class="w-12 h-[1px] bg-cozy-warm/60 mx-auto my-5"></div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-cozy-light/60 p-3.5 rounded-2xl border border-cozy-warm/30 shadow-inner">
                            <span class="text-lg block mb-1">🐾</span>
                            <div class="text-xl font-serif font-bold text-cozy-brown">{{ $adoptionsCount }}</div>
                            <div class="text-[9px] font-bold text-cozy-brown/40 uppercase tracking-widest mt-0.5">Adoptions</div>
                        </div>
                        <div class="bg-cozy-light/60 p-3.5 rounded-2xl border border-cozy-warm/30 shadow-inner">
                            <span class="text-lg block mb-1">💝</span>
                            <div class="text-base font-serif font-bold text-cozy-brown truncate">RM {{ number_format($donationsSum, 0) }}</div>
                            <div class="text-[9px] font-bold text-cozy-brown/40 uppercase tracking-widest mt-0.5">Donated</div>
                        </div>
                    </div>

                    <button @click="tab = 'profile'"
                        class="w-full bg-cozy-brown hover:bg-cozy-accent text-cozy-light hover:text-cozy-brown font-bold py-3.5 rounded-2xl shadow-md transition-colors flex items-center justify-center gap-2 text-xs uppercase tracking-wider">
                        ✏️ Edit profile
                    </button>
                </div>
            </div>

            <!-- Right Column: Tabs & Content -->
            <div class="w-full lg:w-2/3">
                <div class="bg-cozy-card rounded-[2.5rem] shadow-lg border border-cozy-warm/40 overflow-hidden">
                    <!-- Tabs Header -->
                    <div class="bg-cozy-light/60 p-2 flex flex-wrap gap-2 border-b border-cozy-warm/30">
                        <button @click="tab = 'profile'"
                            :class="{'bg-cozy-brown text-cozy-light': tab === 'profile', 'text-cozy-brown/65 hover:bg-cozy-warm/20': tab !== 'profile'}"
                            class="px-6 py-2.5 rounded-full text-xs font-bold transition-all flex items-center gap-2 uppercase tracking-wider shadow-sm">
                            👤 Profile Info
                        </button>
                        <button @click="tab = 'adoptions'"
                            :class="{'bg-cozy-brown text-cozy-light': tab === 'adoptions', 'text-cozy-brown/65 hover:bg-cozy-warm/20': tab !== 'adoptions'}"
                            class="px-6 py-2.5 rounded-full text-xs font-bold transition-all flex items-center gap-2 uppercase tracking-wider shadow-sm">
                            🐾 Adoptions
                        </button>
                        <button @click="tab = 'donations'"
                            :class="{'bg-cozy-brown text-cozy-light': tab === 'donations', 'text-cozy-brown/65 hover:bg-cozy-warm/20': tab !== 'donations'}"
                            class="px-6 py-2.5 rounded-full text-xs font-bold transition-all flex items-center gap-2 uppercase tracking-wider shadow-sm">
                            💝 Donations
                        </button>
                        <button @click="tab = 'events'"
                            :class="{'bg-cozy-brown text-cozy-light': tab === 'events', 'text-cozy-brown/65 hover:bg-cozy-warm/20': tab !== 'events'}"
                            class="px-6 py-2.5 rounded-full text-xs font-bold transition-all flex items-center gap-2 uppercase tracking-wider shadow-sm">
                            🗓️ Events
                        </button>
                    </div>

                    <!-- Content Area -->
                    <div class="p-8">
                        <!-- Profile Tab -->
                        <div x-show="tab === 'profile'" class="space-y-6">
                            <h4 class="text-xl font-serif font-bold text-cozy-brown mb-6">Profile Settings</h4>

                            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                                @csrf
                                @method('patch')

                                <!-- Avatar Upload -->
                                <div>
                                    <label class="block text-cozy-brown text-xs font-bold mb-2 uppercase tracking-wider">Profile Picture</label>
                                    <div class="mt-4 flex items-center gap-6">
                                        <div class="flex-shrink-0">
                                            <div class="relative w-20 h-20 overflow-hidden shadow-inner border border-cozy-accent/30"
                                                 style="border-radius: 60% 40% 50% 50% / 50% 30% 70% 50%;">
                                                @if ($user->avatar)
                                                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}"
                                                        class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full bg-gradient-to-br from-cozy-accent to-cozy-brown flex items-center justify-center text-white text-lg font-bold">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <input id="avatar" name="avatar" type="file" accept="image/*"
                                                class="block w-full text-xs text-cozy-brown/60
                                                file:mr-4 file:py-2.5 file:px-4
                                                file:rounded-xl file:border-0
                                                file:text-xs file:font-bold
                                                file:bg-cozy-brown file:text-cozy-light
                                                hover:file:bg-cozy-accent hover:file:text-cozy-brown
                                                cursor-pointer" />
                                            <p class="text-[10px] text-cozy-brown/40 mt-2 font-bold uppercase tracking-wider">PNG, JPG or GIF (max 5MB)</p>
                                        </div>
                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                                </div>

                                <div>
                                    <label class="block text-cozy-brown text-xs font-bold mb-2 uppercase tracking-wider">Full Name</label>
                                    <input id="name" name="name" type="text"
                                        class="w-full py-3.5 px-5 rounded-2xl border-0 bg-cozy-light text-cozy-brown font-semibold focus:ring-2 focus:ring-cozy-accent text-sm"
                                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <label class="block text-cozy-brown text-xs font-bold mb-2 uppercase tracking-wider">Email Address</label>
                                    <input id="email" name="email" type="email"
                                        class="w-full py-3.5 px-5 rounded-2xl border-0 bg-cozy-light text-cozy-brown font-semibold focus:ring-2 focus:ring-cozy-accent text-sm"
                                        :value="old('email', $user->email)" required autocomplete="username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>

                                <div>
                                    <label class="block text-cozy-brown text-xs font-bold mb-2 uppercase tracking-wider">Phone Number</label>
                                    <input id="phone" name="phone" type="text"
                                        class="w-full py-3.5 px-5 rounded-2xl border-0 bg-cozy-light text-cozy-brown font-semibold focus:ring-2 focus:ring-cozy-accent text-sm"
                                        :value="old('phone', $user->phone)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>

                                <div>
                                    <label class="block text-cozy-brown text-xs font-bold mb-2 uppercase tracking-wider">Address</label>
                                    <textarea id="address" name="address" rows="3"
                                        class="w-full py-3.5 px-5 rounded-2xl border-0 bg-cozy-light text-cozy-brown font-semibold focus:ring-2 focus:ring-cozy-accent text-sm placeholder-cozy-brown/30"
                                        placeholder="Add campus department or current address details...">{{ old('address', $user->address) }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                </div>

                                <div class="flex items-center gap-4 pt-2">
                                    <button class="bg-cozy-brown hover:bg-cozy-accent text-cozy-light hover:text-cozy-brown font-bold py-3.5 px-6 rounded-2xl shadow-md transition-colors text-xs uppercase tracking-wider" type="submit">
                                        {{ __('Save Changes') }}
                                    </button>
                                    @if (session('status') === 'profile-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="text-xs text-emerald-600 font-bold uppercase tracking-wider">{{ __('Saved successfully.') }}</p>
                                    @endif
                                </div>
                            </form>

                            <div class="border-t border-cozy-warm/30 pt-8 mt-8">
                                <h4 class="text-lg font-serif font-bold text-cozy-brown mb-4">Security Credentials</h4>
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        <!-- Adoptions Tab -->
                        <div x-show="tab === 'adoptions'">
                            <h4 class="text-xl font-serif font-bold text-cozy-brown mb-6">Your Adoptions</h4>
                            
                            @if($adoptions->count() > 0)
                                <div class="overflow-hidden rounded-2xl border border-cozy-warm/30">
                                    <table class="w-full text-left">
                                        <thead class="bg-cozy-light text-cozy-brown/85 border-b border-cozy-warm/30">
                                            <tr>
                                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Cat</th>
                                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Status</th>
                                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Date</th>
                                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-cozy-warm/20 bg-cozy-card">
                                            @foreach($adoptions as $adoption)
                                                <tr class="hover:bg-cozy-light/30 transition-colors">
                                                    <td class="px-6 py-4">
                                                        <div class="flex items-center gap-3">
                                                            <div class="w-10 h-10 overflow-hidden shadow-inner border border-cozy-accent/30"
                                                                 style="border-radius: 60% 40% 50% 50% / 50% 30% 70% 50%;">
                                                                @if($adoption->cat->image)
                                                                    <img src="{{ Storage::url($adoption->cat->image) }}" alt="{{ $adoption->cat->name }}" class="w-full h-full object-cover">
                                                                @else
                                                                    <img src="https://via.placeholder.com/50" alt="{{ $adoption->cat->name }}" class="w-full h-full object-cover">
                                                                @endif
                                                            </div>
                                                            <span class="font-serif font-bold text-cozy-brown">{{ $adoption->cat->name }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                                            {{ $adoption->status === 'Approved' ? 'bg-emerald-100 text-emerald-800' : 
                                                               ($adoption->status === 'Rejected' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800') }}">
                                                            {{ $adoption->status }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 text-xs font-semibold text-cozy-brown/70">
                                                        {{ $adoption->created_at->format('M d, Y') }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <a href="{{ route('cats.show', $adoption->cat) }}" class="text-cozy-accent hover:text-cozy-brown text-xs font-bold uppercase tracking-wider">
                                                            Meet →
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-12 bg-cozy-light/30 border border-dashed border-cozy-warm/60 rounded-3xl p-6">
                                    <span class="text-4xl block mb-2">🍃</span>
                                    <h3 class="text-sm font-bold text-cozy-brown/85">No Adoptions Recorded</h3>
                                    <p class="text-xs text-cozy-brown/50 mt-1">You haven't applied to adopt a stray companion yet.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Donations Tab -->
                        <div x-show="tab === 'donations'">
                            <h4 class="text-xl font-serif font-bold text-cozy-brown mb-6">Your Contributions</h4>
                            
                            <div class="text-center py-12 bg-cozy-light/30 border border-dashed border-cozy-warm/60 rounded-3xl p-6">
                                <div class="w-16 h-16 bg-cozy-warm/50 text-cozy-brown rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
                                    💝
                                </div>
                                <h3 class="text-sm font-bold text-cozy-brown/85">Heartfelt Supporter</h3>
                                <p class="text-xs text-cozy-brown/50 mt-1">Total donated so far:</p>
                                <p class="text-3xl font-serif font-extrabold text-cozy-brown mt-2">RM {{ number_format($donationsSum, 2) }}</p>
                            </div>
                        </div>

                        <!-- Events Tab -->
                        <div x-show="tab === 'events'">
                            <h4 class="text-xl font-serif font-bold text-cozy-brown mb-6">Attending Events</h4>

                            <div class="text-center py-12 bg-cozy-light/30 border border-dashed border-cozy-warm/60 rounded-3xl p-6">
                                <div class="w-16 h-16 bg-cozy-warm/50 text-cozy-brown rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
                                    🗓️
                                </div>
                                <h3 class="text-sm font-bold text-cozy-brown/85">Upcoming Attendance</h3>
                                <p class="text-xs text-cozy-brown/50 mt-1">You are registered to attend:</p>
                                <p class="text-2xl font-serif font-extrabold text-cozy-brown mt-2">{{ $eventsCount }} Campaign Events</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>