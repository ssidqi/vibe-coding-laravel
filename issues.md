# Issues — Perencanaan Implementasi

> Dokumen ini berisi daftar pekerjaan yang direncanakan untuk diimplementasikan.
> Instruksi ditulis **high-level**: fokus pada tujuan, batasan, dan kriteria selesai.
> Eksekutor (junior programmer / model murah) tidak perlu bertanya-tanya — ikuti konteks
> di bawah, gunakan pola yang sudah ada di repo, dan jangan menambah dependency baru
> tanpa persetujuan.

## Konteks Project (baca dulu sebelum mulai)

- Aplikasi **Lost & Found** berbasis **Laravel + Blade + Tailwind CSS v4** (Vite).
- UI utama:
  - Layout: `resources/views/layouts/app.blade.php`
  - Dashboard: `resources/views/dashboard.blade.php`
  - Komponen reusable: `resources/views/components/` (`button`, `item-card`, `status-badge`, dll.)
  - Styling global: `resources/css/app.css` (Tailwind v4, token warna didefinisikan lewat blok `@theme`)
- routing: `routes/web.php` — halaman dashboard ada di `Route::get('/', ...)` dengan nama `dashboard`.
- **Jangan** mengubah logika bisnis, controller, model, maupun migration. Semua issue di bawah murni pekerjaan tampilan (view + CSS) kecuali disebutkan eksplisit.
- **Jangan** menambah package Composer/npm baru. Manfaatkan utilitas Tailwind yang sudah ada.
- Setiap kali selesai, jalankan `npm run build` dan pastikan tidak ada error; cek halaman terkait di browser (`php artisan serve`) sebelum menyatakan selesai.

---

## Issue 1 — Restyle UI dengan Palet Warna Baru

**Prioritas:** Tinggi
**Scope:** `resources/css/app.css`, `resources/views/layouts/app.blade.php`, `resources/views/dashboard.blade.php`, dan komponen di `resources/views/components/`

### Tujuan

Perbarui tampilan aplikasi agar lebih menarik dengan palet warna brand berikut:

| Peran          | Hex       | Catatan penggunaan                                      |
| -------------- | --------- | ------------------------------------------------------- |
| Warna card     | `#f6aa1c` | Latar section hero / kartu utama                        |
| Warna icon     | `#941b0c` | Latar (background) elemen ikon di header, kartu, tombol |
| Warna pelengkap| `#220901` | Warna "other": teks judul di atas card oranye, footer, aksen, hover state |

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

---

## Issue 2 — Halaman Visualisasi "Electoral College Forecast 2030" (Gaya Qt)

**Prioritas:** Sedang
**Scope:** file view baru, entri route baru, komponen baru (opsional), token CSS di `resources/css/app.css`

### Tujuan

Buat **halaman visualisasi "Electoral College Forecast 2030"** — sebuah halaman web untuk menampilkan proyeksi pembagian electoral vote (total 538) menuju pemilu 2030.

**Desain wajib mengikuti gaya Qt (seperti aplikasi desktop Qt):**

- **Flat** — tanpa gradient pada elemen utama; satu warna solid per area.
- **Utilitarian** — fungsional dulu; prioritas data yang mudah dibaca, bukan dekorasi.
- **Spacing konsisten** — gunakan skala spacing Tailwind yang seragam (mis. `gap-4` / `p-4` sebagai satuan dasar) di seluruh halaman; jangan campur-campur nilai acak.
- **Border minimal** — garis pemisah tipis 1px secukupnya; hindari border berlapis, ring dekoratif, dan rounded berlebihan.
- **Palet warna reserved** — warna netral dan rendah saturasi (abu, putih, hitam pekat `#220901`) sebagai dasar; warna cerah hanya dipakai fungsional (mis. membedakan dua kandidat/blok partisan), bukan dekoratif.
- **Tanpa gradient berlebihan dan tanpa shadow dramatis** — shadow (jika perlu) maksimal setara `shadow-sm`/`ring-1`, atau cukup pakai border tipis.
- **Font**: sans-serif bawaan sistem (system font stack, tanpa font eksternal), dengan **hierarki heading yang jelas lewat ukuran & weight** — mis. H1 tegas dan besar, H2 sedang, label kecil uppercase non-bold. Jangan membedakan hierarki hanya dengan warna.

### Arahan High-Level

1. **Halaman & route.** Buat view Blade baru (mis. `resources/views/forecast.blade.php`) yang extend `layouts.app`, lalu daftarkan entri route GET-nya di `routes/web.php` dengan nama rute yang deskriptif (mis. `forecast.index`). Tambahkan tautan ke halaman ini di navbar dashboard agar mudah ditemukan.
2. **Data.** Simpan data proyeksi sebagai array sederhana yang didefinisikan statis di controller atau closure route lalu dipass ke view — formatnya: nama negara bagian (atau blok regional), jumlah electoral vote, dan proyeksi pemenangnya. **Jangan buat tabel/migration database** untuk issue ini; data statis cukup. Pastikan jumlah total electoral vote (538) konsisten dengan data yang ditampilkan.
3. **Komposisi halaman** (urutan vertikal):
   - Heading utama "Electoral College Forecast 2030" + satu paragraf ringkas deskripsi (subjudul, no fluff).
   - Ringkasan agregat: total electoral votes, proyeksi per blok/kandidat, dan selisih menuju angka menang (270) — ditampilkan sebagai baris ringkasan flat dalam bentuk angka besar + label kecil.
   - Visualisasi utama: representasi distribusi electoral vote per negara bagian/blok (mis. horizontal bar chart sederhana / daftar berproporsi lebar berdasarkan porsi EV). Buatlah dengan **HTML + CSS murni (flex/grid + width berpersentase)** — **tidak perlu library chart JS**.
   - Tabel/detail pendukung di bawahnya (negara bagian, EV, proyeksi) dengan garis pemisah tipis antar baris — gaya tabel utilitarian.
4. **Netrakan ke gaya Qt pada detail kecil**: label uppercase kecil, angka rata kanan pada kolom numerik tabel, garis pemisah `border-slate-200`, tanpa animasi berlebihan (transisi minimal diperbolehkan).
5. **Aksesibilitas & responsive.** Struktur heading semantik (satu `h1`, `h2` per section), skema warna tidak bergantung pada warna saja (sertakan label teks), dan tata letak tetap rapi di mobile (visualisasi & tabel boleh scroll horizontal jika sempit).
6. Halaman ini boleh (dan disarankan) memakai warna `#220901` untuk teks/aksen utama agar terasa satu family dengan aplikasi — tetapi tetap patuhi prinsip palet reserved di atas; jangan pakai `#f6aa1c` sebagai warna latar luas di halaman ini, cukup sebagai aksen tipis (mis. marker baris atau titik legenda).

### Kriteria Selesai (Definition of Done)

- [ ] Route baru dapat diakses dan sudah ditautkan dari navbar.
- [ ] Visualisasi tampil flat tanpa gradient dan tanpa shadow dramatis; memakai system sans-serif.
- [ ] Spacing antar elemen konsisten dan border tipis/minimal.
- [ ] Hierarki heading jelas (ukuran berbeda per level) dan total EV pada tampilan = 538.
- [ ] Halaman rapi pada mobile dan desktop; data tidak hardcoded di template mentah (di-pass dari route/controller).
- [ ] `npm run build` sukses tanpa error.

---

## Catatan untuk Eksekutor

- Kerjakan **Issue 1 dulu**, karena Issue 2 akan menumpang (reuse) token warna & pola yang dihasilkan Issue 1.
- Jangan refactor file di luar scope yang disebut. Jika menemukan kebutuhan di luar rencana, catat di PR/deskripsi commit sebagai *follow-up*, jangan dikerjakan diam-diam.
- Satu issue = satu commit/PR terpisah dengan pesan yang menjelaskan "apa dan kenapa".
- Jika ada keputusan detail (mis. nama token warna, nama route) yang tidak disebut di sini, pilih yang paling sederhana dan konsisten dengan penamaan yang sudah ada di repo.
