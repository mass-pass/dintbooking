<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Common;
use Illuminate\Support\Facades\Route;

use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Facades\Cache;


use App\DataTables\TransactionDataTable;


use Auth, Validator, Socialite, Mail, DateTime, Hash, Excel, DB, Image, Session;

use App\Models\{
    User,
    UserDetails,
    Messages,
    Country,
    PasswordResets,
    Payment,
    Notification,
    Timezone,
    Reviews,
    Accounts,
    Boat,
    UsersVerification,
    Properties,
    Payouts,
    Bookings,
    Currency,
    Settings,
    Wallet,
    Withdrawal
};




class UserController extends Controller
{
    protected $helper;
    
    public function __construct()
    {
        $this->helper = new Common;
    }

    public function create(Request $request, EmailController $email_controller)
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
            return back()->withErrors($validator)->withInput();
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
            $user->user_type_id =  1;
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
            $email_controller->welcome_email($user);
            
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $this->helper->one_time_message('success', trans('messages.success.register_success'));
                return redirect()->intended('dashboard');
            } else {
                $this->helper->one_time_message('danger', trans('messages.error.login_error'));
                return redirect('login');
            }
        }
    }
    
    

    public function dashboard()
    {
        $data['title']          = 'Dashboard';
        $user_id                = Auth::user()->id;
        $data['wallet']         = wallet::where('user_id', $user_id)->first();
        //$data['list']           = Properties::where('host_id', $user_id)->count();
        $data['trip']           = Bookings::where(['user_id' => $user_id, 'status' => 'Accepted'])->count();
        $data['points']           = Auth::user()->total_available_mature_points.'/'.Auth::user()->total_available_points;

        $bookings               = Bookings::select('payment_method_id', 'currency_code', 
                                DB::raw('(total - service_charge) as total'), 'created_at')->where(['host_id' => $user_id, 'status' => 'Accepted']);

        $data['transactions']   = Withdrawal::with('payment_methods')->select('payment_method_id', 'currency_id', 'amount', 'created_at')->where(['user_id' => $user_id, 'status' => 'Success'])->union($bookings)->orderBy('created_at', 'desc')->take(9)->get();

        $data['bookings']        = Bookings::with('users', 'properties')->where(['host_id' => $user_id, 'status' => 'Accepted'])->orderBy('id', 'desc')->take(5)->get();
        
        /*
        $data['boats'] = Boat::where('owner_id', auth()->id())
            ->latest()
            ->paginate();
        */

        return view('users.dashboard', $data);

    }

    public function profile(Request $request, EmailController $email_controller)
    {

        $user = User::find(Auth::user()->id);

        if ($request->isMethod('post')) {
            $rules = array(
                'first_name'      => 'required|max:255',
                'last_name'       => 'required|max:255',
                'email'           => 'required|max:255|email|unique:users,email,'.Auth::user()->id,
                'birthday_day'    => 'required',
                'birthday_month'  => 'required',
                'birthday_year'   => 'required',
                'phone'           => 'required',
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
            );

            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $new_email = ($user->email != $request->email) ? 'yes' : 'no';

                $user->first_name      = $request->first_name;
                $user->last_name       = $request->last_name;
                $user->email           = $request->email;
                $formattedPhone        = str_replace('+' . $request->carrier_code, "", $request->formatted_phone);
                $user->phone           = !empty($request->phone) ? preg_replace("/[\s-]+/", "", $formattedPhone) : NULL;
                $user->default_country = isset($request->default_country) ? $request->default_country : NULL;
                $user->carrier_code    = isset($request->carrier_code) ? $request->carrier_code : NULL;
                $user->formatted_phone = isset($request->formatted_phone) ? $request->formatted_phone : NULL;
                $user->save();

                $user_verification = UsersVerification::where('user_id', $user->id)->first();
                $user_verification->email = 'no';
                $user_verification->save();

                $temp_details = $request->details;
                $temp_details['date_of_birth'] = $request->birthday_year.'-'.$request->birthday_month.'-'.$request->birthday_day;
                foreach ($temp_details as $key => $value) {
                    if (!is_null($value) && $value != '') {
                        UserDetails::updateOrCreate(['user_id' => Auth::user()->id, 'field' => $key], ['value' => $value]);
                    }
                }

                if ($new_email == 'yes') {
                    $email_controller->change_email_confirmation($user);

                    $this->helper->one_time_message('success', trans('messages.success.email_cofirmation_success'));
                } else {
                    $this->helper->one_time_message('success', trans('messages.profile.profile_updated'));
                }
            }
        }

        $data['profile']   = User::find(Auth::user()->id);

        $data['timezone'] = Cache::remember('timezone', 86400, function () {
            return Timezone::get()->pluck('zone', 'value');
            });

        $data['country'] = Cache::remember('country', 86400, function () {
            return Country::get()->pluck('name', 'short_name');
            });


        $data['details']   = $details = UserDetails::where('user_id', Auth::user()->id)->pluck('value', 'field')->toArray();

        if (isset($details['date_of_birth'])) {
            $data['date_of_birth'] = explode('-', $details['date_of_birth']);
        } else {
            $data['date_of_birth'] = [];
        }

        return view('users.profile', $data);
    }

    public function media()
    {
        $data['result'] = $user = User::find(Auth::user()->id);
        $available_exts = array('png', 'jpg', 'jpeg', 'gif');

        $data['old_imgs'] = array();

        return view('users.media', $data);
    }

    public function photoUpload(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $available_exts = array('png', 'jpg', 'jpeg', 'gif');

        $one_photo = $request->file('file');

        $name = str_replace(' ', '_', $one_photo->getClientOriginalName());
        $name = replaceBracket($name);
                    
        $ext = pathinfo($name, PATHINFO_EXTENSION);

        $name         = 'profile_'.time().'.'.$ext; 

        $path = 'images/profile/'.Auth::user()->id;

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
        $path = Storage::disk('public')->put($path."/".$name, $image->stream(), 'public');
        
        $user->addImage($name);
        $user->profile_image  = $name;
        $user->save();

        return response()->json(['success'=>true]);
    }

    public function userProfile(Request $request)
    {
        $user = User::findOrFail($request->id);
        return response()->json($user);
    }


    public function photoDelete(Request $request)
    {

        $user = User::find(Auth::user()->id);
        $user->removeImage($user->profile_image);
        $user->profile_image  = NULL;
        $user->setProfileImageFromOldImages();
        $user->save();

        $_FILES = array();

        return json_encode([
            'success' => true,
            'default_title' => Auth::user()->first_name,
            'default_profile' => url('images/default-profile.png'),
            'default_alt' => $user->first_name
        ]);
    }

    public function accountPreferences(Request $request, EmailController $email_controller)
    {
        $data['currency_code'] = Currency::where('default', 1)->first();
        $currency_code = $data['currency_code']->code;

        if (!$request->isMethod('post')) {
            $data['payouts']   = Accounts::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            $data['country']   = Country::all()->pluck('name', 'short_name');
            return view('account.preferences', $data);
        } else {
            $account                    =   new Accounts;
            $account->user_id           = Auth::user()->id;
            $account->address1          = $request->address1;
            $account->address2          = $request->address2;
            $account->city              = $request->city;
            $account->state             = $request->state;
            $account->postal_code       = $request->postal_code;
            $account->country           = $request->country;
            $account->payment_method_id = $request->payout_method;
            $account->account           = $request->account;
            $account->currency_code     = $currency_code;

            $account->save();


            $account_check = Accounts::where('user_id', Auth::user()->id)->where('selected', 'Yes')->get();

            if ($account_check->count() == 0) {
                $account->selected = 'Yes';
                $account->save();
            }
            $updateTime = dateFormat($account->updated_at);


            $email_controller->account_preferences($account->id, $updateTime, 'update');

            $this->helper->one_time_message('success', trans('messages.success.payout_update_success'));
            return redirect('users/account-preferences');
        }
    }

    public function accountDelete(Request $request, EmailController $email_controller)
    {
        $account = Accounts::find($request->id);
        if ($account->selected == 'Yes') {
            $this->helper->one_time_message('success', "Selected payout is default");
            return redirect('users/account-preferences');
        } else {


            $account->delete();
            $updateTime = dateFormat($account->updated_at);
            $email_controller->account_preferences($account->id, $updateTime, 'delete');

            $this->helper->one_time_message('success', "Payout account successfully deleted");
            return redirect('users/account-preferences');
        }
    }

    public function accountDefault(Request $request, EmailController $email_controller)
    {
        $account = Accounts::find($request->id);




        if ($account->selected == 'Yes') {
            $this->helper->one_time_message('success', trans('messages.error.payout_account_error'));
            return redirect('users/account-preferences');
        } else {
            $account_all       = Accounts::where('user_id', \Auth::user()->id)->update(['selected'=>'No']);
            $account->selected = 'Yes';
            $account->save();
            $updateTime = dateFormat($account->updated_at);

            $email_controller->account_preferences($account->id, $updateTime, 'default_update' );

            $this->helper->one_time_message('success', trans('messages.success.default_payout_success'));
            return redirect('users/account-preferences');
        }
    }

    public function security(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = array(
                'old_password'          => 'required',
                'new_password'          => 'required|min:6|max:30|different:old_password',
                'password_confirmation' => 'required|same:new_password|different:old_password'
            );

            $fieldNames = array(
                'old_password'          => 'Old Password',
                'new_password'          => 'New Password',
                'password_confirmation' => 'Confirm Password'
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $user = User::find(Auth::user()->id);

                if (!Hash::check($request->old_password, $user->password)) {
                    return back()->withInput()->withErrors(['old_password' => trans('messages.profile.pwd_not_correct')]);
                }

                $user->password = bcrypt($request->new_password);

                $user->save();

                $this->helper->one_time_message('success', trans('messages.profile.pwd_updated'));
                return redirect('users/security');
            }
        }
        return view('account.security');
    }

    public function show(Request $request)
    {
        $data['properties'] = Properties::where('status', 'listed')
                        ->with('users','property_price')
                        ->where('host_id', $request->id)
                        ->take(4)
                        ->get();           
        
        $data['result'] = User::findOrFail($request->id);
        $data['details'] = UserDetails::where('user_id', $request->id)->pluck('value', 'field')->toArray();
        
        $data['reviews_from_guests'] = Reviews::with('users', 'properties')->where(['receiver_id'=>$request->id, 'reviewer'=>'guest'])->orderBy('id', 'desc')->get();
        $data['reviews_from_hosts'] = Reviews::with('users', 'properties')->where(['receiver_id'=>$request->id, 'reviewer'=>'host'])->orderBy('id', 'desc')->get();

        $data['reviews_count'] = $data['reviews_from_guests']->count() + $data['reviews_from_hosts']->count();

        $data['title'] = $data['result']->first_name."'s Profile ";

        return view('users.show', $data);
    }

    public function transactionHistory(TransactionDataTable $dataTable)
    {
    
        $data['from'] = isset(request()->from) ? request()->from : null;
        $data['to']   = isset(request()->to) ? request()->to : null; 
        
        $data['title']  = 'Transaction History'; 
        return $dataTable->render('account.transaction_history',$data);
    }   

    public function getCompletedTransaction(Request $request)
    {
        $transaction        = $this->transaction_result();

        if ($request->from) {
            
            $transaction->whereDate('payouts.created_at', '>=', $request->from);
        }
        if ($request->to) {
            $transaction->whereDate('payouts.created_at', '<=', $request->to);
        }
        if ($request->status) {
            $transaction->where('payouts.status', '=', $request->status);
        }
        $transaction_result = $transaction->paginate(Session::get('row_per_page'))->toJson();
        echo $transaction_result;
    }

    public function transaction_result()
    {
        $where['user_id']   = Auth::user()->id;

        $transaction        = Payouts::join('properties', function ($join) {
            $join->on('properties.id', '=', 'payouts.property_id');
        })
        ->select('payouts.*', 'properties.name as property_name')
        ->where($where)
        ->orderBy('updated_at', 'DESC');

        return $transaction;
    }


    public function verification(Request $request)
    {
        $data          = [];
        $data['title'] = 'Verify your account';
        return view('users.verification', $data);
    }

    public function confirmEmail(Request $request)
    {
        $password_resets = PasswordResets::whereToken($request->code);

        if ($password_resets->count() && Auth::user()->email == $password_resets->first()->email) {
            $password_result = $password_resets->first();
            $datetime1 = new DateTime();
            $datetime2 = new DateTime($password_result->created_at);
            $interval  = $datetime1->diff($datetime2);
            $hours     = $interval->format('%h');
            if ($hours >= 1) {
                $password_resets->delete();
                $this->helper->one_time_message('success', trans('messages.login.token_expired'));
                return redirect('login');
            }
            $data['result'] = User::whereEmail($password_result->email)->first();
            $data['token']  = $request->code;
            $user = User::find($data['result']->id);
            $user->status = "Active";
            $user->save();
            $user_verification = UsersVerification::where('user_id', $data['result']->id)->first();

            $user_verification->email = 'yes';
            $user_verification->save();
            $password_resets->delete();

            $this->helper->one_time_message('success', trans('messages.profile.email_confirmed'));
            return redirect('dashboard');
        } else {
            $this->helper->one_time_message('success', trans('messages.login.invalid_token'));
            return redirect('dashboard');
        }
    }
    public function newConfirmEmail(Request $request, EmailController $emailController)
    {
        $userInfo = User::find(Auth::user()->id);

        $emailController->new_email_confirmation($userInfo);

        $this->helper->one_time_message('success', trans('messages.profile.new_confirm_link_sent', ['email'=>$userInfo->email]));
        if ($request->redirect == 'verification') {
            return redirect('users/edit-verification');
        } else {
            return redirect('dashboard');
        }
    }

    public function facebookLoginVerification()
    {
        Session::put('verification', 'yes');
        return Socialite::with('facebook')->redirect();
    }

    public function facebookConnect(Request $request)
    {
        $facebook_id = $request->id;

        $verification = UsersVerification::find(Auth::user()->id);
        $verification->facebook = 'yes';
        $verification->fb_id = $facebook_id;
        $verification->save();
        $this->helper->one_time_message('success', trans('messages.profile.connected_successfully', ['social'=>'Facebook']));
        return redirect('users/edit_verification');
    }

    public function facebookDisconnectVerification(Request $request)
    {
        $verification = UsersVerification::find(Auth::user()->id);
        $verification->facebook = 'no';
        $verification->fb_id = '';
        $verification->save();
        $this->helper->one_time_message('success', trans('messages.profile.disconnected_successfully', ['social'=>'Facebook']));
        return redirect('users/edit_verification');
    }

    public function googleLoginVerification()
    {
        Session::put('verification', 'yes');
        return Socialite::with('google')->redirect();
    }

    public function googleConnect(Request $request)
    {
        $google_id = $request->id;

        $verification = UsersVerification::find(Auth::user()->id);

        $verification->google = 'yes';
        $verification->google_id = $google_id;

        $verification->save();

        $this->helper->one_time_message('success', trans('messages.profile.connected_successfully', ['social'=>'Google']));
        return redirect('users/edit-verification');
    }

    public function googleDisconnect(Request $request)
    {
        $verification = UsersVerification::find(Auth::user()->id);

        $verification->google = 'no';
        $verification->google_id = '';

        $verification->save();

        $this->helper->one_time_message('success', trans('messages.profile.disconnected_successfully', ['social'=>'Google']));
        return redirect('users/edit-verification');
    }


    public function reviews(Request $request)
    {
        $data['title'] = "Reviews";
        $data['reviewsAboutYou'] = Reviews::where('receiver_id', Auth::user()->id)
        ->orderBy('id', 'desc')
        ->get();
        return view('users.reviews_tpl', $data);
    }

    public function reviewsByYou(Request $request)
    {
        $data['title'] = "Reviews";
        $data['reviewsByYou'] = Reviews::where('sender_id', auth()->id())
                                ->orderBy('id', 'desc')
                                ->paginate(Session::get('row_per_page'), ['*'], 'you');

        $data['reviewsToWrite'] = Bookings::with(['reviews'])
        ->whereRaw('DATEDIFF(now(),end_date) <= 14')
        ->whereRaw('DATEDIFF(now(),end_date) >= 1')
        ->where(['status'=>'Accepted'])
        ->where(function ($query) {
            return $query->where('user_id', auth()->id())->orWhere('host_id', auth()->id());
        })
        ->has('reviews', '<', 1)
        ->paginate(Session::get('row_per_page'), ['*'], 'write');

        $data['expiredReviews'] = Bookings::with(['reviews'])
        ->whereRaw('DATEDIFF(now(),end_date) > 14')
        ->where('status', 'Accepted')
        ->where(function ($query) {
            return $query->where('user_id', auth()->id())->orWhere('host_id', auth()->id());
        })
        ->has('reviews', '<', 1)
        ->paginate(Session::get('row_per_page'), ['*'], 'expired');

        if ($request->expired) {
            $data['expired'] = 'active';
        } elseif ($request->you){
            $data['you'] = 'active';
        } else {
            $data['write'] = 'active';
        }

        return view('users.reviews_you', $data);
    }

    public function editReviews(Request $request)
    {
        $data['title']  = 'Update your reviews';
        $data['result'] = $reservationDetails = Bookings::findOrFail($request->id);

        if (Auth::user()->id == $reservationDetails->user_id) {
            $reviewsChecking = Reviews::where(['booking_id'=>$request->id, 'reviewer'=>'guest'])->get();
            $data['review_id'] = ($reviewsChecking->count()) ? $reviewsChecking[0]->id : '';
        } else {
            $reviewsChecking = Reviews::where(['booking_id'=>$request->id, 'reviewer'=>'host'])->get();
            $data['review_id'] = ($reviewsChecking->count()) ? $reviewsChecking[0]->id : '';
        }

        if (!$request->isMethod('post')) {
            if ($reservationDetails->user_id == Auth::user()->id) {
                return view('users.edit_reviews_guest', $data);
            } elseif ($reservationDetails->host_id == Auth::user()->id) {
                return view('users.edit_reviews_host', $data);
            } else {
                return abort(404);
            }
        } else {
            $data  = $request;
            if ($data->review_id == '') {
                $reviews = new Reviews;
            } else {
                $reviews = Reviews::find($data->review_id);
            }

            $reviews->booking_id = $reservationDetails->id;
            $reviews->property_id = $reservationDetails->property_id;

            if ($reservationDetails->user_id == Auth::user()->id) {
                $reviews->sender_id = $reservationDetails->user_id;
                $reviews->receiver_id = $reservationDetails->host_id;
                $reviews->reviewer = 'guest';
            } elseif ($reservationDetails->host_id == Auth::user()->id) {
                $reviews->sender_id = $reservationDetails->host_id;
                $reviews->receiver_id = $reservationDetails->user_id;
                $reviews->reviewer = 'host';
            }

            foreach ($data->all() as $key => $value) {
                if ($key != 'section' && $key != 'review_id') {
                    $reviews->$key = $value;
                }
            }


            $reviews->save();

            return json_encode(['success'=>true, 'review_id'=>$reviews->id]);
        }
    }


    public function reviewDetails(Request $request)
    {
        $review_id = $request->id;
        $data['reviewDetails'] = Reviews::where('id', '=', $review_id)->where(function($query){
            return $query->where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id());
            return $query;
        })->firstOrFail();
        return view('users.reviews_details', $data)->render();
    }


    /**
     * Check duplicate phone number for new user
     *
     * @param Request $request
     *
     * @return status true/false
     * 
     * @return message fail/success
     */

    public function duplicatePhoneNumberCheck(Request $request)
    { 
        $req_id = $request->id;

        if (isset($req_id)) {
            $user = User::where(['phone' => preg_replace("/[\s-]+/", "", $request->phone), 'carrier_code' => $request->carrier_code])->where(function ($query) use ($req_id)
            {
                $query->where('id', '!=', $req_id);
            })->first(['phone', 'carrier_code']);
        } else {
            $user = User::where(['phone' => preg_replace("/[\s-]+/", "", $request->phone), 'carrier_code' => $request->carrier_code])->first(['phone', 'carrier_code']);
        }

        if (!empty($user->phone) && !empty($user->carrier_code)) {
            $data['status'] = true;
            $data['fail']   = "The phone number has already been taken!";
        } else {
            $data['status']  = false;
            $data['success'] = "The phone number is Available!";
        }
        return json_encode($data);
    }

    /**
     * Checking duplicate hone numebr for existing customer during manual booking
     *
     * @param string Request as $request
     *
     * @return status and message
     */

    public function duplicatePhoneNumberCheckForExistingCustomer(Request $request)
    {

        $req_id = isset($request->id) ? $request->id : $request->customer_id;

        if (isset($req_id)) {
            $user = User::where(['phone' => preg_replace("/[\s-]+/", "", $request->phone), 'carrier_code' => $request->carrier_code])->where(function ($query) use ($req_id)
            {
                $query->where('id', '!=', $req_id);
            })->first(['phone', 'carrier_code']);
        } else {
            $user = User::where(['phone' => preg_replace("/[\s-]+/", "", $request->phone), 'carrier_code' => $request->carrier_code])->first(['phone', 'carrier_code']);
        }

        if (!empty($user->phone) && !empty($user->carrier_code)) {
            $data['status'] = true;
            $data['fail']   = "The phone number has already been taken!";
        } else {
            $data['status']  = false;
            $data['success'] = "The phone number is Available!";
        }
        return json_encode($data);
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
   }

