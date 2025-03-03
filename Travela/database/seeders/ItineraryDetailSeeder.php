<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItineraryDetail;
use App\Models\Booking;
use App\Models\Location;

class ItineraryDetailSeeder extends Seeder
{
    public function run()
    {
        $bookings = Booking::all();
        $locations = Location::all();

        foreach ($bookings as $booking) {
            ItineraryDetail::create([
                'booking_id' => $booking->id,
                'location_id' => $locations->random()->id,
                'arrival_time' => now()->addHours(rand(1, 10)),
                'day_number' => rand(1, 5),
                'note' => 'Khách sẽ có hướng dẫn viên riêng.',
            ]);
        }
    }
}
