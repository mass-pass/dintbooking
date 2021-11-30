<?php

namespace App\Http\Controllers\partner;

use App\Models\PartnerFacilities;
use Illuminate\Http\Request;
use Auth;

use App\Http\{
    Helpers\Common,
    Controllers\Controller
};


class FacilitiesController extends Controller
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
        $data['title'] = 'Facilities';
        $partnerFacilities = PartnerFacilities::where('user_id', Auth::user()->id)->get();
        $data['partnerFacilities'] = $partnerFacilities;
       
        if(!empty($partnerFacilities)) {
            foreach($partnerFacilities as $partnerFacility) {
                $data[$partnerFacility['name']] = $partnerFacility['value'];
            }
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data as $key => $value) {
                if($key != '_token' && $key != 'q') {
                    if($value == 'on') {
                        $value = 1;
                    }
                    $partnerFacilities = PartnerFacilities::updateOrCreate(
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
            return redirect()->route('facilities');
        }
        return view('partner.facilities', $data);
    }
}
