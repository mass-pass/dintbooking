<?php
namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HotelCategory extends Model
{
    protected $table = 'hotel_categories';
    protected $guarded = ['id'];
    use SoftDeletes;

}
