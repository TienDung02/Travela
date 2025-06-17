<?php

namespace Database\Seeders;

use App\Models\Shipment;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use App\Models\Payment;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $locations = Shipment::all();

        foreach ($users as $user) {
            foreach ($locations as $location) {
            Product::create([
                'user_id' => $user->id,
                'location_id' => $location->id,
                'pickup_time' => rand(1, 7),
                ]);
        }
        }
    }
}
