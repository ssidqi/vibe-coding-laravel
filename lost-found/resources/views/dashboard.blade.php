@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-600 via-indigo-600 to-violet-700 px-6 py-8 text-white shadow-lg sm:px-10 sm:py-12">
        <span class="inline-flex items-center rounded-full bg-white/15 px-3 py-1 text-xs font-semibold ring-1 ring-inset ring-white/25">
            Lost &amp; Found
        </span>

        <h1 class="mt-4 text-2xl font-bold sm:text-4xl">Kehilangan barang? Laporkan di sini.</h1>

        <p class="mt-3 max-w-2xl text-sm text-indigo-100 sm:text-base">
            Satu tempat untuk mencatat barang hilang dan barang ditemukan di lingkungan kampus.
            Posting laporanmu, lalu pantau daftar terbarunya di bawah ini.
        </p>

        <div class="mt-6 flex flex-wrap gap-3">
            <x-button :href="route('lost.create')" variant="danger">
                Posting Kehilangan Barang
            </x-button>
            <x-button :href="route('found.create')" variant="success">
                Posting Penemuan Barang
            </x-button>
        </div>
    </section>

    <section class="mt-6 grid gap-4 sm:grid-cols-3" aria-label="Statistik">
        <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <span class="flex size-11 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <div>
                <p class="text-sm font-medium text-slate-500">Barang Hilang</p>
                <p class="text-2xl font-bold text-slate-900">{{ $lostCount }}</p>
            </div>
        </div>

        <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <span class="flex size-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <div>
                <p class="text-sm font-medium text-slate-500">Barang Ditemukan</p>
                <p class="text-2xl font-bold text-slate-900">{{ $foundCount }}</p>
            </div>
        </div>

        <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <span class="flex size-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l2.25 2.25L15 9.75M4.5 20.25a8.25 8.25 0 1115 0c0 .414-.336.75-.75.75H5.25a.75.75 0 01-.75-.75z" />
                </svg>
            </span>
            <div>
                <p class="text-sm font-medium text-slate-500">Sudah Diklaim</p>
                <p class="text-2xl font-bold text-slate-900">{{ $claimedCount }}</p>
            </div>
        </div>
    </section>

    <section class="mt-10" aria-labelledby="lost-items-heading">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <h2 id="lost-items-heading" class="text-lg font-bold text-slate-900 sm:text-xl">Barang Hilang</h2>
                <span class="rounded-full bg-rose-100 px-2.5 py-1 text-xs font-semibold text-rose-700">{{ $lostCount }} laporan</span>
            </div>
            <x-button :href="route('lost.create')" variant="danger" size="sm">Posting Kehilangan Barang</x-button>
        </div>

        @if ($lostItems->isEmpty())
            <div class="mt-4 rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center">
                <p class="text-sm font-medium text-slate-600">Belum ada laporan barang hilang.</p>
                <p class="mt-1 text-xs text-slate-500">Jadilah yang pertama melaporkan barang hilangmu.</p>
            </div>
        @else
            <div class="mt-4 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($lostItems as $item)
                    <x-item-card :item="$item" />
                @endforeach
            </div>
        @endif
    </section>

    <section class="mt-12" aria-labelledby="found-items-heading">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <h2 id="found-items-heading" class="text-lg font-bold text-slate-900 sm:text-xl">Barang Ditemukan</h2>
                <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">{{ $foundCount }} laporan</span>
            </div>
            <x-button :href="route('found.create')" variant="success" size="sm">Posting Penemuan Barang</x-button>
        </div>

        @if ($foundItems->isEmpty())
            <div class="mt-4 rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center">
                <p class="text-sm font-medium text-slate-600">Belum ada laporan barang ditemukan.</p>
                <p class="mt-1 text-xs text-slate-500">Temukan barang orang lain? Laporkan di sini.</p>
            </div>
        @else
            <div class="mt-4 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($foundItems as $item)
                    <x-item-card :item="$item" />
                @endforeach
            </div>
        @endif
    </section>
@endsection
