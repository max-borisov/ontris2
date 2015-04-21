// Counter for Transit Via blocks
var cargoTransitViaCounter;
// Counter for Cargo type blocks
var cargoTypeCounter = 0;
$(function() {
    datePicker();
    $('.row.submit-holder').hide();

    // Form keypress. Prevent form is being send by click 'enter' button
    $('.register-form').keypress(function(event) {
        var code = event.keyCode || event.which;
        // If user clicked Enter button prevent form submit
        if (code == 13) {
            event.preventDefault();
        }
    })

    // If there are 'Transit via blocks', start counter from the last position
    if ($('.transit-via-block').length == 0) {
        cargoTransitViaCounter = 100;
    } else {
        // Get number for the last 'Via' block
        cargoTransitViaCounter = $('.transit-via-block:last').data('counter');
    }

    // If there are 'Cargo type blocks', start counter from the last position
    if ($('.type-add-row.hide-row').length == 0) {
        cargoTypeCounter = 200;
    } else {
        cargoTypeCounter = $('.type-add-row.hide-row:last').data('cargoTypeNum');
    }

    // Select Cargo type, Transportation type and Special requirements menu items
    $('.row.type-row, .row.transport-row, .row.krav-row').on('click', '.btn-list a', function(event) {
        event.preventDefault();

        if (!$(this).hasClass('active')) {
            $(this).parents('ul').find('a').removeClass('active');
            $(this).toggleClass('active');
        }
    });

    /****** Cargo type ******/
    // Tabs
    $('.row.type-row').on('click', '.type-add-row .btn-list a', function(event) {
        event.preventDefault();
        showBox = $(this).closest('.type-add-row').find('.tab');
        showBox.show();
        // If Letter
        if ($(this).parent('li').is(':first-child')) {
            // Show only 1 field (Amount input)
            showBox.find('.text-holder, .row>label').hide();
            showBox.find('.row-holder .row:eq(0) .text-holder:eq(0)').show();
        }
        else {
            // Show all input fields
            showBox.find('.text-holder, .row>label').show();
        }
    });
    // Make the Letter type selected by default after page loading if it was chose before
    $('.type-add-row .btn-list .letter-li a[class="active"]').each(function() {
        showBox = $(this).closest('.type-add-row').find('.tab');
        showBox.show();
        showBox.find('.text-holder, .row>label').hide();
        showBox.find('.row-holder .row:eq(0) .text-holder:eq(0)').show();
    })
    // Make the Pakke/Pallet types selected by default after page loading if they was chose before
    $('.type-add-row .btn-list .pakke-li a[class="active"], .type-add-row .btn-list .palle-li a[class="active"]').each(function() {
        showBox = $(this).closest('.type-add-row').find('.tab');
        showBox.show();
        showBox.find('.text-holder, .row>label').show();
    })
    /****** Cargo type END ******/

    /****** Transportation type ******/
    // Tabs
    $('.row.transport-row').on('click', '.row-content .btn-list a', function(event) {
        event.preventDefault();

        // Show section
        var showBox = $(this).closest('.row-content').find('.tab');
        showBox.show();
        // If Normal transport was selected
        if ($(this).parent('li').is(':first-child')) {
            // Hide box with ASAP params
            showBox.find('.hide-holder').hide();
            // Show normal transportation text
            showBox.find('.normal-transport-text').show();
        }
        else {
            // Show ASAP box
            showBox.find('.hide-holder').show();
            // Hide normal transportation text
            showBox.find('.normal-transport-text').hide();
        }
    });
    // Show section after page is loading
    var trTypeRowContent = $('.row.transport-row .row-content');
    if (trTypeRowContent.find('.btn-list a:first').hasClass('active')) {
        // Show subsection
        var showBox = trTypeRowContent.find('.tab');
        showBox.show();
        // Hide box with ASAP params
        showBox.find('.hide-holder').hide();
        // Hide normal transport description text
        showBox.find('.normal-transport-text').show();
    } else if (trTypeRowContent.find('.btn-list a:last').hasClass('active')) {
        var showBox = trTypeRowContent.find('.tab');
        showBox.show();
        // Show box with ASAP params
        showBox.find('.hide-holder').show();
        // Show POD row
        PODRowManager('show');
    }
    /****** Transportation type END ******/

    /****** Requirements ******/
    // Tabs
    $('.row.krav-row').on('click', '.row-content .btn-list a', function(event) {
        event.preventDefault();

        // Show section
        showBox = $(this).closest('.row-content').find('.tab');
        // If Specific requirements were selected
        if ($(this).parent('li').is(':first-child')) {
            // Show section
            showBox.show();
        }
        else {
            // Show ASAP box
            showBox.hide();
        }

        resetPricesBlock();
    });
    // Show section after page loading
    var reqTypeRowContent = $('.row.krav-row .row-content');
    if (reqTypeRowContent.find('.btn-list a:first').hasClass('active')) {
        // Show subsection
        var showBox = reqTypeRowContent.find('.tab');
        showBox.show();
    } else if (reqTypeRowContent.find('.btn-list a:last').hasClass('active')) {
        var showBox = reqTypeRowContent.find('.tab');
        showBox.hide();
    }
    /****** Requirements END ******/

    // Step-by-step registration. Make next item available if the current item is selected.
    $('.register-form .btn-list a, .register-form .text').click(function() {
        if ($(this).closest('.row').hasClass('map-row')) {
            $(this).closest('.row').next().removeClass('row-masked').find('.mask').remove();
            $(this).closest('.row').next().find('.pricer-list').show();
        }
        else {
            $(this).closest('.row').next().removeClass('row-masked').find('.mask').remove();
        }
    });

    // Handler for link 'Add more cargo'. Send request for html form form to add new cargo
    $('.more-cargo-type a').click(function(event) {
        event.preventDefault();
        cargoTypeCounter++;
        $.get('/action/register-cargo/type-block/' + cargoTypeCounter, function(data) {
            $(data).insertBefore('.row.type-row .link-holder');
        })
    })
    // Remove cargo from the list
    $('.row.type-row').on('click', '.remove-cargo-type', function(event) {
        event.preventDefault();
        $(this).parent().remove();
        resetPricesBlock();
    })

    // Add 'Autocomplete' event for the 'Via' blocks which are on the page
//    $('.transit-via-block input').autocomplete(autoCompleteObj);

    // Add new 'Via' block
    $('#transit-via-btn').click(function(event) {
        event.preventDefault();

        // Html tpl for 'Via' block
        if (!window.cargoTransitViaBlockTpl) return false;

        // Put number for a new block
        ++cargoTransitViaCounter;
        // Tpl for a new Via block
        cargoTransitViaBlock = cargoTransitViaBlockTpl.replace(/#num#/gi, cargoTransitViaCounter);
        cargoTransitViaBlock = cargoTransitViaBlock.replace(/#errorClass#/gi, '');
        cargoTransitViaBlock = cargoTransitViaBlock.replace(/#inputValue#/gi, '');
        cargoTransitViaBlock = cargoTransitViaBlock.replace(/#lat#/gi, '');
        cargoTransitViaBlock = cargoTransitViaBlock.replace(/#lng#/gi, '');
        cargoTransitViaBlock = cargoTransitViaBlock.replace(/#zip#/gi, '');

        // Insert a new block  into the page
        $(cargoTransitViaBlock).insertBefore($(this).parent('.row'));

        // Attach 'Autocomplete' event for 'via' point inputs
        mGoogleApi.autoComplete('transitVia_' + cargoTransitViaCounter, viaAutoCompleteFunction);
    })
    // Remove one 'Via' point
    $('.map-holder').on('click', '.text-row .transit-via-remove', function(event) {
        event.preventDefault();
        $(this).parent().remove();
        showCargoRoute();

        resetPricesBlock();
    })

    // Cargo type. Hidden field. Save cargo type id
    $('.row.type-row').on('click', '.cargo-type li a', function(event) {
        event.preventDefault();
        var that = $(this);
        that.closest('.type-add-row').find("input[type='hidden']").val(that.data('cargoType'));
        // Show Rregister more cargo' link
        if ($('.more-cargo-type').hasClass('display-none')) {
            $('.more-cargo-type').removeClass('display-none');
        }

        resetPricesBlock();
    })

    // Transportation type. Hidden field
    $('.cargo-tr-type li a').click(function() {
        $('#cargoTrType').val($(this).data('trType'));
    })
    // Special Requirements type. Hidden field
    $('.cargo-req-type li a').click(function() {
        $('#cargoReqType').val($(this).data('reqType'));
    })

    // Hide/show elements
    // attach event to element's class instead of name attr
    $(".radio.pickup-ready-flag").click(function() {
        hideMask("#godset-no","#godset-yes");
    });
    // attach event to element's class instead of name attr
    $(".radio.pickup-close-flag").click(function() {
        hideMask("#senset-yes","#senset-no");
    });
    $(".radio.asap-flag").click(function() {
        hideMask2("#hurtigst-no","#hurtigst-yes");
    });
    // attach event to element's class instead of name attr
    $(".radio.req-adr-flag").click(function() {
        hideMask("#adr-yes","#adr-no");
    });
    $(".radio.req_pod_flag").on('click', function() {
        hideMask("#pod-yes","#pod-no");
    });

    $(".radio.req-frig-flag").click(function() {
        hideMask("#refrigerated-yes","#refrigerated-no");
    });
    // attach event to element's class instead of name attr
    $(".radio.cargo-insurance").click(function() {
        hideMask("#cargo-insurance-yes","#cargo-insurance-no");
    });
    $(".radio.req-customs-type").click(function() {
        hideMask("#responsible-clearance", "#no-clearance", "#company-clearance");
    });

	// Disable some elements
    $(window).on('load',
        hideMask("#godset-no","#godset-yes"),
        hideMask("#senset-yes","#senset-no"),
        hideMask2("#hurtigst-no","#hurtigst-yes"),
        hideMask("#adr-yes","#adr-no"),
        hideMask("#pod-yes","#pod-no"),
        hideMask("#refrigerated-yes","#refrigerated-no"),
        hideMask("#cargo-insurance-yes","#cargo-insurance-no"),
        hideMask("#responsible-clearance", "#no-clearance", "#company-clearance")
    );

    // Reset prices block if pickup/closing radio button has been changed
    $(".radio.pickup-ready-flag, .pickup-close-flag, .asap-flag").on('change', function() {
        resetPricesBlock();
    });
    // Reset prices block if any pickup/closing/destination date/time has been changed
    $('.date-time-holder input').on('change', function() {
        resetPricesBlock();
    })

    // Show/Hide POD row for Urgent transportation
    $('.transport-row .btn-list a').click(function(event) {
		event.preventDefault();
		if ($(this).parent('li').is(':last-child')) {
            PODRowManager('show');
        } else {
            PODRowManager('hide');
        }
        resetPricesBlock();
	});

    // If there is calculatePrices, send request to get prices
    if (window.calculatePrices && calculatePrices == true) {
        getPricesNew();
    }

    // Click on item from prices block
    $('.prices-box').on('click', '.pricer-list a', function(event) {
        event.preventDefault();

        // Set basic_data_id for order
        $('#order-bd-id').val($(this).parent('li').data('bd'));
        // Set trip_id for order
        $('#order-trip-id').val($(this).parent('li').data('trip'));

        // Make 'Continue' button available
        if ($('.row.submit-holder').hasClass('row-masked')) {
            $('.row.submit-holder').removeClass('row-masked');
            $('.row.submit-holder').find('span.mask').remove();
        }

        if (!$(this).hasClass('active')) {
            $(this).parents('ul').find('a').removeClass('active');
            $(this).toggleClass('active');
        }
    });

    // Reset prices block if any cargo parameter has been changed (exp. amount/weight/dimensions)
    $('.tab.tab-cargo-dimensions').on('change', function(){
        resetPricesBlock();
    })

    // There is no Ajax button any more.
    // Send request for relevant offer.
    /*$('.prices-box').on('click', '.no-suggestions-box a:last', function(event) {
        event.preventDefault();
        showPreloader();
        // Save request
        $.get('/action/register-cargo/offer-request', function(resp) {
            // show success message
            $('.no-suggestions-box').empty().append(offerSuccessMsg);
            hidePreloader();
        })
    })*/

    // Remove mask
	/*window.onload = function() {
		$('.mask').remove();
		$('div').removeClass('row-masked');
	};*/
})

function getPricesNew() {
    showPreloader()
    $.get('/action/register-cargo/calculate-prices', function(data) {
//        console.log(data)

        // Server returns html code for the prices block. Check whether it contains prices section.
        var hasPrices = (data.indexOf('pricer-list') == -1) ? false : true;
        var box = $('.prices-box .row-content');
        // Hide banner
        box.find('.banner').hide();

        var priserListBox, offer24Hour;
        // Remove previous blocks
        if (priserListBox = box.find('.btn-list.pricer-list')) {
            priserListBox.remove();
        }
        if (offer24Hour = box.find('.24-hour-offer')) {
            offer24Hour.remove();
        }

        box.append(data);
        if (hasPrices) {
            box.find('.btn-list.pricer-list').show();

            // Doesn't work with .on method
            $(".prices-info").hover(
                function () {
                    $(this).closest('li').find('.prices-info-text').fadeIn(250).animate({
                        bottom: "82px"
                        },100);
                },
                function () {
                    $(this).closest('li').find('.prices-info-text').animate({
                        bottom: "92px"
                    }, 100).fadeOut(250);
                }
            );

            $(".reduce-label").hover(
                function () {
                    $(this).closest('li').find('.reduce-text').fadeIn(250).animate(
                        {
                            bottom: "25px"
                        },100);
                },
                function () {
                    $(this).closest('li').find('.reduce-text').animate({
                        bottom: "18px"
                    }, 100).fadeOut(250);
                });

            if ($('.row.submit-holder').is(':hidden')) {
                $('.row.submit-holder').show();
            }
        } else {
            /*if ($('.row.submit-holder').is(':visible')) {
                $('.row.submit-holder').hide();
            }*/
        }

        // Scroll page down to the prices block
        location.hash = '#prices-section';
        hidePreloader();
    })
}

// Hide prices block and show banner instead
function resetPricesBlock()
{
    var parent = $('.prices-box');
    // If banner is visible, not prices block
    if (parent.find('.banner').is(':visible')) return false;

    // Hide 'Send offer request' block
    parent.find('.no-suggestions-box').remove();

    // Show banner
    parent.find('.banner').show();
    // Hide prices
    parent.find('.pricer-list').remove();
    // Hide 'Continue' button
    $('.row.submit-holder').hide();
}

function showPreloader() {
    $('div.preloader-box').fadeIn(300);
    return true;
};
function hidePreloader() {
    $('div.preloader-box').fadeOut(300);
    return true;
};
// Show/Hide POD row for Urgent transportation
function PODRowManager(action) {
    var row = $('.krav-row .pod-row');
    if (action === 'show') {
        row.show();
    } else if (action === 'hide') {
        row.hide();
    }
    return true;
}

// Callback autocomplete function for via points
var viaAutoCompleteFunction = function (autocomplete, inputId) {
    showCargoRoute();
    var place = autocomplete.getPlace();
    if (!place.geometry) return;
    var parent = $('#' + inputId).parent('div');
    // save related to via point lat and lng values
    parent.find('.via-lat').val(place.geometry.location.lat());
    parent.find('.via-lng').val(place.geometry.location.lng());
    parent.find('.via-zip').val(getZipFromPlace(place));

    resetPricesBlock();
}