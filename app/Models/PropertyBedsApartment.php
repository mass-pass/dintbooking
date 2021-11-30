<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyBedsApartment extends Model
{
    protected $table   = 'property_beds_apartment';
    protected $fillable = ['property_id', 'single_bedroom', 'double_bedroom', 'large_bedroom', 'extra_large_bedroom', 'bunk_bedroom_div', 'sofa_bedroom_div', 'futon_bedroom_div', 'from_user'];
    public $timestamps = false;

    public function properties()
    {
        return $this->belongsTo('App\Models\Properties', 'property_id', 'id');
    }
}
