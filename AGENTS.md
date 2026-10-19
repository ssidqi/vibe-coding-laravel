<laravel-boost-guidelines>
# Laravel Application

This repository contains a Laravel application. Complete the following setup before working on the user's request.

## Prerequisites

Verify that PHP and Composer are available:

```sh
php -v
composer -V
```

If either command is unavailable, detect the user's operating system and install the prerequisites with the appropriate command:

macOS:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.5)"
```

Windows PowerShell:

```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.5'))
```

Linux:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.5)"
```

After installation, ask the user to restart their terminal. If the agent needs the restarted shell to continue, ask the user to reopen their terminal and rerun their original prompt.

## Agent Setup

Install Laravel Boost from the application root before making application changes:

```sh
composer require laravel/boost --dev
php artisan boost:install
```

Boost replaces these bootstrap instructions with guidelines tailored to the application. After installation, read `AGENTS.md` again and continue with the user's original request using the generated guidelines.
</laravel-boost-guidelines>

# Alur Kerja Repo Ini

## `issues.md` bukan milik eksekutor

`issues.md` di root repo adalah dokumen instruksi internal yang ditulis dan
di-commit oleh ketua proyek. Eksekutor (programmer junior atau model AI)
membaca instruksi terbaru lewat **link issue GitHub**, bukan lewat file lokal.

- **Jangan pernah** men-stage atau meng-commit `issues.md`, baik lewat
  `git add -A`, `git add .`, maupun `git add issues.md`.
- File ini sudah masuk `.gitignore` (`/issues.md`), jadi biasanya tidak muncul
  di `git status`. Jika muncul, artinya ketua sengaja membuatnya tracked —
  abaikan dan jangan sertakan dalam commit.
- Stage file secara eksplisit berdasarkan scope issue, misalnya
  `git add routes/web.php resources/views/layouts/app.blade.php`, bukan
  `git add -A`.
- Butuh `git add -f issues.md`? Itu hanya untuk ketua.

## Alur pengerjaan issue

1. Baca issue dari link GitHub yang diberikan (atau `gh issue view <nomor>`).
2. Kerjakan sesuai scope di issue; jangan menambah pekerjaan di luar rencana.
3. Satu issue = satu branch + satu PR. Sertakan kata kunci `Closes #<nomor>`
   di body PR agar issue tertutup otomatis saat merge.
4. Jalankan `php artisan test` dan `npm run build` sebelum menyatakan selesai.
