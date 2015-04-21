utils = {
    /**
     * Get app language
     * @returns {string}
     */
    getAppLang : function() {
        var lang = 'en';
        if (location.href.search(/da\./) != -1) {
            lang = 'da';
        } else if (location.href.search(/de\./) != -1) {
            lang = 'de';
        }
        return lang;
    },

    googleApiLoader: function(lang, callback) {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyDuDlKGN10RJycYdys1MwfmWM1i7saoLfg&sensor=false&language="+lang+'&callback='+callback;
        document.body.appendChild(script);
    }
};

mGoogleApi = {
    geocoder: null,
    directionsDisplay: null,
    directionsService: null,
    map: null,
    onLoadCallback: function(){},

    load: function(lang) {

        // @todo Temporary solution. Think about other languages.
        // Problem: Countries in other languages cannot be found id database
        lang = 'en';

        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyDuDlKGN10RJycYdys1MwfmWM1i7saoLfg&sensor=false&libraries=places&language="+lang+'&callback=mGoogleApi._loaderCallback';
        document.body.appendChild(script);
    },
    loadLight: function(lang) {

        // @todo Temporary solution. Think about other languages.
        lang = 'en';

        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyDuDlKGN10RJycYdys1MwfmWM1i7saoLfg&sensor=false&language="+lang+'&callback=mGoogleApi._loaderCallbackLight';
        document.body.appendChild(script);
    },
    _loaderCallbackLight: function() {
        this.geocoder = new google.maps.Geocoder();
        this.onLoadCallback();
    },
    _loaderCallback: function() {
        this.geocoder = new google.maps.Geocoder();
        this.directionsDisplay = new google.maps.DirectionsRenderer();
        this.directionsService = new google.maps.DirectionsService();

        var mapOptions = {
            center: new google.maps.LatLng(55.6734038, 12.5959576),
            zoom: 8,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        this.map = map;
        this.directionsDisplay.setMap(map);

        this.onLoadCallback();
    },
    geocode: function(address, lang, callback) {
        this.geocoder.geocode({'address': address, 'language' : lang}, function(results, status) {
            if (status == 'OK' && results.length > 0) {
                if (results[0].address_components && results[0].address_components[1] && results[0].address_components[1].long_name) {
                    respRes = results[0].address_components[1].long_name;
                    callback(respRes)
                }
            } else {
                callback('');
            }
        })
    },
    directionsCallback: function(){},
    directions: function(params) {
        var that = this;
        var request = {
            origin: params.origin,
            destination: params.destination,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
            /*waypoints: [
                {location: 'Germany, Berlin', 'stopover': true}
             ]*/
        };
        if (typeof params.waypoints != 'undefined') {
            request.waypoints = params.waypoints;
        }
        this.directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                that.directionsDisplay.setDirections(response);
                that.directionsCallback(response);
            }
        });
    },

    // Get full route length. Based on route legs param.
    getRouteDuration: function(response) {
        var duration = 0, legs = response.routes[0].legs;
        for (i in legs) {
            duration += legs[i]['distance']['value'];
        }
        // Convert meters to km.
        return duration = (duration / 1000).toFixed(2);
    },

    // Auto complete event for input fields
    autoComplete: function(inputId, callback) {
        var input = document.getElementById(inputId);
        var autoComplete = new google.maps.places.Autocomplete(input);
        autoComplete.setTypes(['geocode']);
        autoComplete.bindTo('bounds', this.map);
        google.maps.event.addListener(autoComplete, 'place_changed', function() {
            // Result object
            callback(autoComplete, inputId);
        })
    }
}

function datePicker(fullCalendar) {
    // Check if there is an element for date picker. To avoid conflicts. Date picker requires addition css and js files.
    if ($('#content').find('.datepicker-text').length == 0) {
        return false;
    }
    // Show full calendar(with previous months) or only present/future dates
    var minDate = (typeof fullCalendar == 'boolean' && fullCalendar === true) ? null : 0;
    $( ".datepicker-text" ).datepicker({
        showOn: "button",
        buttonImage: "/frontend/images/calendar.gif",
        buttonImageOnly: true,
        dateFormat: 'dd/mm/yy',
        minDate: minDate
    });

    // setting for dk localization
    $.datepicker.regional['dk'] = {
        closeText: 'Luk',
        prevText: '&#x3c;Forrige',
        nextText: 'NГ¦ste&#x3e;',
        currentText: 'Idag',
        monthNames: ['Januar','Februar','Marts','April','Maj','Juni',
            'Juli','August','September','Oktober','November','December'],
        monthNamesShort: ['Jan','Feb','Mar','Apr','Maj','Jun',
            'Jul','Aug','Sep','Okt','Nov','Dec'],
        dayNames: ['SГёndag','Mandag','Tirsdag','Onsdag','Torsdag','Fredag','LГёrdag'],
        dayNamesShort: ['Sø','Ma','Ti','On','To','Fr','Lø'],
        dayNamesMin: ['Sø','Ma','Ti','On','To','Fr','Lø'],
        dateFormat: 'dd-mm-yy',
        firstDay: 0,
        isRTL: false};

    if (utils.getAppLang() == 'dk') {
        $.datepicker.setDefaults($.datepicker.regional['dk']);
    }
}

function hideMask(className1, className2, className3) {
    if ($(className1).is(":checked")) {
        $(className1).closest('.row').find('.hide-mask').hide();
        $(className1).closest('.row').find('.hide-field').css({'opacity': '1'});
    }
    else if ($(className2).is(":checked")) {
        $(className2).closest('.row').find('.hide-mask').show();
        $(className2).closest('.row').find('.hide-field').css({'opacity': '0.5'});
    } else if (className3 != undefined && $(className3).is(":checked")) {
        $(className3).closest('.row').find('.hide-mask').show();
        $(className3).closest('.row').find('.hide-field').css({'opacity': '0.5'});
    }
};

function hideMask2(className1, className2) {
    if ($(className1).is(":checked")) {
        $(className1).closest('.hide-holder').find('.hide-mask').hide();
        $(className1).closest('.hide-holder').find('.hide-field').css({'opacity' : '1'});
    }
    else if ($(className2).is(":checked")) {
        $(className2).closest('.hide-holder').find('.hide-mask').show();
        $(className2).closest('.hide-holder').find('.hide-field').css({'opacity' : '0.5'});
    }
};

// Show info window on hover event
// isWide - use wide popup
function popupInfoWindow(isWide) {
    var cl = '';
    if (isWide === true) {
        cl = '.popup-info-text-wide';
    } else {
        cl = '.popup-info-text';
    }
    $(".popup-info").hover(
        function () {
            $(this).closest('.popup-info-holder').find(cl).fadeIn(250).animate({bottom: "24px"},100);
        },
        function () {
            $(this).closest('.popup-info-holder').find(cl).animate({bottom: "34px"}, 100).fadeOut(250);
        }
    );
}
// Init info popup block for labels (to provide more information for user)
// isWide param means that will be applied additional css
function initInfoPopupBlock(isWide) {
    var infoPopupTpl = '';
    // Popup tpl
    // Use wide popup
    if (isWide === true) {
        infoPopupTpl = '<div class="popup-info-holder"><span class="popup-info">i</span><div class="popup-info-text-wide"><span>{text}</span></div></div>';
    } else {
        infoPopupTpl = '<div class="popup-info-holder"><span class="popup-info">i</span><div class="popup-info-text"><span>{text}</span></div></div>';
    }

    // Find all labels and insert popup block
    $('.info-popup').each(function(index, elem) {
        $(elem).append(infoPopupTpl.replace('{text}', $(elem).data('text')));
    })
    // Show info box in hover
    popupInfoWindow(isWide);
    return true;
}

/*
function localizeDatepicker() {
    $( "#datepicker-fra, #datepicker-til" ).datepicker({
        showOn: "button",
        buttonImage: "/frontend/images/calendar.gif",
        buttonImageOnly: true
    });

    // setting for dk localization
    $.datepicker.regional['dk'] = {
        closeText: 'Luk',
        prevText: '&#x3c;Forrige',
        nextText: 'NГ¦ste&#x3e;',
        currentText: 'Idag',
        monthNames: ['Januar','Februar','Marts','April','Maj','Juni',
            'Juli','August','September','Oktober','November','December'],
        monthNamesShort: ['Jan','Feb','Mar','Apr','Maj','Jun',
            'Jul','Aug','Sep','Okt','Nov','Dec'],
        dayNames: ['SГёndag','Mandag','Tirsdag','Onsdag','Torsdag','Fredag','LГёrdag'],
        dayNamesShort: ['Sø','Ma','Ti','On','To','Fr','Lø'],
        dayNamesMin: ['Sø','Ma','Ti','On','To','Fr','Lø'],
        dateFormat: 'dd-mm-yy',
        firstDay: 0,
        isRTL: false};

    if (utils.getAppLang() == 'dk') {
        $.datepicker.setDefaults($.datepicker.regional['dk']);
    }
}*/
