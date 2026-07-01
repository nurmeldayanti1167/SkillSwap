<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->role === 'admin') {
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }
}
