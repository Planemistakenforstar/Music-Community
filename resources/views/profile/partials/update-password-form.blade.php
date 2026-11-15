<section>
    <header>
        <h2 class="text-lg font-medium text-[#fffaf0]">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-[#c7cbbf]">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label class="!text-[#fffaf0]" for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full bg-[#f1ecdf] text-[#182723]" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="!text-community-ochre mt-2" />
        </div>

        <div>
            <x-input-label class="!text-[#fffaf0]" for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full bg-[#f1ecdf] text-[#182723]" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="!text-community-ochre mt-2" />
        </div>

        <div>
            <x-input-label class="!text-[#fffaf0]" for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-[#f1ecdf] text-[#182723]" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="!text-community-ochre mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-[#c7cbbf]"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
