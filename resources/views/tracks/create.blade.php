<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload a track') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-3">
                <div class="grid-cols-12 sm:grid-cols-6 bg-community-ink-panel font-mono text-[#fffaf0] shadow-sm sm:rounded-lg p-4">
                    <div class="p-8">
                        <div class="mb-6 text-center">
                            <div class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-[#e5b64f] text-[#182723] text-lg">
                                ♪
                            </div>
                            <h1 class="mt-4 text-xl font-bold text-[#fffaf0]">Share a track</h1>
                            <p class="mt-1 text-sm text-gray-300">
                                Local broadcasters and podcasters can play this on air, royalty-free, with credit to you.
                            </p>
                        </div>

                        @if (session('status'))
                        <div class="mb-6 rounded-md bg-green-50 p-3 text-sm text-green-700">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('dashboard.tracks.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="my-4">
                                <x-input-label class="!text-[#fffaf0]" for="title" :value="__('Title')" />
                                <x-text-input id="title" class="mt-1 block w-full bg-[#fffaf0] text-[#182723] placeholder:text-gray-500" type="text"
                                    name="title" :value="old('title')" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-4">
                                <div>
                                    <x-input-label class="!text-[#fffaf0]" for="genre" :value="__('Genre')" />
                                    <x-text-input id="genre" class="mt-1 block w-full bg-[#fffaf0] text-[#182723] placeholder:text-gray-500" type="text"
                                        name="genre" :value="old('genre')" placeholder="e.g. indie rock" />
                                    <x-input-error :messages="$errors->get('genre')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label class="!text-[#fffaf0]" for="city" :value="__('City')" />
                                    <x-text-input id="city" class="mt-1 block w-full bg-[#fffaf0] text-[#182723] placeholder:text-gray-500" type="text"
                                        name="city" :value="old('city')" placeholder="e.g. Thessaloniki" />
                                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                </div>
                            </div>

                            <div class="my-4">
                                <x-input-label class="!text-[#fffaf0]" for="file" :value="__('Audio file (mp3 or wav, max 20MB)')" />
                                <input id="file" type="file" name="file" accept=".mp3,.wav,audio/*" required
                                    class="mt-1 block w-full text-sm text-[#fffaf0]
                                          file:mr-3 file:rounded-md file:border-0
                                          file:bg-community-ink file:px-4 file:py-2
                                          file:text-sm file:font-medium file:text-white
                                          hover:file:bg-community-ink-hover">
                                <x-input-error :messages="$errors->get('file')" class="mt-2" />
                            </div>

                            <div class="my-6 rounded-md border border-gray-200 bg-gray-50 p-4">
                                <label for="airplay_permission" class="flex items-start gap-3">
                                    <input id="airplay_permission" type="checkbox" name="airplay_permission" value="1"
                                        {{ old('airplay_permission') ? 'checked' : '' }}
                                        class="mt-1 rounded border-gray-300 text-[#e5b64f] shadow-sm focus:ring-[#e5b64f]">
                                    <span class="text-sm text-gray-700">
                                        I own this recording and allow local broadcasters and podcasters to play it on air,
                                        royalty-free, with credit to me. I can revoke this permission at any time.
                                    </span>
                                </label>
                                <x-input-error :messages="$errors->get('airplay_permission')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-between my-6">
                                <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 underline hover:text-gray-900">
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center rounded-md bg-[#e5b64f] px-4 py-2 text-xs font-semibold uppercase tracking-wider text-[#182723] transition hover:bg-[#d7a93f] focus:outline-none focus:ring-2 focus:ring-[#e5b64f] focus:ring-offset-2 focus:ring-offset-community-ink-panel">
                                    {{ __('Upload track') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="flex items-start gap-4 rounded-lg bg-community-ink font-mono text-[#fffaf0] p-6 shadow-sm sm:p-8">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/10 text-lg text-[#e5b64f]" aria-hidden="true">✎</span>
                    <div>
                        <p class="text-[10px] uppercase tracking-[0.16em] text-[#e5b64f]">Coming soon</p>
                        <h2 class="mt-2 text-xl font-semibold">Add your lyrics</h2>
                        <p class="mt-2 text-sm leading-6 text-[#c7cbbf]">
                            Lyrics sharing is not available yet. For now, you can add and showcase your track here.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>