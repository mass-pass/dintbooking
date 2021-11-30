<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyDetails extends Model
{
    protected $table    = 'property_details';
    public $timestamps  = false;
    protected $fillable = ['property_id', 'field', 'value'];

    public function properties()
    {
        return $this->belongsTo('App\Models\Properties', 'property_id', 'id');
    }
}
