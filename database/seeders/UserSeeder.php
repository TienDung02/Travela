<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo 5 user đăng nhập bằng email & mật khẩu
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'provider' => 'local',
                'provider_id' => null,
            ]);
        }

        // Tạo 5 user đăng nhập bằng Google
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => null, // Không cần password
                'provider' => 'google',
                'provider_id' => $faker->unique()->uuid . '_google',
            ]);
        }

        // Tạo 5 user đăng nhập bằng Facebook
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => null, // Không cần password
                'provider' => 'facebook',
                'provider_id' => $faker->unique()->uuid . '_facebook',
            ]);
        }


        //Tao 1 user cho 1 role
        User::create(

            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'provider' => 'local',
                'provider_id' => null,
                'role_id' => 1, // Giả sử role_id 1 là Admin
            ]
            );
        User::create(
            [
                'name' => 'Product Manager',
                'email' => 'bookingManager@gmail.com'
                ,
                'password' => Hash::make('password123'),
                'provider' => 'local',
                'provider_id' => null,
                'role_id' => 2, // Giả sử role_id 2 là Product Manager
            ]
        );
        User::create(
            [
                'name' => 'Statistics Manager',
                'email' => 'statisticManager@gmail.com',
                'password' => Hash::make('password123'),
                'provider' => 'local',
                'provider_id' => null,
                'role_id' => 3, // Giả sử role_id 3 là Statistics Manager
            ]
        );
        User::create(
            [
                'name' => 'Packages Manager',
                'email' => 'packageManager@gmail.com',
                'password' => Hash::make('password123'),
                'provider' => 'local',
                'provider_id' => null,
                'role_id' => 4, // Giả sử role_id 4 là Packages Manager
            ]
        );
        User::create(
            [
                'name' => 'Blogs Manager',
                'email' => 'blogManager@gmail.com'
                ,
                'password' => Hash::make('password123'),
                'provider' => 'local',
                'provider_id' => null,
                'role_id' => 5, // Giả sử role_id 5 là Blogs Manager
            ]
        );
        User::create(
            [
                'name' => 'Contact Manager',
                'email' => 'contactManager@gmail.com'
                ,
                'password' => Hash::make('password123'),
                'provider' => 'local',
                'provider_id' => null,
                'role_id' => 6, // Giả sử role_id 6 là Contact Manager
            ]
        );

    }
}
