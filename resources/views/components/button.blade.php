@props([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
])

@php
    $variants = [
        'primary' => 'bg-indigo-600 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-indigo-600',
        'danger' => 'bg-rose-600 text-white shadow-sm hover:bg-rose-500 focus-visible:outline-rose-600',
        'success' => 'bg-emerald-600 text-white shadow-sm hover:bg-emerald-500 focus-visible:outline-emerald-600',
        'ghost' => 'bg-white text-slate-700 ring-1 ring-inset ring-slate-300 hover:bg-slate-50 focus-visible:outline-slate-400',
    ];

    $sizes = [
        'sm' => 'px-3 py-2 text-xs',
        'md' => 'px-4 py-2.5 text-sm',
    ];

    $classes = 'inline-flex items-center justify-center gap-2 rounded-lg font-semibold transition focus-visible:outline-2 focus-visible:outline-offset-2 '
        . ($variants[$variant] ?? $variants['primary'])
        . ' '
        . ($sizes[$size] ?? $sizes['md']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
