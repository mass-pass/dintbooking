<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyPhotos extends Model
{
    protected $table   = 'property_photos';
    public $timestamps = false;

    public function properties()
    {
        return $this->belongsTo('App\Models\Properties', 'property_id', 'id');
    }
}
