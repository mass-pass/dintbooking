<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    
    
    public function language()
    {
        return $this->belongsTo('App\Models\Language', 'lang_id');
    }
}
