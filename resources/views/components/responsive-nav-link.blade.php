@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-community-ochre text-start text-base font-medium text-community-ink bg-community-ochre/20 focus:outline-none focus:text-community-ink focus:bg-community-ochre/30 focus:border-community-ochre-dark transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-community-ink/70 hover:text-community-ink hover:bg-community-ochre/10 hover:border-community-ochre/60 focus:outline-none focus:text-community-ink focus:bg-community-ochre/10 focus:border-community-ochre transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
