<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $sql = "
        DROP PROCEDURE IF EXISTS add_product_procedure;

        CREATE PROCEDURE add_product_procedure(
            IN product_id CHAR(36),
            IN product_name VARCHAR(255),
            IN product_status ENUM('aktif', 'tidak aktif', 'exp'),
            IN gambar_obat_file VARCHAR(255),
            IN desc_id CHAR(36),
            IN kategori CHAR(36),
            IN golongan CHAR(36),
            IN satuan_obat CHAR(36),
            IN NIE VARCHAR(15),
            IN pemasok CHAR(36),
            IN produksi VARCHAR(255),
            IN deskripsi LONGTEXT,
            IN efek_samping LONGTEXT,
            IN dosis LONGTEXT,
            IN indikasi LONGTEXT,
            IN peringatan LONGTEXT,
            IN harga_beli INT,
            IN expired_date TIMESTAMP,
            IN harga_jual INT,
            IN stock INT,
            IN detail_id CHAR(36)
        )
        BEGIN
        
            DECLARE existing_invoice_id CHAR(36);

            DECLARE is_transaction_successful BOOLEAN DEFAULT TRUE;

            DECLARE EXIT HANDLER FOR SQLEXCEPTION
            BEGIN
                SET is_transaction_successful = FALSE;
                ROLLBACK;
            END;

            START TRANSACTION;

            SELECT bi.buying_invoice_id INTO existing_invoice_id
            FROM invoice_buying bi
            JOIN suppliers s ON bi.supplier_name COLLATE utf8mb4_unicode_ci = s.supplier COLLATE utf8mb4_unicode_ci
            WHERE s.supplier_id COLLATE utf8mb4_unicode_ci = pemasok
                AND DATE_FORMAT(bi.order_date, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')
            LIMIT 1;

            IF existing_invoice_id IS NULL THEN
                INSERT INTO invoice_buying (buying_invoice_id, supplier_name, order_date)
                VALUES (UUID(), (SELECT s.supplier COLLATE utf8mb4_unicode_ci FROM suppliers s WHERE s.supplier_id COLLATE utf8mb4_unicode_ci = pemasok), NOW());

                SELECT buying_invoice_id INTO existing_invoice_id
                FROM invoice_buying
                WHERE supplier_name COLLATE utf8mb4_unicode_ci = (SELECT s.supplier COLLATE utf8mb4_unicode_ci FROM suppliers s WHERE s.supplier_id COLLATE utf8mb4_unicode_ci = pemasok)
                AND DATE_FORMAT(order_date, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')
                ORDER BY order_date DESC
                LIMIT 1;
            END IF;

            INSERT INTO deskripsi_produk (description_id, category_id, group_id, unit_id, product_DPN, supplier_id, product_manufacture, product_description, product_sideEffect, product_dosage, product_indication, product_notice, product_photo)
            VALUES (desc_id, kategori, golongan, satuan_obat, NIE, pemasok, produksi, deskripsi, efek_samping, dosis, indikasi, peringatan, gambar_obat_file);

            INSERT INTO produk (product_id, product_status, product_name, product_sell_price, description_id)
            VALUES (product_id, product_status, product_name, harga_jual, desc_id);

            INSERT INTO detail_produk (product_id, detail_id, product_buy_price, product_expired, product_stock)
            VALUES (product_id, detail_id, harga_beli, expired_date, stock);

            INSERT INTO invoice_buying_details (buying_detail_id, buying_invoice_id, product_name, product_buy_price, exp_date, quantity)
            VALUES (UUID(), existing_invoice_id, product_name, harga_beli, expired_date, stock);

            IF is_transaction_successful THEN
                COMMIT;
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
        //
    }
};