<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayoutSetting extends Model
{
	protected $table   = 'payout_settings';

    public function withdrawls()
    {
    	return $this->hasMany('App\Models\Withdrawal', 'id', 'payout_id');
    }

    public function payment_methods(){

    	return $this->belongsTo('App\Models\PaymentMethods', 'type', 'id');

    }

}

