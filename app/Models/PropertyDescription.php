<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyDescription extends Model
{
    protected $table   = 'property_description';
    public $timestamps = false;

    public function properties()
    {
        return $this->belongsTo('App\Models\Properties', 'property_id', 'id');
    }
}
