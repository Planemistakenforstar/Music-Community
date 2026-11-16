@php
    $containerClass = $containerClass ?? '';
    $linkClass = $linkClass ?? '';
    $activeClass = $activeClass ?? '';
    $inactiveClass = $inactiveClass ?? '';
    $links = [
        [
            'label' => __('Listen'),
            'href' => request()->routeIs('home') ? '#tracks' : route('tracks.index'),
            'active' => request()->routeIs('tracks.*'),
        ],
        [
            'label' => __('Lessons'),
            'href' => request()->routeIs('home') ? '#lessons' : route('lessons'),
            'active' => request()->routeIs('lessons'),
        ],
        [
            'label' => __('Forum'),
            'href' => route('forum'),
            'active' => request()->routeIs('forum'),
        ],
        [
            'label' => __('Dashboard'),
            'href' => route('dashboard'),
            'active' => request()->routeIs('dashboard', 'dashboard.*'),
        ],
    ];
@endphp

<div class="{{ $containerClass }}">
    @foreach ($links as $link)
        <a
            href="{{ $link['href'] }}"
            class="{{ $linkClass }} {{ $link['active'] ? $activeClass : $inactiveClass }}"
            @if ($link['active']) aria-current="page" @endif
        >
            {{ $link['label'] }}
        </a>
    @endforeach
</div>
