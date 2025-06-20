<?php

namespace App\Http\Controllers\frontend;

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

        return view('frontend.profile.index', compact('user', 'address'));
    }
}
