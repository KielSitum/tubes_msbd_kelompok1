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
        Schema::create('invoice_selling_details', function (Blueprint $table) {
            $table->uuid('selling_detail_id')->primary();
            $table->uuid('selling_invoice_id');
            $table->foreign('selling_invoice_id')
                ->references('selling_invoice_id')
                ->on('invoice_selling')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('product_name');
            $table->integer('product_sell_price');
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_selling_details');
    }
};