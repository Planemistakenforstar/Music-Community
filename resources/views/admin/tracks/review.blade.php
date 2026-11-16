<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Track review') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <h1 class="mb-6 text-2xl font-semibold text-community-ink">Tracks awaiting review</h1>

            <div class="space-y-4">
                @forelse ($tracks as $track)
                    <article class="flex items-center justify-between gap-4 rounded-lg bg-community-ink-panel p-4 text-[#fffaf0]">
                        <div>
                            <h2 class="font-semibold">{{ $track->title }}</h2>
                            <p class="mt-1 text-sm text-[#c7cbbf]">
                                {{ $track->artist->name }} · {{ $track->genre ?: 'Genre not specified' }} · {{ $track->city ?: 'City not specified' }}
                            </p>
                        </div>
                        <form method="POST" action="{{ route('admin.tracks.publish', $track) }}">
                            @csrf
                            <button type="submit" class="rounded-md bg-community-ochre px-4 py-2 text-sm font-semibold text-community-ink">
                                Publish
                            </button>
                        </form>
                    </article>
                @empty
                    <p class="rounded-lg bg-community-ink-panel p-4 text-[#fffaf0]">No tracks are awaiting review.</p>
                @endforelse
            </div>

            <div class="mt-6">{{ $tracks->links() }}</div>
        </div>
    </div>
</x-app-layout>
