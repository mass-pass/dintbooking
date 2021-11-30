<?php


namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Helpers\Common;
use App\Models\UserDetails;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'profile_images'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['profile_src'];
    protected $casts = [
        'profile_images' => 'array',
    ];

    public function users_verification()
    {
        return $this->hasOne('App\Models\UsersVerification', 'user_id', 'id');
    }

    public function payouts()
    {
        return $this->hasMany('App\Models\Payouts', 'user_id', 'id');
    }

    public function accounts()
    {
        return $this->hasMany('App\Models\Account', 'user_id', 'id');
    }

    private function pointsLogger()
    {
    }

    public function bookings()
    {
        return $this->hasMany('App\Models\Bookings', 'user_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'user_id', 'id');
    }

    public function reports()
    {
        return $this->hasMany('App\Models\Report', 'user_id', 'id');
    }


    public function user_details()
    {
        return $this->hasMany('App\Models\UserDetail', 'user_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment', 'user_id', 'id');
    }

    public function withdraw()
    {
        return $this->hasMany('App\Models\Withdraw', 'user_id', 'id');
    }

    public function properties()
    {
        return $this->hasMany('App\Models\Properties', 'host_id', 'id');
    }

    public function boats()
    {
        return $this->hasMany(Boat::class, 'owner_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Reviews', 'sender_id', 'id');
    }

    public function getProfileSrcAttribute()
    {
        if ($this->attributes['profile_image'] == '') {
            $src = url('images/default-profile.png');
        } else {
            $src = s3UrlAppend('images/profile/' . $this->attributes['id'] . '/' . $this->attributes['profile_image']);
        }

        return $src;
    }

    public function details_key_value()
    {
        $details = UserDetails::where('user_id', $this->attributes['id'])->pluck('value', 'field');
        return $details;
    }

    public function getAccountSinceAttribute()
    {
        $since = date('F Y', strtotime($this->attributes['created_at']));
        return $since;
    }

    public function getFullNameAttribute()
    {
        $full_name = ucfirst($this->attributes['first_name']) . ' ' . ucfirst($this->attributes['last_name']);
        return $full_name;
    }

    public function pointsLogs()
    {
        return $this->hasMany('\App\Models\PointsLog', 'user_id');
    }

    public function addOnlyPointsLogs()
    {
        return $this->hasMany('\App\Models\PointsLog', 'user_id')->addOnly;
    }

    public function totalPoints()
    {
        return $this->pointsLogs()->where('points_log.mode', '=', 'added')->sum('points') - $this->pointsLogs()->where('points_log.mode', '<>', 'added')->sum('points');
    }

    public function totalMaturedPoints()
    {
        return $this->pointsLogs()->where('points_log.mode', '=', 'added')->maturedOnly()->sum('points') - $this->pointsLogs()->where('points_log.mode', '<>', 'added')->sum('points');
    }

    public function hasMaturePoints()
    {
        return $this->totalMaturedPoints() > 0;
    }

    public function addImage($image)
    {
        if (!is_array($this->profile_images)) {
            $profile_images = [];
        } else {
            $profile_images = $this->profile_images;
        }

        $profile_images[] = $image;
        $this->profile_images = $profile_images;
    }

    public function removeImage($image)
    {
        if (!is_array($this->profile_images)) {
            return;
        }

        if (count($this->profile_images) == 0) {
            return;
        }

        $profile_images = $this->profile_images;


        $index = array_search($image, $profile_images);
        if ($index >= 0) {
            unset($profile_images[$index]);
        }

        $this->profile_images = $profile_images;
    }

    public function setProfileImageFromOldImages()
    {
        if (!is_array($this->profile_images)) {
            return;
        }

        if (count($this->profile_images) == 0) {
            return;
        }

        $profile_images = $this->profile_images;
        $this->profile_image = end($profile_images);
    }

    public function hasProperties()
    {
        return $this->properties()->count() > 0;
    }

    public function hasBoats()
    {
        return $this->boats()->count() > 0;
    }

    public function isGuest()
    {
        return $this->user_type_id == UserType::GENERAL;
    }

    public function isHost()
    {
        return $this->user_type_id == UserType::HOST ||
            $this->hasProperties() ||
            $this->hasBoats();
    }
}
