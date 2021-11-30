<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;


class Country extends Model
{
    protected $table   = 'country';
    public $timestamps = false;

    public static function getAll()
    {
        $data = Cache::get('vr-countries');
        if (empty($data)) {
            $data = parent::all();
            Cache::put('vr-countries', $data, 86400);
        }
        return $data;
    }

    public function property_address()
    {
        return $this->hasMany('App\Models\Address', 'country', 'short_name');
    }
}
