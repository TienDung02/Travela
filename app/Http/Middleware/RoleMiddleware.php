<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Usage in routes:
     * Route::middleware([RoleMiddleware::class . ':Admin'])->group(...);
     * Route::middleware([RoleMiddleware::class . ':Admin,Product manager'])->group(...);
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        // Support comma-separated roles in a single argument
        if (count($roles) === 1 && str_contains($roles[0], ',')) {
            $roles = array_map('trim', explode(',', $roles[0]));
        }
        if (!$user || !in_array($user->role->name ?? null, $roles)) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
