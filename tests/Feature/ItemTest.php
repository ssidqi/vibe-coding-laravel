<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_menampilkan_statistik_dan_daftar_barang(): void
    {
        Item::factory()->lost()->count(3)->create();
        Item::factory()->found()->count(2)->create();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Barang Hilang');
        $response->assertSee('Barang Ditemukan');
        $response->assertSee('3');
        $response->assertSee('2');
    }

    public function test_dashboard_dengan_database_kosong_tetap_tampil(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Belum ada laporan barang hilang.');
        $response->assertSee('Belum ada laporan barang ditemukan.');
    }

    public function test_halaman_form_kehilangan_dan_penemuan_dapat_dibuka(): void
    {
        $this->get(route('lost.create'))
            ->assertOk()
            ->assertSee('Posting Kehilangan Barang');

        $this->get(route('found.create'))
            ->assertOk()
            ->assertSee('Posting Penemuan Barang');
    }

    public function test_laporan_barang_hilang_tersimpan_ke_database(): void
    {
        $response = $this->post(route('lost.store'), [
            'title' => 'Dompet hitam hilang',
            'description' => 'Dompet kulit hitam berisi KTP dan kartu ATM.',
            'category' => 'Dompet & Tas',
            'location' => 'Kantin kampus',
            'item_date' => now()->subDay()->toDateString(),
            'reporter_name' => 'Rizky Pratama',
        ]);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('items', [
            'title' => 'Dompet hitam hilang',
            'type' => Item::TYPE_LOST,
            'status' => Item::STATUS_LOST,
        ]);
    }

    public function test_laporan_barang_ditemukan_tersimpan_ke_database(): void
    {
        $response = $this->post(route('found.store'), [
            'title' => 'Botol minum ditemukan',
            'description' => 'Botol stainless warna silver ditemukan di ruang kelas.',
            'category' => 'Lainnya',
            'location' => 'Gedung A ruang 101',
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('items', [
            'title' => 'Botol minum ditemukan',
            'type' => Item::TYPE_FOUND,
            'status' => Item::STATUS_FOUND,
        ]);
    }

    public function test_foto_barang_disimpan_ke_disk_public(): void
    {
        Storage::fake('public');

        $this->post(route('lost.store'), [
            'title' => 'Jaket denim hilang',
            'description' => 'Jaket denim biru ukuran L dengan tambalan di siku.',
            'photo' => UploadedFile::fake()->image('jaket.jpg'),
        ])->assertRedirect(route('dashboard'));

        $item = Item::firstOrFail();

        Storage::disk('public')->assertExists($item->photo);
    }

    public function test_validasi_gagal_saat_field_wajib_kosong(): void
    {
        $response = $this->post(route('lost.store'), [
            'title' => '',
            'description' => '',
        ]);

        $response->assertSessionHasErrors(['title', 'description']);
        $this->assertDatabaseCount('items', 0);
    }

    public function test_validasi_gagal_saat_kategori_tidak_dikenal(): void
    {
        $response = $this->post(route('lost.store'), [
            'title' => 'Barang aneh',
            'description' => 'Deskripsi barang yang cukup panjang untuk lolos validasi.',
            'category' => 'Kategori Ngawur',
        ]);

        $response->assertSessionHasErrors('category');
    }

    public function test_status_claimed_menampilkan_badge_diklaim(): void
    {
        Item::factory()->found()->claimed()->create(['title' => 'Helm putih full face']);

        $this->get('/')
            ->assertOk()
            ->assertSee('Helm putih full face')
            ->assertSee('Diklaim');
    }
}
