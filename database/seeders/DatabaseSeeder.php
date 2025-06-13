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
            ReviewSeeder::class,
            CurrencySeeder::class,
            PreferencesSeeder::class,
        ]);
        // Tạo dữ liệu cho bảng Role
//        Role::factory(5)->create();

        // Tạo dữ liệu cho bảng User
        User::factory(10)->create();

        // Tạo dữ liệu cho bảng Place
        Place::factory(10)->create();

        // Tạo dữ liệu cho bảng PlaceMedia
        PlaceMedia::factory(10)->create();

        // Tạo dữ liệu cho bảng BlogCategory
        BlogCategory::factory(5)->create();

        // Tạo dữ liệu cho bảng Blog
        Blog::factory(10)->create();

        // Tạo dữ liệu cho bảng Tour
        Tour::factory(10)->create();

        // Tạo dữ liệu cho bảng Package
        Package::factory(50)->create();

        // Tạo dữ liệu cho bảng Customer
        Customer::factory(10)->create();

        // Tạo dữ liệu cho bảng Order
        Order::factory(5)->create();

        // Tạo dữ liệu cho bảng OrderDetail
        // 5 OrderDetail là tour và 5 OrderDetail là package
        OrderDetail::factory()->count(5)->state([
            'item_type' => 'tour',
        ])->create();

        OrderDetail::factory()->count(5)->state([
            'item_type' => 'package',
        ])->create();

        // Tạo dữ liệu cho bảng Review
        Review::factory(10)->create();

        // Tạo dữ liệu cho bảng Contact
        Contact::factory(5)->create();

        // Tạo dữ liệu cho bảng ActivityLog
        ActivityLog::factory(10)->create();

        $this->call([
            TourPlaceSeeder::class,

            PackageImageSeeder::class,
        ]);
    }
}
