<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PackageFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->city,
            'desc' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(1000000, 10000000),
            'tour_id' => \App\Models\Tour::inRandomOrder()->first(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
