<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-[28px] font-serif font-bold text-[#2C3317]">Join e-Doptcat</h2>
        <p class="text-[#6B6352] mt-1 text-[14px]">Create your account to start helping cats</p>
    </div>

    <div class="bg-white/80 backdrop-blur-sm p-8 rounded-3xl shadow-xl border border-[#EDE4D3] w-full">

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="flex gap-3 mb-4">
                <div class="flex-1">
                    <label for="first_name" class="block text-[12px] font-bold text-[#2C3317] uppercase tracking-wider mb-1.5">First Name</label>
                    <input id="first_name" type="text" name="first_name" :value="old('first_name')" required autofocus
                        placeholder="John"
                        class="w-full px-4 py-3 rounded-xl bg-[#F5EDDD] border-transparent focus:border-[#5B6B2E] focus:bg-white focus:ring-0 text-[14px] text-[#2C3317] transition-colors"/>
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>
                </div>
                <div class="flex-1">
                    <label for="last_name" class="block text-[12px] font-bold text-[#2C3317] uppercase tracking-wider mb-1.5">Last Name</label>
                    <input id="last_name" type="text" name="last_name" :value="old('last_name')" required
                        placeholder="Doe"
                        class="w-full px-4 py-3 rounded-xl bg-[#F5EDDD] border-transparent focus:border-[#5B6B2E] focus:bg-white focus:ring-0 text-[14px] text-[#2C3317] transition-colors"/>
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
                </div>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-[12px] font-bold text-[#2C3317] uppercase tracking-wider mb-1.5">Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required
                    placeholder="your.email@university.edu"
                    class="w-full px-4 py-3 rounded-xl bg-[#F5EDDD] border-transparent focus:border-[#5B6B2E] focus:bg-white focus:ring-0 text-[14px] text-[#2C3317] transition-colors"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-[12px] font-bold text-[#2C3317] uppercase tracking-wider mb-1.5">Phone Number</label>
                <input id="phone" type="text" name="phone" :value="old('phone')" required
                    placeholder="+60 12-345 6789"
                    class="w-full px-4 py-3 rounded-xl bg-[#F5EDDD] border-transparent focus:border-[#5B6B2E] focus:bg-white focus:ring-0 text-[14px] text-[#2C3317] transition-colors"/>
                <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-[12px] font-bold text-[#2C3317] uppercase tracking-wider mb-1.5">Password</label>
                <input id="password" type="password" name="password" required
                    placeholder="Enter a strong password"
                    class="w-full px-4 py-3 rounded-xl bg-[#F5EDDD] border-transparent focus:border-[#5B6B2E] focus:bg-white focus:ring-0 text-[14px] text-[#2C3317] transition-colors"/>
                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <div class="mb-5">
                <label for="password_confirmation" class="block text-[12px] font-bold text-[#2C3317] uppercase tracking-wider mb-1.5">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    placeholder="Confirm your password"
                    oninput="checkPasswordMatch()"
                    class="w-full px-4 py-3 rounded-xl bg-[#F5EDDD] border-transparent focus:border-[#5B6B2E] focus:bg-white focus:ring-0 text-[14px] text-[#2C3317] transition-colors"/>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                <div id="password-match-status" class="mt-1.5 text-[13px] font-semibold hidden"></div>
            </div>

            <div class="mb-6 space-y-2.5">
                <label class="flex items-start gap-2.5 cursor-pointer">
                    <input id="terms" type="checkbox" name="terms" required
                        class="mt-0.5 w-4 h-4 text-[#5B6B2E] border-[#EDE4D3] rounded focus:ring-[#5B6B2E]">
                    <span class="text-[13px] text-[#6B6352]">I agree to the
                        <a href="#" class="text-[#5B6B2E] font-bold hover:text-[#2C3317]">Terms and Conditions</a>
                    </span>
                </label>
                <label class="flex items-start gap-2.5 cursor-pointer">
                    <input id="newsletter" type="checkbox" name="newsletter"
                        class="mt-0.5 w-4 h-4 text-[#5B6B2E] border-[#EDE4D3] rounded focus:ring-[#5B6B2E]">
                    <span class="text-[13px] text-[#6B6352]">I'd like to receive updates about cat adoptions and AHC activities</span>
                </label>
            </div>

            <button type="submit"
                class="w-full bg-[#5B6B2E] text-[#F5EDDD] font-bold py-3.5 rounded-full text-[14px] uppercase tracking-wide hover:bg-[#3D4A1E] transition-colors shadow-md hover:shadow-lg hover:-translate-y-px duration-200">
                Create Account
            </button>

            <div class="flex items-center justify-between mt-5 text-[13px]">
                <span class="text-[#6B6352]">Already have an account?
                    <a href="{{ route('login') }}" class="text-[#5B6B2E] font-bold hover:text-[#2C3317] transition-colors">Sign in</a>
                </span>
            </div>
        </form>
    </div>
</x-guest-layout>

<script>
function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirm  = document.getElementById('password_confirmation').value;
    const status   = document.getElementById('password-match-status');
    if (!confirm) { status.classList.add('hidden'); return; }
    status.classList.remove('hidden','text-red-500','text-[#5B6B2E]');
    if (password === confirm) {
        status.classList.add('text-[#5B6B2E]');
        status.textContent = '✓ Passwords match';
    } else {
        status.classList.add('text-red-500');
        status.textContent = '✗ Passwords do not match';
    }
}
</script>
