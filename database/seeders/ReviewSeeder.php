<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Activity;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $activities = Activity::all();

        foreach ($users as $user) {
            Review::create([
                'user_id' => $user->id,
                'activity_id' => $activities->random()->id,
                'review' => 'Trải nghiệm tuyệt vời! ' . rand(1, 5) . ' sao.',
                'feedback' => rand(0, 1) ? 'Cảm ơn bạn đã đánh giá!' : null,
            ]);
        }
    }
}
