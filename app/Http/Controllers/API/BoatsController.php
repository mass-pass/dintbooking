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
    Boat,
    Address
};

use Auth;
use DateTime;
use Session;
use Validator;
use DB;

class BoatsController extends Controller
{
    public $successStatus = 200;
    public $unAuthorizedStatus = 401;

    protected $helper;

    private $boat;

    public function __construct(Boat $boat)
    {
        //
        $this->boat = $boat;
    }

    public function create(Request $request){
        $boat = new Boat();

        $boat->boat_type = $request->boat_type;
        $boat->owner_id = $request->owner_id;
        $boat->slug = $request->slug;
        $boat->is_owner_professional = $request->is_owner_professional;
        $boat->manufacturer = $request->manufacturer;
        $boat->model = $request->model;
        $boat->is_rented_with_captain = $request->is_rented_with_captain;
        $boat->name = $request->name;
        $boat->save();
        $city =$request->city;
        $address_line_1 =$request->address_line_1;
      

        $address1      = str_replace([" ","%2C"], ["+",","], "$city");
        $map_where    = 'https://maps.google.com/maps/api/geocode/json?key='.env('GOOGLE_MAP_API_KEY').'&address='.$address1.'&sensor=false&libraries=places';
        $geocode      = $this->content_read($map_where);
        $json         = json_decode($geocode);
        if ($json->{'results'}) {
            $data['lat'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            $data['long'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        } else {
            $data['lat'] = 0;
            $data['long'] = 0;

        }

        $address = new Address([
            'city' => $request->city,
            'longitude' =>$data['long'] ,
            'latitude' => $data['lat'] ,
            'address_line_1' =>  $address_line_1 ,
        ]);
        $boat->address()->save($address);

        return response()->json(['success' => $boat ], $this->successStatus);

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

    public function update(Request $request, $id){

        $boat = $this->boat->find($id);
        $attribs = array(
            'boat_type', 'owner_id', 'city', 'harbour', 'harbour_other', 'is_owner_professional', 'manufacturer', 'model',
            'is_rented_with_captain', 'name', 'title', 'descripton', 'authorised_onboard_capacity', 'recommended_onboard_capacity',
            'cabin_count', 'berth_count', 'bathroom_count', 'length', 'fuel_consumption_ga_h', 'speed_km_h', 
            'year_of_construction', 'year_of_renovation', 'insurance_security_deposit', 'insurance_certificate_file', 
            'is_insured', 'price', 'languages', 'photos', 'amenities'
        );

        foreach($attribs as $attrib){
            if(isset($request->$attrib)) {
                if ($attrib == 'city') {
                    $address = $boat->address;
                    $address->city = $request->$attrib;
                    $address->save();
                } else {
                    $boat->$attrib = $request->$attrib;
                }

            }
        }

        $boat->save();
        return response()->json(['success'=>$boat], $this->successStatus);
    }

    public function get(Request $request){

    }

}