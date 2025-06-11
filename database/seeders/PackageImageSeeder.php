<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;
class PackageImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = Package::all();

        foreach ($packages as $package) {
            $randomIndex = rand(1,24);
            $imageName = 'packages-' . $randomIndex . '.jpg';
            
            $package->main_image = $imageName;
            $package->save();
        }
    }
}