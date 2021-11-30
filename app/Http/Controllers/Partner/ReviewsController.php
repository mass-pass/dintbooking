<?php

namespace App\Http\Controllers\partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Common;
use App\Models\{
    Properties,
};
class ReviewsController extends Controller
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
    public function index(Properties $property = null)
    {
        $data['title'] = 'Reviews';
        if ($property) {
            $data["current_property_id"] = $property->id;
        } else {
            return selectPropertyFirst();
        }
        
        return view('partner.reviews', $data);
    }
}
