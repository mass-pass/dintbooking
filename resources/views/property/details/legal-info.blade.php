@extends('layouts.master')

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li>
                <a data-toggle="tab" href="#name-and-location">Name and location</a>
            </li>
            <li><a data-toggle="tab" href="#property-setup">Property Setup</a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li>
                <a data-toggle="tab" href="#legal-info" class="active">
                    Legal info
                    <div><span class="fil-success"></span></div>
                </a>
            </li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
        </ul>
    </div>
    <div class="tab-content container">
        <div id="name-and-location" class="tab-pane active">
            <div class="place-section">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="mb-5">Please tell us your licence number</h3>
                    </div>
                    <div class="col-lg-6">
                        <form id="propertyLegalInfoForm" method="POST" action="{{route('partner.property.details.legalInfo',$property->id)}}">
                            @csrf
                        <div class="place-section-right">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor.
                            </p>
                            <label class="mt-4">Business Tax Receipt Number</label>
                            <select id="licence-selector" class="w-100 mb-4">
                                <option {{ $property->licence_number != '' ? 'selected':'' }} value="yes">My property has a business tax recipt and resort tax registration</option>
                                <option {{ $property->licence_number == '' ? 'selected':'' }} value="no">My property doesn't need a licence</option>
                            </select>
                            <input type="text" name="licence_number" value="{{ $property->licence_number }}"  class="w-100">
                            <p>Resort Tax Registration Certificate Number</p>
                            <input type="text" name="tax_number" value="{{ $property->tax_number }}" class="w-100">
                        </div>
                        <hr class="mt-4">
                        <div class="btn-section-artment">
                            <a href="{{route('partner.property.details.availability',$property->id)}}" class="thme-btn-border mr-3"><i class="fas fa-chevron-left"></i></a>
                            <button type="submit" name="" id="btn-continue" class="btn thme-btn w-100">Continue</button>
                        </div>
                        </form>
                    </div>
                    <div class="col-lg-3">
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
    $(function(){
        $('#licence-selector').change(function(){
            if($(this).val()=='yes'){
                $('input[name="licence_number"]').show();
                $('input[name="tax_number"]').show();
            }else{
                $('input[name="licence_number"]').hide();
                $('input[name="tax_number"]').hide();
            }
        });
        if($('#licence-selector').val()=='yes'){
                $('input[name="licence_number"]').show();
                $('input[name="tax_number"]').show();
            }else{
                $('input[name="licence_number"]').hide();
                $('input[name="tax_number"]').hide();
            }

    });
    </script>
@endpush
