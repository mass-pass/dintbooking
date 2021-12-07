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
    Properties,
    PropertyDetails,
    Address,
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
    AmenityType,
    Photo
};


class PropertyController extends Controller
{
    public function __construct()
    {
        $this->helper = new Common;
    }

    public function userProperties(Request $request)
    {
        switch ($request->status) {
            case 'Listed':
            case 'Unlisted':
                $pram = [['status', '=', $request->status]];
                break;
            default:
                $pram = [];
                break;
        }

        $data['status'] = $request->status;
        $data['properties'] = Properties::with('property_price')
            ->where('host_id', Auth::id())
            ->where($pram)
            ->orderBy('id', 'desc')
            ->paginate(Session::get('row_per_page'));
        return view('property.listings', $data);
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

    /**
     * a form to create property will be shown
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $data['property_type'] = PropertyType::where('status', 'Active')->pluck('name', 'id');
        $data['space_type'] = SpaceType::where('status', 'Active')->pluck('name', 'id');

        return view('property.create', $data);
    }

    /**
     * Property Will be stored and then redirected to the page to fill up other necessary details like room, bed, price ...
     * @param PropertyRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PropertyRequest $request)
    {
        $name = SpaceType::find($request->space_type)->name . ' in ' . $request->city;
        $slug = Str::slug($name, '-');

        $final_slug = PropertyHelper::getUniqueSLug($slug);

        $property = new Properties;
        $property->host_id = Auth::id();
        $property->name = $name;
        $property->slug = $final_slug;
        $property->property_type = $request->property_type_id;
        $property->space_type = $request->space_type;
        $property->accommodates = $request->accommodates;
        $property->save();


        $property_address = new Address([
            'address_line_1' => $request->route,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        
        $property->address()->save($property_address);

        $property_price = new PropertyPrice;
        $property_price->property_id = $property->id;
        $property_price->currency_code = \Session::get('currency');
        $property_price->save();

        $property_steps = new PropertySteps;
        $property_steps->property_id = $property->id;
        $property_steps->save();

        $property_description = new PropertyDescription;
        $property_description->property_id = $property->id;
        $property_description->save();

        return redirect('listing/' . $property->id . '/basics');
    }

    public function listing(Request $request, CalendarController $calendar)
    {


        $step = $request->step;
        $property_id = $request->id;
        $data['step'] = $step;
        $data['result'] = Properties::where('host_id', Auth::id())->findOrFail($property_id);
        $data['details'] = PropertyDetails::pluck('value', 'field');
        $data['missed'] = PropertySteps::where('property_id', $request->id)->first();
        if(!is_array($data['missed'])){
            $data['missed'] = [];
        }

        if ($step == 'basics') {
            if ($request->isMethod('post')) {
                $property = Properties::find($property_id);
                $property->bedrooms = $request->bedrooms;
                $property->beds = $request->beds;
                $property->bathrooms = $request->bathrooms;
                $property->bed_type = $request->bed_type;
                $property->property_type = $request->property_type;
                $property->space_type = $request->space_type;
                $property->accommodates = $request->accommodates;
                $property->save();

                $property_steps = PropertySteps::where('property_id', $property_id)->first();
                if(!$property_steps){
                    $property_steps = new PropertySteps();
                    $property_steps->property_id = $property_id;
                }
                $property_steps->basics = 1;
                $property_steps->save();
                return redirect('listing/' . $property_id . '/description');
            }

            $data['bed_type'] = BedType::pluck('name', 'id');
            $data['property_type'] = PropertyType::where('status', 'Active')->pluck('name', 'id');
            $data['space_type'] = SpaceType::pluck('name', 'id');
        } elseif ($step == 'description') {
            if ($request->isMethod('post')) {
                $rules = array(
                    'name' => 'required|max:50',
                    'summary' => 'required|max:500',
                );

                $fieldNames = array(
                    'name' => 'Name',
                    'summary' => 'Summary',
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                } else {
                    $property = Properties::find($property_id);
                    $property->name = $request->name;
                    $slug = Str::slug($property->name, '-');
                    $final_slug = PropertyHelper::getUniqueSLug($slug, $property_id);
                    $property->slug = $final_slug;
                    if ($property->name != $request->name) {
                        $property->url_name = $this->helper->pretty_url($request->name);
                    }
                    $property->save();

                    $property_description = PropertyDescription::where('property_id', $property_id)->first();
                    
                    if(!$property_description){
                        $property_description = new PropertyDescription();
                        $property_description->property_id = $property_id;
                    }

                    $property_description->summary = $request->summary;
                    $property_description->save();

                    $property_steps = PropertySteps::where('property_id', $property_id)->first();
                    if(!$property_steps){
                        $property_steps = new PropertySteps();
                        $property_steps->property_id = $property_id;
                    }

                    $property_steps->description = 1;
                    $property_steps->save();

                    return redirect('listing/' . $property_id . '/location');
                }
            }
            $data['description'] = PropertyDescription::where('property_id', $property_id)->first();
        } elseif ($step == 'details') {
            if ($request->isMethod('post')) {
                $property_description = PropertyDescription::where('property_id', $property_id)->first();
                
                if(!$property_description){
                    $property_description = new PropertyDescription();
                    $property_description->property_id = $property_id;
                }

                $property_description->about_place = $request->about_place;
                $property_description->place_is_great_for = $request->place_is_great_for;
                $property_description->guest_can_access = $request->guest_can_access;
                $property_description->interaction_guests = $request->interaction_guests;
                $property_description->other = $request->other;
                $property_description->about_neighborhood = $request->about_neighborhood;
                $property_description->get_around = $request->get_around;
                $property_description->save();

                return redirect('listing/' . $property_id . '/description');
            }
        } elseif ($step == 'location') {
            if ($request->isMethod('post')) {
                $rules = array(
                    'address_line_1' => 'required|max:250',
                    'address_line_2' => 'max:250',
                    'country' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'latitude' => 'required|not_in:0',
                );

                $fieldNames = array(
                    'address_line_1' => 'Address Line 1',
                    'country' => 'Country',
                    'city' => 'City',
                    'state' => 'State',
                    'latitude' => 'Map',
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

                    if(!$property_address){
                        $property_address = new Address();
                        $property_address->addressable_id = $property_id;
                        $property_address->addressable_type = Properties::class;
                    }

                    if ($property_address) {
                        $property_address->address_line_1 = $request->address_line_1;
                        $property_address->address_line_2 = $request->address_line_2;
                        $property_address->latitude = $request->latitude;
                        $property_address->longitude = $request->longitude;
                        $property_address->city = $request->city;
                        $property_address->state = $request->state;
                        $property_address->country = $request->country;
                        $property_address->postal_code = $request->postal_code;
                        $property_address->save();
                    } else {
                        $property_address = new Address;
                        $property_address->address_line_1 = $request->address_line_1;
                        $property_address->address_line_2 = $request->address_line_2;
                        $property_address->latitude = $request->latitude;
                        $property_address->longitude = $request->longitude;
                        $property_address->city = $request->city;
                        $property_address->state = $request->state;
                        $property_address->country = $request->country;
                        $property_address->postal_code = $request->postal_code;
                        $property_address->save();
                        $property->address()->save($property_address);
                    }

                    $property_steps = PropertySteps::where('property_id', $property_id)->first();
                    if(!$property_steps){
                        $property_steps = new PropertySteps();
                        $property_steps->property_id = $property_id;
                    }

                    $property_steps->location = 1;
                    $property_steps->save();

                    return redirect('listing/' . $property_id . '/amenities');
                }
            }
            $data['country'] = Country::pluck('name', 'short_name');
        } elseif ($step == 'amenities') {
            if ($request->isMethod('post') && is_array($request->amenities)) {
                $rooms = Properties::find($request->id);
                $rooms->amenities = implode(',', $request->amenities);
                $rooms->save();
                return redirect('listing/' . $property_id . '/photos');
            }
            $data['property_amenities'] = explode(',', $data['result']->amenities);
            $data['amenities'] = Amenities::where('status', 'Active')->get();
            $data['amenities_type'] = AmenityType::get();
        } elseif ($step == 'photos') {
            if ($_FILES) {

                $rules = array(
                    'photos' => 'required',
                    'photos.*' => 'image|mimes:jpg,jpeg,bmp,png,gif,JPG',
                    'photos.*' => 'dimensions:min_width=640,min_height=360,ratio=16/9',

                );

                $fieldNames = array(
                    'photos' => 'Photos',
                    'photos.*' => 'Photos'
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                } else {

                    foreach ($request->photos as $one_photo):
                        $name = str_replace(' ', '_', $one_photo->getClientOriginalName());
                        $name = replaceBracket($name);

                        $ext = pathinfo($name, PATHINFO_EXTENSION);

                        $name = time() . '_' . $name;

                        $path = 'images/property/' . $property_id;

                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }

                        $image = Image::make($one_photo);
                        $height = $image->height();
                        $width = $image->width();

                        $calculated_width = ceil((16 / 9) * $height);
                        $calculated_height = ceil($width / (16 / 9));
                        $applicable_height = 0;
                        $applicable_width = 0;

                        if ($height >= $calculated_height) {
                            $applicable_height = $calculated_height;
                            $applicable_width = $width;
                        } else {
                            $applicable_height = $height;
                            $applicable_width = $calculated_width;
                        }
                        $image->fit($applicable_width, $applicable_height)->save($path . "/" . $name);

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
                        if(!$property_steps){
                            $property_steps = new PropertySteps();
                            $property_steps->property_id = $property_id;
                        }

                        $property_steps->photos = 1;
                        $property_steps->save();

                        $properties = Properties::find($property_id);
                        $properties->status = ($properties->steps_completed == 0) && (count($properties->property_photos) >= 4) ? 'Listed' : 'Unlisted';
                        $properties->save();


                    endforeach;

                    /*if (isset($_FILES["photos"]["name"])) {
                        foreach ($_FILES["photos"]["error"] as $key => $error) {
                            $tmp_name = $_FILES["photos"]["tmp_name"][$key];

                            $name = str_replace(' ', '_', $_FILES["photos"]["name"][$key]);
                            $name = replaceBracket($name);

                            $ext = pathinfo($name, PATHINFO_EXTENSION);

                            $name = time().'_'.$name;

                            $path = 'images/property/'.$property_id;
                                            
                            if (!file_exists($path)) {
                                mkdir($path, 0777, true);
                            }
                                                       
                            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'JPG') {
                                if (move_uploaded_file($tmp_name, $path."/".$name)) {
                                    $photo_exist_first   = PropertyPhotos::where('property_id', $property_id)->count();
                                    if ($photo_exist_first!=0) {
                                        $photo_exist         = PropertyPhotos::orderBy('serial', 'desc')->where('property_id', $property_id)->take(1)->first();
                                    }
                                    $photos              = new PropertyPhotos;
                                    $photos->property_id = $property_id;
                                    $photos->photo       = $name;
                                    if ($photo_exist_first!=0) {
                                        $photos->serial = $photo_exist->serial+1;
                                    } else {
                                        $photos->serial = $photo_exist_first+1;
                                    }
                                    if (! $photo_exist_first) {
                                        $photos->cover_photo     = 1;
                                    }
                                    
                                    $photos->save();
                                    $property_steps         = PropertySteps::where('property_id', $property_id)->first();
                                    $property_steps->photos = 1;
                                    $property_steps->save();
                                }
                            }
                        }
                    }*/


                    return redirect('listing/' . $property_id . '/photos')->with('success', 'File Uploaded Successfully!');
                }
            }
            $data['photos'] = Photo::where('photoable_id', $property_id)
                ->where('photoable_type', 'App\Models\Properties')
                ->orderBy('serial', 'asc')
                ->get();
        } elseif ($step == 'pricing') {
            if ($request->isMethod('post')) {
                $rules = array(
                    'price' => 'required|numeric|min:5',
                    'weekly_discount' => 'nullable|numeric|max:99|min:0',
                    'monthly_discount' => 'nullable|numeric|max:99|min:0'
                );

                $fieldNames = array(
                    'price' => 'Price',
                    'weekly_discount' => 'Weekly Discount Percent',
                    'monthly_discount' => 'Monthly Discount Percent'
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                } else {
                    $property_price = PropertyPrice::where('property_id', $property_id)->first();
                    
                    if(!$property_price){
                        $property_price = new PropertyPrice();
                        $property_price->property_id = $property_id;
                    }

                    $property_price->price = $request->price;
                    $property_price->weekly_discount = $request->weekly_discount;
                    $property_price->monthly_discount = $request->monthly_discount;
                    $property_price->currency_code = $request->currency_code;
                    $property_price->cleaning_fee = $request->cleaning_fee;
                    $property_price->guest_fee = $request->guest_fee;
                    $property_price->guest_after = $request->guest_after;
                    $property_price->security_fee = $request->security_fee;
                    $property_price->weekend_price = $request->weekend_price;
                    $property_price->save();

                    $property_steps = PropertySteps::where('property_id', $property_id)->first();
                    
                    if(!$property_steps){
                        $property_steps = new PropertySteps();
                        $property_steps->property_id = $property_id;
                    }

                    $property_steps->pricing = 1;
                    $property_steps->save();

                    return redirect('listing/' . $property_id . '/booking');
                }
            }
        } elseif ($step == 'booking') {
            if ($request->isMethod('post')) {

                $property_steps = PropertySteps::where('property_id', $property_id)->first();
                
                if(!$property_steps){
                    $property_steps = new PropertySteps();
                    $property_steps->property_id = $property_id;
                }

                $property_steps->booking = 1;
                $property_steps->save();

                $properties = Properties::find($property_id);
                $properties->booking_type = $request->booking_type;
                $properties->status = ($properties->steps_completed == 0) && (count($properties->property_photos) >= 4) ? 'Listed' : 'Unlisted';
                $properties->save();


                return redirect('listing/' . $property_id . '/calendar');
            }
        } elseif ($step == 'calendar') {
            $data['calendar'] = $calendar->generate($request->id);
        }

        return view("listing.$step", $data);
    }

    public function updateStatus(Request $request)
    {
        $property_id = $request->id;
        $reqstatus = $request->status;
        if ($reqstatus == 'Listed') {
            $status = 'Unlisted';
        } else {
            $status = 'Listed';
        }
        $properties = Properties::where('host_id', Auth::id())->find($property_id);
        $properties->status = $status;
        $properties->save();
        return response()->json($properties);

    }

    public function getPrice(Request $request)
    {

        return $this->helper->get_price($request->property_id, $request->checkin, $request->checkout, $request->guest_count);
    }

    public function single(Request $request, $slug)
    {

        $data['result'] = Properties::where('slug', $slug)->firstOrFail();
        $data['result']['property_address'] = Address::where('addressable_id', $data['result']->id)->where('addressable_type', 'App\Models\Properties')->first();

        $data['property_id'] = $data['result']->id;

        $data['property_photos'] = $data['result']->photo;
        
        $data['amenities'] = Amenities::normal($data['result']->id);
        $data['safety_amenities'] = Amenities::security($data['result']->id);

        $property_address = $data['result']->property_address;
        $property_address = $data['result']->property_address;

        $latitude = $property_address->latitude;

        $longitude = $property_address->longitude;

        $data['checkin'] = (isset($request->checkin) && $request->checkin != '') ? $request->checkin : '';
        $data['checkout'] = (isset($request->checkout) && $request->checkout != '') ? $request->checkout : '';
        $data['guests'] = (isset($request->guests) && $request->guests != '') ? $request->guests : '';
        // $data['similar'] = Properties::join('addresses', function ($join) {
        //     $join->on('properties.id', '=', 'addresses.addressable_id');
        // })
        // $data['similar'] = Properties::join('property_address_1', function ($join) {
        //     $join->on('properties.id', '=', 'property_address_1.property_id');
        // })
        //     ->select(DB::raw('*, ( 3959 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitude ) ) ) ) as distance'))
        //     ->having('distance', '<=', 30)
        //     ->where('properties.id', '!=', $data['result']->id)
        //     ->where('properties.status', 'Listed')
        //     ->get();
        $data['title'] = $data['result']->name . ' in ' . ($data['result']->property_address ? $data['result']->property_address->city : '');

        $data['shareLink'] = url('/') . '/' . 'properties/' . $data['property_id'];
        // return $data['similar'];
        return view('property.single', $data);
    }

    public function currencySymbol(Request $request)
    {
        $symbol = Currency::code_to_symbol($request->currency);
        $data['success'] = 1;
        $data['symbol'] = $symbol;

        return json_encode($data);
    }

    public function photoMessage(Request $request)
    {
        $property = Properties::find($request->id);
        if ($property->host_id == \Auth::user()->id) {
            $photos = Photo::find($request->photo_id);
            $photos->message = $request->messages;
            $photos->save();
        }

        return json_encode(['success' => 'true']);
    }

    public function photoDelete(Request $request)
    {
        $property = Properties::find($request->id);
        if ($property->host_id == \Auth::user()->id) {
            $photos = Photo::find($request->photo_id);
            $photos->delete();
        }
        $property = Properties::find($request->id);
        $property->status = ($property->steps_completed == 0) && (count($property->property_photos) >= 4) ? 'Listed' : 'Unlisted';
        $property->save();

        return json_encode(['success' => 'true']);
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
        return json_encode(['success' => 'true']);
    }

    public function makePhotoSerial(Request $request)
    {

        $photos = Photo::find($request->id);
        $photos->serial = $request->serial;
        $photos->save();

        return json_encode(['success' => 'true']);
    }


    public function listProperty()
    {
        $title = 'Contact Details';
        $property_types = PropertyType::where('status','Active')->get();
        return view('property.list_property', compact('title','property_types'));
    }

    public function apartmentdetails()
    {
        return view('apartment.list_apartment');
    }

    public function propertyname(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = array(
                'name' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $property = new Properties;
                $property->host_id = Auth::id();
                $property->name = $request->name;
                $property->property_type = $request->property_type_id;
                $property->save();

                $property_price = new PropertyPrice;
                $property_price->property_id = $property->id;
                $property_price->save();

                $property_breakfast = new PropertyBreakfast;
                $property_breakfast->property_id = $property->id;
                $property_breakfast->save();

                $property_lang = new PropertyLanguage;
                $property_lang->property_id = $property->id;
                $property_lang->save();

                $property_timing = new PropertyTimings;
                $property_timing->property_id = $property->id;
                $property_timing->save();

                $property_licence = new PropertyLicence;
                $property_licence->property_id = $property->id;
                $property_licence->save();

                $property_credit = new PropertyCredit;
                $property_credit->property_id = $property->id;
                $property_credit->save();

                return redirect('list/' . $property->id . '/address');
            }
        }

        return view('apartment.name');
    }

    public function propertylisting(Request $request)
    {

        $step = $request->step;
        $property_id = $request->id;

        $data['result'] = Properties::findOrFail($property_id);
        $data['details'] = PropertyDetails::pluck('value', 'field');

        if ($step == 'address') {
            if ($request->isMethod('post')) {
                $rules = array(
                    'country' => 'required',
                    'address' => 'required|max:250',
                    'zip' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                } else {

                    $property = Properties::find($property_id);

                    $property_address = $property->address;
                    if (!$property_address) {
                        $property_address = new Address;
                        $isaddress = false;
                    }

                    $property_address->country = $request->country;
                    $property_address->address_line_1 = $request->address;
                    $property_address->latitude = 0;
                    $property_address->longitude = 0;
                    $property_address->postal_code = $request->zip;
                    $property_address->city = $request->city;
                    $property_address->state = $request->state;
                    $property_address->save();
                    if (!$isaddress) {
                        $property->address()->save($property_address);   
                    }

                    return redirect('list/' . $property_id . '/location');
                }
            }
            $data['country'] = Country::pluck('name', 'short_name');
            return view('apartment.address', $data);
        } elseif ($step == 'location') {
            if ($request->isMethod('post')) {

                return redirect('list/' . $property_id . '/basics');
            }
            return view('apartment.location');
        } elseif ($step == 'basics') {
            if ($request->isMethod('post')) {
                $property = Properties::find($property_id);
                $property->bedrooms = $request->bedrooms;
                $property->beds = $request->beds;
                $property->bed_type = $request->bed_type;
                $property->bathrooms = $request->bathrooms;
                $property->space_type = $request->space_type;
                $property->accommodates = $request->accommodates;
                $property->save();

                return redirect('list/' . $property_id . '/amenities');
            }
            $data['bed_type'] = BedType::pluck('name', 'id');
            $data['property_type'] = PropertyType::where('status', 'Active')->pluck('name', 'id');
            $data['space_type'] = SpaceType::pluck('name', 'id');
            return view('apartment.basics', $data);
        } elseif ($step == 'amenities') {
            if ($request->isMethod('post') && is_array($request->amenities)) {
                $rooms = Properties::find($request->id);
                $rooms->amenities = implode(',', $request->amenities);
                $rooms->save();
                return redirect('list/' . $property_id . '/breakfast');
            }
            $data['property_amenities'] = explode(',', $data['result']->amenities);
            $data['amenities'] = Amenities::where('status', 'Active')->where('category', 'Property')->get();
            $data['amenities_type'] = AmenityType::get();
            return view('apartment.amenities', $data);
        } elseif ($step == 'breakfast') {
            if ($request->isMethod('post')) {
                $property_breakfast = PropertyBreakfast::where('property_id', $property_id)->first();
                $property_breakfast->breakfast = $request->breakfast;
                $property_breakfast->save();
                return redirect('list/' . $property_id . '/language');
            }
            return view('apartment.breakfast');
        } elseif ($step == 'language') {
            if ($request->isMethod('post')) {
                $property_lang = PropertyLanguage::where('property_id', $property_id)->first();
                $property_lang->language = $request->language;
                $property_lang->save();

                return redirect('list/' . $property_id . '/check-ins');
            }
            $data['lang'] = Language::pluck('name', 'id');
            return view('apartment.language', $data);
        } elseif ($step == 'check-ins') {
            if ($request->isMethod('post')) {
                $property_timing = PropertyTimings::where('property_id', $property_id)->first();
                $property_timing->check_in_from = $request->check_in;
                $property_timing->check_in_until = $request->check_in1;
                $property_timing->checkout_from = $request->check_out;
                $property_timing->checkout_until = $request->check_out1;
                $property_timing->save();

                return redirect('list/' . $property_id . '/photos');
            }
            return view('apartment.check-ins');
        } elseif ($step == 'photos') {
            if ($_FILES) {
                $rules = array(
                    'photos' => 'required',
                    'photos.*' => 'image|mimes:jpg,jpeg,bmp,png,gif',
                    'photos.*' => 'dimensions:min_width=640,min_height=360',
                );


                $fieldNames = array(
                    'photos' => 'Photos',
                    'photos.*' => 'Photos'
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                } else {

                    foreach ($request->photos as $one_photo):
                        $name = str_replace(' ', '_', $one_photo->getClientOriginalName());
                        $name = replaceBracket($name);

                        $ext = pathinfo($name, PATHINFO_EXTENSION);

                        $name = time() . '_' . $name;

                        $path = 'images/property/' . $property_id;

                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }

                        $image = Image::make($one_photo);
                        $height = $image->height();
                        $width = $image->width();

                        $calculated_width = ceil((16 / 9) * $height);
                        $calculated_height = ceil($width / (16 / 9));
                        $applicable_height = 0;
                        $applicable_width = 0;

                        if ($height >= $calculated_height) {
                            $applicable_height = $calculated_height;
                            $applicable_width = $width;
                        } else {
                            $applicable_height = $height;
                            $applicable_width = $calculated_width;
                        }
                        $image->fit($applicable_width, $applicable_height)->save($path . "/" . $name);

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


                    return redirect('list/' . $property_id . '/credit-card');
                }
            }

            $data['photos'] = Photo::where('photoable_id', $property_id)
                ->where('photoable_type', 'App\Models\Properties')
                ->orderBy('serial', 'asc')
                ->get();

            return view('apartment.photos', $data);
        } elseif ($step == 'credit-card') {
            if ($request->isMethod('post')) {
                $property_credit = PropertyCredit::where('property_id', $property_id)->first();
                $property_credit->credit = $request->creditcard;
                $property_credit->save();
                return redirect('list/' . $property_id . '/pricing');
            }
            return view('apartment.credit-card');
        } elseif ($step == 'pricing') {
            if ($request->isMethod('post')) {
                $property_price = PropertyPrice::where('property_id', $property_id)->first();
                $property_price->price = $request->price;
                $property_price->monthly_discount = $request->monthly_discount;
                $property_price->save();
                return redirect('list/' . $property_id . '/booking');
            }
            return view('apartment.pricing');
        } elseif ($step == 'booking') {
            if ($request->isMethod('post')) {
                $properties = Properties::find($property_id);
                $properties->booking_type = $request->booking_type;
                $properties->status = 'Listed';
                $properties->save();

                return redirect('list/' . $property_id . '/licencing');
            }
            return view('apartment.booking');
        } elseif ($step == 'licencing') {
            if ($request->isMethod('post')) {
                $property_licence = PropertyLicence::where('property_id', $property_id)->first();
                $property_licence->licence_number = $request->licence_number;
                $property_licence->save();
                return redirect('list/' . $property_id . '/review');
            }
            return view('apartment.licencing');
        } elseif ($step == 'review') {
            if ($request->isMethod('post')) {
                $count = PropertyCount::where('host_id', Auth::id())->decrement('count', 1);
                $count = PropertyCount::where('host_id', Auth::id())->get('count');
                $locate = PropertyCount::where('host_id', Auth::id())->get('location');
                if ($locate = 'true' && $count = '0') {
                    return redirect('/dashboard');
                } else {
                    return view('apartment.name');
                }
            }
            return view('apartment.review');
        }
    }

    public function singleapartment(Request $request)
    {
        $property_count = new PropertyCount;
        $property_count->host_id = Auth::id();

        if ($_POST["apartment"] == "single") {
            $property_count = PropertyCount::where('host_id', Auth::id())->first();
            $property_count->count = "1";
            $property_count->location = "false";
            $property_count->apartment = $request->apartment;
            $property_count->save();
            return view('apartment.single.single_apartment');
        } else if ($_POST["apartment"] == "multiple") {

            $property_count = PropertyCount::where('host_id', Auth::id())->first();
            $property_count->apartment = $request->apartment;
            $property_count->count = $request->count;
            $property_count->location = $request->apartment_location;
            $property_count->save();

            return view('apartment.multiple.multiple_apartment');
        }
    }

    /**
     * property own type is one of the first endpoint while creating / listing your property
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function propertyOwnType(Request $request)
    {
        $title = 'Own Type';
        $property_type = $request->input('property_type');
        $property_type_id = $request->input('property_type_id');
        return view('property.own-type-default',compact('title','property_type','property_type_id'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmOwnType(Request $request)
    {
        $title = 'Confirm Own Type';
        $property_type = $request->input('property_type');
        $property_type_id = $request->input('property_type_id');
        $property_count = $request->input('property_count');
        $location_type = $request->input('location_type');
        return view('property.confirm-own-type-default',compact('title','property_type','property_type_id','property_count','location_type'));
    }

    //This will  be called from list your property flow from front end or client
    public function createUnlistedProperty(Request $request)
    {
        $request->validate([
            'property_type_id' => 'required',
        ]);
        //if location type is null considered one
        $user_id = auth()->user()->id;
        $property_type_id = $request->input('property_type_id');
        $name = 'New Property';
        $slug = PropertyHelper::getUniqueSLug( $user_id.'-'.Str::of($name)->slug('-'));
        $property_data = [
            'name'              => $name,
            'slug'              => $slug,
            'status'            => 'Draft',
            'host_id'           => $user_id,
            'property_type'     => $property_type_id,
            'space_type'        => 1,
        ];
        if($request->property_category)
        {
            $property_data['property_category'] =   $request->property_category;
        }
        $property = Properties::create($property_data);
        //change redirection from name to location
        return redirect()->route('partner.property.details.location',$property->id);
//        return view('property.details.property_name');
    }


   public function vacationHome(Request $request)
    {
        $title = 'Vacation Own Type';
        $property_type = $request->input('property_type');
        $property_type_id = $request->input('property_type_id');
       return view('property.vacation-home',compact('title','property_type','property_type_id'));
    }
    public function confirmVacationType(Request $request)
    {
        $title = 'Vacation Property Type';
        $categories = PropertyCategory::get();
        $property_count = $request->input('property_count');
        $location_type = $request->input('location_type');
        $property_type = $request->input('property_type');
        $property_type_id = $request->input('property_type_id');
        return view('property.entire-place',compact('title','property_count','location_type','property_type','property_type_id','categories'));
    }
}