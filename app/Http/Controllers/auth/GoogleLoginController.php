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

        // Kiểm tra xem user đã tồn tại theo email chưa
        $existingUser = User::where('email', $googleUser->email)->first();

        if ($existingUser) {
            // Nếu đã có user, cập nhật thông tin
            $existingUser->provider_id = $googleUser->id;
            $existingUser->provider = 'google';
            $existingUser->name = $googleUser->name;
            $existingUser->updated_at = now();
            $existingUser->save(); // Gọi save() để chắc chắn dữ liệu được cập nhật
            $user = $existingUser;
        } else {
            // Nếu chưa có, tạo user mới
            $user = new User();
            $user->provider_id = $googleUser->id;
            $user->provider = 'google';
            $user->name = $googleUser->name;
            $user->email = $googleUser->email;
            $user->password = bcrypt(Str::random(16)); // Mật khẩu ngẫu nhiên
            $user->created_at = now();
            $user->updated_at = now();
            $user->save(); // Gọi save() để chắc chắn dữ liệu được lưu
        }

        // Đăng nhập và lưu session
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
