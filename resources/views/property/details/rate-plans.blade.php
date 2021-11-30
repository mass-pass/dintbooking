@extends('layouts.master')

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location" >Name and location </a></li>
            <li>
                <a data-toggle="tab" href="#property-setup">Property Setup</a>
            </li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar" class="active">Pricing and calendar<div>
                        <span class="fil-success"></span>
                        <span class="fil-success"></span>
                        <span class="current"></span>
                        <span></span>
                    </div></a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
        </ul>
    </div>
    <div class="tab-content container">
        <div id="property-setup" class="tab-pane active">

            <div class="place-section">
                <div class="row">
                    <!--<div class="col-lg-12">
                        <h3 class="mb-5">Rate plans</h3>
                    </div>-->
                    <div class="col-lg-12">
                     <h3 class="mb-5">Cancellation policies</h3>
                  </div>
                    <div class="col-lg-6">
                        <form id="propertyDetailsForm" method="POST" action="{{route('partner.property.details.ratePlans',$property->id)}}">
                            @csrf
                            <!--<div class="place-section-right">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure
                                </p>
                                </p>
                            </div>
                            <h3 class="mb-5">Standard Rate plans</h3>
                            <div class="place-section-right">
                                <div class="bedroom-section-lft d-flex justify-content-between w-100">
                                    <h4>Price per group size</h4>
                                    <a href="javascript:void(0);" class="thme-btn-border text-right">Edit</a>
                                </div>
                                <hr class="mt-4 mb-3">
                                <p> <i class="fas fa-exclamation mr-2"></i>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut
                                </p>
                                <div class="place-section-right-group1">
                                    <ul>
                                        <li>
                                     <span class="left-sec">
                                        <h4 class="mb-0">Occupancy</h4>
                                     </span>
                                            <span class="right-sec">
                                        <h4 class="mb-0">Guest pay</h4>
                                     </span>
                                        </li>
                                        <li>
                                            <span class="left-sec"><i class="far fa-user mr-2"></i><span class="mr-2">x</span>4</span>
                                            <span class="right-sec">US$ 240.00</span>
                                        </li>
                                        <li>
                                            <span class="left-sec"><i class="far fa-user mr-2"></i><span class="mr-2">x</span>3</span>
                                            <span class="right-sec">US$ 216.00</span>
                                        </li>
                                        <li>
                                            <span class="left-sec"><i class="far fa-user mr-2"></i><span class="mr-2">x</span>2</span>
                                            <span class="right-sec">US$ 204.00</span>
                                        </li>
                                        <li>
                                            <span class="left-sec"><i class="far fa-user mr-2"></i><span class="mr-2">x</span>1</span>
                                            <span class="right-sec">US$ 192.00</span>
                                        </li>
                                    </ul>
                                </div>
                                <hr class="mt-4 mb-4">
                                <div class="bedroom-section-lft d-flex justify-content-between w-100">
                                    <h4>Cancellition policy</h4>
                                    <a href="javascript:void(0);" class="thme-btn-border text-right">Edit</a>
                                </div>
                                <hr class="mt-4 mb-3">
                                <div class="d-flex align-items-center mb-5">
                                    <i class="fas fa-exclamation mr-5"></i>
                                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et.</p>
                                </div>
                                <div class="d-flex align-items-center mb-5">
                                    <i class="far fa-check-circle mr-5"></i>
                                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et.</p>
                                </div>
                            </div> -->



                            <div class="place-section-right cancellation-policies">
                        <p class="mb-4">How many, days before arrival can guests <strong>cancel their booking for free?</strong></p>
                        <div class="d-flex">
                           <span class="p-2 bg-success text-white rounded">Recommended</span>
                        </div>
                        <div class="btn-group btn-group-toggle cancel-limit-container" data-toggle="buttons">
                            <label class="cancel-limit btn btn-light btn-lg {{ ($cancellation_policy && $cancellation_policy->cancellation_days_before == 1) || (!$cancellation_policy) ? 'active': '' }}">
                                <input type="radio" name="cancellation_days_before" {{ ($cancellation_policy && $cancellation_policy->cancellation_days_before == 1) || (!$cancellation_policy) ? 'checked': '' }} value="1" autocomplete="off"> 1 Day
                            </label>
                            <label class="cancel-limit btn btn-light btn-lg {{ $cancellation_policy && $cancellation_policy->cancellation_days_before == 5 ? 'active': '' }}">
                                <input type="radio" name="cancellation_days_before" value="5" {{ $cancellation_policy && $cancellation_policy->cancellation_days_before == 5 ? 'checked': '' }} autocomplete="off" > 5 days
                            </label>
                            <label class="cancel-limit btn btn-light btn-lg {{ $cancellation_policy && $cancellation_policy->cancellation_days_before == 14 ? 'active': '' }}">
                                <input type="radio" name="cancellation_days_before" value="14" {{ $cancellation_policy && $cancellation_policy->cancellation_days_before == 14 ? 'checked': '' }} autocomplete="off" > 14 days
                            </label>
                            <label class="cancel-limit btn btn-light btn-lg {{ $cancellation_policy && $cancellation_policy->cancellation_days_before == 30 ? 'active': '' }}">
                                <input type="radio" name="cancellation_days_before" value="30" autocomplete="off" {{ $cancellation_policy && $cancellation_policy->cancellation_days_before == 30 ? 'checked': '' }} > 30 days
                            </label>
                        </div>


                        <div class="d-flex mt-5 mb-5">
                           <i class="fa fa-info-circle text-24" aria-hidden="true"></i>
                           <div class="ml-3">
                              <p class="text-dark">Guests love flexiblity - free cancellation rates are generally the most booked rates On our site. Get your first booking sooner by allowing  guests to cancel up to 5 days before check-in.</p>
                            </div>
                        </div>
                        <h4 class="mb-4">Protection against accidental bookings </h4>
                       <p class="d-flex align-items-center">
                           <label class="switch-btn">
                             <input type="checkbox" value="1" name="protect_against_accidental_bookings" {{ $cancellation_policy && $cancellation_policy->protect_against_accidental_bookings == 1 ? 'checked': '' }}>
                             <span class="slider"></span>
                           </label>
                           <label class="ml-2">On</label>
                        </p>
                        <p>To avoid having to deal with accidental bookings, we automaticaly waive cancelation fees for guests who cancel within 24 hours of booking.</p>
                     </div>

                            <hr class="mt-4">
                            <div class="btn-section-artment">
                                <a href="{{route('partner.property.details.pricePerNight',$property->id)}}" class="thme-btn-border mr-3"><i class="fas fa-chevron-left"></i></a>
                                <button type="submit" name="" id="btn-continue" class="btn thme-btn w-100">Continue</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 ">
                        <div class="place-section-left d-flex">
                            <div class="mr-3"><i class="far fa-lightbulb-on"></i></div>
                            <span class="close-icon"><i class="fal fa-times"></i></span>
                            <div class="">
                            <h4>What policy should I choose?</h4>
                            <p>Any policy you select now can be easily updated after you complete registration</p>
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
