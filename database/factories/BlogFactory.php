<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class BlogFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'category_id' => \App\Models\BlogCategory::inRandomOrder()->first()->id,
            'active' => 1,
            'published_at' => now(),
            'created_at' => now(),
        ];
    }

}
