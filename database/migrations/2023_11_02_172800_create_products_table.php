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
        Schema::create('produk', function (Blueprint $table) {
            $table->uuid('product_id')->primary();
            $table->uuid('description_id');
            $table->foreign('description_id')
                ->references('description_id')
                ->on('deskripsi_produk')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('product_name');
            // $table->timestamp('product_expired');
            // $table->integer('product_stock');
            // $table->integer('product_buy_price');
            $table->integer('product_sell_price');
            $table->integer('discounted_price')->nullable(); // Harga setelah diskon
            $table->enum('product_status', ['aktif', 'tidak aktif', 'exp']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
