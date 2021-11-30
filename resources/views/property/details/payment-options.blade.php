@extends('layouts.master')

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location">Name and location</a></li>
            <li><a data-toggle="tab" href="#property-setup">Property Setup</a></li>
            <li><a data-toggle="tab" href="#photos" >Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar" class="active">Pricing and calendar<div>
                        <span class="current"></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div></a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
        </ul>
    </div>
    <div class="tab-content container">
        <div id="property-setup" class="tab-pane active">
            <div class="place-section brkfst-details">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="mb-5">Guest payment options</h3>
                    </div>
                    <div class="col-lg-6">
                        <form id="propertyDetailsForm" method="POST" action="{{route('partner.property.details.paymentOptions',$property->id)}}">
                            @csrf
                            <div class="place-section-right general-seting">
                                <h4 class="mb-4">Can you charge credit cards at your property?</h4>
                                <p><input type="radio" name="credit_allowed" value="1" {{ $property->credit_allowed == 1?'checked':'' }} class="mr-2">Yes</p>
                                <p><input type="radio" name="credit_allowed" value="0" {{ $property->credit_allowed == 0?'checked':'' }} class="mr-2">No</p>
                                <hr class="mt-5 mb-5">
                                <h4 >No problem! let guests pay online</h4>
                                <p class="mb-4 text-secondary">You can guests pay via payments by Dint.com</p>
                                <div class="breakfast-offers-section">

                                </div>
                            </div>
                            <hr class="mt-4">
                            <div class="btn-section-artment">
                                <a href="{{route('partner.property.details.photo',$property->id)}}" class="thme-btn-border mr-3"><i class="fas fa-chevron-left"></i></a>
                                <button type="submit" name="" id="btn-continue" class="btn thme-btn w-100">Continue</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3">
                        <div class="place-section-left d-flex">
                            <div class="mr-3"><i class="far fa-lightbulb-on"></i></div>
                            <span class="close-icon"><i class="fal fa-times"></i></span>
                            <div class="">
                                <h4>What should i consider when choosing name?</h4>
                                <p>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</p>
                                <p><a href="javascript:void(0);"><strong>Lorem ipsum dolor sit</strong></a></p>
                                <p>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 d-flex">
                        <div class="place-section-left d-flex mt-auto bg-thme">
                            <span class="close-icon"><i class="fal fa-times"></i></span>
                            <div class="">
                                <p>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</p>
                                <a href="javascript:void(0);" class="thme-btn-border-small">Lets Us Know</a>
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
