<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $table    = 'user_details';
    protected $fillable = ['user_id', 'field', 'value'];
    public $timestamps  = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function fields()
    {
        return UserDetail::whereStatus('Active')->get();
    }
}
