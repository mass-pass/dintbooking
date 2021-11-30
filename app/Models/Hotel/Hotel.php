<?php
namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Hotel extends Model
{
    protected $table = 'hotels';
    protected $guarded = ['id'];
    use SoftDeletes;

}
