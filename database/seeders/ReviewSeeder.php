<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Place;
use App\Models\Tour;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        // Lấy tất cả user và place
        $users = User::all();
        $places = Place::all();
        $tours = Tour::all();

        foreach ($places as $place) {
            $reviewCount = rand(40, 50);

            for ($i = 0; $i < $reviewCount; $i++) {
                // Lấy ngẫu nhiên 1 user làm người review
                $user = $users->random();

                Review::create([
                    'user_id' => $user->id,
                    'reviewable_id' => $place->id,
                    'reviewable_type' => Place::class,
                    'rating' => rand(1, 5),
                    'comment' => 'Địa điểm rất đẹp, tôi rất hài lòng.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        foreach ($tours as $tour) {
            $reviewCount = rand(20, 30);
    
            for ($i = 0; $i < $reviewCount; $i++) {
                $user = $users->random();
    
                Review::create([
                    'user_id' => $user->id,
                    'reviewable_id' => $tour->id,
                    'reviewable_type' => Tour::class,
                    'rating' => rand(1, 5),
                    'comment' => 'Tour rất tuyệt vời, hướng dẫn viên thân thiện.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        $packages = \App\Models\Package::all();

        foreach ($packages as $package) {
        // Kiểm tra nếu package chưa có review nào thì tạo ít nhất 1
        if ($package->reviews()->count() === 0) {
            Review::create([
                'user_id' => $users->random()->id,
                'reviewable_id' => $package->id,
                'reviewable_type' => \App\Models\Package::class,
                'rating' => rand(1, 5),
                'comment' => 'Đánh giá khởi tạo cho gói tour.',
                'created_at' => now(),
                'updated_at' => now(),
        ]);
    }}

    }
}
