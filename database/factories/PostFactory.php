<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'place_id' => \App\Models\Place::inRandomOrder()->first()?->id ?? \App\Models\Place::factory(),
            'caption' => Str::limit($this->faker->paragraph(), 150),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Post $post) {
            \App\Models\PostMedia::factory()->count(rand(1, 3))->create([
                'post_id' => $post->id,
            ]);
        });
    }
}
