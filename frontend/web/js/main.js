$(document).ready(function() {
    // Front page. Show message when click on App icon
    $('.mobile-link-list a').on('click', function(event) {
        event.preventDefault;
        alert('Vores App er endnu ikke klar til lancering, men alle medlemmer vil blive informeret når App vil kunne hentes;-)');
        return false;
    })

    // Hide notification message shown after login
    $('.log-notification-section .close-btn').on('click', function() {
        var that = this;
        // Request url
        var url = $(this).data('url');
        $.get(url, function(data) {
            if (data == '1') {
                $(that).parent().slideUp();
            }
        })
        return true;
    })
});