<section>
    <header>
        <h2 class="text-lg font-medium text-[#fffaf0]">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-[#c7cbbf]">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label class="!text-[#fffaf0]" for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-[#f1ecdf] text-[#182723]" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="!text-community-ochre mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label class="!text-[#fffaf0]" for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-[#f1ecdf] text-[#182723]" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="!text-community-ochre mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-[#fffaf0]">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="rounded-md text-sm text-community-ochre underline hover:text-[#fffaf0] focus:outline-none focus:ring-2 focus:ring-community-ochre focus:ring-offset-2 focus:ring-offset-community-ink-panel">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-community-ochre">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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
