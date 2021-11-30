<?php
namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HotelPhoto extends Model
{
    protected $table = 'hotel_photos';
    protected $guarded = ['id'];
    use SoftDeletes;

}
