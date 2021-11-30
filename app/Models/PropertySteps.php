<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertySteps extends Model
{
    protected $table   = 'property_steps';
    public $timestamps = false;

    public function property()
    {
        return $this->belongsTo('App\Models\Properties', 'property_id', 'id');
    }
}
