<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class CustomRateLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $executed = RateLimiter::attempt(
            'education'.$request->ip(),
            12
            ,
            function() { }
        );

        if (!$executed) {
            return response(
                [
                    'message' => 'Too many attempts.. try again in '.RateLimiter::availableIn('education'.$request->ip()).' seconds'
                ], 429);
        }
        return $next($request);
    }
}
