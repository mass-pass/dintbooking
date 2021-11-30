@extends('layouts.master')

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="{{route('property.details.name',$property->id)}}" class="active">Name and location <span class="fil-success"></span><span class="fil-success"></span><span class="current"></span></a></li>
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
                        <h3 class="mb-5">Pin the location of your Property</h3>
                    </div>
                    <div class="col-lg-6">
                        <form id="pinLocationForm" method="POST"
                              action="{{route('property.details.pinLocation',$property->id)}}">
                            @csrf

                            <div class="place-section-right">
                                <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua.
                                </p>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114964.53925910071!2d-80.29949906059734!3d25.78239073313235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9b0a20ec8c111%3A0xff96f271ddad4f65!2sMiami%2C%20FL%2C%20USA!5e0!3m2!1sen!2sin!4v1624554473526!5m2!1sen!2sin"
                                        width="100%" height="600" style="border:0;" allowfullscreen=""
                                        loading="lazy"></iframe>
                            </div>
                            <hr class="mt-4">
                            <div class="btn-section-artment mt-2">
                                <a href="{{route('property.details.name',$property->id)}}"
                                   class="thme-btn-border mr-3"><i class="fa fa-chevron-left"
                                                                   aria-hidden="true"></i></a>
                                <button type="submit" class="btn thme-btn w-100">Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script  type="text/javascript">
        $(document).ready(function () {
            {{--$("#pinLocationForm").validate({--}}
            {{--    rules: {--}}
            {{--        address_line_2: "required",--}}
            {{--        city: "required",--}}
            {{--        postal_code: "required",--}}
            {{--        state: "required",--}}
            {{--    },--}}
            {{--    messages: {--}}
            {{--        address_line_2: "{{ __('messages.jquery_validation.required') }}",--}}
            {{--        city: "{{ __('messages.jquery_validation.required') }}",--}}
            {{--        postal_code: "{{ __('messages.jquery_validation.required') }}",--}}
            {{--        state: "{{ __('messages.jquery_validation.required') }}"--}}
            {{--    }--}}
            {{--});--}}
        });
    </script>
@endpush
