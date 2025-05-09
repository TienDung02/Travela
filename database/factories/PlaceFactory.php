<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PlaceFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->city,
            'desc' => $this->faker->sentence,
            'address' => $this->faker->address,
            'tag' => $this->faker->word,
            'lat' => $this->faker->latitude,
            'lon' => $this->faker->longitude,
            'status' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
