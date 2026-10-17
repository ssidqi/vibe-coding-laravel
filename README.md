# vibe-coding-laravel

Kumpulan projek hasil vibe coding dengan Laravel.

## Daftar Projek

| Projek | Deskripsi | Stack |
| --- | --- | --- |
| [lost-found](./lost-found) | Aplikasi Lost &amp; Found: mencatat dan menampilkan barang hilang &amp; barang ditemukan. | Laravel 13, MariaDB, Tailwind CSS 4 |

## Cara Menjalankan

Masuk ke folder projek, lalu ikuti instruksi pada README masing-masing projek:

```sh
cd lost-found
composer install && npm install
cp .env.example .env && php artisan key:generate
php artisan migrate --seed && php artisan storage:link
npm run build && php artisan serve
```
