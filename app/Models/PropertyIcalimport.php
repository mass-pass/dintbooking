<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyIcalimport extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table   = 'property_icalimports';

    public $timestamps = false;

   
    protected $fillable = ['property_id', 'icalendar_url', 'icalendar_name', 'icalendar_last_sync'];
}
