<?php
namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HotelAddress extends Model
{
    protected $table = 'hotel_addresses';
    protected $guarded = ['id'];
    use SoftDeletes;

}
