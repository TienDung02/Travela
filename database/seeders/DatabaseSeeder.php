<?php

namespace Database\Seeders;

use App\Models\Preference;
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
            PreferencesSeeder::class,
        ]);
    }
}
