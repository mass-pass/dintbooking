<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;
use App\Http\Helpers\Common;
use Illuminate\Http\Request;


use App\Models\{
    PasswordResets,
    User,
    UserDetails,
    UsersVerification
};

use Auth;
use DateTime;
use Session;
use Socialite;
use Validator;
use DB;

class LoginController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common();
    }

    public function index()
    {
        $data = [];

        return view('login.view', $data);
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
            return back()->withErrors($validator)->withInput();
        } else {
            $users = User::where('email', $request->email)->first();

            if (!empty($users)) {
                if ($users->status != 'Inactive') {
                    if ($users->user_type_id == 1 || $users->user_type_id == 2) {
                        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                           // return redirect()->intended(route('user_dashboard'));
                            return $this->get_intend_url();
                        } else {
                            $this->helper->one_time_message('error', trans('messages.error.login_info_error'));
                            return redirect('login');
                        }
                    } else {
                        $this->helper->one_time_message('error', "You can't access this site.");
                        return redirect('login');
                    }
                } elseif ($users->status == 'Inactive') {
                    $this->helper->one_time_message('error', "User is inactive. Please try agin!");
                    return redirect('login');
                } else {
                    $this->helper->one_time_message('error', trans('messages.error.login_info_error'));
                    return redirect('login');
                }
            } else {
                $this->helper->one_time_message('error', trans('There isn’t an account associated with this email address.'));
                return redirect('login');
            }
        }
    }

    public function check(Request $request)
    {
        if ($request->get('email')) {
            $email = $request->get('email');
            $data  = DB::table("users")
                ->where('email', $email)
                ->count();
            if ($data > 0) {
                echo 'not_unique';
            } else {
                echo 'unique';
            }
        }
    }

    public function signup(Request $request)
    {
        $data = [];
        return view('home.signup_login', $data);
    }

    public function forgotPassword(Request $request, EmailController $email_controller)
    {
        if (!$request->isMethod('post')) {
            return view('login.forgot_password');
        } else {
            $rules = array(
                'email' => 'required|email|exists:users,email|max:200',
            );

            $messages = array(
                'required' => ':attribute is required.',
                'exists'   => trans('messages.jquery_validation.email_not_existed'),
            );

            $fieldNames = array(
                'email' => 'Email',
            );

            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $user = User::whereEmail($request->email)->first();
                $email_controller->forgot_password($user);

                $this->helper->one_time_message('success', trans('messages.success.reset_pass_send_success'));
                return redirect('login');
            }
        }
    }

    public function resetPassword(Request $request)
    {
        if (!$request->isMethod('post')) {
            $password_resets = PasswordResets::whereToken($request->secret);

            if ($password_resets->count()) {
                $password_result = $password_resets->first();

                $datetime1 = new DateTime();
                $datetime2 = new DateTime($password_result->created_at);
                $interval  = $datetime1->diff($datetime2);
                $hours     = $interval->format('%h');

                if ($hours >= 1) {
                    $password_resets->delete();

                    $this->helper->one_time_message('error', trans('messages.error.token_expire_error'));
                    return redirect('login');
                }

                $data['result'] = User::whereEmail($password_result->email)->first();
                $data['token']  = $request->secret;

                return view('login.reset_password', $data);
            } else {
                $this->helper->one_time_message('error', trans('Invalid Token'));
                return redirect('login');
            }
        } else {
            $rules = array(
                'password'              => 'required|min:6|max:30',
                'password_confirmation' => 'required|same:password',
            );

            $fieldNames = array(
                'password'              => 'New Password',
                'password_confirmation' => 'Confirm Password',
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $password_resets = PasswordResets::whereToken($request->token)->delete();

                $user           = User::find($request->id);
                $user->password = bcrypt($request->password);
                $user->save();

                $this->helper->one_time_message('success', trans('messages.success.pass_change_success'));
                return redirect('login');
            }
        }
    }

    public function facebookAuthenticate(Request $request, EmailController $email_controller, UserController $user_controller)
    {
        if (!isset(request()->error)) {

            //try {
            $userNode = Socialite::with('facebook')->stateless()->user();
            //} catch (\Exception $e) {
            //return redirect('login');
            //}


            $verificationUser = Session::get('verification');

            if ($verificationUser == 'yes') {
                return redirect('facebookConnect/' . $userNode->id);
            }

            $ex_name   = explode(' ', $userNode->name);
            $firstName = $ex_name[0];
            $lastName  = $ex_name[1];

            $email = $userNode->email;

            $user = User::where('email', $email);

            if ($user->count() > 0) {
                $user = User::where('email', $email)->first();

                UserDetails::updateOrCreate(
                    ['user_id' => $user->id, 'field' => 'fb_id'],
                    ['value' => $userNode->id]
                );

                $user_id = $user->id;
            } else {
                $user = User::where('email', $email);

                if ($user->count() > 0) {
                    $data['title'] = 'Disabled ';
                    return view('users.disabled', $data);
                }

                $user             = new User();
                $user->first_name = $firstName;
                $user->last_name  = $lastName;
                $user->email      = $email;
                $user->status     = 'Active';
                $user->save();

                $user_details          = new UserDetails();
                $user_details->user_id = $user->id;
                $user_details->field   = 'fb_id';
                $user_details->value   = $userNode->id;
                $user_details->save();

                $user_verification           = new UsersVerification();
                $user_verification->user_id  = $user->id;
                $user_verification->fb_id    = $userNode->id;
                $user_verification->facebook = 'yes';
                $user_verification->save();

                $user_id = $user->id;
                $user_controller->wallet($user->id);
                $email_controller->welcome_email($user);
            }

            $users = User::where('id', $user_id)->first();

            if ($users->status != 'Inactive') {
                if (Auth::loginUsingId($user_id)) {
                    return redirect()->intended('dashboard');
                } else {
                    $this->helper->one_time_message('danger', trans('messages.login.login_failed'));
                    return redirect('login');
                }
            } else {
                $data['title'] = 'Disabled ';
                return view('users.disabled', $data);
            }
        } else {
            return redirect('login');
        }
    }

    public function googleLogin()
    {
        return Socialite::with('google')->redirect();
    }

    public function facebookLogin()
    {
        return Socialite::with('facebook')->redirect();
    }

    public function googleAuthenticate(EmailController $email_controller, UserController $user_controller)
    {

        if (!isset(request()->error)) {
            $userNode = Socialite::with('google')->stateless()->user();

            $verificationUser = Session::get('verification');
            if ($verificationUser == 'yes') {
                return redirect('googleConnect/' . $userNode->id);
            }

            $ex_name   = explode(' ', $userNode->name);
            $firstName = $ex_name[0];
            $lastName  = $ex_name[1];

            $email = ($userNode->email == '') ? $userNode->id . '@gmail.com' : $userNode->email;

            $user = User::where('email', $email);

            if ($user->count() > 0) {
                $user = User::where('email', $email)->first();

                UserDetails::updateOrCreate(
                    ['user_id' => $user->id, 'field' => 'fb_id'],
                    ['value' => $userNode->id]
                );

                $user_id = $user->id;
            } else {
                $user = User::where('email', $email);

                if ($user->count() > 0) {
                    $data['title'] = 'Disabled ';
                    return view('users.disabled', $data);
                }

                $user             = new User();
                $user->first_name = $firstName;
                $user->last_name  = $lastName;
                $user->email      = $email;
                $user->status     = 'Active';
                $user->save();

                $user_details          = new UserDetails();
                $user_details->user_id = $user->id;
                $user_details->field   = 'google_id';
                $user_details->value   = $userNode->id;
                $user_details->save();

                $user_id = $user->id;

                $user_verification            = new UsersVerification();
                $user_verification->user_id   = $user->id;
                $user_verification->google_id = $userNode->id;
                $user_verification->google    = 'yes';
                $user_verification->save();

                $user_controller->wallet($user->id);
                //$email_controller->welcome_email($user);
            }

            $users = User::where('id', $user_id)->first();

            if ($users->status != 'Inactive') {
                if (Auth::loginUsingId($user_id)) {
                    return redirect()->intended('dashboard');
                } else {
                    $this->helper->one_time_message('danger', trans('messages.login.login_failed'));
                    return redirect('login');
                }
            } else {
                $data['title'] = 'Disabled ';
                return view('users.disabled', $data);
            }
        } else {
            return redirect('login');
        }
    }

    private function get_intend_url() {
        $guestDomain = config('services.domain.guest');
        return redirect()->to($guestDomain . "/dashboard"); 
    }

}
