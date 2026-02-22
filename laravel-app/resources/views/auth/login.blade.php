<x-guest-layout>
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-boho-light text-boho-brown mb-4">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </div>
        <h2 class="text-3xl font-serif font-bold text-gray-800">Welcome Back</h2>
        <p class="text-gray-500 mt-2">Sign in to your e-Doptcat account</p>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md mx-auto">
        <h3 class="text-center text-gray-700 font-medium mb-6">Login</h3>

        <div class="flex gap-4 mb-6 bg-boho-bg p-1 rounded-full">
            <button type="button" onclick="switchRole('user')"
                id="user-btn"
                class="user-role-btn flex-1 py-2 text-sm font-bold rounded-full transition-all flex items-center justify-center gap-2 bg-white shadow-sm text-boho-brown">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                User
            </button>
            <button type="button" onclick="switchRole('admin')"
                id="admin-btn"
                class="admin-role-btn flex-1 py-2 text-sm font-bold rounded-full transition-all flex items-center justify-center gap-2 text-gray-500 hover:text-boho-brown">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Admin
            </button>
        </div>

        <form method="POST" action="{{ route('login') }}" id="login-form">
            @csrf
            <input type="hidden" name="user_type" id="user_type" value="user">

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                <input id="email"
                    class="w-full px-4 py-3 rounded-xl bg-boho-bg border-transparent focus:border-boho-brown focus:bg-white focus:ring-0 transition-colors"
                    type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="your.email@university.edu" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                <input id="password"
                    class="w-full px-4 py-3 rounded-xl bg-boho-bg border-transparent focus:border-boho-brown focus:bg-white focus:ring-0 transition-colors"
                    type="password" name="password" required placeholder="Enter your password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <label for="remember" class="flex items-center text-sm mb-6">
                <input id="remember" type="checkbox" name="remember"
                    class="rounded border-gray-300 text-boho-brown shadow-sm focus:ring-boho-brown">
                <span class="ml-2 text-gray-600">Remember for 30 days</span>
            </label>

            <button type="submit"
                class="w-full bg-blue-500 text-white font-bold py-3 rounded-xl hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30"
                id="submit-btn">
                Sign In as User
            </button>

            <div class="flex items-center justify-between mt-6 text-sm">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-gray-400 hover:text-gray-600">Forgot
                        password?</a>
                @endif
                <span class="text-gray-500">Don't have an account? <a href="{{ route('register') }}"
                        class="text-blue-500 font-bold hover:underline">Sign up</a></span>
            </div>
        </form>
    </div>

    <div class="mt-8 p-4 bg-orange-50 border border-orange-100 rounded-lg max-w-md mx-auto">
        <p class="text-xs font-bold text-orange-800 mb-2">Demo Credentials:</p>
        <div class="space-y-1">
            <p class="text-xs text-orange-700">User: <span class="font-mono">user@demo.com</span> / <span
                    class="font-mono">password123</span></p>
            <p class="text-xs text-orange-700">Admin: <span class="font-mono">admin@demo.com</span> / <span
                    class="font-mono">admin123</span></p>
        </div>
    </div>
</x-guest-layout>

<script>
function switchRole(role) {
    document.getElementById('user_type').value = role;
    const userBtn = document.getElementById('user-btn');
    const adminBtn = document.getElementById('admin-btn');
    const submitBtn = document.getElementById('submit-btn');
    
    if (role === 'user') {
        userBtn.classList.add('bg-white', 'shadow-sm', 'text-boho-brown');
        userBtn.classList.remove('text-gray-500', 'hover:text-boho-brown');
        adminBtn.classList.remove('bg-white', 'shadow-sm', 'text-boho-brown');
        adminBtn.classList.add('text-gray-500', 'hover:text-boho-brown');
        submitBtn.textContent = 'Sign In as User';
    } else {
        adminBtn.classList.add('bg-white', 'shadow-sm', 'text-boho-brown');
        adminBtn.classList.remove('text-gray-500', 'hover:text-boho-brown');
        userBtn.classList.remove('bg-white', 'shadow-sm', 'text-boho-brown');
        userBtn.classList.add('text-gray-500', 'hover:text-boho-brown');
        submitBtn.textContent = 'Sign In as Admin';
    }
}
</script>