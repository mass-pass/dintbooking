<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerAmenities extends Model
{
    protected $table   = 'partner_amenities';
    protected $fillable = ['name', 'value', 'user_id'];
    public $timestamps = true;
}
