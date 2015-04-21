$(function() {
    var countryName = '', countryMsg = '';
    // Show notification if user select country other than Denmark
    $('#country_id').on('change', function() {
        countryName = $(this).find('option:selected').text();
        // If not Denmark
        if ($(this).val() != '89') {
            // Insert country name
            countryMsg = $('.country-msg-tpl').text().replace(/\{country\}/ig, countryName)
            $('.country-msg').html(countryMsg).show();
        } else {
            $('.country-msg').hide();
        }
    })
})