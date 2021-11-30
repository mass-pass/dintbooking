<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bookings;
use Auth;

class BookingNotes extends Model
{
    protected $table = 'booking_notes';

    protected $appends = ['created_time','host_user','guest_user'];

    
    public function bookings()
    {
        return $this->belongsTo('App\Models\Bookings', 'booking_id', 'id');
    }

    

    public function sender()
    {
        return $this->hasOne('App\Models\User', 'id', 'sender_id');
    }

   

    public function getCreatedTimeAttribute()
    {
        if (date('d-m-Y') == date('d-m-Y', strtotime($this->attributes['created_at']))) {
            return date('h:i A', strtotime($this->attributes['created_at']));
        } else {
            return date('d/m/Y', strtotime($this->attributes['created_at']));
        }
    }

   

   

    
}
