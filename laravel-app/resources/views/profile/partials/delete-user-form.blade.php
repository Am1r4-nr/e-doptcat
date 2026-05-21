<section class="space-y-6">
    <header>
        <p class="text-[10px] tracking-widest text-rose-600 uppercase font-bold mb-1">Danger Zone</p>
        <h3 class="text-lg font-serif font-bold text-rose-700">{{ __('Delete Account') }}</h3>
        <p class="text-xs text-cozy-brown/60">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 px-6 rounded-2xl shadow-md transition-colors text-xs uppercase tracking-wider cursor-pointer"
    >{{ __('Delete Account') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-cozy-card border border-cozy-warm/30 rounded-[2rem] shadow-xl space-y-5">
            @csrf
            @method('delete')

            <div>
                <h3 class="text-lg font-serif font-bold text-rose-700">
                    {{ __('Are you sure you want to delete your account?') }}
                </h3>

                <p class="text-xs text-cozy-brown/60 mt-2">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>
            </div>

            <div>
                <label for="password" class="block text-cozy-brown text-xs font-bold mb-2 uppercase tracking-wider">{{ __('Verify Password') }}</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full py-3.5 px-5 rounded-2xl border-0 bg-cozy-light text-cozy-brown font-semibold focus:ring-2 focus:ring-cozy-accent text-sm"
                    placeholder="{{ __('Enter your account password to confirm...') }}"
                    required
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end pt-2">
                <button type="button" x-on:click="$dispatch('close')" class="bg-cozy-light hover:bg-cozy-warm/30 text-cozy-brown font-bold py-3 px-6 rounded-2xl transition-colors text-xs uppercase tracking-wider cursor-pointer mr-3">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 px-6 rounded-2xl shadow-md transition-colors text-xs uppercase tracking-wider cursor-pointer">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
