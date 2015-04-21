/**
 * Javascript for history section (cargo/orders/trips)
 */
$(function() {

    // Delete trip from history
    $('.del-history-trip').on('click', function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete trip from history ?')) {
            var that = this;
            $.get(that.href, function(resp) {
                if (resp == '1') {
                    $(that).closest('tr').hide();
                }
            });
        }
        // We need it due to parent row is clickable
        eventStopPropagation(event)
    })

    // Delete order from history
    $('.del-history-order').on('click', function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete order from history ?')) {
            var that = this;
            $.get(that.href, function(resp) {
                if (resp == '1') {
                    $(that).closest('tr').hide();
                }
            });
        }
        // We need it due to parent row is clickable
        eventStopPropagation(event)
    })

    $('.click-row-table tr').on('click', function() {
        location.href = $(this).data('rowLink');
        return true;
    })

    // Delete cargo from history
    $('.del-history-cargo').on('click', function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete cargo from history ?')) {
            var that = this;
            $.get(that.href, function(resp) {
                if (resp == '1') {
                    $(that).closest('tr').hide();
                }
            });
        }
        // We need it due to parent row is clickable
        eventStopPropagation(event)
    })

    // Take action over an order
    $('.order-action-link').on('click', function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to take action ?')) {
            var that = this;
            $.get(that.href, function(resp) {
//                if (resp == '1') {
                // Reload page. Even if 0 was returned. It means there were no 'free' orders
                location.reload();
//                    $(that).closest('tr').hide();
//                }
            });
        }
        // We need it due to parent row is clickable
        eventStopPropagation(event)
    })

    // Delete company user
    $('.remove-user-link').on('click', function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete user ?')) {
            var that = this;
            $.get(that.href, function(resp) {
                if (resp == '1') {
                    $(that).closest('tr').hide();
                }
            });
        }
    })
})

function eventStopPropagation(e) {
    var event = e || window.event;
    event.stopPropagation ? event.stopPropagation() : (event.cancelBubble=true);
}