<?php

namespace Database\Factories;

use App\Models\InvoiceBuying;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceBuyingDetail>
 */
class InvoiceBuyingDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $buying_id = InvoiceBuying::pluck('buying_invoice_id')->all();
        $id = fake()->randomElement($buying_id);

        $products_name = Produk::all()->pluck('product_name');
        $product_name = fake()->randomElement($products_name);

        return [
            'buying_detail_id' => fake()->uuid,
            'buying_invoice_id' => $id,
            'product_name' => $product_name,
            'product_buy_price' => fake()->numberBetween(1000,100000),
            'exp_date'=> fake()->dateTime(),
            'quantity' => fake()->numberBetween(1, 20),
        ];
    }
}
