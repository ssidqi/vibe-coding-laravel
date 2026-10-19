# Issues — Perencanaan Implementasi (Revisi 2)

> Dokumen ini berisi daftar pekerjaan yang direncanakan untuk diimplementasikan.
> Instruksi ditulis **high-level**: fokus pada tujuan, batasan, dan kriteria selesai.
> Eksekutor (junior programmer / model murah) tidak perlu bertanya-tanya — ikuti konteks
> di bawah, gunakan pola yang sudah ada di repo, dan jangan menambah dependency baru
> tanpa persetujuan.

## Koreksi dari Perencanaan Sebelumnya

- ❌ **DIBATALKAN: halaman visualisasi "Electoral College Forecast 2030".**
  Item ini dihapus seluruhnya karena kesalahan penulisan pada perencanaan
  sebelumnya (Revisi 1). Item tersebut **tidak boleh** dikerjakan. Jika pada repo
  sudah ada sisa pekerjaannya (route, view, atau tautan di navbar), hapus bersih
  dan jangan pernah merujuk ke perencanaan lama.
- ✅ **Tetap berjalan: Issue 1 — Restyle UI dengan palet warna baru.** Isu ini
  tidak berubah dan merupakan satu-satunya pekerjaan pada perencanaan ini.

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

## Issue 1 — Restyle UI dengan Palet Warna Baru

**Prioritas:** Tinggi
**Scope:** `resources/css/app.css`, `resources/views/layouts/app.blade.php`, `resources/views/dashboard.blade.php`, dan komponen di `resources/views/components/`

### Tujuan

Perbarui tampilan aplikasi agar lebih menarik dengan palet warna brand berikut:

| Peran           | Hex       | Catatan penggunaan                                      |
| --------------- | --------- | ------------------------------------------------------- |
| Warna card      | `#f6aa1c` | Latar section hero / kartu utama                        |
| Warna icon      | `#941b0c` | Latar (background) elemen ikon di header, kartu, tombol |
| Warna pelengkap | `#220901` | Warna "other": teks judul di atas card oranye, footer, aksen, hover state |

### Arahan High-Level

1. **Definisikan token warna central.** Daftarkan ketiga warna sebagai token di blok `@theme` pada `resources/css/app.css` (mis. `--color-brand-amber`, `--color-brand-rust`, `--color-brand-dark`) agar bisa dipakai sebagai kelas Tailwind (`bg-brand-amber`, dst.) dan mudah diubah di kemudian hari. Hindari hardcode hex tersebar di banyak file.
2. **Terapkan secara konsisten**, bukan tempelan:
   - Kartu-kartu utama (section hero dashboard, kartu statistik, kartu item) menggunakan warna card.
   - Semua elemen pembungkus ikon (badge ikon di statistik, logo di navbar, ikon pada alert) menggunakan warna icon sebagai background.
   - Warna "other" dipakai untuk teks heading di atas card oranye, elemen footer, dan state interaktif (hover/active) agar palet terasa utuh.
3. **Ganti warna lama.** Hapus penggunaan skema indigo/violet/rose/emerald/amber bawaan pada layout, dashboard, dan komponen; ganti dengan palet baru. Warna status semantik (sukses/error) yang memang fungsional boleh dipertahankan, selama tidak bertabrakan dengan palet baru.
4. **Jaga keterbacaan (kontras).** Kombinasi warna teks dan latarnya harus tetap terbaca — terutama teks di atas latar `#f6aa1c`: gunakan `#220901` untuk teksnya, bukan putih buram. Periksa juga state disabled.
5. **Pertahankan bentuk & spacing yang sudah ada**: rounded, padding, grid, dan hierarki ukuran tidak perlu diubah — yang diganti hanya bahasa warna, kecuali memang terlihat janggal.
6. Sertakan state hover/focus yang tetap berbentuk dan konsisten di seluruh komponen (button, link nav, kartu).

### Kriteria Selesai (Definition of Done)

- [ ] Ketiga warna hanya didefinisikan satu kali (di `@theme`) dan dipakai di seluruh halaman lewat token.
- [ ] Tidak ada lagi sisa warna indigo/violet lama pada halaman utama, form, dan komponen.
- [ ] Semua teks dan latar kartu memiliki kontras yang cukup (tidak ada teks yang "hilang" di atas card).
- [ ] `npm run build` sukses; dashboard, form post barang, dan kartu item terlihat konsisten menggunakan palet baru pada breakpoint desktop dan mobile.
- [ ] Tidak ada sisa artefak dari perencanaan lama yang salah (route/view/tautan "Electoral College Forecast 2030") — jika sempat terlanjur dibuat, bersihkan sampai tuntas.

---

## Catatan untuk Eksekutor

- Ini **satu-satunya** pekerjaan pada dokumen ini; jangan mencar-cari issue lain dari versi perencanaan lama.
- Jangan refactor file di luar scope yang disebut. Jika menemukan kebutuhan di luar rencana, catat di PR/deskripsi commit sebagai *follow-up*, jangan dikerjakan diam-diam.
- Satu issue = satu commit/PR terpisah dengan pesan yang menjelaskan "apa dan kenapa".
- Jika ada keputusan detail (mis. nama token warna) yang tidak disebut di sini, pilih yang paling sederhana dan konsisten dengan penamaan yang sudah ada di repo.

## Riwayat Revisi

- **Revisi 2 (19 Okt 2026):** Menghapus seluruh perencanaan halaman "Electoral College Forecast 2030" karena salah tulis pada perencanaan awal. Isu restyle UI palet warna dipertahankan tanpa perubahan.
- **Revisi 1:** Memuat 2 isu (restyle UI palet warna + halaman forecast 2030).
