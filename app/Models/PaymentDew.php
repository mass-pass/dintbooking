<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentDew extends Model
{
    protected $table = 'payouts';

    public function bookings()
    {
        return $this->belongsTo('App\Models\Bookings', 'booking_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function payout_penalties()
    {
        return $this->hasMany('App\Models\PayoutPenalties', 'payout_id', 'id');
    }
}
