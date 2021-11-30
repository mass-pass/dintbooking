<?php
namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HotelDetail extends Model
{
    protected $table = 'hotel_details';
    protected $guarded = ['id'];
    use SoftDeletes;

}
