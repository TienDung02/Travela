<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            ['name' => 'Admin', 'desc' => 'full authority'],
            ['name' => 'Booking manager', 'desc' => 'Order and payment management'],
            ['name' => 'Statistics and reporting manager', 'desc' => 'financial reporting and marketing performance'],
            ['name' => 'Packages manager', 'desc' => 'Manage service packages'],
            ['name' => 'Blogs manager', 'desc' => 'Manage posts'],
            ['name' => 'Contact manager', 'desc' => 'Manage contacts and send notifications'],
            ['name' => 'Customer', 'desc' => 'Book tours, travel packages, use AI to create itineraries, view information about company, websites and tourist destinations'],
        ]);
    }
}
