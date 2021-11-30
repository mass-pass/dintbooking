<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorSearch extends Model
{
    protected $table = 'visitor_searches';
    protected $guarded = ['id'];
    protected $dates = ['created_at','updated_at'];
}
