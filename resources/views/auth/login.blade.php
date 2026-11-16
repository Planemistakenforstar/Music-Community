<x-guest-layout>
    <div class="mb-6 text-center">
        <a href="/" class="inline-flex items-center gap-2 font-semibold text-lg">
            <span class="inline-flex h-8 w-8 items-center justify-center rounded-md bg-community-ochre text-community-ink">♪</span>
            <span>Community member</span></span>
        </a>
        <h1>Welcome back</h1>
    </div>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="my-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="my-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between my-6">
            <x-input-label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300  shadow-sm focus:ring-community-ochre"
                    name="remember">
                <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
            </x-input-label>
            @if (Route::has('password.request'))
            <a class="text-sm underline hover:text-gray-900"
                href="{{ route('password.request') }}">
                {{ __('Forgot password?') }}
            </a>
            @endif
        </div>
        <x-primary-button class="w-full justify-center bg-community-ochre text-community-ink hover:bg-community-ochre-hover focus:ring-community-ochre">
            {{ __('Log in') }}
        </x-primary-button>
        @if (Route::has('register'))
        <p class="text-center text-sm mt-3">
            No account?
            <a href="{{ route('register') }}" class="font-semibold text-community-ochre-dark hover:text-community-ink">
                Create one
            </a>
        </p>
        @endif
    </form>
</x-guest-layout>