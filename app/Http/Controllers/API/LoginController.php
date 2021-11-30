<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\{
    Controller,
    EmailController,
    UserController
};
use App\Http\Helpers\Common;
use Illuminate\Http\Request;


use App\Models\{
    User,
    UserDetails,
    UsersVerification
};

use Auth;
use DateTime;
use Session;
use Validator;
use DB;

class LoginController extends Controller
{
    public $successStatus = 200;
    public $unAuthorizedStatus = 401;

    protected $helper;

    public function __construct()
    {
        //
    }

    public function authenticate(Request $request)
    {
        $rules = array(
            'email'    => 'required|email|max:200',
            'password' => 'required',
        );

        $fieldNames = array(
            'email'    => 'Email',
            'password' => 'Password',
        );

        $remember = ($request->remember_me) ? true : false;

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($fieldNames);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], $this-> unAuthorizedStatus);
        } else {
            $users = User::where('email', $request->email)->first();

            if (!empty($users)) {  
                if ($users->status != 'Inactive') {
                    if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                        $success['token'] =  $users->createToken('MyApp')-> accessToken; 
                        $success['user_info'] =  $users;
                        return response()->json(['success'=>$success], $this-> successStatus);
                    } else {
                        return response()->json(['warn'=>'Incorrect email or password'], $this-> unAuthorizedStatus);
                        // $this->helper->one_time_message('error', trans('messages.error.login_info_error'));
                        // return redirect('login');
                    }
                } elseif ($users->status == 'Inactive') {
                    return response()->json(['warn'=>'User is inactive. Please try agin!'], $this-> unAuthorizedStatus);
                } else {
                        return response()->json(['warn'=>'Failed to login'], $this-> unAuthorizedStatus);
                }
            }else{
                    return response()->json(['warn'=>'There isn’t an account associated with this email address.'], $this-> unAuthorizedStatus);
            }
           
        }
    }
}