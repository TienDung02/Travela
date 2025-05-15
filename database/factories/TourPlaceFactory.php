<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TourPlaceFactory extends Factory
{
    protected $model = \App\Models\TourPlace::class;

    public function definition(): array
    {
        return [
            // Các trường này sẽ được truyền từ Seeder
            'tour_id' => null,
            'place_id' => null,
            'day_number' => null,
            'duration_days' => null,
            'note' => $this->faker->text(),
        ];
    }
}
