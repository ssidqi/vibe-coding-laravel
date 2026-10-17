<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\Item;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ItemController extends Controller
{
    /**
     * Form posting barang hilang.
     */
    public function createLost(): View
    {
        return view('items.lost-form');
    }

    /**
     * Form posting barang ditemukan.
     */
    public function createFound(): View
    {
        return view('items.found-form');
    }

    /**
     * Simpan laporan barang hilang.
     */
    public function storeLost(StoreItemRequest $request): RedirectResponse
    {
        $item = $this->store($request, Item::TYPE_LOST);

        return redirect()
            ->route('dashboard')
            ->with('success', "Laporan kehilangan \"{$item->title}\" berhasil dikirim.");
    }

    /**
     * Simpan laporan barang ditemukan.
     */
    public function storeFound(StoreItemRequest $request): RedirectResponse
    {
        $item = $this->store($request, Item::TYPE_FOUND);

        return redirect()
            ->route('dashboard')
            ->with('success', "Laporan penemuan \"{$item->title}\" berhasil dikirim.");
    }

    /**
     * Simpan item yang sudah divalidasi ke database.
     */
    protected function store(StoreItemRequest $request, string $type): Item
    {
        $data = $request->safe()->except('photo');
        $data['type'] = $type;
        $data['status'] = $type === Item::TYPE_LOST
            ? Item::STATUS_LOST
            : Item::STATUS_FOUND;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('items', 'public');
        }

        return Item::create($data);
    }
}
