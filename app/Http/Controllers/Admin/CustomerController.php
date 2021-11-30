<?php


namespace App\Http\Controllers\Admin;

use PDF;
use DB;
use Session;
use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Common;
use App\Http\Controllers\EmailController;

use App\Exports\CustomersExport;

use App\DataTables\{
    CustomerDataTable,
    PropertyDataTable,
    BookingsDataTable,
    PayoutsDataTable,
    WalletsDataTable,
    RewardsDataTable
};

use App\Models\{
    User,
    UsersVerification,
    Wallet,
    Properties,
    SpaceType,
    Settings,
    Accounts,
    Country,
    Bookings,
    UserType
};


use Maatwebsite\Excel\Facades\Excel;
use Twilio\Rest\Client;


class CustomerController extends Controller
{
    protected $helper; 

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(CustomerDataTable $dataTable)
    {
        $data['from'] = isset(request()->from) ? request()->from : null;
        $data['to']   = isset(request()->to) ? request()->to : null;
             
        if (isset(request()->customer)) {
            $data['customers'] = User::where('users.id', request()->customer )->select('id', 'first_name', 'last_name')->get();
        } else {
            $data['customers'] = null;
        }

        if (isset(request()->reset_btn)) {
            $data['from']        = null;
            $data['to']          = null;
            $data['allstatus']   = '';
            $data['allcustomers']   = '';
            return $dataTable->render('admin.customers.view', $data);
        }
        $pref = Settings::where('type', 'preferences')->get();
        if (! empty($pref)) {
            foreach ($pref as $value) {
                $prefer[$value->name] = $value->value;
            }
            Session::put($prefer);
        }

        isset(request()->customer) ? $data['allcustomers'] = request()->customer : $data['allcustomers']    = '';
        isset(request()->status) ? $data['allstatus'] = $allstatus = request()->status : $data['allstatus'] = $allstatus = '';

        return $dataTable->render('admin.customers.view', $data);
    }

    public function searchCustomer(Request $request)
    {   
        $str = $request->term;
        
        if($str == null) {
            $myresult = User::select('id', 'first_name', 'last_name')->take(5)->get();
        } else {
            $myresult = User::where('users.first_name', 'LIKE', '%'.$str.'%')->orWhere('users.last_name', 'LIKE', '%'.$str.'%')->select('users.id','users.first_name', 'users.last_name')->get();  
        }

        if($myresult->isEmpty()) {
            $myArr=null;
        } else {
            $arr2 = array(
                "id"   => "",
                "text" => "All"
              );
              $myArr[] = ($arr2);
            foreach ($myresult as $result) {
                $arr = array(
                  "id"   => $result->id,
                  "text" => $result->first_name." ".$result->last_name
                );
                $myArr[] = ($arr);  
            }
        }
        return $myArr;
    }

    public function add(Request $request, EmailController $email_controller)
    {
        if (! $request->isMethod('post')) {
            return view('admin.customers.add');
        } elseif ($request->isMethod('post')) {
            $rules = array(
                'first_name'    => 'required|max:255',
                'last_name'     => 'required|max:255',
                'email'         => 'required|max:255|email|unique:users',
                'password'      => 'required|min:6'
            );

            $fieldNames = array(
                'first_name'    => 'First_name',
                'last_name'     => 'Last_name',
                'email'         => 'Email',
                'password'      => 'Password'
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames); 

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput(); 
            } else {
                $user                  = new User;
                $user->first_name      = $request->first_name;
                $user->last_name       = $request->last_name;
                $user->email           = $request->email;
                $user->password        = \Hash::make($request->password);
                $user->status          = $request->status;
                $user->profile_image   = NULL;
                $formattedPhone        = str_replace('+' . $request->carrier_code, "", $request->formatted_phone);
                $user->phone           = !empty($request->phone) ? preg_replace("/[\s-]+/", "", $formattedPhone) : NULL;
                $user->default_country = isset($request->default_country) ? $request->default_country : NULL;
                $user->carrier_code    = isset($request->carrier_code) ? $request->carrier_code : NULL;
                $user->formatted_phone = isset($request->formatted_phone) ? $request->formatted_phone : NULL;
                  $user->save();


                $user_verification           = new UsersVerification;
                $user_verification->user_id  =   $user->id;
                $user_verification->save();
                $this->wallet($user->id);
                $email_controller->welcome_email($user);
                $this->helper->one_time_message('success', 'Added Successfully');

                return redirect('admin/customers');
            }
        }
    }

    public function ajaxCustomerAdd(Request $request, EmailController $email_controller)
    { 
        $data = [];
        if($request->isMethod('post')) {
            $rules = array(
                'first_name'    => 'required|max:255',
                'last_name'     => 'required|max:255',
                'email'         => 'required|max:255|email|unique:users',
                'password'      => 'required|min:6'
            );

            $fieldNames = array(
                'first_name'    => 'First_name',
                'last_name'     => 'Last_name',
                'email'         => 'Email',
                'password'      => 'Password'
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames); 

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput(); 
            } else  {
            $user                  = new User;
            $user->first_name      = $request->first_name;
            $user->last_name       = $request->last_name;
            $user->email           = $request->email;
            $user->password        = \Hash::make($request->password);
            $user->status          = $request->status;
            $user->profile_image   = NULL;
            $formattedPhone        = str_replace('+' . $request->carrier_code, "", $request->formatted_phone);
            $user->phone           = !empty($request->phone) ? preg_replace("/[\s-]+/", "", $formattedPhone) : NULL;
            $user->default_country = isset($request->default_country) ? $request->default_country : NULL;
            $user->carrier_code    = isset($request->carrier_code) ? $request->carrier_code : NULL;
            $user->formatted_phone = isset($request->formatted_phone) ? $request->formatted_phone : NULL;
            $user->save();
            $this->wallet( $user->id);

            $user_verification           = new UsersVerification;
            $user_verification->user_id  =   $user->id;
            $user_verification->save();

            $data = ['status' => 1,'user' => $user];
        }
        return $data;
     }
   }
    public function customerProperties(PropertyDataTable $dataTable, $id)
    {
        $data['properties_tab'] = 'active';
        $data['user'] = DB::table('users')->where('id',$id)->first();

        $data['from'] = isset(request()->from) ? request()->from:null;
        $data['to']   = isset(request()->to) ? request()->to:null;
        $data['space_type_all'] = SpaceType::all('id','name');

        
        if (isset(request()->reset_btn)) {
            $data['from']        = null;
            $data['to']          = null;
            $data['allstatus']   = '';
            $data['allSpaceType']   = '';
            return $dataTable->render('admin.customerdetails.properties',$data);
        }
        isset(request()->status) ? $data['allstatus'] = $allstatus = request()->status : $data['allstatus'] = $allstatus = '';
        isset(request()->space_type) ? $data['allSpaceType'] = request()->space_type : $data['allSpaceType']  = '';

        return $dataTable->render('admin.customerdetails.properties',$data);

    }

    public function customerBookings(BookingsDataTable $dataTable, $id)
    {
        $data['bookings_tab'] = 'active';
        $data['user']         = DB::table('users')->where('id',$id)->first();

        $data['from'] = isset(request()->from)?request()->from:null;
        $data['to'] = isset(request()->to)?request()->to:null;
        if (isset(request()->property)) {
            $data['properties'] = Properties::where('properties.id',request()->property )->select('id', 'name')->get();
        } else {
            $data['properties'] = null;
        }
        if (isset(request()->reset_btn)) {
            $data['from']        = null;
            $data['to']          = null;
            $data['allstatus']   = '';
            $data['allproperties']   = '';
            return $dataTable->render('admin.customerdetails.bookings', $data);
        }
 
        isset(request()->property) ? $data['allproperties'] = request()->property : $data['allproperties'] = '';
        isset(request()->status) ? $data['allstatus'] = request()->status : $data['allstatus'] = '';
        return $dataTable->render('admin.customerdetails.bookings', $data);

    }

    public function customerRewards(RewardsDataTable $dataTable,$id){
        $data = [];

        $data['rewards_tab'] = 'active';
        $data['user'] = \App\User::find($id);
        $data['from'] = isset(request()->from)?request()->from:null;
        $data['to'] = isset(request()->to)?request()->to:null;

        isset(request()->status) ? $data['status'] = request()->status : $data['status'] = '';

        $data['total_points'] = $data['user']->totalPoints();

        $data['total_matured_points'] = $data['user']->totalMaturedPoints();
        if (isset(request()->reset_btn)) {
            $data['from'] = null;
            $data['to'] = null;
            $data['status'] = '';
            return $dataTable->render('admin.customerdetails.rewards', $data);
        }


        return $dataTable->render('admin.customerdetails.rewards', $data);
    }

    public function customerPayouts(PayoutsDataTable $dataTable, $id)
    {
        $data['payouts_tab'] = 'active';
        $data['user'] = DB::table('users')->where('id',$id)->first();

        $data['from'] = isset(request()->from)?request()->from:null;
        $data['to'] = isset(request()->to)?request()->to:null;
        if (isset(request()->property)) {
            $data['properties'] = Properties::where('properties.id',request()->property )->select('id', 'name')->get();
        } else {
            $data['properties'] = null;
        }

        if (isset(request()->reset_btn)) {
            $data['from']        = null;
            $data['to']          = null;
            $data['allstatus']   = '';
            $data['alltypes']   = '';
            $data['allproperties']   = '';
            return $dataTable->render('admin.customerdetails.payouts', $data);
        }
        isset(request()->property) ? $data['allproperties'] = request()->property : $data['allproperties'] = '';
        isset(request()->status) ? $data['allstatus'] = request()->status : $data['allstatus'] = '';
        isset(request()->types) ? $data['alltypes'] = request()->types : $data['alltypes'] = '';

        return $dataTable->render('admin.customerdetails.payouts', $data);
    }

    public function paymentMethods($id)
    {
        $data['payment_methods_tab'] = 'active';
        $data['user'] = DB::table('users')->where('id',$id)->first();

        $data['payouts']  = Accounts::where('user_id', $id)->orderBy('id','desc')->get();
        $data['country']  = Country::all()->pluck('name','short_name');

        return view('admin.customerdetails.payment_methods', $data);
    }

    public function update(Request $request)
    {
        $data['user'] = DB::table('users')->where('id',$request->id)->first();  
        $data['user_types']   = UserType::all();
        
        if (! $request->isMethod('post')) { 
            $data['customer_edit_tab'] = 'active';
            return view('admin.customers.edit', $data);
            
        } else if($request->isMethod('post')) {
            $rules = array(
                'first_name'    => 'required|max:255',
                'last_name'     => 'required|max:255',
                'email'       => 'required|max:255|email|unique:users,email,'.$data['user']->id,

            );
             $messages = array(
                'email' => 'Email already existed.',
                
            );
         

            $fieldNames = array(
                'first_name'    => 'First Name',
                'last_name'     => 'Last Name',
                 'email'        => 'Email',

            );

            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->setAttributeNames($fieldNames); 

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $user                  = User::find($request->customer_id);
                $user->first_name      = $request->first_name;
                $user->last_name       = $request->last_name;
                $user->email           = $request->email;
                $user->status          = $request->status;
                $user->user_type_id    = $request->user_type_id;
                $user->profile_image   = NULL;
                $formattedPhone        = str_replace('+' . $request->carrier_code, "", $request->formatted_phone);
                $user->phone           = !empty($request->phone) ? preg_replace("/[\s-]+/", "", $formattedPhone) : NULL;
                $user->default_country = isset($request->default_country) ? $request->default_country : NULL;
                $user->carrier_code    = isset($request->carrier_code) ? $request->carrier_code : NULL;
                $user->formatted_phone = isset($request->formatted_phone) ? $request->formatted_phone : NULL;
                if ($request->password != '')
                    $user->password = bcrypt($request->password);
                $user->save();

                $this->helper->one_time_message('success', 'Updated Successfully');
                return redirect('admin/customers');
            }
        }
    }
    public function delete(Request $request)
    {
        $properties = Properties::where(['host_id' => $request->id])->get()->toArray();
        $bookings   = Bookings::where(['user_id' => $request->id])->get()->toArray();
        if (env('APP_MODE', '') != 'test') {
            if ((count($properties)) && (count($bookings)) > 0) {
                $this->helper->one_time_message('danger', 'Customer have properties and bookings.Sorry can not possible to delete.');                
            } else if (count($properties) > 0) {
                $this->helper->one_time_message('danger', 'Customer have properties.Sorry can not possible to delete.'); 
            } else if (count($bookings) > 0) {  
                $this->helper->one_time_message('danger', 'Customer have bookings.Sorry can not possible to delete.'); 
            } else {
                $user = User::find($request->id);
                if (!empty($user)) {
                    $user->delete();
                    $this->helper->one_time_message('success', 'Deleted Successfully');                    
                } else {
                    $this->helper->one_time_message('success', 'Deleted Successfully');                    
                }
            }
        }

        return redirect('admin/customers');
    }

    public function customerCsv()
    {
        return Excel::download(new CustomersExport, 'customer_sheet' . time() .'.xls');
    }

    public function customerPdf()
    {
        $to                   = setDateForDb(request()->to);
        $from                 = setDateForDb(request()->from);
        $data['companyLogo']  = $logo  = Settings::where('name','logo')->select('value')->first();
        $customer             = isset(request()->customer) ? request()->customer : 'null';
       
        
        if($logo->value==null) {
            $data['logo_flag'] = 0;
        } else if (!file_exists("front/images/logos/$logo->value")) {
            /* if 'logo_flag' is 0 then
            in pdf there will be a default error image */
            $data['logo_flag'] = 0;
        }
        $data['status']     = $status = isset(request()->status) ? request()->status : 'null';
        $query= User::orderBy('id', 'desc')->select();

        if ($from) {
            $query->whereDate('created_at', '>=', $from);             
        }
        if ($to) {
            $query->whereDate('created_at', '<=', $to);             
        }               
        if($status){
            $query->where('status','=',$status);
        }
        if($customer){
            $query->where('id','=',$customer);
        }
        if($from && $to){
          $data['date_range'] = onlyFormat($from) . ' To ' . onlyFormat($to);  
        }
        $data['customerList'] = $query->get();
        $pdf = PDF::loadView('admin.customers.list_pdf', $data, [], [
            'format' => 'A3', [750, 1060]
          ]);
          
        return $pdf->download('customer_list_' . time() . '.pdf', array("Attachment" => 0));
    }



    public function getCurrentCustomerDetails(Request $request) 
    {
        $data        = [];
        $userDetails = User::find($request->customer_id)->makeHidden(['created_at', 'updated_at', 'status', 'profile_image', 'balance', 'profile_src']);
        if ($userDetails->exists()) {
            $data['status']      = true;
            $data['userDetails'] = $userDetails;
        } else {
            $data['status']      = false;
        }
        return $data;
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
      public function customerWallet(WalletsDataTable $dataTable, $id)
    {

        $data['wallet']      = 'active';
        $data['user']         = DB::table('users')->where('id',$id)->first();
       
        return $dataTable->render('admin.customerdetails.wallets', $data);

    }
}

