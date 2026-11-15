<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Piraeus Music Community</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-mono:400,500|instrument-serif:400,400i&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#f1ecdf] font-mono text-[#182723]">
    <header class="border-b border-[#182723]/20">
        <nav class="mx-auto flex max-w-6xl items-center justify-between px-5 py-5 sm:px-8">
            <a href="{{ url('/') }}" class="text-xs font-medium uppercase tracking-[0.12em] sm:text-sm">
                <span class="mr-2 text-community-ochre-dark">✳</span>Piraeus Music Community
            </a>
            <div class="flex items-center gap-4 text-[11px] uppercase tracking-wider sm:gap-7 sm:text-xs">
                <a href="#tracks" class="transition hover:text-community-ochre-dark">Listen</a>
                <a href="#lessons" class="hidden transition hover:text-community-ochre-dark sm:inline">Take part</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="border-b border-[#182723] pb-1 hover:text-community-ochre-dark">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hidden transition hover:text-community-ochre-dark sm:inline">Log in</a>
                    <a href="{{ route('register') }}" class="bg-community-ochre px-3 py-2 text-community-ink transition hover:bg-community-ochre-hover">
                        Join us
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-6xl px-5 sm:px-8">
        <section class="grid min-h-[480px] items-center gap-8 py-16 sm:grid-cols-[1.25fr_0.75fr] sm:py-20">
            <div>
                <p class="text-[11px] uppercase tracking-[0.2em] text-community-ochre-dark">A neighborhood sound / Piraeus, Greece</p>
                <h1 class="font-display mt-6 max-w-3xl text-6xl leading-[0.92] tracking-tight sm:text-8xl">
                    The music<br>happening <em class="text-community-ochre-dark">here.</em>
                </h1>
                <p class="mt-7 max-w-lg text-xs leading-6 text-[#46534b] sm:text-sm sm:leading-7">
                    A meeting place for the people making noise around the port. Find new music, share your own, and get together to play.
                </p>
                <a href="#tracks" class="mt-8 inline-flex items-center gap-3 border-b border-[#182723] pb-2 text-[11px] uppercase tracking-[0.14em] transition hover:border-community-ochre-dark hover:text-community-ochre-dark">
                    Hear what’s here <span aria-hidden="true">↓</span>
                </a>
            </div>

            <div class="relative mx-auto flex aspect-square w-full max-w-[290px] items-center justify-center sm:max-w-[340px]" aria-label="Illustration of a vinyl record">
                <div class="absolute inset-0 rounded-full border border-[#182723]/20"></div>
                <div class="absolute inset-[5%] rounded-full border border-[#182723]/10"></div>
                <div class="absolute inset-[13%] rounded-full bg-[#1f302b] shadow-[8px_10px_0_rgba(24,39,35,0.12)]">
                    <div class="absolute inset-[8%] rounded-full border border-white/10"></div>
                    <div class="absolute inset-[18%] rounded-full border border-white/10"></div>
                    <div class="absolute inset-[28%] rounded-full border border-white/10"></div>
                    <div class="absolute inset-[38%] rounded-full border border-white/10"></div>
                    <div class="absolute inset-[34%] flex items-center justify-center rounded-full bg-[#e5b64f] text-center text-[9px] uppercase leading-4 tracking-widest text-[#182723]">
                        Piraeus<br>side A
                    </div>
                    <div class="absolute left-1/2 top-1/2 h-2 w-2 -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#182723]"></div>
                </div>
                <span class="absolute bottom-1 left-0 text-[9px] uppercase tracking-[0.18em] text-[#657168]">37°56' N / 23°38' E</span>
                <span class="absolute right-0 top-2 rotate-90 text-[9px] uppercase tracking-[0.18em] text-[#657168]">Independent by nature</span>
            </div>
        </section>

        <section id="tracks" class="scroll-mt-8 border-t border-[#182723]/25 py-12 sm:py-16">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-community-ochre-dark">Fresh from the neighborhood</p>
                    <h2 class="font-display mt-3 text-4xl sm:text-5xl">Put a record on.</h2>
                </div>
                <a href="{{ route('tracks.index') }}" class="shrink-0 border-b border-[#182723]/50 pb-1 text-[10px] uppercase tracking-wider transition hover:border-community-ochre-dark hover:text-community-ochre-dark">
                    All tracks ↗
                </a>
            </div>

            <div class="mt-8 divide-y divide-[#182723]/20 border-y border-[#182723]/20">
                @forelse ($tracks as $track)
                    <article class="group flex items-center gap-4 py-4 sm:gap-6">
                        <span class="w-7 shrink-0 text-xs text-[#8a8b7d]">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center bg-community-ochre text-xl text-[#182723] transition group-hover:rotate-3 group-hover:bg-community-ochre-hover" aria-hidden="true">♫</div>
                        <div class="min-w-0 flex-1">
                            <h3 class="font-display truncate text-lg leading-tight sm:text-2xl">
                                <a href="{{ route('tracks.show', $track) }}" class="transition group-hover:text-community-ochre-dark">{{ $track->title }}</a>
                            </h3>
                            <p class="mt-1 truncate text-[10px] uppercase tracking-wider text-[#657168]">
                                {{ $track->artist->name }}@if ($track->city) <span class="px-1">/</span>{{ $track->city }}@endif
                            </p>
                        </div>
                        @if ($track->genre)
                            <span class="hidden text-[9px] uppercase tracking-widest text-[#8a8b7d] sm:inline">{{ $track->genre }}</span>
                        @endif
                        <a href="{{ route('tracks.show', $track) }}" aria-label="Listen to {{ $track->title }}" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-[#182723]/30 text-sm transition hover:border-community-ochre hover:bg-community-ochre hover:text-[#182723]">▶</a>
                    </article>
                @empty
                    <p class="py-8 text-xs leading-6 text-[#657168]">
                        No tracks have been shared yet. Be the first to add a sound to the neighborhood.
                    </p>
                @endforelse
            </div>
        </section>

        <section id="lessons" class="scroll-mt-8 grid gap-8 border-t border-[#182723]/25 py-12 sm:grid-cols-[0.8fr_1.2fr] sm:py-16">
            <div>
                <p class="text-[10px] uppercase tracking-[0.2em] text-community-ochre-dark">Not just listening</p>
                <h2 class="font-display mt-3 text-4xl leading-none sm:text-5xl">Pass it<br>around.</h2>
            </div>
            <div class="border-l-2 border-[#e5b64f] pl-5 sm:pl-8">
                <p class="text-xs leading-6 text-[#46534b] sm:text-sm sm:leading-7">
                    Lessons, instrument swaps, gatherings, open jams—there’s room for all of it. We’re building a place for the scene to teach, trade, and meet.
                </p>
                @guest
                    <a href="{{ route('register') }}" class="mt-5 inline-flex border-b border-[#182723] pb-1 text-[10px] uppercase tracking-[0.14em] transition hover:border-community-ochre-dark hover:text-community-ochre-dark">
                        Get involved <span class="ml-2">↗</span>
                    </a>
                @endguest
            </div>
        </section>
    </main>

    <footer class="border-t border-[#182723]/25">
        <div class="mx-auto flex max-w-6xl flex-col gap-2 px-5 py-6 text-[9px] uppercase tracking-[0.15em] text-[#657168] sm:flex-row sm:items-center sm:justify-between sm:px-8">
            <span>Piraeus Music Community</span>
            <span>Made around the port of Athens</span>
        </div>
    </footer>

    <x-cookie-consent />
</body>
</html>
