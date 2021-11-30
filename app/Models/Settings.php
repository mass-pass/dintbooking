<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Settings extends Model
{
    protected $table    = 'settings';
    public $timestamps  = false;

    protected $fillable = ['value'];

    public static function getAll()
    {
        $data = Cache::get('settings');
        if (empty($data)) {
            $data = parent::all();
            Cache::put('settings', $data, 1440);
        }
        return $data;
    }
}
