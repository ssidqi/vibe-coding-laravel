# Lost &amp; Found

Aplikasi web untuk mencatat **barang hilang** dan **barang ditemukan**. Dibuat dengan
Laravel (PHP ≥ 8.2) dan MariaDB. Fokus fitur awal (MVP) ada di frontend; autentikasi
sengaja di-skip.

## Fitur MVP

- Dashboard (`/`) berisi statistik (jumlah barang hilang, ditemukan, dan diklaim).
- Daftar card barang hilang & barang ditemukan, lengkap dengan foto/placeholder,
  kategori, lokasi, tanggal, status, dan nama pelapor.
- Form **Posting Kehilangan Barang** (`/lost/create`) dan **Posting Penemuan Barang**
  (`/found/create`) beserta validasi client-side (atribut HTML5) dan server-side
  (`StoreItemRequest`).
- Upload foto barang (opsional) ke `storage/app/public/items`.
- Flash message sukses/gagal setelah submit.
- Tampilan responsive dengan Tailwind CSS 4 dan komponen Blade yang bisa dipakai ulang.

## Kebutuhan

- PHP ≥ 8.2 dengan ekstensi `pdo_mysql`, `mbstring`, `gd`/`zip` (bawaan Laravel).
- Composer
- Node.js + npm (untuk build asset Vite/Tailwind)
- MariaDB

## Setup

### 1. Dependensi

```sh
composer install
npm install
```

### 2. Database

Buat database dan user khusus aplikasi (butuh akses root MariaDB):

```sh
sudo mariadb -e "
  CREATE DATABASE IF NOT EXISTS lost_found CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
  CREATE USER IF NOT EXISTS 'lost_found'@'localhost' IDENTIFIED BY 'secret';
  GRANT ALL PRIVILEGES ON lost_found.* TO 'lost_found'@'localhost';
  FLUSH PRIVILEGES;
"
```

> Alternatif: pakai user `root` bila environment Anda mengizinkannya
> (`DB_USERNAME=root`, `DB_PASSWORD=`), sama seperti contoh pada `.env.example`.

### 3. Konfigurasi `.env`

Salin `.env.example` menjadi `.env` lalu sesuaikan kredensial database:

```dotenv
APP_NAME="Lost & Found"

DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lost_found
DB_USERNAME=lost_found
DB_PASSWORD=secret
```

Jangan commit file `.env` (sudah ada di `.gitignore`).

### 4. Migrasi, seeder, dan storage link

```sh
php artisan migrate --seed
php artisan storage:link
```

Seeder `ItemSeeder` mengisi 15 data dummy (barang hilang & ditemukan) agar dashboard
langsung terlihat berisi.

### 5. Build asset & jalankan

```sh
npm run build        # atau: npm run dev (development)
php artisan serve
```

Buka <http://localhost:8000>.

## Routes

| Method | URI             | Nama route    | Keterangan                        |
| ------ | --------------- | ------------- | --------------------------------- |
| GET    | `/`             | `dashboard`   | Dashboard + statistik + daftar    |
| GET    | `/lost/create`  | `lost.create` | Form posting barang hilang        |
| POST   | `/lost`         | `lost.store`  | Simpan laporan barang hilang      |
| GET    | `/found/create` | `found.create`| Form posting barang ditemukan     |
| POST   | `/found`        | `found.store` | Simpan laporan barang ditemukan   |

Tidak ada middleware auth/login — sesuai scope MVP.

## Struktur Penting

```
app/
├── Http/
│   ├── Controllers/DashboardController.php   # statistik + daftar item
│   ├── Controllers/ItemController.php        # form & simpan laporan
│   └── Requests/StoreItemRequest.php         # validasi + pesan Bahasa Indonesia
└── Models/Item.php                           # konstanta type/status/kategori, scope, accessor

database/
├── factories/ItemFactory.php
├── migrations/*_create_items_table.php
└── seeders/ItemSeeder.php

resources/views/
├── layouts/app.blade.php                     # navbar + flash message + footer
├── dashboard.blade.php
├── items/lost-form.blade.php
├── items/found-form.blade.php
└── components/                               # button, input, textarea, select,
                                              # file-input, status-badge, item-card, item-form
```

## Catatan Desain

- **Satu tabel `items` (Opsi B).** Barang hilang dan ditemukan disimpan di tabel yang sama.
  Kolom `type` (`lost`/`found`) menentukan asal laporan, kolom `status`
  (`lost`/`found`/`claimed`) menentukan keadaan barang saat ini.
- **Kolom `item_date`.** Menggantikan `lost_date`/`found_date` karena satu tabel menampung
  dua jenis laporan: berisi tanggal hilang untuk `type = lost` dan tanggal ditemukan
  untuk `type = found`.
- **Kategori** dibatasi pada daftar `Item::CATEGORIES` (dropdown) dan divalidasi dengan
  `Rule::in`, sehingga data kategori tetap konsisten.
- **Pelapor** disimpan di kolom `reporter_name` (opsional) karena fitur login belum ada.
- **Foto** disimpan di disk `public` (`storage/app/public/items`) dan diakses lewat
  symlink `public/storage`.

## Testing

```sh
php artisan test
```

Test berjalan di SQLite in-memory (lihat `phpunit.xml`) dan mencakup dashboard,
pembukaan form, penyimpanan laporan hilang/ditemukan, upload foto, dan validasi.

## Yang Ditunda

Autentikasi & middleware proteksi, relasi item ke `users`, edit/hapus item,
pencarian & filter, serta fitur claim/meet matching.
