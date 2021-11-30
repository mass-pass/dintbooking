<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCategory extends Model
{
    protected $table = 'property_category';

    
    
    public function getUpdatedAtTimeAttribute()
    {
        return date('d M', strtotime($this->attributes['updated_at'])).' at '.date('H:i', strtotime($this->attributes['updated_at']));
    }

    public function getUpdatedAtDateAttribute()
    {
        return date('d F, Y', strtotime($this->attributes['updated_at']));
    }
}
