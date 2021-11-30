<?php

namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCount extends Model
{
    protected $table = 'property_count';

    protected $fillable = ['id','host_id','apartment','location,count'];
}
