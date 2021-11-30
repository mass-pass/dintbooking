@extends('layouts.master')

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location">Name and location</a></li>
            <li><a data-toggle="tab" href="#property-setup" class="active">Property Setup<div><span class="fil-success"></span><span class="current"></span><span></span><span></span><span></span></div></a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
        </ul>
    </div>
    <div class="tab-content container">
        <div id="property-setup" class="tab-pane active">
            <div class="place-section">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="mb-5">What can guests use at your place?</h3>
                    </div>
                    <div class="col-lg-6">
                        <form id="propertyDetailsForm" method="POST" action="{{route('partner.property.details.amenities',$property->id)}}">
                            @csrf

                            
                            <div class="place-section-right general-seting">

                            @foreach($amenities_type as $row_type)
										<div class="">
											<div class=""> <h4 class="mb-4 mt-4">{{ $row_type->name }} <span class="text-danger">*</span></h4></div>
										</div>
										
										<div class="">
											@if($row_type->description != '')
												<p class="text-muted">{{ $row_type->description }}</p>
											@endif
											<div class="">
												<ul class="list-unstyled">
													@foreach($amenities as $amenity)
													@if($amenity->type_id == $row_type->id)
													<li>
														<label class="label-large label-inline amenity-label">
														<input type="checkbox" value="{{ $amenity->id }}" name="amenities[]" data-saving="{{ $row_type->id }}" {{ in_array($amenity->id, $property_amenities) ? 'checked' : '' }}> &nbsp;&nbsp;
														<span>{{ $amenity->title }}</span>
														</label>
														<span>&nbsp;</span>

														@if($amenity->description != '')
														<span data-toggle="tooltip" class="icon" title="{{ $amenity->description }}"></span>
														@endif
													</li>
													@endif
													@endforeach
												</ul>
											</div>
										</div>
                                        <hr class="mt-5 mb-5">

									@endforeach



                            </div>
                            <hr class="mt-4">
                            <div class="btn-section-artment">
                                <a href="{{route('partner.property.details.propertyDetails',$property->id)}}" class="thme-btn-border mr-3"><i class="fas fa-chevron-left"></i></a>
                                <button type="submit" name="" class="btn thme-btn w-100" xdisabled="">Continue</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3">
                        <div class="place-section-left d-flex">
                            <div class="mr-3"><i class="far fa-lightbulb-on"></i></div>
                            <span class="close-icon"><i class="fal fa-times"></i></span>
                            <div class="">
                                <h4>What if I don't see a facility I offer?</h4>
                                <ul>
                                    <li>The facilities listed here are the ones guests search for most. After you complete your registration, you can add more facilities from a larger list on the Partner's dashboard, the platform you'll use to manage your property.
                                    
                                    The ones selected here will apply to all your apartments.</li>
                                 
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
    <script  type="text/javascript">
        {{--$(document).ready(function () {--}}
        {{--    $("#locationForm").validate({--}}
        {{--        rules: {--}}
        {{--            address_line_2: "required",--}}
        {{--            city: "required",--}}
        {{--            postal_code: "required",--}}
        {{--            state: "required",--}}
        {{--        },--}}
        {{--        messages: {--}}
        {{--            address_line_2: "{{ __('messages.jquery_validation.required') }}",--}}
        {{--            city: "{{ __('messages.jquery_validation.required') }}",--}}
        {{--            postal_code: "{{ __('messages.jquery_validation.required') }}",--}}
        {{--            state: "{{ __('messages.jquery_validation.required') }}"--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endpush
