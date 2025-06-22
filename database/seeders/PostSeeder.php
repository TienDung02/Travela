<?php
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstWhere('email', 'blogManager@gmail.com');

        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Blogs Manager',
                'email' => 'blogManager@gmail.com',
                'password' => bcrypt('password'), // hoặc mật khẩu tùy ý
            ]);
        }

        Post::factory()->count(10)->create([
            'user_id' => $user->id,
        ]);
    }
}