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

        // Kiểm tra user có tồn tại theo email chưa
        $existingUser = User::where('email', $facebookUser->email)->first();

        if ($existingUser) {
            // Nếu user đã tồn tại, cập nhật thông tin
            $existingUser->provider_id = $facebookUser->id;
            $existingUser->provider = 'facebook';
            $existingUser->name = $facebookUser->name;
            $existingUser->updated_at = now();
            $existingUser->save(); // Gọi save() để chắc chắn cập nhật dữ liệu
            $user = $existingUser;
        } else {
            // Nếu user chưa tồn tại, tạo mới
            $user = new User();
            $user->provider_id = $facebookUser->id;
            $user->provider = 'facebook';
            $user->name = $facebookUser->name;
            $user->email = $facebookUser->email;
            $user->password = bcrypt(Str::random(16)); // Mật khẩu ngẫu nhiên
            $user->created_at = now();
            $user->updated_at = now();
            $user->save(); // Gọi save() để chắc chắn dữ liệu được lưu
        }

        // Đăng nhập & lưu session
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
    }

}
