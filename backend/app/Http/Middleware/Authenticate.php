<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route("login");
        }
    }
    // Override handle method
    public function handle($request, Closure $next, ...$guards)
    {
        $auth = auth()->user();
        
        if ($auth && in_array($auth->role, $guards)) {
            return $next($request);
        }
        return response()->json(['error'=>'Unauthorized'],401);
    }
}
