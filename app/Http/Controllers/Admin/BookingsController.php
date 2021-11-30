<?php

namespace App\Http\Controllers\Admin;

use Validator;
use DB;
use PDF;
use View, Auth,  Session, DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\BookingsDataTable;
use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Helpers\Common;
use App\Http\Controllers\EmailController;

use App\Models\{
    Bookings,
    BookingDetails,
    PropertyType,
    Properties,
    User,
    Messages,
    Currency,
    SpaceType,
    Payouts,
    Settings,
    PayoutSetting,
    Disputes,
    BookingNotes,
    BookingBehaviour
};



class BookingsController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
     
    public function index(BookingsDataTable $dataTable, Request $request)
    {
        $data['from'] = isset(request()->from) ? request()->from : null;
        $data['to']   = isset(request()->to) ? request()->to : null;

        if (isset(request()->property)) {
            $data['properties'] = Properties::where('properties.id', request()->property)->select('id', 'name')->get();
        } else {
            $data['properties'] = null;
        }
        if (isset(request()->customer)) {
            $data['customers'] = User::where('users.id', request()->customer)->select('id', 'first_name', 'last_name')->get();
        } else {
            $data['customers'] = null;
        }

        if (isset(request()->btn)) {
            $status     = request()->status;
            $from       = request()->from;
            $to         = request()->to;
            if (isset(request()->property)) {
                $property    = request()->property;
            } else {
                $property    = null;
            }

            if (isset(request()->customer)) {
                $customer    = request()->customer;
            } else {
                $customer    = null;
            }
        } else {
            $status     = null;
            $property   = null;
            $customer   = null;
            $from       = null;
            $to         = null;
        }

        //Calculating total customers, bookings and total amount in distinct currency
        $total_bookings_initial  = $this->getAllBookings();
        $total_bookings_currency = $this->getAllBookings();

        $total_bookings = $this->getAllBookings();
        $data['total_bookings']  = $total_bookings->get()->count();

        $total_customers_initial = $total_bookings->select('user_id')->distinct();
        $data['total_customers'] =  $total_customers_initial->get()->count();
        
        $different_currency_total_initial  = $total_bookings_currency->select('bookings.currency_code as currency_code', DB::raw('SUM(bookings.total) AS total_amount'))->groupBy('currency_code');
        $different_currency_total = $different_currency_total_initial->get();

        $data['different_total_amounts'] = $this->getDistinctCurrencyTotalWithSymbol($different_currency_total);
         
        if (isset(request()->reset_btn)) {
            $data['from']            = null;
            $data['to']              = null;
            $data['allstatus']       = null;
            $data['allproperties']   = null;
            $data['allcustomers']    = null;
            return $dataTable->render('admin.bookings.view', $data);
        }

        //filtering total bookings, total customers and total amounts in different currecncy
        if ($from) {
            $total_bookings_initial = $total_bookings_initial->whereDate('bookings.created_at', '>=', $from);
            $total_customers_initial = $total_customers_initial->whereDate('bookings.created_at', '>=', $from);
            $different_currency_total_initial = $different_currency_total_initial->whereDate('bookings.created_at', '>=', $from);   
        }
        if ($to) {
            $total_bookings_initial = $total_bookings_initial->whereDate('bookings.created_at', '<=', $to);
            $total_customers_initial = $total_customers_initial->whereDate('bookings.created_at', '<=', $to);
            $different_currency_total_initial = $different_currency_total_initial->whereDate('bookings.created_at', '<=', $to);           
        }                 

        if ($property) {
            $total_bookings_initial = $total_bookings_initial->where('bookings.property_id','=',$property);
            $total_customers_initial = $total_customers_initial->where('bookings.property_id','=',$property);
            $different_currency_total_initial = $different_currency_total_initial->where('bookings.property_id','=',$property);      
        }
        if ($customer) {
            $total_bookings_initial = $total_bookings_initial->where('bookings.user_id','=',$customer);
            $total_customers_initial = $total_customers_initial->where('bookings.user_id','=',$customer);
            $different_currency_total_initial = $different_currency_total_initial->where('bookings.user_id','=',$customer);
        }
        if ($status) {
            $total_bookings_initial  = $total_bookings_initial->where('bookings.status','=',$status);
            $total_customers_initial = $total_customers_initial->where('bookings.status','=',$status);
            $different_currency_total_initial = $different_currency_total_initial->where('bookings.status','=',$status);
        }    
            
        $data['total_bookings']  = $total_bookings_initial->get()->count();
        $data['total_customers'] = $total_customers_initial->get()->count();
        $different_currency_total_initial = $different_currency_total_initial->get();

        if (count($different_currency_total_initial)) {
            $data['different_total_amounts'] = $this->getDistinctCurrencyTotalWithSymbol($different_currency_total_initial);
        }else{
            $data['different_total_amounts'] = NULL;
        }

        isset(request()->property) ? $data['allproperties'] = request()->property : $data['allproperties'] = '';
        isset(request()->customer) ? $data['allcustomers'] = request()->customer : $data['allcustomers'] = '';
        isset(request()->status) ? $data['allstatus'] = request()->status : $data['allstatus'] = '';
        return $dataTable->render('admin.bookings.view', $data);
    }

    /**
     * Get Distinct currency total with symbol
     *
     * @param array $different_currency_total      Distinct currency total
     * @return array $different_total_amounts      Distinct currency total with symbol
     */
    public function getDistinctCurrencyTotalWithSymbol($different_currency_total)
    {
        $different_total_amounts = null;
        foreach ($different_currency_total as $key => $value) {
            $current_currency_symbol = Currency::where('code', $value->currency_code)->select('symbol AS currency_symbol')->first();
            $different_total_amounts[$key]['total'] = moneyFormat($current_currency_symbol->currency_symbol, $value->total_amount);
            $different_total_amounts[$key]['currency_code'] = $value->currency_code;
        }
        return $different_total_amounts;
    }

    public function details(Request $request)
    {

       
         $data['bookings']      = $result    = Bookings::
          leftJoin("property_address as pd","pd.property_id","bookings.property_id")
         ->leftJoin("properties as p","p.id","bookings.property_id")
        ->where('bookings.id', $request->id)
        ->select("bookings.*","p.bedrooms","p.name as pname","pd.address_line_1 as pd_address")->first();
        $data["user"] =  User::find($result->user_id);
        $data["host"] =  User::find($result->host_id);
        
        $data['title']            = 'Payment receipt for';
        $data['url']              = url('/').'/';
        
        $data['bk'] = $data["bookings"];
        $data['payouts']= $payouts = Payouts::whereBookingId($result->id)->whereUserType('Host')->first();
        $property_fees = DB::table("property_fees")->where("field","partner_service_charge")->first()->value;
        $data["commission"]=round(($result->total*$property_fees)/100,2);
        $data['additional_title'] = $request->code;
        $unread   = Messages::where('booking_id',$result->id)->where('receiver_id',$result->host_id)->where('read',0)->count();

    if ($unread !=0)
        Messages::where('booking_id',$result->id)->where('receiver_id',$result->host_id)->update(['read' =>'1']);

    $data['messages'] = Messages::with('sender','bookings','message_type')
          ->where('booking_id',$result->id)->orderBy('created_at','desc')->get();
      
    $data["notes"] = BookingNotes::where('booking_id',$result->id)->orderBy('created_at','desc')->get();
         $data["misconduct"] = BookingBehaviour::
         where('booking_id',$result->id)->orderBy('created_at','desc')->get();
      $data["result"] =$result;
        return view('admin.bookings.detail', $data);
    }
     public function dispute(Request $request)
    {
        
       
        $booking_id      = $request->booking_id;
        $booking         = Bookings::find($booking_id);
        $booking_details = BookingDetails::find($booking_id);
        $dispute_status  = $request->dispute_status;

        if($booking->dispute_status==$dispute_status)
        {
            $this->helper->one_time_message('error', "Nothing is update.Pleae check dispute status");
           return redirect()->back();
        }
        if($booking->dispute_status==0 && $dispute_status==2)
        {
            $this->helper->one_time_message('error', "Please create dispute");
             return redirect()->back(); 
        }
        if(empty($request->message))
        {
            $this->helper->one_time_message('error', "Please enter valid reason");
           return redirect()->back();
        }
        $booking->dispute_status=$dispute_status;
        $booking->save();
        if ($request->message) {
            
        
        $payouts                       = new Disputes;
        $payouts->booking_id           = $booking_id;
        $payouts->from_user            =   Auth::guard('admin')->user()->id;
        $payouts->message              = $request->message;
        
        $payouts->save();
        
        $this->helper->one_time_message('success', 'Dispute updated successfully ');
        return redirect()->back();
       }
    }
   
    public function pay(Request $request)
    {
        $booking_id      = $request->booking_id;
        $booking         = Bookings::find($booking_id);
        $booking_details = BookingDetails::find($booking_id);

        $data['currency_default'] = Currency::where('default', 1)->first();
        $default_currency = $data['currency_default']->code;
        $companyName = Settings::where(['type' => 'general', 'name' => 'name'])->first(['value'])->value;

        if ($request->user_type == 'guest') {
            $payout_email       = $booking->guest_account;
            $amount             = $booking->original_guest_payout;
            $payout_user_id     = $booking->user_id;
            $payout_id          = $request->guest_payout_id;
            $guestPayout        = ($companyName.': ' .'Your payout amount is'.' '.$booking->currency->code .' '.$amount);
            twilioSendSms($booking->users->formatted_phone, $guestPayout);
        } else if ($request->user_type == 'host') {
            $payout_email              = $booking->host_account;
            $amount                    = $booking->original_host_payout;
            $payout_user_id            = $booking->host_id;
            $payout_id                 = $request->host_payout_id;
            $hostPayout                = ($companyName.': ' .'Your payout amount is'.' '.$booking->currency->code.' '.$amount);
            twilioSendSms($booking->users->formatted_phone, $hostPayout);
        } else {
            return redirect('admin/bookings/detail/'.$booking_id);
        }
        
        $payouts                       = Payouts::find($payout_id);
        $payouts->booking_id           = $booking_id;
        $payouts->property_id          = $booking->property_id;
        $payouts->amount               = $amount;
        $payouts->currency_code        = $default_currency;
        $payouts->user_type            = $request->user_type;
        $payouts->user_id              = $payout_user_id;
        $payouts->account              = $payout_email;
        $payouts->status               = 'Completed';
        $payouts->save();
        $email = new EmailController;
        $email->payout_sent($booking_id);
        $this->helper->one_time_message('success', ucfirst($request->user_type).' payout amount successfully marked as paid');
        return redirect('admin/bookings/detail/'.$booking_id);
    }

    public function needPayAccount(Request $request, EmailController $email)
    {
        $type = $request->type;
        $email->need_pay_account($request->id, $type);

        $this->helper->one_time_message('success', 'Email sent Successfully');
        return redirect('admin/bookings/detail/'.$request->id);
    }

    public function searchProperty(Request $request)
    {
        $str = $request->term;
        
        if ($str == null) {
            $myresult = Properties::where('status', 'Listed')->select('id', 'name')->take(5)->select('properties.id', 'properties.name AS text')->get();
        } else {
            $myresult = Properties::where('properties.name', 'LIKE', '%'.$str.'%')->select('properties.id', 'properties.name AS text')->get();
        }

        if ($myresult->isEmpty()) {
            $myArr = null;
        } else {
            $arr2 = array(
                "id"   => "",
                "text" => "All"
              );
              $myArr[] = ($arr2);
            foreach ($myresult as $result) {
                $arr = array(
                  "id"   => $result->id,
                  "text" => $result->text
                );
                $myArr[] = ($arr);
            }
        }
        return $myArr;
    }

    public function searchCustomer(Request $request)
    {
        $str = $request->term;
        
        if ($str == null) {
            $myresult = User::select('id', 'first_name', 'last_name')->take(5)->get();
        } else {
            $myresult = User::where('users.first_name', 'LIKE', '%'.$str.'%')->orWhere('users.last_name', 'LIKE', '%'.$str.'%')->select('users.id', 'users.first_name', 'users.last_name')->get();
        }

        if ($myresult->isEmpty()) {
            $myArr = null;
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

    public function bookingCsv($id = null)
    {
        return Excel::download(new BookingsExport, 'booking_sheet' . time() .'.xls');
    }

    public function bookingPdf($id = null)
    {
        $to                   = setDateForDb(request()->to);
        $from                 = setDateForDb(request()->from);
        $data['companyLogo']  = $logo  = Settings::where('name', 'logo')->select('value')->first();
       
        if ($logo->value==null) {
            $data['logo_flag'] = 0;
        } elseif (!file_exists("front/images/logos/$logo->value")) {
            $data['logo_flag'] = 0;
        }
        $data['status']     = $status   = isset(request()->status) ? request()->status : null;
        $data['property']   = $property = isset(request()->property) ? request()->property : null;
        $data['customer']   = $customer = isset(request()->customer) ? request()->customer : null;
        $bookings           = $this->getAllBookings();
        if (isset($id)) {
            $bookings->where('bookings.user_id', '=', $id);
        }
        if ($from) {
            $bookings->whereDate('bookings.created_at', '>=', $from);
        }
        if ($to) {
            $bookings->whereDate('bookings.created_at', '<=', $to);
        }
        if ($property) {
            $bookings->where('bookings.property_id', '=', $property);
        }
        if ($customer) {
            $bookings->where('bookings.user_id', '=', $customer);
        }
        if ($status) {
            $bookings->where('bookings.status', '=', $status);
        }
        if ($from && $to) {
            $data['date_range'] = onlyFormat($from) . ' To ' . onlyFormat($to);
        }
                    
        $data['bookingList'] = $bookings->get();

        $pdf = PDF::loadView('admin.bookings.list_pdf', $data, [], [
            'format' => 'A3', [750, 1060]
          ]);
        return $pdf->download('booking_list_' . time() . '.pdf', array("Attachment" => 0));
    }

    public function getAllBookings()
    {
        $allBookings = Bookings::join('properties', function ($join) {
            $join->on('properties.id', '=', 'bookings.property_id');
        })
        ->join('users', function ($join) {
                $join->on('users.id', '=', 'bookings.user_id');
        })
        ->join('currency', function ($join) {
                $join->on('currency.code', '=', 'bookings.currency_code');
        })
        ->leftJoin('users as u', function ($join) {
                $join->on('u.id', '=', 'bookings.host_id');
        })
        ->select(['bookings.id as id', 'u.first_name as host_name', 'users.first_name as guest_name', 'properties.name as property_name', DB::raw('CONCAT(currency.symbol, bookings.total) AS total_amount'), 'bookings.status', 'bookings.created_at as created_at', 'bookings.updated_at as updated_at', 'bookings.start_date', 'bookings.end_date', 'bookings.guest', 'bookings.host_id', 'bookings.user_id', 'bookings.total', 'bookings.currency_code', 'bookings.service_charge', 'bookings.host_fee']);
        return $allBookings;
    }

    public function getAllBookingsCSV()
    {
        $allBookings = Bookings::join('properties', function ($join) {
            $join->on('properties.id', '=', 'bookings.property_id');
        })
        ->join('users', function ($join) {
                $join->on('users.id', '=', 'bookings.user_id');
        })
        ->join('currency', function ($join) {
                $join->on('currency.code', '=', 'bookings.currency_code');
        })
        ->leftJoin('users as u', function ($join) {
                $join->on('u.id', '=', 'bookings.host_id');
        })
        ->select(['bookings.id as id', 'u.first_name as host_name', 'users.first_name as guest_name', 'properties.name as property_name', DB::raw('bookings.total AS total_amount'), 'bookings.currency_code as currency_name','bookings.status', 'bookings.created_at as created_at', 'bookings.updated_at as updated_at', 'bookings.start_date', 'bookings.end_date', 'bookings.guest', 'bookings.host_id', 'bookings.user_id', 'bookings.total', 'bookings.currency_code', 'bookings.service_charge', 'bookings.host_fee'])
        ->orderBy('bookings.id', 'desc');
        return $allBookings;
    }
}
