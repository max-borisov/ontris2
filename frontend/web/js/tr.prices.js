// Counter for new added countries (prices)
var addCountryCounter = 0;
$(function() {
    // If there is no list of countries added already
    // data-counter is the attribute for rows which are going to be added to DB
    if (!$('.hide-row[data-counter]').length) {
        addCountryCounter = 1000;
    } else {
        // Each row with a country holds a counter. Get the last one
        addCountryCounter = $('div[data-counter]:last').data('counter')
    }

    // Add new country. Get the html code from template
    $('.add-country-btn').click(function(event) {
        event.preventDefault();
        if (!window.addCountryTpl) return false;

        // Select elem
        var dropDown = $(this).closest('.row').find('select');
        // Get country Id
        var countryId = dropDown.val();
        // Get country name
        var countryName = dropDown.find('option:checked').text();
        if (!countryId || !countryName) return false;

        // Show header and footer for prices block
        $('.prices-th-hide-row:hidden, .measure-th-hide-row:hidden').show();

        // Fill up block template
        addCountryHtmlBlock = addCountryTpl
            // Unique number
            .replace(/#num#/ig, ++addCountryCounter)
            .replace(/#country#/ig, countryName)
            .replace(/#country_id#/ig, countryId);
        // Show block
        $('#new-country-box').append(addCountryHtmlBlock);
        // Reset dropdown
        dropDown.val('');
    })
    // Remove country record from DB
    $('.del-other-country').click(function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete this record ?')) {
            var that = $(this);
            var parentBlock = that.closest('.hide-row');
            // Get row id
            var rowId = parentBlock.find('.country-prices-id').val();
            $.get('/company/transportation-prices/delete/' + rowId, function(data){
                if (data == '1') {
                    parentBlock.remove();
                }
            })
        }
    })
    // Remove new country from page
    $('#new-country-box').on('click', '.del-new-country', function(event) {
        event.preventDefault();
        $(this).closest('.hide-row').remove();
    })

    // Show info box on hover
    popupInfoWindow();
})

/*
$('.del-ico-link').click(function() {
    $(this).closest('.hide-row, tr, .row').detach();
    return false;
});
$('.add-del-link').click(function() {
    $(this).closest('.hide-row').detach();
    return false;
});*/
