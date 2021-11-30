@extends('layouts.partner_template')

@section('main')
    <section style="padding-left: 20%;padding-top:3%;">
        <div class="content-wrapper">
            <div class="container">
                <div class="page-header">
                    <div class="page-info">
                        <h4 class="mb-0">Room Amenities</h4>
                    </div>
                    <!-- Spacer -->
                    <div class="hr">
                        <hr>
                    </div>
                    <!-- Spacer -->
                </div>
                <form id="amenities_form" method="POST" action="{{ route('amenities') }}">
                    @csrf
                    <div class="content-body">
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>We added these new amenities in Media & Technology , so take a minute<br> to
                                                update yours amenities if needed.</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <ul class="list-inline">
                                                <li class="list-inline-item "><a href="">Mobile Hotspot Device</a></li>
                                                <li class="list-inline-item"><a href="">Smartphone</a></li>
                                                <li class="list-inline-item"><a href="">Streaming service(like Netflix)</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="close" onclick="closeMe()">&times</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>We display your room size to guest on your Dint.property page.</p>
                                            <p class="mb-2"><b>What's your preferred unit of measurement?</b></p>
                                            <ul class="nav nav-pills my-3">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">square meters</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#">square feet</a>
                                                </li>
                                            </ul>
                                            <p><b>Please enter the size of your room(s).</b></p>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="">Two Bedroom Apartment</label>
                                                    <div class="input-group mb-3 w-50">
                                                        <input type="text" class="form-control" placeholder="900.0"
                                                            id="number" name="number" value="{{ isset($number) ? $number : '' }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">ft<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="amenities-header">
                                        <h5>Room amenities</h5> <br>
                                    </div>
                                    <div class="amenities-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="amenities-list ">
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Children's cribs
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($children_cribs) && $children_cribs == '1' ? 'checked' : '' }} type="radio" name="children_cribs" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($children_cribs) || (isset($children_cribs) && $children_cribs == '0')  ? 'checked' : '' }} type="radio" name="children_cribs" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Clothes racks
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($clothes_racks) && $clothes_racks == '1' ? 'checked' : '' }} type="radio" name="clothes_racks" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($clothes_racks) || (isset($clothes_racks) && $clothes_racks == '0')  ? 'checked' : '' }} type="radio" name="clothes_racks" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Drying rack for clothing
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($drying_rack_for_clothing) && $drying_rack_for_clothing == '1' ? 'checked' : '' }} type="radio" name="drying_rack_for_clothing" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($drying_rack_for_clothing) || (isset($drying_rack_for_clothing) && $drying_rack_for_clothing == '0')  ? 'checked' : '' }} type="radio" name="drying_rack_for_clothing" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Fold-up bed
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($fold_up_bed) && $fold_up_bed == '1' ? 'checked' : '' }} type="radio" name="fold_up_bed" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($fold_up_bed) || (isset($fold_up_bed) && $fold_up_bed == '0')  ? 'checked' : '' }} type="radio" name="fold_up_bed" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Sofa bed
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($sofa_bed) && $sofa_bed == '1' ? 'checked' : '' }} type="radio" name="sofa_bed" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($sofa_bed) || (isset($sofa_bed) && $sofa_bed == '0')  ? 'checked' : '' }} type="radio" name="sofa_bed" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Trash cans
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($trash_cans) && $trash_cans == '1' ? 'checked' : '' }} type="radio" name="trash_cans" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($trash_cans) || (isset($trash_cans) && $trash_cans == '0')  ? 'checked' : '' }} type="radio" name="trash_cans" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Heated pool
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($heated_pool) && $heated_pool == '1' ? 'checked' : '' }} type="radio" name="heated_pool" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($heated_pool) || (isset($heated_pool) && $heated_pool == '0')  ? 'checked' : '' }} type="radio" name="heated_pool" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Infinity Pool
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($infinity_pool) && $infinity_pool == '1' ? 'checked' : '' }} type="radio" name="infinity_pool" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($infinity_pool) || (isset($infinity_pool) && $infinity_pool == '0')  ? 'checked' : '' }} type="radio" name="infinity_pool" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Plunge Pool
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($plunge_pool) && $plunge_pool == '1' ? 'checked' : '' }} type="radio" name="plunge_pool" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($plunge_pool) || (isset($plunge_pool) && $plunge_pool == '0')  ? 'checked' : '' }} type="radio" name="plunge_pool" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Pool cover
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($pool_cover) && $pool_cover == '1' ? 'checked' : '' }} type="radio" name="pool_cover" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($pool_cover) || (isset($pool_cover) && $pool_cover == '0')  ? 'checked' : '' }} type="radio" name="pool_cover" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Pool towels
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($pool_towels) && $pool_towels == '1' ? 'checked' : '' }} type="radio" name="pool_towels" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($pool_towels) || (isset($pool_towels) && $pool_towels == '0')  ? 'checked' : '' }} type="radio" name="pool_towels" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Pool with a view
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($pool_with_a_view) && $pool_with_a_view == '1' ? 'checked' : '' }} type="radio" name="pool_with_a_view" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($pool_with_a_view) || (isset($pool_with_a_view) && $pool_with_a_view == '0')  ? 'checked' : '' }} type="radio" name="pool_with_a_view" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Rooftop pool
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($rooftop_pool) && $rooftop_pool == '1' ? 'checked' : '' }} type="radio" name="rooftop_pool" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($rooftop_pool) || (isset($rooftop_pool) && $rooftop_pool == '0')  ? 'checked' : '' }} type="radio" name="rooftop_pool" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Saltwater pool
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($saltwater_pool) && $saltwater_pool == '1' ? 'checked' : '' }} type="radio" name="saltwater_pool" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($saltwater_pool) || (isset($saltwater_pool) && $saltwater_pool == '0')  ? 'checked' : '' }} type="radio" name="saltwater_pool" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Shallow end
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($shallow_end) && $shallow_end == '1' ? 'checked' : '' }} type="radio" name="shallow_end" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($shallow_end) || (isset($shallow_end) && $shallow_end == '0')  ? 'checked' : '' }} type="radio" name="shallow_end" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Air conditioning
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($air_conditioning) && $air_conditioning == '1' ? 'checked' : '' }} type="radio" name="air_conditioning" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($air_conditioning) || (isset($air_conditioning) && $air_conditioning == '0')  ? 'checked' : '' }} type="radio" name="air_conditioning" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Private pool
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($private_pool) && $private_pool == '1' ? 'checked' : '' }} type="radio" name="private_pool" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($private_pool) || (isset($private_pool) && $private_pool == '0')  ? 'checked' : '' }} type="radio" name="private_pool" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Dryer
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($dryer) && $dryer == '1' ? 'checked' : '' }} type="radio" name="dryer" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($dryer) || (isset($dryer) && $dryer == '0')  ? 'checked' : '' }} type="radio" name="dryer" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Wardrobe or closet
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($wardrobe_or_closet) && $wardrobe_or_closet == '1' ? 'checked' : '' }} type="radio" name="wardrobe_or_closet" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($wardrobe_or_closet) || (isset($wardrobe_or_closet) && $wardrobe_or_closet == '0')  ? 'checked' : '' }} type="radio" name="wardrobe_or_closet" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Carpeted
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($carpeted) && $carpeted == '1' ? 'checked' : '' }} type="radio" name="carpeted" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($carpeted) || (isset($carpeted) && $carpeted == '0')  ? 'checked' : '' }} type="radio" name="carpeted" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Walk-in closet
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($walk_in_closet) && $walk_in_closet == '1' ? 'checked' : '' }} type="radio" name="walk_in_closet" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($walk_in_closet) || (isset($walk_in_closet) && $walk_in_closet == '0')  ? 'checked' : '' }} type="radio" name="walk_in_closet" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Extra long beds(>6.5ft)
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($extra_long_beds) && $extra_long_beds == '1' ? 'checked' : '' }} type="radio" name="extra_long_beds" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($extra_long_beds) || (isset($extra_long_beds) && $extra_long_beds == '0')  ? 'checked' : '' }} type="radio" name="extra_long_beds" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Fan
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($fan) && $fan == '1' ? 'checked' : '' }} type="radio" name="fan" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($fan) || (isset($fan) && $fan == '0')  ? 'checked' : '' }} type="radio" name="fan" id="">
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Fireplace
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($fireplace) && $fireplace == '1' ? 'checked' : '' }} type="radio" name="fireplace" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($fireplace) || (isset($fireplace) && $fireplace == '0')  ? 'checked' : '' }} type="radio" name="fireplace" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Heating
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($heating) && $heating == '1' ? 'checked' : '' }} type="radio" name="heating" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($heating) || (isset($heating) && $heating == '0')  ? 'checked' : '' }} type="radio" name="heating" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Interconnecting room(s) available
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($interconnecting_rooms_available) && $interconnecting_rooms_available == '1' ? 'checked' : '' }} type="radio" name="interconnecting_rooms_available" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($interconnecting_rooms_available) || (isset($interconnecting_rooms_available) && $interconnecting_rooms_available == '0')  ? 'checked' : '' }} type="radio" name="interconnecting_rooms_available" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Iron
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($iron) && $iron == '1' ? 'checked' : '' }} type="radio" name="iron" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($iron) || (isset($iron) && $iron == '0')  ? 'checked' : '' }} type="radio" name="iron" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Ironing facilities
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($ironing_facilities) && $ironing_facilities == '1' ? 'checked' : '' }} type="radio" name="ironing_facilities" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($ironing_facilities) || (isset($ironing_facilities) && $ironing_facilities == '0')  ? 'checked' : '' }} type="radio" name="ironing_facilities" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Hot tub
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($hot_tub) && $hot_tub == '1' ? 'checked' : '' }} type="radio" name="hot_tub" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($hot_tub) || (isset($hot_tub) && $hot_tub == '0')  ? 'checked' : '' }} type="radio" name="hot_tub" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Mosquito net
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($mosquito_net) && $mosquito_net == '1' ? 'checked' : '' }} type="radio" name="mosquito_net" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($mosquito_net) || (isset($mosquito_net) && $mosquito_net == '0')  ? 'checked' : '' }} type="radio" name="mosquito_net" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Private entrance
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($private_entrance) && $private_entrance == '1' ? 'checked' : '' }} type="radio" name="private_entrance" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($private_entrance) || (isset($private_entrance) && $private_entrance == '0')  ? 'checked' : '' }} type="radio" name="private_entrance" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Safe
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($safe) && $safe == '1' ? 'checked' : '' }} type="radio" name="safe" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($safe) || (isset($safe) && $safe == '0')  ? 'checked' : '' }} type="radio" name="safe" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Sofa
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($sofa) && $sofa == '1' ? 'checked' : '' }} type="radio" name="sofa" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($sofa) || (isset($sofa) && $sofa == '0')  ? 'checked' : '' }} type="radio" name="sofa" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Sound proof
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($sound_proof) && $sound_proof == '1' ? 'checked' : '' }} type="radio" name="sound_proof" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($sound_proof) || (isset($sound_proof) && $sound_proof == '0')  ? 'checked' : '' }} type="radio" name="sound_proof" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Sitting area
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($sitting_area) && $sitting_area == '1' ? 'checked' : '' }} type="radio" name="sitting_area" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($sitting_area) || (isset($sitting_area) && $sitting_area == '0')  ? 'checked' : '' }} type="radio" name="sitting_area" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Tile/Marble floor
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($tile_marble_floor) && $tile_marble_floor == '1' ? 'checked' : '' }} type="radio" name="tile_marble_floor" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($tile_marble_floor) || (isset($tile_marble_floor) && $tile_marble_floor == '0')  ? 'checked' : '' }} type="radio" name="tile_marble_floor" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Suit press
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($suit_press) && $suit_press == '1' ? 'checked' : '' }} type="radio" name="suit_press" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($suit_press) || (isset($suit_press) && $suit_press == '0')  ? 'checked' : '' }} type="radio" name="suit_press" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Washing machine
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($washing_machine) && $washing_machine == '1' ? 'checked' : '' }} type="radio" name="washing_machine" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($washing_machine) || (isset($washing_machine) && $washing_machine == '0')  ? 'checked' : '' }} type="radio" name="washing_machine" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Hardwood or parquet floor
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($hardwood_or_parquet_floor) && $hardwood_or_parquet_floor == '1' ? 'checked' : '' }} type="radio" name="hardwood_or_parquet_floor" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($hardwood_or_parquet_floor) || (isset($hardwood_or_parquet_floor) && $hardwood_or_parquet_floor == '0')  ? 'checked' : '' }} type="radio" name="hardwood_or_parquet_floor" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Desk
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($desk) && $desk == '1' ? 'checked' : '' }} type="radio" name="desk" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($desk) || (isset($desk) && $desk == '0')  ? 'checked' : '' }} type="radio" name="desk" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Hypoallergenic
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($hypoallergenic) && $hypoallergenic == '1' ? 'checked' : '' }} type="radio" name="hypoallergenic" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($hypoallergenic) || (isset($hypoallergenic) && $hypoallergenic == '0')  ? 'checked' : '' }} type="radio" name="hypoallergenic" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Cleaning Products
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($cleaning_products) && $cleaning_products == '1' ? 'checked' : '' }} type="radio" name="cleaning_products" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($cleaning_products) || (isset($cleaning_products) && $cleaning_products == '0')  ? 'checked' : '' }} type="radio" name="cleaning_products" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Electric blankets
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($electric_blankets) && $electric_blankets == '1' ? 'checked' : '' }} type="radio" name="electric_blankets" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($electric_blankets) || (isset($electric_blankets) && $electric_blankets == '0')  ? 'checked' : '' }} type="radio" name="electric_blankets" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Pajamas
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($pajamas) && $pajamas == '1' ? 'checked' : '' }} type="radio" name="pajamas" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($pajamas) || (isset($pajamas) && $pajamas == '0')  ? 'checked' : '' }} type="radio" name="pajamas" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Yukata
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($yukata) && $yukata == '1' ? 'checked' : '' }} type="radio" name="yukata" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($yukata) || (isset($yukata) && $yukata == '0')  ? 'checked' : '' }} type="radio" name="yukata" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Socket near the bed
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($socket_near_the_bed) && $socket_near_the_bed == '1' ? 'checked' : '' }} type="radio" name="socket_near_the_bed" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($socket_near_the_bed) || (isset($socket_near_the_bed) && $socket_near_the_bed == '0')  ? 'checked' : '' }} type="radio" name="socket_near_the_bed" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Adapter
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($adapter) && $adapter == '1' ? 'checked' : '' }} type="radio" name="adapter" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($adapter) || (isset($adapter) && $adapter == '0')  ? 'checked' : '' }} type="radio" name="adapter" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Feather pillow
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($feather_pillow) && $feather_pillow == '1' ? 'checked' : '' }} type="radio" name="feather_pillow" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($feather_pillow) || (isset($feather_pillow) && $feather_pillow == '0')  ? 'checked' : '' }} type="radio" name="feather_pillow" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Non-feather pillow
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($non_feature_pillow) && $non_feature_pillow == '1' ? 'checked' : '' }} type="radio" name="non_feature_pillow" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($non_feature_pillow) || (isset($non_feature_pillow) && $non_feature_pillow == '0')  ? 'checked' : '' }} type="radio" name="non_feature_pillow" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Hypoallergenic pillow
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($hypoallergenic_pillow) && $hypoallergenic_pillow == '1' ? 'checked' : '' }} type="radio" name="hypoallergenic_pillow" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($hypoallergenic_pillow) || (isset($hypoallergenic_pillow) && $hypoallergenic_pillow == '0')  ? 'checked' : '' }} type="radio" name="hypoallergenic_pillow" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="amenities-header">
                                        <h5>Bathroom</h5>
                                        <p><i class="fa fa-info-circle text-warning"></i> You can easily add the number of
                                            bathrooms,their privacy levels, and locations in the<a href="#" class="link">
                                                Property layout</a> section </p>
                                    </div>
                                    <div class="amenities-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="amenities-list ">
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Toilet paper
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($toilet_paper) && $toilet_paper == '1' ? 'checked' : '' }} type="radio" name="toilet_paper" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($toilet_paper) || (isset($toilet_paper) && $toilet_paper == '0')  ? 'checked' : '' }} type="radio" name="toilet_paper" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Bathtub
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($bathtub) && $bathtub == '1' ? 'checked' : '' }} type="radio" name="bathtub" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($bathtub) || (isset($bathtub) && $bathtub == '0')  ? 'checked' : '' }} type="radio" name="bathtub" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Bidet
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($bidet) && $bidet == '1' ? 'checked' : '' }} type="radio" name="bidet" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($bidet) || (isset($bidet) && $bidet == '0')  ? 'checked' : '' }} type="radio" name="bidet" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Bathroom or shower
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($bathroom_or_shower) && $bathroom_or_shower == '1' ? 'checked' : '' }} type="radio" name="bathroom_or_shower" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($bathroom_or_shower) || (isset($bathroom_or_shower) && $bathroom_or_shower == '0')  ? 'checked' : '' }} type="radio" name="bathroom_or_shower" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Bathrobe
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($bathrobe) && $bathrobe == '1' ? 'checked' : '' }} type="radio" name="bathrobe" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($bathrobe) || (isset($bathrobe) && $bathrobe == '0')  ? 'checked' : '' }} type="radio" name="bathrobe" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Free toiletries
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($free_toiletries) && $free_toiletries == '1' ? 'checked' : '' }} type="radio" name="free_toiletries" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($free_toiletries) || (isset($free_toiletries) && $free_toiletries == '0')  ? 'checked' : '' }} type="radio" name="free_toiletries" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Guest bathroom
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($guest_bathroom) && $guest_bathroom == '1' ? 'checked' : '' }} type="radio" name="guest_bathroom" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($guest_bathroom) || (isset($guest_bathroom) && $guest_bathroom == '0')  ? 'checked' : '' }} type="radio" name="guest_bathroom" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Hair dryer
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($hair_dryer) && $hair_dryer == '1' ? 'checked' : '' }} type="radio" name="hair_dryer" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($hair_dryer) || (isset($hair_dryer) && $hair_dryer == '0')  ? 'checked' : '' }} type="radio" name="hair_dryer" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Spa tub
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($spa_tub) && $spa_tub == '1' ? 'checked' : '' }} type="radio" name="spa_tub" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($spa_tub) || (isset($spa_tub) && $spa_tub == '0')  ? 'checked' : '' }} type="radio" name="spa_tub" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Shared toilet
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($shared_toilet) && $shared_toilet == '1' ? 'checked' : '' }} type="radio" name="shared_toilet" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($shared_toilet) || (isset($shared_toilet) && $shared_toilet == '0')  ? 'checked' : '' }} type="radio" name="shared_toilet" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Sauna
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($sauna) && $sauna == '1' ? 'checked' : '' }} type="radio" name="sauna" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($sauna) || (isset($sauna) && $sauna == '0')  ? 'checked' : '' }} type="radio" name="sauna" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Shower
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($shower) && $shower == '1' ? 'checked' : '' }} type="radio" name="shower" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($shower) || (isset($shower) && $shower == '0')  ? 'checked' : '' }} type="radio" name="shower" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Slippers
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($slippers) && $slippers == '1' ? 'checked' : '' }} type="radio" name="slippers" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($slippers) || (isset($slippers) && $slippers == '0')  ? 'checked' : '' }} type="radio" name="slippers" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Toilet
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($toilet) && $toilet == '1' ? 'checked' : '' }} type="radio" name="toilet" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($toilet) || (isset($toilet) && $toilet == '0')  ? 'checked' : '' }} type="radio" name="toilet" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Toothbrush
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($toothbrush) && $toothbrush == '1' ? 'checked' : '' }} type="radio" name="toothbrush" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($toothbrush) || (isset($toothbrush) && $toothbrush == '0')  ? 'checked' : '' }} type="radio" name="toothbrush" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Shampoo
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($shampoo) && $shampoo == '1' ? 'checked' : '' }} type="radio" name="shampoo" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($shampoo) || (isset($shampoo) && $shampoo == '0')  ? 'checked' : '' }} type="radio" name="shampoo" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Conditioner
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($conditioner) && $conditioner == '1' ? 'checked' : '' }} type="radio" name="conditioner" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($conditioner) || (isset($conditioner) && $conditioner == '0')  ? 'checked' : '' }} type="radio" name="conditioner" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Body soap
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($body_soap) && $body_soap == '1' ? 'checked' : '' }} type="radio" name="body_soap" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($body_soap) || (isset($body_soap) && $body_soap == '0')  ? 'checked' : '' }} type="radio" name="body_soap" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Shower cap
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($shower_cap) && $shower_cap == '1' ? 'checked' : '' }} type="radio" name="shower_cap" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($shower_cap) || (isset($shower_cap) && $shower_cap == '0')  ? 'checked' : '' }} type="radio" name="shower_cap" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="amenities-header">
                                        <h5>Media & Technology</h5> <br>
                                    </div>
                                    <div class="amenities-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="amenities-list ">
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Game console - PS4
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($game_console_ps4) && $game_console_ps4 == '1' ? 'checked' : '' }} type="radio" name="game_console_ps4" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($game_console_ps4) || (isset($game_console_ps4) && $game_console_ps4 == '0')  ? 'checked' : '' }} type="radio" name="game_console_ps4" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Game console - Wii U
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($game_console_wii_u) && $game_console_wii_u == '1' ? 'checked' : '' }} type="radio" name="game_console_wii_u" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($game_console_wii_u) || (isset($game_console_wii_u) && $game_console_wii_u == '0')  ? 'checked' : '' }} type="radio" name="game_console_wii_u" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Game console - Xbox One
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($game_console_xbox_one) && $game_console_xbox_one == '1' ? 'checked' : '' }} type="radio" name="game_console_xbox_one" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($game_console_xbox_one) || (isset($game_console_xbox_one) && $game_console_xbox_one == '0')  ? 'checked' : '' }} type="radio" name="game_console_xbox_one" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Computer
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($computer) && $computer == '1' ? 'checked' : '' }} type="radio" name="computer" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($computer) || (isset($computer) && $computer == '0')  ? 'checked' : '' }} type="radio" name="computer" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Game console
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($game_console) && $game_console == '1' ? 'checked' : '' }} type="radio" name="game_console" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($game_console) || (isset($game_console) && $game_console == '0')  ? 'checked' : '' }} type="radio" name="game_console" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Game console - Nintendp Wii
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($game_console_nintendp_wii) && $game_console_nintendp_wii == '1' ? 'checked' : '' }} type="radio" name="game_console_nintendp_wii" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($game_console_nintendp_wii) || (isset($game_console_nintendp_wii) && $game_console_nintendp_wii == '0')  ? 'checked' : '' }} type="radio" name="game_console_nintendp_wii" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Game console - PS2
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($game_console_ps2) && $game_console_ps2 == '1' ? 'checked' : '' }} type="radio" name="game_console_ps2" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($game_console_ps2) || (isset($game_console_ps2) && $game_console_ps2 == '0')  ? 'checked' : '' }} type="radio" name="game_console_ps2" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Game console - PS3
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($game_console_ps3) && $game_console_ps3 == '1' ? 'checked' : '' }} type="radio" name="game_console_ps3" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($game_console_ps3) || (isset($game_console_ps3) && $game_console_ps3 == '0')  ? 'checked' : '' }} type="radio" name="game_console_ps3" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Game console - Xbox 360
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($game_console_xbox_360) && $game_console_xbox_360 == '1' ? 'checked' : '' }} type="radio" name="game_console_xbox_360" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($game_console_xbox_360) || (isset($game_console_xbox_360) && $game_console_xbox_360 == '0')  ? 'checked' : '' }} type="radio" name="game_console_xbox_360" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Laptop
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($laptop) && $laptop == '1' ? 'checked' : '' }} type="radio" name="laptop" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($laptop) || (isset($laptop) && $laptop == '0')  ? 'checked' : '' }} type="radio" name="laptop" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                iPad
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($ipad) && $ipad == '1' ? 'checked' : '' }} type="radio" name="ipad" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($ipad) || (isset($ipad) && $ipad == '0')  ? 'checked' : '' }} type="radio" name="ipad" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Cable channels
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($cable_channels) && $cable_channels == '1' ? 'checked' : '' }} type="radio" name="cable_channels" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($cable_channels) || (isset($cable_channels) && $cable_channels == '0')  ? 'checked' : '' }} type="radio" name="cable_channels" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                CD player
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($cd_player) && $cd_player == '1' ? 'checked' : '' }} type="radio" name="cd_player" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($cd_player) || (isset($cd_player) && $cd_player == '0')  ? 'checked' : '' }} type="radio" name="cd_player" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                DVD player
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($dvd_player) && $dvd_player == '1' ? 'checked' : '' }} type="radio" name="dvd_player" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($dvd_player) || (isset($dvd_player) && $dvd_player == '0')  ? 'checked' : '' }} type="radio" name="dvd_player" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Fax
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($fax) && $fax == '1' ? 'checked' : '' }} type="radio" name="fax" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($fax) || (isset($fax) && $fax == '0')  ? 'checked' : '' }} type="radio" name="fax" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                iPad dock
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($ipad_dock) && $ipad_dock == '1' ? 'checked' : '' }} type="radio" name="ipad_dock" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($ipad_dock) || (isset($ipad_dock) && $ipad_dock == '0')  ? 'checked' : '' }} type="radio" name="ipad_dock" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Laptop safe
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($laptop_safe) && $laptop_safe == '1' ? 'checked' : '' }} type="radio" name="laptop_safe" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($laptop_safe) || (isset($laptop_safe) && $laptop_safe == '0')  ? 'checked' : '' }} type="radio" name="laptop_safe" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Flat screen TV
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($flat_screen_tv) && $flat_screen_tv == '1' ? 'checked' : '' }} type="radio" name="flat_screen_tv" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($flat_screen_tv) || (isset($flat_screen_tv) && $flat_screen_tv == '0')  ? 'checked' : '' }} type="radio" name="flat_screen_tv" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Pay-per-view channels
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($pay_per_view_channels) && $pay_per_view_channels == '1' ? 'checked' : '' }} type="radio" name="pay_per_view_channels" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($pay_per_view_channels) || (isset($pay_per_view_channels) && $pay_per_view_channels == '0')  ? 'checked' : '' }} type="radio" name="pay_per_view_channels" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Radio
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($radio) && $radio == '1' ? 'checked' : '' }} type="radio" name="radio" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($radio) || (isset($radio) && $radio == '0')  ? 'checked' : '' }} type="radio" name="radio" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Satelite channels
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($satelite_channels) && $satelite_channels == '1' ? 'checked' : '' }} type="radio" name="satelite_channels" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($satelite_channels) || (isset($satelite_channels) && $satelite_channels == '0')  ? 'checked' : '' }} type="radio" name="satelite_channels" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Telephone
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($telephone) && $telephone == '1' ? 'checked' : '' }} type="radio" name="telephone" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($telephone) || (isset($telephone) && $telephone == '0')  ? 'checked' : '' }} type="radio" name="telephone" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                TV
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($tv) && $tv == '1' ? 'checked' : '' }} type="radio" name="tv" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($tv) || (isset($tv) && $tv == '0')  ? 'checked' : '' }} type="radio" name="tv" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Video
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($video) && $video == '1' ? 'checked' : '' }} type="radio" name="video" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($video) || (isset($video) && $video == '0')  ? 'checked' : '' }} type="radio" name="video" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Video games
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($video_games) && $video_games == '1' ? 'checked' : '' }} type="radio" name="video_games" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($video_games) || (isset($video_games) && $video_games == '0')  ? 'checked' : '' }} type="radio" name="video_games" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Blu-ray player
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($blu_ray_player) && $blu_ray_player == '1' ? 'checked' : '' }} type="radio" name="blu_ray_player" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($blu_ray_player) || (isset($blu_ray_player) && $blu_ray_player == '0')  ? 'checked' : '' }} type="radio" name="blu_ray_player" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Mobile hotspot device <br>
                                                                <span style="font-weight: normal;">A device can borrow
                                                                    during their stay</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($mobile_hotspot_device) && $mobile_hotspot_device == '1' ? 'checked' : '' }} type="radio" name="mobile_hotspot_device" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($mobile_hotspot_device) || (isset($mobile_hotspot_device) && $mobile_hotspot_device == '0')  ? 'checked' : '' }} type="radio" name="mobile_hotspot_device" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Smartphone
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($smartphone) && $smartphone == '1' ? 'checked' : '' }} type="radio" name="smartphone" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($smartphone) || (isset($smartphone) && $smartphone == '0')  ? 'checked' : '' }} type="radio" name="smartphone" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Streaming service (like Netflix)
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($streaming_service) && $streaming_service == '1' ? 'checked' : '' }} type="radio" name="streaming_service" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($streaming_service) || (isset($streaming_service) && $streaming_service == '0')  ? 'checked' : '' }} type="radio" name="streaming_service" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="amenities-header">
                                        <h5>Food & Drink</h5> <br>
                                    </div>
                                    <div class="amenities-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="amenities-list ">
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Dining area
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($dining_area) && $dining_area == '1' ? 'checked' : '' }} type="radio" name="dining_area" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($dining_area) || (isset($dining_area) && $dining_area == '0')  ? 'checked' : '' }} type="radio" name="dining_area" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Dining table
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($dining_table) && $dining_table == '1' ? 'checked' : '' }} type="radio" name="dining_table" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($dining_table) || (isset($dining_table) && $dining_table == '0')  ? 'checked' : '' }} type="radio" name="dining_table" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Wine glasses
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($wine_glasses) && $wine_glasses == '1' ? 'checked' : '' }} type="radio" name="wine_glasses" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($wine_glasses) || (isset($wine_glasses) && $wine_glasses == '0')  ? 'checked' : '' }} type="radio" name="wine_glasses" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Bottle of water
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($bottle_of_water) && $bottle_of_water == '1' ? 'checked' : '' }} type="radio" name="bottle_of_water" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($bottle_of_water) || (isset($bottle_of_water) && $bottle_of_water == '0')  ? 'checked' : '' }} type="radio" name="bottle_of_water" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Chocolate/Cookies
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($chocolate_cookies) && $chocolate_cookies == '1' ? 'checked' : '' }} type="radio" name="chocolate_cookies" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($chocolate_cookies) || (isset($chocolate_cookies) && $chocolate_cookies == '0')  ? 'checked' : '' }} type="radio" name="chocolate_cookies" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Fruit
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($fruit) && $fruit == '1' ? 'checked' : '' }} type="radio" name="fruit" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($fruit) || (isset($fruit) && $fruit == '0')  ? 'checked' : '' }} type="radio" name="fruit" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Wine/Champagne
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($wine_champagne) && $wine_champagne == '1' ? 'checked' : '' }} type="radio" name="wine_champagne" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($wine_champagne) || (isset($wine_champagne) && $wine_champagne == '0')  ? 'checked' : '' }} type="radio" name="wine_champagne" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Barbecue
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($barbecue) && $barbecue == '1' ? 'checked' : '' }} type="radio" name="barbecue" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($barbecue) || (isset($barbecue) && $barbecue == '0')  ? 'checked' : '' }} type="radio" name="barbecue" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Oven
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($oven) && $oven == '1' ? 'checked' : '' }} type="radio" name="oven" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($oven) || (isset($oven) && $oven == '0')  ? 'checked' : '' }} type="radio" name="oven" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Stovetop
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($stovetop) && $stovetop == '1' ? 'checked' : '' }} type="radio" name="stovetop" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($stovetop) || (isset($stovetop) && $stovetop == '0')  ? 'checked' : '' }} type="radio" name="stovetop" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Toaster
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($toaster) && $toaster == '1' ? 'checked' : '' }} type="radio" name="toaster" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($toaster) || (isset($toaster) && $toaster == '0')  ? 'checked' : '' }} type="radio" name="toaster" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Dishwasher
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($dishwasher) && $dishwasher == '1' ? 'checked' : '' }} type="radio" name="dishwasher" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($dishwasher) || (isset($dishwasher) && $dishwasher == '0')  ? 'checked' : '' }} type="radio" name="dishwasher" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Electric kettle
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($electric_kettle) && $electric_kettle == '1' ? 'checked' : '' }} type="radio" name="electric_kettle" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($electric_kettle) || (isset($electric_kettle) && $electric_kettle == '0')  ? 'checked' : '' }} type="radio" name="electric_kettle" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Outdoor dining area
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($outdoor_dining_area) && $outdoor_dining_area == '1' ? 'checked' : '' }} type="radio" name="outdoor_dining_area" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($outdoor_dining_area) || (isset($outdoor_dining_area) && $outdoor_dining_area == '0')  ? 'checked' : '' }} type="radio" name="outdoor_dining_area" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Outdoor furniture
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($outdoor_furniture) && $outdoor_furniture == '1' ? 'checked' : '' }} type="radio" name="outdoor_furniture" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($outdoor_furniture) || (isset($outdoor_furniture) && $outdoor_furniture == '0')  ? 'checked' : '' }} type="radio" name="outdoor_furniture" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Minibar
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($minibar) && $minibar == '1' ? 'checked' : '' }} type="radio" name="minibar" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($minibar) || (isset($minibar) && $minibar == '0')  ? 'checked' : '' }} type="radio" name="minibar" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Kitchen
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($kitchen) && $kitchen == '1' ? 'checked' : '' }} type="radio" name="kitchen" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($kitchen) || (isset($kitchen) && $kitchen == '0')  ? 'checked' : '' }} type="radio" name="kitchen" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Kitchenette
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($kitchenette) && $kitchenette == '1' ? 'checked' : '' }} type="radio" name="kitchenette" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($kitchenette) || (isset($kitchenette) && $kitchenette == '0')  ? 'checked' : '' }} type="radio" name="kitchenette" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Kitchenwarre
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($kitchenwarre) && $kitchenwarre == '1' ? 'checked' : '' }} type="radio" name="kitchenwarre" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($kitchenwarre) || (isset($kitchenwarre) && $kitchenwarre == '0')  ? 'checked' : '' }} type="radio" name="kitchenwarre" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Microwave
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($microwave) && $microwave == '1' ? 'checked' : '' }} type="radio" name="microwave" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($microwave) || (isset($microwave) && $microwave == '0')  ? 'checked' : '' }} type="radio" name="microwave" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Refrigerator
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($refrigerator) && $refrigerator == '1' ? 'checked' : '' }} type="radio" name="refrigerator" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($refrigerator) || (isset($refrigerator) && $refrigerator == '0')  ? 'checked' : '' }} type="radio" name="refrigerator" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Tea/Coffee maker
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($tea_coffee_maker) && $tea_coffee_maker == '1' ? 'checked' : '' }} type="radio" name="tea_coffee_maker" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($tea_coffee_maker) || (isset($tea_coffee_maker) && $tea_coffee_maker == '0')  ? 'checked' : '' }} type="radio" name="tea_coffee_maker" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Cofee machine
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($cofee_machine) && $cofee_machine == '1' ? 'checked' : '' }} type="radio" name="cofee_machine" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($cofee_machine) || (isset($cofee_machine) && $cofee_machine == '0')  ? 'checked' : '' }} type="radio" name="cofee_machine" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                High chair
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($high_chair) && $high_chair == '1' ? 'checked' : '' }} type="radio" name="high_chair" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($high_chair) || (isset($high_chair) && $high_chair == '0')  ? 'checked' : '' }} type="radio" name="high_chair" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="amenities-header">
                                        <h5>Services & Extras</h5> <br>
                                    </div>
                                    <div class="amenities-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="amenities-list ">
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Key card access &nbsp;<span
                                                                    class="badge badge-success">New!</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($key_card_access) && $key_card_access == '1' ? 'checked' : '' }} type="radio" name="key_card_access" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($key_card_access) || (isset($key_card_access) && $key_card_access == '0')  ? 'checked' : '' }} type="radio" name="key_card_access" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Lockers &nbsp;<span class="badge badge-success">New!</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($lockers) && $lockers == '1' ? 'checked' : '' }} type="radio" name="lockers" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($lockers) || (isset($lockers) && $lockers == '0')  ? 'checked' : '' }} type="radio" name="lockers" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Key access &nbsp;<span
                                                                    class="badge badge-success">New!</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($key_access) && $key_access == '1' ? 'checked' : '' }} type="radio" name="key_access" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($key_access) || (isset($key_access) && $key_access == '0')  ? 'checked' : '' }} type="radio" name="key_access" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Executive lounge access
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($executive_lounge_access) && $executive_lounge_access == '1' ? 'checked' : '' }} type="radio" name="executive_lounge_access" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($executive_lounge_access) || (isset($executive_lounge_access) && $executive_lounge_access == '0')  ? 'checked' : '' }} type="radio" name="executive_lounge_access" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Alarm clock
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($alarm_clock) && $alarm_clock == '1' ? 'checked' : '' }} type="radio" name="alarm_clock" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($alarm_clock) || (isset($alarm_clock) && $alarm_clock == '0')  ? 'checked' : '' }} type="radio" name="alarm_clock" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Wake-up service
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($wake_up_service) && $wake_up_service == '1' ? 'checked' : '' }} type="radio" name="wake_up_service" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($wake_up_service) || (isset($wake_up_service) && $wake_up_service == '0')  ? 'checked' : '' }} type="radio" name="wake_up_service" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Linens
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($linens) && $linens == '1' ? 'checked' : '' }} type="radio" name="linens" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($linens) || (isset($linens) && $linens == '0')  ? 'checked' : '' }} type="radio" name="linens" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                                <div class="checkboxes">
                                                                    <ul class="list-inline mb-0 mt-3">
                                                                        <li class="list-inline-item">
                                                                            <label for="">
                                                                                <input {{ isset($criblinen) && $criblinen == '1' ? 'checked' : '' }} type="checkbox" name="criblinen" id="criblinen"> Criblinen
                                                                            </label>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <label for="">
                                                                                <input {{ isset($fitted_sheet) && $fitted_sheet == '1' ? 'checked' : '' }} type="checkbox" name="fitted_sheet" id="fitted_sheet"> Fitted Sheet
                                                                            </label>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <label for="">
                                                                                <input {{ isset($top_sheet) && $top_sheet == '1' ? 'checked' : '' }} type="checkbox" name="top_sheet" id="top_sheet"> Top sheet
                                                                            </label>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <label for="">
                                                                                <input {{ isset($blanket) && $blanket == '1' ? 'checked' : '' }} type="checkbox" name="blanket" id="blanket"> Blanket
                                                                            </label>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <label for="">
                                                                                <input {{ isset($extra_blankets) && $extra_blankets == '1' ? 'checked' : '' }} type="checkbox" name="extra_blankets" id="extra_blankets"> Extra Blankets
                                                                            </label>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <label for="">
                                                                                <input {{ isset($pillow) && $pillow == '1' ? 'checked' : '' }} type="checkbox" name="pillow" id="pillow"> Pillow
                                                                            </label>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <label for="">
                                                                                <input {{ isset($mattress_protector) && $mattress_protector == '1' ? 'checked' : '' }} type="checkbox" name="mattress_protector" id="mattress_protector"> Mattress protector
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Towels
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($towels) && $towels == '1' ? 'checked' : '' }} type="radio" name="towels" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($towels) || (isset($towels) && $towels == '0')  ? 'checked' : '' }} type="radio" name="towels" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Towels/Sheets (extra fee)
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input{{ isset($towels_sheets) && $towels_sheets == '1' ? 'checked' : '' }}  type="radio" name="towels_sheets" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($towels_sheets) || (isset($towels_sheets) && $towels_sheets == '0')  ? 'checked' : '' }} type="radio" name="towels_sheets" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="amenities-header">
                                        <h5>Outdoor & View</h5> <br>
                                    </div>
                                    <div class="amenities-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="amenities-list ">
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Balcony
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($balcony) && $balcony == '1' ? 'checked' : '' }} type="radio" name="balcony" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($balcony) || (isset($balcony) && $balcony == '0')  ? 'checked' : '' }} type="radio" name="balcony" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Patio
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($patio) && $patio == '1' ? 'checked' : '' }} type="radio" name="patio" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($patio) || (isset($patio) && $patio == '0')  ? 'checked' : '' }} type="radio" name="patio" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                View
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($view) && $view == '1' ? 'checked' : '' }} type="radio" name="view" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($view) || (isset($view) && $view == '0')  ? 'checked' : '' }} type="radio" name="view" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Terarce
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($terarce) && $terarce == '1' ? 'checked' : '' }} type="radio" name="terarce" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($terarce) || (isset($terarce) && $terarce == '0')  ? 'checked' : '' }} type="radio" name="terarce" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                City view
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($city_view) && $city_view == '1' ? 'checked' : '' }} type="radio" name="city_view" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($city_view) || (isset($city_view) && $city_view == '0')  ? 'checked' : '' }} type="radio" name="city_view" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Garden view
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($garden_view) && $garden_view == '1' ? 'checked' : '' }} type="radio" name="garden_view" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($garden_view) || (isset($garden_view) && $garden_view == '0')  ? 'checked' : '' }} type="radio" name="garden_view" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Lake view
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input{{ isset($lake_view) && $lake_view == '1' ? 'checked' : '' }} type="radio" name="lake_view" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($lake_view) || (isset($lake_view) && $lake_view == '0')  ? 'checked' : '' }} type="radio" name="lake_view" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Landmark view
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($landmark_view) && $landmark_view == '1' ? 'checked' : '' }} type="radio" name="landmark_view" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($landmark_view) || (isset($landmark_view) && $landmark_view == '0')  ? 'checked' : '' }} type="radio" name="landmark_view" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Mountain view
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($mountain_view) && $mountain_view == '1' ? 'checked' : '' }} type="radio" name="mountain_view" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($mountain_view) || (isset($mountain_view) && $mountain_view == '0')  ? 'checked' : '' }} type="radio" name="mountain_view" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Pool view
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($pool_view) && $pool_view == '1' ? 'checked' : '' }} type="radio" name="pool_view" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($pool_view) || (isset($pool_view) && $pool_view == '0')  ? 'checked' : '' }} type="radio" name="pool_view" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                River view
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($river_view) && $river_view == '1' ? 'checked' : '' }} type="radio" name="river_view" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($river_view) || (isset($river_view) && $river_view == '0')  ? 'checked' : '' }} type="radio" name="river_view" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Ocean view
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($ocean_view) && $ocean_view == '1' ? 'checked' : '' }} type="radio" name="ocean_view" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($ocean_view) || (isset($ocean_view) && $ocean_view == '0')  ? 'checked' : '' }} type="radio" name="ocean_view" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Inner courtyard view
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($inner_courtyard_view) && $inner_courtyard_view == '1' ? 'checked' : '' }} type="radio" name="inner_courtyard_view" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($inner_courtyard_view) || (isset($inner_courtyard_view) && $inner_courtyard_view == '0')  ? 'checked' : '' }} type="radio" name="inner_courtyard_view" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Quiet street view
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($quiet_street_view) && $quiet_street_view == '1' ? 'checked' : '' }} type="radio" name="quiet_street_view" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($quiet_street_view) || (isset($quiet_street_view) && $quiet_street_view == '0')  ? 'checked' : '' }}type="radio" name="quiet_street_view" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="amenities-header">
                                        <h5>Accessibility</h5> <br>
                                    </div>
                                    <div class="amenities-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="amenities-list ">
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Accessible by elevator
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($accessible_by_elevator) && $accessible_by_elevator == '1' ? 'checked' : '' }} type="radio" name="accessible_by_elevator" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($accessible_by_elevator) || (isset($accessible_by_elevator) && $accessible_by_elevator == '0')  ? 'checked' : '' }} type="radio" name="accessible_by_elevator" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Entire unit located on ground floor
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($entire_unit_located_on_ground_floor) && $entire_unit_located_on_ground_floor == '1' ? 'checked' : '' }} type="radio" name="entire_unit_located_on_ground_floor" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($entire_unit_located_on_ground_floor) || (isset($entire_unit_located_on_ground_floor) && $entire_unit_located_on_ground_floor == '0')  ? 'checked' : '' }} type="radio" name="entire_unit_located_on_ground_floor" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Entire unit wheelchair accessible
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($entire_unit_wheelchair_accessible) && $entire_unit_wheelchair_accessible == '1' ? 'checked' : '' }} type="radio" name="entire_unit_wheelchair_accessible" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($entire_unit_wheelchair_accessible) || (isset($entire_unit_wheelchair_accessible) && $entire_unit_wheelchair_accessible == '0')  ? 'checked' : '' }} type="radio" name="entire_unit_wheelchair_accessible" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Upper floors accessible by stairs only
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($upper_floors_accessible_by_stairs_only) && $upper_floors_accessible_by_stairs_only == '1' ? 'checked' : '' }} type="radio" name="upper_floors_accessible_by_stairs_only" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($upper_floors_accessible_by_stairs_only) || (isset($upper_floors_accessible_by_stairs_only) && $upper_floors_accessible_by_stairs_only == '0')  ? 'checked' : '' }} type="radio" name="upper_floors_accessible_by_stairs_only" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Adapted bath
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($adapted_bath) && $adapted_bath == '1' ? 'checked' : '' }} type="radio" name="adapted_bath" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($adapted_bath) || (isset($adapted_bath) && $adapted_bath == '0')  ? 'checked' : '' }} type="radio" name="adapted_bath" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Emergency cord in bathroom
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($emergency_cord_in_bathroom) && $emergency_cord_in_bathroom == '1' ? 'checked' : '' }} type="radio" name="emergency_cord_in_bathroom" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($emergency_cord_in_bathroom) || (isset($emergency_cord_in_bathroom) && $emergency_cord_in_bathroom == '0')  ? 'checked' : '' }} type="radio" name="emergency_cord_in_bathroom" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Raised toilet
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($raised_toilet) && $raised_toilet == '1' ? 'checked' : '' }} type="radio" name="raised_toilet" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($raised_toilet) || (isset($raised_toilet) && $raised_toilet == '0')  ? 'checked' : '' }} type="radio" name="raised_toilet" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Lower sink
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($lower_sink) && $lower_sink == '1' ? 'checked' : '' }} type="radio" name="lower_sink" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($lower_sink) || (isset($lower_sink) && $lower_sink == '0')  ? 'checked' : '' }} type="radio" name="lower_sink" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Roll-in shower
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($roll_in_shower) && $roll_in_shower == '1' ? 'checked' : '' }} type="radio" name="roll_in_shower" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($roll_in_shower) || (isset($roll_in_shower) && $roll_in_shower == '0')  ? 'checked' : '' }} type="radio" name="roll_in_shower" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Shower chair
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($shower_chair) && $shower_chair == '1' ? 'checked' : '' }} type="radio" name="shower_chair" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($shower_chair) || (isset($shower_chair) && $shower_chair == '0')  ? 'checked' : '' }} type="radio" name="shower_chair" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Toilet with grab rails
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($toilet_with_gran_rails) && $toilet_with_gran_rails == '1' ? 'checked' : '' }} type="radio" name="toilet_with_gran_rails" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($toilet_with_gran_rails) || (isset($toilet_with_gran_rails) && $toilet_with_gran_rails == '0')  ? 'checked' : '' }} type="radio" name="toilet_with_gran_rails" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Walk-in shower
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($walk_in_shower) && $walk_in_shower == '1' ? 'checked' : '' }} type="radio" name="walk_in_shower" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($walk_in_shower) || (isset($walk_in_shower) && $walk_in_shower == '0')  ? 'checked' : '' }} type="radio" name="walk_in_shower" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="amenities-header">
                                        <h5>Building Characteristics</h5> <br>
                                    </div>
                                    <div class="amenities-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="amenities-list ">
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Detaced
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($detaced) && $detaced == '1' ? 'checked' : '' }} type="radio" name="detaced" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($detaced) || (isset($detaced) && $detaced == '0')  ? 'checked' : '' }} type="radio" name="detaced" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Private apartment in building
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($private_apartment_in_building) && $private_apartment_in_building == '1' ? 'checked' : '' }} type="radio" name="private_apartment_in_building" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($private_apartment_in_building) || (isset($private_apartment_in_building) && $private_apartment_in_building == '0')  ? 'checked' : '' }} type="radio" name="private_apartment_in_building" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Semi-detached
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($semi_detached) && $semi_detached == '1' ? 'checked' : '' }} type="radio" name="semi_detached" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($semi_detached) || (isset($semi_detached) && $semi_detached == '0')  ? 'checked' : '' }} type="radio" name="semi_detached" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="amenities-header">
                                        <h5>Entertainments & Family Services</h5> <br>
                                    </div>
                                    <div class="amenities-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="amenities-list ">
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Baby safety gates
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($baby_safety_gates) && $baby_safety_gates == '1' ? 'checked' : '' }} type="radio" name="baby_safety_gates" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($baby_safety_gates) || (isset($baby_safety_gates) && $baby_safety_gates == '0')  ? 'checked' : '' }} type="radio" name="baby_safety_gates" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Board games/puzzels
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($board_games_puzzels) && $board_games_puzzels == '1' ? 'checked' : '' }} type="radio" name="board_games_puzzels" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($board_games_puzzels) || (isset($board_games_puzzels) && $board_games_puzzels == '0')  ? 'checked' : '' }} type="radio" name="board_games_puzzels" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Books, DVDs or music for children
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($books_dvds_or_music_for_children) && $books_dvds_or_music_for_children == '1' ? 'checked' : '' }} type="radio" name="books_dvds_or_music_for_children" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($books_dvds_or_music_for_children) || (isset($books_dvds_or_music_for_children) && $books_dvds_or_music_for_children == '0')  ? 'checked' : '' }} type="radio" name="books_dvds_or_music_for_children" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Child safety socket covers
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($child_safety_socket_covers) && $child_safety_socket_covers == '1' ? 'checked' : '' }} type="radio" name="child_safety_socket_covers" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($child_safety_socket_covers) || (isset($child_safety_socket_covers) && $child_safety_socket_covers == '0')  ? 'checked' : '' }} type="radio" name="child_safety_socket_covers" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="amenities-header">
                                        <h5>Safety & security</h5> <br>
                                    </div>
                                    <div class="amenities-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="amenities-list ">
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Carbon monoxide detector
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($carbon_monoxide_detector) && $carbon_monoxide_detector == '1' ? 'checked' : '' }} type="radio" name="carbon_monoxide_detector" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($carbon_monoxide_detector) || (isset($carbon_monoxide_detector) && $carbon_monoxide_detector == '0')  ? 'checked' : '' }} type="radio" name="carbon_monoxide_detector" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Carbon monoxide sources
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($carbon_monoxide_sources) && $carbon_monoxide_sources == '1' ? 'checked' : '' }} type="radio" name="carbon_monoxide_sources" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($carbon_monoxide_sources) || (isset($carbon_monoxide_sources) && $carbon_monoxide_sources == '0')  ? 'checked' : '' }} type="radio" name="carbon_monoxide_sources" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Smoke alarm &nbsp;<span
                                                                    class="badge badge-success">New!</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($smoke_alarm) && $smoke_alarm == '1' ? 'checked' : '' }} type="radio" name="smoke_alarm" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($smoke_alarm) || (isset($smoke_alarm) && $smoke_alarm == '0')  ? 'checked' : '' }} type="radio" name="smoke_alarm" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Fire extinguisher &nbsp;<span
                                                                    class="badge badge-success">New!</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($fire_extinguisher) && $fire_extinguisher == '1' ? 'checked' : '' }} type="radio" name="fire_extinguisher" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($fire_extinguisher) || (isset($fire_extinguisher) && $fire_extinguisher == '0')  ? 'checked' : '' }} type="radio" name="fire_extinguisher" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="amenities-header">
                                        <h5>Safety features</h5> <br>
                                    </div>
                                    <div class="amenities-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="amenities-list ">
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Air purifiers installed
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($air_purifiers_installed) && $air_purifiers_installed == '1' ? 'checked' : '' }} type="radio" name="air_purifiers_installed" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($air_purifiers_installed) || (isset($air_purifiers_installed) && $air_purifiers_installed == '0')  ? 'checked' : '' }} type="radio" name="air_purifiers_installed" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="amenities-header">
                                        <h5>Physical distancing</h5> <br>
                                    </div>
                                    <div class="amenities-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="amenities-list ">
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Single-room AC for guest accomodation
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($single_room_ac_for_guest_accomodation) && $single_room_ac_for_guest_accomodation == '1' ? 'checked' : '' }} type="radio" name="single_room_ac_for_guest_accomodation" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($single_room_ac_for_guest_accomodation) || (isset($single_room_ac_for_guest_accomodation) && $single_room_ac_for_guest_accomodation == '0')  ? 'checked' : '' }} type="radio" name="single_room_ac_for_guest_accomodation" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="amenities-wrapper mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="amenities-header">
                                        <h5>Cleanlineness & disinfection</h5> <br>
                                    </div>
                                    <div class="amenities-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="amenities-list ">
                                                    <div class="amenities-list-item no-gutters ">
                                                        <div class="col-md-3">
                                                            <div class="amenities-title">
                                                                Hand sanitizer
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="amenities-action">
                                                                <div class="amenities-custom-radio">
                                                                    <label for="">
                                                                        <input {{ isset($hand_sanitizer) && $hand_sanitizer == '1' ? 'checked' : '' }} type="radio" name="hand_sanitizer" id="">
                                                                        <span>Yes</span>
                                                                    </label>
                                                                    <label for="">
                                                                        <input {{ !isset($hand_sanitizer) || (isset($hand_sanitizer) && $hand_sanitizer == '0')  ? 'checked' : '' }} type="radio" name="hand_sanitizer" id="" >
                                                                        <span>No</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <script  type="text/javascript">
        $(document).ready(function(){
            @if($partnerAmenities->isEmpty())
                $('input:radio').each(function () {
                    console.log($(this).attr('name'));
                    $(this).val(0);
                });
            @else 
                @foreach($partnerAmenities as $partnerAmenity)
                    $("input[name*='{{$partnerAmenity->name}}']").val('{{$partnerAmenity->value}}');
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