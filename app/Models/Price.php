<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table   = 'prices';

    public function property_layout()
    {
        return $this->belongsTo('App\Models\PropertyLayout', 'property_layout_id', 'id');
    }

    public function priceable(){
        return $this->morphTo();
    }

    public function scopeByCategory($q, $category){
        return $q->where('category', '=', $category);
    }

}
