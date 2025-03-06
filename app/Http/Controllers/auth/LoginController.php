<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    public function index()
    {

        return view('auth.login.index');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
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

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
