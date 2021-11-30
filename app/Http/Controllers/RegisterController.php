<?php

namespace App\Http\Controllers;


use App\Http\{
    Helpers\Common,
    Controllers\Controller,
    Controllers\EmailController,
};

use Illuminate\Http\Request;
use Auth, Validator, Session;
use App\Models\{
    User,
    UserDetails,
    Messages,
    UsersVerification,
    Settings,
    Wallet
};


class RegisterController extends Controller
{
    protected $helper;
    
    public function __construct()
    {
        $this->helper = new Common;
    }

    /**
     * Create Account For User
     */
    public function createAccount(Request $request)
    {  
        if ($request->isMethod('post')) {
            $rules = array(
                'email' => 'required|max:255|email|unique:users',
            );

            $messages = array(
                'required' => ':attribute is required.'
            );

            $fieldNames = array(
                'email' => 'Email',
            );

            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->setAttributeNames($fieldNames);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                Session::put('register_email', $request->email);
                return redirect()->route('partner.contact-details');
            }
        } else {
            if (Session::get('register_email') && Session::get('register_first_name') && Session::get('register_last_name')) {
                $data['title'] = 'Create Password';
                return view('register.create_password', $data);
            } else if (Session::get('register_email')) {
                $data['title'] = 'Contact Details';
                return view('register.contact_details', $data); 
            } else {
                $data['title'] = 'Create Account';
                return view('register.create_account', $data); 
            } 
        }
    }

    public function contactDetails(Request $request)
    {  
        if ($request->isMethod('post')) {
            $rules = array(
                'first_name'      => 'required|max:255',
                'last_name'       => 'required|max:255'
            );

            $messages = array(
                'required'                => ':attribute is required.'
            );

            $fieldNames = array(
                'first_name'      => 'First name',
                'last_name'       => 'Last name',
            );

            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                Session::put('register_first_name', $request->first_name);
                Session::put('register_last_name', $request->last_name);
                Session::put('register_carrier_code', $request->carrier_code);
                Session::put('register_formatted_phone', $request->formatted_phone);
                Session::put('register_phone', $request->phone);
                Session::put('register_default_country', $request->default_country);
                return redirect()->route('partner.create-password');
            }
        } else {
            if (Session::get('register_email') && Session::get('register_first_name') && Session::get('register_last_name')) {
                $data['title'] = 'Create Password';
                return view('register.create_password', $data);
            } else if (Session::get('register_email')) {
                 $data['title'] = 'Contact Details';
                return view('register.contact_details', $data); 
            } else {
                return redirect()->route('partner.create-account');
            } 
        }
    }

    /**
     * Create Password and Create User
     */
    public function createPassword(Request $request, EmailController $email)
    {  
        if ($request->isMethod('post')) {
            $rules = array(
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required|min:6'
            );

            $messages = array(
                'required' => ':attribute is required.'
            );

            $fieldNames = array(
                'password' => 'Password',
                'password_confirmation' => 'Confirm Password',
            );

            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->setAttributeNames($fieldNames);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $user = new User;
                $user->first_name   =   Session::get('register_first_name');
                $user->last_name    =   Session::get('register_last_name');
                $user->email        =   Session::get('register_email');
                $user->password     =   bcrypt($request->password);
                $user->status       =   'Active';
                $formattedPhone        = str_replace('+' . Session::get('register_carrier_code'), "", Session::get('register_formatted_phone'));
                $user->phone           = !empty(Session::get('register_phone')) ? preg_replace("/[\s-]+/", "", $formattedPhone) : NULL;
                $user->default_country = !empty(Session::get('register_default_country')) ? Session::get('register_default_country') : NULL;
                $user->carrier_code    = !empty(Session::get('register_carrier_code')) ? Session::get('register_carrier_code') : NULL;
                $user->formatted_phone = !empty(Session::get('register_formatted_phone')) ? Session::get('register_formatted_phone') : NULL;
                $user->user_type_id =  2;
                $user->save();

                $user_verification  = new UsersVerification;
                $user_verification->user_id  =   $user->id;
                $user_verification->save();

                $this->wallet($user->id);
               // $email->welcome_email($user);
                
                if (Auth::attempt(['email' => Session::get('register_email'), 'password' => $request->password])) {
                    Session::forget('register_email');
                    Session::forget('register_first_name');
                    Session::forget('register_last_name');
                    Session::forget('register_carrier_code');
                    Session::forget('register_default_country');
                    Session::forget('register_phone');
                    Session::forget('register_formatted_phone');
                    $this->helper->one_time_message('success', trans('messages.success.register_success'));
                    // return redirect()->route('partner.list-property');
                    return $this->get_intend_url();
                } else {
                    $this->helper->one_time_message('danger', trans('messages.error.login_error'));
                    return redirect('login');
                }
            }
        } else {
            if (Session::get('register_email') && Session::get('register_first_name') && Session::get('register_last_name')) {
                $data['title'] = 'Create Password';
                return view('register.create_password', $data);
            } else if (Session::get('register_email')) {
                 $data['title'] = 'Contact Details';
                return view('register.contact_details', $data); 
            } else {
                return redirect()->route('partner.create-account');
            } 
        }
    }

    /**
     * Add for user wallet info
     *
     * @param string Request as $request
     *
     * @return  user info
     */
    public function wallet($userId)
    {  
        $defaultCurrencyId    = Settings::where('name', 'default_currency')->first();
        $wallet               = new Wallet();
        $wallet->user_id      = $userId;
        $wallet->currency_id  = (int)$defaultCurrencyId->value;
        $wallet->save();
    }

    private function get_intend_url() {
        $guestDomain = config('services.domain.guest');
        return redirect()->to($guestDomain . "/dashboard"); 
    }
}
