<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostMediaFactory extends Factory
{
    public function definition(): array
    {
        $images = [
            'destination-1.jpg', 'destination-2.jpg', 'destination-3.jpg',
            'explore-tour-1.jpg', 'gallery-1.jpg', 'gallery-2.jpg',
            'gallery-3.jpg', 'gallery-4.jpg', 'gallery-5.jpg',
        ];

        return [
            'post_id' => Post::inRandomOrder()->first()?->id ?? Post::factory(),
            'media' => '/frontend/images/' . $this->faker->randomElement($images),
            'media_type' => 'image',
        ];
    }
}