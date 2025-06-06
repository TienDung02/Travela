<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first(),
            'reviewable_id' => rand(1, 10),
            'reviewable_type' => $this->faker->randomElement([
                \App\Models\Package::class,
                \App\Models\Tour::class,
                \App\Models\Place::class,
            ]),
            'rating' => rand(1, 5),
            'comment' => $this->faker->sentence,
        ];
    }
}
