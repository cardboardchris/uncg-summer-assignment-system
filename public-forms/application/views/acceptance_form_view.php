<?php defined('BASEPATH') OR exit('No direct script access allowed');

//get form year
if (date('n') > 9) {
    $year = date('Y')+1;
} else {
    $year = date('Y');
}

?>
<div class="row">
    <div class="col-md-12">
    	<h1>UNC Greensboro Division of Online Learning Acceptance Form</h1>
    </div>
</div>
<!-- Form -->
<div class="container form-container acceptance-form">
    <form action="<?=site_url('acceptanceform/submit')?>" method="post" accept-charset="utf-8" data-toggle="validator">
        <input type="hidden" id="pre-filled" name="pre-filled" value="<?php echo ($user_data) ? 'yes' : 'no'; ?>">
    <!-- Identity -->
        <div class="row name-row">
            <div class="col-md-4 text-col">
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" class="form-control" id="firstname" value="<?=$user_data->first_name?>" readonly>
                </div>
            </div>
            <div class="col-md-3 text-col">
                <div class="form-group">
                    <label for="middleinitial">MI:</label>
                    <input type="text" name="middleinitial" class="form-control" id="middleinitial" size="2" <?=(!is_null($user_data->middle_name))?'value="'.$user_data->middle_name.'"':''?> readonly>
                </div>
            </div> <!-- .col -->
            <div class="col-md-5 text-col">
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" class="form-control" id="lastname" data-error="Please enter your last name." placeholder="Last name" value="<?=$user_data->last_name?>" readonly>
                </div>
            </div>
        </div> <!-- .row -->
        <div class="row email-row">
            <div class="col-md-5 text-col">
                <div class="form-group">
                    <label for="spartanid">UNCG ID #:</label>
                    <input type="text" name="spartanid" class="form-control" id="spartanid" value="<?=$user_data->spartan_id?>" readonly>
                </div>
            </div> <!-- .col -->
            <div class="col-md-7 text-col">
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" class="form-control" id="email" data-error="Please enter a valid email address." placeholder="username@uncg.edu" value="<?=$user_data->email?>" readonly>
                </div>
            </div> <!-- .col -->
        </div> <!-- .row -->
    <!-- Status -->
        <div class="row employee-status-container">
            <div class="col-xs-3 col-md-3">
                <p><strong>Employee Status:</strong></p>
            </div>
            <div class="col-xs-9 col-md-9 radio-buttons">
                <div class="form-group">
                    <div class="checkbox checkbox-inline">
                        <input class="form-control" type="radio" name="employeestatus" id="employeestatus-faculty" value="faculty" <?=($user_data && $employeestatus == 'faculty')?'checked="checked"':''?> >
                        <label for="employeestatus-faculty" class="radio-inline">Faculty</label>
                    </div>
                    <div class="checkbox checkbox-inline">
                        <input class="form-control" type="radio" name="employeestatus" id="employeestatus-staff" value="staff" <?=($user_data && $employeestatus == 'staff')?'checked="checked"':''?> >
                        <label for="employeestatus-staff" class="radio-inline">Staff</label>
                    </div>
                    <div class="checkbox checkbox-inline">
                        <input class="form-control" type="radio" name="employeestatus" id="employeestatus-student" value="student" <?=($user_data && $employeestatus == 'student')?'checked="checked"':''?> >
                        <label for="employeestatus-student" class="radio-inline">Student</label>
                    </div>
                    <div class="checkbox checkbox-inline">
                        <input class="form-control" type="radio" name="employeestatus" id="employeestatus-none" value="not affiliated" <?=($user_data && $employeestatus == 'none')?'checked="checked"':''?> >
                        <label for="employeestatus-none" class="radio-inline">Not currently affiliated with UNCG</label>
                    </div>
                </div> <!-- .form-group -->
            </div> <!-- .radio-buttons -->
        </div>

        <div class="row student-status-header <?=($employeestatus !== 'student')?'begin-hidden':''?>">
            <div class="col-md-12">
                <strong>UNCG Student Status:</strong>
            </div>
        </div>
        <div class="row student-status-container student-status-summer <?=($employeestatus !== 'student')?'begin-hidden':''?>">
            <div class="col-xs-4">
                <p>Will you be enrolled in Summer classes?</p>
            </div>
            <div class="col-xs-8 radio-buttons">
                <div class="form-group">
                    <div class="checkbox checkbox-inline student-status">
                        <input class="form-control" type="radio" name="summerstudent" id="summerstudent-no" value="no" <?=($employeestatus == 'student')?'required':''?>>
                        <label class="radio-inline" for="summerstudent-no">No</label>
                        <input class="form-control" type="radio" name="summerstudent" id="summerstudent-yes" value="yes" <?=($employeestatus == 'student')?'required':''?>>
                        <label class="radio-inline" for="summerstudent-yes">Yes, as</label>
                    </div> <!-- checkbox checkbox-inline -->
                </div> <!-- .form-group -->
                <div class="form-group">
                    <div class="checkbox checkbox-inline student-session">
                        <input class="form-control disabled" disabled="disabled" type="radio" name="summerstatus" id="summerstatus-undergrad" value="Undergrad">
                        <label class="radio-inline" for="summerstatus-undergrad">an undergraduate</label>
                        <input class="form-control disabled" disabled="disabled" type="radio" name="summerstatus" id="summerstatus-grad" value="Graduate">
                        <label class="radio-inline" for="summerstatus-grad">a graduate student</label>
                    </div> <!-- checkbox checkbox-inline -->
                </div> <!-- .form-group -->
            </div> <!-- .col-xs-9  radio-buttons -->
        </div>
        <div class="row student-status-container student-status-fall <?=($employeestatus !== 'student')?'begin-hidden':''?>">
            <div class="col-xs-4">
                <p>Will you be enrolled in Fall classes?</p>
            </div>
            <div class="col-xs-8 radio-buttons">
                <div class="form-group">
                    <div class="checkbox checkbox-inline student-status">
                        <input class="form-control" type="radio" name="fallstudent" id="fallstudent-no" value="no" <?=($employeestatus == 'student')?'required':''?>>
                        <label class="radio-inline" for="fallstudent-no">No</label>
                        <input class="form-control" type="radio" name="fallstudent" id="fallstudent-yes" value="yes" <?=($employeestatus == 'student')?'required':''?>>
                        <label class="radio-inline" for="fallstudent-yes">Yes, as</label>
                    </div> <!-- checkbox checkbox-inline -->
                </div> <!-- .form-group -->
                <div class="form-group">
                    <div class="checkbox checkbox-inline student-session">
                        <input class="form-control disabled" disabled="disabled" type="radio" name="fallstatus" id="fallstatus-undergrad" value="Undergrad">
                        <label class="radio-inline" for="fallstatus-undergrad">an undergraduate</label>
                        <input class="form-control disabled" disabled="disabled" type="radio" name="fallstatus" id="fallstatus-grad" value="Graduate">
                        <label class="radio-inline" for="fallstatus-grad">a graduate student</label>
                    </div> <!-- checkbox checkbox-inline -->
                </div> <!-- .form-group -->
            </div> <!-- .col-xs-8 .radio-buttons -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($courses['active_courses'])) {
                    foreach ($courses['active_courses'] as $course) { ?>
                        <p>Your summer assignment of <?=$course->course_position?> <?=(!empty($course->course_subject) && !empty($course->course_number))?' of '.$course->course_subject.$course->course_number.' ':''?>has not yet been verified. Please check back later.</p>
                    <?php } // end foreach
                } else {
                    if (!empty($courses['verified_courses']) || !empty($courses['accepted_courses'])) {
                        // set course counter for later
                        $i = 1;
                        ?>
                        <input type="hidden" id="grad_rate" value="<?=$grad_rate?>">
                        <input type="hidden" id="ugrad_rate" value="<?=$ugrad_rate?>">
                        <input type="hidden" id="percent" value="<?=$percent?>">
                    <?php } // endif ?>

                    <?php if (!empty($courses['verified_courses'])) {
                        // check if all assignments are non-prorated (non-instructors)
                        $any_prorated_assignments = false;
                        foreach ($courses['verified_courses'] as $course_object) {
                            if ($course_object->course_position == 'Instructor') {
                                $any_prorated_assignments = true;
                                break;
                            }
                        }
                        if ($any_prorated_assignments) { ?>
                            <h2>Summer Session Appointment and Pro-Rate Acceptance</h2>
                            <p>
                                To be paid a full stipend, minimum enrollment  is 15 students for undergraduate courses and 10 for graduate courses. Undergraduate courses with fewer than nine students enrolled or graduate courses with fewer than five stu­dents will be cancelled with no further obligation to you. If a course has fewer students than  for a full stipend, you may elect a pro-rate option for that course. You must accept or decline the pro-rate option at this time.
                            </p>
                            <p>
                                In the table below, choose whether you accept the assignment for each course, and whether you will accept pro-rated pay if fewer than 15 students (for undergraduate courses) or fewer than 10 students (for graduate courses) enroll. Then enter the minimum number of students you are willing to teach in that course. The minimum pro-rated salary for the number of students you select will be reflected in the Minimum stipend column. Pro-rated salary for a course cannot exceed the original stipend amount stated in your appointment letter.
                            </p>
                        <?php } else { ?>
                            <h2>Summer Session Appointment Acceptance</h2>
                            <p>
                                In the table below, choose whether you accept each assignment.
                            </p>
                        <?php } // endif ?>
                        </div> <!-- col-md-12 -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-md-12 courses">
                            <?php foreach ($courses['verified_courses'] as $course) {
                                $this->template->load('_parts/acceptance_course_inputs_view', null, array('course_count' => $i, 'course' => $course, 'accepted' => false));
                                $i++;
                            } //end foreach ?>
                        </div> <!-- col-md-12 .courses -->
                    </div> <!-- row -->
                    <?php } //endif
                    if (!empty($courses['accepted_courses'])) { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    You have already accepted the following assignments. You submitted your acceptance on <?=date('m/d/y', strtotime(reset($courses['accepted_courses'])->accepted_date))?>.
                                </p>
                            </div> <!-- .col-md-12 -->
                        </div> <!-- row -->
                        <div class="row">
                            <div class="col-md-12 courses">
                                <?php foreach ($courses['accepted_courses'] as $course) {
                                    $this->template->load('_parts/acceptance_course_inputs_view', null, array('course_count' => $i, 'course' => $course, 'accepted' => true));
                                    $i++;
                                } // end foreach ?>
                            </div> <!-- .courses -->
                        </div> <!-- row -->
                    <?php } //endif ?>
                <?php } //endif ?>

    <!-- Sign and submit -->
        <?php if (empty($courses['active_courses']) && !empty($courses['verified_courses'])) { ?>
            <div class="row hide-for-print">
                <div class="col-xs-1 text-right">
                    <input type="checkbox" name="signature-accept" id="signature-accept" required>
                </div><!-- col-xs-1 col-sm-offset-1 -->
                <div class="col-xs-11">
                    <p>
                        I understand that by entering my full name below, in lieu of an original signature on paper, I accept the terms of this appointment form.
                    </p>
                </div><!-- col-xs-11 -->
            </div><!-- row -->
            <div class="row signature-row hide-for-print">
                <div class="col-sm-3">
                    <p>Enter your full name</p>
                </div><!-- col-sm-2 text-right signature-col -->
                <div class="col-sm-6 signature-col form-group">
                    <input type="text" id="signature" name="signature" placeholder="Firstname Lastname" required>
                </div><!-- .col-sm-8 -->
                <div class="col-sm-3 date-col">
                    Date: <span class="hide-for-print"><?=date('m/d/Y')?></span>
                </div><!-- .col-sm-4 -->
            </div><!-- row -->
            <div class="row hide-for-print">
                <div class="col-xs-12 col-md-11 col-md-offset-1">
                    <p>
                        If you prefer to sign a paper copy instead please contact us at <a href="mailto:onldiv@uncg.edu">onldiv@uncg.edu</a></span>.
                    </p>
                </div><!-- col-xs-12 -->
            </div> <!-- .row -->
            <div class="row submit-row hide-for-print">
                <div class="col-md-4 col-md-offset-4 submit-cell text-center">
                    <button class="btn btn-primary btn-block submit-button" type="submit">Submit</button>
                </div>
            </div> <!-- .row .submit-row -->
            <div class="hide-for-screen signature-row">
                <div class="signature-cell">
                    Signature:
                    <div class="underlined"></div>
                </div>
                <div class="date-cell">
                    Date:
                    <div class="underlined"></div>
                </div>
            </div><!-- .hide-for-screen -->
        <?php } //endif ?>
    </form>
</div> <!-- .form-container -->

<?php $this->template->load('_parts/contact_info_view', null);
