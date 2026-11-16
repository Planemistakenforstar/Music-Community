<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My tracks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-community-ink">My tracks</h1>
                @if (auth()->user()->isArtist())
                    <a href="{{ route('dashboard.tracks.create') }}" class="rounded-md bg-community-ink px-4 py-2 text-sm text-white">
                        Upload a track
                    </a>
                @endif
            </div>

            <div class="space-y-3">
                @forelse ($tracks as $track)
                    <article class="rounded-lg bg-community-ink-panel p-4 text-[#fffaf0]">
                        <h2 class="font-semibold">{{ $track->title }}</h2>
                        <p class="mt-1 text-sm text-[#c7cbbf]">
                            Status: {{ $track->status === 'draft' ? 'Pending review' : ucfirst($track->status) }}
                        </p>
                    </article>
                @empty
                    <p class="rounded-lg bg-community-ink-panel p-4 text-[#fffaf0]">You have not uploaded any tracks yet.</p>
                @endforelse
            </div>

            <div class="mt-6">{{ $tracks->links() }}</div>
        </div>
    </div>
</x-app-layout>
