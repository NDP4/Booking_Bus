<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bus', 100);
            $table->string('plat_nomor', 20)->unique();
            $table->integer('kapasitas');
            $table->year('tahun');
            $table->string('sasis');
            $table->string('karoseri', 100)->nullable();
            $table->string('nomor_kir');
            $table->text('fasilitas');
            $table->string('foto_bus', 255)->nullable();
            $table->text('kondisi');
            $table->integer('harga_sewa');
            $table->enum('status', ['Tersedia', 'Tidak Tersedia', 'Dalam Perawatan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
