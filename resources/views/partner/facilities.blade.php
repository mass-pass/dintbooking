@extends('layouts.partner_template')

@section('main')
<section style="padding-left: 20%;padding-top:3%;">
        <div class="content-wrapper">
            <div class="container">
                <div class="page-header">
                    <div class="page-info">
                        <h4 class="mb-0">Facilities & Services</h4>
                    </div>
                </div>
                <!-- spacer -->
                <div class="hr">
                    <hr>
                </div>
                <!-- spacer -->
                <form id="facilities_form" method="POST" action="{{ route('facilities') }}">
                    @csrf
                    <div class="content-body">
                        <div class="facility-review-wrapper mb-4">
                            <div class="row">
                                <div class="col-md-12 col-lg-10 col-xl-8">
                                    <p>Edit the details of your apartment, such as bed options, on-site facilities, services and amenities.</p>                               
                                </div>
                            </div>
                        </div>
                        <div class="facility-review-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5>Top Facilities</h5>
                                    <p>These are the facilities that guests look for the most! Tell them which you have bu answering <b>yes</b> or <b>no</b> to each question ans click <b>save.</b> </p>
                                    <div class="facilities-list">
                                        <div class="row">
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                        Bar
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($bar) && $bar == '1' ? 'checked' : '' }} type="radio" name="bar" id="">
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($bar) || (isset($bar) && $bar == '0')  ? 'checked' : '' }} type="radio" name="bar" id="">
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                        Family Rooms
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($family_rooms) && $family_rooms == '1' ? 'checked' : '' }} type="radio" name="family_rooms" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($family_rooms) || (isset($family_rooms) && $family_rooms == '0')  ? 'checked' : '' }} type="radio" name="family_rooms" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Sauna
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($sauna) && $sauna == '1' ? 'checked' : '' }} type="radio" name="sauna" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($sauna) || (isset($sauna) && $sauna == '0')  ? 'checked' : '' }} type="radio" name="sauna" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Hot tub/jacuzzi
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($hot_tub_jacuzzi) && $hot_tub_jacuzzi == '1' ? 'checked' : '' }} type="radio" name="hot_tub_jacuzzi" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($hot_tub_jacuzzi) || (isset($hot_tub_jacuzzi) && $hot_tub_jacuzzi == '0')  ? 'checked' : '' }} type="radio" name="hot_tub_jacuzzi" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Garden
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($garden) && $garden == '1' ? 'checked' : '' }} type="radio" name="garden" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($garden) || (isset($garden) && $garden == '0')  ? 'checked' : '' }} type="radio" name="garden" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Air Conditioning 
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($air_conditioning) && $air_conditioning == '1' ? 'checked' : '' }} type="radio" name="air_conditioning" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($air_conditioning) || (isset($air_conditioning) && $air_conditioning == '0')  ? 'checked' : '' }} type="radio" name="air_conditioning" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Terrace
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($terrace) && $terrace == '1' ? 'checked' : '' }} type="radio" name="terrace" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($terrace) || (isset($terrace) && $terrace == '0')  ? 'checked' : '' }} type="radio" name="terrace" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Swimming pool 
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($swimming_pool) && $swimming_pool == '1' ? 'checked' : '' }} type="radio" name="swimming_pool" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($swimming_pool) || (isset($swimming_pool) && $swimming_pool == '0')  ? 'checked' : '' }} type="radio" name="swimming_pool" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Non-smoking rooms
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($non_smoking_rooms) && $non_smoking_rooms == '1' ? 'checked' : '' }} type="radio" name="non_smoking_rooms" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($non_smoking_rooms) || (isset($non_smoking_rooms) && $non_smoking_rooms == '0')  ? 'checked' : '' }} type="radio" name="non_smoking_rooms" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="facility-review-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="mb-3">Meals</h5> 
                                    <label for="">Do you serve meals?</label>
                                    <div class="serve-meals-wrapper">
                                        <div class="serve-meals-item">
                                            <div class="form-check-inline">
                                                <div class="custom-radio">
                                                    <input {{ isset($meals) && $meals == '1' ? 'checked' : '' }} type="radio" name="meals" id="" >
                                                    <span>Yes</span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="serve-meals-item">
                                            <div class="form-check-inline">
                                                <div class="custom-radio">
                                                    <input {{ !isset($meals) || (isset($meals) && $meals == '0')  ? 'checked' : '' }} type="radio" name="meals" id="" >
                                                    <span>No</span>
                                                </div>
                                            </div>                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="facility-review-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="mb-3">Language Spoken</h5> 
                                <div class="row">
                                    <div class="col-lg-6">
                                            <div class="language-spoken-wrapper">
                                                <div class="language-spoken-item" id="language_div">
                                                    <div class="toclone input-group mb-3">
                                                        <select name="" class="form-control" id="">
                                                            <option value="">English</option>
                                                        </select>
                                                        <div class="input-group-append">
                                                        <button class="delete btn btn-outline-danger" type="submit"> <i class="fa fa-minus-circle"></i> Remove </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="language-spoken-item-add">
                                                    <a href="#" class="clone link"> <i class="fa fa-plus-circle"></i> Add another language </a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                        </div>
                        <div class="facility-review-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="mb-3">Building info</h5> 
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Total number of rooms at this property</label>
                                            <input type="number" value="{{ isset($total_number_rooms_property)  ? $total_number_rooms_property : '' }}" name="total_number_rooms_property" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Total number of floors in the building (excl. underground floors)</label>
                                            <input type="number" value="{{ isset($total_number_floors_property)  ? $total_number_floors_property : '' }}" name="total_number_floors_property" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                        </div>
                        <div class="facility-review-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="mb-3">safety features</h5>                                
                                    <div class="facilities-list">
                                        <div class="row">
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                        Staff follow all safety protocols as directed by local authorities
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($staff_follow_all_safety_protocols) && $staff_follow_all_safety_protocols == '1' ? 'checked' : '' }} type="radio" name="staff_follow_all_safety_protocols" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($staff_follow_all_safety_protocols) || (isset($staff_follow_all_safety_protocols) && $staff_follow_all_safety_protocols == '0')  ? 'checked' : '' }} type="radio" name="staff_follow_all_safety_protocols" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    First aid kits Available
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($first_aid_kits_available) && $first_aid_kits_available == '1' ? 'checked' : '' }} type="radio" name="first_aid_kits_available" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($first_aid_kits_available) || (isset($first_aid_kits_available) && $first_aid_kits_available == '0')  ? 'checked' : '' }} type="radio" name="first_aid_kits_available" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Shared stationary (e.g printed menus, magazines, pensn papers) removed
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($shared_stationary) && $shared_stationary == '1' ? 'checked' : '' }} type="radio" name="shared_stationary" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($shared_stationary) || (isset($shared_stationary) && $shared_stationary == '0')  ? 'checked' : '' }} type="radio" name="shared_stationary" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Access to health care professionals
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($access_to_health_care) && $access_to_health_care == '1' ? 'checked' : '' }} type="radio" name="access_to_health_care" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($access_to_health_care) || (isset($access_to_health_care) && $access_to_health_care == '0')  ? 'checked' : '' }} type="radio" name="access_to_health_care" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Hand sanitizer in guest accomodation and common areas
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($hand_sanitizer_in_guest_accomodations) && $hand_sanitizer_in_guest_accomodations == '1' ? 'checked' : '' }} type="radio" name="hand_sanitizer_in_guest_accomodations" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($hand_sanitizer_in_guest_accomodations) || (isset($hand_sanitizer_in_guest_accomodations) && $hand_sanitizer_in_guest_accomodations == '0')  ? 'checked' : '' }} type="radio" name="hand_sanitizer_in_guest_accomodations" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Face masks for guests available 
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($free_masks_guest) && $free_masks_guest == '1' ? 'checked' : '' }} type="radio" name="free_masks_guest" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($free_masks_guest) || (isset($free_masks_guest) && $free_masks_guest == '0')  ? 'checked' : '' }} type="radio" name="free_masks_guest" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Process in the place to check health of guests
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($process_place_check_health) && $process_place_check_health == '1' ? 'checked' : '' }} type="radio" name="process_place_check_health" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($process_place_check_health) || (isset($process_place_check_health) && $process_place_check_health == '0')  ? 'checked' : '' }} type="radio" name="process_place_check_health" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="facility-review-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="mb-3">Physical distancing</h5>                                
                                    <div class="facilities-list">
                                        <div class="row">
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                        Contactless check-in/out
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($contactless_check_in_out) && $contactless_check_in_out == '1' ? 'checked' : '' }} type="radio" name="contactless_check_in_out" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($contactless_check_in_out) || (isset($contactless_check_in_out) && $contactless_check_in_out == '0')  ? 'checked' : '' }} type="radio" name="contactless_check_in_out" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Mobile app for room service
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($mobile_app_for_room_service) && $mobile_app_for_room_service == '1' ? 'checked' : '' }} type="radio" name="mobile_app_for_room_service" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($mobile_app_for_room_service) || (isset($mobile_app_for_room_service) && $mobile_app_for_room_service == '0')  ? 'checked' : '' }} type="radio" name="mobile_app_for_room_service" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Cashless payment available
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($cashless_payment_available) && $cashless_payment_available == '1' ? 'checked' : '' }} type="radio" name="cashless_payment_available" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($cashless_payment_available) || (isset($cashless_payment_available) && $cashless_payment_available == '0')  ? 'checked' : '' }} type="radio" name="cashless_payment_available" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Screens or physical barriers between staff and guests in appropriate areas
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($physical_barries_between_staff_guests) && $physical_barries_between_staff_guests == '1' ? 'checked' : '' }} type="radio" name="physical_barries_between_staff_guests" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($physical_barries_between_staff_guests) || (isset($physical_barries_between_staff_guests) && $physical_barries_between_staff_guests == '0')  ? 'checked' : '' }} type="radio" name="physical_barries_between_staff_guests" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Physical distancing rules followed
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($physical_distancing_rules_followed) && $physical_distancing_rules_followed == '1' ? 'checked' : '' }} type="radio" name="physical_distancing_rules_followed" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($physical_distancing_rules_followed) || (isset($physical_distancing_rules_followed) && $physical_distancing_rules_followed == '0')  ? 'checked' : '' }} type="radio" name="physical_distancing_rules_followed" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="facility-review-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="mb-3">Cleanliness & disinfecction</h5>                                
                                    <div class="facilities-list">
                                        <div class="row">
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Use of cleaning chemicals that are effective against coronavirus
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($cleaning_chemicals) && $cleaning_chemicals == '1' ? 'checked' : '' }} type="radio" name="cleaning_chemicals" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($cleaning_chemicals) || (isset($cleaning_chemicals) && $cleaning_chemicals == '0')  ? 'checked' : '' }} type="radio" name="cleaning_chemicals" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Guest accomodation sealed after cleaning
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($guest_accomodation_sealed_after_cleaning) && $guest_accomodation_sealed_after_cleaning == '1' ? 'checked' : '' }} type="radio" name="guest_accomodation_sealed_after_cleaning" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($guest_accomodation_sealed_after_cleaning) || (isset($guest_accomodation_sealed_after_cleaning) && $guest_accomodation_sealed_after_cleaning == '0')  ? 'checked' : '' }} type="radio" name="guest_accomodation_sealed_after_cleaning" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Linens, towels, and laundry washed in accodance wiht local authority guidlines
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($lines_washed_with_local_guidlines) && $lines_washed_with_local_guidlines == '1' ? 'checked' : '' }} type="radio" name="lines_washed_with_local_guidlines" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($lines_washed_with_local_guidlines) || (isset($lines_washed_with_local_guidlines) && $lines_washed_with_local_guidlines == '0')  ? 'checked' : '' }} type="radio" name="lines_washed_with_local_guidlines" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Property cleaned by progfessional cleaning companies
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($proerty_cleaned_by_companies) && $proerty_cleaned_by_companies == '1' ? 'checked' : '' }} type="radio" name="proerty_cleaned_by_companies" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($proerty_cleaned_by_companies) || (isset($proerty_cleaned_by_companies) && $proerty_cleaned_by_companies == '0')  ? 'checked' : '' }} type="radio" name="proerty_cleaned_by_companies" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Guest accomodation disinfected between stays
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($guest_accomodation_disinfected_stays) && $guest_accomodation_disinfected_stays == '1' ? 'checked' : '' }} type="radio" name="guest_accomodation_disinfected_stays" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($guest_accomodation_disinfected_stays) || (isset($guest_accomodation_disinfected_stays) && $guest_accomodation_disinfected_stays == '0')  ? 'checked' : '' }} type="radio" name="guest_accomodation_disinfected_stays" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->        
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Guest have the options to cancel any cleaning services for their accomodation during their stay.
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($guest_options_cancel_cleaning_services) && $guest_options_cancel_cleaning_services == '1' ? 'checked' : '' }} type="radio" name="guest_options_cancel_cleaning_services" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($guest_options_cancel_cleaning_services) || (isset($guest_options_cancel_cleaning_services) && $guest_options_cancel_cleaning_services == '0')  ? 'checked' : '' }} type="radio" name="guest_options_cancel_cleaning_services" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="facility-review-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="mb-3">Food & drink safety</h5>                                
                                    <div class="facilities-list">
                                        <div class="row">
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Physical distancing in dining areas
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($physical_distancing_dining_area) && $physical_distancing_dining_area == '1' ? 'checked' : '' }} type="radio" name="physical_distancing_dining_area" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($physical_distancing_dining_area) || (isset($physical_distancing_dining_area) && $physical_distancing_dining_area == '0')  ? 'checked' : '' }} type="radio" name="physical_distancing_dining_area" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Breakfast to-go container
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($breakfast_go_container) && $breakfast_go_container == '1' ? 'checked' : '' }} type="radio" name="breakfast_go_container" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($breakfast_go_container) || (isset($breakfast_go_container) && $breakfast_go_container == '0')  ? 'checked' : '' }} type="radio" name="breakfast_go_container" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Food can be delivered to guest accomodation
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($food_delivered_guest_accomodation) && $food_delivered_guest_accomodation == '1' ? 'checked' : '' }} type="radio" name="food_delivered_guest_accomodation" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($food_delivered_guest_accomodation) || (isset($food_delivered_guest_accomodation) && $food_delivered_guest_accomodation == '0')  ? 'checked' : '' }} type="radio" name="food_delivered_guest_accomodation" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    Delivered food covered securely
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($delivered_food_covered_securely) && $delivered_food_covered_securely == '1' ? 'checked' : '' }} type="radio" name="delivered_food_covered_securely" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($delivered_food_covered_securely) || (isset($delivered_food_covered_securely) && $delivered_food_covered_securely == '0')  ? 'checked' : '' }} type="radio" name="delivered_food_covered_securely" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->
                                            <!-- Item -->
                                            <div class="col-md-6">
                                                <div class="facilities-list-item">
                                                    <div class="facility-title">
                                                    All plates, cutlery, glasses, and other tableware sanitized
                                                    </div>
                                                    <div class="facility-action">
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ isset($plates_cutlery_sanitized) && $plates_cutlery_sanitized == '1' ? 'checked' : '' }} type="radio" name="plates_cutlery_sanitized" id="" >
                                                                <span>Yes</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <div class="custom-radio">
                                                                <input {{ !isset($plates_cutlery_sanitized) || (isset($plates_cutlery_sanitized) && $plates_cutlery_sanitized == '0')  ? 'checked' : '' }} type="radio" name="plates_cutlery_sanitized" id="" >
                                                                <span>No</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <!-- Item  -->         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="facility-review-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="mb-3">Check-in-services</h5>                                
                                    <!--<div class="row">
                                        <div class="col-md-6">
                                            <div class="left-container guest-self">
                                                <h6 class="mb-3">Guest self-check-in-services</h6>
                                                <div class="facilities-list">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-12">
                                                            <div class="facilities-list-item">
                                                                <div class="facility-title">
                                                                Physical distancing in dining areas
                                                                </div>
                                                                <div class="facility-action">
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input {{ isset($physical_distancing_dining_area) && $physical_distancing_dining_area == '1' ? 'checked' : '' }} type="radio" name="physical_distancing_dining_area" id="" >
                                                                            <span>Yes</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input {{ !isset($physical_distancing_dining_area) || (isset($physical_distancing_dining_area) && $physical_distancing_dining_area == '0')  ? 'checked' : '' }} type="radio" name="radio29" id="" >
                                                                            <span>No</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                            
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <div class="facilities-list-item">
                                                                <div class="facility-title">
                                                                Breakfast to-go container
                                                                </div>
                                                                <div class="facility-action">
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input {{ isset($breakfast_go_container) && $breakfast_go_container == '1' ? 'checked' : '' }} type="radio" name="breakfast_go_container" id="" >
                                                                            <span>Yes</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input {{ !isset($breakfast_go_container) || (isset($breakfast_go_container) && $breakfast_go_container == '0')  ? 'checked' : '' }} type="radio" name="breakfast_go_container" id="" >
                                                                            <span>No</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                            
                                                        </div>
                                                    
                                                        <div class="col-md-12">
                                                            <div class="facilities-list-item">
                                                                <div class="facility-title">
                                                                Food can be delivered to guest accomodation
                                                                </div>
                                                                <div class="facility-action">
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input {{ isset($food_delivered_guest_accomodation) && $food_delivered_guest_accomodation == '1' ? 'checked' : '' }} type="radio" name="food_delivered_guest_accomodation" id="" >
                                                                            <span>Yes</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input {{ !isset($food_delivered_guest_accomodation) || (isset($food_delivered_guest_accomodation) && $food_delivered_guest_accomodation == '0')  ? 'checked' : '' }} type="radio" name="food_delivered_guest_accomodation" id="" >
                                                                            <span>No</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                            
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <div class="facilities-list-item">
                                                                <div class="facility-title">
                                                                Delivered food covered securely
                                                                </div>
                                                                <div class="facility-action">
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input {{ isset($delivered_food_covered_securely) && $delivered_food_covered_securely == '1' ? 'checked' : '' }} type="radio" name="delivered_food_covered_securely" id="" >
                                                                            <span>Yes</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input {{ !isset($delivered_food_covered_securely) || (isset($delivered_food_covered_securely) && $delivered_food_covered_securely == '0')  ? 'checked' : '' }} type="radio" name="delivered_food_covered_securely" id="" >
                                                                            <span>No</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                            
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <div class="facilities-list-item">
                                                                <div class="facility-title">
                                                                All plates, cutlery, glasses, and other tableware sanitized
                                                                </div>
                                                                <div class="facility-action">
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input {{ isset($plates_cutlery_sanitized) && $plates_cutlery_sanitized == '1' ? 'checked' : '' }} type="radio" name="plates_cutlery_sanitized" id="" >
                                                                            <span>Yes</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input {{ !isset($plates_cutlery_sanitized) || (isset($plates_cutlery_sanitized) && $plates_cutlery_sanitized == '0')  ? 'checked' : '' }} type="radio" name="plates_cutlery_sanitized" id="" >
                                                                            <span>No</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                            
                                                        </div>
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --> 
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop

    
@push('scripts')
    <script type="text/javascript" src="{{ url('js/jquery-cloneya.min.js')}}"></script>
    <script  type="text/javascript">
        $(document).ready(function(){
            $('#language_div').cloneya({
                maximum: 5
            }).on('after_append.cloneya', function (event, toclone, newclone) {
                //var name = $(newclone).find("select").attr('id');
                //$(newclone).find("input[type='email']").attr('name', name);
            }).off('remove.cloneya').on('remove.cloneya', function (event, clone) {
                $(clone).slideToggle('slow', function () {
                    $(clone).remove();
                })
            });

            @if($partnerFacilities->isEmpty())
                $('input:radio').each(function () {
                    $(this).val(0);
                });
            @else 
                @foreach($partnerFacilities as $partnerFacility)
                    
                    $("input[name*='{{$partnerFacility->name}}']").val('{{$partnerFacility->value}}');
                @endforeach
            @endif
            $("input[type=radio]").click(function(e) {
                var inputs = $('input[type=radio]');
                if($(this).next().html() == 'Yes') {
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }
            });
        });
    </script>
@endpush