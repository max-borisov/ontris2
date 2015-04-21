$(function() {
    // Show info box on hover
    popupInfoWindow();
})
$(window).load(function() {
    // Setup callback which runs after maps api was loaded
    mGoogleApi.onLoadCallback = function() {
        showTripOnMap();
    };
    mGoogleApi.load(utils.getAppLang());
});

// Show route on map
function  showTripOnMap() {
    // Route data: dst from, dst to, via points
    if (!window.routeData) return false;
    var routeData = jQuery.parseJSON(window.routeData);
    if (!routeData.from || !routeData.to) return false;

    var request = {
        origin: routeData.from.country + ',' + routeData.from.city,
        destination: routeData.to.country + ',' + routeData.to.city
    };

    // Via points
    var viaPoints = [];
    if (viaPoints = routeData.via) {
        var wayPoints = [];
        for (var i in viaPoints) {
            wayPoints.push({
                'location': viaPoints[i]['country'] + ', ' + viaPoints[i]['city'],
                'stopover': true
            });
        }
        request.waypoints = wayPoints;
    }
    mGoogleApi.directions(request);
}