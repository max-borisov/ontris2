$(function() {
    // Update the map if user has changed data in 'From' or 'To' fields
    /*$('#destination-from, #destination-to').blur(function() {
        if ($('#destination-from').val() == '' || $('#destination-to').val() == '') return false;
        showCargoRoute();
        return true;
    })*/
    // Update the map if user has changed data in 'From' or 'To' fields
   /* $('#destination-from, #destination-to, .transit-via-input').change(function() {
        if ($('#destination-from').val() == '' || $('#destination-to').val() == '') return false;

        alert(11)
        showCargoRoute();
        alert(12)
        getPrices();

        return true;
    })*/


    // Autocomplete for map fields
//    $( "#destination-from, #destination-to" ).autocomplete(autoCompleteObj);


    // Getting city name by selecting country and zip code(select, zip)
    /*$('#fra-post, #fra-land').change(function() {
        getCityByZipCountry($('#fra-land'), $('#fra-post'), $('#fra-city'));
    })
    $('#til-post, #til-land').change(function() {
        getCityByZipCountry($('#til-land'), $('#til-post'), $('#til-city'));
    })*/
    /*$('#post-til, #land-til').change(function() {
        getCityByZipCountry($('#land-til'), $('#post-til'), $('#city-til'));
    })
    // Display route on map
    $('#land-fra, #city-fra, #land-til, #city-til').change(function() {
        showTripOnMap();
    })*/

    function getCityByZipCountry(countryObj, zipObj, cityObj) {
        var selectedCountry = countryObj.find('option:selected').text();
        var zipCode = zipObj.val();
        if (!selectedCountry || !zipCode) return false;

        // get app language
        var lang = utils.getAppLang();
//        geocoder.geocode({'address': zipCode + ',' + selectedCountry, 'language' : lang}, function(results, status) {
        mGoogleApi.geocode(zipCode + ',' + selectedCountry, utils.getAppLang(), function(results, status) {
            //console.log(results)
            /*if (status == 'OK' && results.length > 0) {
                if (results[0].address_components && results[0].address_components[1] && results[0].address_components[1].long_name)
                    cityObj.val(results[0].address_components[1].long_name);

                showTripOnMap();
            } else {
                cityObj.val('');
            }*/
        })
    }

})

/*var autoCompleteObj = {
    source: function( request, response ) {
        mGoogleApi.geocoder.geocode({ 'address': request.term}, function(data, status) {
            response( $.map( data, function( item ) {
                return {
                    label: item.formatted_address,
                    value: item.formatted_address
                }
            }))
        })
    },
    delay: 1000,
    minLength: 2,
    select: function( event, ui ) {
        // After an item was selected put it's value to the input's value
        $(this).attr('value', ui.item.value)
        setTimeout(function() {
            showCargoRoute();

            getPrices(true);

        }, 500);
    },
    open: function() {
        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
//        alert('open');
    },
    close: function(event, ui) {
        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
    }
}*/

$(window).load(function() {
    // Setup callback which runs after maps api was loaded
    mGoogleApi.onLoadCallback = function() {
        showCargoRoute();

        // Google auto complete for 'Destination from' input field
        mGoogleApi.autoComplete('destination-from', function(autocomplete) {
            showCargoRoute();
            var place = autocomplete.getPlace();
            if (!place.geometry) return;
            $('#from-lat').val(place.geometry.location.lat());
            $('#from-lng').val(place.geometry.location.lng());
            $('#from-zip').val(getZipFromPlace(place));
        })
        // Google auto complete for 'Destination to' input field
        mGoogleApi.autoComplete('destination-to', function(autocomplete) {
            showCargoRoute();
            var place = autocomplete.getPlace();
            if (!place.geometry) return;
            $('#to-lat').val(place.geometry.location.lat());
            $('#to-lng').val(place.geometry.location.lng());
            $('#to-zip').val(getZipFromPlace(place));
        })

        // Attach autocomplete event for each ViaPoint
        $('.transit-via-block .transit-via-input').each(function(index, elem) {
            mGoogleApi.autoComplete($(elem).attr('id'), viaAutoCompleteFunction);
        })
    };
    mGoogleApi.load(utils.getAppLang());
});

function getZipFromPlace(place) {
    if (!place.address_components) return false;
    var addr = place.address_components;
    var zip = '';
    for (var i in addr) {
        if (addr[i].types && addr[i].types[0] == 'postal_code') {
            zip = addr[i]['short_name'];
            break;
        }
//        console.log(addr[i])
    }
    return zip;
}

function showCargoRoute() {
    var request = {
        origin: $('#destination-from').val(),
        destination: $('#destination-to').val(),
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };

    // Additional 'via' points on the route
    if (getViaPoints().length) {
        var wayPoints = [], viaPoints = getViaPoints();
        for (var i in viaPoints) {
            wayPoints.push({
                'location': viaPoints[i],
                'stopover': true
            });
        }
        request.waypoints = wayPoints;
    }

    mGoogleApi.directionsCallback = function(resp) {
        $("#route-distance").val(mGoogleApi.getRouteDuration(resp));
    };
    mGoogleApi.directions(request);
}

/**
 * Get 'via' points data (country, city) to show them on map
 * @returns {Array}
 */
function getViaPoints() {
    var points = [], rootElem = $('.text-row.transit-via-block');
    // If there are 'Via' points
    if (!rootElem.is(':empty')) {
        rootElem.each(function(index, elem) {
//            points.push($(elem).find('input:first').attr('value'));
            points.push($(elem).find('input:first').val());
        })
    }
    return points;
}

function getViaPointForAutoComplete() {
//    var func = TransitViaAutoCompleteCallback(autoComplete, inputId);
//    var func = TransitViaAutoComple;
    $('.transit-via-block .transit-via-input').each(function(index, elem) {
//        mGoogleApi.autoComplete($(elem).attr('id'), TransitViaAutoCompleteCallback(autoComplete, inputId));
        mGoogleApi.autoComplete($(elem).attr('id'), viaAutoCompleteFunction);
    })
}
