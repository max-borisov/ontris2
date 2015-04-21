$(function() {

    // Repeating trip / Is empty car options
    $(window).on('load', hideMask2("#show-prices-yes","#show-prices-no"));

    $(".radio[name='BasicData[show_prices_flag]']").click(function() {
        hideMask2("#show-prices-yes","#show-prices-no");
    });

    /*$('.basic-data-delete').click(function() {
        // url like /en/basic-data/delete/7.html
        var url = $(this).attr('href');
//        console.log(url);
        if (window.confirm('Are you sure you want to delete the account ?')) {
            $.get(url, function(data, textStatus, jqXHR) {
                location.reload();
            });
        }
        return false;
    })*/

    // Getting city name by selecting country and zip code(select, zip)
    $('#country, #zip-code').change(function() {
        getCityByZipCountry($('#country'), $('#zip-code'), $('#city'));
    })

    // Info block for 'i' icon
    initInfoPopupBlock();
})

$(window).load(function() {
    mGoogleApi.loadLight(utils.getAppLang());
});

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