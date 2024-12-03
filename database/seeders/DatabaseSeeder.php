<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(8)->create();
        \App\Models\User::factory()->create([
            'username' => 'cashier1',
            'role' => 'cashier'
        ]);
        \App\Models\User::factory()->create([
            'username' => 'owner',
            'role' => 'owner'
        ]);

        \App\Models\Kasir::factory(1)->create();
        \App\Models\Customer::factory(9)->create();
        \App\Models\Kategori::factory(8)->create();
        \App\Models\Unit::factory(7)->create();
        \App\Models\Group::factory(4)->create();
        \App\Models\Supplier::factory(7)->create();
        for ($i=0; $i < 40; $i++) { 
            \App\Models\DeskripsiProduk::factory(1)->create();
            \App\Models\Produk::factory(1)->create();
            \App\Models\DetailProduk::factory(1)->create();
        }
        for ($i=0; $i < 40; $i++) { 
            \App\Models\InvoiceSelling::factory(1)->create();
        }
        \App\Models\InvoiceSellingDetail::factory(160)->create();
        \App\Models\InvoiceBuying::factory(5)->create();
        \App\Models\InvoiceBuyingDetail::factory(20)->create();
        \App\Models\Keranjang::factory(30)->create();
    }
}
