<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $active = collect([
            Car::ACTIVE,
            Car::INACTIVE,
        ])->random(1)[0];

        return [
            'name' => fake()-> text (100),
            'brand' => fake()-> text (100),
            'img' => fake()-> imageUrl,
            'is_active' => $active,
            'describe' => fake()->text,
        ];
    }
}
