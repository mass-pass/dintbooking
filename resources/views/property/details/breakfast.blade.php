@extends('layouts.master')

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location">Name and location </a></li>
            <li><a data-toggle="tab" href="#property-setup" class="active">Property Setup<div><span class="fil-success"></span><span class="fil-success"></span><span class="current"></span><span></span><span></span></div></a></li>
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
                        <h3 class="mb-5">Breakfast details</h3>
                    </div>
                    <div class="col-lg-6">
                        <form id="propertyDetailsForm" method="POST" action="{{route('partner.property.details.breakfast',$property->id)}}">
                            @csrf
                            <div class="place-section-right general-seting">
                                <h4 class="mb-4">Do you serve guests breakfast?</h4>
                                <p><input type="radio" name="breakfast" value="1" {{ $property->breakfast == 1 ?'checked':'' }} class="mr-2">Yes</p>
                                <p><input type="radio" name="breakfast" value="0" {{ $property->breakfast == 0 ?'checked':'' }}  class="mr-2">No</p>
                            <div id="multi" class="{{ $property->breakfast == 1 ?'':'d-none' }}">
                            <h4 class="mb-4 mt-5">Is breakfast Included in the price guests pay?</h4>
                               <p><input type="radio" name="breakfast_price_included" {{ $property->breakfast_price_included == 1 ?'checked':'' }}  value="1" class="mr-2">Yes,it's included</p>
                               <p><input type="radio" name="breakfast_price_included" {{ $property->breakfast_price_included == 0 ?'checked':'' }}  value="0" class="mr-2">No, it costs extra</p>
                               <div id="breakfast_price_when_included" class="{{ $property->breakfast_price_included == 0 ?'':'d-none' }}">
                               <p>
                               <label>Cost for Breakfast</label>
                               <input type="text" name="breakfast_price" value="{{ $property->breakfast_price }}" class="mr-2 form-control" /></p>
                               </div>
                            </div>
                            </div>
                           <hr class="mt-4">
                            <div class="btn-section-artment">
                                <a href="{{route('partner.property.details.amenities',$property->id)}}" class="thme-btn-border mr-3"><i class="fas fa-chevron-left"></i></a>
                                <button type="submit" name="" class="btn thme-btn w-100">Continue</button>
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

$(document).ready(function() {
    $("input[name='breakfast']").change(function(){
        console.log({c:$(this).is(':checked'), v:$(this).val()});
        if ($(this).is(':checked') && $(this).val() == '1') {
            console.log(1);
            $("#multi").removeClass('d-none');
        } else {
            $("#multi").addClass('d-none');
        }
    });

    $("input[name='breakfast_price_included']").change(function(){
        console.log({c:$(this).is(':checked'), v:$(this).val()});
        if ($(this).is(':checked') && $(this).val() == '0') {
            $("#breakfast_price_when_included").removeClass('d-none');
        } else {
            $("#breakfast_price_when_included").addClass('d-none');
        }
    });

   });

    </script>
@endpush
