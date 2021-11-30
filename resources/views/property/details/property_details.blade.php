@extends('layouts.master')

@push('css')
<style type="text/css">
        input[type="text" i] {
            border: none;
            width: 45px;
        }

        .bedroom-section-inner span{
            margin: 10px 0;
        }
</style>
@endpush 

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location" >Name and location </a></li>
            <li><a data-toggle="tab" href="#property-setup" class="active">Property Setup<div><span class="current"></span><span></span><span></span><span></span><span></span></div></a></li>
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
        <div id="property-setup" class="tab-pane active">
            <div class="place-section">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="mb-5">Property details</h3>
                    </div>
                    <div class="col-lg-6">
                        <form id="propertyDetailsForm" method="POST" action="{{route('partner.property.details.propertyDetails',$property->id)}}">
                            @csrf
                            <div class="place-section-right">
                                <label class="d-block mb-3">Where can people sleep?</label>
                                <div class="d-flex bedroom-section">
                                    <div class="bedroom-section-lft">
                                        @if(!$propertyBedsApartments->isEmpty())
                                            @php
                                                $i = 1
                                            @endphp
                                            @foreach($propertyBedsApartments as $propertyBedsApartment)
                                                <div class="bedroom-section-inner">
                                                    <p>Bedroom {{$i}}</p>
                                                    @if($propertyBedsApartment->single_bedroom != 0)
                                                        <span>{{ $propertyBedsApartment->single_bedroom }} Single bed</span>
                                                    @endif
                                                    @if($propertyBedsApartment->double_bedroom != 0)
                                                        <span>{{ $propertyBedsApartment->double_bedroom }} Double bed</span>
                                                    @endif
                                                    @if($propertyBedsApartment->large_bedroom != 0)
                                                        <span>{{ $propertyBedsApartment->large_bedroom }} Large bed</span>
                                                    @endif
                                                    @if($propertyBedsApartment->extra_large_bedroom != 0)
                                                        <span>{{ $propertyBedsApartment->extra_large_bedroom }} Extra Large bed</span>
                                                    @endif
                                                    @if($propertyBedsApartment->sofa_bedroom_div != 0)
                                                        <span>{{ $propertyBedsApartment->sofa_bedroom_div }} Sofa bed</span>
                                                    @endif
                                                    @if($propertyBedsApartment->futon_bedroom_div != 0)
                                                        <span>{{ $propertyBedsApartment->futon_bedroom_div }} Futon bed</span>
                                                    @endif
                                                    @if($propertyBedsApartment->bunk_bedroom_div != 0)
                                                        <span>{{ $propertyBedsApartment->bunk_bedroom_div }} Bunk bed</span>
                                                    @endif
                                                    
                                                </div>
                                                @php
                                                    $i = $i +1
                                                @endphp
                                            @endforeach
                                        @endif
                                        <div class="bedroom-section-inner">
                                            <p>Living room</p>
                                            <span>0 beds</span>
                                        </div>
                                        <div class="bedroom-section-inner">
                                            <p>Other spaces</p>
                                            <span>0 beds</span>
                                        </div>
                                        <a href="{{route('partner.property.details.bedroom',$property->id)}}"><strong><i class="fas fa-plus-circle mr-2"></i>Add bedroom</strong></a>
                                    </div>
                                    <div class="bedroom-section-right">
                                        <span class="minus-icon d-block"><i class="fas fa-minus-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="place-section-right">
                                <div class="d-flex">
                                    <div class="bedroom-section-lft">
                                        <label class="d-block">How many guests can stay?</label>
                                        <div class="flter-section mb-5" id="num_of_guest_div">
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-minus"><i class="fas fa-minus"></i></a>
                                            <input type="text" value="{{ $property->guests }}" name="num_of_guest" id="num_of_guest" class="qty"  class="input-text qty" />
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-plus"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <label class="d-block">How many bathrooms are there</label>
                                        <div class="flter-section mb-5" id="num_of_bathrooms_div">
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-minus"><i class="fas fa-minus"></i></a>
                                            <input type="text" value="{{ $property->bathrooms }}" name="num_of_bathrooms" id="num_of_bathrooms" class="qty"  class="input-text qty" />
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-plus"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <label class="d-block">Number of apartments (of this type)</label>
                                        <div class="flter-section mb-5" id="num_of_apartment_div">
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-minus"><i class="fas fa-minus"></i></a>
                                            <input type="text" value="{{ $property->apartments }}" name="num_of_apartment" id="num_of_apartment" class="qty"  class="input-text qty" />
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-plus"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="place-section-right">
                                <div class="d-flex">
                                    <div class="bedroom-section-lft">
                                        <h4 class="mb-3">How big is this apartment</h4>
                                        <label class="d-block">Apartment size - optional</label>
                                <input type="text" name="apartment_size" class="form-control w-100 mb-3" style="border:1px solid #ced4da"
                                       value="{{ $property->apartment_size }}">
                                        <select class="form-control" id="apartment_size_metric" name="apartment_size_metric">
                                            <option {{ $property->apartment_size_metric == 'square_meters' ? 'selected' : '' }} value="square_meters">Square Meters</option>
                                            <option {{ $property->apartment_size_metric == 'square_feet' ? 'selected' : '' }} value="square_feet">Square feet</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-4">
                            <div class="btn-section-artment">
                                <a href="{{route('partner.property.details.name',$property->id)}}" class="thme-btn-border mr-3"><i class="fas fa-chevron-left"></i></a>
                                <button type="submit" name="" id="btn-continue" class="btn thme-btn w-100">Continue</button>
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
        $(function ($) {
            var options = {
                minimum: 1,
                maximize: 100,
                onChange: valChanged,
                onMinimum: function(e) {
                    console.log('reached minimum: '+e)
                },
                onMaximize: function(e) {
                    console.log('reached maximize'+e)
                }
            }
            $('#num_of_guest_div').handleCounter(options);
            $('#num_of_bathrooms_div').handleCounter(options);
            $('#num_of_apartment_div').handleCounter(options);        
        })

        function valChanged(d) {
            //            console.log(d)
        }
    </script>
@endpush

