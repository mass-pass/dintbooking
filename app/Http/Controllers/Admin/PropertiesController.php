<?php



namespace App\Http\Controllers\Admin;

use App\Helpers\PropertyHelper;
use App\Http\Requests\PropertyRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Session;
use Storage;
use PDF;
use Image;
use Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PropertyDataTable;
use App\Exports\CustomersExport;
use App\Exports\PropertiesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Helpers\Common;
use App\Http\Controllers\Admin\CalendarController;

use App\Models\{
    Properties,
    PropertyDetails,
    Address,
    PropertyPhotos,
    PropertyPrice,
    PropertyType,
    PropertyDates,
    PropertyDescription,
    Currency,
    SpaceType,
    BedType,
    PropertySteps,
    Country,
    Amenities,
    AmenityType,
    User,
    Settings,
    Bookings,
    Photo
};

class PropertiesController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(PropertyDataTable $dataTable)
    {
        $data['from'] = isset(request()->from) ? request()->from : null;
        $data['to']   = isset(request()->to) ? request()->to : null;
        $data['space_type_all'] = SpaceType::all('id', 'name');

        
        if (isset(request()->reset_btn)) {
            $data['from']        = null;
            $data['to']          = null;
            $data['allstatus']   = '';
            $data['allSpaceType']   = '';
            return $dataTable->render('admin.properties.view', $data);
        }
        isset(request()->status) ? $data['allstatus'] = $allstatus = request()->status : $data['allstatus'] = $allstatus = '';
        isset(request()->space_type) ? $data['allSpaceType'] = request()->space_type : $data['allSpaceType']  = '';
        return $dataTable->render('admin.properties.view', $data);
    }

    public function create()
    {
        $data['property_type'] = PropertyType::where('status', 'Active')->pluck('name', 'id');
        $data['space_type']    = SpaceType::where('status', 'Active')->pluck('name', 'id');
        $data['users']         = User::where('status', 'Active')->get();
        return view('admin.properties.add', $data);
    }

    public function store(PropertyRequest $request)
    {
        $name = SpaceType::find($request->space_type)->name.' in '.$request->city;
        $slug = Str::slug($name, '-');

        $final_slug = PropertyHelper::getUniqueSLug($slug);

        $property                  = new Properties;
        $property->host_id         = $request->host_id;
        $property->name            = $name;
        $property->slug            = $final_slug;
        $property->property_type   = $request->property_type_id;
        $property->space_type      = $request->space_type;
        $property->accommodates    = $request->accommodates;
        $property->save();

        $property_address                 = new Address;
        $property_address->address_line_1 = $request->route;
        $property_address->city           = $request->city;
        $property_address->state          = $request->state;
        $property_address->country        = $request->country;
        $property_address->postal_code    = $request->postal_code;
        $property_address->latitude       = $request->latitude;
        $property_address->longitude      = $request->longitude;
        $property->address()->save($property_address);

        $property_price                 = new PropertyPrice;
        $property_price->property_id    = $property->id;
        $property_price->currency_code  = \Session::get('currency');
        $property_price->save();

        $property_steps                   = new PropertySteps;
        $property_steps->property_id      = $property->id;
        $property_steps->save();

        $property_description              = new PropertyDescription;
        $property_description->property_id = $property->id;
        $property_description->save();

        return redirect('admin/listing/'.$property->id.'/basics');
    }

    public function reloadImages(Request $request)
    {
        $property = Properties::find($request->property_id);
        $photos = $property->photo;

        $s3_path = env('S3_BUCKET_PATH');
        
        $view = view("listing.photos_selectable", ['result' => $property, 'photos' => $photos, 's3_path' => $s3_path])->render();

        return response()->json(['success' => $photos, 'html' => $view]);
    }

    public function photoUpload(Request $request){
        $one_photo = $request->file('file');

        $name = str_replace(' ', '_', $one_photo->getClientOriginalName());
        $name = replaceBracket($name);

        $extension = pathinfo($name, PATHINFO_EXTENSION);

        $name = time().'_'.$name; 

        $path = 'images/property/'.$request->property_id;
                        
        $image = Image::make($one_photo);
        $height = $image->height();
        $width = $image->width();
        if($height>900){
            if(ceil((16/9)*900)<$width){
                $height = 900;
                $width = ceil((16/9)*$height);
            }
        }

        $calculated_width = ceil((16/9)*$height);
        $calculated_height = ceil($width/(16/9));
        $applicable_height = 0;
        $applicable_width = 0;
        
        if($height >= $calculated_height){
            $applicable_height = $calculated_height;
            $applicable_width = $width;
        }else{
            $applicable_height = $height;
            $applicable_width = $calculated_width;
        }
        
        $image->fit($applicable_width, $applicable_height)->encode($extension, 40);
        
        $property = Properties::find($request->property_id);
        $chk_photo = $property->photo;

        if($chk_photo != ''){
            $photo_exist_first   = Photo::where('photoable_id', $request->property_id)->count();
                   
            if ($photo_exist_first!=0) {
                $photo_exist         = Photo::orderBy('serial', 'desc')->where('photoable_id', $request->property_id)->take(1)->first();
            }
        }else{
            $photo_exist_first = 0;
            $photo_exist = 0;
        }
 
        $photo = new Photo();
        $photo->photo         = $name;
        if ($photo_exist_first != 0) {
            $photo->serial = $photo_exist->serial+1;
        } else {
            $photo->serial = $photo_exist_first+1;
        }
        if (!$photo_exist_first) {
            $photo->cover_photo     = 1;
        }
        $property->photo()->save($photo);

        //$path = Storage::disk('s3')->put($path."/".$name, $image->stream(), 'public');
        $path = Storage::disk('public')->put($path."/".$name, $image->stream(), 'public');

        $photoCount = Photo::where('photoable_id', $request->property_id)->where('photoable_type', 'App\Models\Properties')->count();
        $properties               = Properties::find($request->property_id);
        $properties->status       = ($photoCount >= 4) ?  'Listed' : 'Unlisted';
        $properties->save();

        $photos = Photo::where('photoable_type', '=', 'App\Models\Properties')->where('photoable_id', '=', $request->property_id)->get();
        return response()->json(['success' => $photos]);
    }

    public function listing(Request $request, CalendarController $calendar)
    {

        $step            = $request->step;
        $property_id     = $request->id;

        $data['step']    = $step;
        $data['result']  = Properties::findOrFail($property_id);
        $data['details'] = PropertyDetails::pluck('value', 'field');
        
        if ($step == 'basics') {
            if ($request->isMethod('post')) {
                $property                     = Properties::find($property_id);
                $property->bedrooms           = $request->bedrooms;
                $property->beds               = $request->beds;
                $property->bathrooms          = $request->bathrooms;
                $property->bed_type           = $request->bed_type;
                $property->property_type      = $request->property_type;
                $property->space_type         = $request->space_type;
                $property->accommodates       = $request->accommodates;
                $property->recomended         = $request->recomended;
                $property->save();

                $property_steps = PropertySteps::where('property_id', $property_id)->first();
                $property_steps->basics = 1;
                $property_steps->save();
                return redirect('admin/listing/'.$property_id.'/description');
            }

            $data['bed_type']       = BedType::pluck('name', 'id');
            $data['property_type']  = PropertyType::where('status', 'Active')->pluck('name', 'id');
            $data['space_type']     = SpaceType::pluck('name', 'id');
        } elseif ($step == 'description') {
            if ($request->isMethod('post')) {
                $rules = array(
                    'name'     => 'required|max:50',
                    'summary'  => 'required|max:500',
                );
        
                $fieldNames = array(
                    'name'     => 'Name',
                    'summary'  => 'Summary',
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                } else {
                    $property           = Properties::find($property_id);
                    $property->name     = $request->name;
                    $slug               = Str::slug($property->name, '-');
                    $final_slug         = PropertyHelper::getUniqueSLug($slug,$property_id);
                    $property->slug     = $final_slug;

                    if ($property->name != $request->name) {
                        $property->url_name = $this->helper->pretty_url($request->name);
                    }
                    $property->save();

                    $property_description              = PropertyDescription::where('property_id', $property_id)->first();
                    if(is_null($property_description)) {
                       $property_description  = new PropertyDescription();
                       $property_description->property_id = $property_id;
                       $property_description->summary     = $request->summary;
                       $property_description->save();
                    } else {
                        $property_description->summary     = $request->summary;
                        $property_description->save();
                    }

                    $property_steps = PropertySteps::where('property_id', $property_id)->first();
                    $property_steps->description = 1;
                    $property_steps->save();
                    return redirect('admin/listing/'.$property_id.'/location');
                }
            }
            $data['description']       = PropertyDescription::where('property_id', $property_id)->first();
        } elseif ($step == 'details') {
            if ($request->isMethod('post')) {
                $property_description                       = PropertyDescription::where('property_id', $property_id)->first();
                $property_description->about_place          = $request->about_place;
                $property_description->place_is_great_for   = $request->place_is_great_for;
                $property_description->guest_can_access     = $request->guest_can_access;
                $property_description->interaction_guests   = $request->interaction_guests;
                $property_description->other                = $request->other;
                $property_description->about_neighborhood   = $request->about_neighborhood;
                $property_description->get_around           = $request->get_around;
                $property_description->save();

                return redirect('admin/listing/'.$property_id.'/description');
            }
        } elseif ($step == 'location') {
            if ($request->isMethod('post')) {
                $rules = array(
                    'address_line_1'    => 'required|max:250',
                    'address_line_2'    => 'max:250',
                    'country'           => 'required',
                    'city'              => 'required',
                    'state'             => 'required',
                    'latitude'          => 'required|not_in:0',
                );
            
                $fieldNames = array(
                    'address_line_1' => 'Address Line 1',
                    'country'        => 'Country',
                    'city'           => 'City',
                    'state'          => 'State',
                    'latitude'       => 'Map',
                );

                $messages = [
                    'not_in' => 'Please set :attribute pointer',
                ];

                $validator = Validator::make($request->all(), $rules, $messages);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput(); 
                } else {
                    $property = Properties::find($property_id);
                    $property_address = $property->address;
                    if (!$property_address) {
                        $property_address = new Address;
                    }

                    $property_address->address_line_1 = $request->address_line_1;
                    $property_address->address_line_2 = $request->address_line_2;
                    $property_address->latitude       = $request->latitude;
                    $property_address->longitude      = $request->longitude;
                    $property_address->state          = $request->state;
                    $property_address->country        = $request->country;
                    $property_address->postal_code    = $request->postal_code;
                    $property->address()->save($property_address);

                    $property_steps = PropertySteps::where('property_id', $property_id)->first();
                    $property_steps->location = 1;
                    $property_steps->save();

                    return redirect('admin/listing/'.$property_id.'/amenities');
                }
            }
            $data['country']       = Country::pluck('name', 'short_name');
        } elseif ($step == 'amenities') {
            if ($request->isMethod('post') && is_array($request->amenities)) {
                $rooms = Properties::find($request->id);
                $rooms->amenities = implode(',', $request->amenities);
                $rooms->save();
                return redirect('admin/listing/'.$property_id.'/photos');
            }
            $data['property_amenities'] = explode(',', $data['result']->amenities);
            $data['amenities']          = Amenities::where('status', 'Active')->where('category', 'Property')->get();
            $data['amenities_type']     = AmenityType::get();
        } elseif ($step == 'photos') {
            if ($_FILES) {
                $rules = array(
                    'photos'   => 'required',
                    'photos.*' => 'image|mimes:jpg,jpeg,bmp,png,gif',
                    'photos.*' => 'dimensions:min_width=640,min_height=360',
                );

            
                $fieldNames = array(
                    'photos'  => 'Photos',
                    'photos.*'=> 'Photos'
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();  
                } else {

                    foreach($request->photos as $one_photo):
                        $name = str_replace(' ', '_', $one_photo->getClientOriginalName());
                        $name = replaceBracket($name);

                        $ext = pathinfo($name, PATHINFO_EXTENSION);
        
                        $name = time().'_'.$name; 
        
                        $path = 'images/property/'.$property_id;
                                        
                        if (! file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
        
                        $image = Image::make($one_photo);
                        $height = $image->height();
                        $width = $image->width();
        
                        $calculated_width = ceil((16/9)*$height);
                        $calculated_height = ceil($width/(16/9));
                        $applicable_height = 0;
                        $applicable_width = 0;
                        
                        if($height >= $calculated_height){
                            $applicable_height = $calculated_height;
                            $applicable_width = $width;
                        }else{
                            $applicable_height = $height;
                            $applicable_width = $calculated_width;
                        }
                        $image->fit($applicable_width, $applicable_height)->save($path."/".$name);

                        $property = Properties::find($request->property_id);
                        $chk_photo = $property->photo;

                        if($chk_photo != ''){
                            $photo_exist_first   = Photo::where('photoable_id', $request->property_id)->count();
                                
                            if ($photo_exist_first!=0) {
                                $photo_exist         = Photo::orderBy('serial', 'desc')->where('photoable_id', $request->property_id)->take(1)->first();
                            }
                        }else{
                            $photo_exist_first = 0;
                            $photo_exist = 0;
                        }
                
                        $photo = new Photo();
                        $photo->photo         = $name;
                        if ($photo_exist_first != 0) {
                            $photo->serial = $photo_exist->serial+1;
                        } else {
                            $photo->serial = $photo_exist_first+1;
                        }
                        if (!$photo_exist_first) {
                            $photo->cover_photo     = 1;
                        }
                        $property->photo()->save($photo);

                        $property_steps = PropertySteps::where('property_id', $property_id)->first();
                        $property_steps->photos = 1;
                        $property_steps->save();


                    endforeach;
                    $properties               = Properties::find($property->id);
                    $properties->status       = ( $properties->steps_completed == 0 ) && (count($properties->property_photos) >=4) ?  'Listed' : 'Unlisted';
                    $properties->save();
            
                    /*if (isset($_FILES["photos"]["name"])) {
                        foreach ($_FILES["photos"]["error"] as $key => $error) {
                            $tmp_name = $_FILES["photos"]["tmp_name"][$key];

                            $name = str_replace(' ', '_', $_FILES["photos"]["name"][$key]);
                            $name = replaceBracket($name);
                            
                            $ext = pathinfo($name, PATHINFO_EXTENSION);

                            $name = time().'_'.$name; 

                            $path = 'images/property/'.$property_id;
                                            
                            if (! file_exists($path)) {
                                mkdir($path, 0777, true);
                            }
                                                       
                            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif') {
                                if (move_uploaded_file($tmp_name, $path."/".$name)) {
                                    $photo_exist_first   = PropertyPhotos::where('property_id', $property_id)->count();
                                   
                                    if ($photo_exist_first!=0) {
                                        $photo_exist         = PropertyPhotos::orderBy('serial', 'desc')->where('property_id', $property_id)->take(1)->first();
                                    }
                                    $photos                = new PropertyPhotos;
                                    $photos->property_id   = $property_id;
                                    $photos->photo         = $name;
                                    if ($photo_exist_first != 0) {
                                        $photos->serial = $photo_exist->serial+1;
                                    } else {
                                        $photos->serial = $photo_exist_first+1;
                                    }

                                    if (!$photo_exist_first) {
                                        $photos->cover_photo     = 1;
                                    }
                                    
                                    $photos->save();

                                    $property_steps = PropertySteps::where('property_id', $property_id)->first();
                                    $property_steps->photos = 1;
                                    $property_steps->save();
                                }
                            }
                        }
                    }*/

                    
                    return redirect('admin/listing/'.$property_id.'/photos')->with('success', 'File Uploaded Successfully!');
                }
            }
            $data['photos']    = Photo::where('photoable_id', $property_id)
                                ->where('photoable_type', 'App\Models\Properties')
                                ->orderBy('serial', 'asc')
                                ->get();
        } else if ($step == 'pricing') {
            if ($request->isMethod('post')) {
                $rules = array(
                    'price' => 'required|numeric|min:5',
                );
            
                $fieldNames = array(
                    'price'  => 'Price',
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                } else {
                    $property_price                    = PropertyPrice::where('property_id', $property_id)->first();
                    $property_price->price             = $request->price;
                    $property_price->weekly_discount   = $request->weekly_discount;
                    $property_price->monthly_discount  = $request->monthly_discount;
                    $property_price->currency_code     = $request->currency_code;
                    $property_price->cleaning_fee      = $request->cleaning_fee;
                    $property_price->guest_fee         = $request->guest_fee;
                    $property_price->guest_after       = $request->guest_after;
                    $property_price->security_fee      = $request->security_fee;
                    $property_price->weekend_price     = $request->weekend_price;
                    $property_price->save();

                    $property_steps = PropertySteps::where('property_id', $property_id)->first();
                    $property_steps->pricing = 1;
                    $property_steps->save();

                    return redirect('admin/listing/'.$property_id.'/booking');
                }
            }
        } elseif ($step == 'booking') {
            if ($request->isMethod('post')) {
                $properties               = Properties::find($property_id);
                $properties->booking_type = $request->booking_type;
 
                $properties->status       = (count($properties->property_photos) >=4) ?  'Listed' : 'Unlisted';
                $properties->save();

                $property_steps          = PropertySteps::where('property_id', $property_id)->first();
                $property_steps->booking = 1;
                $property_steps->save();
                
                return redirect('admin/listing/'.$property_id.'/calender');
            }
        } elseif ($step == 'calender') {
            $data['calendar'] = $calendar->generate($request->id);
        }

        return view("admin.listing.$step", $data);
    }

    public function update(Request $request)
    {
        if (! $request->isMethod('post')) {
              $amenity_type=AmenityType::get();
              $am = [];
            foreach ($amenity_type as $key => $value) {
                $am[$value->id]=$value->name;
            }
              $data['am'] = $am;
            $data['result'] = Amenities::find($request->id);
            return view('admin.amenities.edit', $data);
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'title'          => 'required',
                    'description'    => 'required',
                    'symbol'         => 'required',
                    'type_id'        => 'required',
                    'status'         => 'required'

                    );

            $fieldNames = array(
                        'title'             => 'Title',
                        'description'       => 'Description',
                        'symbol'            => 'Symbol'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $amenitie = Amenities::find($request->id);
                $amenitie->title          = $request->title;
                $amenitie->description    = $request->description;
                $amenitie->symbol         = $request->symbol;
                $amenitie->type_id        = $request->type_id;
                $amenitie->status         = $request->status;
                $amenitie->save();

                $this->helper->one_time_message('success', 'Updated Successfully');
                return redirect('admin/amenities');
            }
        }
    }
    
    public function delete(Request $request)
    {
        $bookings   = Bookings::where(['property_id' => $request->id])->get()->toArray();
        if (env('APP_MODE', '') != 'test') {
            if (count($bookings) > 0) {
               $this->helper->one_time_message('danger', 'This Property has Bookings.Sorry can not possible to delete'); 
            } else {
                Properties::find($request->id)->delete();
                $this->helper->one_time_message('success', 'Deleted Successfully');
                return redirect('admin/properties');                    
             } 
         }
         return redirect('admin/properties');  
    }

    public function photoMessage(Request $request)
    {
           $property = Properties::find($request->id);
            $photos  = Photo::find($request->photo_id);
            $photos->message = $request->messages;
            $photos->save();
        
        return json_encode(['success'=>'true']);
    }

    public function photoDelete(Request $request)
    {
      
            $property = Properties::find($request->id);
            $photos   = Photo::find($request->photo_id);
            $photos->delete(); 
        
            $property               = Properties::find($request->id);
            $property->status       = (count($property->property_photos) >=4) ?  'Listed' : 'Unlisted';
            $property->save();

        return json_encode(['success'=>'true']);
    }

    public function makeDefaultPhoto(Request $request)
    {

        if ($request->option_value == 'Yes') {
            Photo::where('photoable_id', '=', $request->property_id)->where('photoable_type', 'App\Models\Properties')
            ->update(['cover_photo' => 0]);

            $photos = Photo::find($request->photo_id);
            $photos->cover_photo = 1;
            $photos->save();
        }
        return json_encode(['success'=>'true']);
    }

    public function makePhotoSerial(Request $request)
    {
       
        $photos         = Photo::find($request->id);
        $photos->serial = $request->serial;
        $photos->save();

        return json_encode(['success'=>'true']);
    }

    public function propertyCsv($id = null)
    {
        return Excel::download(new PropertiesExport, 'properties_sheet' . time() .'.xls');
    }

    public function propertyPdf($id = null)
    {
        $to                 = setDateForDb(request()->to);
        $from               = setDateForDb(request()->from);
        $data['companyLogo']  = $logo  = Settings::where('name', 'logo')->select('value')->first();
        if ($logo->value==null) {
            $data['logo_flag'] = 0;
        } elseif (! file_exists("front/images/logos/$logo->value")) {
            $data['logo_flag'] = 0;
        }
        $data['status']     = $status = isset(request()->status) ? request()->status : null;
        $data['space_type'] = $space_type = isset(request()->space_type) ? request()->space_type : 'null';
        $properties = $this->getAllProperties();

        if (isset($id)) {
            $properties->where('properties.host_id', '=', $id);
        }

        if ($from) {
            $properties->whereDate('properties.created_at', '>=', $from);
        }

        if ($to) {
                $properties->whereDate('properties.created_at', '<=', $to);
        }

        if (!is_null($status)) {
                $properties->where('properties.status', '=', $status);
        }

        $data['propertyList'] = $properties->get();
        
        if ($space_type) {
                $properties->where('properties.space_type', '=', $space_type);
        }
        if ($from && $to) {
            $data['date_range'] = onlyFormat($from) . ' To ' . onlyFormat($to);
        }
        

        $pdf = PDF::loadView('admin.properties.list_pdf', $data, [], [
            'format' => 'A3', [750, 1060]
          ]);
        return $pdf->download('property_list_' . time() . '.pdf', array("Attachment" => 0));
    }

    public function getAllProperties()
    {
        $query = Properties::join('users', function ($join) {
            $join->on('users.id', '=', 'properties.host_id');
        })
            ->join('space_type', function ($join) {
                    $join->on('space_type.id', '=', 'properties.space_type');
            })

            ->select(['properties.id as properties_id', 'properties.name as property_name', 'properties.status as property_status', 'properties.created_at as property_created_at', 'properties.updated_at as property_updated_at','space_type.name as Space_type_name' , 'properties.*', 'users.*', 'space_type.*'])
            ->orderBy('properties.id', 'desc');
            return $query;
    }
}
