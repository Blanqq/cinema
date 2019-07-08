<?php

namespace App\Http\Middleware;

use Closure;

class IsEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            if(!auth()->check())
            {
                return response()->view('errors.401', [], 401);
            }
            if (auth()->user()->isEmployee())
            {
                return $next($request);
            }
            return response()->view('errors.403', [], 403);
    }
}
