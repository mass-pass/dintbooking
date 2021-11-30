<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Roles extends Model
{
    public static function permission_role($id)
    {
        return DB::table('permission_role')->where('role_id', $id)->pluck('permission_id');
    }

    public static function role_admin($id)
    {
        return DB::table('role_admin')->where('admin_id', $id)->first();
    }

}
