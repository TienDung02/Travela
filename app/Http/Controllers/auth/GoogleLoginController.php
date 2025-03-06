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
class GoogleLoginController extends Controller
{
    public function provider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();
        try {
            $user = User::updateOrCreate(
                ['provider_id' => $googleUser->id, 'provider' => 'google'],
                [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'avatar' => $googleUser->avatar,
                ]
            );
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
            Auth::login($user);

            return redirect('/');
        }catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                $existingUser = User::where('email', $googleUser->email)->first();
                if ($existingUser) {
                    $existingUser->update([
                        'provider_id' => $googleUser->id,
                        'provider' => 'google',
                        'name' => $googleUser->name,
                        'avatar' => $googleUser->avatar,
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
