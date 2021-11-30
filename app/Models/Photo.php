<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table   = 'photos';

    protected $appends = ['url'];

    public function photoable(){
        return $this->morphTo();
    }

    public function getUrlAttribute(){
        return s3UrlAppend($this->photo);
    }

}
