<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ItemSeeder extends Seeder
{
    /**
     * Data dummy barang hilang & ditemukan untuk mengisi dashboard.
     *
     * @var list<array<string, mixed>>
     */
    protected array $items = [
        [
            'type' => Item::TYPE_LOST,
            'status' => Item::STATUS_LOST,
            'title' => 'Dompet kulit hitam berisi KTP',
            'description' => 'Dompet kulit warna hitam berisi KTP, kartu ATM BCA, dan uang tunai sekitar Rp 200.000. Terakhir dipakai saat makan siang di kantin.',
            'category' => 'Dompet & Tas',
            'location' => 'Kantin kampus',
            'item_date' => '-2 days',
            'reporter_name' => 'Rizky Pratama',
        ],
        [
            'type' => Item::TYPE_LOST,
            'status' => Item::STATUS_LOST,
            'title' => 'HP Samsung Galaxy A54 warna biru',
            'description' => 'HP Samsung Galaxy A54 warna biru dengan softcase bening dan stiker bintang di belakang. Layar masih ada retak halus di sudut kanan atas.',
            'category' => 'Elektronik',
            'location' => 'Perpustakaan lantai 2',
            'item_date' => '-3 days',
            'reporter_name' => 'Nabila Putri',
        ],
        [
            'type' => Item::TYPE_LOST,
            'status' => Item::STATUS_LOST,
            'title' => 'Kunci motor dengan gantungan kucing',
            'description' => 'Kunci motor Honda Vario dengan gantungan kunci berbentuk kucing warna abu-abu. Ada remote alarm kecil di rantai kuncinya.',
            'category' => 'Kunci',
            'location' => 'Parkiran motor belakang',
            'item_date' => '-1 day',
            'reporter_name' => 'Agus Setiawan',
        ],
        [
            'type' => Item::TYPE_LOST,
            'status' => Item::STATUS_LOST,
            'title' => 'Tas laptop hitam merek Eiger',
            'description' => 'Tas laptop hitam merek Eiger berisi laptop Lenovo ThinkPad, charger, dan buku catatan kuliah. Ada bordir nama "DWI" di bagian depan.',
            'category' => 'Dompet & Tas',
            'location' => 'Gedung A ruang 101',
            'item_date' => '-5 days',
            'reporter_name' => 'Dwi Handayani',
        ],
        [
            'type' => Item::TYPE_LOST,
            'status' => Item::STATUS_LOST,
            'title' => 'KTM dan KTP atas nama Fajar Nugroho',
            'description' => 'Kartu Tanda Mahasiswa dan KTP hilang bersamaan, kemungkinan jatuh saat perjalanan dari halte ke gedung B.',
            'category' => 'Dokumen & Kartu',
            'location' => 'Halte depan kampus',
            'item_date' => '-7 days',
            'reporter_name' => 'Fajar Nugroho',
        ],
        [
            'type' => Item::TYPE_LOST,
            'status' => Item::STATUS_LOST,
            'title' => 'Earphone TWS putih case retak',
            'description' => 'Earphone TWS warna putih, case bagian atas ada retak, merek Taff Studio. Terakhir dipakai saat belajar di musholla.',
            'category' => 'Elektronik',
            'location' => 'Musholla lantai 1',
            'item_date' => '-4 days',
            'reporter_name' => 'Siti Aminah',
        ],
        [
            'type' => Item::TYPE_LOST,
            'status' => Item::STATUS_LOST,
            'title' => 'Gelang emas rantai kecil',
            'description' => 'Gelang emas rantai kecil dengan liontin inisial "A". Sangat berharga, mohon dikembalikan jika menemukan.',
            'category' => 'Perhiasan',
            'location' => 'Lapangan upacara',
            'item_date' => '-9 days',
            'reporter_name' => 'Anisa Rahmawati',
        ],
        [
            'type' => Item::TYPE_LOST,
            'status' => Item::STATUS_CLAIMED,
            'title' => 'Sepeda lipat warna merah',
            'description' => 'Sepeda lipat warna merah merek Element, ada keranjang hitam di depan. Sudah ditemukan oleh petugas keamanan.',
            'category' => 'Kendaraan',
            'location' => 'Lobby utama',
            'item_date' => '-12 days',
            'reporter_name' => 'Bayu Saputra',
        ],
        [
            'type' => Item::TYPE_FOUND,
            'status' => Item::STATUS_FOUND,
            'title' => 'Dompet hitam berisi kartu mahasiswa',
            'description' => 'Menemukan dompet hitam berisi kartu mahasiswa atas nama Rizky Pratama dan beberapa kartu lain. Dompet dititipkan di pos keamanan.',
            'category' => 'Dompet & Tas',
            'location' => 'Kantin kampus',
            'item_date' => '-1 day',
            'reporter_name' => 'Petugas Keamanan',
        ],
        [
            'type' => Item::TYPE_FOUND,
            'status' => Item::STATUS_FOUND,
            'title' => 'Botol minum stainless warna silver',
            'description' => 'Botol minum stainless warna silver dengan sticker gunung di sisi kanan. Ditemukan tertinggal di meja paling belakang.',
            'category' => 'Lainnya',
            'location' => 'Gedung A ruang 101',
            'item_date' => '-2 days',
            'reporter_name' => 'Rina Kusuma',
        ],
        [
            'type' => Item::TYPE_FOUND,
            'status' => Item::STATUS_FOUND,
            'title' => 'Kunci motor dengan gantungan kucing',
            'description' => 'Kunci motor ditemukan menggantung di pagar parkiran dengan gantungan kunci kucing abu-abu dan remote alarm.',
            'category' => 'Kunci',
            'location' => 'Parkiran motor belakang',
            'item_date' => '-1 day',
            'reporter_name' => 'Petugas Parkir',
        ],
        [
            'type' => Item::TYPE_FOUND,
            'status' => Item::STATUS_FOUND,
            'title' => 'Jaket denim biru ukuran L',
            'description' => 'Jaket denim biru ukuran L tanpa merek yang jelas. Ditemukan tertinggal di bangku halte sejak pagi.',
            'category' => 'Pakaian & Aksesoris',
            'location' => 'Halte depan kampus',
            'item_date' => '-3 days',
            'reporter_name' => 'Hendra Wijaya',
        ],
        [
            'type' => Item::TYPE_FOUND,
            'status' => Item::STATUS_FOUND,
            'title' => 'Flashdisk 32GB warna merah',
            'description' => 'Flashdisk 32GB warna merah merek Sandisk, masih menyala saat dites. Ditemukan di meja komputer perpustakaan.',
            'category' => 'Elektronik',
            'location' => 'Perpustakaan lantai 2',
            'item_date' => '-6 days',
            'reporter_name' => 'Maya Sari',
        ],
        [
            'type' => Item::TYPE_FOUND,
            'status' => Item::STATUS_CLAIMED,
            'title' => 'Helm putih full face',
            'description' => 'Helm putih full face merek KYT dengan visor bening. Sudah diambil oleh pemiliknya dengan menunjukkan STNK.',
            'category' => 'Pakaian & Aksesoris',
            'location' => 'Lobby utama',
            'item_date' => '-8 days',
            'reporter_name' => 'Petugas Keamanan',
        ],
        [
            'type' => Item::TYPE_FOUND,
            'status' => Item::STATUS_FOUND,
            'title' => 'Kucing oren berkalung merah',
            'description' => 'Kucing oren jinak dengan kalung merah dan lonceng kecil, ditemukan berkeliaran di area lapangan upacara.',
            'category' => 'Hewan Peliharaan',
            'location' => 'Lapangan upacara',
            'item_date' => '-2 days',
            'reporter_name' => 'Dimas Prayoga',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->items as $item) {
            $item['item_date'] = Carbon::parse($item['item_date'])->toDateString();

            Item::create($item);
        }
    }
}
