<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayoutPenalties extends Model
{
    protected $table   = 'payout_penalties';
    public $timestamps = false;

    public function payouts()
    {
        return $this->belongsTo('App\Models\Payouts', 'payout_id', 'id');
    }

    public function penalty()
    {
        return $this->belongsTo('App\Models\Penalty', 'penalty_id', 'id');
    }
}
