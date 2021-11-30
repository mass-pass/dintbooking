<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $table   = 'property_type';
    public $timestamps = false;

    public function properties()
    {
        return $this->hasMany('App\Models\Properties', 'property_type', 'id');
    }
}
