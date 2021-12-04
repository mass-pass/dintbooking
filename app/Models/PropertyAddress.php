<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class PropertyAddress extends Model
{
    protected $table   = 'property_address';
    protected $guarded = ['id'];
    public $timestamps = false;

    // public function properties()
    // {
    //     return $this->belongsTo('App\Models\Properties', 'property_id', 'id');
    // }

    public function countries()
    {
        return $this->belongsTo('App\Models\Country', 'country', 'short_name');
    }

    public function getCountryNameAttribute()
    {
        $result = Country::where('short_name', $this->attributes['id'])->first();
        $name = '';
        if (isset($result->name)) {
            $name = $result->name;
        }
        return $name;
    }
}
