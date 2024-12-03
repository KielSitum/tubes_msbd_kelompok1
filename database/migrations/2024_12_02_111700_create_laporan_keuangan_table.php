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
        Schema::create('laporan_keuangan', function (Blueprint $table) {
            $table->id('id_laporan'); // Primary key
            $table->date('tanggal_laporan');
            $table->decimal('pendapatan_kotor', 15, 2);
            $table->decimal('pendapatan_bersih', 15, 2);
            $table->integer('jumlah_transaksi');
            $table->decimal('total_pengeluaran', 15, 2);
            $table->text('catatan')->nullable(); // Catatan boleh kosong
            $table->timestamps(); // Untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keuangan');
    }
};
