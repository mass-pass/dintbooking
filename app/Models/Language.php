<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table   = 'language';
    public $timestamps = false;
    
    public function email_templates()
    {
        return $this->hasMany('App\Models\EmailTemplate', 'lang_id');
    }

    public static function name($name)
    {
        $name =  Language::where('short_name', $name)->first()->name;
        return $name;
    }
}
