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

/*
|--------------------------------------------------------------------------
| Halaman visualisasi
|--------------------------------------------------------------------------
*/

Route::get('/forecast', function () {
    // Proyeksi Electoral College 2030. Data sengaja statis (tanpa tabel atau
    // migration) karena halaman ini murni visualisasi.
    // Format tiap baris: [negara bagian, electoral vote, blok proyeksi ('A'|'B')].
    $states = [
        ['Alabama', 9, 'B'],
        ['Alaska', 3, 'B'],
        ['Arizona', 11, 'B'],
        ['Arkansas', 6, 'B'],
        ['California', 54, 'A'],
        ['Colorado', 10, 'A'],
        ['Connecticut', 7, 'A'],
        ['Delaware', 3, 'A'],
        ['District of Columbia', 3, 'A'],
        ['Florida', 30, 'B'],
        ['Georgia', 16, 'B'],
        ['Hawaii', 4, 'A'],
        ['Idaho', 4, 'B'],
        ['Illinois', 19, 'A'],
        ['Indiana', 11, 'B'],
        ['Iowa', 6, 'B'],
        ['Kansas', 6, 'B'],
        ['Kentucky', 8, 'B'],
        ['Louisiana', 8, 'B'],
        ['Maine', 4, 'A'],
        ['Maryland', 10, 'A'],
        ['Massachusetts', 11, 'A'],
        ['Michigan', 15, 'A'],
        ['Minnesota', 10, 'A'],
        ['Mississippi', 6, 'B'],
        ['Missouri', 10, 'B'],
        ['Montana', 4, 'B'],
        ['Nebraska', 5, 'B'],
        ['Nevada', 6, 'A'],
        ['New Hampshire', 4, 'A'],
        ['New Jersey', 14, 'A'],
        ['New Mexico', 5, 'A'],
        ['New York', 28, 'A'],
        ['North Carolina', 16, 'B'],
        ['North Dakota', 3, 'B'],
        ['Ohio', 17, 'B'],
        ['Oklahoma', 7, 'B'],
        ['Oregon', 8, 'A'],
        ['Pennsylvania', 19, 'A'],
        ['Rhode Island', 4, 'A'],
        ['South Carolina', 9, 'B'],
        ['South Dakota', 3, 'B'],
        ['Tennessee', 11, 'B'],
        ['Texas', 40, 'B'],
        ['Utah', 6, 'B'],
        ['Vermont', 3, 'A'],
        ['Virginia', 13, 'A'],
        ['Washington', 12, 'A'],
        ['West Virginia', 4, 'B'],
        ['Wisconsin', 10, 'A'],
        ['Wyoming', 3, 'B'],
    ];

    $blocs = [
        'A' => 'Blok A',
        'B' => 'Blok B',
    ];

    $threshold = 270;
    $totalEv = array_sum(array_column($states, 1));

    if ($totalEv !== 538) {
        throw new LogicException("Total electoral vote harus 538, data saat ini {$totalEv}.");
    }

    $blocTotals = array_fill_keys(array_keys($blocs), 0);

    foreach ($states as [$name, $ev, $bloc]) {
        $blocTotals[$bloc] += $ev;
    }

    $leader = array_search(max($blocTotals), $blocTotals, true);

    return view('forecast', [
        'states' => $states,
        'blocs' => $blocs,
        'totalEv' => $totalEv,
        'threshold' => $threshold,
        'blocTotals' => $blocTotals,
        'leader' => $leader,
        'leaderMargin' => $blocTotals[$leader] - $threshold,
        'thresholdShare' => round($threshold / $totalEv * 100, 2),
        'maxEv' => max(array_column($states, 1)),
    ]);
})->name('forecast.index');
