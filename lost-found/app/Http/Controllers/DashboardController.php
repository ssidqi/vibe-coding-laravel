<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard: statistik + daftar barang hilang & ditemukan.
     */
    public function index(): View
    {
        return view('dashboard', [
            'lostCount' => Item::ofType(Item::TYPE_LOST)->count(),
            'foundCount' => Item::ofType(Item::TYPE_FOUND)->count(),
            'claimedCount' => Item::where('status', Item::STATUS_CLAIMED)->count(),
            'lostItems' => Item::ofType(Item::TYPE_LOST)->latestFirst()->get(),
            'foundItems' => Item::ofType(Item::TYPE_FOUND)->latestFirst()->get(),
        ]);
    }
}
