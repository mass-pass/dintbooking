
var markers = [];
var allowRefresh = true;
var loadPage = APP_URL + '/search/result';

$("#price-range").bootstrapSlider();

$("#price-range").on("slideStop", function (slideEvt) {
    slideEvt.preventDefault();
    slideEvt.stopPropagation();

    var range = $('#price-range').attr('data-value');
    range = range.split(',');
    var min_price = range[0];
    var max_price = range[1];
    $('#minPrice').html(min_price);
    $('#maxPrice').html(max_price);

    return false;
});

$('#header-search-form').on('change', function () {
    allowRefresh = true;
    deleteMarkers();
    loadPage = APP_URL + '/search/result';
    window.getProperties($('#map_view').locationpicker('map').map);
});

$("#search-pg-checkin").datepicker({
    dateFormat: "mm-dd-yy",
    minDate: 0,
    onSelect: function (e) {
        var t = $("#search-pg-checkin").datepicker("getDate");
        t.setDate(t.getDate() + 1), $("#search-pg-checkout").datepicker("option", "minDate", t), setTimeout(function () {
            $("#search-pg-checkout").datepicker("show")
        }, 20);
        allowRefresh = true;
        loadPage = APP_URL + '/search/result';
        window.getProperties($('#map_view').locationpicker('map').map);
    }
});

$("#search-pg-checkout").datepicker({
    dateFormat: "mm-dd-yy",
    minDate: 1,
    onClose: function () {
        var e = $("#checkin").datepicker("getDate"),
            t = $("#header-search-checkout").datepicker("getDate");
        if (e >= t) {
            var a = $("#search-pg-checkout").datepicker("option", "minDate");
            $("#search-pg-checkout").datepicker("setDate", a)
        }
    }, onSelect: function () {
        allowRefresh = true;
        loadPage = APP_URL + '/search/result';
        window.getProperties($('#map_view').locationpicker('map').map);
    }
});

$(document.body).on('click', '.page-data', function (e) {
    e.preventDefault();
    var hr = $(this).attr('href');
    loadPage = hr;
    allowRefresh = true;
    window.getProperties($('#map_view').locationpicker('map').map, hr);
});

window.addMarker = function (map, features) {

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

// Sets the map on all markers in the array.
window.setMapOnAll = function (map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

// Removes the markers from the map, but keeps them in the array.
window.clearMarkers = function () {
    setMapOnAll(null);
}

// Deletes all markers in the array by removing references to them.
window.deleteMarkers = function () {
    clearMarkers();
    markers = [];
}

window.moneyFormat = function (symbol, value) {
    var symbolPosition = 'before';
    if (symbolPosition == "before") {
        val = symbol + ' ' + value;
    } else {
        val = value + ' ' + symbol;
    }
    return val;
}

window.buildResult = function (map, result, req) {
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
                    pager += '<li class="page-item active"><a  href="' + APP_URL + '/search/result?page=' + i + '" class="page-data page-link">' + i + '</a></li>';
                } else {
                    pager += '<li class="page-item"><a  href="' + APP_URL + '/search/result?page=' + i + '" class="page-data page-link">' + i + '</a></li>';

                }
            }
        }

        if (result.next_page_url) pager += '<li class="page-item"><a class="page-data page-link" href="' + result.next_page_url + '">Next</a></li>';
        $('#pager').html(pager);
        $('#pagination').removeClass('d-none');
    } else {
        $('#pagination').addClass('d-none');
    }

    var properties = result.data;

    var room_point = [];
    var room_div = "";
    for (var key in properties) {
        if (properties.hasOwnProperty(key)) {
            room_point[key] = {
                latitude: properties[key].property_address.latitude,
                longitude: properties[key].property_address.longitude,
                title: properties[key].name,

                content: '<a href="' + APP_URL + '/properties/' + properties[key].slug + '?checkin=' + req.checkin + '&checkout=' + req.checkout + '&guests=' + req.guest + '" class="media-cover" target="_blank">'
                    + '<img class="map-property-img p-1" src="' + properties[key].cover_photo + '"alt="' + properties[key].name + '">'
                    + '</a>'
                    + '<div class="map-property-name">'
                    + '<div class="col-xs-12 p-1">'
                    + '<div class="location-title"><h5>' + properties[key].name + '</h5></div>'
                    + '</div>'
                    + '</div>'
            };

            var avg_rating = properties[key].avg_rating;
            reviews_count = 0;
            if (properties[key].reviews_count == 1) reviews_count = properties[key].reviews_count;
            else if (properties[key].reviews_count > 0) reviews_count = properties[key].reviews_count;

            var moneySymbol = properties[key].property_price.currency.symbol;
            var price = properties[key].property_price.price;
            var symbolWithPrice = moneyFormat(moneySymbol, price);

            var colDiv = 'col-md-6 col-lg-4 p-2';
            var divCol = $('#listCol').hasClass('col-md-7');
            if (divCol == false) {
                room_div += '<div class="col-md-6 col-lg-3 p-2 pl-4 pr-4 mt-4">'
                    + '<div class="card h-100">'
                    + '<div class="grid">'
                    + '<a href="' + APP_URL + '/properties/' + properties[key].slug + '?checkin=' + req.checkin + '&checkout=' + req.checkout + '&guests=' + req.guest + '" target="_blank">'
                    + '<figure class="effect-milo">'
                    + '<img src="' + properties[key].cover_photo + '" class="img-fluid rounded " alt="' + properties[key].name + '"/>'
                    + '<figcaption>'
                    + '</figcaption>'
                    + '</figure>'
                    + '</a>'
                    + '</div>'
                    + '<div class="card-body p-0 pl-1 pr-1">'
                    + '<div class="d-flex">'
                    + '<div>'
                    + '<div class="pl-2 pr-1">'
                    + '<a href="' + APP_URL + '/users/show/' + properties[key].host_id + '"><img src="' + properties[key].users.profile_src + '" class="img-60x60 rounded-circle" alt="profile-image"></a>'
                    + '</div>'
                    + '</div>'

                    + '<div class="p-2 text">'
                    + '<a class="text-color text-color-hover" href="' + APP_URL + '/properties/' + properties[key].slug + '?checkin=' + req.checkin + '&checkout=' + req.checkout + '&guests=' + req.guest + '" target="_blank">'
                    + '<h4 class="text-16 font-weight-700 text">' + properties[key].name + '</h4>'
                    + '</a>'
                    + '<p class="text-13 mt-2 mb-0 text"><i class="fas fa-map-marker-alt"></i> ' + properties[key].property_address.address_line_1 + '</p>'
                    + '</div>'
                    + '</div>'

                    + '<div class="review-0 p-3">'
                    + '<div class="d-flex justify-content-between">'
                    + '<div>'
                    + '<span><i class="fa fa-star text-14 secondary-text-color"></i>' + ' ' + avg_rating
                    + ' ' + '(' + reviews_count + ')</span>'
                    + '</div>'

                    + '<div>'
                    + '<span class="font-weight-700 text-18">' + symbolWithPrice + '</span> / night'
                    + '</div>'
                    + '</div>'
                    + '</div>'

                    + '<div class="card-footer text-muted p-0 border-0">'
                    + '<div class="d-flex bg-white justify-content-between pl-2 pr-2 pt-2 mb-3">'
                    + '<div>'
                    + '<ul class="list-inline">'
                    + '<li class="list-inline-item  pl-4 pr-4 border rounded-3 mt-1 bg-light text-dark">'
                    + '<div class="vtooltip"> <i class="fas fa-user-friends"></i> ' + properties[key].accommodates + ''
                    + '<span class="vtooltiptext text-14">' + properties[key].accommodates + ' Guests</span>'
                    + '</div>'
                    + '</li>'

                    + '<li class="list-inline-item pl-4 pr-4 border rounded-3 mt-1 bg-light">'
                    + '<div class="vtooltip"> <i class="fas fa-bed"></i> ' + properties[key].bedrooms + ''
                    + '<span class="vtooltiptext  text-14">' + properties[key].bedrooms + ' Bedrooms</span>'
                    + '</div>'
                    + '</li>'

                    + '<li class="list-inline-item pl-4 pr-4 border rounded-3 mt-1 bg-light">'
                    + '<div class="vtooltip"> <i class="fas fa-bath"></i> ' + ' ' + properties[key].bathrooms + ''
                    + '<span class="vtooltiptext  text-14 p-2">' + properties[key].bathrooms + ' Bathrooms</span>'
                    + '</div>'
                    + '</li>'
                    + '</ul>'
                    + '</div>'
                    + '</div>'
                    + '</div>'
                    + '</div>'
                    + '</div>'
                    + '</div>';
            } else {
                room_div += '<div class="col-sm-6 col-md-12 col-lg-12  p-0 mb-4">'
                    + '<div class=" row  border p-2 rounded-3">'
                    + '<div class="col-lg-5 p-2">'
                    + '<div class="img-event">'
                    + '<a href="' + APP_URL + '/properties/' + properties[key].slug + '?checkin=' + req.checkin + '&checkout=' + req.checkout + '&guests=' + req.guest + '" target="_blank">'
                    + '<img class="img-fluid rounded" src="' + properties[key].cover_photo + '" alt="' + properties[key].name + '">'
                    + '</a>'
                    + '</div>'
                    + '</div>'

                    + '<div class="col-lg-7 p-2">'
                    + '<div class="row justify-content-between">'
                    + '<div class="col-sm-12 pl-0">'
                    + '<a href="' + APP_URL + '/properties/' + properties[key].slug + '?checkin=' + req.checkin + '&checkout=' + req.checkout + '&guests=' + req.guest + '" target="_blank">'
                    + '<p class="mb-0 text-18 text-color font-weight-700 text-color-hover text">' + properties[key].name + '</p>'
                    + '</a>'
                    + '</div>'
                    + '</div>'

                    + '<div class="review-0 mt-4">'
                    + '<div class="d-flex justify-content-between">'
                    + '<div>'
                    + '<span><i class="fa fa-star text-14 secondary-text-color"></i>' + ' ' + avg_rating
                    + ' ' + '(' + reviews_count + ')</span>'
                    + '</div>'

                    + '<div>'
                    + '<span class="font-weight-700 text-20">' + symbolWithPrice + '</span> / night'
                    + '</div>'
                    + '</div>'
                    + '</div>'

                    + '<ul class="list-inline mt-2 pb-3">'
                    + '<li class="list-inline-item border rounded-3 p-1 mt-4 pl-3 pr-3">'
                    + '<p class="text-center mb-0">'
                    + '<i class="fas fa-bed text-20 d-none d-sm-inline-block text-muted"></i> '
                    + properties[key].accommodates
                    + '<span class=" text-14 font-weight-700"> Guest</span>'
                    + '</p>'
                    + '</li>'
                    + '<li class="list-inline-item  border rounded-3 mt-4 p-1  pl-3 pr-3">'
                    + '<p  class="text-center mb-0" >'
                    + '<i class="fas fa-user-friends d-none d-sm-inline-block text-20 text-muted"></i> '
                    + properties[key].bedrooms
                    + '<span class=" text-14 font-weight-700"> Bedrooms</span>'
                    + '</p>'
                    + '</li>'
                    + '<li class="list-inline-item  border rounded-3 mt-4 p-1  pl-3 pr-3">'
                    + '<p  class="text-center mb-0">'
                    + '<i class="fas fa-bath text-20  d-none d-sm-inline-block  text-muted"></i> '
                    + properties[key].bathrooms
                    + '<span class="text-14 font-weight-700"> Bathrooms</span>'
                    + '</p>'
                    + '</li>'
                    + '</ul>'
                    + '</div>'
                    + '</div>'
                    + '</div>'
            }
        }
    }

    if (room_div != '') $('#properties_show').html(room_div);
    else $('#properties_show').html(' <div class="text-center justify-content-center w-100 position-center"><img src="http://dev.dint.test/img/not-found.png" class="img-fluid not-found" alt="not-found"><h4 class="text-center text-20 font-weight-700">No Results Found</h4></div>');

    //deleteMarkers();
    window.addMarker(map, room_point);
}

window.getProperties = function (map, url) {

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

        var range = $('#price-range').attr('data-value');

        if (range != '') {
            range = range.split(',');
        } else {
            range = [0, 1000];
        }

        var map_details = a + "~" + t + "~" + o + "~" + i + "~" + s + "~" + r + "~" + l + "~" + n;
        var location = $('#location').val();
        var city = $('#location_city').val();

        //Input Search value set
        $('#header-search-form').val(location);
        //Input Search value set
        var min_price = range[0];
        var max_price = range[1];
        $('#minPrice').html(min_price);
        $('#maxPrice').html(max_price);

        var amenities = getCheckedValueArray('amenities');
        var property_type = getCheckedValueArray('property_type');
        var book_type = getCheckedValueArray('book_type');
        var space_type = getCheckedValueArray('space_type');
        var beds = $('#map-search-min-beds').val();
        var bathrooms = $('#map-search-min-bathrooms').val();
        var bedrooms = $('#map-search-min-bedrooms').val();
        var checkin = $('#startDate').val();
        var checkout = $('#endDate').val();
        var guest = $('#front-search-guests').val();
        //var map_details = map_details;
        var dataURL = loadPage;
        // if(url != '') dataURL = url;

        if ($('#more_filters').css('display') != 'none') {

            let req = {
                'location': location,
                'city': city,
                'min_price': min_price,
                'max_price': max_price,
                'amenities': amenities,
                'property_type': property_type,
                'book_type': book_type,
                'space_type': space_type,
                'beds': beds,
                'bathrooms': bathrooms,
                'bedrooms': bedrooms,
                'checkin': checkin,
                'checkout': checkout,
                'guest': guest,
                'map_details': map_details
            };

            $('#properties_show').html("");
            window.show_loader();

            axios.post(dataURL, req).then(function (resp) {
                window.buildResult(map, resp.data, req);
                window.hide_loader();
            }).catch(function (err) {
                window.hide_loader();
                allowRefresh = false;
                alert('Error while loading search result');
                // This callback function will trigger on unsuccessful action
                console.log(err);
            })

            /*
            $.ajax({
                url: dataURL,
                data: req,
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                    $('#properties_show').html("");
                    show_loader();
                },
                success: function (result) {

                },
                error: function (request, error) {
                    allowRefresh = false;
                    // This callback function will trigger on unsuccessful action
                    console.log(error);
                },
                complete: function () {
                    window.hide_loader();
                }
            });
            */
        }
    }
}

$('#btnBook, #btnRoom, #btnPrice, .filter-apply').on('click', function () {
    allowRefresh = true;
    deleteMarkers();
    loadPage = APP_URL + '/search/result';
    window.getProperties($('#map_view').locationpicker('map').map);
    $('.room_filter').addClass('display-off');
    $('#more_filters').show();
    $('.dropdown-menu-price').removeClass('show');
});

window.getCheckedValueArray = function (field_name) {
    var array_Value = '';
    array_Value = $('input[name="' + field_name + '[]"]:checked').map(function () {
        return this.value;
    })
        .get()
        .join(',');

    return array_Value;
}

$(document.body).on('click', '#map_view', function () {
    allowRefresh = true;
    loadPage = APP_URL + '/search/result';
    window.getProperties($('#map_view').locationpicker('map').map);
});

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

$('#map_view').locationpicker({
    location: {
        latitude: $('#location_lat').val(),
        longitude: $('#location_lng').val()
    },
    types: ['(cities)'],
    radius: 0,
    zoom: 12,
    addressFormat: "",
    markerVisible: false,
    markerInCenter: true,
    inputBinding: {
        latitudeInput: $('#location_lat'),
        longitudeInput: $('#location_lng')
        //locationNameInput: $('#front-search-field')
    },
    enableAutocomplete: true,
    draggable: true,
    onclick: function (currentLocation, radius, isMarkerDropped) {
        if (allowRefresh == true) {
            window.getProperties($(this).locationpicker('map').map);
        }
    },

    onchanged: function (currentLocation, radius, isMarkerDropped) {
        var addressComponents = $(this).locationpicker('map').location.addressComponents;
        addressUpdated(addressComponents);
    },
    oninitialized: function (component) {
        var addressComponents = $(component).locationpicker('map').location.addressComponents;
        addressUpdated(addressComponents);
    }
});

$('.slider-selection').trigger('click');

window.show_loader = function () {
    $('#loader').removeClass('display-off');
    $('#pagination').hide();
}

window.hide_loader = function () {
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
    loadPage = APP_URL + '/search/result';
    window.getProperties($('#map_view').locationpicker('map').map);

});
// Map show
$('#showMap').on('click', function () {
    $('#listCol').removeClass('col-md-12');
    $('#listCol').addClass('col-md-7');
    $('#mapCol').removeClass('d-none');
    $('#showMap').addClass('d-none');
    allowRefresh = true;
    loadPage = APP_URL + '/search/result';
    window.getProperties($('#map_view').locationpicker('map').map);
});

$(function () {
    if (document.getElementById('daterange-btn')) {
        let checkin = $('#startDate').val();
        let checkout = $('#endDate').val();

        window.dateRangeBtn(checkin, checkout);
    }

    $('.dropdown-menu.filter-dropdown-menu').on('click', function(event){
        // The event won't be propagated up to the document NODE and 
        // therefore delegated events won't be fired
        event.stopPropagation();
    });
});

$.fn.slider = null;

$(window).on("load", function () {
    allowRefresh = true;
    loadPage = APP_URL + '/search/result';
    window.getProperties($('#map_view').locationpicker('map').map);
});