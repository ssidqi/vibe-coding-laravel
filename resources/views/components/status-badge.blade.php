@props(['status'])

@php
    $statuses = [
        'lost' => [
            'label' => 'Hilang',
            'classes' => 'bg-rose-100 text-rose-700 ring-rose-200',
        ],
        'found' => [
            'label' => 'Ditemukan',
            'classes' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
        ],
        'claimed' => [
            'label' => 'Diklaim',
            'classes' => 'bg-amber-100 text-amber-700 ring-amber-200',
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
