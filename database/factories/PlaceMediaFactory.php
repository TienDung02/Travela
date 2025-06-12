<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PlaceMediaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'place_id' => \App\Models\Place::inRandomOrder()->first(),
            'media' => 'frontend/images/destination-' . $this->faker->numberBetween(1, 9) . '.jpg',
            'media_type' => 'image',
            'is_primary' => $this->faker->boolean(),
        ];
    }
}
