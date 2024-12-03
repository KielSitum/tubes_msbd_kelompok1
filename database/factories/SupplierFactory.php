<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supplier_id' => $this->faker->uuid, // Generate UUID secara acak
            'supplier' => $this->faker->company, // Nama perusahaan acak
            'supplier_address' => $this->faker->address, // Alamat acak
            'supplier_phone' => '08'.strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)),
        ];
    
    }
}






