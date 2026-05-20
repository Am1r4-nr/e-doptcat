<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-3xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
        <p class="text-gray-500 mt-1">Manage your account and view your activity</p>
    </x-slot>

    <div class="py-12" x-data="{ tab: 'profile' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Left Column: Summary Card -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-3xl shadow-sm p-8 text-center border border-gray-100">
                        <!-- Avatar -->
                        @if (Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                class="w-24 h-24 mx-auto rounded-full object-cover shadow-lg ring-4 ring-p-olive/30 mb-4">
                        @else
                            <div
                                class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-400 to-p-forest rounded-full flex items-center justify-center text-white text-2xl font-bold mb-4 shadow-lg">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                        @endif

                        <h3 class="text-xl font-bold text-gray-800">{{ Auth::user()->name }}</h3>
                        <p class="text-gray-500 text-sm mb-6">{{ Auth::user()->email }}</p>

                        <div class="border-t border-gray-100 my-6"></div>

                        <!-- Contact Details -->
                        <div class="space-y-4 text-left text-sm text-gray-600">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span>{{ Auth::user()->phone ?? 'No phone number' }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ Auth::user()->address ?? 'No address set' }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Member since {{ Auth::user()->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 my-6"></div>

                        <!-- Stats -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-blue-50 p-4 rounded-xl">
                                <svg class="w-6 h-6 text-blue-500 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <div class="text-2xl font-bold text-blue-600">{{ $adoptionsCount }}</div>
                                <div class="text-xs text-blue-400 font-medium">Adoptions</div>
                            </div>
                            <div class="bg-green-50 p-4 rounded-xl">
                                <svg class="w-6 h-6 text-green-500 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="text-2xl font-bold text-green-600">RM {{ number_format($donationsSum) }}
                                </div>
                                <div class="text-xs text-green-400 font-medium">Donated</div>
                            </div>
                        </div>

                        <button @click="tab = 'profile'"
                            class="w-full bg-blue-500 text-white font-bold py-3 rounded-xl hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Profile
                        </button>
                    </div>
                </div>

                <!-- Right Column: Tabs & Content -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <!-- Tabs Header -->
                        <div class="bg-orange-50/50 p-2 flex flex-wrap gap-2 border-b border-orange-100">
                            <button @click="tab = 'profile'"
                                :class="{'bg-white shadow-sm text-p-forest': tab === 'profile', 'text-gray-500 hover:text-p-forest': tab !== 'profile'}"
                                class="px-6 py-2 rounded-full text-sm font-bold transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profile
                            </button>
                            <button @click="tab = 'adoptions'"
                                :class="{'bg-white shadow-sm text-p-forest': tab === 'adoptions', 'text-gray-500 hover:text-p-forest': tab !== 'adoptions'}"
                                class="px-6 py-2 rounded-full text-sm font-bold transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                Adoptions
                            </button>
                            <button @click="tab = 'donations'"
                                :class="{'bg-white shadow-sm text-p-forest': tab === 'donations', 'text-gray-500 hover:text-p-forest': tab !== 'donations'}"
                                class="px-6 py-2 rounded-full text-sm font-bold transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Donations
                            </button>
                            <button @click="tab = 'events'"
                                :class="{'bg-white shadow-sm text-p-forest': tab === 'events', 'text-gray-500 hover:text-p-forest': tab !== 'events'}"
                                class="px-6 py-2 rounded-full text-sm font-bold transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Events
                            </button>
                        </div>

                        <!-- Content Area -->
                        <div class="p-8">
                            <!-- Profile Tab -->
                            <div x-show="tab === 'profile'" class="space-y-6">
                                <h4 class="text-xl font-bold text-gray-800 mb-6">Edit Profile</h4>

                                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                                    @csrf
                                    @method('patch')

                                    <!-- Avatar Upload -->
                                    <div>
                                        <x-input-label for="avatar" :value="__('Profile Picture')"
                                            class="text-gray-600 font-bold" />
                                        <div class="mt-4 flex items-end gap-6">
                                            <div class="flex-shrink-0">
                                                @if ($user->avatar)
                                                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}"
                                                        class="w-24 h-24 rounded-full object-cover ring-4 ring-p-olive/30 shadow-lg">
                                                @else
                                                    <div
                                                        class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-400 to-p-forest flex items-center justify-center text-white text-2xl font-bold ring-4 ring-gray-200">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <input id="avatar" name="avatar" type="file" accept="image/*"
                                                    class="block w-full text-sm text-gray-500
                                                    file:mr-4 file:py-2 file:px-4
                                                    file:rounded-lg file:border-0
                                                    file:text-sm file:font-bold
                                                    file:bg-p-olive file:text-white
                                                    hover:file:bg-orange-500
                                                    cursor-pointer" />
                                                <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF up to 5MB</p>
                                            </div>
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                                    </div>

                                    <div>
                                        <x-input-label for="name" :value="__('Full Name')"
                                            class="text-gray-600 font-bold" />
                                        <x-text-input id="name" name="name" type="text"
                                            class="mt-1 block w-full bg-slate-50 border-gray-100 rounded-xl"
                                            :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>

                                    <div>
                                        <x-input-label for="email" :value="__('Email Address')"
                                            class="text-gray-600 font-bold" />
                                        <x-text-input id="email" name="email" type="email"
                                            class="mt-1 block w-full bg-slate-50 border-gray-100 rounded-xl"
                                            :value="old('email', $user->email)" required autocomplete="username" />
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    </div>

                                    <div>
                                        <x-input-label for="phone" :value="__('Phone Number')"
                                            class="text-gray-600 font-bold" />
                                        <x-text-input id="phone" name="phone" type="text"
                                            class="mt-1 block w-full bg-slate-50 border-gray-100 rounded-xl"
                                            :value="old('phone', $user->phone)" />
                                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                    </div>

                                    <div>
                                        <x-input-label for="address" :value="__('Address')"
                                            class="text-gray-600 font-bold" />
                                        <textarea id="address" name="address" rows="3"
                                            class="mt-1 block w-full bg-slate-50 border-gray-100 rounded-xl shadow-sm focus:border-p-forest focus:ring-p-forest">{{ old('address', $user->address) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <x-primary-button
                                            class="bg-p-forest hover:bg-p-forest-d">{{ __('Save Changes') }}</x-primary-button>
                                        @if (session('status') === 'profile-updated')
                                            <p x-data="{ show: true }" x-show="show" x-transition
                                                x-init="setTimeout(() => show = false, 2000)"
                                                class="text-sm text-green-600 font-bold">{{ __('Saved successfully.') }}</p>
                                        @endif
                                    </div>
                                </form>

                                <div class="border-t border-gray-100 pt-6 mt-8">
                                    <h4 class="text-lg font-bold text-gray-800 mb-4">Security</h4>
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>

                            <!-- Adoptions Tab -->
                            <div x-show="tab === 'adoptions'">
                                <h4 class="text-xl font-bold text-gray-800 mb-6">Your Adoptions</h4>
                                
                                @if($adoptions->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="w-full">
                                            <thead class="bg-gray-50 border-b">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Cat</th>
                                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Application Date</th>
                                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y">
                                                @foreach($adoptions as $adoption)
                                                    <tr class="hover:bg-gray-50">
                                                        <td class="px-6 py-4">
                                                            <div class="flex items-center gap-3">
                                                                @if($adoption->cat->image)
                                                                    <img src="{{ Storage::url($adoption->cat->image) }}" alt="{{ $adoption->cat->name }}" class="w-12 h-12 rounded-lg object-cover">
                                                                @else
                                                                    <img src="https://via.placeholder.com/50" alt="{{ $adoption->cat->name }}" class="w-12 h-12 rounded-lg object-cover">
                                                                @endif
                                                                <span class="font-medium">{{ $adoption->cat->name }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                                                {{ $adoption->status === 'Approved' ? 'bg-green-100 text-green-800' : 
                                                                   ($adoption->status === 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                                {{ $adoption->status }}
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-gray-600">
                                                            {{ $adoption->created_at->format('d M Y') }}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <a href="{{ route('cats.show', $adoption->cat) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                                                View Cat
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-12">
                                        <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-800">No Adoptions Yet</h3>
                                        <p class="text-gray-500">You haven't applied for any adoptions yet.</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Donations Tab -->
                            <div x-show="tab === 'donations'">
                                <div class="text-center py-12">
                                    <div
                                        class="w-16 h-16 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-800">Your Donations</h3>
                                    <p class="text-gray-500">Total donated: RM {{ number_format($donationsSum) }}</p>
                                </div>
                            </div>

                            <!-- Events Tab -->
                            <div x-show="tab === 'events'">
                                <div class="text-center py-12">
                                    <div
                                        class="w-16 h-16 bg-purple-50 text-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-800">Your Events</h3>
                                    <p class="text-gray-500">Registered for {{ $eventsCount }} events.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>