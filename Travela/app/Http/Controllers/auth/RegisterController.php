<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register.index');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            print_r($request->all());
            dd($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return redirect()->back()->withErrors(['email' => 'This email is already registered.'])->withInput();
        }

        // Nếu chưa tồn tại, thêm user mới vào database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user->save()) {
            Session::put('alert_', [
                'email' => $user->email,
                'alert_title' => 'Account created successfully.',
                'alert_text' => 'Please check your email to get your password and activate your account.',
                'alert_type' => 'success',
                'alert_reload' => 'false',
            ]);
        } else {
            session()->flash('error', 'There was an error adding a industry!');
        }

        auth()->login($user);

        return redirect()->route('home.index');
    }


}
