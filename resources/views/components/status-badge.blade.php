@props(['status'])

@php
    // Tiga status memakai tiga warna brand, semua teks dipilih agar kontras
    // dengan latarnya (bukan bergantung pada warna saja — label tetap dibaca).
    $statuses = [
        'lost' => [
            'label' => 'Hilang',
            'classes' => 'bg-brand-rust text-white ring-brand-rust/40',
        ],
        'found' => [
            'label' => 'Ditemukan',
            'classes' => 'bg-brand-amber text-brand-dark ring-brand-amber/60',
        ],
        'claimed' => [
            'label' => 'Diklaim',
            'classes' => 'bg-brand-dark text-brand-amber ring-brand-dark/40',
        ],
    ];

    $badge = $statuses[$status] ?? [
        'label' => ucfirst((string) $status),
        'classes' => 'bg-slate-100 text-slate-700 ring-slate-200',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset '.$badge['classes']]) }}>
    {{ $badge['label'] }}
</span>
