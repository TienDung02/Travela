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

    public function callback()
    {
        $facebookUser = Socialite::driver('facebook')->user();
        try {
            $user = User::updateOrCreate(
                ['provider_id' => $facebookUser->id, 'provider' => 'facebook'],
                [
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'avatar' => $facebookUser->avatar,
                ]
            );
            Auth::login($user);
            Session::put('user_data', [
                'id' => $user->id,
                'avatar' => $user->avatar ?? '',
                'name' => $user->name ?? '',
                'email' => $user->email ?? '',
            ]);
            Session::put('alert_', [
                'alert__type' => 'success',
                'alert__title' => 'Login success',
                'alert__text' => '',
                'alert_reload' => 'false',
            ]);
            return redirect('/');
        } catch (\Exception $e) {
            if ($e->errorInfo[1] == 1062) {
                $existingUser = User::where('email', $facebookUser->email)->first();
                if ($existingUser) {
                    $existingUser->update([
                        'provider_id' => $facebookUser->id,
                        'provider' => 'google',
                        'name' => $facebookUser->name,
                        'avatar' => $facebookUser->avatar,
                        'updated_at' => now(),
                    ]);
                    $user = $existingUser;
                }
                Auth::login($user);
                Session::put('user_data', [
                    'id' => $user->id,
                    'avatar' => $user->avatar ?? '',
                    'name' => $user->name ?? '',
                    'email' => $user->email ?? '',
                ]);
                Session::put('alert_', [
                    'alert__type' => 'success',
                    'alert__title' => 'Login success',
                    'alert__text' => '',
                    'alert_reload' => 'false',
                ]);
                return redirect('/');
            } else {
                throw $e;
            }
        }
    }
}
