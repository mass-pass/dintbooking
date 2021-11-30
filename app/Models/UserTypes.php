<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $table    = 'user_types';
    protected $fillable = ['user_type_name'];
    public $timestamps  = false;
}
