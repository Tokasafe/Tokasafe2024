@props(['active'])

@php
    $classes = $active ?? false ? 'text-green-300 font-semibold' : '';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
