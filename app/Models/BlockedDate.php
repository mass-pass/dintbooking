<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockedDate extends Model
{
    protected $table    = 'blocked_dates';
    protected $fillable = ['blockable_type', 'blockable_id', 'date', 'notes'];

    public function blockable(){
        return $this->morphTo();
    }
}