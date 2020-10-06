<?php

namespace App\Http\Middleware;

use Closure;

class LocalizationMiddleware
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

        //put language in session
        //then check on it and put in app()->locale
        //check if request has another language put it in session
//        $lang=$request->lang;
//        if(!is_null($lang)){
//
//            \Session::put('locale',$lang);
//            \App::setLocale($lang);
//        }else
//        $lang='ar';
        if (!\Session::has('locale'))
        {
            \Session::put('locale','ar');
        }
        \App::setLocale(session('locale'));

        return $next($request);
    }
}
