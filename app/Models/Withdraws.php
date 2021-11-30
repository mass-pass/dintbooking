<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraws extends Model
{
    protected $table = 'withdraws';

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
    public function accounts()
    {
        return $this->belongsTo('App\Models\Accounts', 'account_id', 'id');
    }
}
