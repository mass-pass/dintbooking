<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penalty;
use App\Models\PayoutPenalties;
use App\Models\Currency;
use DB;
use Session;

class Payouts extends Model
{
    protected $table = 'payouts';

    public $appends = ['currency_symbol', 'date'];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
     public function currency()
    {
        return $this->belongsTo('App\Models\Currency', 'currency_code', 'code');
    }

    public function getTotalPenaltyAmountAttribute()
    {
        $penalty = 0;

        $penalty_list = PayoutPenalties::where('payout_id', $this->attributes['id'])->pluck('penalty_id');
        $penalty = Penalty::whereIn('id', $penalty_list)->sum('amount');

        if ($penalty != 0) {
            $rate = Currency::where('code', $this->attributes['currency_code'])->first()->rate;

            $base_amount = $penalty / $rate;

            $default_currency = Currency::where('default_currency', 1)->first()->code;

            $now_rate = Currency::whereCode((Session::get('currency')) ? Session::get('currency') : $default_currency)->first()->rate;

            return round($base_amount * $now_rate);
        } else {
            return 0;
        }
    }

    public function getDateAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['updated_at']));
    }

    public function getCurrencySymbolAttribute()
    {
        $default_currency = Currency::where('default', 1)->first()->code;
        $default_code = (Session::get('currency')) ? Session::get('currency') : $default_currency;

        return Currency::where('code', $default_code)->first()->symbol;
    }

    public function getOriginalAmountAttribute()
    {
        return $this->attributes['amount'];
    }

    public function getAmountAttribute()
    {
        return $this->currency_adjust('amount');
    }

    public function getPanaltyAmountAttribute()
    {
        return $this->currency_adjust('penalty_amount');
    }

    public function currency_adjust($field)
    {
        $rate = Currency::whereCode($this->attributes['currency_code'])->first()->rate;

        $base_amount = $this->attributes[$field] / $rate;

        $default_currency = Currency::where('default', 1)->first()->code;

        $session_rate = Currency::whereCode((Session::get('currency')) ? Session::get('currency') : $default_currency)->first()->rate;

        return round($base_amount * $session_rate);
    }
}
