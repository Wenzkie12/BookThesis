@props([
    'title',
    'value',
    'variant' => 'light' 
])

@php
    $baseClasses = 'p-6 rounded-lg shadow';
    $bgClass = $variant === 'secondary'
        ? 'bg-secondary opacity-50 text-text'
        : 'bg-secondary text-text ';
@endphp

<div class="{{ $baseClasses }} {{ $bgClass }}">
    <h2 class="text-lg font-semibold mb-2  text-text">{{ $title }}</h2>
    <p class="text-2xl font-bold">{{ $value }}</p>
</div>
