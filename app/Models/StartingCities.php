<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;


class StartingCities extends Model
{
    protected $table   = 'starting_cities';
    public $timestamps = false;
    public $appends    = ['image_url'];

	public static function getAll()
	{
		$data = Cache::get('vr-cities');
		if (empty($data)) {
			$data = parent::where('status', 'Active')->select('name', 'image')->get();
			Cache::put('vr-cities', $data, 86400);
		}
		return $data;
	}

    public function getImageUrlAttribute()
    {
        return url('/').'/front/images/starting_cities/'.$this->attributes['image'];
    }
}
