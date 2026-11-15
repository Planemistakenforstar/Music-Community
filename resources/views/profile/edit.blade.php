<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-community-ink leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                <div class="mt-3 rounded-lg bg-community-ink-panel p-5 font-mono text-[#fffaf0] shadow-sm sm:p-7">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="mt-3 rounded-lg bg-community-ink-panel p-5 font-mono text-[#fffaf0] shadow-sm sm:p-7">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="mt-3 rounded-lg bg-community-ink-deep p-5 font-mono text-[#fffaf0] shadow-sm sm:p-7">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
