<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckPartnerUser
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
        if (!Auth::check()) {
            return \Redirect::guest('login');
        }
        if (Auth::user()->user_type_id == 1) {   
           return redirect()->intended('dashboard');
        } 
        return $next($request);
    }
}
