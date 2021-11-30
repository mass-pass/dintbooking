<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = 'reviews';

    
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'sender_id', 'id');
    }

   
    public function users_from()
    {
        return $this->belongsTo('App\Models\User', 'receiver_id', 'id');
    }

    public function properties()
    {
        return $this->belongsTo('App\Models\Properties', 'property_id', 'id');
    }

    public function bookings()
    {
        return $this->belongsTo('App\Models\Bookings', 'booking_id', 'id');
    }

    public function getDateFyAttribute()
    {
        return date('F Y', strtotime($this->attributes['updated_at']));
    }

    
    public function getHiddenReviewAttribute()
    {
        $booking_id = $this->attributes['booking_id'];
        $sender_id = $this->attributes['sender_id'];
        $receiver_id = $this->attributes['receiver_id'];
        $check = Reviews::where(['sender_id'=>$receiver_id, 'receiver_id'=>$sender_id, 'booking_id'=>$booking_id])->get();
        if ($check->count()) {
            return false;
        } else {
            return true;
        }
    }
}
