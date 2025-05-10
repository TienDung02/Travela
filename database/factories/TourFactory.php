<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TourFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'desc' => $this->faker->sentence,
            'location' => $this->faker->city,
            'start_date' => Carbon::now()->addDays(rand(1, 10)),
            'end_date' => Carbon::now()->addDays(rand(11, 20)),
            'price' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }

}
