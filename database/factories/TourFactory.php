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

        $startDate = Carbon::now()->addDays(rand(5, 90));

        return [
            'name' => $this->faker->word,
            'desc' => $this->faker->sentence,
            'start_date' => Carbon::now()->addDays(rand(5, 90)),
            'end_date' => (clone $startDate)->addDays(rand(7, 30)),
            'price' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }

}
