<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyDates extends Model
{
    protected $table    = 'property_dates';
    protected $fillable = ['property_id', 'status', 'date', 'price','color','type'];

    public function properties()
    {
        return $this->belongsTo('App\Models\Properties', 'property_id', 'id');
    }
}
