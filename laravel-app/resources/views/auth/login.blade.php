<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-[28px] font-serif font-bold text-[#2C3317]">Welcome Back</h2>
        <p class="text-[#6B6352] mt-1 text-[14px]">Sign in to your e-Doptcat account</p>
    </div>

    <div class="bg-white/80 backdrop-blur-sm p-8 rounded-3xl shadow-xl border border-[#EDE4D3] w-full">

        {{-- Role switcher --}}
        <div class="flex gap-2 mb-6 bg-[#F5EDDD] p-1 rounded-full">
            <button type="button" onclick="switchRole('user')" id="user-btn"
                class="flex-1 py-2 text-[13px] font-bold rounded-full transition-all flex items-center justify-center gap-2 bg-white shadow-sm text-[#5B6B2E]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                User
            </button>
            <button type="button" onclick="switchRole('admin')" id="admin-btn"
                class="flex-1 py-2 text-[13px] font-bold rounded-full transition-all flex items-center justify-center gap-2 text-[#6B6352] hover:text-[#2C3317]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Admin
            </button>
        </div>

        <form method="POST" action="{{ route('login') }}" id="login-form">
            @csrf
            <input type="hidden" name="user_type" id="user_type" value="user">

            <div class="mb-4">
                <label for="email" class="block text-[12px] font-bold text-[#2C3317] uppercase tracking-wider mb-1.5">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="your.email@university.edu"
                    class="w-full px-4 py-3 rounded-xl bg-[#F5EDDD] border-transparent focus:border-[#5B6B2E] focus:bg-white focus:ring-0 text-[14px] text-[#2C3317] transition-colors"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-[12px] font-bold text-[#2C3317] uppercase tracking-wider mb-1.5">Password</label>
                <input id="password" type="password" name="password" required
                    placeholder="Enter your password"
                    class="w-full px-4 py-3 rounded-xl bg-[#F5EDDD] border-transparent focus:border-[#5B6B2E] focus:bg-white focus:ring-0 text-[14px] text-[#2C3317] transition-colors"/>
                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <label for="remember" class="flex items-center gap-2 text-[13px] text-[#6B6352] mb-6 cursor-pointer">
                <input id="remember" type="checkbox" name="remember"
                    class="rounded border-[#EDE4D3] text-[#5B6B2E] shadow-sm focus:ring-[#5B6B2E]">
                Remember for 30 days
            </label>

            <button type="submit" id="submit-btn"
                class="w-full bg-[#5B6B2E] text-[#F5EDDD] font-bold py-3.5 rounded-full text-[14px] uppercase tracking-wide hover:bg-[#3D4A1E] transition-colors shadow-md hover:shadow-lg hover:-translate-y-px duration-200">
                Sign In as User
            </button>

            <div class="flex items-center justify-between mt-5 text-[13px]">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-[#6B6352] hover:text-[#5B6B2E] transition-colors">Forgot password?</a>
                @endif
                <span class="text-[#6B6352]">No account?
                    <a href="{{ route('register') }}" class="text-[#5B6B2E] font-bold hover:text-[#2C3317] transition-colors">Sign up</a>
                </span>
            </div>
        </form>
    </div>

    {{-- Demo creds --}}
    <div class="mt-5 p-4 bg-[#5B6B2E]/08 border border-[#5B6B2E]/15 rounded-2xl text-center">
        <p class="text-[11px] font-bold text-[#2C3317] uppercase tracking-wider mb-2">Demo Credentials</p>
        <p class="text-[12px] text-[#6B6352]">User: <span class="font-mono text-[#2C3317]">user@demo.com</span> / <span class="font-mono text-[#2C3317]">password123</span></p>
        <p class="text-[12px] text-[#6B6352]">Admin: <span class="font-mono text-[#2C3317]">admin@demo.com</span> / <span class="font-mono text-[#2C3317]">admin123</span></p>
    </div>
</x-guest-layout>

<script>
function switchRole(role) {
    const userBtn  = document.getElementById('user-btn');
    const adminBtn = document.getElementById('admin-btn');
    const submitBtn = document.getElementById('submit-btn');
    document.getElementById('user_type').value = role;

    const activeClasses   = ['bg-white','shadow-sm','text-[#5B6B2E]'];
    const inactiveClasses = ['text-[#6B6352]','hover:text-[#2C3317]'];

    if (role === 'user') {
        userBtn.classList.add(...activeClasses);
        userBtn.classList.remove(...inactiveClasses);
        adminBtn.classList.remove(...activeClasses);
        adminBtn.classList.add(...inactiveClasses);
        submitBtn.textContent = 'Sign In as User';
    } else {
        adminBtn.classList.add(...activeClasses);
        adminBtn.classList.remove(...inactiveClasses);
        userBtn.classList.remove(...activeClasses);
        userBtn.classList.add(...inactiveClasses);
        submitBtn.textContent = 'Sign In as Admin';
    }
}
</script>
