<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Tạo Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Tạo 10 User giả
        User::factory(10)->create();
    }
}

