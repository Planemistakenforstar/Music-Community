<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tracks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-lg bg-community-ink-panel font-mono text-[#fffaf0] shadow-sm">
                <div class="p-6 sm:p-10">
                    @if (session('status'))
                    <div class="mb-6 rounded-md border border-white/10 bg-community-ink px-4 py-3 text-sm text-[#fffaf0]">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="mb-8 flex items-start gap-5">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-[#e5b64f] text-2xl text-[#182723]" aria-hidden="true">
                            ♫
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] uppercase tracking-[0.16em] text-[#e5b64f]">Community track</p>
                            <h1 class="font-display mt-2 break-words text-4xl leading-none text-[#fffaf0] sm:text-5xl">{{ $track->title }}</h1>
                            <p class="mt-3 text-xs text-[#c7cbbf]">
                                {{ $track->artist->name }}@if($track->city) <span class="px-1">/</span>{{ $track->city }}@endif
                                @if($track->genre) <span class="px-1">/</span>{{ $track->genre }}@endif
                            </p>
                        </div>
                    </div>

                    <div class="rounded-md bg-[#f1ecdf] p-3 sm:p-4">
                        <audio controls src="{{ Storage::url($track->file_path) }}" class="w-full accent-[#e5b64f]"></audio>
                    </div>

                    <div class="mt-5 flex flex-wrap items-center justify-between gap-3 border-t border-white/10 pt-4 text-[10px] uppercase tracking-wider text-[#c7cbbf]">
                        <span>
                            Airplay
                            @if($track->airplay_permission)
                                <span class="ml-2 text-community-ochre">Cleared</span>
                            @else
                                <span class="ml-2 text-[#c7cbbf]">Not cleared</span>
                            @endif
                        </span>
                        <span>{{ $track->plays()->count() }} plays</span>
                    </div>

                    <div class="mt-7">
                        <a href="{{ route('tracks.index') }}" class="inline-flex items-center gap-2 text-[10px] uppercase tracking-[0.14em] text-[#c7cbbf] transition hover:text-[#e5b64f]">
                            <span aria-hidden="true">←</span> All tracks
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>