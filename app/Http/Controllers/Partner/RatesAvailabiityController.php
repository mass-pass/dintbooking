<?php

namespace App\Http\Controllers\partner;

use App\Http\{
    Helpers\Common,
    Controllers\Controller,
    Requests
};
use App\Models\{
    Properties,
    PropertyDetails,
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
    private $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }


    /**
     * Partner Dashboard Show By Host 
     *
    */
   public function index(Properties $property = null)
   {
        $data = [];
        if ($property) {
            $data["current_property_id"] = $property->id;
        } else {
            return selectPropertyFirst();
        }
        $data['title'] = 'Rates and Availability';
        $property_layouts = PropertyLayout::where('property_id', $property->id)->get();
        $data['property_layouts'] = $property_layouts;
        
        return view('partner.rates-availability.index', $data);
   }

   public function photos()
   {
       $data['title'] = 'Settings';
       $property= Properties::where('host_id', \Auth::id())->first();
       if(!$property){
           abort(404);
       }

       $data = [];
       $property_id = $property->id;
       $data['property'] = $property;
       $data['details'] = PropertyDetails::pluck('value', 'field');

       return view('partner.property.photo', $data);
   }
}
