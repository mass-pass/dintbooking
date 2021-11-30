<?php

namespace App\Http\Controllers\partner;

use App\Models\PartnerAmenities;
use Illuminate\Http\Request;
use Auth;

use App\Http\{
    Helpers\Common,
    Controllers\Controller
};


class AmenitiesController extends Controller
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
    public function index(Request $request)
    {
        $data['title'] = 'Amenities';
        $partnerAmenities = PartnerAmenities::where('user_id', Auth::user()->id)->get();
        $data['partnerAmenities'] = $partnerAmenities;
        if(!empty($partnerAmenities)) {
            foreach($partnerAmenities as $partnerAmenity) {
                $data[$partnerAmenity['name']] = $partnerAmenity['value'];
            }
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data as $key => $value) {
                if($key != '_token' && $key != 'q') {
                    if($value == 'on') {
                        $value = 1;
                    }
                    $partnerAmenities = PartnerAmenities::updateOrCreate(
                        [
                            'name'  => $key,
                        ],
                        [
                            'user_id'  => Auth::user()->id,
                            'value' => $value,
                        ]
                    );
                }   
            }
            
            return redirect()->route('amenities');
        }
        return view('partner.amenities', $data);
    }
}
