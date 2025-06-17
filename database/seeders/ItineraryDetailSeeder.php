<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Shipment;

class ItineraryDetailSeeder extends Seeder
{
    public function run()
    {
        $bookings = Product::all();
        $locations = Shipment::all();

        foreach ($bookings as $booking) {
            Discount::create([
                'booking_id' => $booking->id,
                'location_id' => $locations->random()->id,
                'arrival_time' => now()->addHours(rand(1, 10)),
                'day_number' => rand(1, 5),
                'note' => 'Khách sẽ có hướng dẫn viên riêng.',
            ]);
        }
    }
}
