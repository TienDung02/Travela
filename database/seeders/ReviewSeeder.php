<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Place;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        // Lấy tất cả user và place
        $users = User::all();
        $places = Place::all();

        foreach ($places as $place) {
            $reviewCount = rand(10, 20);

            for ($i = 0; $i < $reviewCount; $i++) {
                // Lấy ngẫu nhiên 1 user làm người review
                $user = $users->random();

                Review::create([
                    'user_id' => $user->id,
                    'reviewable_id' => $place->id,
                    'reviewable_type' => Place::class,
                    'rating' => rand(3, 5),
                    'comment' => 'Địa điểm rất đẹp, tôi rất hài lòng.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
