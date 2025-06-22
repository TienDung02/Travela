<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;

class ProfileController
{
    public function index()
    {
        $user = auth()->user();

<<<<<<< Updated upstream
        return view('frontend.profile.index', compact('user', 'address'));
    }
=======
        // Tránh lỗi nếu user chưa có ward
        if (!$user || !$user->ward || !$user->ward->district || !$user->ward->district->province) {
            abort(404, 'Incomplete address info.');
        }
        $posts = $user->posts()->with(['media', 'likes', 'comments'])->latest()->get();
        $address = $user->ward->name . ', ' . $user->ward->district->name . ', ' . $user->ward->district->province->name;

        $posts = \App\Models\Post::where('user_id', $user->id)
                ->with(['user', 'media', 'likes', 'comments'])
                ->latest()
                ->get();

            return view('frontend.profile.index', [
                'user' => $user,
                'address' => $address,
                'posts' => $posts,
            ]);
    }

public function like()
{
    return $this->index(); // Reuse index logic
}
>>>>>>> Stashed changes
}
