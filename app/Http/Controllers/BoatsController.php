<?php

namespace App\Http\Controllers;

use App\Helpers\PropertyHelper;
use App\Http\Requests\PropertyRequest;
use Cache;
use Auth;
use DB, Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Storage;
use Session;

use App\Http\Helpers\Common;
use App\Http\Controllers\CalendarController;
use Illuminate\Http\Request;
use Validator;

use App\Models\{
    Boat,
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
    PropertyCategory,
    Currency,
    Language,
    SpaceType,
    BedType,
    PropertySteps,
    Country,
    Amenities,
    AmenityType
};


class BoatsController extends Controller
{
    public function __construct()
    {
        $this->helper = new Common;
    }

    public function new(Request $request){
        $data = array();
        $data['title'] = 'Boat Registration';

        $data['boat_types'] = \App\Models\Boat::TYPES;
        $data['languages'] = getLanguagesList();
        asort($data['languages']);
        $data['amenity_types'] =  \App\Models\AmenityType::with('boat_amenities')->get();
        return view('boats.new', $data);
    }

    public function single(Request $request, $slug)
    {
        $data['title'] = $slug;
        $data['boat_date'] = $request->input('boat_date');
        $data['result'] = Boat::join('users', function ($join) {
                            $join->on('boats.owner_id', '=', 'users.id');
                        })->where('slug', $slug)->firstOrFail();
                        
        $data['discounts'] = Boat::leftJoin('discounts', function ($join) {
                                $join->on('boats.id', '=', 'discounts.discountable_id');
                                $join->where('discounts.discountable_type', 'App\Models\Boat');
                            })->where('slug', $slug)->get();
                       
        $data['boat_id'] = $data['result']->id;
        $address = ($data['result']->address) ? $data['result']->address->city : '';
       
        $map_where = 'https://maps.google.com/maps/api/geocode/json?key='.env('GOOGLE_MAP_API_KEY').'&address='.$address.'&sensor=false';
        $geocode  = $this->content_read($map_where);
        $json     = json_decode($geocode);
       
        if (!empty($json->{'results'})) {
            $data['lat']  = isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'})?$json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'}:0;
            $data['long'] = isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'})?$json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}:0;
        } else {
            $data['lat']  = 0;
            $data['long'] = 0;
        }
       
        return view('boats.single', $data);
    }

    public function content_read($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result=curl_exec($ch);
        curl_close($ch);

        return $result;
    }
    
}