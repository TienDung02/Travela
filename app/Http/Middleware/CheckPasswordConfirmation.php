<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPasswordConfirmation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
//    public function handle(Request $request, Closure $next)
//    {
//        if ($request->password !== $request->password_confirmation) {
//            echo '234';die;
//
//            return redirect()->back()->withErrors(['confirm_password' => 'Confirm password does not match']);
//        }
//
//        return $next($request);
//    }
}
