<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Helpers\Common;

use App\Http\Controllers\Controller;

use Auth;
use Session;
use Validator;

use App\Models\{
    Admin,
    Settings,
    RoleAdmin,
    PermissionRole,
    Roles,
    User,
    Messages,
    Bookings,
    Properties
};




use App\DataTables\AdminuserDataTable;
use App\DataTables\MessagesDataTable;

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    protected $helper;
    
    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(AdminuserDataTable $dataTable)
    {
        return $dataTable->render('admin.admin.view');
    }

    public function add(Request $request)
    {
        if (! $request->isMethod('post')) {
            $data['roles'] = Roles::all()->pluck('display_name','id');
            return view('admin.admin.add', $data);
        } elseif ($request->isMethod('post')) {
            $rules = array(
                'username'   => 'required|unique:admin|max:255',
                'email'      => 'required|email|unique:admin|max:255',
                'password'   => 'required|max:50',
                'role'       => 'required',
                'status'     => 'required'
            );

            $fieldNames = array(
                'username'   => 'Username',
                'email'      => 'Email',
                'password'   => 'Password',
                'role'       => 'Role',
                'status'     => 'Status'
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames); 

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $admin = new Admin;
                $admin->username = $request->username;
                $admin->email    = $request->email;
                $admin->password = bcrypt($request->password);
                $admin->status   = !empty($request->status) ? $request->status : 'Active';
                $admin->save();

                RoleAdmin::insert(['admin_id' => $admin->id, 'role_id' => $request->role]);

                $this->helper->one_time_message('success', 'Added Successfully');

                return redirect('admin/admin-users');
            }
        } else {
            return redirect('admin/admin-users');
        }
    }

    public function installer_create(Request $request)
    {
        if (isset($request['username']) && isset($request['email']) && isset($request['password'])) {
            $admin = new Admin;
            $admin->truncate();
            $admin->username =   $request['username'];
            $admin->email    =   $request['email'];
            $admin->password =   bcrypt($request['password']);
            $admin->save();

            $role_user = new RoleAdmin;
            $role_user->truncate();
            $role_user->admin_id = $admin->id;
            $role_user->role_id  = '1';
            $role_user->save();

            $data = [
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
                ['permission_id' => 23, 'role_id' => '1'],
                ['permission_id' => 24, 'role_id' => '1'],
                ['permission_id' => 25, 'role_id' => '1'],
                ['permission_id' => 26, 'role_id' => '1'],
                ['permission_id' => 27, 'role_id' => '1'],
                ['permission_id' => 28, 'role_id' => '1'],
                ['permission_id' => 29, 'role_id' => '1'],
                ['permission_id' => 30, 'role_id' => '1'],
                ['permission_id' => 31, 'role_id' => '1'],
                ['permission_id' => 32, 'role_id' => '1'],
                ['permission_id' => 33, 'role_id' => '1'],
                ['permission_id' => 34, 'role_id' => '1'],
                ['permission_id' => 35, 'role_id' => '1'],
                ['permission_id' => 36, 'role_id' => '1'],
                ['permission_id' => 37, 'role_id' => '1'],
                ['permission_id' => 38, 'role_id' => '1'],
                ['permission_id' => 39, 'role_id' => '1'],
                ['permission_id' => 40, 'role_id' => '1'],
                ['permission_id' => 41, 'role_id' => '1'],
            ];
            
            return PermissionRole::insert($data);
        }
    }

    public function update(Request $request)
    {
        if (!$request->isMethod('post')) {
            $data['result']  = Admin::find($request->id);
            
            $data['roles']   = Roles::all()->pluck('display_name', 'id');
            
            $data['role_id'] = Roles::role_admin($request->id)->role_id;

            return view('admin.admin.edit', $data);
        } elseif ($request->isMethod('post')) {
            $rules = array(
                'username'   => 'required|max:255|unique:admin,username,'.$request->id,
                'email'      => 'required|max:255|email|unique:admin,email,'.$request->id,
                'role'       => 'required',
                'status'     => 'required'
            );

            $fieldNames = array(
                'username'   => 'Username',
                'email'      => 'Email',
                'role'       => 'Role',
                'status'     => 'Status'
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames); 

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $admin = Admin::findOrFail($request->id);

                $admin->username = $request->username;
                $admin->email    = $request->email;
                $admin->status   = $request->status;
                
                if($request->password != '')
                    $admin->password = bcrypt($request->password);

                $admin->save();

                RoleAdmin::where(['admin_id' => $request->id])->update(['role_id' => $request->role]);

                $this->helper->one_time_message('success', 'Updated Successfully');

                return redirect('admin/admin-users');
            }
        } else {
            return redirect('admin/admin-users');
        }
    }


    public function login()
    {
        return view('admin.login');
    }

   public function authenticate(Request $request)
    {
        $admin = Admin::where('email', $request['email'])->first();
        if (!empty($admin->status)) {
          if ($admin->status != 'Inactive') {
             if (Auth::guard('admin')->attempt(['email' => trim($request['email']), 'password' => trim($request['password'])])) {
                 $pref   = Settings::where('type', 'preferences')->get();
                 $prefer = [];
                 if (!empty($pref)) {
                    foreach ($pref as $value) {
                        $prefer[$value->name] = $value->value;
                     }
                    Session::put($prefer);
                 }
                return redirect()->intended('admin/dashboard'); 
             } else {
                $this->helper->one_time_message('danger', 'Please Check Your Email/Password'); 
                return redirect('admin/login'); 
             }
          } else {
            $this->helper->one_time_message('danger', 'You are Blocked.'); 
            return redirect('admin/login'); 
          }
        } else {
            
             $this->helper->one_time_message('danger', 'Please Check Your Email/Password'); 
             return redirect('admin/login'); 

        }
    }

    public function validator(array $data){
        $rules = array(
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:50',
        );

        $fieldNames = array(
            'name'   => 'Username',
            'email'      => 'Email',
            'password'   => 'Password',
        );

        $validator = Validator::make($data, $rules);
        $validator->setAttributeNames($fieldNames);
        return $validator;
        
    }

    
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('admin/login');
    }

    public function profile(Request $request){
        if (! $request->isMethod('post')) {
             $data['result'] = Auth::guard('admin')->user();
            
             return view('admin.profile', $data);
        } elseif ($request->isMethod('post')) {
            $rules = array(
                'name'       => 'required|max:255',
                'password'   => 'confirmed|max:50',
            );

            $fieldNames = array(
                'name'       => 'Name',
                'password'   => 'Password',
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames); 

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                if (env('APP_MODE', '') != 'test') {
                    $extension_type =  [1 => 'gif', 2 => 'jpg', 3 => 'png'];
                    if (!empty($_FILES) && $_FILES['profile_pic']['name'] != '') {
                        $img_name = 'profile';
                        $path = 'images/profile/'.\Auth::guard('admin')->user()->id;

                        if (! file_exists($path)) {
                            mkdir($path, 0777, true);
                        }

                        $tempFile       = $_FILES['profile_pic']['tmp_name'];             
                        
                        $extension      =   exif_imagetype( $_FILES['profile_pic']['tmp_name']);
                        
                        if ($extension) {
                            $filename       =   $img_name . '.' . $extension_type[$extension];

                            $targetPath     = 'images/profile/'.\Auth::guard('admin')->user()->id.'/';

                            $targetFile     =  $targetPath. $filename;

                            move_uploaded_file($tempFile,$targetFile);
                            list($width, $height) = getimagesize($targetFile);
                        }
                    }

                    $user = Admin::find(Auth::guard('admin')->user()->id);
                    $user->username  = $request->name;
                    if (isset($request->password) && $request->password != '') $user->password   = \Hash::make($request->password);
                    if (isset($filename) && $filename != '') $user->profile_image   = $filename;
                    $user->save();
                }
                
                $this->helper->one_time_message('success', 'Updated Successfully');
                return redirect('admin/profile');
            }
        }
    }

    public function delete(Request $request)
    {
        if ( $request->id == 1 ) {

           $this->helper->one_time_message('error', 'This User can\'t be deleted');
           return redirect('admin/admin-users');
        }elseif ($request->id == Auth::guard('admin')->id()) {
            $this->helper->one_time_message('error', 'You can\'t delete yourself!');
           return redirect('admin/admin-users');
        }else{

            Admin::find($request->id)->delete();
            RoleAdmin::where('admin_id', $request->id)->delete();
            $this->helper->one_time_message('success', 'Deleted Successfully');
            return redirect('admin/admin-users');
        }
        
    }

    public function updateCustomer(Request $request) 
    {

        $user                  = User::find($request->customer_id);
        $user->first_name      = $request->first_name;
        $user->last_name       = $request->last_name;
        $user->email           = $request->email;
        $user->status          = $request->status;
        $user->profile_image   = NULL;
        $formattedPhone        = str_replace('+' . $request->carrier_code, "", $request->formatted_phone);
        $user->phone           = !empty($request->phone) ? preg_replace("/[\s-]+/", "", $formattedPhone) : NULL;
        $user->default_country = isset($request->default_country) ? $request->default_country : NULL;
        $user->carrier_code    = isset($request->carrier_code) ? $request->carrier_code : NULL;
        $user->formatted_phone = isset($request->formatted_phone) ? $request->formatted_phone : NULL;
        $user->save();
        $this->helper->one_time_message('success', 'Clients information successfully updated!');
        return redirect('admin/bookings/detail'.'/'.$request->booking_id);
        
    }
    
    public function customerMessage(MessagesDataTable $dataTable)
    {

        return $dataTable->render('admin.messages.view');
    }
    public function deleteMessage(Request $request)
    {

        Messages::where('id', $request->id)->delete();

        $this->helper->one_time_message('success', 'Deleted Successfully');

        return redirect('admin/messages');
    }
    public function sendEmail(Request $request)
    {

        $message = Messages::find($request->id);
        if (! $request->isMethod('POST')) {
            $data['messages'] = $message;
            return view('admin.bookings.adminmessagesend', $data);
        } else {
            $rules = array(
                'content'                => 'required'
            );

            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput(); 
            } else {
             $request->merge(['property_id' => $message->property_id, 'booking_id' => $message->booking_id, 'receiver_id' => $message->receiver_id, 'sender_id' => $message->sender_id]);
             $this->saveMessages($message,$request);
             $this->helper->one_time_message('success', 'Message successfully updated!.');  
             return redirect('admin/messages');
         }
     }
 }

 /**
* Process of updating message 
*
* @param string $request
*
* @return mixed
*/
public function saveMessages($message,$request)
{
  $message->property_id    = $request->property_id;
  $message->booking_id     = $request->booking_id;
  $message->receiver_id    = $request->receiver_id;
  $message->sender_id      = $request->sender_id;
  $message->message        = $request->content;
  $message->type_id        = $request->type_id;
  
  $message->save();
}
public function hostMessage(Request $request)
{
    $bookings = Bookings::find($request->id);

    $unread   = Messages::where('booking_id',$request->id)->where('receiver_id',$bookings->host_id)->where('read',0)->count();

    if ($unread !=0)
        Messages::where('booking_id',$request->id)->where('receiver_id',$bookings->host_id)->update(['read' =>'1']);

    $data['messages'] = Messages::with('sender','bookings')->where('booking_id',$request->id)->orderBy('created_at','desc')->get();


    $data['Properties'] = Properties::where('host_id',$bookings->host_id)->pluck('name','id');



    if ($data['messages'][0]->bookings->user_id == $bookings->host_id) {

       abort('404');
   }
   
   $data['title'] = 'Conversation';
   return view('admin.bookings.hostmessage', $data);
}
public function reply(Request $request)
{
    $rules = array(
        'message'      => 'required',
    );

    $fieldNames = array(
        'message'      => 'Message',
    );

    $validator = Validator::make($request->all(), $rules);
    $validator->setAttributeNames($fieldNames);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    } else {

        $booking = Bookings::where('id', $request->booking_id)->first();

        $message = new Messages;
        $message->property_id  = $booking->property_id;
        $message->booking_id   = $request->booking_id;
        $message->receiver_id  =$booking->user_id ;
        $message->sender_id    = $booking->host_id;
        $message->message      = $request->message;
        $message->type_id      = 1;

        $message->save();

        return redirect('admin/messaging/host/'.$request->booking_id);
    }

  }

}

