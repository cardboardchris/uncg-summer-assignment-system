$(function(){
    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    $('#leave-begin-date').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        minDate: today,
        maxDate: function () {
            return $('#leave-end-date').val();
        }
    });
    $('#leave-end-date').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        minDate: function () {
            return $('#leave-begin-date').val();
        }
    });
    $('#leave-begin-time').timepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        format: 'h:MM TT'
    });
    $('#leave-end-time').timepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        format: 'h:MM TT'
    });
});
