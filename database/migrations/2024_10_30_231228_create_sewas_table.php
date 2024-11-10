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
        Schema::create('sewas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penyewa')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_bus')->constrained('buses')->onDelete('cascade');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->time('jam_penjemputan');
            $table->text('lokasi_penjemputan');
            // $table->decimal('total_harga', 10, 0)->default(0);
            $table->integer('total_harga');
            $table->text('tujuan');
            $table->enum('status', ['Diproses', 'Berlangsung', 'Selesai', 'Dibatalkan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewas');
    }
};
