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
        Schema::create('invoice_buying_details', function (Blueprint $table) {
            $table->uuid('buying_detail_id')->primary();
            $table->uuid('buying_invoice_id');
            $table->foreign('buying_invoice_id')
                ->references('buying_invoice_id')
                ->on('invoice_buying')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('product_name');
            $table->integer('product_buy_price');
            $table->timestamp('exp_date');
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_buying_details');
    }
};
