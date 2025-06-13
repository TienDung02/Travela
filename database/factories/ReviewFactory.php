<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Package;
use App\Models\Tour;
use App\Models\Place;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $reviewables = [
            Package::class,
            Tour::class,
            Place::class,
            ];
        
        $type = $this->faker->randomElement($reviewables);
        $id = $type::inRandomOrder()->first()?->id;
        
        return [
            'user_id' => User::inRandomOrder()->first()?->id,
            'reviewable_id' => $id,
            'reviewable_type' => $type,
            'rating' => rand(1, 5),
            'comment' => $this->faker->sentence,
        ];
    }
}