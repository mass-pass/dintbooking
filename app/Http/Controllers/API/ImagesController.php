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
    Photo
};

use Auth;
use DateTime;
use Session;
use Validator;
use DB;

class ImagesController extends Controller
{
    public $successStatus = 200;
    public $unAuthorizedStatus = 401;

    protected $helper;

    private $photo;

    public function __construct(Photo $photo)
    {
        //
        $this->photo = $photo;
    }

    public function save(Request $request){
        foreach($request->images as $image){
            $one_image = $this->photo->find($image['id']);
            $one_image->message = $image['message'];
            $one_image->cover_photo = $image['cover_photo'];
            $one_image->serial = $image['serial'];
            $one_image->save();
        }
        return response()->json(['success'=>true], $this->successStatus);

    }

    public function get(Request $request, $type, $id){
        $type = ucwords(strtolower($type));
        $images = $this->photo->where('photoable_type', '=', $type)->where('photoable_id', '=', $id)->get();

        return response()->json(['success'=>$images], $this->successStatus);
    }

}