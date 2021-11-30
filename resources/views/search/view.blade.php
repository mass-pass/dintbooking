@extends('layouts.master')
@push('css')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.min.css"
    integrity="sha512-3q8fi8M0VS+X/3n64Ndpp6Bit7oXSiyCnzmlx6IDBLGlY5euFySyJ46RUlqIVs0DPCGOypqP8IRk/EyPvU28mQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

@if(false)
<link rel="stylesheet" type="text/css" href="{{ url('css/daterangepicker.min.css')}}" />
<link href="{{ url('css/bootstrap-slider.min.css') }}" rel="stylesheet" type="text/css" />
@endif

@endpush

@section('main')
<div class="container-fluid bg-white main-panel border-0 p-0">
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
                <input type="hidden" id="location_city" value="">
                <input type="hidden" id="location" name="location" value="{{$location}}">
            </div>

            <div class="d-flex justify-content-between">
                <div>
                    <ul class="list-inline  pl-4">
                        <li class="list-inline-item mt-4">
                            <div class="dropdown">
                                <button class="btn text-16 border border-r-25 pl-4 pr-4 dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    {{trans('messages.trips_active.location')}}
                                </button>

                                <div class="w-100">
                                    <div class="dropdown-menu dropdown-menu-location"
                                        aria-labelledby="dropdownMenuButton">
                                        <div class="row p-3">
                                            <form id="front-search-form" method="post" action="{{url('search')}}">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h3 class="font-weight-700 text-14">
                                                            {{trans('messages.header.where_are_you_going')}} </h3>
                                                        <div class="input-group mt-4">
                                                            <input class="form-control p-3 text-14"
                                                                id="front-search-field" value="{{$location}}"
                                                                autocomplete="off" name="location" type="text" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 p-0">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <div class="d-flex" id="daterange-btn">
                                                                    <div class="pr-2">
                                                                        <h3 class="font-weight-700 mt-4 text-14">
                                                                            {{trans('messages.search.check_in')}}</h3>
                                                                        <div class="input-group mr-2">
                                                                            <input
                                                                                class="form-control p-3 border-right-0 border text-14 checkinout"
                                                                                name="checkin" id="startDate"
                                                                                type="text"
                                                                                placeholder="{{trans('messages.search.check_in')}}"
                                                                                value="{{$checkin}}" autocomplete="off"
                                                                                readonly="readonly" required>
                                                                            <span class="input-group-append">
                                                                                <div class="input-group-text">
                                                                                    <i
                                                                                        class="fa fa-calendar success-text text-14"></i>
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                    <div>
                                                                        <h3 class="font-weight-700 mt-4 text-14">
                                                                            {{trans('messages.search.check_out')}}</h3>
                                                                        <div class="input-group ml-2">
                                                                            <input
                                                                                class="form-control p-3 border-right-0 border text-14 checkinout"
                                                                                name="checkout" id="endDate" type="text"
                                                                                placeholder="{{trans('messages.search.check_out')}}"
                                                                                value="{{$checkout}}"
                                                                                readonly="readonly" required>
                                                                            <span class="input-group-append">
                                                                                <div class="input-group-text">
                                                                                    <i
                                                                                        class="fa fa-calendar success-text text-14"></i>
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <h3 class="font-weight-700 mt-4 text-14">
                                                                    {{trans('messages.search.guest')}}</h3>
                                                                <select class="form-control text-16"
                                                                    id="front-search-guests" name="guests">
                                                                    @for($i=1;$i<=16;$i++) <option value="{{ $i }}">
                                                                        {{ ($i == '16') ? $i.'+ ' : $i }} </option>
                                                                        @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-5 text-center">
                                                        <button
                                                            class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3"
                                                            type="submit">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                            {{trans('messages.header.find_place')}}
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
                            <button class="btn text-16 border border-r-25 pl-4 pr-4 dropdown-toggle" type="button"
                                id="dropdownRoomType" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{trans('messages.search.room_type')}}
                            </button>

                            <div class="dropdown-menu dropdown-menu-room-type" aria-labelledby="dropdownRoomType">
                                <div class="row p-3">
                                    @foreach($space_type as $rws=>$value)
                                    <div class="col-md-12">
                                        @if($rws==1)
                                        <div class="d-flex justify-content-between pr-4">
                                            <div>
                                                <p class="text-16"><i class="icon icon-entire-place"></i> {{ $value }}
                                                </p>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="space_type_{{ $rws }}" name="space_type[]"
                                                    value="{{ $rws }}" class="form-check-input"
                                                    {{ in_array($rws, $space_type_selected)?'checked':'' }}>
                                            </div>
                                        </div>
                                        @endif

                                        @if($rws==2)
                                        <div class="d-flex justify-content-between pr-4">
                                            <div>
                                                <p class="text-16"><i class="icon icon-private-room"></i> {{ $value }}
                                                </p>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="space_type_{{ $rws }}" name="space_type[]"
                                                    value="{{ $rws }}" class="form-check-input"
                                                    {{ in_array($rws, $space_type_selected)?'checked':'' }}>
                                            </div>
                                        </div>
                                        @endif

                                        @if($rws==3)
                                        <div class="d-flex justify-content-between pr-4">
                                            <div>
                                                <p class="text-16"><i class="icon icon-shared-room"></i> {{ $value }}
                                                </p>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="space_type_{{ $rws }}" name="space_type[]"
                                                    value="{{ $rws }}" class="form-check-input"
                                                    {{ in_array($rws, $space_type_selected)?'checked':'' }}>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                    <div class="col-md-12 text-right mt-4">
                                        <button class="btn vbtn-success text-16 font-weight-700  rounded"
                                            id="btnRoom">{{trans('messages.utility.submit')}}</button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="list-inline-item  mt-4">
                            <button class="btn text-16 border border-r-25 pl-4 pr-4 dropdown-toggle" type="button"
                                id="dropdownBookingType" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{trans('messages.listing_book.booking_type')}}
                            </button>
                            <div class="w-100">
                                <div class="dropdown-menu filter-dropdown-menu caed-raise dropdown-menu-room-type"
                                    aria-labelledby="dropdownRoomType">
                                    <form onsubmit="return false">
                                    <div class="row p-3">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between pr-4">
                                                <div>
                                                    <p class="text-16"><i class="fa fa-clock text-beach"></i>
                                                        {{trans('messages.property_single.request_book')}}</p>
                                                </div>
                                                <div>
                                                    <input type="checkbox" name="book_type[]" class="form-check-input"
                                                        value="request">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between pr-4">
                                                <div>
                                                    <p class="text-16"><i class="fa  fa-bolt text-beach"></i>
                                                        {{trans('messages.property_single.instant_book')}}</p>
                                                </div>
                                                <div>
                                                    <input type="checkbox" name="book_type[]" class="form-check-input"
                                                        value="instant">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-right mt-4">
                                            <button type="button" class="btn vbtn-success text-16 font-weight-700  rounded"
                                                id="btnBook">{{trans('messages.utility.submit')}}</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </li>

                        <li class="list-inline-item  mt-4">
                            <button class="btn text-16 border border-r-25 pl-4 pr-4 dropdown-toggle" type="button"
                                id="dropdownPrice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{trans('messages.search.price_range')}}
                            </button>

                            <div class="w-100">
                                <div class="dropdown-menu filter-dropdown-menu dropdown-menu-price p-4"
                                    aria-labelledby="dropdownPrice">
                                    <form onsubmit="return false">
                                        <div class="row p-3 mt-4">
                                            <div class="btn text-16 border price-btn  pl-4 pr-4">
                                                <span>$</span>
                                                <span id="minPrice">{{ $min_price }}</span>
                                            </div>

                                            <div class="pl-4 pr-4 pt-2 min-w-250">
                                                <input id="price-range" data-provide="slider"
                                                    data-slider-min="{{ $min_price }}"
                                                    data-slider-max="{{ $max_price }}"
                                                    data-slider-value="[{{ $min_price }},{{ $max_price }}]" />
                                            </div>

                                            <div class="btn text-16 border price-btn  pl-4 pr-4 ">
                                                <span>$</span>
                                                <span id="maxPrice">{{ $min_price }}</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 text-right mt-4">
                                                <button type="button"
                                                    class="btn vbtn-success text-16 font-weight-700 rounded"
                                                    id="btnPrice">{{ trans('messages.utility.submit') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>

                        <li class="list-inline-item  mt-4">
                            <button type="button" id="more_filters"
                                class="font-weight-500 btn text-16 border border-r-25 pl-4 pr-4" data-toggle="modal"
                                data-target="#exampleModalCenter">
                                {{ trans('messages.search.more_filters') }}
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="pr-5">
                    <div class="show-map d-none" id="showMap">
                        <a href="#" class="btn text-16 border"><i class="fas fa-map-marked-alt"></i>
                            {{ trans('messages.search.show_map') }}</a>
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
                <div id="properties_show" class="row w-100">
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
                    <div class="pl-3 text-16 mt-4"><span id="page-from">0</span> – <span id="page-to">0</span>
                        {{ trans('messages.search.of') }} <span id="page-total">0</span>
                        {{trans('messages.search.rentals')}}</div>
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
        <div class="modal fade mt-5 z-index-high" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="w-100 pt-3">
                            <h5 class="modal-title text-20 text-center font-weight-700" id="exampleModalLongTitle">
                                {{ trans('messages.search.more_filters') }}</h5>
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
                                <h5 class="font-weight-700 text-24 mt-2 p-4" for="user_birthdate">
                                    {{ trans('messages.search.size') }}</h5>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="select col-sm-4">
                                        <select name="min_bedrooms" class="form-control" id="map-search-min-bedrooms">
                                            <option value="">{{ trans('messages.search.bedrooms') }}</option>
                                            @for($i=1;$i<=10;$i++) <option value="{{ $i }}"
                                                {{ ($bedrooms==$i)?'selected':''}}>
                                                {{ $i }} {{ trans('messages.search.bedrooms') }}
                                                </option>
                                                @endfor
                                        </select>
                                    </div>

                                    <div class="select col-sm-4">
                                        <select name="min_bathrooms" class="form-control" id="map-search-min-bathrooms">
                                            <option value="">{{ trans('messages.search.bathrooms') }}</option>
                                            @for($i=0.5;$i<=8;$i+=0.5) <option class="bathrooms" value="{{ $i }}"
                                                {{ $bathrooms == $i?'selected':''}}>
                                                {{ ($i == '8') ? $i.'+' : $i }} {{ trans('messages.search.bathrooms') }}
                                                </option>
                                                @endfor
                                        </select>
                                    </div>

                                    <div class="select col-sm-4">
                                        <select name="min_beds" class="form-control" id="map-search-min-beds">
                                            <option value="">{{ trans('messages.search.beds') }}</option>
                                            @for($i=1;$i<=16;$i++) <option value="{{ $i }}"
                                                {{ $beds == $i?'selected':''}}>
                                                {{ ($i == '16') ? $i.'+' : $i }} {{ trans('messages.search.beds') }}
                                                </option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-sm-12">
                                <h5 class="font-weight-700 text-24 pl-4" for="user_birthdate">
                                    {{ trans('messages.search.amenities') }}</h5>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    @php $row_inc = 1 @endphp

                                    @foreach($amenities as $row_amenities)
                                    @if($row_inc <= 4) <div class="col-md-6">
                                        <div class="form-check mt-4">
                                            <input type="checkbox" name="amenities[]" value="{{ $row_amenities->id }}"
                                                class="form-check-input mt-2 amenities_array"
                                                id="map-search-amenities-{{ $row_amenities->id }}">
                                            <label class="form-check-label mt-2 ml-25" for="exampleCheck1">
                                                {{ $row_amenities->title }}</label>
                                        </div>
                                </div>
                                @endif

                                @php $row_inc++ @endphp
                                @endforeach

                                <div class="collapse" id="amenities-collapse">
                                    <div class="row">
                                        @php $amen_inc = 1 @endphp
                                        @foreach($amenities as $row_amenities)
                                        @if($amen_inc > 4)
                                        <div class="col-md-6 mt-4">
                                            <div class="form-check">
                                                <input type="checkbox" name="amenities[]"
                                                    value="{{ $row_amenities->id }}"
                                                    class="form-check-input mt-2 amenities_array"
                                                    id="map-search-amenities-{{ $row_amenities->id }}"
                                                    ng-checked="{{ (in_array($row_amenities->id, $amenities_selected)) ? 'true' : 'false' }}">
                                                <label class="form-check-label mt-2 ml-25" for="exampleCheck1">
                                                    {{ $row_amenities->title }}</label>
                                            </div>
                                        </div>
                                        @endif
                                        @php $amen_inc++ @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="cursor-pointer" data-toggle="collapse" data-target="#amenities-collapse">
                                <span class="font-weight-600 ml-4"><u> Show all amenities</u></span>
                                <i class="fa fa-plus"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-12">
                            <h5 class="font-weight-700 text-24 pl-4" for="user_birthdate">
                                {{ trans('messages.search.property_type') }}</h5>
                        </div>

                        <div class="col-sm-12">
                            <div class="row mt-2">
                                @php $pro_inc = 1 @endphp
                                @foreach($property_type as $row_property_type =>$value_property_type)
                                @if($pro_inc <= 4) <div class="col-md-6">
                                    <div class="form-check mt-4">
                                        <input type="checkbox" name="property_type[]" value="{{ $row_property_type }}"
                                            class="form-check-input mt-2"
                                            id="map-search-property_type-{{ $row_property_type }}">
                                        <label class="form-check-label mt-2 ml-25" for="exampleCheck1">
                                            {{ $value_property_type}}</label>
                                    </div>
                            </div>
                            @endif
                            @php $pro_inc++ @endphp
                            @endforeach

                            <div class="collapse" id="property-collapse">
                                <div class="row">
                                    @php $property_inc = 1 @endphp
                                    @foreach($property_type as $row_property_type =>$value_property_type)
                                    @if($property_inc > 4)
                                    <div class="col-md-6 mt-4">
                                        <div class="form-check">
                                            <input type="checkbox" name="property_type[]"
                                                value="{{ $row_property_type }}" class="form-check-input mt-2"
                                                id="map-search-property_type-{{ $row_property_type }}">
                                            <label class="form-check-label mt-2 ml-25" for="exampleCheck1">
                                                {{ $value_property_type}}</label>
                                        </div>
                                    </div>
                                    @endif
                                    @php $property_inc++ @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="cursor-pointer" data-toggle="collapse" data-target="#property-collapse">
                            <span class="font-weight-600 text-16 ml-4"><u> Show all property type</u></span>
                            <i class="fa fa-plus"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer p-4">
                <button class="btn btn-outline-danger text-16 pl-3 pr-3 mr-4"
                    data-dismiss="modal">{{ trans('messages.search.cancel') }}</button>
                <button class="btn vbtn-outline-success filter-apply text-16 mr-5 pl-3 pr-3 ml-2"
                    data-dismiss="modal">{{ trans('messages.search.apply_filter') }}</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@push('scripts')
<script>
    $.fn.slider = null;
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js"
    integrity="sha512-f0VlzJbcEB6KiW8ZVtL+5HWPDyW1+nJEjguZ5IVnSQkvZbwBt2RfCBY0CBO1PsMAqxxrG4Di6TfsCPP3ZRwKpA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{{ mix('js/search-scripts-properties.js') }}"></script>

@if(false)
<script type="text/javascript" src="{{ url('js/front.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery-ui.js') }}"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="{{ url('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/daterangepicker.min.js')}}"></script>
<script src="{{ url('js/locationpicker.jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/daterangecustom.min.js')}}"></script>
<script type="text/javascript">
    $(function() {
            var checkin = $('#startDate').val();
            var checkout = $('#endDate').val();
			dateRangeBtn(checkin,checkout);
		});
</script>

<script>
    $.fn.slider = null;
</script>
<script src="{{ url('js/bootstrap-slider.min.js') }}"></script>
<script src="{{ url('js/searchresults.js') }}">
        var markers      = [];
        var allowRefresh = true;
        var loadPage = '{{url("search/result")}}';

        $("#price-range").slider();
        

        $("#price-range").on("slideStop", function(slideEvt) {
            var range       = $('#price-range').attr('data-value');
            range           = range.split(',');
            var min_price       = range[0];
            var max_price       = range[1];
            $('#minPrice').html(min_price);
            $('#maxPrice').html(max_price);
        });

        $('#header-search-form').on('change', function(){
            allowRefresh = true;
            deleteMarkers();
            loadPage = '{{url("search/result")}}';
            getProperties($('#map_view').locationpicker('map').map);
        });

        $("#search-pg-checkin").datepicker({
            dateFormat:"mm-dd-yy",
            minDate: 0,
            onSelect: function(e) {
                var t = $("#search-pg-checkin").datepicker("getDate");
                t.setDate(t.getDate() + 1), $("#search-pg-checkout").datepicker("option", "minDate", t), setTimeout(function() {
                    $("#search-pg-checkout").datepicker("show")
                }, 20);
                allowRefresh = true;
                loadPage = '{{url("search/result")}}';
                getProperties($('#map_view').locationpicker('map').map);
            }
        });

        $("#search-pg-checkout").datepicker({
            dateFormat:"mm-dd-yy",
            minDate: 1,
            onClose: function() {
                var e = $("#checkin").datepicker("getDate"),
                    t = $("#header-search-checkout").datepicker("getDate");
                if (e >= t) {
                    var a = $("#search-pg-checkout").datepicker("option", "minDate");
                    $("#search-pg-checkout").datepicker("setDate", a)
                }
            }, onSelect: function(){
                allowRefresh = true;
                loadPage = '{{url("search/result")}}';
                getProperties($('#map_view').locationpicker('map').map);
            }
        });

        $(document.body).on('click', '.page-data', function(e){
            e.preventDefault();
            var hr = $(this).attr('href');
            loadPage = hr;
            allowRefresh = true;
            getProperties($('#map_view').locationpicker('map').map, hr);
        });

        function addMarker(map, features){

            var infowindow = new google.maps.InfoWindow();
            for (var i = 0, feature; feature = features[i]; i++) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(feature.latitude, feature.longitude),
                    icon: feature.icon !== undefined ? feature.icon : undefined,
                    map: map,
                    title: feature.title !== undefined? feature.title : undefined,
                    content: feature.content !== undefined? feature.content : undefined,
                });
                markers.push(marker);

                google.maps.event.addListener(marker, 'click', function (e) {
                    
                    if(this.content){
                        infowindow.setContent(this.content);
                        infowindow.open(map, this);
                    }
                });

            }
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setMapOnAll(null);
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }

        function moneyFormat(symbol, value) {
            var symbolPosition = 'before';
            if (symbolPosition == "before") {
            val = symbol + ' ' + value;
            } else {
                val = value + ' ' + symbol;
            }
            return val;
        }

        function getProperties(map,url){

            if(loadPage) {
                url = url||'';
            p = map;
            var a = p.getZoom(),
                t = p.getBounds(),
                o = t.getSouthWest().lat(),
                i = t.getSouthWest().lng(),
                s = t.getNorthEast().lat(),
                r = t.getNorthEast().lng(),
                l = t.getCenter().lat(),
                n = t.getCenter().lng();

            var range       = $('#price-range').attr('data-value');
            range           = range.split(',');
            var map_details = a + "~" + t + "~" + o + "~" + i + "~" + s + "~" + r + "~" + l + "~" + n;
            var location    = $('#location').val();

            //Input Search value set
            $('#header-search-form').val(location);
            //Input Search value set
            var min_price       = range[0];
            var max_price       = range[1];
            $('#minPrice').html(min_price);
            $('#maxPrice').html(max_price);

            var amenities       = getCheckedValueArray('amenities');
            var property_type   = getCheckedValueArray('property_type');
            var book_type       = getCheckedValueArray('book_type');
            var space_type      = getCheckedValueArray('space_type');
            var beds            = $('#map-search-min-beds').val();
            var bathrooms       = $('#map-search-min-bathrooms').val();
            var bedrooms        = $('#map-search-min-bedrooms').val();
            var checkin         = $('#startDate').val();
            var checkout        = $('#endDate').val();
            var guest           = $('#front-search-guests').val();
            //var map_details = map_details;
            var dataURL = loadPage;
            // if(url != '') dataURL = url;

            if($('#more_filters').css('display') != 'none'){
                $.ajax({
                    url: dataURL,
                    data: {
                        "_token": "h1d9vLh3NoAnjnol1ss8KPKiPWvzSI2TETBCVqKM",
                        'location': location,
                        'min_price': min_price,
                        'max_price': max_price,
                        'amenities': amenities,
                        'property_type': property_type,
                        'book_type':book_type,
                        'space_type': space_type,
                        'beds': beds,
                        'bathrooms': bathrooms,
                        'bedrooms': bedrooms,
                        'checkin': checkin,
                        'checkout': checkout,
                        'guest': guest,
                        'map_details': map_details
                    },
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function (){
                        $('#properties_show').html("");
                        show_loader();
                    },
                    success: function (result) {
                        $('#page-total').html(result.total);
                        $('#page-from').html(result.from);
                        $('#page-to').html(result.to);

                        allowRefresh = false;

                        var pager = '';
                        if(result.total > 0) {
                            if(result.current_page > 1 ) pager +=  '<li class="page-item"><a class="page-data page-link" href="'+result.prev_page_url+'">Previous</a></li>';
                            if(result.current_page){
                                for(var i=1; i<= result.last_page; i++){
                                    if(result.current_page == i) {
                                        pager +=  '<li class="page-item active"><a  href="'+APP_URL+'/search/result?page='+i+'" class="page-data page-link">'+i+'</a></li>';
                                    } else {
                                        pager +=  '<li class="page-item"><a  href="'+APP_URL+'/search/result?page='+i+'" class="page-data page-link">'+i+'</a></li>';

                                    }
                                }
                            }
                    
                            if(result.next_page_url) pager +=  '<li class="page-item"><a class="page-data page-link" href="'+result.next_page_url+'">Next</a></li>';
                            $('#pager').html(pager);
                            $('#pagination').removeClass('d-none');
                        } else {
                            $('#pagination').addClass('d-none');
                        }


                        var properties = result.data;

                        var room_point = [];
                        var room_div   = "";
                        for (var key in properties) {
                            if (properties.hasOwnProperty(key)) {
                                room_point[key] = {
                                    latitude: properties[key].property_address.latitude,
                                    longitude: properties[key].property_address.longitude,
                                    title: properties[key].name,
                                
                                    content: '<a href="'+APP_URL+'/properties/'+properties[key].slug+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest+'" class="media-cover" target="_blank">'
                                    +'<img class="map-property-img p-1" src="'+properties[key].cover_photo+'"alt="'+properties[key].name+'">'
                                    +'</a>'
                                    +'<div class="map-property-name">'
                                        +'<div class="col-xs-12 p-1">'
                                            +'<div class="location-title"><h5>'+properties[key].name+'</h5></div>'
                                        +'</div>'
                                    +'</div>'
                                };

                                var avg_rating = properties[key].avg_rating;
                                reviews_count = 0;
                                if(properties[key].reviews_count == 1) reviews_count = properties[key].reviews_count;
                                else if(properties[key].reviews_count > 0) reviews_count = properties[key].reviews_count;

                                    var moneySymbol = properties[key].property_price.currency.symbol;
                                    var price       = properties[key].property_price.price;
                                    var symbolWithPrice = moneyFormat(moneySymbol, price);

                                    var colDiv ='col-md-6 col-lg-4 p-2';
                                    var divCol = $('#listCol').hasClass('col-md-7');
                                    if (divCol == false) {
                                        room_div += '<div class="col-md-6 col-lg-3 p-2 pl-4 pr-4 mt-4">'
                                                    +'<div class="card h-100">'
                                                        +'<div class="grid">'
                                                            +'<a href="'+APP_URL+'/properties/'+properties[key].slug+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest+'" target="_blank">'
                                                            +'<figure class="effect-milo">'
                                                                +'<img src="'+properties[key].cover_photo+'" class="img-fluid rounded " alt="'+properties[key].name+'"/>'
                                                                +'<figcaption>'
                                                                +'</figcaption>'     
                                                            +'</figure>'        
                                                            +'</a>'
                                                        +'</div>'
                                                        +'<div class="card-body p-0 pl-1 pr-1">'
                                                            +'<div class="d-flex">'
                                                                +'<div>'
                                                                    +'<div class="pl-2 pr-1">'
                                                                        +'<a href="'+APP_URL+'/users/show/'+properties[key].host_id+'"><img src="'+properties[key].users.profile_src+'" class="img-60x60 rounded-circle" alt="profile-image"></a>'
                                                                    +'</div>'
                                                                +'</div>'

                                                                +'<div class="p-2 text">'
                                                                    +'<a class="text-color text-color-hover" href="'+APP_URL+'/properties/'+properties[key].slug+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest+'" target="_blank">'
                                                                        +'<h4 class="text-16 font-weight-700 text">' +properties[key].name+'</h4>'
                                                                    +'</a>'
                                                                    +'<p class="text-13 mt-2 mb-0 text"><i class="fas fa-map-marker-alt"></i> '+ properties[key].property_address.address_line_1+'</p>'
                                                                +'</div>'
                                                            +'</div>'
                                                            
                                                            +'<div class="review-0 p-3">'
                                                                +'<div class="d-flex justify-content-between">'
                                                                    +'<div>'
                                                                        +'<span><i class="fa fa-star text-14 secondary-text-color"></i>'+' '+ avg_rating
                                                                            +' '+ '('+reviews_count+')</span>'
                                                                    +'</div>'
                                                                
                                                                    +'<div>'
                                                                        +'<span class="font-weight-700 text-18">'+symbolWithPrice+'</span> / night'
                                                                    +'</div>'
                                                                +'</div>'
                                                            +'</div>'

                                                            +'<div class="card-footer text-muted p-0 border-0">'
                                                                +'<div class="d-flex bg-white justify-content-between pl-2 pr-2 pt-2 mb-3">'
                                                                    +'<div>'
                                                                    +'<ul class="list-inline">'
                                                                        +'<li class="list-inline-item  pl-4 pr-4 border rounded-3 mt-1 bg-light text-dark">'
                                                                            +'<div class="vtooltip"> <i class="fas fa-user-friends"></i> '+properties[key].accommodates +''
                                                                            +'<span class="vtooltiptext text-14">'+properties[key].accommodates +' Guests</span>'
                                                                        +'</div>'
                                                                    +'</li>'

                                                                        +'<li class="list-inline-item pl-4 pr-4 border rounded-3 mt-1 bg-light">'
                                                                        +'<div class="vtooltip"> <i class="fas fa-bed"></i> '+properties[key].bedrooms+''
                                                                            +'<span class="vtooltiptext  text-14">' +properties[key].bedrooms+' Bedrooms</span>'
                                                                        +'</div>'
                                                                        +'</li>'

                                                                        +'<li class="list-inline-item pl-4 pr-4 border rounded-3 mt-1 bg-light">'
                                                                        +'<div class="vtooltip"> <i class="fas fa-bath"></i> '+' '+properties[key].bathrooms+''
                                                                            +'<span class="vtooltiptext  text-14 p-2">'+properties[key].bathrooms+' Bathrooms</span>'
                                                                        +'</div>'
                                                                        +'</li>'
                                                                    +'</ul>'
                                                                    +'</div>'
                                                                +'</div>'
                                                            +'</div>'
                                                        +'</div>'
                                                        +'</div>'
                                                    +'</div>';
                                    } else{
                                        room_div +='<div class="col-sm-6 col-md-12 col-lg-12  p-0 mb-4">'
                                                    +'<div class=" row  border p-2 rounded-3">'
                                                        +'<div class="col-lg-5 p-2">'
                                                            +'<div class="img-event">'
                                                                +'<a href="'+APP_URL+'/properties/'+properties[key].slug+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest+'" target="_blank">'
                                                                    +'<img class="img-fluid rounded" src="'+properties[key].cover_photo+'" alt="'+properties[key].name+'">'
                                                                +'</a>' 
                                                            +'</div>'
                                                        +'</div>'

                                                        +'<div class="col-lg-7 p-2">'
                                                            +'<div class="row justify-content-between">'
                                                                +'<div class="col-sm-12 pl-0">'
                                                                    +'<a href="'+APP_URL+'/properties/'+properties[key].slug+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest+'" target="_blank">'
                                                                        +'<p class="mb-0 text-18 text-color font-weight-700 text-color-hover text">' +properties[key].name+'</p>'     
                                                                    +'</a>'
                                                                +'</div>'
                                                            +'</div>'

                                                            +'<div class="review-0 mt-4">'
                                                                +'<div class="d-flex justify-content-between">'
                                                                    +'<div>'
                                                                        +'<span><i class="fa fa-star text-14 secondary-text-color"></i>'+' '+ avg_rating
                                                                            +' '+ '('+reviews_count+')</span>'
                                                                    +'</div>'
                                                                
                                                                    +'<div>'
                                                                        +'<span class="font-weight-700 text-20">'+symbolWithPrice+'</span> / night'
                                                                    +'</div>'
                                                                +'</div>'
                                                            +'</div>'

                                                            +'<ul class="list-inline mt-2 pb-3">'
                                                                +'<li class="list-inline-item border rounded-3 p-1 mt-4 pl-3 pr-3">'
                                                                    +'<p class="text-center mb-0">'
                                                                        +'<i class="fas fa-bed text-20 d-none d-sm-inline-block text-muted"></i> '
                                                                        +properties[key].accommodates
                                                                        +'<span class=" text-14 font-weight-700"> Guest</span>' 
                                                                    +'</p>'
                                                                +'</li>'
                                                                +'<li class="list-inline-item  border rounded-3 mt-4 p-1  pl-3 pr-3">'
                                                                    +'<p  class="text-center mb-0" >'
                                                                        +'<i class="fas fa-user-friends d-none d-sm-inline-block text-20 text-muted"></i> '
                                                                        +properties[key].bedrooms
                                                                        +'<span class=" text-14 font-weight-700"> Bedrooms</span>' 
                                                                    +'</p>'
                                                                +'</li>'
                                                                +'<li class="list-inline-item  border rounded-3 mt-4 p-1  pl-3 pr-3">'
                                                                    +'<p  class="text-center mb-0">'
                                                                        +'<i class="fas fa-bath text-20  d-none d-sm-inline-block  text-muted"></i> '
                                                                        +properties[key].bathrooms
                                                                        +'<span class="text-14 font-weight-700"> Bathrooms</span>' 
                                                                    +'</p>'
                                                                +'</li>'
                                                            +'</ul>'
                                                        +'</div>'
                                                    +'</div>'
                                                +'</div>'
                                    }
                                }
                            }

                            if(room_div != '') $('#properties_show').html(room_div);
                            else $('#properties_show').html(' <div class="text-center justify-content-center w-100 position-center"><img src="http://dev.dint.test/img/not-found.png" class="img-fluid not-found" alt="not-found"><h4 class="text-center text-20 font-weight-700">No Results Found</h4></div>');

                            //deleteMarkers();
                            addMarker(map, room_point);
                        },
                        error: function (request, error) {
                            allowRefresh = false;
                            // This callback function will trigger on unsuccessful action
                            console.log(error);
                        },
                        complete: function(){
                            hide_loader();
                        }
                });
            }

            }

        
        }

        $('#btnBook, #btnRoom, #btnPrice, .filter-apply').on('click', function(){
            allowRefresh = true;
            deleteMarkers();
            loadPage = '{{url("search/result")}}';
            getProperties($('#map_view').locationpicker('map').map);
            $('.room_filter').addClass('display-off');
            $('#more_filters').show();
            $('.dropdown-menu-price').removeClass('show');
        });
            

        function getCheckedValueArray(field_name){
            var array_Value = '';
            array_Value = $('input[name="' + field_name + '[]"]:checked').map(function() {
                return this.value;
            })
                .get()
                .join(',');

            return array_Value;
        }

        
        $(document.body).on('click','#map_view',function(){
            allowRefresh = true;
            loadPage = '{{url("search/result")}}';
            getProperties($('#map_view').locationpicker('map').map);
        });

        $('#map_view').locationpicker({
            location: {
                latitude: 25.7616798,
                longitude: -80.1917902
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

        function show_loader(){
            $('#loader').removeClass('display-off');
            $('#pagination').hide();
        }

        function hide_loader(){
            $('#loader').addClass('display-off');
            $('#pagination').show();
        }

        // Map Close
        $('#closeMap').on('click', function(){
            $('#listCol').removeClass('col-md-7');
            $('#listCol').addClass('col-md-12');
            $('#mapCol').addClass('d-none');
            $('#showMap').removeClass('d-none');

            allowRefresh = true;
            loadPage = '{{url("search/result")}}';
            getProperties($('#map_view').locationpicker('map').map);
            
        });
        // Map show
        $('#showMap').on('click', function(){
            $('#listCol').removeClass('col-md-12');
            $('#listCol').addClass('col-md-7');
            $('#mapCol').removeClass('d-none');
            $('#showMap').addClass('d-none');
            allowRefresh = true;
            loadPage = '{{url("search/result")}}';
            getProperties($('#map_view').locationpicker('map').map);
        });

        $( window ).on( "load", function() {
                allowRefresh = true;
                loadPage = '{{url("search/result")}}';
                getProperties($('#map_view').locationpicker('map').map);
        });
    </script>
@endif

@endpush
@endsection