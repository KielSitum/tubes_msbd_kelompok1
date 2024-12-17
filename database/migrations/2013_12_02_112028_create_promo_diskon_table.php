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
        Schema::create('promo_diskon', function (Blueprint $table) {
            $table->id('id_promo'); // Auto-increment primary key
            $table->string('nama_promo', 100); // VARCHAR(100) NOT NULL
            $table->decimal('nilai_diskon', 5, 2); // DECIMAL(5, 2) NOT NULL
            $table->date('tanggal_mulai'); // DATE NOT NULL
            $table->date('tanggal_selesai'); // DATE NOT NULL
            $table->enum('status', ['aktif', 'nonaktif']); // ENUM('aktif', 'nonaktif') NOT NULL
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_diskon');
    }
};
