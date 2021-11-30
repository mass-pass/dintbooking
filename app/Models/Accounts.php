<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $table = 'accounts';

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
    public function payment_methods()
    {
        return $this->belongsTo('App\Models\PaymentMethods', 'payment_method_id', 'id');
    }

    public function withdraw()
    {
        return $this->hasMany('App\Models\Withdraws', 'account_id', 'id');
    }
    
    public function getUpdatedAtTimeAttribute()
    {
        return date('d M', strtotime($this->attributes['updated_at'])).' at '.date('H:i', strtotime($this->attributes['updated_at']));
    }

    public function getUpdatedAtDateAttribute()
    {
        return date('d F, Y', strtotime($this->attributes['updated_at']));
    }
}
