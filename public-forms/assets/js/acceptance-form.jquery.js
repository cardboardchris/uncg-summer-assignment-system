$(function(){

    // show student status options if student status selected
    $('.employee-status-container input').change(function(){
        $studentStatusContainers = $('.student-status-header').add('.student-status-container');
        if ($('#employeestatus-student').is(':checked')) {
            $studentStatusContainers.slideDown().find('.student-status input').prop('required', true);
        } else {
            $studentStatusContainers.slideUp().find('.student-status input').removeAttr('required');
        }
    });

    // show undergrad/grad options for each semester if "Yes" for that semester selected
    $('.student-status input[type=radio]').change(function(){
        $this = $(this);
        if ($this.val() == 'yes') {
            $this.closest('.form-group').next().find('input').removeClass('disabled').attr('disabled', false).prop('required', true);
        } else if ($this.val() == 'no') {
            $this.closest('.form-group').next().find('input').addClass('disabled').prop('checked', false).attr('disabled', true).removeAttr('required');
        }
    });

    // disable select on decline
    $('.input-cell.last-cell input').on('change', function(){
        $this = $(this);
        $minimumSelect = $this.closest('.course').find('.course-minimum').find('select');
        if ($this.is(':checked')) {
            $minimumSelect.prop('disabled', true);
            $minimumSelect.val('');
            $minimumSelect.css('opacity', .4);
        } else {
            $minimumSelect.removeAttr('disabled');
            $minimumSelect.css('opacity', 1);
        }
    });

    // make all course fields required if one field has a value entered
    $('.course input, .course select').on('change', function(){
        var $this = $(this);
        if ($this.val() !== "") {
            $this.closest('.course').find('input, .course-campus select').each(function(index, element){
                $element = $(element);
                if (!$element.is('[readonly]')) {
                    $element.prop('required', true);
                }
            });
        } else {
            $this.closest('.course').find('input, select').removeAttr('required');
        }
    });

    // make minimum enrollment not required if pro-rate is declined
    $('.course-accept-prorate input[type=radio]').on('change', function(){
        $this = $(this);
        if ($this.val() == 'no') {
            $this.closest('.course').find('.course-minimum select').val('').removeAttr('required');
            $this.closest('.course').find('.course-minimum .input-cell').removeClass('has-error has-danger');
            $this.closest('.course').find('.course-minimum .disabled-overlay').show();
        } else {
            $this.closest('.course').find('select').prop('required', true);
            $this.closest('.course').find('.course-minimum .disabled-overlay').hide();
        }
    });

    // disable all fields for course if assignment declined
    $('.course-accept input[type=radio]').on('change', function(){
        $this = $(this);
        if ($this.val() == 'no') {
            $this.closest('.course').find('.disabled-overlay').show();
            $this.closest('.course').find('.course-accept-prorate input[type=radio]').removeAttr('required');
            $this.closest('.course').find('.course-accept-prorate input[type=radio]').prop('checked', false);
        } else {
            $this.closest('.course').find('.disabled-overlay').hide();
        }
    });

    // calculate prorated stipends when minimum enrollment changes
    $('.course-minimum select').on('change', function(){
        calculateStipend($(this).closest('.course'));
    });

    function currencyFormat(num) {
      return '$' + parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    function calculateStipend($course) {
        var $enrollmentSelect = $course.find('.course-minimum select');
        if ($enrollmentSelect.length > 0) {
            var enrollment = $enrollmentSelect.find('option:selected').val();
        } else {
            var enrollment = '';
        }
        if (enrollment !== '') {
            var courseNumber = $course.find('.course-number-only').val();
            var courseCredits = $course.find('.course-credits').val();
            var courseStipend = $course.find('.course-maximum-stipend').val();
            var gradRate = $('#grad_rate').val();
            var ugradRate = $('#ugrad_rate').val();
            var percent = $('#percent').val();
            var minimum = $('#minimum-stipend').val();
            var gradRatePerCredit = gradRate*percent;
            var ugradRatePerCredit = ugradRate*percent;
            if (courseNumber < 500) {
                var proratedStipend = ugradRatePerCredit.toFixed(2)*enrollment*courseCredits;
            } else {
                var proratedStipend = gradRatePerCredit.toFixed(2)*enrollment*courseCredits;
            }
            if (proratedStipend > courseStipend) {
                var stipend = parseFloat(courseStipend).toFixed(2);
            } else {
                var stipend = proratedStipend.toFixed(2);
            }
            $course.find('.adjusted-stipend').val(currencyFormat(stipend));
        }
    }

    // + Course buttons
    $('.add-course-button').on('click', function(){
        $this = $(this);
        $this.closest('.course').next().show();
        $this.closest('.course').next().find('.course-campus select').prop('required', true);
        $this.hide();
    });

    // - Course buttons
    $('.remove-course-button').on('click', function(){
        $this = $(this);
        $this.closest('.course').hide().find('input, select').val('').removeAttr('required');
        $this.closest('.course').find('input[type=radio]').prop('checked', false);
        $this.closest('.course').prev().find('.add-course-button').show();
    });

    // make course 1 fields required when page loads
    $('.course-1').find('input[type=text], .course-campus select').each(function(index, element){
        $element = $(element);
        if (!$element.is('[readonly]')) {
            $element.prop('required', true);
        }
    });

    // calculate stipend for any pre-filled enrollments (already accepted)
    $('.course').each(function() {
        calculateStipend($(this));
    });

});