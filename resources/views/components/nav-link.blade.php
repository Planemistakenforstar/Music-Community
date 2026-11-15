@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-community-ochre text-sm font-medium leading-5 text-community-ink focus:outline-none focus:border-community-ochre-dark transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-community-ink/70 hover:text-community-ink hover:border-community-ochre/60 focus:outline-none focus:text-community-ink focus:border-community-ochre transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
