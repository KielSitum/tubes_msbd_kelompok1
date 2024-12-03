<?php

namespace Database\Factories;

use App\Models\Produk;
use App\Models\DeskripsiProduk;
use App\Models\DetailProduk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $descriptions_id = DeskripsiProduk::pluck('description_id')->all();
        $description_id = fake()->unique()->randomElement($descriptions_id);

        return [
            'product_id' => fake()->uuid,
            'description_id' => $description_id,
            'product_name' => fake()->text(50),
            'product_status'=> fake()->randomElement(['aktif', 'tidak aktif']),
            'product_sell_price' => fake()->numberBetween(1000,100000),
        ];
    }
}
