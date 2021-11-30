<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\{
    Controller,
    EmailController,
    UserController
};
use App\Http\Helpers\Common;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;



use Auth;
use DateTime;
use Session;
use Validator;
use DB;

use App\Models\{
    Properties,
    PropertyDetails,
    PricingInterval,
    PropertyLayout,
    PropertyBreakfast,
    PropertyPhotos,
    PropertyPrice,
    PropertyType,
    PropertyLicence,
    PropertyCredit,
    PropertyLanguage,
    PropertyTimings,
    PropertyCount,
    Propertysmoking,
    PropertyDates,
    PropertyDescription,
    Currency,
    Language,
    SpaceType,
    BedType,
    PropertySteps,
    Country,
    Amenities,
    AmenityType
};

class RatesAvailabiityController extends Controller
{

    public $successStatus = 200;
    public $unAuthorizedStatus = 401;

    protected $helper;
    private $pricing_interval = null;

    public function __construct(PricingInterval $pricing_interval)
    {
        //
        $this->pricing_interval = $pricing_interval;
    }
    /**
     * Partner Dashboard Show By Host 
     *
    */
   public function index()
   {
   }

    public function delete(Request $request, $id){
        $pricing_interval = $this->pricing_interval->find($id);
        $pricing_interval->delete();

       return response()->json(['success'=>true], $this->successStatus);
    }
    
    public function getPricing(Request $request){
        $data = [];
        // create array of dates
        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);
        $period = CarbonPeriod::create($from, $to);
        

        $property_layout = \App\Models\PropertyLayout::find($request->property_layout_id);
        $property = $property_layout->property;

        // since layouts do not have prices attached yet - we're reading prices default from the property
        // this is a hack for the unexplicable case you have a property without a price - only for testing nce you have real data coming in this will no longer apply
        $default_fallback_prices = $property->property_price?$property->property_price->price:100;

        $pricing_intervals = \App\Models\PricingInterval::where('property_layout_id', '=', $property_layout->id)
                                                            ->forDateRange($from, $to)->orderby('start_date', 'asc')->get();

        foreach($period as $one_date){
            $data[$one_date->format('Ymd')] = $default_fallback_prices;
            foreach($pricing_intervals as $pricing_interval){

                if($one_date >=$pricing_interval){  
                    switch($one_date->format('ddd')){
                        case 'Sun':
                            if($pricing_interval->charges_sunday > 0){
                                $data[$one_date->format('Ymd')] = $pricing_interval->charges_sunday;
                            }
                        break;
                        case 'Mon':
                            if($pricing_interval->charges_monday > 0){
                                $data[$one_date->format('Ymd')] = $pricing_interval->charges_monday;
                            }
                        break;
                        case 'Tue':
                            if($pricing_interval->charges_tuesday > 0){
                                $data[$one_date->format('Ymd')] = $pricing_interval->charges_tuesday;
                            }
                        break;
                        case 'Wed':
                            if($pricing_interval->charges_wednesday > 0){
                                $data[$one_date->format('Ymd')] = $pricing_interval->charges_wednesday;
                            }
                        break;
                        case 'Thu':
                            if($pricing_interval->charges_thursday > 0){
                                $data[$one_date->format('Ymd')] = $pricing_interval->charges_thursday;
                            }
                        break;
                        case 'Fri':
                            if($pricing_interval->charges_friday > 0){
                                $data[$one_date->format('Ymd')] = $pricing_interval->charges_friday;
                            }
                        break;
                        case 'Sat':
                            if($pricing_interval->charges_saturday > 0){
                                $data[$one_date->format('Ymd')] = $pricing_interval->charges_saturday;
                            }
                        break;
                    }
                }
            }
        }

        return response()->json(['success'=>['pricing'=>$data, 'property_layout_id'=>$property_layout->id] ], $this->successStatus);


    }

   public function create(Request $request)
   {
       $pricing_interval = new PricingInterval();

        foreach(PricingInterval::ATTRIBUTES as $attrib){
            if(isset($request->$attrib)){
                $pricing_interval->$attrib = $request->$attrib;
            }
        }
       $pricing_interval->priceable_type = $request->priceable_type;
       $pricing_interval->priceable_id = $request->priceable_id;
      

        if(isset($request->property_layout_id)){
            $pricing_interval->priceable_type = "App\Models\PropertyLayout";
            $pricing_interval->priceable_id = $request->property_layout_id;
        }

       $pricing_interval->save();
  

       $data = [];
       $data['pricing_interval'] = $pricing_interval;

       return response()->json(['success'=>$data], $this->successStatus);
    }

    public function getIntervals(Request $request){
        $pricing_intervals = PricingInterval::where('priceable_type', $request->priceable_type)
                                                ->where('priceable_id', $request->priceable_id)->get();
        return response()->json(['success'=>$pricing_intervals], $this->successStatus);
    }


    public function update(Request $request, $id)
    {
        $pricing_interval = PricingInterval::find($id);
 
        $pricing_interval->property_layout_id = $request->property_layout_id;
 
        $pricing_interval->name = $request->name;
        $pricing_interval->start_date = $request->start_date;
        $pricing_interval->end_date = $request->end_date;
        $pricing_interval->min_los = $request->min_los;
        $pricing_interval->max_los = $request->max_los;
        $pricing_interval->closed_arrivals = $request->closed_arrivals;
        $pricing_interval->closed_departure = $request->closed_departure;
        $pricing_interval->extra_charges_additional_guest = $request->extra_charges_additional_guest;
        $pricing_interval->charges_sunday = $request->charges_sunday;
        $pricing_interval->charges_monday = $request->charges_monday;
        $pricing_interval->charges_tuesday = $request->charges_tuesday;
        $pricing_interval->charges_wednesday = $request->charges_wednesday;
        $pricing_interval->charges_thursday = $request->charges_thursday;
        $pricing_interval->charges_friday = $request->charges_friday;
        $pricing_interval->charges_saturday = $request->charges_saturday;
        $pricing_interval->save();
   
 
        $data = [];
        $data['pricing_interval'] = $pricing_interval;
 
        return response()->json(['success'=>$data], $this->successStatus);
     }
 
}
