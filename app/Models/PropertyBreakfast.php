<?php

namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyBreakfast extends Model
{
    protected $table = 'property_breakfast';

    protected $fillable = ['id', 'property_id','breakfast'];
}
