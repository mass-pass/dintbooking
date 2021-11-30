@extends('layouts.master')

@section('main')
    <?php
    if ($property_count === 'one') {
        $imageName = 'apartment';
        $headerText = __('property.confirm_single_apartment');
    } else {
        if($location_type === 'multiple'){
            $headerText = __('property.confirm_multiple_apartment_multiple_locations');
        }else{
            $headerText = __('property.confirm_multiple_apartment_single_locations');
        }
        $imageName = 'apartments';
    }

    ?>
    <div class="aparment-section">
        <div class="container">
            <div class="col-lg-5">
                <form action="{{route('partner.property.createUnlistedProperty')}}">
                    <div class="text-center listing-section-inner">
                        <h5>You're listing:</h5>
                        <span class="d-block">
                  <img src="{{asset('images/property-type-category/'.$imageName.'.png')}}">
                  </span>
                        <h3>{{$headerText}}</h3>
                        <p class="mb-5">Does this sound like your property?</p>
                        <input type="hidden" name="property_type_id" value="{{$property_type_id}}">
                        <input type="hidden" name="property_type" value="{{$property_type}}">
                        <input type="hidden" name="'property_count" value="{{$property_count}}">
                        <input type="hidden" name="location_type" value="{{$location_type}}">
                        <button type="submit" class="w-100 thme-btn mb-4">Continue</button>
                        <a href="{{route('list-property')}}" class="w-100 thme-btn-border btn-block">No, i need to make
                            a change</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop