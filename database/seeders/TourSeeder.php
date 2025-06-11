<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;
use Illuminate\Support\Carbon;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        $baseTours = [
            [
                'name' => 'Tour Hà Nội - Hạ Long',
                'desc' => 'Khám phá Hà Nội và vịnh Hạ Long tuyệt đẹp.',
                'base_days' => 10,
                'duration' => 5,
                'price' => 5000000,
            ],
            [
                'name' => 'Tour Đà Nẵng - Hội An',
                'desc' => 'Trải nghiệm thành phố biển Đà Nẵng và phố cổ Hội An.',
                'base_days' => 20,
                'duration' => 5,
                'price' => 4500000,
            ],
            [
                'name' => 'Tour Sài Gòn - Miền Tây',
                'desc' => 'Khám phá Sài Gòn sôi động và miền Tây sông nước.',
                'base_days' => 5,
                'duration' => 4,
                'price' => 4000000,
            ],
        ];

        for ($i = 1; $i <= 20; $i++) {
            $template = $baseTours[$i % count($baseTours)];
            Tour::create([
                'name' => $template['name'] ,
                'desc' => $template['desc'] ,
                'start_date' => now()->addDays($template['base_days'] + $i),
                'end_date' => now()->addDays($template['base_days'] + $i + $template['duration']),
                'price' => $template['price'] + ($i * 100000),
            ]);
        }
    }
}
