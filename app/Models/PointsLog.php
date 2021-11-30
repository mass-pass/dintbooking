<?php

/**
 * PointsLog Model
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointsLog extends Model
{
    protected $table = 'points_log';

    const FLAG_ADDED = 'added';
    const FLAG_REDEEMED = 'redeemed';

    protected $fillable = [
        'user_id', 'mode', 'pointable_type', 'pointable_id', 'notes', 'points', 'is_matured'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
   
    public function pointable()
    {
        return $this->morphTo();
    }

    public function scopeAddsOnly($q){
        return $q->where('mode', '=', self::FLAG_ADDED);
    }

    public function scopeMaturedOnly($q){
        return $q->where('is_matured', '=', 1);
    }
    public function scopeImmaturedOnly($q){
        return $q->where('is_matured', '<>', 1);
    }

    public function scopeByUser($q, $user_id){
        return $q->where('user_id', '=', $user_id);
    }

    public function scopeRedeemedOnly($q){
        return $q->where('mode', '=', self::FLAG_REDEEMED);
    }

}
