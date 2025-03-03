<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run()
    {
        Location::insert([
            [
                'name' => 'Hà Nội',
                'address' => 'Hà Nội',
                'average_rating' => 4.5,
                'note' => 'Thủ đô Việt Nam'
            ],
            [
                'name' => 'TP. Hồ Chí Minh',
                'address' => 'TP. Hồ Chí Minh',
                'average_rating' => 4.7,
                'note' => 'Thành phố lớn nhất Việt Nam'
            ],
            [
                'name' => 'Đà Nẵng',
                'address' => 'Đà Nẵng',
                'average_rating' => 4.6,
                'note' => 'Thành phố biển đẹp'
            ],
        ]);
    }
}
