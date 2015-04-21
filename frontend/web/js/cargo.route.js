$(function() {
    /*function getCityByZipCountry(countryObj, zipObj, cityObj) {
        var selectedCountry = countryObj.find('option:selected').text();
        var zipCode = zipObj.val();
        if (!selectedCountry || !zipCode) return false;

        // get app language
        var lang = utils.getAppLang();
//        geocoder.geocode({'address': zipCode + ',' + selectedCountry, 'language' : lang}, function(results, status) {
        mGoogleApi.geocode(zipCode + ',' + selectedCountry, utils.getAppLang(), function(results, status) {
            //console.log(results)
            *//*if (status == 'OK' && results.length > 0) {
                if (results[0].address_components && results[0].address_components[1] && results[0].address_components[1].long_name)
                    cityObj.val(results[0].address_components[1].long_name);

                showTripOnMap();
            } else {
                cityObj.val('');
            }*//*
        })
    }
*/
})

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

            resetPricesBlock();
        })
        // Google auto complete for 'Destination to' input field
        mGoogleApi.autoComplete('destination-to', function(autocomplete) {
            showCargoRoute();
            var place = autocomplete.getPlace();
            if (!place.geometry) return;
            $('#to-lat').val(place.geometry.location.lat());
            $('#to-lng').val(place.geometry.location.lng());
            $('#to-zip').val(getZipFromPlace(place));

            resetPricesBlock();
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
        var routeDistance = mGoogleApi.getRouteDuration(resp);
        $("#route-distance").val(routeDistance);
        // Show route distance above map
        $('.route-distance-holder span').text(routeDistance);
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
    $('.transit-via-block .transit-via-input').each(function(index, elem) {
        mGoogleApi.autoComplete($(elem).attr('id'), viaAutoCompleteFunction);
    })
}
