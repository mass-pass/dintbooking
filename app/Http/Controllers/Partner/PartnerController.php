<?php

namespace App\Http\Controllers\partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Common;

use Session, Auth, Validator, App, Image, Storage;

use App\Models\{
    Settings,
    language,
    Photo,
    User
};


class PartnerController extends Controller
{
    private $helper;
    
    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index()
    {
        // on Sept 20, it's decided that we are going to use one login form
        return $this->goto_main_login();

        $data['title'] = 'Partner Login';
        $sessionLanguage  = Session::get('language');
        $language = Settings::where(['name' => 'default_language', 'type' => 'general'])->first();
        $languageDetails = language::where(['id' => $language->value])->first();

        if (!($sessionLanguage)) {
            Session::pull('language');
            Session::put('language', $languageDetails->short_name);
            App::setLocale($languageDetails->short_name);
        }

        $pref = Settings::getAll();
        $prefer = [];

        if (!empty($pref)) {
            foreach ($pref as $value) {
                $prefer[$value->name] = $value->value;
            }
            Session::put($prefer);
        }
       
        if (Auth::check()) {
            //return redirect('partner/dashboard');
            return $this->get_intend_url();
        }

        return view('partner.login.login', $data);  
    }


    public function photoUpload(Request $request){
        $one_photo = $request->file('file');

        $name = str_replace(' ', '_', $one_photo->getClientOriginalName());
                                    
        $extension = pathinfo($name, PATHINFO_EXTENSION);

        $name = time().'_'.$name; 

        $path = 'images/'.date('Ymd');
                        
        $image = Image::make($one_photo);
        $height = $image->height();
        $width = $image->width();
        if($height>900){
            if(ceil((16/9)*900)<$width){
                $height = 900;
                $width = ceil((16/9)*$height);
            }
        }

        $calculated_width = ceil((16/9)*$height);
        $calculated_height = ceil($width/(16/9));
        $applicable_height = 0;
        $applicable_width = 0;
        
        if($height >= $calculated_height){
            $applicable_height = $calculated_height;
            $applicable_width = $width;
        }else{
            $applicable_height = $height;
            $applicable_width = $calculated_width;
        }

        $image->fit($applicable_width, $applicable_height)->encode($extension, 40);

        //$path = Storage::disk('s3')->put($path."/".$name, $image->stream(), 'public');
        $path = Storage::put($path."/".$name, $image->stream(), 'public');

        $photo = new Photo();
        $photo->photoable_type   = $request->photoable_type;
        $photo->photoable_id   = $request->photoable_id;
        $photo->photo         = $name;
        $photo->save();


        return response()->json(['success'=>$photo."/".$name]);
    }

    public function fileUpload(Request $request){
        $one_file = $request->file('file');

        $name = str_replace(' ', '_', $one_file->getClientOriginalName());
                                    
        $name = time().'_'.$name; 

        $path = 'files/'.date('Ymd');
                        
        //$path = Storage::disk('s3')->putFileAs($path, $one_file, $name);
        $path = Storage::putFileAs($path, $one_file, $name);

        return response()->json(['success'=>['path'=>$path]]);
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
                    if($users->user_type_id == 2) {
                        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                            //return redirect('partner/dashboard');
                            
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
            }else{
                $this->helper->one_time_message('error', trans('There isn’t an account associated with this email address.'));
                    return redirect('login');
            }
        }
    }

    private function get_intend_url() {
        $guestDomain = config('services.domain.guest');
        return redirect()->to($guestDomain . "/dashboard"); 
    }

    private function goto_main_login() {
        $guestDomain = config('services.domain.guest');
        return redirect()->to($guestDomain . "/login"); 
    }
}
