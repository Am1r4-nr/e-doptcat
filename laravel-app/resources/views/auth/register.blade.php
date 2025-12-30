<x-guest-layout>
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-boho-light text-boho-brown mb-4">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </div>
        <h2 class="text-3xl font-serif font-bold text-gray-800">Join e-Doptcat</h2>
        <p class="text-gray-500 mt-2">Create your account to start helping cats</p>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md mx-auto">
        <h3 class="text-center text-gray-700 font-medium mb-6 flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            User Registration
        </h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name Split -->
            <div class="flex gap-4 mb-4">
                <div class="w-1/2">
                    <label for="first_name" class="block text-sm font-bold text-gray-700 mb-1">First Name</label>
                    <input id="first_name"
                        class="w-full px-4 py-3 rounded-xl bg-boho-bg border-transparent focus:border-boho-brown focus:bg-white focus:ring-0 transition-colors"
                        type="text" name="first_name" :value="old('first_name')" required autofocus
                        placeholder="John" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>
                <div class="w-1/2">
                    <label for="last_name" class="block text-sm font-bold text-gray-700 mb-1">Last Name</label>
                    <input id="last_name"
                        class="w-full px-4 py-3 rounded-xl bg-boho-bg border-transparent focus:border-boho-brown focus:bg-white focus:ring-0 transition-colors"
                        type="text" name="last_name" :value="old('last_name')" required placeholder="Doe" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                <input id="email"
                    class="w-full px-4 py-3 rounded-xl bg-boho-bg border-transparent focus:border-boho-brown focus:bg-white focus:ring-0 transition-colors"
                    type="email" name="email" :value="old('email')" required placeholder="your.email@university.edu" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="mb-4">
                <label for="phone" class="block text-sm font-bold text-gray-700 mb-1">Phone Number</label>
                <input id="phone"
                    class="w-full px-4 py-3 rounded-xl bg-boho-bg border-transparent focus:border-boho-brown focus:bg-white focus:ring-0 transition-colors"
                    type="text" name="phone" :value="old('phone')" required placeholder="+60 12-345 6789" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                <input id="password"
                    class="w-full px-4 py-3 rounded-xl bg-boho-bg border-transparent focus:border-boho-brown focus:bg-white focus:ring-0 transition-colors"
                    type="password" name="password" required placeholder="Enter a strong password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-1">Confirm
                    Password</label>
                <input id="password_confirmation"
                    class="w-full px-4 py-3 rounded-xl bg-boho-bg border-transparent focus:border-boho-brown focus:bg-white focus:ring-0 transition-colors"
                    type="password" name="password_confirmation" required placeholder="Confirm your password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Agreements -->
            <div class="mb-6 space-y-2">
                <div class="flex items-start">
                    <input id="terms" type="checkbox" name="terms" required
                        class="mt-1 w-4 h-4 text-boho-brown border-gray-300 rounded focus:ring-boho-brown">
                    <label for="terms" class="ml-2 text-sm text-gray-600">
                        I agree to the <a href="#" class="text-blue-500 hover:underline font-bold">Terms and
                            Conditions</a>
                    </label>
                </div>
                <div class="flex items-start">
                    <input id="newsletter" type="checkbox" name="newsletter"
                        class="mt-1 w-4 h-4 text-boho-brown border-gray-300 rounded focus:ring-boho-brown">
                    <label for="newsletter" class="ml-2 text-sm text-gray-600">
                        I would like to receive updates about cat adoptions and AHC activities
                    </label>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-500 text-white font-bold py-3 rounded-xl hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
                Create Account
            </button>

            <div class="flex items-center justify-between mt-6 text-sm">
                <span class="text-gray-500">Already have an account? <a href="{{ route('login') }}"
                        class="text-blue-500 font-bold hover:underline">Sign in here</a></span>
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-600">Back to Home</a>
            </div>
        </form>
    </div>
</x-guest-layout>