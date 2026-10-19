# Issues — Perencanaan Implementasi (Revisi 3)

> Dokumen ini berisi daftar pekerjaan yang direncanakan untuk diimplementasikan.
> Instruksi ditulis **high-level**: fokus pada tujuan, batasan, dan kriteria selesai.
> Eksekutor (junior programmer / model murah) tidak perlu bertanya-tanya — ikuti konteks
> di bawah, gunakan pola yang sudah ada di repo, dan jangan menambah dependency baru
> tanpa persetujuan.

## Koreksi dari Perencanaan Sebelumnya

- ❌ **DIBATALKAN: halaman visualisasi "Electoral College Forecast 2030".**
  Item ini adalah kesalahan penulisan pada perencanaan Revisi 1 dan sudah dihapus
  dari perencanaan sejak Revisi 2. Akan tetapi, pekerjaannya **terlanjur
  diimplementasikan dan di-merge ke `main` melalui PR #6**
  (`feat(forecast): halaman visualisasi Electoral College Forecast 2030`).
  Lantaran itu, kini ada **isu pembersihan artefak** (Issue 1 di bawah) yang wajib
  dikerjakan lebih dulu.
- ✅ **Restyle UI dengan palet warna baru** juga sudah ter-merge melalui PR #5
  (`feat(ui): restyle tampilan dengan palet brand amber/rust/dark`),
  sehingga isunya kini berubah menjadi **tugas verifikasi** (Issue 2 di bawah).

---

## Konteks Project (baca dulu sebelum mulai)

- Aplikasi **Lost & Found** berbasis **Laravel + Blade + Tailwind CSS v4** (Vite).
- UI utama:
  - Layout: `resources/views/layouts/app.blade.php`
  - Dashboard: `resources/views/dashboard.blade.php`
  - Komponen reusable: `resources/views/components/` (`button`, `item-card`, `status-badge`, dll.)
  - Styling global: `resources/css/app.css` (Tailwind v4, token warna didefinisikan lewat blok `@theme`)
- Routing: `routes/web.php` — halaman dashboard ada di `Route::get('/', ...)` dengan nama `dashboard`.
- **Jangan** mengubah logika bisnis, controller, model, maupun migration. Semua issue di bawah murni pekerjaan tampilan (view + CSS) kecuali disebutkan eksplisit.
- **Jangan** menambah package Composer/npm baru. Manfaatkan utilitas Tailwind yang sudah ada.
- Setiap kali selesai, jalankan `npm run build` dan pastikan tidak ada error; cek halaman terkait di browser (`php artisan serve`) sebelum menyatakan selesai.

---

## Issue 1 — Pembersihan Artefak Forecast 2030 (takedown PR #6)

**Prioritas:** Tinggi — **kerjakan lebih dulu sebelum Issue 2.**
**Scope:** `resources/views/forecast.blade.php`, `routes/web.php`, `resources/views/layouts/app.blade.php`

### Tujuan

Menghapus seluruh artefak halaman "Electoral College Forecast 2030" yang terlanjur
ter-merge lewat PR #6, karena item tersebut berasal dari kesalahan penulisan
perencanaan dan tidak pernah menjadi kebutuhan produk yang valid.

### Arahan High-Level

1. **Hapus tuntas, bukan setengah hati:**
   - Hapus file view `resources/views/forecast.blade.php`.
   - Hapus seluruh entri route forecast di `routes/web.php` (blok ±97 baris yang masuk PR #6) beserta import/controller yang hanya dipakai untuk halaman itu jika ada.
   - Hapus tautan menuju halaman forecast di navbar pada `resources/views/layouts/app.blade.php`.
2. **Batasan yang WAJIB dijaga** — jangan sekali-kali ikut membalik commit
   `refactor(ui): seragamkan warna tombol aksi jadi rust` (bagian kode `47771af`
   yang membuat warna tombol konsisten dengan palet brand). Refactor itu valid dan
   selaras dengan Issue 2; hanya kode yang terkait halaman forecast yang dihapus.
3. **Verifikasi kebersihan:**
   - `php artisan route:list` — pastikan tidak ada rute yang tersisa terkait forecast.
   - `grep -ri "forecast"` pada `resources/` dan `routes/` — pastikan tidak ada sisa.
   - Buka dashboard di browser dan `php artisan serve`: tampilan normal, tidak ada link mati.
4. **Jangan refactor file lain**, termasuk penataan ulang route di luar blok forecast.

### Kriteria Selesai (Definition of Done)

- [ ] Tidak ada lagi file view, route, atau tautan navbar yang terkait forecast.
- [ ] `php artisan route:list` bersih dari rute forecast; grep "forecast" menyisakan 0 hasil relevan.
- [ ] Commit `refactor(ui): ...rust` tetap utuh — refactoring warna tombol tidak tergoyahkan.
- [ ] Dashboard, form post barang, dan kartu item berjalan normal.
- [ ] `npm run build` sukses tanpa error.

---

## Issue 2 — Verifikasi Restyle UI dengan Palet Warna Baru

**Prioritas:** Sedang.
**Scope:** `resources/css/app.css`, `resources/views/layouts/app.blade.php`, `resources/views/dashboard.blade.php`, komponen di `resources/views/components/`

### Tujuan

PR #5 (`feat(ui): restyle tampilan dengan palet brand amber/rust/dark`) sudah
ter-merge ke `main`, sehingga pekerjaan kini **bukan membangun dari nol**, melainkan
memverifikasi hasilnya terhadap daftar periksa di bawah dan menuntaskan sisa yang
belum tuntas. Palet brand yang diharapkan:

| Peran           | Hex       | Catatan penggunaan                                      |
| --------------- | --------- | ------------------------------------------------------- |
| Warna card      | `#f6aa1c` | Latar section hero / kartu utama                        |
| Warna icon      | `#941b0c` | Latar (background) elemen ikon di header, kartu, tombol |
| Warna pelengkap | `#220901` | Warna "other": teks judul di atas card oranye, footer, aksen, hover state |

### Arahan High-Level

1. **Periksa implementasi token warna central.** Ketiga warna harus didefinisikan
   di blok `@theme` pada `resources/css/app.css` (mis. `--color-brand-amber`,
   `--color-brand-rust`, `--color-brand-dark`) dan dipakai sebagai kelas Tailwind.
   Jika masih ada hex yang dicorat-coret manual di banyak file, sentralisasi dulu.
2. **Verifikasi konsistensi penerapan:**
   - Kartu utama (section hero dashboard, kartu statistik, kartu item) memakai warna card.
   - Semua pembungkus ikon (badge statistik, logo navbar, ikon alert) memakai warna icon sebagai background.
   - Warna "other" dipakai pada teks heading di atas card oranye, footer, dan state interaktif (hover/active).
3. **Cari sisa warna lama.** Grep untuk kelas indigo/violet/rose/emerald/amber bawaan
   pada layout, dashboard, komponen, dan form. Warna status semantik fungsional
   (sukses/error) boleh bertahan selama tidak bertabrakan dengan palet baru.
4. **Cek keterbacaan (kontras).** Teks di atas latar `#f6aa1c` memakai `#220901`,
   bukan putih buram; periksa juga state disabled.
5. **Pastikan bentuk & spacing tidak melenceng**: rounded, padding, grid, dan
   hierarki ukuran mengikuti apa yang sudah ada sebelum restyle.
6. Uji state hover/focus button, link nav, dan kartu di desktop maupun mobile.

### Kriteria Selesai (Definition of Done)

- [ ] Ketiga warna hanya didefinisikan satu kali (di `@theme`) dan dipakai di seluruh halaman lewat token.
- [ ] Tidak ada sisa warna indigo/violet lama pada halaman utama, form, dan komponen.
- [ ] Semua teks dan latar kartu memiliki kontras yang cukup (tidak ada teks yang "hilang" di atas card).
- [ ] `npm run build` sukses; dashboard, form, dan kartu item konsisten di desktop maupun mobile.
- [ ] Laporkan temuan berupa daftar ceklis: mana yang sudah lolos, mana yang perlu perbaikan.

---

## Catatan untuk Eksekutor

- Urutan wajib: **Issue 1 dulu** (pembersihan), baru **Issue 2** (verifikasi restyle).
- Satu issue = satu commit/PR terpisah dengan pesan yang menjelaskan "apa dan kenapa".
- Jangan mencar-cari issue lain dari versi perencanaan lama. Jika menemukan kebutuhan di luar rencana, catat di PR/deskripsi commit sebagai *follow-up*, jangan dikerjakan diam-diam.
- Jika ada keputusan detail yang tidak disebut di sini, pilih yang paling sederhana dan konsisten dengan penamaan yang sudah ada di repo.

## Riwayat Revisi

- **Revisi 3 (19 Okt 2026):** Menyadari kode forecast 2030 sudah ter-merge via PR #6; menambah Issue 1 pembersihan artefak. PR #5 (restyle) juga sudah ter-merge, sehingga isu restyle diubah menjadi tugas verifikasi.
- **Revisi 2 (19 Okt 2026):** Menghapus seluruh perencanaan halaman "Electoral College Forecast 2030" karena salah tulis pada perencanaan awal. Isu restyle UI palet warna dipertahankan tanpa perubahan.
- **Revisi 1:** Memuat 2 isu (restyle UI palet warna + halaman forecast 2030).
