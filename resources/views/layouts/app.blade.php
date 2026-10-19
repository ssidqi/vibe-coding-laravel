<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Dashboard') · {{ config('app.name') }}</title>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex min-h-screen flex-col bg-brand-amber/5 text-brand-dark antialiased">
        <header class="sticky top-0 z-30 border-b border-brand-dark/10 bg-white/90 backdrop-blur">
            <nav class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-x-6 gap-y-3 px-4 py-3 sm:px-6 lg:px-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                    <span class="flex size-9 items-center justify-center rounded-xl bg-brand-rust text-brand-amber shadow-sm">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" />
                        </svg>
                    </span>
                    <span class="leading-tight">
                        <span class="block text-sm font-bold text-brand-dark">Lost &amp; Found</span>
                        <span class="block text-xs text-brand-dark/60">Barang hilang &amp; ditemukan</span>
                    </span>
                </a>

                <div class="flex flex-wrap items-center gap-2">
                    @php
                        $navLinks = [
                            ['route' => 'dashboard', 'label' => 'Dashboard', 'active' => request()->routeIs('dashboard')],
                            ['route' => 'forecast.index', 'label' => 'Forecast 2030', 'active' => request()->routeIs('forecast.*')],
                        ];
                    @endphp

                    @foreach ($navLinks as $link)
                        <a
                            href="{{ route($link['route']) }}"
                            @class([
                                'rounded-lg px-3 py-2 text-sm font-medium transition',
                                'bg-brand-amber text-brand-dark' => $link['active'],
                                'text-brand-dark/70 hover:bg-brand-amber/20 hover:text-brand-dark' => ! $link['active'],
                            ])
                            @if ($link['active']) aria-current="page" @endif
                        >
                            {{ $link['label'] }}
                        </a>
                    @endforeach

                    <x-button :href="route('lost.create')" variant="primary" size="sm">Posting Kehilangan</x-button>
                    <x-button :href="route('found.create')" variant="secondary" size="sm">Posting Penemuan</x-button>
                </div>
            </nav>
        </header>

        <main class="mx-auto w-full max-w-7xl flex-1 px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
            @if (session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-brand-amber bg-brand-amber/25 p-4 text-sm text-brand-dark">
                    <span class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-brand-rust text-brand-amber">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-brand-rust/30 bg-brand-rust/10 p-4 text-sm text-brand-rust">
                    <span class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-brand-rust text-brand-amber">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="border-t border-brand-dark/10 bg-brand-dark">
            <div class="mx-auto flex max-w-7xl flex-col gap-1 px-4 py-6 text-xs text-brand-amber/80 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
                <p>&copy; {{ now()->year }} {{ config('app.name') }} — aplikasi barang hilang &amp; ditemukan.</p>
                <p>Laravel {{ Illuminate\Foundation\Application::VERSION }} · MariaDB</p>
            </div>
        </footer>
    </body>
</html>
