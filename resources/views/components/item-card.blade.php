@props(['item'])

<article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
    <div class="relative aspect-[4/3] w-full overflow-hidden bg-slate-100">
        @if ($item->photo_url)
            <img
                src="{{ $item->photo_url }}"
                alt="Foto {{ $item->title }}"
                class="size-full object-cover transition duration-300 group-hover:scale-105"
            >
        @else
            <div class="flex size-full flex-col items-center justify-center gap-2 bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400">
                <svg class="size-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75v10.5A2.25 2.25 0 004.5 19.5zm10.5-11.25h.008v.008h-.008V8.25z" />
                </svg>
                <span class="text-xs font-medium">Foto belum tersedia</span>
            </div>
        @endif

        <div class="absolute top-3 left-3">
            <x-status-badge :status="$item->status" class="shadow-sm" />
        </div>
    </div>

    <div class="flex flex-1 flex-col gap-3 p-4">
        <div>
            <h3 class="text-base font-semibold text-slate-900">{{ $item->title }}</h3>
            <p class="mt-1 line-clamp-3 text-sm text-slate-600">{{ $item->description }}</p>
        </div>

        <dl class="space-y-1.5 text-xs text-slate-600">
            <div class="flex items-start gap-2">
                <dt class="shrink-0 text-slate-400">
                    <span class="sr-only">Kategori</span>
                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>
                </dt>
                <dd>{{ $item->category ?: 'Tanpa kategori' }}</dd>
            </div>

            <div class="flex items-start gap-2">
                <dt class="shrink-0 text-slate-400">
                    <span class="sr-only">Lokasi</span>
                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </dt>
                <dd>{{ $item->location ?: 'Lokasi tidak disebutkan' }}</dd>
            </div>

            <div class="flex items-start gap-2">
                <dt class="shrink-0 text-slate-400">
                    <span class="sr-only">Tanggal</span>
                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </dt>
                <dd>
                    {{ $item->item_date
                        ? $item->item_date->locale('id')->translatedFormat('d F Y')
                        : 'Tanggal tidak disebutkan' }}
                </dd>
            </div>
        </dl>

        <div class="mt-auto flex items-center justify-between gap-3 border-t border-slate-100 pt-3 text-xs text-slate-500">
            <span class="inline-flex items-center gap-1.5">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                {{ $item->reporter_name ?: 'Anonim' }}
            </span>
            <span>{{ $item->created_at?->locale('id')->diffForHumans() }}</span>
        </div>
    </div>
</article>
