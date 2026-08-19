<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class PreventAbuse
{
    public function handle(Request $request, Closure $next)
    {
        $key = 'public:'.($request->ip() ?? 'unknown');

        if (RateLimiter::tooManyAttempts($key, 60)) {
            abort(429, 'Terlalu banyak permintaan. Silakan coba lagi dalam beberapa saat.');
        }

        RateLimiter::hit($key, 60);

        return $next($request);
    }
}
