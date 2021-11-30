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

class SettingsController extends Controller
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
   public function index()
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

       return view('partner.settings', $data);
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
