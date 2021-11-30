<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Session;




class Wallet extends Model

{

    protected $table    = 'wallets';

    protected $fillable = ['user_id', 'currency_id'];

    public function user()

    {

        return $this->belongsTo('App\Models\User', 'user_id', 'id');

    }

    public function currency()

    {

      return $this->belongsTo('App\Models\Currency', 'currency_id', 'id');

    }

    public function currency_adjust($field)
    {   
        $default_currency = Currency::where('default', 1)->first()->code;
        
        $rate = Currency::whereCode(($this->currency->currency_code) ? ($this->currency->currency_code) :$default_currency)->first()->rate;

        $base_amount = $this->attributes[$field] / $rate;

        $session_rate = Currency::whereCode((Session::get('currency')) ? Session::get('currency') : $default_currency)->first()->rate;

        return round($base_amount * $session_rate);
    }

    public function getTotalAttribute()
    {
        return $this->currency_adjust('balance');
    }


}

