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
        $sql = "
        DROP TRIGGER IF EXISTS update_discount_price_insert;

        CREATE TRIGGER update_discount_price_insert
        AFTER INSERT ON promo_diskon
        FOR EACH ROW
        BEGIN
            IF NEW.status = 'aktif' THEN
                UPDATE produk
                SET discounted_price = product_sell_price - (product_sell_price * NEW.nilai_diskon / 100)
                WHERE product_status = 'aktif';
                
                UPDATE invoice_selling_details
                JOIN produk ON invoice_selling_details.product_name = produk.product_name
                SET invoice_selling_details.discounted_price = produk.product_sell_price - (produk.product_sell_price * NEW.nilai_diskon / 100)
                WHERE produk.product_status = 'aktif';
            END IF;
        END;

        
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_discount_price_trigger');
    }
};
