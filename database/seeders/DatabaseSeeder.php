<?php

namespace Database\Seeders;

use App\Models\Preference;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Place;
use App\Models\PlaceMedia;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Package;
use App\Models\Tour;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Review;
use App\Models\Contact;
use App\Models\ActivityLog;
use App\Models\TourPlace;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProvinceSeeder::class,
            DistrictSeeder::class,
            WardSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
//            PlaceSeeder::class,
            TourSeeder::class,
            ReviewSeeder::class,
            CurrencySeeder::class,
            PreferencesSeeder::class,
            CategorySeeder::class,
        ]);

        User::factory(10)->create();

        Place::factory(50)->create();

        PlaceMedia::factory(750)->create();

        Place::all()->each(function ($place) {
            $media = $place->placeMedia()->inRandomOrder()->first();
            if ($media) {
                $media->is_primary = true;
                $media->save();
            }
        });

        BlogCategory::factory(5)->create();

        Blog::factory(10)->create();

        // Tạo dữ liệu cho bảng Tour
        //Tour::factory(10)->create();

        $this->call(PackageSeeder::class);

//        Category::factory(10)->create();

        Order::factory(5)->create();

        OrderDetail::factory()->count(5)->state([
            'item_type' => 'tour',
        ])->create();

        OrderDetail::factory()->count(5)->state([
            'item_type' => 'package',
        ])->create();

        Review::factory(30)->create();

        Contact::factory(5)->create();

        ActivityLog::factory(10)->create();

        $this->call([
//            PlaceMediaSeeder::class,
            TourPlaceSeeder::class,
            PackageImageSeeder::class,
        ]);
    }
}
