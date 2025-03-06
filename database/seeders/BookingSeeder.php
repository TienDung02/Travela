<?php

namespace Database\Seeders;

use App\Models\location;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Destination;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $locations = location::all();

        foreach ($users as $user) {
            foreach ($locations as $location) {
            Booking::create([
                'user_id' => $user->id,
                'location_id' => $location->id,
                'pickup_time' => rand(1, 7),
                ]);
        }
        }
    }
}
