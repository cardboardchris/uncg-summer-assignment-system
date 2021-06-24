$(function(){

    $('input[name="no-id"]').on('change', function(){
        newHire();
        uncgInfo();
    });

    // auto-fill ORG# if non-academic department selected
    $('#department').on('change', function(){
        $this = $(this);
        if ($this.val().length == 2) {
            console.log($this.val().length);
            $('#org').val('10302');
        }
    });

    // un-require UNCG id and show address row if "no ID" box checked
    function newHire() {
        var $spartanid = $('#spartanid');
        var $ssnRow = $('.ssn-row');
        var $employeestatus_no = $('#employeestatus-no');
        var $studentstatus_no = $('#studentstatus-no');
        var $newEmployeeInfo = $('.new-employee-info-container');
        if ($('input[name="no-id"]').is(':checked')){
            $spartanid.val('').removeAttr('required').focus().blur();
            $newEmployeeInfo.collapse('show');
            $newEmployeeInfo.find('input, select').prop('required', true);
            $employeestatus_no.prop('checked', true);
            $studentstatus_no.prop('checked', true);
        } else {
            $spartanid.prop('required', true);
            $newEmployeeInfo.collapse('hide');
            $newEmployeeInfo.find('input, select').removeAttr('required');
            $employeestatus_no.prop('checked', false);
            $studentstatus_no.prop('checked', false);
        }
    }

    // if a UNCG id is given, unckeck "no UNCG id",
    // un-require new hire info, and check if campus address required
    $('#spartanid').on('keyup', function() {
        var $newEmployeeInfo = $('.new-employee-info-container');
        if($(this).val()) {
            $('input[name="no-id"]').prop('checked', false);
            $newEmployeeInfo.collapse('hide');
            $newEmployeeInfo.find('#state').val('');
            $newEmployeeInfo.find('input, select').removeAttr('required');
            $('#employeestatus-no').prop('checked', false);
            $('#studentstatus-no').prop('checked', false);
        }
        uncgInfo();
    });

    // require visa info if non-citizen
    $('#citizenship').on('change', function(){
        if ($(this).val() == 'Citizen') {
            $('.new-employee-visa').collapse('hide');
            $('#visa-type, #visa-expires').removeAttr('required').val('');
        } else {
            $('.new-employee-visa').collapse('show');
            $('#visa-type, #visa-expires').prop('required', true);
        }
    });

    // show options and campus address if user is employee or student
    function uncgInfo() {
        var student = $('input[name="studentstatus"]:checked').val();
        var employee = $('input[name="employeestatus"]:checked').val();
        var $newEmployeeInfo = $('.new-employee-info-container');
        var $studentDetails = $('.student-details-container');
        var $employeeDetails = $('.employee-details-container');
		var $salaryContainer = $('.employee-salary');
        var $newHireButton = $('.new-hire-info-button');
        var $spartanidInput = $('#spartanid');
        var $noIdCheckbox = $('input[name="no-id"]');
        // if user has checked 'yes' for current employee or current student
        if (student == "yes" || employee == "yes") {
            // uncheck the no-uncg-id checkbox
            $noIdCheckbox.prop('checked', false);
            // make the spartan id field required
            $spartanidInput.prop('required', true);
            // set the state select to null in case it was pre-filled by the browser
            $('#state').val('');
            // hide the new hire fields, clear them, and make them not required
            $newEmployeeInfo.collapse('hide').find('input, select').removeAttr('required');
            $newEmployeeInfo.find('input[type=radio], input[type=checkbox]').prop('checked', false);
            $newEmployeeInfo.find('input[type=text], select').val('');
        // if the user has not checked 'yes' for current employee or student
        } else if (student == "no" && employee == "no") {
            // make the spartan id field not required
            $spartanidInput.removeAttr('required');
            // show the new hire fields and make them required
            $newEmployeeInfo.collapse('show').find('input, select').prop('required', true);
        }
        // if the user checks 'yes' for current employee
        if (employee == "yes") {
            // show current employee fields and make them required
            $employeeDetails.collapse('show').find('input, select').prop('required', true);
        // if the user has not checked 'yes' for current employee
        } else {
            // hide the current employee fields, clear them, and make them not required
			$salaryContainer.collapse('hide');
			$salaryContainer.removeAttr('required').val('');
            $employeeDetails.collapse('hide').find('input[type=text], select').removeAttr('required').val('');
            $employeeDetails.find('input[type=radio], input[type=checkbox]').removeAttr('required').prop('checked', false);
            // set any selects to the first (default) option
            $employeeDetails.find('option:eq(1)').prop('selected', true);
        }
        if (student == "yes") {
            $studentDetails.collapse('show');
            $studentDetails.find('input, select').prop('required', true);
        } else {
            $studentDetails.collapse('hide').find('input').removeAttr('required').prop('checked', false);
            // set any selects to the first (default) option
            $studentDetails.find('option:eq(1)').prop('selected', true);
            // clear the selects and make them not required
            $studentDetails.find('select').removeAttr('required').val('');
        }
    }

    // show and require salary field if full-time employee
    $('input[name="employeetime"]').on('change', function(){
        var $container = $('.employee-salary');
        var $salary = $('#salary');
        // console.log($('input[name="employeetime"]:checked').val());
        if ($('input[name="employeetime"]:checked').val() == 'full time') {
            $container.collapse('show');
            $salary.prop('required', true);
        } else {
            // hide the salary field container
            $container.collapse('hide');
            // clear the salary field and make it not required
            $salary.removeAttr('required').val('');
        }
    });

    // if student status or employee status is changed, check if
    // campus address is required
    $('input[name="studentstatus"], input[name="employeestatus"], #no-id').on('change', function() {
        uncgInfo();
    });

    ////////////////////////// course table interactivity //////////////////////

    // // section numbers by term
    // var termSections = {
    //     1 : '31',
    //     2 : '01',
    //     3 : '11',
    //     4 : '21',
    //     5 : '51',
    //     6 : '61',
    //     7 : '41',
    //     8 : '71'
    // }
		//
    // // set the value of the section input for a course based on the selected term
    // function set_section(course) {
    //     var $course = course;
    //     var $sectionInput = $course.find('.course-section').find('input');
    //     var requiresAllFields = false;
    //     if ($course.find('.course-position select option:selected').attr('data-course-specific') == 'true') {
    //         requiresAllFields = true;
    //     }
    //     var term = $course.find('.course-term select').val();
    //     if (term !== "" && requiresAllFields) {
    //         $sectionInput.val(termSections[term]);
    //     } else {
    //         $sectionInput.val('');
    //     }
    // }
		//
    // // when selecting term, if position is course-specific, suggest section number
    // $('.course-term select').on('change', function() {
    //     set_section($(this).closest('.course'));
    // });

    // recalculate if credit hours changes while instructor is selected
    $('.course-credits').find('input').on('keyup', function() {
        var $this = $(this);
        var $hoursInput = $this.closest('.course').find('.course-hours input');
        var $positionSelect = $this.closest('.course').find('.course-position').find('select');
        if ($positionSelect.val() == 'Instructor') {
            $hoursInput.val($this.val() * 3);
            $hoursInput.prop('readonly', true);
            $this.focus();
        } else {
            $hoursInput.val('');
            $hoursInput.prop('readonly', false);
        }
    });

    // require or un-require course info fields depending on changes to any field
    $('.courses-container input, .courses-container select').on('change', function(){
        var $input = $(this);
        var $course = $input.closest('.course');
        var $positionSelect = $course.find('.course-position select');
        var $hoursInput = $course.find('.course-hours input');
        var $allCourseInputs = $course.find('input, select');
        var selectedPositionCourseSpecific = $positionSelect.find('option:selected').attr('data-course-specific');
        var requiresAllFields = false;
        var anyFieldHasValue = false;
        $allCourseInputs.each(function(){
            if ($(this).val() !== "") {
                anyFieldHasValue = true;
            }
        });
        if (selectedPositionCourseSpecific == 'true') {
            requiresAllFields = true;
        }

        // change required fields
        if (anyFieldHasValue && requiresAllFields) {
            // the course position is intructor. require all fields
            $course.find('input, select').prop('required', true);
            // set_section($course);
        } else if (anyFieldHasValue && !requiresAllFields) {
            // the course position is not instructor. un-require all fields
            $course.find('input, select').removeAttr('required')
            // remove the suggested section value
            $course.find('.course-section input').val('');
            // require hours input and make it editable
            $course.find('.course-hours input').prop('readonly', false).prop('required', true);
            // require only some fields
            $positionSelect.prop('required', true);
            $course.find('.course-term select').prop('required', true);
            $course.find('.course-campus select').prop('required', true);
            $course.find('.course-stipend input').prop('required', true);
        } else {
            // the course has no filled fields. un-require all fields
            $course.find('input, select').removeAttr('required').focus().blur();
        }
    });

    // remove hide-for-print class from selects that have a value
    $('.courses-container select').on('change', function(){
        $this = $(this);
        if ($this.val() !== "") {
            $this.removeClass('hide-options-for-print');
        } else {
            $this.addClass('hide-options-for-print');
        }
    });

    // //// Calculate stipend totals ////
    // $('.stipend-input-session-1, .stipend-input-session-2').on('keyup, change', function() {
    //     getStipendTotals();
    // });

    // function getStipendTotals() {
    //     var session1total = 0;
    //     var session2total = 0;
    //     var total = 0;
    //     // get session 1 stipends
    //     $('.courses-container .session-1 .course-stipend input').each( function() {
    //         session1total += parseFloat($(this).val().replace(/[^\d.]/g, ''), 10) || 0;
    //     });
    //     if (session1total >= 0) {
    //         $('#session-1-total').val("$" + session1total.toFixed(2));
    //     } else {
    //         $('#session-1-total').val('');
    //     }
    //     // get session 2 stipends
    //     $('.courses-container .session-2 .course-stipend input').each( function() {
    //         session2total += parseFloat($(this).val().replace(/[^\d.]/g, ''), 10) || 0;
    //     });
    //     if (session2total >= 0) {
    //         $('#session-2-total').val("$" + session2total.toFixed(2));
    //     } else {
    //         $('#session-2-total').val('');
    //     }
    //     // total sessions' stipends
    //     total += session1total + session2total;
    //     if (total >= 0) {
    //         $('#grand-total').val("$" + total.toFixed(2));
    //     } else {
    //         $('#grand-total').val('');
    //     }
    // }

    //// Custom Validation ////
    // give error message if all course info fields are left blank
    // $('.submit-button').on('click', function(event){
    //     if (parseFloat($('#grand-total').val().replace(/[^0-9]+/g,"")) == 0 || $('.courses-container .has-error').length > 0) {
    //         event.preventDefault();
    //         $('.form-g-info-error').show();
    //         $('.courses-container').removeClass('validation-ok-border');
    //         $('.courses-container').addClass('validation-error-border');
    //     }
    // });
		//
    // //cancel error message on assignment courses table
    // $('.courses-container input, .courses-container select').on('change', function(){
    //     $('.form-g-info-error').hide();
    //     $('.courses-container').removeClass('validation-error-border');
    //     $('.courses-container').addClass('validation-ok-border');
    // });

    // prevent form from being submitted by pressing enter key
    $('form').keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    // print button
    $('.print-button').on('click', function() {
        window.print();
    });

    ///////////// functions to run on page load //////////////

	// check for repopulated employee or student settings from invalid submit attempt
    uncgInfo();
    // total any stipend inputs that have been repopulated from invalid submit attempt
    // getStipendTotals();

    // input masks on phone numbers
    $('input[type=tel]').inputmask({"mask": "(999) 999-9999", "placeholder": " ", "showMaskOnHover": false});

});
