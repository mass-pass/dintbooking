@extends('layouts.master')

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="{{route('property.details.name',$property->id)}}" class="active">Name and location <div>
                <span class="fil-success"></span>
                <span class="current"></span>
                </div></a></li>
            <li><a data-toggle="tab" href="#property-setup">Property Setup</a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
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
                        <h3 class="mb-5">What's the name of your place?</h3>
                        <p class="mt-3">This is the location we'll show guests on our site.</p>
                    </div>
                    <div class="col-lg-6">
                        <form method="POST" action="{{route('partner.property.details.name',$property->id)}}">
                            @csrf
                            <div class="place-section-right">
                                <label class="mt-4">Property Name</label>
                                <input type="text" name="property_name" class="w-100 form-control @error('property_name') is-invalid @enderror"
                                       value="{{($property->status !== 'Draft')?$property->name:''}}">
                                @error('property_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <?php 
                                    $address = ($property_address) ? str_replace(" ", "+", $property_address->address_line_1) : '';
                                ?>
                                <iframe class="mt-5" src="https://www.google.com/maps/embed/v1/place?key={{ @$map_key }}&q={{ $address }}"
                                        width="100%" height="300" style="border:0;" allowfullscreen=""
                                        loading="lazy"></iframe>
                            </div>
                            <hr class="mt-4">
                            <div class="btn-section-artment mt-2">
                            <a href="{{route('partner.property.details.location',$property->id)}}" class="thme-btn-border mr-3"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                            <button type="submit" name="" id="btn-continue" class="btn thme-btn w-100">Continue</button>
                        </div>
                            <!-- <button type="submit" class="thme-btn w-100 mt-2">Continue</button> -->
                        </form>
                    </div>
                    <div class="col-lg-3">
                        <div class="place-section-left d-flex">
                            <div class="mr-3"><i class="far fa-thumbs-up"></i></div>
                            <span class="close-icon"><i class="fal fa-times"></i></span>
                            <div class="">
                                <h4>What should I consider when choosing a name?</h4>
                                <ul>
                                <li>Keep it short and catchy</li>
                                    <li>Avoid abbreviations</li>
                                    <li>Stick to the facts</li>
                                </ul>
                            </div>
                        </div>
                        <div class="place-section-left d-flex">
                            <div class="mr-3"><i class="far fa-lightbulb-on"></i></div>
                            <span class="close-icon"><i class="fal fa-times"></i></span>
                            <div class="">
                                <h4>Why I need to name my property?</h4>
                                <ul>
                                    <li>This is the name that will appear as the title of your listing on our site. It should tell guests something specific about your place, where it is, or what you offer. This will be visible to anyone visiting our site, so don't include your address in the name. </li>
                              
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

@endpush