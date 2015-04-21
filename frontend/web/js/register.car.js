$(function() {

    // Delete car
    $('.del-car-link').on('click', function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete the car ?')) {
            var that = this;
            $.get(that.href, function(resp) {
                if (resp == '1') {
                    $(that).closest('tr').hide();
                }
            });
        }
    })

    $(".radio[name='RegCar[freezer_flag]']").click(function() {
        hideMask2("#fridge-yes","#fridge-no");
    });
    $(".radio[name='RegCar[adr_flag]']").click(function() {
        hideMask2("#adr-yes","#adr-no");
    });

    // Calculate volume
    $('#height, #width, #length').change(function() {
        calcVolume();
    });

    $(window).on('load', hideMask2("#fridge-yes","#fridge-no"), hideMask2("#adr-yes","#adr-no"));
});

/**
 * Calculate volume based on width, height and length
 */
function calcVolume() {
    var height = parseFloat($('#height').val());
    var width = parseFloat($('#width').val());
    var length = parseFloat($('#length').val());
    var volume = '';
    if (height > 0 && width > 0 && length > 0) {
        // Convert cm3 into m3
        volume = height * width * length / 1000000;
        volume = volume.toFixed(2);
    }
    $('#volume').val(volume);
}