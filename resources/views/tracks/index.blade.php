<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs uppercase tracking-[0.18em] text-community-ochre-dark">Piraeus music community</p>
                    <h1 class="font-display mt-3 text-4xl text-community-ink sm:text-5xl">Tracks from the scene</h1>
                    <p class="mt-2 text-sm text-community-ink/70">Music shared by local artists.</p>
                </div>
                @auth
                    @if (auth()->user()->isArtist())
                        <a href="{{ route('dashboard.tracks.create') }}" class="shrink-0 rounded-md bg-community-ink px-4 py-2 text-xs font-semibold uppercase tracking-wider text-[#fffaf0] transition hover:bg-community-ink-hover">
                            Share a track
                        </a>
                    @endif
                @endauth
            </div>

            <div class="space-y-3">
                @forelse ($tracks as $track)
                    <article class="group flex items-center gap-4 rounded-lg bg-community-ink-panel p-4 font-mono text-[#fffaf0] shadow-sm transition hover:bg-community-ink sm:gap-6 sm:p-5">
                        <span class="w-7 shrink-0 text-xs text-community-ochre">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-community-ochre text-lg text-community-ink transition group-hover:rotate-3 group-hover:bg-community-ochre-hover" aria-hidden="true">♫</div>
                        <div class="min-w-0 flex-1">
                            <h2 class="font-display truncate text-2xl leading-tight">
                                <a href="{{ route('tracks.show', $track) }}" class="transition hover:text-community-ochre">{{ $track->title }}</a>
                            </h2>
                            <p class="mt-1 truncate text-[10px] uppercase tracking-wider text-[#c7cbbf]">
                                {{ $track->artist->name }}
                                @if ($track->city) <span class="px-1">/</span>{{ $track->city }} @endif
                                @if ($track->genre) <span class="px-1">/</span>{{ $track->genre }} @endif
                            </p>
                        </div>
                        <span class="hidden shrink-0 text-[10px] uppercase tracking-wider text-[#c7cbbf] sm:inline">{{ $track->plays()->count() }} plays</span>
                        <a href="{{ route('tracks.show', $track) }}" aria-label="Listen to {{ $track->title }}" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-community-ochre/60 text-xs text-community-ochre transition hover:bg-community-ochre hover:text-community-ink">▶</a>
                    </article>
                @empty
                    <div class="rounded-lg border border-dashed border-community-ink/25 bg-community-ink-panel p-8 font-mono text-sm text-[#fffaf0]">
                        <p class="text-community-ochre">No tracks yet.</p>
                        <p class="mt-2 text-[#c7cbbf]">The first sound from the community could be yours.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">{{ $tracks->links() }}</div>
        </div>
    </div>
</x-app-layout>
