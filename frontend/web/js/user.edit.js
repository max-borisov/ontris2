$(document).ready(function() {
    // Add new area
    $('.new-country-link').click(function(event) {
        event.preventDefault();
        // Counter for a new row
        var num = $('.area-table tbody tr').length + 1;
        var classTr = (num % 2 != 0) ? 'blue-row' : '';
        // Use tpl
        var newAreaTr = newAreaTpl.replace(/#num#/ig, num).replace(/#class#/, classTr);
        $('.area-table tbody').append(newAreaTr);
    })

    // Delete area
    $('table.area-table').on('click', 'tr td .del-ico-link', function(event) {
        event.preventDefault();
        var obj = $(this);
        // Area id
        // Only saved areas have id
        var id = obj.data('id');
        if (id == undefined) {
            obj.closest('tr').hide();
        } else {
            if (!confirm('Are you sure you want to delete this area ? ')) return false;
            $.get('/company/users/area/delete/' + id, function() {
                obj.closest('tr').remove();
            });
        }
    })

    // Manage import/export blocks.
    // It is should not be possible to select 'No' for both export and import.
    // At least one radio should be checked
    $('table.area-table').on('click', 'tr td .import-block input', function() {
        // Import - NO
        if ($(this).val() == '0') {
            // If export is also NO
            if($(this).closest('tr').find('.export-block input:last').prop('checked') === true) {
                // Mark export YES
                $(this).closest('tr').find('.export-block input:first').prop("checked", true);
            }
        }
    })
    $('table.area-table').on('click', 'tr td .export-block input', function() {
        // Export - NO
        if ($(this).val() == '0') {
            // If import is also NO
            if($(this).closest('tr').find('.import-block input:last').prop('checked') === true) {
                // Mark import YES
                $(this).closest('tr').find('.import-block input:first').prop("checked", true);
            }
        }
    })

    // Info block for 'i' icon
    initInfoPopupBlock(true);

});