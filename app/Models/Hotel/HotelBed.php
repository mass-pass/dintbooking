<?php
namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HotelBed extends Model
{
    protected $table = 'hotel_beds';
    protected $guarded = ['id'];
    use SoftDeletes;

}
