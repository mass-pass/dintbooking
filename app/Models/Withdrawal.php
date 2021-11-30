<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{

  protected $table   = 'withdrawals';

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'user_id', 'id');
  }

  public function currency()
  {
    return $this->belongsTo('App\Models\Currency', 'currency_id', 'id');
  }

  public function payment_methods()
  {
    return $this->belongsTo('App\Models\PaymentMethods', 'payment_method_id', 'id');
  }

  public function payout_settings()
  {
    return $this->belongsTo('App\Models\PayoutSetting', 'payout_id', 'id');
  }
}

