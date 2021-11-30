@extends('layouts.master')

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location" >Name and location </a></li>
            <li>
                <a data-toggle="tab" href="#property-setup">
                    Property Setup
                </a>
            </li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar" class="active">Pricing and calendar<div>
                        <span class="fil-success"></span>
                        <span class="current"></span>
                        <span></span>
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
                    <div class="col-lg-12">
                        <h3 class="mb-5">Price per night</h3>
                    </div>
                    <div class="col-lg-6">
                        <form id="propertyRateForm" method="POST" action="{{route('partner.property.details.pricePerNight',$property->id)}}">
                            @csrf
                            <div class="place-section-right">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco <strong>US$ 141.88</strong>and <strong>US$ 257.31</strong> sunt in culpa qui officia deserunt mollit anim id est laborum.a <strong>US$ 227.86</strong>
                                    <a href="javascript:void(0);">Learn more</a>
                                </p>
                                <hr class="mt-4">
                                <p>Did this help you decide on a price? <a href="javascript:void(0);"><i class="far fa-thumbs-up mr-3"></i></a><a href="javascript:void(0);"><i class="far fa-thumbs-down"></i></a>
                                </p>
                            </div>
                            <div class="place-section-right">
                                <div class="bedroom-section-lft">
                                    <h4 class="mb-3">How much do you want to charge per night</h4>
                                    <label class="d-block">Price guests pay</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">US$</span>
                                        </div>
                                        <input type="text" name="price" class="form-control w-75">
                                        <p>Inculiding taxes, commission, and fee</p>
                                    </div>
                                </div>
                                
                                <!--<hr class="mt-4 mb-3">
                                <h4 class="mb-3">Want to lower your price by 20% for your guests</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud
                                </p>
                                <p><input type="radio" name="" class="mr-2">Yes
                                    <input type="radio" name="" class="mr-2">No
                                </p>
                                <div class="place-section-right-cnfrm-box d-flex">
                                    <div class="lft">
                                        <i class="far fa-check-circle mr-2"></i>
                                    </div>
                                    <div class="righttt">
                                        <h5>Lorem ipsum dolor sit amet</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                    </div>
                                </div>-->
                            </div>
                            <!--<div class="place-section-right">
                                <p>Lorem <strong>ipsum dolor sit amet</strong></p>
                                <ul class="pl-4">
                                    <li><i class="fal fa-check mr-2"></i>Lorem ipsum dolor sit amet</li>
                                    <li><i class="fal fa-check mr-2"></i>Lorem ipsum dolor sit amet</li>
                                    <li><i class="fal fa-check mr-2"></i>Lorem ipsum dolor sit amet</li>
                                    <li><i class="fal fa-check mr-2"></i>Lorem ipsum dolor sit amet</li>
                                </ul>
                                <hr class="mt-4">
                                <p>Lorem <strong>ipsum dolor sit amet</strong></p>
                            </div>-->
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
