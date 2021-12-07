<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\Common;
use Illuminate\Support\Facades\Route;

use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller; 


use Auth, Validator, DateTime, Hash, DB, Image, Session;

use App\Models\{
    User,
    UserDetails,
    UsersVerification,
    Settings,
    Wallet
};




class UserController extends Controller
{

    public $successStatus = 200;
    public $unAuthorizedStatus = 401;
    
    public function __construct()
    {
        //
    }

    public function create(Request $request)
    { 
        $rules = array(
            'first_name'      => 'required|max:255',
            'last_name'       => 'required|max:255',
            'email'           => 'required|max:255|email|unique:users',
            'password'        => 'required|min:6',
            'date_of_birth'   => 'check_age',
            'birthday_day'    => 'required',
            'birthday_month'  => 'required',
            'birthday_year'   => 'required',
        );

        $messages = array(
            'required'                => ':attribute is required.',
            'birthday_day.required'   => 'Birth date field is required.',
            'birthday_month.required' => 'Birth date field is required.',
            'birthday_year.required'  => 'Birth date field is required.',
        );

        $fieldNames = array(
            'first_name'      => 'First name',
            'last_name'       => 'Last name',
            'email'           => 'Email',
            'password'        => 'Password',
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->setAttributeNames($fieldNames);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], $this-> unAuthorizedStatus);   
            // return back()->withErrors($validator)->withInput();
        } else {
            $user = new User;
            $user->first_name   =   $request->first_name;
            $user->last_name    =   $request->last_name;
            $user->email        =   $request->email;
            $user->password     =   bcrypt($request->password);
            $user->status       =   'Active';
            $formattedPhone        = str_replace('+' . $request->carrier_code, "", $request->formatted_phone);
            $user->phone           = !empty($request->phone) ? preg_replace("/[\s-]+/", "", $formattedPhone) : NULL;
            $user->default_country = isset($request->default_country) ? $request->default_country : NULL;
            $user->carrier_code    = isset($request->carrier_code) ? $request->carrier_code : NULL;
            $user->formatted_phone = isset($request->formatted_phone) ? $request->formatted_phone : NULL;
            $user->profile_image = '';
            $user->save();

            $user_details             = new UserDetails;
            $user_details->user_id    = $user->id;
            $user_details->field      = 'date_of_birth';
            $user_details->value      = $request->birthday_year.'-'.$request->birthday_month.'-'.$request->birthday_day;
            $user_details->save();

            $user_verification  = new UsersVerification;
            $user_verification->user_id  =   $user->id;
            $user_verification->save();

            $this->wallet($user->id);
            // $email_controller->welcome_email($user);
            
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                $success['user_info'] =  $user;
                return response()->json(['success'=>$success], $this-> successStatus);
            } else {
                return response()->json(['warn'=>'Failed to login'], $this-> unAuthorizedStatus);
            }
        }
    }

    public function photoUpload(Request $request)
    {
        $user = User::find($request->id);
        $available_exts = array('png', 'jpg', 'jpeg', 'gif');

        $one_photo = $request->file('file');

        $name = str_replace(' ', '_', $one_photo->getClientOriginalName());
        $name = replaceBracket($name);
                              
        $ext = pathinfo($name, PATHINFO_EXTENSION);

        $name         = 'profile_'.time().'.'.$ext; 

        $path = 'images/profile/'.$request->id;

        $image = Image::make($one_photo);
        $height = $image->height();
        $width = $image->width();

        if($height < $width){
            $width = $height;
        }

        if($height>900){
            $height = 900;
            $width = 900;
        }

        $image->fit($width, $height)->encode($ext, 40);

        //$path = Storage::disk('s3')->put($path."/".$name, $image->stream(), 'public');
        $path = Storage::put($path."/".$name, $image->stream(), 'public');

        $user->addImage($name);
        $user->profile_image  = $name;
        $user->save();

        $success['photo'] =  $user;
        return response()->json(['success'=>$success], $this-> successStatus);

        // return response()->json(['success'=>true]);
    }   
    

    public function wallet($userId)
       {  
           $defaultCurrencyId    = Settings::where('name', 'default_currency')->first();
           $wallet               = new Wallet();
           $wallet->user_id      = $userId;
           $wallet->currency_id  = (int)$defaultCurrencyId->value;
           $wallet->save();

       }
   }