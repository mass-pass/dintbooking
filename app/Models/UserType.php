<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    const GENERAL = 1;
    const HOST = 2;

    protected $table    = 'user_types';
    public $timestamps  = false;
}
