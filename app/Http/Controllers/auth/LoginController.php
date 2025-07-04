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

    public function backendindex(){
        return view('backend.login.index');
    }
    public function index()
    {
        return view('auth.login.index');
    }
    public function privacy()
    {
        return view('auth.login.privacy');
    }
    public function terms()
    {
        return view('auth.login.terms');
    }
    public function backendLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
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
            return redirect('/management');
        } else {
            // On failed login, redirect back with error
            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('alert_login_fail', [
                    'alert__text' => 'Username or password incorrect'
                ]);
        }
    }
// ...existing code...
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            session()->put('user_id', $user->id);
            Session::put('user_data', [
                'id' => $user->id,
                'avatar' => $user->avatar ?? '',
                'name' => $user->name ?? '',
                'email' => $user->email ?? '',
            ]);
            Session::put('alert_2', [
                'alert_type' => 'success',
                'alert_title' => 'Login success',
                'alert_text' => '',
                'alert_reload' => 'false',
            ]);
            return redirect('/');
        }else{
            Session::put('alert_', [
                'alert__type' => 'error',
                'alert__title' => 'Incorrect email or password',
                'alert__text' => '',
                'alert__reload' => 'true',
            ]);
            return redirect()->back();
        }

    }

    public function logout(Request $request) {
//        dd($request->all());
        Auth::logout();
        Session::put('alert_2', [
            'alert_type' => 'success',
            'alert_title' => 'Login success',
            'alert_text' => '',
            'alert_reload' => 'false',
        ]);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');

    }

}
