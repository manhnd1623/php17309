<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $active = collect([
            Product::ACTIVE,
            Product::INACTIVE,
        ])->random(1)[0];

        return [
            'name' => fake()-> text (100),
            'price' => fake()-> text ,
            'price_sale' => fake()-> text ,
            'img' => fake()-> imageUrl,
            'is_active' => $active,
            'describe' => fake()->text,
        ];
    }
}
