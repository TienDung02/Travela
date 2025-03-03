<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        Activity::insert([
            ['name' => 'Tham quan phố cổ', 'type' => 'sightseeing', 'price' => 100000, 'duration' => 120],
            ['name' => 'Đi biển', 'type' => 'adventure', 'price' => 150000, 'duration' => 180],
            ['name' => 'Thưởng thức ẩm thực', 'type' => 'food', 'price' => 200000, 'duration' => 90],
        ]);
    }
}
