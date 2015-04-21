// Unique number for each 'via' block
var tripViaCounter;

$(document).ready(function() {

    datePicker();

    // Repeating trip / Is empty car options
    $(window).on('load', hideMask2("#rep-trip-yes","#rep-trip-no"), hideMask2("#car-empty-no","#car-empty-yes"));

    $(".radio[name='Trip[is_repeated_flag]']").click(function() {
        hideMask2("#rep-trip-yes","#rep-trip-no");
    });
    $(".radio[name='Trip[is_empty_car_flag]']").click(function() {
        hideMask2("#car-empty-no","#car-empty-yes");
    });

    // If there are no 'via' blocks
    if ($('.transit-via-box').length == 0) {
        tripViaCounter = 100;
    } else {
        tripViaCounter = $('.transit-via-box:last').data('counter');
    }
    /**
     * Add new Via block
     */
    $('.add-via-block').click(function() {
        // Send request for 'Via' html form
        $.get('/action/register-trip/via-block/' + (++tripViaCounter), function(data) {
            $('.via-block-container').append(data);
            // Show datepicker
            datePicker();
//            showTripOnMap();
        })
         return false;
     })
    /**
     * Attach 'click' even to make possible to remove particular 'via' block
     */
    $('.via-block-container').on('click', '.transit-via-box .del-via-block', function(event) {
        event.preventDefault();
        $(this).parent().remove();
        showTripOnMap();
    })
    // Send request to geocoder when country or zip of 'via' block were changed
    $('.via-block-container').on('change', '.country-via, .zip-via', getCityByZipCountryViaBlock)
    // Update route if city-via has been updated
    $('.via-block-container').on('change', '.city-via', showTripOnMap)

    // Getting city name by selecting country and zip code(select, zip)
    $('#country-from, #zip-from').change(function() {
        getCityByZipCountry($('#country-from'), $('#zip-from'), $('#city-from'));
    })
    $('#country-to, #zip-to').change(function() {
        getCityByZipCountry($('#country-to'), $('#zip-to'), $('#city-to'));
    })
    // Update route on map if city have been changed
    $('#city-from, #city-to').change(function() {
        showTripOnMap();
    })

    // Info block for 'i' icon
    initInfoPopupBlock();

    // Get data from order select. When user selects an order refresh page with order id in url
    $('#order_id').on('change', function(event) {
        var url = '', orderId = $(this).val();
        if (orderId == '') {
            url = '/action/register-trip';
        } else if (orderId > 0) {
            url = '/action/register-trip/order/' + orderId;
        }
        location.href = url;
        return true;
    })
});

function getCityByZipCountry(countrySelectObj, zipInputObj, cityInputObj) {
    var selectedCountry = countrySelectObj.find('option:selected').text();
    var zipCode = zipInputObj.val();
    if (!countrySelectObj || !zipInputObj) return false;

    // get app language
    var lang = utils.getAppLang();
    var geoResp = mGoogleApi.geocode(zipCode + ',' + selectedCountry, lang, function(resp) {
//        console.log(resp);
        cityInputObj.val(resp);
        showTripOnMap();
    });
}
/**
 * Get data(country, city) for each 'via' block
 * @param event
 * @returns {boolean}
 */
function getCityByZipCountryViaBlock(event) {
    var country, zip, cityInputObj, parentBlock;
    // Current Via block holder
    parentBlock = $(this).closest('.transit-via-box');
    country = parentBlock.find('.country-via').find('option:selected').text();
    zip = parentBlock.find('.zip-via').val();
    cityInputObj = parentBlock.find('.city-via');
    if (!country || !zip) return false;

//    mGoogleApi.geocode(zipInputObj.val() + ',' + countrySelectObj.find('option:selected').text(), utils.getAppLang(), function(resp) {
    mGoogleApi.geocode(zip + ',' + country, utils.getAppLang(), function(resp) {
        cityInputObj.val(resp);
        showTripOnMap();
    });
}
/**
 * Get 'via' points data (country, city) to show it on map
 * @returns {Array}
 */
function getViaPoints() {
    var points = [];
    // List of Via blocks
    var viaList = $('.transit-via-box');
    var viaCountry, viaCity;
    if (viaList.length) {
        viaList.each(function() {
            viaCountry = $(this).find('.country-via option:selected').text();
            viaCity = $(this).find('.city-via').val();
            if (viaCountry && viaCity) {
                points.push({
                    'country': viaCountry,
                    'city': viaCity
                });
            }
        })
    }
    return points;
}

/**
 * Get route steps. Set of route points
 */
function getRouteSteps(resp) {
    var steps = [];
    // Get lat, lng of each route step
    $(resp.routes[0].overview_path).each(function(inddex, item) {
         steps.push({'lat' : item.lat(), 'lng' : item.lng()});
     })
    // @todo Think about not all browsers support build in JSON.stringify function
    // Convert into JSON
    steps = JSON.stringify(steps);
    return steps;
}

/**
 * Get route bounds. SouthWest and NorthEast
 * @param resp DirectionService object
 * @returns {*}
 */
function getRouteBounds(resp) {
    var bounds;
    // Route bounds
    return bounds = resp.routes[0].bounds.toUrlValue();
}

function  showTripOnMap() {
    var from_country = $('#country-from option:selected').text();
    var from_city = $('#city-from').val();

    var to_country = $('#country-to option:selected').text();
    var to_city = $('#city-to').val();

    if (!from_country || !from_city || !to_country || !to_city) {
        return false;
    }

    var request = {
        origin: from_country + ',' + from_city,
        destination: to_country + ',' + to_city
    };
    // Additional 'via' points on the route
    if (getViaPoints().length) {
        var wayPoints = [], viaPoints = getViaPoints();
        for (var i in viaPoints) {
            wayPoints.push({
                'location': viaPoints[i]['country'] + ', ' + viaPoints[i]['city'],
                'stopover': true
            });
        }
        request.waypoints = wayPoints;
    }
    // Callback after directions
    mGoogleApi.directionsCallback = function(resp) {
        var routeDistance = mGoogleApi.getRouteDuration(resp);
        $("#trip-distance").val(routeDistance);

        // Show route distance above map
        $('.trip-distance-holder span').text(routeDistance);

        // Save route steps to hidden form field
        $('#route-steps').val(getRouteSteps(resp));

        // Save route bounds to hidden form field
        $('#route-bounds').val(getRouteBounds(resp));
    }
    mGoogleApi.directions(request);
}

$(window).load(function() {
    // Setup callback which runs after maps api was loaded
    mGoogleApi.onLoadCallback = function() {
        showTripOnMap();
    };
    mGoogleApi.load(utils.getAppLang());
});