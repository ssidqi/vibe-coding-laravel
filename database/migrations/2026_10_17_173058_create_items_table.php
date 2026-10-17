<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Satu tabel `items` dipakai untuk barang hilang maupun barang ditemukan
     * (Opsi B): kolom `type` menentukan asal laporannya, kolom `status`
     * menentukan keadaan barang saat ini.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['lost', 'found'])->index();
            $table->enum('status', ['lost', 'found', 'claimed'])->index();
            $table->string('title');
            $table->text('description');
            $table->string('category')->nullable();
            $table->string('location')->nullable();
            // Tanggal kejadian: tanggal hilang untuk type = lost,
            // tanggal ditemukan untuk type = found.
            $table->date('item_date')->nullable();
            $table->string('photo')->nullable();
            $table->string('reporter_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
