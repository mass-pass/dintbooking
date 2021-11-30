<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetails extends Model
{
    protected $table    = 'booking_details';
    public $timestamps  = false;

    public function bookings()
    {
        return $this->belongsTo('App\Models\Bookings', 'booking_id', 'id');
    }
}
