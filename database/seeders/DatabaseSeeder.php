<?php

namespace Database\Seeders;

use App\Models\Preference;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Place;
use App\Models\PlaceMedia;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Package;
use App\Models\Tour;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Review;
use App\Models\Contact;
use App\Models\ActivityLog;
use App\Models\TourPlace;
//use Database\Seeders\RoleSeeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            PlaceSeeder::class,
            PlaceMediaSeeder::class,
            TourSeeder::class,
            ReviewSeeder::class,
            CurrencySeeder::class,
            PreferencesSeeder::class,
        ]);

        User::factory(10)->create();

//        Place::factory(10)->create();

        PlaceMedia::factory(10)->create();

        BlogCategory::factory(5)->create();

        Blog::factory(10)->create();

        // Tạo dữ liệu cho bảng Tour
        //Tour::factory(10)->create();

        Tour::factory(10)->create();



        Package::factory(50)->create();

        Customer::factory(10)->create();

        Order::factory(5)->create();

        OrderDetail::factory()->count(5)->state([
            'item_type' => 'tour',
        ])->create();

        OrderDetail::factory()->count(5)->state([
            'item_type' => 'package',
        ])->create();

        Review::factory(10)->create();

        Contact::factory(5)->create();

        ActivityLog::factory(10)->create();

        $this->call([
            TourPlaceSeeder::class,

            PackageImageSeeder::class,
        ]);
    }
}
