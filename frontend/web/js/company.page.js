var refBlockCounter = 1000;
$(function() {
    // Add new reference
    $('.add-new-ref').click(function(event) {
        event.preventDefault();
        // Js code for a new reference block
        if (!window.newRefBlockTpl) return false;
        // Unique blocl number
        var tmpRefBlock = newRefBlockTpl.replace(/#num#/ig, ++refBlockCounter);
        // Reference text
        tmpRefBlock = tmpRefBlock.replace(/#value#/ig, '');
        $('.refBlockHolder').append(tmpRefBlock);
    })

    // Delete reference
    $('.refBlockHolder').on('click', '.del-ico-link', function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete reference ?')) {
            $(this).closest('.row').slideUp('slow', function() {
                $(this).remove();
            });
        }
    })
})