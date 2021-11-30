<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class Currency extends Model
{
    protected $table   = 'currency';
    public $timestamps = false;

    protected $appends = ['org_symbol'];

    public function getSymbolAttribute()
    {
        if (Session::get('symbol')) {
            return Session::get('symbol');
        } else {
            return DB::table('currency')->where('default', 1)->first()->symbol;
        }
    }

    public function getSessionCodeAttribute()
    {
        if (Session::get('currency')) {
            return Session::get('currency');
        } else {
            return DB::table('currency')->where('default', 1)->first()->code;
        }
    }

    public static function code_to_symbol($code)
    {
        $symbol = DB::table('currency')->where('code', $code)->first()->symbol;
        return $symbol;
    }

    public function getOrgSymbolAttribute()
    {
        $symbol = $this->attributes['symbol'];
        return $symbol;
    }
}
