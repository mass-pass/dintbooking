@extends('layouts.master')

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li>
                <a data-toggle="tab" href="{{route('partner.property.details.name',$property->id)}}" class="active">Name and location 
                   
                    <span class="current"></span>
                    <span></span>
                </a>
            </li>
            <li><a data-toggle="tab" href="#property-setup">Property Setup</a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
        </ul>
    </div>
    <?php
       $propertyAddress = $property->property_address;
    ?>
    <div class="tab-content container">
        <div id="name-and-location" class="tab-pane active">
            <div class="place-section">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="mb-5">Where is the property you're listing</h3>
                    </div>

                    <div class="col-lg-6">
                        <form id="locationForm" method="POST" action="{{route('partner.property.details.location',$property->id)}}">

                        <div class="place-section-right">
                            <p class="mt-3">
                            </p>
                                <div class="form-group">
                                    @csrf
                                    <label>Country/region</label>
                                    <select name="country" id="country" class="form-control">
                                        @foreach($countries as $k => $v)
                                            <option {{($propertyAddress && $propertyAddress->country === $v->short_name)?'selected':''}} value="{{$v->short_name}}">{{$v->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Street name and house number</label>
                                    <input type="text" id="address_line_2" autocomplete="off" name="address_line_1" class="w-100 form-control @error('address_line_1') is-invalid @enderror"
                                           value="{{($propertyAddress) ? $propertyAddress->address_line_1 : ""}}">
                                    @error('address_line_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    </br>
                                    @enderror
                                    <span>Add apartment or floor number</span>
                                </div>
                                <div class="form-group">
                                    <label>Zip code</label>
                                    <input type="text" id="postal_code" name="postal_code" class="w-50 form-control @error('postal_code') is-invalid @enderror"
                                           value="{{($propertyAddress)?$propertyAddress->postal_code:''}}">
                                    @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror"
                                           value="{{($propertyAddress) ? $propertyAddress->city:""}}">
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" id="state" name="state" class="form-control @error('state') is-invalid @enderror"
                                           value="{{($propertyAddress)?$propertyAddress->state:""}}">
                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                        </div>
                        <hr class="mt-4">
                        <!-- <div class="btn-section-artment mt-2"> -->
                            <!-- <a href="{{route('property.details.name',$property->id)}}" class="thme-btn-border mr-3"><i class="fa fa-chevron-left" aria-hidden="true"></i></a> -->
                            <button type="submit" name="" id="btn-continue" class="btn thme-btn w-100">Continue</button>
                        <!-- </div> -->
                        </form>
                    </div>


                    <div class="col-lg-3">
                        <div class="place-section-left d-flex">
                            <div class="mr-3"><i class="far fa-thumbs-up"></i></div>
                            <span class="close-icon"><i class="fal fa-times"></i></span>
                            <div class="">
                                <h4>What needs to be included in my address?</h4>
                                <ul>
                                    <li>Include both your street name and number for the entire property</li>
                                    <li>Individual apartment of floor numbers can be shared later</li>
                                    <li>Provide the zipcode</li>
                                    <li>Spell the street name correctly</li>
                                    <li>Use the physical address of the property, not your office or honme address</li>
                                </ul>
                            </div>
                        </div>


                        
                        <div class="place-section-left d-flex">
                            <div class="mr-3"><i class="far fa-lightbulb-on"></i></div>
                            <span class="close-icon"><i class="fal fa-times"></i></span>
                            <div class="">
                                <h4>Why do I need to add my address? </h4>
                                <ul>
                                <li>Once a guest books your property, this is the address that will be shared with them. It's important that it's correct so guests can easily find your property</p>
                                 
                            </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
	<script type="text/javascript">
        let autocomplete;
        function initialize() {
            var input = document.getElementById('address_line_2');
            autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener("place_changed", fillInAddress);
        }

        function fillInAddress() {
            const place = autocomplete.getPlace();
            let address1 = "";
            let postcode = "";
            for (const component of place.address_components) {
                const componentType = component.types[0];

                switch (componentType) {
                case "street_number": {
                    address1 = `${component.long_name} ${address1}`;
                    break;
                }

                case "route": {
                    address1 += component.short_name;
                    break;
                }

                case "postal_code": {
                    postcode = `${component.long_name}${postcode}`;
                    break;
                }

                case "postal_code_suffix": {
                    postcode = `${postcode}-${component.long_name}`;
                    break;
                }
                case "locality":
                    document.querySelector("#city").value = component.long_name;
                    break;

                case "administrative_area_level_1": {
                    document.querySelector("#state").value = component.long_name;
                    break;
                }
                case "country":
                    document.querySelector("#country").value = component.short_name;
                    break;
                }
            }
            
            $('#postal_code').val(postcode);
        }

        $(document).ready(function () {
            google.maps.event.addDomListener(window, 'load', initialize);
            $("#locationForm").validate({
                rules: {
                    address_line_2: "required",
                    city: "required",
                    postal_code: "required",
                    state: "required",
                },
                messages: {
                    address_line_2: "{{ __('messages.jquery_validation.required') }}",
                    city: "{{ __('messages.jquery_validation.required') }}",
                    postal_code: "{{ __('messages.jquery_validation.required') }}",
                    state: "{{ __('messages.jquery_validation.required') }}"
                }
            });
        });

        
	</script>
	
@endpush


