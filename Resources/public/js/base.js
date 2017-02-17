$(document).ready(function() {
    $('input[data-plugin="filter"]').on('keyup', function() {
        var keyword = $(this).val().trim().toLowerCase();
        var row = $(this).data('filter-row');
        var data = $(this).data('filter-data');

        $(row).each(function() {
            if ($(this).find(data).text().trim().toLowerCase().indexOf(keyword) == -1) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });

    $('.js-datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
});
