<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    protected $table = 'penalty';

    public function bookings()
    {
        return $this->belongsTo('App\Models\Bookings', 'booking_id', 'id');
    }

    public function payout_penalties()
    {
        return $this->hasMany('App\Models\PayoutPenalties', 'penalty_id', 'id');
    }
}
