$(window).load(function() {
    // Setup callback which runs after maps api was loaded
    mGoogleApi.onLoadCallback = function() {

        var request = {
            origin: 'Denmark, Esbjerg',
            destination: 'Denmark, Copenhagen'
        };


        request.waypoints = [
            {location: 'Denmark, Odense', 'stopover': true}
        ]

        mGoogleApi.directions(request);

        console.log(mGoogleApi.map);

//        mGoogleApi.map

        /*var flightPlanCoordinates = [
            new google.maps.LatLng(37.772323, -122.214897),
            new google.maps.LatLng(21.291982, -157.821856),
            new google.maps.LatLng(-18.142599, 178.431),
            new google.maps.LatLng(-27.46758, 153.027892)
        ];*/

        /*55.675850000000004
        55.298370000000006

         55.675850000000004, 12.567960000000001
         55.298370000000006, 8.45923

        8.45923
        12.567960000000001*/

        var flightPlanCoordinates = [

//            new google.maps.LatLng(8.45923, 12.567960000000001),
//            new google.maps.LatLng(55.675850000000004, 55.298370000000006),

//            new google.maps.LatLng(55.675850000000004, 12.567960000000001),
            new google.maps.LatLng(55.47637, 8.45923),


//            new google.maps.LatLng(55.298370000000006, 8.45923)
            new google.maps.LatLng(55.675850000000004, 12.567960000000001)
        ];
//        flightPlanCoordinates = 'e`miGhmocNgBf@cBb@KBkGnB';
        var flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

//        flightPath.setMap(mGoogleApi.map);

    };
    mGoogleApi.loadLight(utils.getAppLang());
});