<?php

namespace App\Http\Controllers;

use Auth;

use App\Helpers\PropertyHelper;
use App\Models\Country;
use App\Models\Properties;
use App\Models\PropertyPrice;
use App\Models\Amenities;
use App\Models\AmenityType;
use App\Models\Photo;
use App\Models\Address;
use App\Models\PropertyBedsApartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PropertyDetailController extends Controller
{

    public function detailsName(Request $request, $id)
    {
        $title = 'Property Name';
        $property = Properties::findOrFail($id);
        $property_address = $property->address;
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {
//            $request->validate([
//               'property_name' => 'required'
//            ]);
            $property->name = $request->input('property_name');
            $property->slug = PropertyHelper::getUniqueSLug(Str::slug($property->name, '-'));
            $property->status = 'Unlisted';
            $property->updated_at = now();
            $property->save();
             //change redirection from  location to pinLocation
            return redirect()->route('partner.property.details.propertyDetails',$property->id);
        }
        return view('property.details.name',compact('property','title', 'property_address'));
    }

    public function detailsLocation(Request $request, $id)
    {
        $title = 'Property Location';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        $countries = Country::orderBy('name','asc')->get();
        if ($request->isMethod('post')) {
            $address = $property->address;


            $full_address =$request->input('address_line_1');
            $address1      = str_replace([" ","%2C"], ["+",","], "$full_address");
            $map_where    = 'https://maps.google.com/maps/api/geocode/json?key='.env('GOOGLE_MAP_API_KEY').'&address='.$address1.'&sensor=false&libraries=places';
            $geocode      = (new SearchController)->content_read($map_where);
            $json         = json_decode($geocode);
            if ($json->{'results'}) {
                $data['lat'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                $data['long'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
            } else {
                $data['lat'] = 0;
                $data['long'] = 0;

            }

            if (!$address) {

                $address = new Address([
                    'country' => $request->input('country'),
                    'street_address' => $request->input('address_line_1'),
                    'address_line_1' => $request->input('address_line_1'),
                    'postal_code' => $request->input('postal_code'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'longitude' =>$data['long'] ,
                    'latitude' => $data['lat'] ,
                ]);
            } else {
                $address->fill($request->all())->save();
            }
           $property->address()->save($address);

             //change redirection from  pinlocation to name
            return redirect()->route('partner.property.details.name',$id);
        }
        return view('property.details.location',compact('title','property','countries'));
    }

    public function detailsPropertyDetails(Request $request, $id)
    {
        $title = 'Property Details';
        $property = Properties::findOrFail($id);
        $propertyBedsApartments = PropertyBedsApartment::where('property_id', $id)->get();
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {
            Properties::where('id', '=', $id)
                ->update([
                    'guests' => $request->input('num_of_guest'),
                    'bathrooms' => $request->input('num_of_bathrooms'),
                    'apartment_size_metric' => $request->input('apartment_size_metric'),
                    'apartment_size' => $request->input('apartment_size')
                ]);
            return redirect()->route('partner.property.details.amenities',$id);
        }
        return view('property.details.property_details',compact('title','property', 'propertyBedsApartments'));
    }

    public function detailsBedroom(Request $request, $id)
    {
        $title = 'Bedroom';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {
            
            $propertyBedsApartment = PropertyBedsApartment::Create(
                [
                    'property_id'           => $id,
                    'single_bedroom'               => $request['single_bedroom'],
                    'double_bedroom'        => $request['double_bedroom'],
                    'large_bedroom'              => $request['large_bedroom'],
                    'extra_large_bedroom'                  => $request['extra_large_bedroom'],
                    'bunk_bedroom_div'                 => $request['bunk_bedroom'],
                    'sofa_bedroom_div'                  => $request['sofa_bedroom'],
                    'futon_bedroom_div'                 => $request['futon_bedroom'],
                    'from_user'             =>  Auth::user()->id
                ]
            );
            return redirect()->route('partner.property.details.propertyDetails',$id);
        }
        return view('property.details.bedroom',compact('title','property'));
    }

    public function detailsAmenities(Request $request, $id)
    {
        $title = 'Amenities';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {
            //Perform insertion
            $property->amenities = !is_null($request->amenities)?implode(',', $request->amenities):'';
            $property->save();
            return redirect()->route('partner.property.details.breakfast',$id);
        }

        $property_amenities = explode(',', $property->amenities);
        $amenities = Amenities::where('status', 'Active')->get();
        $amenities_type = AmenityType::get();

        return view('property.details.amenities',compact('title','property','property_amenities','amenities_type', 'amenities'));
    }
    public function detailsBreakfast(Request $request, $id)
    {
        $title = 'Amenities';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {
            //Perform insertion
            $property->breakfast =  $request->breakfast;
            $property->breakfast_price_included =  $request->breakfast_price_included;
            $property->breakfast_price =  $request->breakfast_price;
            $property->save();
            return redirect()->route('partner.property.details.language',$id);
        }
        return view('property.details.breakfast',compact('title','property'));
    }
    public function detailsLanguage(Request $request, $id)
    {
        $title = 'Language';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        $languages = getLanguagesList();
        $property_languages = explode(',', $property->languages);

        if ($request->isMethod('post')) {
            //Perform insertion
            $property->languages = !is_null($request->languages)?implode(',', $request->languages):'';
            $property->save();

            return redirect()->route('partner.property.details.rule',$id);
        }
        return view('property.details.language',compact('title','property', 'property_languages', 'languages'));
    }
    public function detailsRule(Request $request, $id)
    {
        $title = 'Rules';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {
            //Perform insertion
            $property->smoking_allowed = $request->smoking_allowed;

            $property->check_in_from = $request->check_in_from;
            $property->check_in_until = $request->check_in_until;
            $property->checkout_from = $request->checkout_from;
            $property->checkout_until = $request->checkout_until;
            $property->save();

            return redirect()->route('partner.property.details.photo',$id);
        }
        return view('property.details.rule',compact('title','property'));
    }
    public function detailsPhoto(Request $request, $id)
    {
        $title = 'Photo';
        $property = Properties::findOrFail($id);
        $property_photo = $property->photo;
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {
            //Perform insertion
            //return redirect()->route('property.details.paymentOptions',$id);
            return redirect()->route('partner.property.details.pricePerNight',$id);

        }
        return view('property.details.photo',compact('title','property','property_photo'));
    }
    public function detailsPhotoAirBnb(Request $request, $id)
    {
        $title = 'Photo AirBnb';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {
            //Perform insertion
            return redirect()->route('partner.property.details.paymentOptions',$id);

        }
        return view('property.details.photo-airbnb',compact('title','property'));
    }
    public function detailsPaymentOptions(Request $request, $id)
    {
        $title = 'Payment Options';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {
            //Perform insertion
            $property->credit_allowed = $request->credit_allowed;
            $property->save();
            return redirect()->route('partner.property.details.pricePerNight',$id);
        }
        return view('property.details.payment-options',compact('title','property'));
    }
    public function detailsPricePerNight(Request $request, $id)
    {
        $title = 'Price Per Night';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {
            //Perform insertion

            $property_price                    = PropertyPrice::where('property_id', $property->id)->first();
            if(!$property_price){
                $property_price = new PropertyPrice;
                $property_price->property_id = $property->id;
                $property_price->currency_code = empty(\Session::get('currency'))?\Session::get('currency'):'USD';
                $property_price->save();
        
            }
            
            $property_price->price             = $request->price;
            $property_price->weekly_discount   = $request->weekly_discount;
            $property_price->monthly_discount  = $request->monthly_discount;
            $property_price->currency_code     = empty($request->currency_code)?$property_price->currency_code:$request->currency_code;
            $property_price->cleaning_fee      = $request->cleaning_fee;
            $property_price->guest_fee         = $request->guest_fee;
            $property_price->guest_after       = $request->guest_after;
            $property_price->security_fee      = $request->security_fee;
            $property_price->weekend_price     = $request->weekend_price;
            $property_price->save();

            return redirect()->route('partner.property.details.ratePlans',$id);
        }
        return view('property.details.price-per-night',compact('title','property'));
    }
    public function detailsRatePlans(Request $request, $id)
    {
        $title = 'Rate Plans';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        $cancellation_policy = $property->latest_cancellation_policy();
        if ($request->isMethod('post')) {
            $cancellation_policy = new \App\Models\CancellationPolicy();
            $cancellation_policy->property_id =  $id;
            $cancellation_policy->cancellation_days_before = $request->cancellation_days_before;
            $cancellation_policy->protect_against_accidental_bookings  = isset($request->protect_against_accidental_bookings)?$request->protect_against_accidental_bookings:0;
            $cancellation_policy->save();
            return redirect()->route('partner.property.details.availability',$id);
        }
        return view('property.details.rate-plans',compact('title','property', 'cancellation_policy'));
    }
    public function detailsAvailability(Request $request, $id)
    {
        $title = 'Availability';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {
            //Perform insertion
            return redirect()->route('partner.property.details.legalInfo',$id);
        }
        $data = [];
        $data['title'] = $title;
        $property_id = $property->id;
        $data['property'] = $property;
        $data['result'] = $property;
        $data['details'] = \App\Models\PropertyDetails::pluck('value', 'field');
        $calendar = new \App\Http\Controllers\Partner\CalendarController();
        $data['calendar'] = $calendar->generate($property->id);

        return view('property.details.availability', $data);
    }
    public function detailsAvailabilityDate(Request $request, $id)
    {
        $title = 'Availability Date';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {
            //Perform insertion
            return redirect()->route('partner.property.details.availability',$id);
        }
        return view('property.details.availability-date',compact('title','property'));
    }
    public function detailsLegalInfo(Request $request, $id)
    {
        $title = 'Legal Info';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {
            //Perform insertion
            $property->tax_number = $request->tax_number;
            $property->licence_number = $request->licence_number;
            $property->save();
            return redirect()->route('partner.property.details.finalize',$id);
        }
        return view('property.details.legal-info',compact('title','property'));
    }
    public function detailsFinalize(Request $request, $id)
    {
        $title = 'Finalize';
        $property = Properties::findOrFail($id);
        Gate::authorize('update-property', $property);
        if ($request->isMethod('post')) {

            $property->status ='Listed';
            $property->accommodates ='1';
            $property->save();
            return redirect()->route('user_dashboard');
        }
        return view('property.details.finalize', compact('title','property'));
    }

}
