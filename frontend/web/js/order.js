$(function() {
    datePicker();

    $('.print-link').click(function(event) {
        event.preventDefault();
        window.print();
    })

    /*$('.forward-order-form .submit').on('click', function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to forward the order ?')) {
//            $(this).closest('form').submit();
            $(this).click();
        }
    })*/
})