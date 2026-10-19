@props([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
])

@php
    // Palet brand: primary = rust (aksi utama) dan ghost = netral di atas latar
    // terang. Semua tombol aksi sengaja memakai primary agar warnanya seragam;
    // nilai hex hanya ada di @theme app.css.
    $variants = [
        'primary' => 'bg-brand-rust text-white shadow-sm hover:bg-brand-rust/90 focus-visible:outline-brand-rust',
        'ghost' => 'bg-white text-brand-dark ring-1 ring-inset ring-brand-dark/20 hover:bg-brand-amber/15 focus-visible:outline-brand-dark',
    ];

    $sizes = [
        'sm' => 'px-3 py-2 text-xs',
        'md' => 'px-4 py-2.5 text-sm',
    ];

    $classes = 'inline-flex items-center justify-center gap-2 rounded-lg font-semibold transition focus-visible:outline-2 focus-visible:outline-offset-2 disabled:cursor-not-allowed disabled:opacity-60 '
        . ($variants[$variant] ?? $variants['primary'])
        . ' '
        . ($sizes[$size] ?? $sizes['md']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
