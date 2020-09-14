<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // dd($guard);
        $redirectTo = '';
        if ($guard == 'clients')
            $redirectTo = '/';
        else
        if ($guard == 'owners')
            $redirectTo = '/company-panel';
        else if ($guard == 'web')
            $redirectTo = '/dashboard';
        if (Auth::guard($guard)->check()) {
            return redirect($redirectTo);
        }

        return $next($request);
    }
}