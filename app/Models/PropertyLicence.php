<?php

namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyLicence extends Model
{
    protected $table = 'property_licence';

    protected $fillable = ['id', 'property_id','licence_number'];
}
