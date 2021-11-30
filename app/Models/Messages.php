<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bookings;
use Auth;

class Messages extends Model
{
    protected $table = 'messages';
    protected $guarded = ['id'];

    protected $appends = ['created_time','host_user','guest_user'];

    public function message_type()
    {
        return $this->belongsTo('App\Models\MessageType', 'type_id', 'id');
    }

    public function bookings()
    {
        return $this->belongsTo('App\Models\Bookings', 'booking_id', 'id');
    }

    public function properties()
    {
        return $this->belongsTo('App\Models\Properties', 'property_id', 'id');
    }

    public function sender()
    {
        return $this->hasOne('App\Models\User', 'id', 'sender_id');
    }

    public function receiver()
    {
        return $this->hasOne('App\Models\User', 'id', 'receiver_id');
    }

    public function getCreatedTimeAttribute()
    {
        if (date('d-m-Y') == date('d-m-Y', strtotime($this->attributes['created_at']))) {
            return date('h:i A', strtotime($this->attributes['created_at']));
        } else {
            return date('d/m/Y', strtotime($this->attributes['created_at']));
        }
    }

    public function getHostUserAttribute()
    {
        $bookings =  Bookings::where('property_id', $this->attributes['property_id'])->where('host_id', !empty(Auth::guard('admin')->user()->id) ? Auth::guard('admin')->user()->id : Auth::user()->id)->get();

        if (count($bookings) != 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getGuestUserAttribute()
    {
        $bookings =  Bookings::where('property_id', $this->attributes['property_id'])->where('host_id', !empty(Auth::guard('admin')->user()->id) ? Auth::guard('admin')->user()->id : Auth::user()->id)->get();

        if (count($bookings) == 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function property_address()
    {
        return $this->belongsTo('App\Models\PropertyAddress', 'property_id', 'property_id');
    }
}
