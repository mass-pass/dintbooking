<?php
namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HotelPrice extends Model
{
    protected $table = 'hotel_prices';
    protected $guarded = ['id'];
    use SoftDeletes;

}
