<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Dashboard') · {{ config('app.name') }}</title>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex min-h-screen flex-col bg-slate-50 text-slate-900 antialiased">
        <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/90 backdrop-blur">
            <nav class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-x-6 gap-y-3 px-4 py-3 sm:px-6 lg:px-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                    <span class="flex size-9 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" />
                        </svg>
                    </span>
                    <span class="leading-tight">
                        <span class="block text-sm font-bold text-slate-900">Lost &amp; Found</span>
                        <span class="block text-xs text-slate-500">Barang hilang &amp; ditemukan</span>
                    </span>
                </a>

                <div class="flex flex-wrap items-center gap-2">
                    <a
                        href="{{ route('dashboard') }}"
                        @class([
                            'rounded-lg px-3 py-2 text-sm font-medium transition',
                            'bg-slate-100 text-slate-900' => request()->routeIs('dashboard'),
                            'text-slate-600 hover:bg-slate-100 hover:text-slate-900' => ! request()->routeIs('dashboard'),
                        ])
                    >
                        Dashboard
                    </a>

                    <x-button :href="route('lost.create')" variant="danger" size="sm">Posting Kehilangan</x-button>
                    <x-button :href="route('found.create')" variant="success" size="sm">Posting Penemuan</x-button>
                </div>
            </nav>
        </header>

        <main class="mx-auto w-full max-w-7xl flex-1 px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
            @if (session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
                    <svg class="mt-0.5 size-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800">
                    <svg class="mt-0.5 size-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="border-t border-slate-200 bg-white">
            <div class="mx-auto flex max-w-7xl flex-col gap-1 px-4 py-6 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
                <p>&copy; {{ now()->year }} {{ config('app.name') }} — aplikasi barang hilang &amp; ditemukan.</p>
                <p>Laravel {{ Illuminate\Foundation\Application::VERSION }} · MariaDB</p>
            </div>
        </footer>
    </body>
</html>
