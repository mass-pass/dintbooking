<?php

namespace App\Http\Controllers;

use App\Helpers\VisitorHelper;
use Session;
use DB;

use App\Http\Helpers\Common;

use Illuminate\Http\Request;

use App\Models\{
    Properties,
    SpaceType,
    PropertyType,
    Amenities,
    AmenityType,
    Currency,
    PropertyDates,
    Boat,
    BlockedDate,
    Photo
};

class SearchController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(Request $request)
    {
        $visitorInfo = $request->input('visitor_info');
        $location = $request->input('location');
        if(!empty($visitorInfo) && !empty($location)){
            VisitorHelper::storeSearch($visitorInfo, $location);
        }

        $address  = str_replace(" ", "+", "$location");

        $map_where = 'https://maps.google.com/maps/api/geocode/json?key='.env('GOOGLE_MAP_API_KEY').'&address='.$address.'&sensor=false';
        $geocode  = $this->content_read($map_where);
        $json     = json_decode($geocode);

        if ($json->{'results'}) {
            $data['lat']  = isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'})?$json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'}:0;
            $data['long'] = isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'})?$json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}:0;
        } else {
            $data['lat']  = 0;
            $data['long'] = 0;
        }
        
        $data['location']           = $request->input('location');
        $data['checkin']            = $request->input('checkin');
        $data['checkout']           = $request->input('checkout');
        $data['guest']              = $request->input('guest');
        $data['bedrooms']           = $request->input('bedrooms');
        $data['beds']               = $request->input('beds');
        $data['bathrooms']          = $request->input('bathrooms');
        $data['min_price']          = $request->input('min_price');
        $data['max_price']          = $request->input('max_price');
        
        $data['space_type']         = SpaceType::where('status', 'Active')->pluck('name', 'id');
        $data['property_type']      = PropertyType::where('status', 'Active')->pluck('name', 'id');
        $data['amenities']          = Amenities::where('status', 'Active')->where('category', 'Property')->get();
        $data['amenities_type']     = AmenityType::pluck('name', 'id');

        $data['property_type_selected'] = explode(',', $request->input('property_type'));
        $data['space_type_selected'] = explode(',', $request->input('space_type'));
        $data['amenities_selected'] = explode(',', $request->input('amenities'));
        $currency                   = Currency::where('default', 1)->first();
        $data['currency_symbol']    = $currency->symbol;
        $data['default_min_price'] = $this->helper->convert_currency('USD', '', 1);
        $data['default_max_price'] = $this->helper->convert_currency('USD', '', 1000);

        if (!$data['min_price']) {
            $data['min_price'] = $data['default_min_price'];
            $data['max_price'] = $data['default_max_price'];
        }

        $data['max_price_check'] = $this->helper->convert_currency('', 'USD', $data['max_price']);
          
        return view('search.view', $data);


    }

    function searchResult(Request $request)
    {
        $full_address  = $request->input('location');
        $checkin       = $request->input('checkin');
        $checkout      = $request->input('checkout');
        $guest         = $request->input('guest');
        $bedrooms      = $request->input('bedrooms');
        $beds          = $request->input('beds');
        $bathrooms     = $request->input('bathrooms');
        $property_type = $request->input('property_type');
        $space_type    = $request->input('space_type');
        $amenities     = $request->input('amenities');
        $book_type     = $request->input('book_type');
        $map_details   = $request->input('map_details');
        $min_price     = $request->input('min_price');
        $max_price     = $request->input('max_price');
        if (! $min_price) {
            $min_price = $this->helper->convert_currency('USD', '', 0);
            $max_price = $this->helper->convert_currency('USD', '', 1000);
        }

        if (! is_array($property_type)) {
            if ($property_type != '') {
                $property_type = explode(',', $property_type);
            } else {
                $property_type = [];
            }
        }

        if (! is_array($space_type)) {
            if ($space_type != '') {
                $space_type = explode(',', $space_type);
            } else {
                $space_type = [];
            }
        }

        if (! is_array($book_type)) {
            if ($book_type != '') {
                $book_type = explode(',', $book_type);
            } else {
                $book_type = [];
            }
        }
        if (! is_array($amenities)) {
            if ($amenities != '') {
                $amenities = explode(',', $amenities);
            } else {
                $amenities = [];
            }
        }

        $property_type_val   = [];
        $properties_whereIn  = [];
        $space_type_val      = [];
        
        $address      = str_replace([" ","%2C"], ["+",","], "$full_address");
        $map_where    = 'https://maps.google.com/maps/api/geocode/json?key='.env('GOOGLE_MAP_API_KEY').'&address='.$address.'&sensor=false&libraries=places';
        $geocode      = $this->content_read($map_where);
        $json         = json_decode($geocode);
        
        if ($map_details != '') {
            $map_data=   explode('~', $map_details);
            $minLat     =   $map_data[2];
            $minLong    =   $map_data[3];
            $maxLat     =   $map_data[4];
            $maxLong    =   $map_data[5];
        } else {
            if ($json->{'results'}) {
                $data['lat'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                $data['long'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

                $minLat = $data['lat']-0.35;
                $maxLat = $data['lat']+0.35;
                $minLong = $data['long']-0.35;
                $maxLong = $data['long']+0.35;
            } else {
                $data['lat'] = 0;
                $data['long'] = 0;

                $minLat = -1100;
                $maxLat = 1100;
                $minLong = -1100;
                $maxLong = 1100;
            }
        }

        $users_where['users.status']    = 'Active';

        $checkin  = date('Y-m-d', strtotime($checkin));
        $checkout = date('Y-m-d', strtotime($checkout));
    
        $days     = $this->helper->get_days($checkin, $checkout);
        unset($days[count($days)-1]);

        $calendar_where['date'] = $days;

        $not_available_property_ids = PropertyDates::whereIn('date', $days)->where('status', 'Not available')->distinct()->pluck('property_id');
        $properties_where['properties.accommodates'] = $guest;
        
        $properties_where['properties.status']       = 'Listed';
        
        if ($bedrooms) {
            $properties_where['properties.bedrooms']  = $bedrooms;
        }

        if ($bathrooms) {
            $properties_where['properties.bathrooms'] = $bathrooms;
        }
            
        if ($beds) {
            $properties_where['properties.beds']      = $beds;
        }
        
        if (count($space_type)) {
            foreach ($space_type as $space_value) {
                array_push($space_type_val, $space_value);
            }
            $properties_whereIn['properties.space_type'] = $space_type_val;
        }
        
        if (count($property_type)) {
            foreach ($property_type as $property_value) {
                array_push($property_type_val, $property_value);
            }

            $properties_whereIn['properties.property_type'] = $property_type_val;
        }

        $defaultCurrency = Currency::where(['default' => 1])->first();
        $currency_rate = Currency::where('code', Currency::find(1)->session_code)->first()->rate;

        $max_price_check = $this->helper->convert_currency('', 'USD', $max_price);

        $properties = Properties::with(['property_address' => function ($query) use ($minLat, $maxLat, $minLong, $maxLong) {
        },
                            'property_description',
                            'property_price' => function ($query) use ($min_price, $max_price) {
                                $query->with('currency');
                            },
                            'users'])
                            ->whereHas('property_address', function ($query) use ($minLat, $maxLat, $minLong, $maxLong) {
                                 $query->whereRaw("latitude between $minLat and $maxLat and longitude between $minLong and $maxLong");
                            })
                            ->whereHas('property_price', function ($query) use ($min_price, $max_price, $currency_rate, $max_price_check) {
                                    $query->join('currency', 'currency.code', '=', 'property_price.currency_code');
                                if ($max_price_check >= 750) {
                                    $query->whereRaw('((price / currency.rate) * '.$currency_rate.') >= '.$min_price);
                                } else {
                                    $query->whereRaw('((price / currency.rate) * '.$currency_rate.') >= '.$min_price.' and ((price / currency.rate) * '.$currency_rate.') <= '.$max_price);
                                }
                            })
                            ->whereHas('users', function ($query) use ($users_where) {
                                $query->where($users_where);
                            })
                       ->whereNotIn('id', $not_available_property_ids);
        
        if ($properties_where) {

                foreach ($properties_where as $row => $value) {
                    if ($row == 'properties.accommodates' || $row == 'properties.bathrooms' || $row == 'properties.bedrooms' || $row == 'properties.beds') {
                        $operator = '>=';
                    } else {
                        $operator = '=';
                    }
                    if ($value == '') {
                        $value = 0;
                    }
                    $properties = $properties->where($row, $operator, $value);
                }
        }
      
        if ($properties_whereIn) {
            foreach ($properties_whereIn as $row_properties_whereIn => $value_properties_whereIn) {
                $properties = $properties->whereIn($row_properties_whereIn, array_values($value_properties_whereIn));
            }
        }

        if (count($amenities)) {
            foreach ($amenities as $amenities_value) {
                $properties = $properties->whereRaw('find_in_set('.$amenities_value.', amenities)');
            }
        }

        if (count($book_type) && count($book_type)!=2) {
            foreach ($book_type as $book_value) {
                $properties = $properties->where('booking_type', $book_value);
            }
        }

        $properties = $properties->paginate(Session::get('row_per_page'))->toJson();
        echo $properties;
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

    public function boatSearch(Request $request)
    { 
        $data['title'] = 'Boat Search';
        $location = $request->input('location');
        $address  = str_replace(" ", "+", "$location");
        $map_where = 'https://maps.google.com/maps/api/geocode/json?key='.env('GOOGLE_MAP_API_KEY').'&address='.$address.'&sensor=false';
        $geocode  = $this->content_read($map_where);
        $json     = json_decode($geocode);

        if ($json->{'results'}) {
            $data['lat']  = isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'})?$json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'}:0;
            $data['long'] = isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'})?$json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}:0;
        } else {
            $data['lat']  = 0;
            $data['long'] = 0;
        }
        $data['boat_types'] = array('Motorboat', 'Sailboat', 'RIB', 'Catamaran', 'Houseboat', 'Jet ski', 'Yacht');
        $data['location'] = $request->input('location');
        $data['city'] = $request->input('city');
        $data['boat_date'] = $request->input('boat_date');
        $boatTypes = $request->input('boatTypes') ? $request->input('boatTypes') : array();
        if (! is_array($boatTypes)) {
            if ($boatTypes != '') {
                $data['selected_boat_types'] = explode(',', $boatTypes);
            } 
        } else {
            $data['selected_boat_types'] = $boatTypes;
        }
        $data['num_of_passengers']  = $request->input('num_of_people');
        $data['min_length'] = Boat::min('length');
        $data['max_length'] = Boat::max('length');
        if ($data['min_length'] == $data['max_length']) {
            $data['min_length'] = 1;
        }
        $data['min_speed'] = Boat::min('speed_km_h');
        $data['max_speed'] = Boat::max('speed_km_h');
        if ($data['min_speed'] == $data['max_speed']) {
            $data['min_speed'] = 1;
        }
        $data['min_manufacturer'] = Boat::min('year_of_construction');
        $data['max_manufacturer'] = Boat::max('year_of_construction');
        if ($data['min_manufacturer'] == $data['max_manufacturer']) {
            $data['min_manufacturer'] = 2001;
        }
        $data['min_price'] = Boat::min('price');
        $data['max_price'] = Boat::max('price');
        if ($data['min_price'] == $data['max_price']) {
            $data['min_price'] = 1;
        }
        return view('search.boatView', $data);
    }
    function searchBoatResult(Request $request)
    {   
        $location = $request->input('location');
        $boat_date = $request->input('boat_date');
        $people = $request->input('people');
        $boat_types = $request->input('boat_types');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');
        $min_length = $request->input('min_length');
        $max_length = $request->input('max_length');
        $min_speed = $request->input('min_speed');
        $max_speed = $request->input('max_speed');
        $min_manufacture = $request->input('min_manufacture');
        $max_manufacture = $request->input('max_manufacture');
        $map_details   = $request->input('map_details');
        $cabins   = $request->input('cabins');
        $bathrooms   = $request->input('bathrooms');
        $berths   = $request->input('berths');
        $city   = $request->input('city');
       
      
        if (! is_array($boat_types)) {
            if ($boat_types != '') {
                $boat_types = explode(',', $boat_types);
            } else {
                $boat_types = [];
            }
        }

        $address = str_replace([" ","%2C"], ["+",","], "$location");
        $map_where = 'https://maps.google.com/maps/api/geocode/json?key='.env('GOOGLE_MAP_API_KEY').'&address='.$address.'&sensor=false&libraries=places';
        $geocode = $this->content_read($map_where);
        $json = json_decode($geocode);
        
        if ($map_details != '') {
            $map_data = explode('~', $map_details);
            // $minLat = $map_data[2];
            // $minLong = $map_data[3];
            // $maxLat = $map_data[4];
            // $maxLong = $map_data[5];
        } else {
            if ($json->{'results'}) {
                $data['lat'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                $data['long'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                // $minLat = $data['lat']-0.35;
                // $maxLat = $data['lat']+0.35;
                // $minLong = $data['long']-0.35;
                // $maxLong = $data['long']+0.35;
            } else {
                $data['lat'] = 0;
                $data['long'] = 0;
                // $minLat = -1100;
                // $maxLat = 1100;
                // $minLong = -1100;
                // $maxLong = 1100;
            }
        }
        $boat_date  = date('Y-m-d', strtotime($boat_date));
        if(!empty($boat_date)) {
            $boatIds = BlockedDate::select('blockable_id')
                ->whereDate('start_date', '<=', $boat_date)
                ->whereDate('end_Date', '>=', $boat_date)
                ->where('blockable_type', 'App\Models\Boat')
                ->get();
        } else {
            $boatIds = array();
        }
        
        $boats = Boat::whereHas('address', function($query) use ($location) {
            $query->where('city', 'like', '%' . $location . '%');
        });
        if (!empty($boatIds)) {
            $boats = $boats->whereNotIn('id', $boatIds);
        }

        if (!empty($boat_types)) {
            $boats = $boats->whereIn('boat_type', $boat_types);
        }
        if (!empty($min_price) && !empty($max_price)) {
            $boats = $boats->whereBetween('price', [$min_price, $max_price]);
        }
        if (!empty($min_length) && !empty($max_length)) {
            $boats = $boats->whereBetween('length', [$min_length, $max_length]);
        }
        if (!empty($min_speed) && !empty($max_speed)) {
            $boats = $boats->whereBetween('speed_km_h', [$min_speed, $max_speed]);
        }
        if (!empty($min_manufacture) && !empty($max_manufacture)) {
            $boats = $boats->whereBetween('year_of_construction', [$min_manufacture, $max_manufacture]);
        }
        if (!empty($cabins)) {
            $boats = $boats->where('cabin_count', '>=', $cabins);
        }
        if (!empty($berths)) {
            $boats = $boats->where('berth_count', '>=',$berths);
        }
        if (!empty($bathrooms)) {
            $boats = $boats->where('bathroom_count', '>=', $bathrooms);
        }
       
        
        $boats = $boats->paginate(Session::get('row_per_page'))->toJson();
        
        echo $boats;
        exit;
    }
}
