@extends('layouts.app')

@section('title', 'Posting Penemuan Barang')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-indigo-600 transition hover:text-indigo-500">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali ke dashboard
        </a>

        <header class="mt-4">
            <h1 class="text-2xl font-bold text-slate-900">Posting Penemuan Barang</h1>
            <p class="mt-1 text-sm text-slate-600">
                Laporkan barang yang kamu temukan supaya pemiliknya bisa menghubungi dan mengambilnya kembali.
            </p>
        </header>

        @if ($errors->any())
            <div class="mt-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800">
                <p class="font-semibold">Periksa kembali isian berikut:</p>
                <ul class="mt-2 list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('found.store') }}"
            enctype="multipart/form-data"
            class="mt-6 space-y-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8"
        >
            @csrf

            <x-item-form type="found" />

            <div class="flex flex-wrap gap-3 border-t border-slate-100 pt-6">
                <x-button type="submit" variant="success">Kirim Laporan Penemuan</x-button>
                <x-button :href="route('dashboard')" variant="ghost">Batal</x-button>
            </div>
        </form>
    </div>
@endsection
