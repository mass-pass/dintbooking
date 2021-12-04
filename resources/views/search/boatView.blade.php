@extends('layouts.master')
@push('css')

@if(false)
<link rel="stylesheet" type="text/css" href="{{ url('css/daterangepicker.min.css')}}" />
<link href="{{ url('css/bootstrap-slider.min.css') }}" rel="stylesheet" type="text/css" />
@endif

@endpush
@section('main')
<div id="search_boat_controller" class="container-fluid bg-white main-panel border-0 p-0">
    <div class="row">
        <!-- Filter section start-->
        <div class="col-md-7  hidden-pod filter-h" id="listCol">
            <div class="row mt-4">
                <h2 class="p-2">
                    {{trans('messages.search.results_for')}} 
                    <strong class="text-24">{{$location}}</strong>
                </h2>
                
                <input type="hidden" id="location_lat" value="{{ $lat }}">
                <input type="hidden" id="location_lng" value="{{ $long }}">
            </div>

            <div class="d-flex justify-content-between">
                <div>
                    <ul class="list-inline  pl-4">
                        <li class="list-inline-item mt-4">
                            <div class="dropdown">
                                <button class="btn text-16 border border-r-25 pl-4 pr-4 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{trans('messages.trips_active.location')}}
                                </button>

                                <div class="w-100">
                                    <div class="dropdown-menu dropdown-menu-location" aria-labelledby="dropdownMenuButton">
                                        <div class="row p-3">
                                            <form id="front-search-boat" method="get" action="{{url('boat/search')}}">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h3 class="font-weight-700 text-14">{{trans('messages.header.where_are_you_going')}}</h3>
                                                        <div class="input-group mt-4">
                                                            <input class="form-control p-3 text-14" type="hidden" id="city" value="{{$city}}" name="city" required>
                                                        </div>
                                                        <div class="input-group mt-4">
                                                            <input class="form-control p-3 text-14" id="location" value="{{$location}}" name="location" type="text" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 p-0">
                                                        <div class="row">
                                                            <div class="col-md-7">
                                                                <div class="d-flex" id="daterange-btn">
                                                                    <div class="pr-2">
                                                                        <h3 class="font-weight-700 mt-4 text-14">{{trans('messages.search.check_in')}}</h3>
                                                                        <div class="input-group mr-2">
                                                                            <input class="form-control p-3 border-right-0 border text-14" name="boat_date" id="boat_date" type="text" placeholder="{{trans('messages.search.check_in')}}" value="{{$boat_date}}" autocomplete="off" readonly="readonly" required>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-5">
                                                                <h3 class="font-weight-700 mt-4 text-14">No of People</h3>
                                                                <select class="form-control text-16" id="num_of_people" name="num_of_people">
                                                                    @for($i=1;$i<=16;$i++) <option value="{{ $i }}" {{ $num_of_passengers == $i ? 'selected': ''}}> {{ ($i == '16') ? $i.'+ ' : $i }} </option>
                                                                        @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="boatTypes" id="boatTypes" value="">
                                                    <div class="col-md-12 mt-5 text-center">
                                                        <button class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3" type="submit">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                            Find a Boat
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="list-inline-item  mt-4">
                            <button class="btn text-16 border border-r-25 pl-4 pr-4 dropdown-toggle" type="button" id="dropdownRoomType" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Boat Type
                            </button>
                            <div class="dropdown-menu dropdown-menu-room-type" aria-labelledby="dropdownRoomType">
                                <div class="row p-3">
                                    @foreach($boat_types as $key => $value)
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between pr-4">
                                                <div>
                                                    <p class="text-16"><i class="icon icon-entire-place"></i>{{ $value }}</p>
                                                </div>
                                                <div>
                                                    <input type="checkbox" id="boat_type_{{ $key }}" name="boatTypesPage[]" value="{{ $value }}" class="form-check-input" {{ in_array($value, $selected_boat_types) ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    @endforeach
                                    <div class="col-md-12 text-right mt-4">
                                        <button class="btn vbtn-success text-16 font-weight-700  rounded" id="btnBoatTypes">{{trans('messages.utility.submit')}}</button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="list-inline-item  mt-4">
                            <button class="btn text-16 border border-r-25 pl-4 pr-4 dropdown-toggle" type="button" id="dropdownPrice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Range filters
                            </button>

                            <div class="dropdown-menu dropdown-menu-price p-4" aria-labelledby="dropdownPrice">
                                <div class="col-md-12 mt-4">
                                    <span style="font-size: 18px;">Price Per Day</span>
                                </div>
                                <div class="row p-3">
                                    <div class="btn text-16 border price-btn  pl-4 pr-4">
                                        <span>$</span>
                                        <span id="minPrice">{{ $min_price }}</span>
                                    </div>

                                    <div class="pl-4 pr-4 pt-2 min-w-250">
                                        <input id="price-range" data-provide="slider" data-slider-min="{{ $min_price }}" data-slider-max="{{ $max_price }}" data-slider-value="[{{ $min_price }},{{ $max_price }}]" />
                                    </div>

                                    <div class="btn text-16 border price-btn  pl-4 pr-4 ">
                                        <span>$</span>
                                        <span id="maxPrice">{{ $max_price }}</span>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <span style="font-size: 18px;">Boat Length</span>
                                </div>
                                <div class="row p-3 mt-4">
                                    <div class="btn text-16 border price-btn  pl-4 pr-4">
                                        <span id="minLength">{{ $min_length }}</span>
                                    </div>

                                    <div class="pl-4 pr-4 pt-2 min-w-250">
                                        <input id="length-range" data-provide="slider" data-slider-min="{{ $min_length }}" data-slider-max="{{ $max_length }}" data-slider-value="[{{ $min_length }}, {{ $max_length }}]" />
                                    </div>

                                    <div class="btn text-16 border price-btn  pl-4 pr-4 ">
                                        <span id="maxLength">{{ $max_length }}</span>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <span style="font-size: 18px;">Boat Speed</span>
                                </div>
                                <div class="row p-3 mt-4">
                                    <div class="btn text-16 border price-btn  pl-4 pr-4">
                                        <span id="minSpeed">{{ $min_speed }}</span>
                                    </div>

                                    <div class="pl-4 pr-4 pt-2 min-w-250">
                                        <input id="speed-range" data-provide="slider" data-slider-min="{{ $min_speed }}" data-slider-max="{{ $max_speed }}" data-slider-value="[{{ $min_speed }}, {{ $max_speed }}]" />
                                    </div>

                                    <div class="btn text-16 border price-btn  pl-4 pr-4 ">
                                        <span id="maxSpeed">{{ $max_speed }}</span>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <span style="font-size: 18px;">Year Of manufacture</span>
                                </div>
                                <div class="row p-3 mt-4">
                                    <div class="btn text-16 border price-btn  pl-4 pr-4">
                                        <span id="minManufacturer">{{ $min_manufacturer }}</span>
                                    </div>

                                    <div class="pl-4 pr-4 pt-2 min-w-250">
                                        <input id="manufacture-range" data-provide="slider" data-slider-min="{{ $min_manufacturer }}" data-slider-max="{{ $max_manufacturer }}" data-slider-value="[{{ $min_manufacturer }}, {{ $max_manufacturer }}]" />
                                    </div>

                                    <div class="btn text-16 border price-btn  pl-4 pr-4 ">
                                        <span id="maxManufacturer">{{ $max_manufacturer }}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-right mt-4">
                                        <button class="btn vbtn-success text-16 font-weight-700  rounded" id="btnRange">{{ trans('messages.utility.submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="list-inline-item  mt-4">
                            <button type="button" id="more_filters" class="font-weight-500 btn text-16 border border-r-25 pl-4 pr-4" data-toggle="modal" data-target="#exampleModalCenter">
                                {{ trans('messages.search.more_filters') }}
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="pr-5">
                    <div class="show-map d-none" id="showMap">
                        <a href="#" class="btn text-16 border"><i class="fas fa-map-marked-alt"></i> {{ trans('messages.search.show_map') }}</a>
                    </div>
                </div>
            </div>
            <!-- No result found section start -->
            <div class="row mt-4">
                <div id="loader" class="display-off loader-img position-center">
                    <img src="{{URL::to('/')}}/front/img/green-loader.gif" alt="loader">
                </div>
            </div>

            <div class="row mt-3">
                <div id="boats_show" class="row w-100">
                    <div class="text-center justify-content-center w-100 position-center">
                        <!-- not found image -->
                    </div>
                </div>
            </div>
            <!-- No result found section end -->

            <!-- Pagination start -->
            <div class="row mt-4 mb-5">
                <div id="pagination">
                    <ul class="pager ml-4 pagination" id="pager">
                        <!--Pagination -->
                    </ul>
                    <div class="pl-3 text-16 mt-4"><span id="page-from">0</span> – <span id="page-to">0</span> {{ trans('messages.search.of') }} <span id="page-total">0</span> {{trans('messages.search.rentals')}}</div>
                </div>
            </div>
            <!-- Pagination end -->
        </div>
        <!-- Filter section end -->

        <!--Map section start -->
        <div class="col-md-5 p-0" id="mapCol">
            <div class="map-close" id="closeMap"><i class="fas fa-times text-24 p-3 pl-4 text-center"></i></div>
            <div id="map_view" class="map-view"></div>
        </div>
        <!--Map section end -->
    </div>

    <div class="row">
        <!-- Modal -->
        <div class="modal fade mt-5 z-index-high" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="w-100 pt-3">
                            <h5 class="modal-title text-20 text-center font-weight-700" id="exampleModalLongTitle">{{ trans('messages.search.more_filters') }}</h5>
                        </div>

                        <div>
                            <button type="button" class="close text-28 mr-2" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>

                    <div class="modal-body modal-body-filter">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="font-weight-700 text-24 mt-2 p-4" for="user_birthdate">{{ trans('messages.search.size') }}</h5>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="select col-sm-4">
                                        <select name="min_cabins" id="min_cabins" class="form-control" id="map-search-min-bedrooms">
                                            <option value="">Number Of Cabins</option>
                                            @for($i=1;$i<=10;$i++) 
                                                <option value="{{ $i }}">{{ $i }} Cabin</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="select col-sm-4">
                                        <select name="min_bathrooms" id="min_bathrooms" class="form-control" id="map-search-min-bathrooms">
                                            <option value="">Number Of Bathrooms</option>
                                                @for($i=1;$i<=10;$i++) 
                                                    <option class="bathrooms" value="{{ $i }}">{{ $i }} Bathroom</option>
                                                @endfor
                                        </select>
                                    </div>

                                    <div class="select col-sm-4">
                                        <select name="min_berths" id="min_berths" class="form-control" id="map-search-min-beds">
                                            <option value="">Number of berths</option>
                                                @for($i=1;$i<=10;$i++) 
                                                    <option value="{{ $i }}">{{ $i }} Berth</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer p-4">
                                <button class="btn btn-outline-danger text-16 pl-3 pr-3 mr-4"  data-dismiss="modal">{{ trans('messages.search.cancel') }}</button>
                                <button class="btn vbtn-outline-success filter-apply text-16 mr-5 pl-3 pr-3 ml-2" data-dismiss="modal">{{ trans('messages.search.apply_filter') }}</button>
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

@push('scripts')

<script>
    var SearchUrl = '{{url("search/boatResult")}}';
</script>

<script type="text/javascript" src="{{ mix('js/search-scripts-boats.js') }}"></script>

@if(false)
<script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{ @$map_key }}&libraries=places'></script>

<script type="text/javascript" src="{{ url('js/jquery-ui.js') }}"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="{{ url('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/daterangepicker.min.js')}}"></script>
<script src="{{ url('js/locationpicker.jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/daterangecustom.min.js')}}"></script>
<script type="text/javascript">
    $(function() {
        $('input[name="boat_date"]').daterangepicker({
            singleDatePicker: true
        });
    });
</script>

<script>
    $.fn.slider = null;
</script>
<script src="{{ url('js/bootstrap-slider.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[name="boatTypesPage[]"]').change(function() {
            var boat_types = [];
            $("input[name='boatTypesPage[]']:checked").each(function () {
                boat_types.push($(this).val());
            });
            if(boat_types.length > 0) {
                $('#boatTypes').val(boat_types.join(", "));
            } else {
                $('#boatTypes').val('');
            }
        });   
        var boat_types = [];
        $("input[name='boatTypesPage[]']:checked").each(function () {
            boat_types.push($(this).val());
        });
        if(boat_types.length > 0) {
            $('#boatTypes').val(boat_types.join(", "));
        } else {
            $('#boatTypes').val('');
        }     
    });
    var markers = [];
    var allowRefresh = true;
    var loadPage = '{{url("search/boatResult")}}';

    $("#price-range").slider();
    $("#price-range").on("slideStop", function(slideEvt) {
        var range = $('#price-range').attr('data-value');
        range = range.split(',');
        var min_price = range[0];
        var max_price = range[1];
        $('#minPrice').html(min_price);
        $('#maxPrice').html(max_price);
    });

    $("#length-range").slider();
    $("#length-range").on("slideStop", function(slideEvt) {
        var rangeLength = $('#length-range').attr('data-value');
        rangeLength = rangeLength.split(',');
        var min_length = rangeLength[0];
        var max_length = rangeLength[1];
        $('#minLength').html(min_length);
        $('#maxLength').html(max_length);
    });

    $("#speed-range").slider();
    $("#speed-range").on("slideStop", function(slideEvt) {
        var range = $('#speed-range').attr('data-value');
        range = range.split(',');
        var min_speed = range[0];
        var max_speed = range[1];
        $('#minSpeed').html(min_speed);
        $('#maxSpeed').html(max_speed);
    });

    $("#manufacture-range").slider();
    $("#manufacture-range").on("slideStop", function(slideEvt) {
        var range = $('#manufacture-range').attr('data-value');
        range = range.split(',');
        var min_manufacture = range[0];
        var max_manufacture = range[1];
        $('#minManufacture').html(min_manufacture);
        $('#maxManufacture').html(max_manufacture);
    });

    $('#header-search-form').on('change', function() {
        allowRefresh = true;
        deleteMarkers();
        loadPage = '{{url("search/boatResult")}}';
        getBoats($('#map_view').locationpicker('map').map);
    });

    $(document.body).on('click', '.page-data', function(e) {
        e.preventDefault();
        var hr = $(this).attr('href');
        loadPage = hr;
        allowRefresh = true;
        getBoats($('#map_view').locationpicker('map').map, hr);
    });

    function addMarker(map, features) 
    {
        var infowindow = new google.maps.InfoWindow();
        for (var i = 0, feature; feature = features[i]; i++) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(feature.latitude, feature.longitude),
                icon: feature.icon !== undefined ? feature.icon : undefined,
                map: map,
                title: feature.title !== undefined ? feature.title : undefined,
                content: feature.content !== undefined ? feature.content : undefined,
            });
            markers.push(marker);

            google.maps.event.addListener(marker, 'click', function(e) {

                if (this.content) {
                    infowindow.setContent(this.content);
                    infowindow.open(map, this);
                }
            });

        }
    }

    function setMapOnAll(map) 
    {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    function clearMarkers() 
    {
        setMapOnAll(null);
    }

    function deleteMarkers()
    {
        clearMarkers();
        markers = [];
    }

    function moneyFormat(symbol, value) {
        var symbolPosition = '<?php echo currencySymbolPosition(); ?>';
        if (symbolPosition == "before") {
            val = symbol + ' ' + value;
        } else {
            val = value + ' ' + symbol;
        }
        return val;
    }

    function getBoats(map, url) 
    {
        if (loadPage) {
            url = url || '';
            p = map;
            var a = p.getZoom(),
                t = p.getBounds(),
                o = t.getSouthWest().lat(),
                i = t.getSouthWest().lng(),
                s = t.getNorthEast().lat(),
                r = t.getNorthEast().lng(),
                l = t.getCenter().lat(),
                n = t.getCenter().lng();
            
            var map_details = a + "~" + t + "~" + o + "~" + i + "~" + s + "~" + r + "~" + l + "~" + n;
            var location = $('#location').val();
            var city = $('#city').val();
            var boat_date = $('#boat_date').val();
            var people = $('#num_of_people').val();
            var boat_types = getCheckedValueArray('boatTypesPage');
            $('#header-search-form').val(location);

            var priceRange = $('#price-range').attr('data-value');
            priceRange = priceRange.split(',');
            var min_price = priceRange[0];
            var max_price = priceRange[1];
            $('#minPrice').html(min_price);
            $('#maxPrice').html(max_price);

            var lengthRange = $('#length-range').attr('data-value');
            lengthRange = lengthRange.split(',');
            var min_length = lengthRange[0];
            var max_length = lengthRange[1];
            $('#minLength').html(min_length);
            $('#maxLength').html(max_length);

            var speedRange = $('#speed-range').attr('data-value');
            speedRange = speedRange.split(',');
            var min_speed = speedRange[0];
            var max_speed = speedRange[1];
            $('#minSpeed').html(min_speed);
            $('#maxSpeed').html(max_speed);

            var manufactureRange = $('#manufacture-range').attr('data-value');
            manufactureRange = manufactureRange.split(',');
            var min_manufacture = manufactureRange[0];
            var max_manufacture = manufactureRange[1];
            $('#minManufacture').html(min_manufacture);
            $('#maxManufacture').html(max_manufacture);

            var cabins = $('#min_cabins').val();
            var bathrooms = $('#min_bathrooms').val();
            var berths = $('#min_berths').val();
           
            var checkout = $('#endDate').val();
            var guest = $('#front-search-guests').val();
            var dataURL = loadPage;

            if ($('#more_filters').css('display') != 'none') {
                $.ajax({
                    url: dataURL,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'boat_date': boat_date,
                        'location': location,
                        'city': city,
                        'people': people,
                        'boat_types': boat_types,
                        'min_price': min_price,
                        'max_price': max_price,
                        'min_length': min_length,
                        'max_length': max_length,
                        'min_speed': min_speed,
                        'max_speed': max_speed,
                        'min_manufacture': min_manufacture,
                        'max_manufacture': max_manufacture,
                        'cabins': cabins,
                        'bathrooms': bathrooms,
                        'berths': berths,
                        'map_details': map_details
                    },
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#boats_show').html("");
                        show_loader();
                    },
                    success: function(result) {
                        $('#page-total').html(result.total);
                        $('#page-from').html(result.from);
                        $('#page-to').html(result.to);
                        allowRefresh = false;
                        var pager = '';
                        if (result.total > 0) {
                            if (result.current_page > 1) pager += '<li class="page-item"><a class="page-data page-link" href="' + result.prev_page_url + '">Previous</a></li>';
                            if (result.current_page) {
                                for (var i = 1; i <= result.last_page; i++) {
                                    if (result.current_page == i) {
                                        pager += '<li class="page-item active"><a  href="' + APP_URL + '/search/boatResult?page=' + i + '" class="page-data page-link">' + i + '</a></li>';
                                    } else {
                                        pager += '<li class="page-item"><a  href="' + APP_URL + '/search/boatResult?page=' + i + '" class="page-data page-link">' + i + '</a></li>';

                                    }
                                }
                            }

                            if (result.next_page_url) pager += '<li class="page-item"><a class="page-data page-link" href="' + result.next_page_url + '">Next</a></li>';
                            $('#pager').html(pager);
                            $('#pagination').removeClass('d-none');
                        } else {
                            $('#pagination').addClass('d-none');
                        }
                        var boats = result.data;
                        var boat_point = [];
                        var boat_div = "";
                        for (var key in boats) {
                            console.log(key);

                            if (boats.hasOwnProperty(key)) {
                                // boat_point[key] = {
                                //     latitude: properties[key].property_address.latitude,
                                //     longitude: properties[key].property_address.longitude,
                                //     title: properties[key].name,

                                //     content: '<a href="' + APP_URL + '/properties/' + properties[key].slug + '?checkin=' + checkin + '&checkout=' + checkout + '&guests=' + guest + '" class="media-cover" target="_blank">' +
                                //         '<img class="map-property-img p-1" src="' + properties[key].cover_photo + '"alt="' + properties[key].name + '">' +
                                //         '</a>' +
                                //         '<div class="map-property-name">' +
                                //         '<div class="col-xs-12 p-1">' +
                                //         '<div class="location-title"><h5>' + properties[key].name + '</h5></div>' +
                                //         '</div>' +
                                //         '</div>'
                                // };

                                var avg_rating = 0;
                                reviews_count = 0;
                                console.log(boats[key].price);
                                var symbolWithPrice = '$ '+ boats[key].price;

                                var colDiv = 'col-md-6 col-lg-4 p-2';
                                var divCol = $('#listCol').hasClass('col-md-7');
                                
                                boat_div += '<div class="col-sm-6 col-md-12 col-lg-12  p-0 mb-4">' +
                                    '<div class=" row  border p-2 rounded-3">' +
                                    '<div class="col-lg-5 p-2">' +
                                    '<div class="img-event">' +
                                    '<a href="' + APP_URL + '/boats/' + boats[key].slug + '?travelling_date='+boat_date+ '" target="_blank">' +
                                    '<img class="img-fluid rounded" src="' + boats[key].cover_photo + '" alt="' + boats[key].name + '">' +
                                    '</a>' +
                                    '</div>' +
                                    '</div>'

                                    +
                                    '<div class="col-lg-7 p-2">' +
                                    '<div class="row justify-content-between">' +
                                    '<div class="col-sm-12 pl-0">' +
                                    '<a href="' + APP_URL + '/boats/' + boats[key].slug + '?travelling_date='+boat_date+ '" target="_blank">' +
                                    '<p class="mb-0 text-18 text-color font-weight-700 text-color-hover text">' + boats[key].title + '</p>' +
                                    '</a>' +
                                    '</div>' +
                                    '</div>'

                                    +
                                    '<div class="review-0 mt-4">' +
                                    '<div class="d-flex justify-content-between">' +
                                    '<div>' +
                                    '<span><i class="fa fa-star text-14 secondary-text-color"></i>' + ' ' + avg_rating +
                                    ' ' + '(' + reviews_count + ')</span>' +
                                    '</div>'

                                    +
                                    '<div>' +
                                    '<span class="font-weight-700 text-20">' + symbolWithPrice + '</span> / Per Day' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>'

                                    +
                                    '<ul class="list-inline mt-2 pb-3">' +
                                    '<li class="list-inline-item border rounded-3 p-1 mt-4 pl-3 pr-3">' +
                                    '<p class="text-center mb-0">' +
                                    '<i class="fas fa-ship text-20 d-none d-sm-inline-block text-muted"></i> ' +
                                    boats[key].cabin_count +
                                    '<span class=" text-14 font-weight-700"> Cabin</span>' +
                                    '</p>' +
                                    '</li>' +
                                    '<li class="list-inline-item  border rounded-3 mt-4 p-1  pl-3 pr-3">' +
                                    '<p  class="text-center mb-0" >' +
                                    '<i class="fas fa-user-friends d-none d-sm-inline-block text-20 text-muted"></i> ' +
                                    boats[key].authorised_onboard_capacity +
                                    '<span class=" text-14 font-weight-700"> OnBoard Capacity</span>' +
                                    '</p>' +
                                    '</li>' +
                                    '<li class="list-inline-item  border rounded-3 mt-4 p-1  pl-3 pr-3">' +
                                    '<p  class="text-center mb-0">' +
                                    '<i class="fas fa-bath text-20  d-none d-sm-inline-block  text-muted"></i> ' +
                                    boats[key].bathroom_count +
                                    '<span class="text-14 font-weight-700"> Bathrooms</span>' +
                                    '</p>' +
                                    '</li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>'
                                
                            }
                        }
                        if (boat_div != '') {
                            $('#boats_show').html(boat_div);
                        } else {
                            $('#boats_show').html('<div class="text-center justify-content-center w-100 position-center"><img src="{{ url('img/not-found.png')}}" class="img-fluid not-found" alt="not-found"><h4 class="text-center text-20 font-weight-700">No Records Found</h4></div>');
                        } 
                        addMarker(map, boat_point);
                    },
                    error: function(request, error) {
                        allowRefresh = false;
                        console.log(error);
                    },
                    complete: function() {
                        hide_loader();
                    }
                });
            }
        }
    }

    $('#btnBoatTypes, #btnRange, .filter-apply').on('click', function() {
        allowRefresh = true;
        deleteMarkers();
        loadPage = '{{url("search/boatResult")}}';
        getBoats($('#map_view').locationpicker('map').map);
        $('.room_filter').addClass('display-off');
        $('#more_filters').show();
        $('.dropdown-menu-price').removeClass('show');
    });


    function getCheckedValueArray(field_name) 
    {
        var array_Value = '';
        array_Value = $('input[name="' + field_name + '[]"]:checked').map(function() {
            return this.value;
        }).get().join(',');
        return array_Value;
    }

    $(document.body).on('click', '#map_view', function() {
        allowRefresh = true;
        loadPage = '{{url("search/boatResult")}}';
        getBoats($('#map_view').locationpicker('map').map);
    });

    $('#map_view').locationpicker({
        location: {
            latitude: "{{ $lat }}",
            longitude: " {{ $long }}"
        },
        radius: 0,
        zoom: 12,
        addressFormat: "",
        markerVisible: false,
        markerInCenter: true,
        inputBinding: {
            latitudeInput: $('#latitude'),
            longitudeInput: $('#longitude'),
            locationNameInput: $('#address_line_1')
        },
        enableAutocomplete: true,
        draggable: true,
        onclick: function (currentLocation, radius, isMarkerDropped) {
            if (allowRefresh == true) {
                getProperties($(this).locationpicker('map').map);
            }
        },

        oninitialized: function (component) {
            var addressComponents = $(component).locationpicker('map').location.addressComponents;
        }
    });

    $('.slider-selection').trigger('click');

    function show_loader() {
        $('#loader').removeClass('display-off');
        $('#pagination').hide();
    }

    function hide_loader() {
        $('#loader').addClass('display-off');
        $('#pagination').show();
    }

    // Map Close
    $('#closeMap').on('click', function() {
        $('#listCol').removeClass('col-md-7');
        $('#listCol').addClass('col-md-12');
        $('#mapCol').addClass('d-none');
        $('#showMap').removeClass('d-none');

        allowRefresh = true;
        loadPage = '{{url("search/boatResult")}}';
        getBoats($('#map_view').locationpicker('map').map);
    });
    // Map show
    $('#showMap').on('click', function() {
        $('#listCol').removeClass('col-md-12');
        $('#listCol').addClass('col-md-7');
        $('#mapCol').removeClass('d-none');
        $('#showMap').addClass('d-none');
        allowRefresh = true;
        loadPage = '{{url("search/boatResult")}}';
        getBoats($('#map_view').locationpicker('map').map);
    });

    $(window).on("load", function() {
        allowRefresh = true;
        loadPage = '{{url("search/boatResult")}}';
        getBoats($('#map_view').locationpicker('map').map);
    });
    
</script>

<script type="text/javascript">
    $(document).on('click', '.dropdown-menu-price', function(e) {
        e.stopPropagation();
    });
</script>
@endif

@endpush

@endsection
