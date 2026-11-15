<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <p class="text-xs uppercase tracking-[0.18em] text-community-ochre-dark">Piraeus music community</p>
            <h1 class="font-display mt-3 text-4xl text-community-ink sm:text-5xl">The forum</h1>

            <section class="mt-8 max-w-3xl rounded-lg border-l-4 border-community-ochre bg-community-ink-panel p-6 font-mono text-[#fffaf0] shadow-sm sm:p-8">
                <p class="text-xs uppercase tracking-[0.16em] text-community-ochre">Community board</p>
                <h2 class="mt-3 text-xl font-semibold">A place for the scene to meet.</h2>
                <p class="mt-3 text-sm leading-6 text-[#c7cbbf]">
                    The forum is taking shape. It will be a home for instrument listings, local gatherings, and open jams.
                </p>
                <a href="{{ route('dashboard') }}" class="mt-6 inline-flex items-center gap-2 text-xs uppercase tracking-wider text-community-ochre transition hover:text-[#fffaf0]">
                    <span aria-hidden="true">←</span> Back to dashboard
                </a>
            </section>
        </div>
    </div>
</x-app-layout>
