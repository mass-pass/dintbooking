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
    Bookings,
    Discount
};

use Auth;
use DateTime;
use Session;
use Validator;
use DB;

class BookingsController extends Controller
{
    public $successStatus = 200;
    public $unAuthorizedStatus = 401;

    protected $helper;

    private $booking;

    public function __construct(Bookings $booking)
    {
        //
        $this->booking = $booking;
    }

    public function create(Request $request){
        $booking = new Bookings;
        $user = \App\Models\User::where('email', '=', $request->guest['email'])->first();
        if(!$user){
            $user             = new User();
            $user->first_name = $request->guest['first_name'];
            $user->last_name  = $request->guest['last_name'];
            $user->email      = $request->guest['email'];
            $user->phone      = $request->guest['phone'];
            $user->user_type_id      = 1;
            $user->status     = 'Active';
            $user->save();

            $attribs = [
                "dob" => "date_of_birth",
                "gender" => "gender",
                "tax_id_no" => "tax_id_no",
                "company_name" => "company_name",
                "company_tax_id_no" => "company_tax_id_no",
                "address_1" => "address_1",
                "address_2" => "address_2",
                "city" => "city",
                "country" => "country",
                "state" => "state",
                "country_name" => "country_name",
                "zip" => "zip"];
            foreach($attribs as $ii=>$vv){
                if($request->guest['$ii'] == ''){
                    continue;
                }
                $user_details          = new \App\Models\UserDetails();
                $user_details->user_id = $user->id;
                $user_details->field   = $vv;
                $user_details->value   = $request->guest[$ii];
                $user_details->save();
            }
        }

        foreach($request->layouts as $oneLayout){
            if(is_null($oneLayout)){
                continue;
            }
            // find user by email
            $booking->property_id       = $oneLayout['item']['property_id'];
            $booking->host_id           = $oneLayout['item']['property']['host_id'];
            $booking->user_id           = $user->id;
            $booking->start_date        = $request->start_date;
            $booking->end_date          = $request->end_date;
            $booking->guest             = $oneLayout['count_adults'];
            $booking->total_night       = $request->days;
            $booking->per_night         = $oneLayout['item']['property_price']['original_price'];
    
            $booking->custom_price_dates = null;
            $booking->currency_code     = $oneLayout['item']['property_price']['currency_code'];

            $booking->base_price        = $oneLayout['item']['property_price']['original_price'] * $request->days;
            $booking->cleaning_charge   = $oneLayout['item']['property_price']['cleaning_fee'];
            $booking->guest_charge      = $oneLayout['item']['property_price']['guest_fee'];
            $booking->security_money    = $oneLayout['item']['property_price']['security_fee'];
            $booking->service_charge    = 0;
            $booking->host_fee          = 0;
            $booking->total             = $booking->host_fee +  $booking->service_charge + $booking->security_money + $booking->service_charge + $booking->host_fee;
    
            $booking->transaction_id    = " ";
            $booking->payment_method_id = " ";
            $booking->cancellation      = \App\Models\Properties::find($booking->property_id)->cancellation;
            $booking->status            = 'Accepted';
            $booking->booking_type      ='instant';
            $booking->save();
            
            
        }

        return response()->json(['success'=>$user], $this->successStatus);

    }

    public function get(Request $request){

    }

    public function checkAvailability(Request $request)
    {
        $currentPropertyId = $request->input('currentPropertyId', false);
        $layouts = \App\Models\PropertyLayout::where('property_id', $currentPropertyId)->get();
        $data = array();
        foreach($layouts as $layout){
            $row = $layout;
            $row['property'] = $layout->property;
            $row['property_price'] = $layout->property->property_price;
            $data[] = $row;
        }
        $success = [];
        $success['bookables'] =  $data;
        $days = round((strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24));

        $success['availablity'] = array('start_date'=>$request->start_date, 'days'=>$days, 'end_date'=>$request->end_date);
        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function addBlockedDates(Request $request){
        $blocked_date = new \App\Models\BlockedDate();

        $blocked_date->start_date = $request->start_date;
        $blocked_date->end_date = $request->end_date;

        $blocked_date->blockable_type = $request->blockable_type;
        $blocked_date->blockable_id = $request->blockable_id;
        $blocked_date->notes = $request->notes;
        $blocked_date->save();
        return response()->json(['success'=>['blocked_dates'=>$blocked_date]], $this->successStatus);

    }

    public function deleteBlockedDates(Request $request, $id){
        $blocked_date = \App\Models\BlockedDate::find($id);

        $blocked_date->delete();

        return response()->json(['success'=>true], $this->successStatus);

    }

    public function getBlockedDates(Request $request){
        $blocked_dates = \App\Models\BlockedDate::where('blockable_type', $request->blockable_type)
                                    ->where('blockable_id', $request->blockable_id)->get();


        return response()->json(['success'=>$blocked_dates], $this->successStatus);

    }


    public function addDiscount(Request $request){
        $discount = new \App\Models\Discount();
        foreach(Discount::ATTRIBUTES as $attrib){
            if(isset($request->$attrib)){
                $discount->$attrib = $request->$attrib;
            }
        }
        $discount->discountable_type = $request->discountable_type;
        $discount->discountable_id = $request->discountable_id;

        $discount->save();
        return response()->json(['success'=>['discount'=>$discount]], $this->successStatus);

    }

    public function deleteDiscount(Request $request, $id){
        $blocked_date = \App\Models\Discount::find($id);

        $blocked_date->delete();

        return response()->json(['success'=>true], $this->successStatus);

    }

    public function getDiscounts(Request $request){
        $discounts = \App\Models\Discount::where('discountable_type', $request->discountable_type)
                                    ->where('discountable_id', $request->discountable_id)->get();


        return response()->json(['success'=>$discounts], $this->successStatus);

    }

}