<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Session;
use App;
use Illuminate\Support\Facades\Auth;

class Locale
{
    public function handle($request, Closure $next)
    {
        if (Session::get('language')) {
            App::setLocale(Session::get('language'));
        } else {
            App::setLocale('en');
        }

        /*if(Auth::guard('admin')->check())
            return redirect('admin/dashboard');*/
        
        return $next($request);
    }
}
