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
        DROP TRIGGER IF EXISTS cannot_delete_selling_invoice;

        CREATE TRIGGER cannot_delete_selling_invoice 
        BEFORE DELETE ON invoice_selling
        FOR EACH ROW 
        BEGIN 
            SIGNAL SQLSTATE '45000' SET
            MESSAGE_TEXT = 'Tidak Dapat Menghapus Invoice';
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
