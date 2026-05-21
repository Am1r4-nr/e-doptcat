<section class="space-y-6">
    <header>
        <p class="text-[10px] tracking-widest text-cozy-accent uppercase font-bold mb-1">Security</p>
        <h3 class="text-lg font-serif font-bold text-cozy-brown">{{ __('Update Password') }}</h3>
        <p class="text-xs text-cozy-brown/60">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-cozy-brown text-xs font-bold mb-2 uppercase tracking-wider">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                class="w-full py-3 px-4 rounded-2xl border-0 bg-cozy-light text-cozy-brown font-semibold focus:ring-2 focus:ring-cozy-accent text-sm" 
                autocomplete="current-password" required />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-cozy-brown text-xs font-bold mb-2 uppercase tracking-wider">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" 
                class="w-full py-3 px-4 rounded-2xl border-0 bg-cozy-light text-cozy-brown font-semibold focus:ring-2 focus:ring-cozy-accent text-sm" 
                autocomplete="new-password" required />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-cozy-brown text-xs font-bold mb-2 uppercase tracking-wider">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                class="w-full py-3 px-4 rounded-2xl border-0 bg-cozy-light text-cozy-brown font-semibold focus:ring-2 focus:ring-cozy-accent text-sm" 
                autocomplete="new-password" required />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-1">
            <button type="submit" class="bg-cozy-brown hover:bg-cozy-accent text-cozy-light hover:text-cozy-brown font-bold py-3 px-6 rounded-2xl shadow-md transition-colors text-xs uppercase tracking-wider cursor-pointer">
                {{ __('Save Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-xs text-emerald-600 font-bold uppercase tracking-wider"
                >{{ __('Saved successfully.') }}</p>
            @endif
        </div>
    </form>
</section>
