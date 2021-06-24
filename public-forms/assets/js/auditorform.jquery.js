$(function(){
    // enable graduation years
    $('.grad-radio-button').on('change', function(){
        $this = $(this);
        $formGroup = $this.closest('.radio-col').next().find('.form-group');
        $gradYearInput = $formGroup.find('.grad-year-input');
        if ($this.val() == 'yes') {
            $formGroup.removeClass('disabled');
            $gradYearInput.removeAttr('disabled');
            $gradYearInput.attr('required', true);
            // show help-box in case it was previously hidden
            $gradYearInput.next().show();
        } else {
            $formGroup.addClass('disabled');
            $gradYearInput.removeAttr('required');
            $gradYearInput.prop('disabled', true);
            // also hide help-block with error message
            $formGroup.removeClass('has-error has-danger');
            $gradYearInput.next().hide();
            $gradYearInput.val('');
        }
    });

    // enable attended details
    $('.attended-radio-button').on('change', function(){
        $this = $(this);
        $radioFormGroup = $this.closest('.radio-col').next().find('.form-group');
        $textFormGroup = $this.closest('.row').next().find('.form-group');
        $attendCredit = $radioFormGroup.find('input');
        $attendDates = $textFormGroup.find('input');
        if ($this.val() == 'yes') {
            $radioFormGroup.removeClass('disabled');
            $textFormGroup.removeClass('disabled');
            $attendCredit.removeAttr('disabled');
            $attendCredit.attr('required', true);
            $attendDates.removeAttr('disabled');
            $attendDates.attr('required', true);
            // show help-boxes in case they were previously hidden
            $attendCredit.closest('.checkbox').next().next().show();
            $attendDates.next().show();
        } else {
            $radioFormGroup.addClass('disabled');
            $textFormGroup.addClass('disabled');
            $attendCredit.removeAttr('required');
            $attendCredit.prop('disabled', true);
            $attendDates.removeAttr('required');
            $attendDates.prop('disabled', true);
            // also hide help-blocks with error message
            // and clear values entered
            $attendCredit.closest('.checkbox').next().next().hide();
            $radioFormGroup.find('input').prop('checked', false);
            $textFormGroup.removeClass('has-error has-danger');
            $attendDates.next().hide();
            $attendDates.val('');
        }
    });

    // enable enrolled dates
    $('.enrolled-radio-button').on('change', function(){
        $this = $(this);
        $textFormGroup = $this.closest('.row').next().find('.form-group');
        $enrolledDates = $textFormGroup.find('input');
        // console.log($this.val());
        if (($this.val() == 'full time') || ($this.val() == 'part time')) {
            $textFormGroup.removeClass('disabled');
            $enrolledDates.removeAttr('disabled');
            $enrolledDates.attr('required', true);
            // show help-boxes in case they were previously hidden
            $enrolledDates.next().show();
        } else {
            $textFormGroup.addClass('disabled');
            $enrolledDates.removeAttr('required');
            $enrolledDates.prop('disabled', true);
            // also hide help-blocks with error message
            // and clear values entered
            $textFormGroup.removeClass('has-error has-danger');
            $enrolledDates.next().hide();
            $enrolledDates.val('');
        }
    });

    // enable conviction date
    $('.convicted-radio-button').on('change', function(){
        $this = $(this);
        $textFormGroup = $this.closest('.radio-col').next('.text-col').find('.form-group');
        $convictedDate = $textFormGroup.find('input');
        // console.log($this.val());
        if ($this.val() == 'yes') {
            $textFormGroup.removeClass('disabled');
            $convictedDate.removeAttr('disabled');
            $convictedDate.attr('required', true);
            // show help-boxes in case they were previously hidden
            $textFormGroup.next().show();
        } else {
            $textFormGroup.addClass('disabled');
            $convictedDate.removeAttr('required');
            $convictedDate.prop('disabled', true);
            // also hide help-blocks with error message
            // and clear values entered
            $textFormGroup.removeClass('has-error has-danger');
            $convictedDate.next().hide();
            $convictedDate.val('');
        }
    });
});