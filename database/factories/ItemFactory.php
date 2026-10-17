<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    protected $model = Item::class;

    /**
     * Judul dummy untuk laporan barang hilang.
     *
     * @var list<string>
     */
    protected const LOST_TITLES = [
        'Dompet kulit hitam hilang',
        'HP Samsung warna biru hilang',
        'Kunci motor dengan gantungan kucing',
        'Tas laptop hitam ketinggalan',
        'KTM mahasiswa hilang',
        'Earphone TWS putih hilang',
    ];

    /**
     * Judul dummy untuk laporan barang ditemukan.
     *
     * @var list<string>
     */
    protected const FOUND_TITLES = [
        'Dompet hitam ditemukan di kantin',
        'Botol minum ditemukan di kelas',
        'Kunci ditemukan di parkiran',
        'Jaket denim ditemukan di halte',
        'Flashdisk 32GB ditemukan',
        'Helm putih ditemukan di lobby',
    ];

    /**
     * @var list<string>
     */
    protected const LOCATIONS = [
        'Kantin kampus',
        'Perpustakaan lantai 2',
        'Gedung A ruang 101',
        'Parkiran motor belakang',
        'Halte depan kampus',
        'Lapangan upacara',
        'Musholla lantai 1',
        'Lobby utama',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement([Item::TYPE_LOST, Item::TYPE_FOUND]);

        return [
            'type' => $type,
            'status' => fake()->randomElement([$type, $type, $type, Item::STATUS_CLAIMED]),
            'title' => $type === Item::TYPE_LOST
                ? fake()->randomElement(self::LOST_TITLES)
                : fake()->randomElement(self::FOUND_TITLES),
            'description' => fake()->paragraph(3),
            'category' => fake()->randomElement(Item::CATEGORIES),
            'location' => fake()->randomElement(self::LOCATIONS),
            'item_date' => fake()->dateTimeBetween('-2 months', 'now'),
            'photo' => null,
            'reporter_name' => fake()->name(),
        ];
    }

    public function lost(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Item::TYPE_LOST,
            'status' => Item::STATUS_LOST,
            'title' => fake()->randomElement(self::LOST_TITLES),
        ]);
    }

    public function found(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Item::TYPE_FOUND,
            'status' => Item::STATUS_FOUND,
            'title' => fake()->randomElement(self::FOUND_TITLES),
        ]);
    }

    public function claimed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Item::STATUS_CLAIMED,
        ]);
    }
}
