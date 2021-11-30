<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Amenities extends Model
{
    protected $table    = 'amenities';
    public $timestamps  = false;

    public function amenity_type()
    {
        return $this->belongsTo('App\Models\AmenityType', 'type_id', 'id');
    }

    
    public static function normal($property_id)
    {
        $result = DB::select("select amenities.title as title, amenities.id as id, amenities.symbol, properties.id as status from amenities left join properties on find_in_set(amenities.id, properties.amenities) and properties.id = $property_id where type_id = 1");
        return $result;
    }

    public static function security($property_id)
    {
        $result = DB::select("select amenities.title as title, amenities.id as id, amenities.symbol, properties.id as status from amenities left join properties on find_in_set(amenities.id, properties.amenities) and properties.id = $property_id where type_id = 2");
        return $result;
    }
}
