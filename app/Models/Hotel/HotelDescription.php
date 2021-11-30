<?php
namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HotelDescription extends Model
{
    protected $table = 'hotel_descriptions';
    protected $guarded = ['id'];
    use SoftDeletes;

}
