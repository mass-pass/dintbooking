<?php

namespace App;
namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PropertyTimings extends Model
{
    protected $table = 'property_timings';

    protected $fillable = ['id', 'property_id','check_in','checkout'];
}
