<?php



namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;

class Admin extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table    = 'admin';

    protected $fillable = ['username', 'email', 'password'];

    protected $hidden   = ['password', 'remember_token'];

    public function getProfileSrcAttribute()
    {
        if ($this->attributes['profile_image'] == '') {
            $src = url('images/user_pic.jpg');
        } else {
            $src = s3UrlAppend('images/profile/'.$this->attributes['id'].'/'.$this->attributes['profile_image']);
        }

        return $src;
    }
}
