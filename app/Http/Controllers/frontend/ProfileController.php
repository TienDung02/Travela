<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use App\Models\User;

class ProfileController
{
    public function index()
    {
        $user_id = session('user_id');
        $user = User::with('ward')->with('blogs')->with('orders')->with('reviews')->where('id', $user_id)->first();
//        dd($user);
        $ward = $user->ward;
        $district = $ward->district;
        $province = $district->province;
        $address = $ward->name . ', ' . $district->name . ', ' . $province->name;

        $posts = Post::query()->with('user')->with('place')->with('comments')->with('likes')->with('media')->where('user_id', $user_id)->get();

        return view('frontend.profile.index', compact('user', 'address', 'posts'));
    }
    public function like()
    {
        $user_id = session('user_id');
        $user = User::with('ward')->with('blogs')->with('orders')->with('reviews')->where('id', $user_id)->first();
//        dd($user);
        $ward = $user->ward;
        $district = $ward->district;
        $province = $district->province;
        $address = $ward->name . ', ' . $district->name . ', ' . $province->name;

        $posts = Post::query()->with('user')->with('place')->with('comments')->with('likes')->with('media')->where('user_id', $user_id)->get();

        return view('frontend.profile.index', compact('user', 'address', 'posts'));
    }
}
