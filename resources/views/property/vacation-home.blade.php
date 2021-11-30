@extends('layouts.master')

@section('main')
    <div class="aparment-section">
        <div class="container">
            <h3>What can guest book? </h3>
            <div class="row">
                <div class="col-lg-5">
                    <form id="ownTypeForm" action="{{route('partner.property.confirmVationType')}}">
                       
                        <input type="hidden" name="property_type" value="{{$property_type}}">
                        <input type="hidden" name="property_type_id" value="{{$property_type_id}}">
                        <div class="aparment-section-inner">
                            <div class="aprtment-details">
                                <input type="radio" name="property_count" value="entire">
                                <div class="d-flex aparment-checkbox align-items-center">
                                    <img src="{{asset('images/property-type-category/apartment.png')}}">
                                    <p>Entire Place</p>
                                </div>
                            </div>
                            <div class="aprtment-details">
                                <input type="radio" name="property_count" value="private">
                                <div class="d-flex aparment-checkbox align-items-center">
                                    <img src="{{asset('images/property-type-category/apartment.png')}}">
                                    <p>A private room</p>
                                </div>
                            </div>
                            <div class="apartment-location d-none">
                                <h4 class="mt-4 font-weight-bold">Are these properties at the same address or building </h4>
                                <div class="aprtment-details location-details">
                                    <input type="radio" name="location_type" value="one">
                                    <div class="d-flex aparment-checkbox align-items-center">
                                        <img src="{{asset('images/property-type-category/maps.png')}}">
                                        <p>Yes these apartments are at the same address or building</p>
                                    </div>
                                </div>
                                <div class="aprtment-details location-details">
                                    <input type="radio" name="location_type" value="multiple">
                                    <div class="d-flex aparment-checkbox align-items-center">
                                        <img src="{{asset('images/property-type-category/maps-and-flags.png')}}">
                                        <p>No these apartments are at different address or building</p>
                                    </div>
                                </div>
                                <div class="total_property_numbers d-none">
                                    <label class="mb-3 d-block mt-5">Number of properties</label>
                                    <input type="number" name="number_of_properties" value="" class="w-25 prp-box">
                                    <span class="invalid-feedback" id="number_of_properties_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="btn-section-artment">
                            <a href="#"  onclick="window.history.go(-1)" class="thme-btn-border mr-3"><i class="fas fa-chevron-left"></i></a>
                            <button id="rentStyleFormSubmit" onclick="handleSubmit()" type="submit" name="" class="btn thme-btn w-100" disabled>Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        let rentType = '{{$property_type}}'
        $(function () {
            $('.aprtment-details').click(function () {
                let submitForm = $("#rentStyleFormSubmit");
                if (submitForm.prop('disabled')) {
                    submitForm.removeAttr('disabled');
                }

                //check which option is selected single or multiple
                let selectedRadio = $("input[name='property_count']:checked").val();
                let $apartmentLocation = $('.apartment-location')
                if(selectedRadio === 'private'){
                    $apartmentLocation.removeClass('d-none');
                   
                }else{
                    $apartmentLocation.addClass('d-none');
                    $("input[name='location_type']").prop('checked', false);
                    $('.total_property_numbers').addClass('d-none');
                }

            });
            //on clicking one of the location type number of property type field will be shown
            $('.location-details').click(function () {
                $('.total_property_numbers').removeClass('d-none');
            });

            $('#ownTypeForm').submit(function(e){
                let err_msg = "Number of properties should be greater than 1, for multiple type"
                let selectedRadio = $("input[name='property_count']:checked").val();
                let total_number_of_properties = $("input[name='number_of_properties']").val()
                if(selectedRadio === "private" && total_number_of_properties < 2){
                    $('#number_of_properties_error').text(err_msg);
                    $('.invalid-feedback').addClass('d-block')
                    return false;
                }
                return true;
            });

        })
    </script>
@stop