$(function() {
    $('.delete-contact').click(function() {
        // url like /en/basic-data/delete/7.html
        var url = $(this).attr('href');
        console.log(url);
        if (window.confirm('Are you sure you want to delete the contact ?')) {
            $.get(url, function(data) {
//                if (data == '1') {
                    location.reload();
//                }
            });
        }
        return false;
    })

    $('#country, #zip-code').change(function() {
        getCityByZipCountry($('#country'), $('#zip-code'), $('#city'));
    })

    // Turned off temporarily
    /*$('.upload-fake-btn').on('click', function(event) {
        event.preventDefault();
        $('.upload-real-btn').click();
    })

    $('.upload-real-btn').change(function() {
        $(this).parent().submit();
    });*/
})

function getCityByZipCountry(countrySelectObj, zipInputObj, cityInputObj) {
    var selectedCountry = countrySelectObj.find('option:selected').text();
    var zipCode = zipInputObj.val();
    if (!countrySelectObj || !zipInputObj) return false;

    // get app language
    var lang = utils.getAppLang();
    var geoResp = mGoogleApi.geocode(zipCode + ',' + selectedCountry, lang, function(resp) {
        cityInputObj.val(resp);
    });
}

$(window).load(function() {
    mGoogleApi.loadLight(utils.getAppLang());
});