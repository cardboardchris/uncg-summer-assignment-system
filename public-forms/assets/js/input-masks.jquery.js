$(function(){
    // phone number input masks
    $('.phone').inputmask({"mask": "(999) 999-9999", "placeholder": " ", "showMaskOnHover": false});
    // ssn input masks
    $('.ssn').inputmask({"mask": "999-99-9999", "placeholder": " ", "showMaskOnHover": false});
    // date input masks
    $('.month-year-date').inputmask({"mask": "99/9999", "placeholder": " ", "showMaskOnHover": false});
    $('.month-day-year-date').inputmask({"mask": "99/99/9999", "placeholder": " ", "showMaskOnHover": false});
    // course number mask
    $('.five-digit-number').inputmask({"mask": "99999", "placeholder": " ", "showMaskOnHover": false});
});