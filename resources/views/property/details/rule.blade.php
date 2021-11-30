@extends('layouts.master')

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location">Name and location</a></li>
            <li><a data-toggle="tab" href="#property-setup" class="active">Property Setup
                    <div><span class="fil-success"></span><span class="fil-success"></span><span
                                class="fil-success"></span><span class="fil-success"></span><span
                                class="current"></span></div>
                </a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
        </ul>
    </div>
    <div class="tab-content container">
        <div id="property-setup" class="tab-pane active">
            <div class="place-section brkfst-details">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="mb-5">Houses Rules</h3>
                    </div>
                    <div class="col-lg-6">
                        <form id="propertyDetailsForm" method="POST" action="{{route('partner.property.details.rule',$property->id)}}">
                            @csrf
                            <div class="place-section-right general-seting">
                                    <p class="d-flex justify-content-between">
                                        <label>Smooking allowed</label>
                                        <label class="switch-btn">
                                            <input type="checkbox" value="1" {{ $property->smoking_allowed == 1 ? 'checked':'' }} name="smoking_allowed">
                                            <span class="slider"></span>
                                        </label>
                                    </p>
                                    <div class="cstm-row">
                                        <div class="col-lg-12">
                                            <h5 class="mt-5">Check-In</h5>
                                        </div>


                                        <div class="col-lg-6">
                                            <label>From</label>
                                            <input type="time" value="{{ $property->check_in_from }}" name="check_in_from" class="form-control">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Until</label>
                                            <input type="time" value="{{ $property->check_in_until }}"  name="check_in_until" class="form-control">
                                        </div>
                                        <div class="col-lg-12">
                                            <h5 class="mt-5">Check-out</h5>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>From</label>
                                            <input type="time" value="{{ $property->checkout_from }}"  name="checkout_from" class="form-control">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Until</label>
                                            <input type="time" value="{{ $property->checkout_until }}" name="checkout_until" class="form-control">
                                        </div>
                                    </div>
                            </div>
                            <hr class="mt-4">
                            <div class="btn-section-artment">
                                <a href="{{route('partner.property.details.language',$property->id)}}" class="thme-btn-border mr-3"><i class="fas fa-chevron-left"></i></a>
                                <button type="submit" name="" class="btn thme-btn w-100">Continue</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3">
                        <div class="place-section-left d-flex">
                            <div class="mr-3"><i class="far fa-lightbulb-on"></i></div>
                            <span class="close-icon"><i class="fal fa-times"></i></span>
                            <div class="">
                                <h4>What if my house rules change?</h4>
                                <ul>
                                    <li>You can easily customize these house rules later, and you can set additional house rules on the policies page on the Partner's dashboard after completing registration</li>
                                
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
