<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use App\Models\Properties;
use App\Models\Bookings;
use App\Models\Messages;
use DB;

class checkUserRoutesPermissions
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
        if (Request::segment(1) == 'users' && Request::segment(2) == 'show' && is_numeric(Request::segment(3)) && !empty(Request::segment(3))) {
            $userId     = Request::segment(3);
            if ($userId == auth()->user()->id) {
                return $next($request);
            } else {
                abort(403, 'Access denied');
            }
        } elseif (Request::segment(1) == 'listing' && is_numeric(Request::segment(2)) && !empty(Request::segment(2))) {
            $propertyId = Request::segment(2);
            if (Properties::where(['id' => $propertyId, 'host_id' => auth()->user()->id])->first()) {
                return $next($request);
            } else {
                abort(403, 'Access denied');
            }
        } elseif (Request::segment(1) == 'messaging' && (Request::segment(2) == 'host' || Request::segment(2) == 'guest') && is_numeric(Request::segment(3)) && !empty(Request::segment(3))) {
            $bookingId = Request::segment(3);
            if (Messages::where(['booking_id' => $bookingId, 'receiver_id' => auth()->user()->id])->first()) {
                return $next($request);
            } else {
                abort(403, 'Access denied');
            }
        }
    }
}
