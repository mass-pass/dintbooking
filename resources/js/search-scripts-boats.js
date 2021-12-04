$(document).ready(function () {
    $('input[name="boatTypesPage[]"]').change(function () {
        var boat_types = [];
        $("input[name='boatTypesPage[]']:checked").each(function () {
            boat_types.push($(this).val());
        });
        if (boat_types.length > 0) {
            $('#boatTypes').val(boat_types.join(", "));
        } else {
            $('#boatTypes').val('');
        }
    });
    var boat_types = [];
    $("input[name='boatTypesPage[]']:checked").each(function () {
        boat_types.push($(this).val());
    });
    if (boat_types.length > 0) {
        $('#boatTypes').val(boat_types.join(", "));
    } else {
        $('#boatTypes').val('');
    }


});


var markers = [];
var allowRefresh = true;
var loadPage = SearchUrl;

$("#price-range").slider();
$("#price-range").on("slideStop", function (slideEvt) {
    var range = $('#price-range').attr('data-value');
    range = range.split(',');
    var min_price = range[0];
    var max_price = range[1];
    $('#minPrice').html(min_price);
    $('#maxPrice').html(max_price);
});

$("#length-range").slider();
$("#length-range").on("slideStop", function (slideEvt) {
    var rangeLength = $('#length-range').attr('data-value');
    rangeLength = rangeLength.split(',');
    var min_length = rangeLength[0];
    var max_length = rangeLength[1];
    $('#minLength').html(min_length);
    $('#maxLength').html(max_length);
});

$("#speed-range").slider();
$("#speed-range").on("slideStop", function (slideEvt) {
    var range = $('#speed-range').attr('data-value');
    range = range.split(',');
    var min_speed = range[0];
    var max_speed = range[1];
    $('#minSpeed').html(min_speed);
    $('#maxSpeed').html(max_speed);
});

$("#manufacture-range").slider();
$("#manufacture-range").on("slideStop", function (slideEvt) {
    var range = $('#manufacture-range').attr('data-value');
    range = range.split(',');
    var min_manufacture = range[0];
    var max_manufacture = range[1];
    $('#minManufacture').html(min_manufacture);
    $('#maxManufacture').html(max_manufacture);
});

$('#header-search-form').on('change', function () {
    allowRefresh = true;
    deleteMarkers();
    loadPage = SearchUrl;
    getBoats($('#map_view').locationpicker('map').map);
});

$(document.body).on('click', '.page-data', function (e) {
    e.preventDefault();
    var hr = $(this).attr('href');
    loadPage = hr;
    allowRefresh = true;
    getBoats($('#map_view').locationpicker('map').map, hr);
});

$('#btnBoatTypes, #btnRange, .filter-apply').on('click', function () {
    allowRefresh = true;
    deleteMarkers();
    loadPage = SearchUrl;
    getBoats($('#map_view').locationpicker('map').map);
    $('.room_filter').addClass('display-off');
    $('#more_filters').show();
    $('.dropdown-menu-price').removeClass('show');
});

$(document.body).on('click', '#map_view', function () {
    allowRefresh = true;
    loadPage = SearchUrl;
    getBoats($('#map_view').locationpicker('map').map);
});

function addMarker(map, features) {
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

        google.maps.event.addListener(marker, 'click', function (e) {

            if (this.content) {
                infowindow.setContent(this.content);
                infowindow.open(map, this);
            }
        });

    }
}

function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

function clearMarkers() {
    setMapOnAll(null);
}

function deleteMarkers() {
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

var buildResult = function (map, result, req) {
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
            var symbolWithPrice = '$ ' + boats[key].price;
            var colDiv = 'col-md-6 col-lg-4 p-2';
            var divCol = $('#listCol').hasClass('col-md-7');

            boat_div += '<div class="col-sm-6 col-md-12 col-lg-12  p-0 mb-4">' +
                '<div class=" row  border p-2 rounded-3">' +
                '<div class="col-lg-5 p-2">' +
                '<div class="img-event">' +
                '<a href="' + APP_URL + '/boats/' + boats[key].slug + '?travelling_date=' + req.boat_date + '" target="_blank">' +
                '<img class="img-fluid rounded" src="' + ((boats[key].cover_photo) ? boats[key].cover_photo : '/images/no-boat-photo.jpeg') + '" alt="' + boats[key].name + '">' +
                '</a>' +
                '</div>' +
                '</div>'

                +
                '<div class="col-lg-7 p-2">' +
                '<div class="row justify-content-between">' +
                '<div class="col-sm-12 pl-0">' +
                '<a href="' + APP_URL + '/boats/' + boats[key].slug + '?travelling_date=' + req.boat_date + '" target="_blank">' +
                '<p class="mb-0 text-18 text-color font-weight-700 text-color-hover text">' + boats[key].name + '</p>' +
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
                '<span class="font-weight-700 text-20">' + symbolWithPrice + '</span> / Per Days' +
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
        $('#boats_show').html('<div class="text-center justify-content-center w-100 position-center"><img src="/img/not-found.png" class="img-fluid not-found" alt="not-found"><h4 class="text-center text-20 font-weight-700">No Records Found</h4></div>');
    }
    addMarker(map, boat_point);
}

function getBoats(map, url) {
    if (loadPage) {
        url = url || '';
        p = map;
        var a = p.getZoom(),
            t = p.getBounds();
        if (!t) {
            var map_details = a + "~" + t ;
        } else {
            var o = t.getSouthWest().lat(),
            i = t.getSouthWest().lng(),
            s = t.getNorthEast().lat(),
            r = t.getNorthEast().lng(),
            l = t.getCenter().lat(),
            n = t.getCenter().lng();

            var map_details = a + "~" + t + "~" + o + "~" + i + "~" + s + "~" + r + "~" + l + "~" + n;
        }
        
        var location = $('#location').val();
        var city = $('#city').val();
        var boat_date = $('#boat_date').val();
        var people = $('#num_of_people').val();
        var boat_types = getCheckedValueArray('boatTypesPage');
        $('#header-search-form').val(location);

        var priceRange = $('#price-range').attr('data-value');
        //priceRange = priceRange.split(',');
        if (typeof priceRange == 'array') {
            priceRange = priceRange.split(',');
        } else {
            priceRange = [0, 1000];
        }

        var min_price = priceRange[0];
        var max_price = priceRange[1];
        $('#minPrice').html(min_price);
        $('#maxPrice').html(max_price);

        var lengthRange = $('#length-range').attr('data-value');
        //lengthRange = lengthRange.split(',');
        
        if (typeof lengthRange == 'array') {
            lengthRange = lengthRange.split(',');
        } else {
            lengthRange = [0, 1000];
        }

        var min_length = lengthRange[0];
        var max_length = lengthRange[1];
        $('#minLength').html(min_length);
        $('#maxLength').html(max_length);

        var speedRange = $('#speed-range').attr('data-value');
        //speedRange = speedRange.split(',');
        
        if (typeof speedRange == 'array') {
            speedRange = speedRange.split(',');
        } else {
            speedRange = [0, 1000];
        }

        var min_speed = speedRange[0];
        var max_speed = speedRange[1];
        $('#minSpeed').html(min_speed);
        $('#maxSpeed').html(max_speed);

        var manufactureRange = $('#manufacture-range').attr('data-value');
        //manufactureRange = manufactureRange.split(',');
        if (typeof manufactureRange == 'array') {
            manufactureRange = manufactureRange.split(',');
        } else {
            manufactureRange = [0, 1000];
        }

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
        var req = {
            'location': location,
            'city': city,
            'boat_date': boat_date,
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
        };

        if ($('#more_filters').css('display') != 'none') {

            $('#boats_show').html("");
            show_loader();

            axios.post(dataURL, req).then(function (resp) {
                buildResult(map, resp.data, req);
                hide_loader();
            }).catch(function (err) {
                hide_loader();
                allowRefresh = false;
                alert('Error while loading search result');
                // This callback function will trigger on unsuccessful action
            });

            /*
            $.ajax({
                url: dataURL,
                data: req,
                type: 'post',
                dataType: 'json',
                beforeSend: function () {

                },
                success: function (result) {
                    
                },
                error: function (request, error) {
                    allowRefresh = false;
                    console.log(error);
                },
                complete: function () {
                    hide_loader();
                }
            });
            */
        }
    }
}


function getCheckedValueArray(field_name) {
    var array_Value = '';
    array_Value = $('input[name="' + field_name + '[]"]:checked').map(function () {
        return this.value;
    }).get().join(',');
    return array_Value;
}


var addressUpdated = function (addressComponents) {
    var street = addressComponents.addressLine1;
    var city = addressComponents.city;
    var state = addressComponents.postalCode;
    var country = addressComponents.country;

    $('#location_city').val(city);

    var completeAddress =
        ((street != null && street != "") ? street + " " : "") +
        ((city != null && city != "") ? city + " " : "") +
        ((state != null && state != "") ? state + " " : "") +
        ((country != null && country != "") ? country + "" : "");

    $('#location').val(completeAddress);
}

// $('#map_view').locationpicker({
//     location: {
//         latitude: $('#location_lat').val(),
//         longitude: $('#location_lng').val()
//     },
//     types: ['(cities)'],
//     radius: 0,
//     zoom: 12,
//     addressFormat: "",
//     markerVisible: false,
//     markerInCenter: true,
//     inputBinding: {
//         latitudeInput: $('#location_lat'),
//         longitudeInput: $('#location_lng')
//         //locationNameInput: $('#location')
//     },
//     enableAutocomplete: true,
//     draggable: true,
//     onclick: function (currentLocation, radius, isMarkerDropped) {
//         if (allowRefresh == true) {
//             getProperties($(this).locationpicker('map').map);
//         }
//     },

//     onchanged: function (currentLocation, radius, isMarkerDropped) {
//         var addressComponents = $(this).locationpicker('map').location.addressComponents;
//         addressUpdated(addressComponents);
//     },
//     oninitialized: function (component) {
//         var addressComponents = $(component).locationpicker('map').location.addressComponents;
//         addressUpdated(addressComponents);
//     }
// });

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
$('#closeMap').on('click', function () {
    $('#listCol').removeClass('col-md-7');
    $('#listCol').addClass('col-md-12');
    $('#mapCol').addClass('d-none');
    $('#showMap').removeClass('d-none');

    allowRefresh = true;
    loadPage = SearchUrl;
    getBoats($('#map_view').locationpicker('map').map);
});
// Map show
$('#showMap').on('click', function () {
    $('#listCol').removeClass('col-md-12');
    $('#listCol').addClass('col-md-7');
    $('#mapCol').removeClass('d-none');
    $('#showMap').addClass('d-none');
    allowRefresh = true;
    loadPage = SearchUrl;
    getBoats($('#map_view').locationpicker('map').map);
});

$(window).on("load", function () {
    // allowRefresh = true;
    // loadPage = SearchUrl;
    // getBoats($('#map_view').locationpicker('map').map);
});

$(document).on('click', '.dropdown-menu-price', function (e) {
    e.stopPropagation();
});

$.fn.slider = null;

$(function () {
    $('input[name="boat_date"]').daterangepicker({
        singleDatePicker: true
    });
});


var searchBoat = new Vue({
    el: '#search_boat_controller',

    data: {
        searchParam : {
            address : {
                city: '',
                latitude: '',
                longitude: ''
            }   
        }
    },
    
    mounted: function mounted() {
        this.initMap();
        // allowRefresh = true;
        // loadPage = SearchUrl;
        // getBoats($('#map_view').locationpicker('map').map);
    },

    methods: {
        initMap: function() {
            $('#map_view').locationpicker({
                location: {
                    latitude: $('#location_lat').val(),
                    longitude: $('#location_lng').val()
                },
                locationName: "",
                radius: 0,
                zoom: 15,
                // mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [],
                mapOptions: {},
                scrollwheel: true,
                inputBinding: {
                    latitudeInput: $('#location_lat'),
                    longitudeInput: $('#location_lng'),
                    locationNameInput: $('#location')
                },
                enableAutocomplete: true,
                enableAutocompleteBlur: false,
                autocompleteOptions: {
                    
                },
                addressFormat: '',
                // addressFormat: 'administrative_area_level_2',
                enableReverseGeocode: true,
                draggable: true,
                onchanged: function(currentLocation, radius, isMarkerDropped) {
                    var mapContext = $(this).locationpicker('map');
                    $('#location').val(mapContext.location.addressComponents.city);
                },
                onlocationnotfound: function(locationName) {},
                oninitialized: function (component) {},
                // must be undefined to use the default gMaps marker
                markerIcon: undefined,
                markerDraggable: true,
                markerVisible : false,
                draggable: true,
            });

            allowRefresh = true;
            loadPage = SearchUrl;
            getBoats($('#map_view').locationpicker('map').map);
        },
        searchBoats: function searchRoom() {
            $(".dint_collapse").removeClass("collapsed");
            $(".main-collapse").removeClass("collapsed");
            $(".collapse-all").removeClass("collapsed");
            this.is_searched_room.id = this.is_searched_room.value;
            return false;
        },

    }

});