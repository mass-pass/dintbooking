<?php
namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HotelLayout extends Model
{
    protected $table = 'hotel_layouts';
    protected $guarded = ['id'];
    use SoftDeletes;

}
