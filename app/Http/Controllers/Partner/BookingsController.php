<?php

namespace App\Http\Controllers\partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Common;
use App\Models\{
    Properties,
};

class BookingsController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    /**
     * Partner Reviews Show By Host 
     *  
    */
    public function index()
    {
        $data['title'] = 'Bookings';
        return view('partner.bookings', $data);
    }


    public function new(Request $request, Properties $property = null)
    {
        $data = [];
        if ($property) {
            $data["current_property_id"] = $property->id;
        } else {
            return selectPropertyFirst();
        }
        $data['title'] = 'Bookings';

        if($request->isMethod('post')){
            
        }
        return view('partner.bookings.new', $data);
    }

    public function save(Request $request, $id){

    }

}
