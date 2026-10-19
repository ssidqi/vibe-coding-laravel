@extends('layouts.app')

@section('title', 'Electoral College Forecast 2030')

@php
    // Gaya Qt: warna dipakai fungsional untuk membedakan dua blok, bukan
    // dekorasi. Sisanya netral (putih/abu) dengan teks memakai brand-dark
    // (#220901) lewat token, dan amber hanya sebagai aksen tipis.
    $blocFill = [
        'A' => 'bg-brand-rust',
        'B' => 'bg-brand-amber',
    ];

    $label = 'text-xs font-medium tracking-wide text-slate-500 uppercase';
    $number = 'mt-1 text-2xl font-bold tabular-nums';
    $headCell = 'px-4 py-2 text-xs font-medium tracking-wide text-slate-500 uppercase';
    $bodyCell = 'px-4 py-2';
@endphp

@section('content')
    <div class="[font-family:system-ui,sans-serif] text-brand-dark">
        <header class="border-b border-slate-200 pb-4">
            <p class="{{ $label }}">Proyeksi electoral vote</p>
            <h1 class="mt-1 text-2xl font-bold sm:text-3xl">Electoral College Forecast 2030</h1>
            <p class="mt-2 max-w-3xl text-sm text-slate-600">
                Proyeksi pembagian {{ $totalEv }} electoral vote menuju pemilu 2030, dihitung per negara
                bagian lalu dikelompokkan ke dua blok. Angkanya ilustratif untuk keperluan visualisasi,
                bukan hasil survei.
            </p>
        </header>

        <section class="mt-4 border border-slate-200" aria-labelledby="ringkasan-heading">
            <h2 id="ringkasan-heading" class="sr-only">Ringkasan agregat</h2>

            <dl class="grid grid-cols-2 gap-4 p-4 sm:grid-cols-4">
                <div>
                    <dt class="{{ $label }}">Total electoral vote</dt>
                    <dd class="{{ $number }}">{{ $totalEv }}</dd>
                </div>

                @foreach ($blocs as $key => $bloc)
                    <div>
                        <dt class="{{ $label }}">
                            <span class="inline-flex items-center gap-2">
                                <span class="size-2 {{ $blocFill[$key] }}" aria-hidden="true"></span>
                                {{ $bloc }}
                            </span>
                        </dt>
                        <dd class="{{ $number }}">{{ $blocTotals[$key] }}</dd>
                    </div>
                @endforeach

                <div>
                    <dt class="{{ $label }}">Ambang menang</dt>
                    <dd class="{{ $number }}">{{ $threshold }}</dd>
                </div>
            </dl>

            <p class="border-t border-slate-200 p-4 text-sm text-slate-600">
                {{ $blocs[$leader] }} memimpin dengan {{ $blocTotals[$leader] }} EV, yaitu
                {{ $leaderMargin }} EV di atas ambang kemenangan {{ $threshold }}.
            </p>
        </section>

        <section class="mt-8" aria-labelledby="distribusi-heading">
            <h2 id="distribusi-heading" class="text-lg font-semibold">Distribusi {{ $totalEv }} electoral vote</h2>

            <div class="mt-4 border border-slate-200 p-4">
                <div class="relative">
                    <div
                        class="flex h-5 w-full border border-slate-200"
                        role="img"
                        aria-label="{{ $blocs['A'] }} {{ $blocTotals['A'] }} electoral vote, {{ $blocs['B'] }} {{ $blocTotals['B'] }} electoral vote, dari total {{ $totalEv }}"
                    >
                        @foreach ($blocs as $key => $bloc)
                            <span class="{{ $blocFill[$key] }} h-full" style="width: {{ round($blocTotals[$key] / $totalEv * 100, 4) }}%"></span>
                        @endforeach
                    </div>

                    {{-- Penanda ambang menang: garis tipis, bukan blok warna. --}}
                    <span
                        class="absolute inset-y-0 border-l border-dashed border-brand-dark"
                        style="left: {{ $thresholdShare }}%"
                        aria-hidden="true"
                    ></span>
                </div>

                <ul class="mt-4 flex flex-wrap gap-4 text-xs text-slate-600">
                    @foreach ($blocs as $key => $bloc)
                        <li class="flex items-center gap-2">
                            <span class="size-2 {{ $blocFill[$key] }}" aria-hidden="true"></span>
                            {{ $bloc }} — {{ $blocTotals[$key] }} EV
                            ({{ number_format($blocTotals[$key] / $totalEv * 100, 1, ',', '.') }}%)
                        </li>
                    @endforeach

                    <li class="flex items-center gap-2">
                        <span class="h-3 w-0 border-l border-dashed border-brand-dark" aria-hidden="true"></span>
                        Ambang menang — {{ $threshold }} EV ({{ number_format($thresholdShare, 1, ',', '.') }}%)
                    </li>
                </ul>
            </div>
        </section>

        <section class="mt-8" aria-labelledby="tabel-heading">
            <h2 id="tabel-heading" class="text-lg font-semibold">Proyeksi per negara bagian</h2>
            <p class="mt-1 text-sm text-slate-600">
                {{ count($states) }} wilayah · {{ $totalEv }} electoral vote.
            </p>

            <div class="mt-4 overflow-x-auto border border-slate-200">
                <table class="w-full min-w-[36rem] border-collapse text-sm">
                    <caption class="sr-only">
                        Electoral vote dan proyeksi blok per negara bagian, total {{ $totalEv }} electoral vote.
                    </caption>

                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50">
                            <th scope="col" class="{{ $headCell }} text-left">Negara bagian</th>
                            <th scope="col" class="{{ $headCell }} text-right">EV</th>
                            <th scope="col" class="{{ $headCell }} text-left">Proyeksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($states as [$name, $ev, $bloc])
                            <tr class="border-b border-slate-200 last:border-b-0">
                                <th scope="row" class="{{ $bodyCell }} text-left font-normal">{{ $name }}</th>
                                <td class="{{ $bodyCell }} text-right tabular-nums">{{ $ev }}</td>
                                <td class="{{ $bodyCell }}">
                                    <div class="flex items-center gap-2">
                                        <span class="flex h-2 w-24 shrink-0 bg-slate-100" aria-hidden="true">
                                            <span class="{{ $blocFill[$bloc] }} h-full" style="width: {{ round($ev / $maxEv * 100, 2) }}%"></span>
                                        </span>
                                        <span class="text-xs text-slate-600">{{ $blocs[$bloc] }}</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr class="bg-slate-50 font-semibold">
                            <td class="{{ $bodyCell }}">Total</td>
                            <td class="{{ $bodyCell }} text-right tabular-nums">{{ $totalEv }}</td>
                            <td class="{{ $bodyCell }} text-xs font-normal text-slate-600">
                                {{ $blocs['A'] }} {{ $blocTotals['A'] }} EV · {{ $blocs['B'] }} {{ $blocTotals['B'] }} EV
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>
    </div>
@endsection
