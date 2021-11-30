<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmenityType extends Model
{
    protected $table    = 'amenity_type';
    public $timestamps  = false;

    public function amenities()
    {
        return $this->hasMany('App\Models\Amenities', 'type_id', 'id');
    }

    public function boat_amenities()
    {
        return $this->hasMany('App\Models\Amenities', 'type_id', 'id')->where('category', 'Boat');
    }

    public function property_amenities()
    {
        return $this->hasMany('App\Models\Amenities', 'type_id', 'id')->where('category', 'Property');
    }
}
