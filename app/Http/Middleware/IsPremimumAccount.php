<?php

namespace App\Http\Middleware;

use Closure;

class IsPremimumAccount
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
        if ($request->user()->account_type)
            return $next($request);
        else
            abort(403);
    }
}