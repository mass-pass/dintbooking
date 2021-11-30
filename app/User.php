<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','total_available_points','total_available_mature_points'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['points_formatted'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pointsLogs(){
        return $this->hasMany('\App\Models\PointsLog', 'user_id');
    }

    public function addOnlyPointsLogs(){
        return $this->hasMany('\App\Models\PointsLog', 'user_id')->addOnly;
    }

    public function totalPoints(){
        return $this->pointsLogs()->where('points_log.mode', '=', 'added')->sum('points') - $this->pointsLogs()->where('points_log.mode', '<>', 'added')->sum('points');
    }

    public function totalMaturedPoints(){
        return $this->pointsLogs()->where('points_log.mode', '=', 'added')->maturedOnly()->sum('points') - $this->pointsLogs()->where('points_log.mode', '<>', 'added')->sum('points');
    }

    public function hasMaturePoints(){
        return $this->totalMaturedPoints() > 0;
    }



}
