@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-community-ink/25 focus:border-community-ochre focus:ring-community-ochre rounded-md shadow-sm']) !!}>
