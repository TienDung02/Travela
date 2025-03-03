<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
class FacebookLoginController extends Controller
{
    public function provider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackHandle()
    {

        $user = Socialite::driver('facebook')->user();
        dd($user);

//        $data = User::where('email', $user->email)->first();
//        if (is_null($data)){
//            $user['name'] = $user->name;
//            $user['email'] = $user->email;
//            $data = $user::create($user);
//        }
//        Auth::login($user);
//
//        return redirect()->intended('dashboard');
    }


}
