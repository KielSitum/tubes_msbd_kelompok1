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
        Schema::create('log_stok', function (Blueprint $table) {
            $table->id('id_log_stok'); // Primary key
            $table->unsignedBigInteger('id_obat'); // Foreign key (hubungkan ke tabel obat jika ada)
            $table->date('tanggal_perubahan'); // Tanggal perubahan stok
            $table->string('jenis_perubahan', 50); // Jenis perubahan (misalnya: "penambahan" atau "pengurangan")
            $table->integer('jumlah'); // Jumlah perubahan stok
            $table->string('keterangan', 255)->nullable(); // Keterangan tambahan
            $table->timestamps(); // Untuk kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_stok');
    }
};
