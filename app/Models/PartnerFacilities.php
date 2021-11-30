<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerFacilities extends Model
{
    protected $table   = 'partner_facilities';
    protected $fillable = ['name', 'value', 'user_id'];
    public $timestamps = true;
}
