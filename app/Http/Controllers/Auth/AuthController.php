<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    use ThrottlesLogins;
    protected $redirectTo = '/';

    
    public function __construct()
    {
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        DB::table('users')->truncate();
        
        $user = new User;
        $user->name     = $data['name'];
        $user->email    = $data['email'];
        $user->type     = 'Admin';
        $user->status   = 'Inactive';
        $user->password = bcrypt($data['password']);
        $user->save();

        DB::table('role_admin')->truncate();

        DB::table('role_admin')->insert([
            ['admin_id' => 1, 'role_id' => '1']
        ]);

        DB::table('permission_role')->truncate();

        DB::table('permission_role')->insert([
            ['permission_id' => 1, 'role_id' => '1'],
            ['permission_id' => 2, 'role_id' => '1'],
            ['permission_id' => 3, 'role_id' => '1'],
            ['permission_id' => 4, 'role_id' => '1'],
            ['permission_id' => 5, 'role_id' => '1'],
            ['permission_id' => 6, 'role_id' => '1'],
            ['permission_id' => 7, 'role_id' => '1'],
            ['permission_id' => 8, 'role_id' => '1'],
            ['permission_id' => 9, 'role_id' => '1'],
            ['permission_id' => 10, 'role_id' => '1'],
            ['permission_id' => 11, 'role_id' => '1'],
            ['permission_id' => 12, 'role_id' => '1'],
            ['permission_id' => 13, 'role_id' => '1'],
            ['permission_id' => 14, 'role_id' => '1'],
            ['permission_id' => 15, 'role_id' => '1'],
            ['permission_id' => 16, 'role_id' => '1'],
            ['permission_id' => 17, 'role_id' => '1'],
            ['permission_id' => 18, 'role_id' => '1'],
            ['permission_id' => 19, 'role_id' => '1'],
            ['permission_id' => 20, 'role_id' => '1'],
            ['permission_id' => 21, 'role_id' => '1'],
            ['permission_id' => 22, 'role_id' => '1'],
            ['permission_id' => 23, 'role_id' => '1']
        ]);

        return 1;
    }
}
