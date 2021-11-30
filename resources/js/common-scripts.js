require('./common-functions');

$(document).ready(function () {
    var autocompleteBoats = null;

    $("#front-search-field").on("focus", function () {
        var options = {
            types: ['(cities)']
        };
        autocomplete = new google.maps.places.Autocomplete(document.getElementById("front-search-field"), options);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            if(typeof place.name == 'string'){
                $('#stayCity').val(place.name)
            }
        });
    });

    $("#boat-location").on("focus", function () {
        var options = {
            types: ['(cities)']
        };
        autocomplete = new google.maps.places.Autocomplete(document.getElementById("boat-location"), options);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            if(typeof place.name == 'string'){
                $('#boatCity').val(place.name)
            }
        });
    });

    if (document.getElementById('boat_date')) {
        let customFormat = customDaterangeFormat();
        $('#boat_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        }, function (start, end, label) {
            let boatDate = moment(start, customFormat.showDateFormat).format(customFormat.dateSep);
            $("#boat_date").val(boatDate);
        });
    }

    if (document.getElementById('daterange-btn')) {
        window.dateRangeBtn(moment(), moment(), 2);
    }

    $(".dropdown-btn").on('click', function () {
        $(".stay-adult-sec").toggleClass("show");
    });

    $(".boat-type-sec-btn").on('click', function () {
        $(".boat-type-sec").toggleClass("show");
    });

    $('.datepicker').datepicker();

    $(".currency_footer").on('click', function (e) {
        e.preventDefault();

        var currency = $(this).data('curr');

        axios.post(APP_URL + "/set_session", {
            'currency': currency
        }).then(function (resp) {
            location.reload()
        }).catch(function (err) {
            alert('Error while changing language. Please try later.')
        })

        return false;
    });

    $(".language_footer").on('click', function (e) {
        e.preventDefault();

        var language = $(this).data('lang');

        axios.post(APP_URL + "/set_session", {
            'language': language
        }).then(function (resp) {
            location.reload()
        }).catch(function (err) {
            alert('Error while changing language. Please try later.')
        })

        return false;
    });
});