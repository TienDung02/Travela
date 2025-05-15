<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\PlaceMedia;
use App\Models\Place;

class PlaceMediaSeeder extends Seeder
{
    public function run(): void
    {
        $places = Place::all();

        foreach ($places as $place) {
            // Tạo 1 media chính
            PlaceMedia::factory()->create([
                'place_id' => $place->id,
                'is_primary' => true,
            ]);

            // Tạo thêm 3 media phụ
            PlaceMedia::factory(3)->create([
                'place_id' => $place->id,
                'is_primary' => false,
            ]);
        }
    }
}
