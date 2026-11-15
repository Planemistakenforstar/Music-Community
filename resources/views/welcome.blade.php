<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Piraeus Music Community</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900">
    <header class="border-b border-gray-200 bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
            <a href="{{ url('/') }}" class="font-semibold text-lg">Piraeus Music Community</a>
            <div class="flex items-center gap-4 text-sm">
                <a href="#tracks" class="text-gray-700 hover:text-red-600">Tracks</a>
                <a href="#lessons" class="text-gray-700 hover:text-red-600">Lessons</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-md bg-red-600 px-4 py-2 font-semibold text-white hover:bg-red-700">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-600">Log in</a>
                    <a href="{{ route('register') }}" class="rounded-md bg-red-600 px-4 py-2 font-semibold text-white hover:bg-red-700">
                        Join the community
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-6">
        <section class="py-16 sm:py-20">
            <p class="text-sm font-semibold uppercase tracking-wide text-red-600">Piraeus · The port of Athens</p>
            <h1 class="mt-3 max-w-3xl text-4xl font-bold tracking-tight sm:text-5xl">
                Music made and shared in our community.
            </h1>
            <p class="mt-5 max-w-2xl text-lg leading-7 text-gray-600">
                Discover tracks from local artists, find opportunities to learn, and connect with musicians
                around Piraeus.
            </p>
            <a href="#tracks" class="mt-7 inline-flex rounded-md bg-red-600 px-5 py-3 font-semibold text-white hover:bg-red-700">
                Explore tracks
            </a>
        </section>

        <section id="tracks" class="border-t border-gray-200 py-12">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold">Community tracks</h2>
                    <p class="mt-2 text-gray-600">Recent tracks shared by local artists.</p>
                </div>
                <a href="{{ route('tracks.index') }}" class="shrink-0 text-sm font-semibold text-red-700 hover:underline">
                    Browse all tracks
                </a>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($tracks as $track)
                    <article class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
                        <h3 class="font-semibold">
                            <a href="{{ route('tracks.show', $track) }}" class="hover:text-red-700 hover:underline">
                                {{ $track->title }}
                            </a>
                        </h3>
                        <p class="mt-2 text-sm text-gray-600">
                            {{ $track->artist->name }}
                            @if ($track->city)
                                <span> · {{ $track->city }}</span>
                            @endif
                        </p>
                        @if ($track->genre)
                            <p class="mt-3 text-xs font-medium uppercase tracking-wide text-gray-500">{{ $track->genre }}</p>
                        @endif
                    </article>
                @empty
                    <p class="rounded-xl bg-white p-5 text-gray-600 ring-1 ring-gray-200 sm:col-span-2 lg:col-span-3">
                        No tracks have been shared yet. Check back soon for music from local artists.
                    </p>
                @endforelse
            </div>
        </section>

        <section id="lessons" class="border-t border-gray-200 py-12">
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8">
                <p class="text-sm font-semibold uppercase tracking-wide text-red-600">Coming soon</p>
                <h2 class="mt-2 text-2xl font-bold">Lessons from the community</h2>
                <p class="mt-3 max-w-2xl leading-7 text-gray-600">
                    We’re preparing a place for local musicians to share lessons and practical knowledge.
                    Community events, instrument listings, and open jams can help musicians meet and learn together.
                </p>
                @guest
                    <a href="{{ route('register') }}" class="mt-5 inline-flex font-semibold text-red-700 hover:underline">
                        Join the community
                    </a>
                @endguest
            </div>
        </section>
    </main>

    <footer class="mt-8 border-t border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-6 text-sm text-gray-500">
            A community music project in Piraeus, Athens.
        </div>
    </footer>

    <x-cookie-consent />
</body>
</html>
