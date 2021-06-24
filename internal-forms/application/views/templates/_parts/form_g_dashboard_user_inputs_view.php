<!-- department and preparer -->
<div class="row fields-row user-department">
    <div class="col-md-3 form-group">
        <label>Hiring Dept:</label><?php echo form_input('department', $user->department, 'size="2" readonly'); ?>
    </div><!-- form-group col-md-3 -->
    <div class="col-md-3 form-group">
        <label>ORG #:</label><?php echo form_input('org', $user->org, 'size="2" readonly'); ?>
    </div><!-- form-group col-md-3 -->
    <div class="col-md-3 form-group">
        <label>Dept Chair:</label><?php echo form_input('department_head', $user->department_head, 'size="2" readonly'); ?>
    </div><!-- form-group col-md-3 -->
    <div class="col-md-3 form-group">
        <label>School/College:</label><?php echo form_input('school', $user->school, 'size="2" readonly'); ?>
    </div><!-- form-group col-md-3 -->
</div><!-- row -->
<div class="row fields-row user-preparer">
    <div class="col-md-4 form-group">
        <label>Prepared by:</label><?php echo form_input('preparer_name', $user->preparer_name, 'size="2" readonly'); ?>
    </div><!-- form-group col-md-4 -->
    <div class="col-md-4 form-group">
        <label>Preparer's email:</label><?php echo form_input('preparer_email', $user->preparer_email, 'size="2" readonly'); ?>
    </div><!-- form-group col-md-4 -->
    <div class="col-md-4 form-group">
        <label>Preparer's phone:</label><?php echo form_input('preparer_phone', $user->preparer_phone, 'size="2" readonly'); ?>
    </div><!-- .col-md-4 -->
</div><!-- row -->

<!-- hiring department address -->
<div class="row fields-row user-campus-address">
    <div class="col-md-6 form-group">
        <label>Office Address Room #:</label><?php echo form_input('campus_room', $user->campus_room, 'size="2" readonly'); ?>
    </div><!-- col-md-6 form-group -->
    <div class="col-md-6 form-group">
        <label>Building:</label><?php echo form_input('campus_building', $user->campus_building, 'size="2" readonly'); ?>
    </div><!-- col-md-6 form-group -->
</div><!-- row -->

<hr>

<!-- name and contact -->
<div class="row fields-row user-name">
    <div class="col-md-2 form-group">
        <label>Prefix:</label><?php echo form_input('prefix', $user->prefix, 'size="2" readonly'); ?>
    </div><!-- .col-md-2 form-group -->
    <div class="col-md-3 form-group">
        <label>First Name:</label><?php echo form_input('first_name', $user->first_name, 'size="2" readonly'); ?>
    </div><!-- .col-md-3 form-group -->
    <div class="col-md-3 form-group">
        <label>Middle Name:</label><?php echo form_input('middle_name', $user->middle_name, 'size="2" readonly'); ?>
    </div><!-- .col-md-3 form-group -->
    <div class="col-md-4 form-group">
        <label>Last Name:</label><?php echo form_input('last_name', $user->last_name, 'size="2" readonly'); ?>
    </div><!-- .col-md-4 form-group -->
</div><!-- row -->
<div class="row fields-row user-contact">
    <div class="col-md-4 form-group">
        <label>UNCG ID:</label><?php echo form_input('spartan_id', $user->spartan_id, 'size="2" maxlength="9" readonly'); ?>
    </div><!-- .col-md-4 form-group -->
    <div class="col-md-4 form-group">
        <label>Email:</label><?php echo form_input('email', $user->email, 'size="2" readonly'); ?>
    </div><!-- .col-md-4 form-group -->
    <div class="col-md-4 form-group">
        <label>Phone:</label><?php echo form_input('phone', $user->phone, 'size="2" readonly'); ?>
    </div><!-- .col-md-4 form-group -->
</div><!-- row -->

<hr>

<!-- uncg employee info -->
<?php if ($user->employee_status == 'yes') { ?>
    <div class="row fields-row">
        <div class="col-md-3 form-group">
            <label>Employee Type:</label><?php echo form_input('employee_type', $user->employee_type, 'size="2" readonly'); ?>
        </div><!-- col-md-3 form-group -->
        <div class="col-md-3 form-group">
            <label>Employee Time:</label><?php echo form_input('employee_time', $user->employee_time, 'size="2" readonly'); ?>
        </div><!-- col-md-3 form-group -->
        <div class="col-md-3 form-group">
            <label>eClass:</label><?php echo form_input('employee_eclass', $user->employee_eclass, 'size="2" readonly'); ?>
        </div><!-- col-md-3 form-group -->
        <?php if ($user->employee_time == 'full time') { ?>
            <div class="col-md-3 form-group">
                <label>Salary:</label><?php echo form_input('salary', '$'.number_format($user->salary, 2, '.', ','), 'size="2" readonly'); ?>
            </div><!-- col-md-3 form-group -->
        <?php } //endif ?>
    </div><!-- row -->
<?php } //endif ?>

<!-- uncg student info -->
<?php if ($user->student_status == 'yes') { ?>
    <hr>
    <div class="row fields-row">
        <div class="col-md-3 form-group">
            <label>Student Type:</label><?php echo form_input('student_type', $user->student_type, 'size="2" readonly'); ?>
        </div><!-- col-md-3 form-group -->
        <div class="col-md-3 form-group">
            <label>Student Time:</label><?php echo form_input('student_time', $user->student_time, 'size="2" readonly'); ?>
        </div><!-- col-md-3 form-group -->
        <div class="col-md-3 form-group">
            <label>eClass:</label><?php echo form_input('student_eclass', $user->student_eclass, 'size="2" readonly'); ?>
        </div><!-- col-md-3 form-group -->
        <div class="col-md-3 form-group">
            <label>grad date:</label><?php echo form_input('grad_month', $user->grad_month, 'size="2" class="grad-date grad-month" readonly'); ?><span>/</span><?php echo form_input('grad_year', $user->grad_year, 'size="4" class="grad-date" readonly'); ?>
        </div><!-- col-md-3 form-group -->
    </div><!-- row -->
<?php } //endif

if ($user->employee_status == 'no' && $user->student_status == 'no') { ?>
    <div class="row fields-row user-new-hire-address">
        <div class="col-md-3 form-group">
            <label>Address:</label><?php echo form_input('address', $user->address, 'size="2" readonly'); ?>
        </div><!-- col-md-3 form-group -->
        <div class="col-md-3 form-group">
            <label>City:</label><?php echo form_input('city', $user->city, 'size="2" readonly'); ?>
        </div><!-- col-md-3 form-group -->
        <div class="col-md-3 form-group">
            <label>State:</label><?php echo form_input('state', $user->state, 'size="2" readonly'); ?>
        </div><!-- col-md-3 form-group -->
        <div class="col-md-3 form-group">
            <label>Zip:</label><?php echo form_input('zip', $user->zip, 'size="2" readonly'); ?>
        </div><!-- col-md-3 form-group -->
    </div><!-- .row -->
    <div class="row fields-row user-new-hire-citizenship">
        <div class="col-md-4 form-group">
            <label>Citizenship:</label><?php echo form_input('citizenship', $user->citizenship, 'size="2" readonly'); ?>
        </div><!-- col-md-4 form-group -->
        <div class="col-md-4 form-group">
            <label>Visa Type:</label><?php echo form_input('visa_type', $user->visa_type, 'size="2" readonly'); ?>
        </div><!-- col-md-4 form-group -->
        <div class="col-md-4 form-group">
            <label>Visa Expires:</label><?php echo form_input('visa_expires', $user->visa_expires, 'size="2" readonly'); ?>
        </div><!-- col-md-4 form-group -->
    </div><!-- row -->
<?php } //endif ?>
<div class="row fields-row user-comments">
    <div class="col-md-12 form-group">
        <label>Comments:</label><?php echo form_input('comments', $user->comments, 'readonly'); ?>
    </div><!-- .col-md-12 -->
</div><!-- row -->
