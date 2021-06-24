<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="auditor-form-container">
    <div class="row">
        <div class="col-md-12">
        	<h1>University of North Carolina at Greensboro <span>Visiting Auditor Registration</span></h1>
        </div>
    </div> <!-- .row -->

    <div class="row">
        <div class="col-md-12">
            <h2>Auditor Participation</h2>
            <p>
                <strong>Auditors can</strong> participate in lecture courses when space is available and with the approval of the department head and/or the instructor. No credit is involved, no examinations are required, and no grades are reported. Permission to audit in no way constitutes admission to the University. No formal record of participation as a Visiting Auditor will be maintained. <strong>Access is not available</strong> to the Rec Center, Jackson Library, or Computer Labs.
            </p>
        </div> <!-- col-md-12 -->
    </div> <!-- .row -->

    <div class="row">
        <div class="col-md-12">
            <h2>Processing Payment</h2>
            <p>
               Fully complete the form below and submit payment to UNCG Online. UNCG Online will obtain the instructor's signature and notify you of your status in participating in the course.
            </p>
        </div> <!-- col-md-12 -->
    </div> <!-- .row -->

    <div class="row bordered">
        <div class="col-md-6">
            <p>
                If paying by check:
            </p>
            <p>
                Make checks payable to: <strong>UNCG Online</strong>
            </p>
            <p>
                Mail to:
            </p>
            <p>
                UNCG Online
                <br>Becher-Weaver Building
                <br>915 Northridge Street
                <br>Greensboro, NC 27403
                <br>Phone: 336.315.7742
                <br>Fax: 336.315.7737
            </p>
        </div> <!-- col-md-6 -->
        <div class="col-md-6">
            <p>
                If paying online:
            </p>
            <p>
                <a href="https://www.nexternal.com/uncg/visiting-auditor-fees-p2868.aspx" target="_blank">Click here to complete your payment for <?php echo $semester; ?>.</a>
            </p>
        </div> <!-- col-md-6 -->
    </div> <!-- .row bordered -->

    <div class="row">
        <div class="col-md-12">
            <h2>Auditing Fees</h2>
        </div> <!-- col-md-12 -->
    </div> <!-- .row -->

    <div class="row bordered">
        <div class="col-md-3">
            <p>
                Lecture Course
            </p>
        </div> <!-- col-md-12 -->
        <div class="col-md-9">
            <ul>
                <li>$125 per course </li>
                <li>$50 Faculty/Staff </li>
                <li>$50 Faculty/Staff Spouse</li>
                <li>$0 Senior Citizen (65 and older} </li>
            </ul>
        </div> <!-- col-md-12 -->
    </div> <!-- .row bordered -->

    <div class="row bordered no-top-border">
        <div class="col-md-3">
            <p>
                Physical Activity Course
            </p>
        </div> <!-- col-md-12 -->
        <div class="col-md-9">
            <ul>
                <li>$100 per course (No additional discounts because of the nature of the course.)</li>
            </ul>
        </div> <!-- col-md-12 -->
    </div> <!-- .row bordered -->

    <div class="row">
        <div class="col-md-12">
            <h2>Refund Policy</h2>
            <p>
                A full refund will be given if no space is available, you are denied, or class is cancelled. If you are unable to attend a course, a written request for a refund must be received one week prior to the beginning of the session. After that date a portion or all of the fee will be retained to cover costs.
            </p>
        </div> <!-- col-md-12 -->
    </div> <!-- .row -->

    <div class="row">
        <div class="col-md-12">
            <hr>
            <p>
                Complete this form to audit "lecture" or "physical activity" courses. Auditors CANNOT audit online courses.
            </p>
        </div>
    </div> <!-- .row -->

    <!-- Form -->
    <div class="form-container">
        <form action="<?=site_url('auditorform/submit')?>" method="post" accept-charset="utf-8" data-toggle="validator">
    <!-- Identity -->
            <div class="row">
                <div class="col-md-5 text-col">
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" data-error="Please enter your first name." placeholder="First name" required>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-2 text-col">
                    <div class="form-group">
                        <label for="middleinitial">MI:</label>
                        <input type="text" name="middleinitial" class="form-control" id="middleinitial" pattern="[A-Za-z]{1}" data-pattern-error="Please enter one letter only." placeholder="M">
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-5 text-col">
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" data-error="Please enter your last name." placeholder="Last name" required>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-5 text-col">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="address" class="form-control" id="address" data-error="Please enter your street address." placeholder="Home address" required>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-3 text-col">
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" name="city" class="form-control" id="city" data-error="Please enter your city." placeholder="City" required>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-2 select-col">
                    <div class="form-group">
                        <label for="state">State:</label>
                        <select class="form-control" name="state" id="state">
                            <option value="AL">AL</option>
                            <option value="AK">AK</option>
                            <option value="AZ">AZ</option>
                            <option value="AR">AR</option>
                            <option value="CA">CA</option>
                            <option value="CO">CO</option>
                            <option value="CT">CT</option>
                            <option value="DE">DE</option>
                            <option value="DC">DC</option>
                            <option value="FL">FL</option>
                            <option value="GA">GA</option>
                            <option value="HI">HI</option>
                            <option value="ID">ID</option>
                            <option value="IL">IL</option>
                            <option value="IN">IN</option>
                            <option value="IA">IA</option>
                            <option value="KS">KS</option>
                            <option value="KY">KY</option>
                            <option value="LA">LA</option>
                            <option value="ME">ME</option>
                            <option value="MD">MD</option>
                            <option value="MA">MA</option>
                            <option value="MI">MI</option>
                            <option value="MN">MN</option>
                            <option value="MS">MS</option>
                            <option value="MO">MO</option>
                            <option value="MT">MT</option>
                            <option value="NE">NE</option>
                            <option value="NV">NV</option>
                            <option value="NH">NH</option>
                            <option value="NJ">NJ</option>
                            <option value="NM">NM</option>
                            <option value="NY">NY</option>
                            <option value="NC" selected="selected">NC</option>
                            <option value="ND">ND</option>
                            <option value="OH">OH</option>
                            <option value="OK">OK</option>
                            <option value="OR">OR</option>
                            <option value="PA">PA</option>
                            <option value="RI">RI</option>
                            <option value="SC">SC</option>
                            <option value="SD">SD</option>
                            <option value="TN">TN</option>
                            <option value="TX">TX</option>
                            <option value="UT">UT</option>
                            <option value="VT">VT</option>
                            <option value="VA">VA</option>
                            <option value="WA">WA</option>
                            <option value="WV">WV</option>
                            <option value="WI">WI</option>
                            <option value="WY">WY</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-2 text-col">
                    <div class="form-group">
                        <label for="zip">Zip:</label>
                        <input type="text" name="zip" class="five-digit-number form-control" id="zip" pattern="[0-9]{5}" maxlength="5" data-error="Please enter zip." placeholder="12345" required>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-5 select-col">
                    <div class="form-group">
                        <label for="ethnicity">Ethnicity:</label>
                        <select class="form-control" name="ethnicity" id="ethnicity" data-error="Please select your ethnicity." required>
                            <option value="">[please select]</option>
                            <option value="Hispanic">Hispanic any race</option>
                            <option value="Native">American Indian or Alaska Native</option>
                            <option value="Asian">Asian</option>
                            <option value="Black">Black or African American</option>
                            <option value="Islander">Native Hawaiian or Other Pacific Islander</option>
                            <option value="White">White</option>
                            <option value="Mixed">Two or more ethnicities</option>
                            <option value="Not Disclosed">Prefer not to disclose</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-4 text-col">
                    <div class="form-group">
                        <label for="birthdate">Date of Birth:</label>
                        <input type="text" name="birthdate" class="month-day-year-date form-control" id="birthdate" pattern="\d{2}/\d{2}/\d{4}" data-date-format="mm/dd/yyyy" data-pattern-error="Please enter date as MM/DD/YYYY." data-error="Please enter your birthdate." placeholder="MM/DD/YYYY" required>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-4 select-col">
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                            <select class="form-control" name="gender" id="gender" data-error="Please select your gender." required>
                                <option value="">[please select]</option>
                                <option value="F">Female</option>
                                <option value="M">Male</option>
                                <option value="NB">Non-binary</option>
                                <option value="ND">Prefer not to disclose</option>
                            </select>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-2 radio-col">
                    <label>US Citizen?</label>
                </div>
                <div class="col-md-2 radio-col">
                    <div class="form-group">
                        <div class="checkbox checkbox-inline">
                            <input type="radio" name="citizen" class="form-control" id="citizen_no" value="no" data-error="Please select one." required>
                            <label for="citizen_no">NO</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input type="radio" name="citizen" class="form-control" id="citizen_yes" value="yes">
                            <label for="citizen_yes">YES</label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-4 text-col">
                    <div class="form-group">
                        <label for="homephone">Phone:</label>
                        <span class="sub-label">Home</span><input type="tel" name="homephone" class="phone form-control" id="homephone" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}" data-error="Please enter your home number." placeholder="(555)-555-5555">
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-3 text-col">
                    <div class="form-group">
                        <span class="sub-label">Cell</span><input type="tel" name="cellphone" class="phone form-control" id="cellphone" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}" data-error="Please enter your cell number." placeholder="(555)-555-5555">
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-5 text-col">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" class="form-control" id="email" data-error="Please enter a valid email address." placeholder="username@uncg.edu" required>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-3 radio-col">
                    <label>High School Graduate?</label>
                </div>
                <div class="col-md-2 radio-col">
                    <div class="form-group">
                        <div class="checkbox checkbox-inline">
                            <input class="grad-radio-button form-control" type="radio" name="high_school_grad" id="high_school_grad_no" value="no" data-error="Please select one." required>
                            <label for="high_school_grad_no">NO</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="grad-radio-button form-control" type="radio" name="high_school_grad" id="high_school_grad_yes" pattern="[0-9]{4}" value="yes">
                            <label for="high_school_grad_yes">YES</label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-3 text-col">
                    <div class="form-group disabled">
                        <label for="high_school_grad_year">Year Graduated:</label>
                        <input class="grad-year-input form-control" disabled="disabled" type="text" name="high_school_grad_year" id="high_school_grad_year" pattern="[0-9]{4}" data-error="Please enter year." placeholder="<?=date('Y')?>">
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-3 radio-col">
                    <label>College Graduate?</label>
                </div>
                <div class="col-md-2 radio-col">
                    <div class="form-group">
                        <div class="checkbox checkbox-inline">
                            <input class="grad-radio-button form-control" type="radio" name="college_grad" id="college_grad_no" value="no" data-error="Please select one." required>
                            <label for="college_grad_no">NO</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="grad-radio-button form-control" type="radio" name="college_grad" id="college_grad_yes" value="yes">
                            <label for="college_grad_yes">YES</label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-3 text-col">
                    <div class="form-group disabled">
                        <label for="college_grad_year">Year Graduated:</label>
                        <input class="grad-year-input form-control" disabled="disabled" type="text" name="college_grad_year" id="college_grad_year" data-error="Please enter year." placeholder="<?=date('Y')?>">
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-5">
                    <label>Have you previously attended UNCG?</label>
                </div>
                <div class="col-md-2 radio-col">
                    <div class="form-group">
                        <div class="checkbox checkbox-inline">
                            <input class="attended-radio-button form-control" type="radio" name="previously_attended" id="previously_attended_no" value="no" data-error="Please select one." required>
                            <label for="previously_attended_no">NO</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="attended-radio-button form-control" type="radio" name="previously_attended" id="previously_attended_yes" value="yes">
                            <label for="previously_attended_yes">YES</label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-3 col-md-offset-1 radio-col">
                    <div class="form-group disabled">
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="attended_for_credit" id="attended_for_credit_yes" value="yes" data-error="Please select one.">
                            <label for="attended_for_credit_yes">Credit</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="attended_for_credit" id="attended_for_credit_no" value="no">
                            <label for="attended_for_credit_no">Audit</label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-2">
                    <label>Attended Dates:</label>
                </div> <!-- .col -->
                <div class="col-md-3 text-col">
                    <div class="form-group disabled">
                        <label for="attended_dates_from">From</label>
                        <input class="month-year-date form-control" type="text" name="attended_dates_from" id="attended_dates_from" pattern="\d{2}/\d{4}" data-pattern-error="Please enter date as MM/YYYY." data-error="Please enter date." placeholder="MM/YYYY" disabled>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-3 text-col">
                    <div class="form-group disabled">
                        <span class="sub-label">To</span>
                        <input class="month-year-date form-control" type="text" name="attended_dates_to" id="attended_dates_to" pattern="\d{2}/\d{4}" data-pattern-error="Please enter date as MM/YYYY." data-error="Please enter date." placeholder="MM/YYYY" disabled>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-5">
                    <label>Are you currently enrolled as a UNCG student?</label>
                </div> <!-- .col -->
                <div class="col-md-4 radio-col">
                    <div class="form-group">
                        <div class="checkbox checkbox-inline">
                            <input class="enrolled-radio-button form-control" type="radio" name="current_enrollment" id="current_enrolled_none" value="not enrolled" data-error="Please select one." required>
                            <label for="current_enrolled_none">NO</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="enrolled-radio-button form-control" type="radio" name="current_enrollment" id="current_enrolled_full" value="full time" data-error="Please select one.">
                            <label for="current_enrolled_full">Full time</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="enrolled-radio-button form-control" type="radio" name="current_enrollment" id="current_enrolled_part" value="part time">
                            <label for="current_enrolled_part">Part time</label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-5 text-col">
                    <div class="form-group disabled">
                        <label for="enrolled_dates">Enrolled Dates:</label>
                        <span class="sub-label">From</span>
                        <input class="month-year-date form-control" type="text" name="enrolled_dates_from" id="enrolled_dates_from" pattern="\d{2}/\d{4}" data-pattern-error="Please enter date as MM/YYYY." data-error="Please enter date." placeholder="MM/YYYY" disabled>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-3 text-col">
                    <div class="form-group disabled">
                        <span class="sub-label">To</span>
                        <input class="month-year-date form-control" type="text" name="enrolled_dates_to" id="enrolled_dates_to" pattern="\d{2}/\d{4}" data-pattern-error="Please enter date as MM/YYYY." data-error="Please enter date." placeholder="MM/YYYY" disabled>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-12">
                    <p><strong>COURSE:</strong> Please list only one course per registration form.</p>
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-3 text-col">
                    <div class="form-group">
                        <label for="crn">CRN#</label>
                        <input class="five-digit-number form-control" type="text" name="crn" id="crn" pattern="\d{5}" maxlength="5" data-error="Please enter 5-digit CRN." placeholder="00000" required>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-4 text-col">
                    <div class="form-group">
                        <label for="course_number">Course#</label>
                        <input class="form-control" type="text" name="course_number" id="course_number" pattern="[A-Z]{3} \d{3}[A-Z]?-\d{2}" data-pattern-error="Please enter in the form ABC 123(L)-01." data-error="Please enter course number." placeholder="ABC 123-01" required>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-5 text-col">
                    <div class="form-group">
                        <label for="course_title">Title</label>
                        <input class="form-control" type="text" name="course_title" id="course_title" placeholder="Course Title" required>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-6 text-col">
                    <div class="form-group">
                        <label for="course_instructor">Instructor</label>
                        <input class="form-control" type="text" name="course_instructor" id="course_instructor" data-error="Please enter instructor name." placeholder="Instructor Name" required>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-4 select-col">
                    <div class="form-group">
                        <label for="semester">Semester:</label>
                        <select class="form-control" name="semester" id="semester" data-error="Please select semester." required>
                            <option value="">[please select]</option>
                            <option value="spring">Spring</option>
                            <option value="summer">Summer</option>
                            <option value="fall">Fall</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-2 select-col">
                    <div class="form-group">
                        <select class="form-control" name="semester_year" id="semester_year" data-error="Please select year." required>
                            <option value="">[please select]</option>
                            <option value="<?=date('Y')?>"><?=date('Y')?></option>
                            <option value="<?=date('Y')+1?>"><?=date('Y')+1?></option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-12">
                    <p>
                        <strong>Comments:</strong> (reasons for taking course, background in this area, etc.)
                    </p>
                    <textarea class="full-width" name="comments" id="comments"></textarea>
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-12">
                    <p><strong>REQUIRED INFORMATION: You must answer ALL SIX questions.</strong> For the purpose of the following questions, "crime" or "criminal charge" refers to any crime other than a traffic-related misdemeanor or an infraction. You must, however, include alcohol or drug offenses whether or not they were traffic related.</p>
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row list-row">
                <div class="col-md-1 list-number-col">
                    <p>1.</p>
                </div> <!-- .col -->
                <div class="col-md-5 radio-col">
                    <p>Have you ever been convicted of a crime?</p>
                </div>
                <div class="col-md-2 radio-col">
                    <div class="form-group">
                        <div class="checkbox checkbox-inline">
                            <input class="convicted-radio-button form-control" type="radio" name="convicted" id="convicted_no" value="no" data-error="Please select one." required>
                            <label for="convicted_no">NO</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="convicted-radio-button form-control" type="radio" name="convicted" id="convicted_yes" value="yes">
                            <label for="convicted_yes">YES</label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
                <div class="col-md-4 text-col">
                    <div class="form-group disabled">
                        <label for="convicted_date">if yes, date?</label>
                        <input class="month-day-year-date form-control" disabled="disabled" type="text" name="convicted_date" id="convicted_date" data-error="Please enter date." placeholder="MM/DD/YYYY">
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row list-row">
                <div class="col-md-1 list-number-col">
                    <p>2.</p>
                </div> <!-- .col -->
                <div class="col-md-9">
                    <p>Have you ever entered a plea of guilty, a plea of no contest, a plea of nolo contendere, or an Alford plea or have you received a deferred prosecution or prayer for judgment continued, to a criminal charge?</p>
                </div>
                <div class="col-md-2 radio-col">
                    <div class="form-group">
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="guilty_plea" id="guilty_plea_no" value="no" data-error="Please select one." required>
                            <label for="guilty_plea_no">NO</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="guilty_plea" id="guilty_plea_yes" value="yes">
                            <label for="guilty_plea_yes">YES</label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row list-row">
                <div class="col-md-1 list-number-col">
                    <p>3.</p>
                </div> <!-- .col -->
                <div class="col-md-9">
                    <p>Have you otherwise accepted responsibility for the commission of a crime?</p>
                </div>
                <div class="col-md-2 radio-col">
                    <div class="form-group">
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="responsible_for_crime" id="responsible_for_crime_no" value="no" data-error="Please select one." required>
                            <label for="responsible_for_crime_no">NO</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="responsible_for_crime" id="responsible_for_crime_yes" value="yes">
                            <label for="responsible_for_crime_yes">YES</label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row list-row">
                <div class="col-md-1 list-number-col">
                    <p>4.</p>
                </div> <!-- .col -->
                <div class="col-md-9">
                    <p>Do you have any criminal charges pending against you?</p>
                </div>
                <div class="col-md-2 radio-col">
                    <div class="form-group">
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="pending_crime" id="pending_crime_no" value="no" data-error="Please select one." required>
                            <label for="pending_crime_no">NO</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="pending_crime" id="pending_crime_yes" value="yes">
                            <label for="pending_crime_yes">YES</label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row list-row">
                <div class="col-md-1 list-number-col">
                    <p>5.</p>
                </div> <!-- .col -->
                <div class="col-md-9">
                    <p>Have you ever been expelled, dismissed, suspended, placed on probation, or otherwise subject to any disciplinary sanction by any school, college, or university?</p>
                </div>
                <div class="col-md-2 radio-col">
                    <div class="form-group">
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="school_discipline" id="school_discipline_no" value="no" data-error="Please select one." required>
                            <label for="school_discipline_no">NO</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="school_discipline" id="school_discipline_yes" value="yes">
                            <label for="school_discipline_yes">YES</label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row list-row">
                <div class="col-md-1 list-number-col">
                    <p>6.</p>
                </div> <!-- .col -->
                <div class="col-md-7">
                    <p>If you have ever served in the military, did you receive any type of discharge other than an honorable discharge?</p>
                </div>
                <div class="col-md-4 radio-col">
                    <div class="form-group">
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="military_discharge" id="military_discharge_no" value="no" data-error="Please select one." required>
                            <label for="military_discharge_no">NO</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="military_discharge" id="military_discharge_yes" value="yes">
                            <label for="military_discharge_yes">YES</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="military_discharge" id="military_discharge_serving" value="serving now" data-error="Please select one." required>
                            <label for="military_discharge_serving">Currently Serving</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input class="form-control" type="radio" name="military_discharge" id="military_discharge_never_served" value="never served">
                            <label for="military_discharge_never_served">Never Served</label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div> <!-- .form-group -->
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-12">
                    <p>
                        <em>If you answered "yes" to any of the six questions above, please explain the circumstances below. You must promptly notify UNCG Online in writing of any criminal charge, any disposition of a criminal charge, or any school, college, or university disciplinary action against you, or any type of military discharge other than an honorable discharge that occurs at any time after you submit this form. Your failure to do so will be grounds to deny or withdraw your registration, or to dismiss you after enrollment.</em>
                    </p>
                    <textarea class="full-width" name="crime_explanation" id="crime_explanation"></textarea>
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-12">
                    <p>
                        <strong>MEDICAL WAIVER FOR PHYSICAL ACTIVITY COURSE:</strong> I understand that this is a vigorous physical activity and contains certain elements of risk. I am aware that my enrollment in this class constitutes an assumption of risk because of the nature of the activity. UNCG, The School of Health &amp; Human Sciences, UNCG Online, and/or faculty or staff involved in this class shall not be held liable for any personal injuries or property damages incurred as a result of my participation in this class.
                    </p>
                </div> <!-- .col -->
            </div> <!-- .row -->

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

        </form>
    </div> <!-- .form-container -->
</div> <!-- auditor-form-container -->

<?php $this->template->load('_parts/contact_info_view', null);
