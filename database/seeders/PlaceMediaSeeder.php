<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\PlaceMedia;

class PlaceMediaSeeder extends Seeder
{
    public function run()
    {
        PlaceMedia::insert([
            [
                'place_id' => 1,
                'media' => 'https://cdn-imgix.headout.com/tour/30357/TOUR-IMAGE/6cdcf542-452d-4897-beed-76cf68f154e4-1act-de005e04-05d9-4715-96b0-6a089d5c3460.jpg?auto=format&w=1222.3999999999999&h=687.6&q=90&fit=crop&ar=16%3A9&crop=faces',
                'media_type' => 'image',
                'is_primary' => true,
            ],
            [
                'place_id' => 1,
                'media' => 'https://blogs.loc.gov/copyright/files/2020/07/CH-Statue-of-Liberty-Blog.jpg',
                'media_type' => 'image',
                'is_primary' => false,
            ],
            [
                'place_id' => 1,
                'media' => 'https://cdn.pixabay.com/video/2015/12/04/1536-148219668_medium.mp4',
                'media_type' => 'video',
                'is_primary' => false,
            ],
            [
                'place_id' => 1,
                'media' => 'https://cdn-imgix.headout.com/tour/30357/TOUR-IMAGE/6cdcf542-452d-4897-beed-76cf68f154e4-1act-de005e04-05d9-4715-96b0-6a089d5c3460.jpg?auto=format&w=1222.3999999999999&h=687.6&q=90&fit=crop&ar=16%3A9&crop=faces',
                'media_type' => 'image',
                'is_primary' => false,
            ],
            [
                'place_id' => 1,
                'media' => 'https://blogs.loc.gov/copyright/files/2020/07/CH-Statue-of-Liberty-Blog.jpg',
                'media_type' => 'image',
                'is_primary' => false,
            ],
            [
                'place_id' => 1,
                'media' => 'https://cdn.pixabay.com/video/2015/12/04/1536-148219668_medium.mp4',
                'media_type' => 'video',
                'is_primary' => false,
            ],
            [
                'place_id' => 1,
                'media' => 'https://blogs.loc.gov/copyright/files/2020/07/CH-Statue-of-Liberty-Blog.jpg',
                'media_type' => 'image',
                'is_primary' => false,
            ],
            [
                'place_id' => 1,
                'media' => 'https://blogs.loc.gov/copyright/files/2020/07/CH-Statue-of-Liberty-Blog.jpg',
                'media_type' => 'image',
                'is_primary' => false,
            ],
            [
                'place_id' => 1,
                'media' => 'https://blogs.loc.gov/copyright/files/2020/07/CH-Statue-of-Liberty-Blog.jpg',
                'media_type' => 'image',
                'is_primary' => false,
            ],
        ]);
    }
}