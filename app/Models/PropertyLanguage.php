<?php

namespace App;
namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PropertyLanguage extends Model
{
    protected $table = 'property_lang';

    protected $fillable = ['id', 'property_id','language'];
}
