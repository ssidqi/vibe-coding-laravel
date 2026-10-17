@props(['type'])

@php
    $isLost = $type === \App\Models\Item::TYPE_LOST;

    $locationLabel = $isLost ? 'Lokasi terakhir terlihat' : 'Lokasi barang ditemukan';
    $dateLabel = $isLost ? 'Tanggal kehilangan' : 'Tanggal ditemukan';
    $reporterLabel = $isLost ? 'Nama pelapor' : 'Nama penemu/pelapor';
@endphp

<div class="space-y-5">
    <x-input
        name="title"
        label="Nama / judul barang"
        :required="true"
        maxlength="255"
        placeholder="Contoh: Dompet kulit hitam berisi KTP"
    />

    <x-textarea
        name="description"
        label="Deskripsi barang"
        :required="true"
        rows="4"
        maxlength="5000"
        placeholder="Jelaskan ciri-ciri barang, warna, merek, isi, atau tanda khusus lainnya."
    />

    <div class="grid gap-5 sm:grid-cols-2">
        <x-select
            name="category"
            label="Kategori"
            :options="\App\Models\Item::CATEGORIES"
            placeholder="— Pilih kategori —"
        />

        <x-input
            name="item_date"
            type="date"
            :label="$dateLabel"
            max="{{ now()->toDateString() }}"
        />
    </div>

    <x-input
        name="location"
        :label="$locationLabel"
        maxlength="255"
        placeholder="{{ $isLost ? 'Contoh: Kantin kampus' : 'Contoh: Perpustakaan lantai 2' }}"
    />

    <x-file-input
        name="photo"
        label="Foto barang"
        hint="Format JPG, JPEG, PNG, atau WEBP. Ukuran maksimal 2 MB."
    />

    <x-input
        name="reporter_name"
        :label="$reporterLabel"
        maxlength="100"
        placeholder="Contoh: Rizky Pratama"
        hint="Opsional. Karena fitur login belum aktif, nama ini dipakai sebagai identitas pelapor."
    />
</div>
