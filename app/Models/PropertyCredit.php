<?php

namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCredit extends Model
{
    protected $table = 'property_credit';

    protected $fillable = ['id', 'property_id','credit'];
}
