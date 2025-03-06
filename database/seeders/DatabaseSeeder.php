<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            LocationSeeder::class,
            ActivitySeeder::class,
            DestinationSeeder::class,
            BookingSeeder::class,
            ItineraryDetailSeeder::class,
            ReviewSeeder::class,
            CurrencySeeder::class,
        ]);
    }
}
