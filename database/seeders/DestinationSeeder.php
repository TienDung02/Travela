<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        Destination::insert([
            ['name' => 'Vịnh Hạ Long', 'region' => 'North', 'image' => 'images/halong.jpg'],
            ['name' => 'Phú Quốc', 'region' => 'South', 'image' => 'images/phuquoc.jpg'],
            ['name' => 'Đà Lạt', 'region' => 'Central', 'image' => 'images/dalat.jpg'],
        ]);
    }
}
