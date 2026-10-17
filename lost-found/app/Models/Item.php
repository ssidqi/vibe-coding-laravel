<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    /** Jenis laporan: barang hilang. */
    public const TYPE_LOST = 'lost';

    /** Jenis laporan: barang ditemukan. */
    public const TYPE_FOUND = 'found';

    /** Status barang masih hilang. */
    public const STATUS_LOST = 'lost';

    /** Status barang sudah ditemukan. */
    public const STATUS_FOUND = 'found';

    /** Status barang sudah diklaim / dikembalikan ke pemiliknya. */
    public const STATUS_CLAIMED = 'claimed';

    /**
     * Kategori barang yang tersedia pada form posting.
     *
     * @var list<string>
     */
    public const CATEGORIES = [
        'Elektronik',
        'Dompet & Tas',
        'Dokumen & Kartu',
        'Kunci',
        'Pakaian & Aksesoris',
        'Perhiasan',
        'Kendaraan',
        'Hewan Peliharaan',
        'Lainnya',
    ];

    /**
     * Kolom yang boleh diisi secara massal.
     *
     * @var list<string>
     */
    protected $fillable = [
        'type',
        'status',
        'title',
        'description',
        'category',
        'location',
        'item_date',
        'photo',
        'reporter_name',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'item_date' => 'date',
        ];
    }

    /**
     * Daftar jenis laporan beserta labelnya.
     *
     * @return array<string, string>
     */
    public static function typeLabels(): array
    {
        return [
            self::TYPE_LOST => 'Barang Hilang',
            self::TYPE_FOUND => 'Barang Ditemukan',
        ];
    }

    /**
     * Daftar status barang beserta labelnya.
     *
     * @return array<string, string>
     */
    public static function statusLabels(): array
    {
        return [
            self::STATUS_LOST => 'Hilang',
            self::STATUS_FOUND => 'Ditemukan',
            self::STATUS_CLAIMED => 'Diklaim',
        ];
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * Urutkan berdasarkan tanggal kejadian (terbaru lebih dahulu).
     */
    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('item_date')->orderByDesc('id');
    }

    public function getTypeLabelAttribute(): string
    {
        return self::typeLabels()[$this->type] ?? ucfirst($this->type);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statusLabels()[$this->status] ?? ucfirst($this->status);
    }

    /**
     * URL publik foto barang, null jika barang belum punya foto.
     */
    public function getPhotoUrlAttribute(): ?string
    {
        if (blank($this->photo)) {
            return null;
        }

        return Storage::disk('public')->url($this->photo);
    }

    public function isClaimed(): bool
    {
        return $this->status === self::STATUS_CLAIMED;
    }
}
