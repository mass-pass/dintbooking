<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyRules extends Model
{
    protected $table   = 'property_rules';
    public $timestamps = false;

    public function properties()
    {
        return $this->belongsTo('App\Models\Properties', 'property_id', 'id');
    }
}
