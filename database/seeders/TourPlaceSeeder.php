<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Place;
use App\Models\Tour;
use App\Models\TourPlace;

class TourPlaceSeeder extends Seeder
{
    public function run(): void
    {
        $tours = Tour::all();
        $places = Place::all();

        foreach ($tours as $tour) {
            $tourDuration = $tour->start_date->diffInDays($tour->end_date);

            $usedDays = 0;
            $dayNumber = 1;

            $placesForTour = $places->random(rand(2, 4));

            foreach ($placesForTour as $place) {
                $maxStay = max(1, $tourDuration - $usedDays);
                if ($maxStay <= 0) break;

                $duration = rand(1, min(3, $maxStay)); // mỗi nơi ở tối đa 3 ngày
                $usedDays += $duration;

                TourPlace::factory()->create([
                    'tour_id' => $tour->id,
                    'place_id' => $place->id,
                    'day_number' => $dayNumber,
                    'duration_days' => $duration,
                ]);

                $dayNumber += $duration;
            }
        }
    }
}
