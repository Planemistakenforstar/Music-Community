<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-6xl space-y-6 px-5 sm:px-8">

            @if (auth()->user()->isArtist())
            {{-- Upload CTA --}}
            <div class="overflow-hidden rounded-lg bg-community-ink-deep font-mono text-[#fffaf0] shadow-sm">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold">Upload a track</h3>
                    <p class="mb-4 max-w-2xl text-sm leading-6 text-[#c7cbbf]">
                        Share a song with local broadcasters and podcasters. You keep the rights;
                        you grant airplay permission when you upload.
                    </p>
                    <a href="{{ route('dashboard.tracks.create') }}"
                        class="inline-flex items-center rounded-md border border-transparent bg-community-ochre px-4 py-2 text-xs font-semibold uppercase tracking-widest text-community-ink transition hover:bg-community-ochre-hover focus:outline-none focus:ring-2 focus:ring-community-ochre focus:ring-offset-2 focus:ring-offset-community-ink-deep">
                        Upload a track
                    </a>
                </div>
            </div>

            {{-- My tracks --}}
            <div class="overflow-hidden rounded-lg bg-community-ink-panel font-mono text-[#fffaf0] shadow-sm">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold">My tracks</h3>
                    @forelse (auth()->user()->tracks()->latest()->get() as $track)
                    <div class="flex items-center justify-between border-b border-white/10 py-3 last:border-0">
                        <div>
                            <a href="{{ route('tracks.show', $track) }}"
                                class="font-medium transition hover:text-[#e5b64f] hover:underline">
                                {{ $track->title }}
                            </a>
                            <span class="ml-2 text-xs text-[#c7cbbf]">
                                {{ $track->status }} · {{ $track->plays()->count() }} plays
                            </span>
                        </div>
                        @if ($track->airplay_permission)
                        <span class="rounded-full bg-community-ochre px-2 py-1 text-xs font-medium text-community-ink">cleared</span>
                        @else
                        <span class="text-xs text-[#c7cbbf]">not cleared</span>
                        @endif
                    </div>
                    @empty
                    <p class="text-sm text-[#c7cbbf]">No tracks yet.</p>
                    @endforelse
                </div>
            </div>
            @endif

            {{-- Original Breeze welcome block --}}
            <div class="overflow-hidden rounded-lg bg-community-ink font-mono text-[#fffaf0] shadow-sm">
                <div class="p-6">
                    {{ __("You're logged in!") }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>