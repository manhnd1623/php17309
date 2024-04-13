<?php

namespace Database\Factories;

use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $active = collect([
            Device::ACTIVE,
            Device::INACTIVE,
        ])->random(1)[0];

        return [
            'name' => fake()-> text (100),
            'serial' => fake()-> text (100),
            'model' => fake()-> text (100),
            'img' => fake()-> imageUrl,
            'is_active' => $active,
            'describe' => fake()->text,
        ];
    }
}
