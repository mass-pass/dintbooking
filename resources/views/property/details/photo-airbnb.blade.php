@extends('layouts.master')

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location">Name and location</a></li>
            <li><a data-toggle="tab" href="#property-setup">Property Setup</a></li>
            <li><a data-toggle="tab" href="#photos" class="active">Photos<div><span class="fil-success"></span></div></a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
        </ul>
    </div>
    <div class="tab-content container">
        <div id="name-and-location" class="tab-pane active">
            <div class="place-section">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="mb-5">What does your place look like?</h3>
                    </div>
                    <div class="col-lg-6">
                        <div class="place-section-right">
                            <span><i class="fas fa-images mr-2"></i></span>
                            <h4 class="mt-3 mb-5">Import photos from your Airbnb listing</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis</p>
                            <p>Photo taken by Airbnb's professional photographers can not be uploaded here</p>
                            <form>
                                <div class="form-group">
                                    <label>Live listing URL address:</label>
                                    <input type="text" class="form-control">
                                </div>
                            </form>
                        </div>
                        <hr class="mt-4">
                        <div class="btn-section-artment mt-2">
                            <a href="javascript:void(0);" class="thme-btn-border mr-3"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                            <input type="submit" name="" class="btn thme-btn w-100 disabled" value="Continue">
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
