function updateControls(addressComponents) {
    $('#street_number').val(addressComponents.streetNumber);
    $('#route').val(addressComponents.streetName);
    $('#city').val(addressComponents.city);
    $('#state').val(addressComponents.stateOrProvince);
    $('#postal_code').val(addressComponents.postalCode);
    $('#country').val(addressComponents.country);

    if (typeof(addressComponents.city)!== 'undefined') {
        $('#city').val(addressComponents.city);
    } else {
            $('#city').val(addressComponents.stateOrProvince); 
    }
    
    $('#state').val(addressComponents.stateOrProvince);
    $('#postal_code').val(addressComponents.postalCode);
    $('#country').val(addressComponents.country);
    if ( typeof(addressComponents.city) !== 'undefined' && addressComponents.country !== 'undefined' && typeof(addressComponents.city) !== null && addressComponents.country !== null && typeof(addressComponents.city) !== '' && addressComponents.country !== '') {
        $('#map_address').val(addressComponents.city + ',' + addressComponents.country_fullname);
    } else {
        if (addressComponents.stateOrProvince != '' && addressComponents.country_fullname != '') {
            $('#map_address').val(addressComponents.stateOrProvince + ',' + addressComponents.country_fullname);
        }
    }
}

$('#us3').locationpicker({
    location: {
        latitude: 0,
        longitude: 0
    },
    radius: 0,
    addressFormat: "",
    inputBinding: {
        latitudeInput: $('#latitude'),
        longitudeInput: $('#longitude'),
        locationNameInput: $('#map_address')
    },
    enableAutocomplete: true,
    onchanged: function (currentLocation, radius, isMarkerDropped) {
        var addressComponents = $(this).locationpicker('map').location.addressComponents;
        updateControls(addressComponents);
    },
    oninitialized: function (component) {
        var addressComponents = $(component).locationpicker('map').location.addressComponents;
        updateControls(addressComponents);
    }
});
