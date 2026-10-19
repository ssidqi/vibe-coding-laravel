<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route auth (login/register) sengaja di-skip pada MVP ini: semua halaman
| bisa diakses tanpa login dan tanpa middleware proteksi.
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Barang hilang
Route::get('/lost/create', [ItemController::class, 'createLost'])->name('lost.create');
Route::post('/lost', [ItemController::class, 'storeLost'])->name('lost.store');

// Barang ditemukan
Route::get('/found/create', [ItemController::class, 'createFound'])->name('found.create');
Route::post('/found', [ItemController::class, 'storeFound'])->name('found.store');
