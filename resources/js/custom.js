$(document).ready(function () {
    $("#start_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        onSelect: function(dateStr) {
            var d = $.datepicker.parseDate('yy-mm-dd', dateStr);
            var years = parseInt(1, 10);

            d.setFullYear(d.getFullYear() + years);
            d.setDate(d.getDate()-1);
            $('#end_date').datepicker('setDate', d);

        }
    });
    $("#end_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
});
