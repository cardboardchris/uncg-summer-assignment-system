<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<header class="container">
    <div class="row">
        <div class="col-md">
            <?php if ($state == 'new') { ?>
                <h1><span>Summer Instructional & Course Support -</span> Form G</h1>
            <?php } elseif ($state == 'print') { ?>
                <h2>Form G - <?=$user_data['first_name']?> <?=$user_data['last_name']?> - <?=$user_data['affiliation']?></h2>
                <h2>Received <?=date('m/d/y', strtotime($user_data['date']))?></h2>
            <?php } else { ?>
                <h2>Your Form G was submitted successfully. Thank you.</h2>
                <p class="hide-for-print text-center">You can print this form for your records by clicking the "Print" button at the bottom of this page.</p>
            <?php } //endif ?>
        </div>
    </div>
</header><!-- .container -->
<!-- Form -->
<div class="container form-g-<?=$state?>">
    <form class="needs-validation" action="<?=site_url('form_g')?>" method="post" accept-charset="utf-8">

<!-- hiring department -->

        <div class="form-row department-row">
            <div class="col-md">
                <div class="form-row form-group">
                    <label class="col-form-label" for="department">Hiring Dept:</label>
                    <div class="col">
                        <?php if (($state == 'new' && !isset($user_data)) || ($state == 'new' && isset($user_data) && (null == $user_data['department']))) { ?>
                            <div class="select-wrapper">
                                <select class="form-control" name="department" id="department" oninvalid="this.setCustomValidity('Please select your department.')" oninput="this.setCustomValidity('')" required>
                                    <option value="" selected="selected">- select -</option>
                                    <?php foreach ($departments as $dept_object) { ?>
                                        <option value="<?=$dept_object->abbreviation?>" data-description="<?=$dept_object->description?>" <?=set_select('department', $dept_object->abbreviation)?>><?=$dept_object->description?> (<?=$dept_object->abbreviation?>)</option>
                                    <?php } // end foreach ?>
                                </select>
                            </div><!-- select-wrapper -->
                        <?php } else { ?>
                            <input type="text" class="form-control" name="department" id="department" value="<?=$user_data['department']?>">
                        <?php } //endif
                        if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('department'); ?></div>
                        <?php } //endif ?>
                    </div><!-- .col -->
                </div><!-- .form-row form-group -->
            </div> <!-- .col-md -->
            <div class="col-md-2">
                <div class="form-row form-group">
                    <label class="col-form-label" for="org">ORG #:</label>
                    <div class="col">
                        <input type="text" class="form-control" id="org" name="org" maxlength="5" placeholder="00000" oninvalid="this.setCustomValidity('Please select your department.')" oninput="this.setCustomValidity('')" <?=(($state == 'new' && !isset($user_data)) || ($state == 'new' && isset($user_data) && (null == $user_data['org'])))?'value="'.set_value('org').'" required':'value="'.$user_data['org'].'"'?>>
                        <?php if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('org'); ?></div>
                        <?php } //endif ?>
                    </div><!-- .col -->
                </div><!-- .form-row form-group -->
            </div> <!-- .col-md-2 -->
            <div class="col-md">
                <div class="form-row form-group">
                    <label class="col-form-label" for="school">College:</label>
                    <div class="col">
                        <?php if (($state == 'new' && !isset($user_data)) || ($state == 'new' && isset($user_data) && (null == $user_data['school']))) { ?>
                            <div class="select-wrapper">
                                <select class="position-select form-control" name="school" id="school" oninvalid="this.setCustomValidity('Please select your school/college.')" oninput="this.setCustomValidity('')" required>
                                    <option value="" selected="selected">- select -</option>
                                    <option value="CAS" <?=set_select('school', 'CAS')?>>College of Arts &amp; Sciences</option>
                                    <option value="BRYAN" <?=set_select('school', 'BRYAN')?>>Bryan School of Business and Economics</option>
                                    <option value="SOE" <?=set_select('school', 'SOE')?>>School of Education</option>
                                    <option value="HHS" <?=set_select('school', 'HHS')?>>School of Health &amp; Human Sciences</option>
                                    <option value="LHC" <?=set_select('school', 'LHC')?>>Lloyd Honors College</option>
                                    <option value="NUR" <?=set_select('school', 'NUR')?>>School of Nursing</option>
                                    <option value="CVPA" <?=set_select('school', 'CVPA')?>>College of Visual &amp; Performing Arts</option>
                                    <option value="ONL" <?=set_select('school', 'ONL')?>>UNCG Online</option>
                                    <option value="DOM" <?=set_select('school', 'DOM')?>>Enrollment Management</option>
                                </select>
                            </div><!-- select-wrapper -->
                        <?php } else { ?>
                            <input type="text" class="form-control" name="school" id="school" value="<?=$user_data['school']?>">
                        <?php } //endif
                        if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('school'); ?></div>
                        <?php } //endif ?>
                    </div><!-- .col -->
                </div><!-- .form-row form-group -->
            </div> <!-- col-md -->
        </div> <!-- row -->

<!-- hiring department preparer -->

        <div class="form-row preparer-row">
            <div class="col-md">
                <div class="form-row form-group">
                    <label class="col-form-label" for="preparer-name">Prepared by:</label>
                    <div class="col">
                        <input type="text" class="form-control" name="preparer-name" id="preparer-name" placeholder="Preparer's Name" oninvalid="this.setCustomValidity('Please enter your preparer\'s name.')" oninput="this.setCustomValidity('')" <?=(($state == 'new' && !isset($user_data)) || ($state == 'new' && isset($user_data) && (null == $user_data['preparer_name'])))?'value="'.set_value('preparer-name').'" required':'value="'.$user_data['preparer_name'].'"'?>>
                        <?php if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('preparer-name'); ?></div>
                        <?php } //endif ?>
                    </div> <!-- .col -->
                </div> <!-- form-row form-group -->
            </div> <!-- col-md -->
            <div class="col-md">
                <div class="form-row form-group">
                    <label class="col-form-label" for="preparer-email">Email:</label>
                    <div class="col">
                        <input type="email" class="form-control" name="preparer-email" id="preparer-email" placeholder="Preparer's email" oninvalid="this.setCustomValidity('Please enter your preparer\'s email.')" oninput="this.setCustomValidity('')" <?=(($state == 'new' && !isset($user_data)) || ($state == 'new' && isset($user_data) && (null == $user_data['preparer_email'])))?'value="'.set_value('preparer-email').'" required':'value="'.$user_data['preparer_email'].'"'?>>
                        <?php if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('preparer-email'); ?></div>
                        <?php } //endif ?>
                    </div> <!-- .col -->
                </div> <!-- form-row form-group -->
            </div> <!-- .col-md -->
            <div class="col-md">
                <div class="form-row form-group">
                    <label class="col-form-label" for="preparer-phone">Phone:</label>
                    <div class="col">
                        <input type="tel" class="form-control phone" name="preparer-phone" id="preparer-phone" placeholder="Preparer's Phone" oninvalid="this.setCustomValidity('Please enter your preparer\'s phone number.')" oninput="this.setCustomValidity('')" <?=(($state == 'new' && !isset($user_data)) || ($state == 'new' && isset($user_data) && (null == $user_data['preparer_phone'])))?'value="'.set_value('preparer-phone').'" required':'value="'.$user_data['preparer_phone'].'"'?>>
                        <?php if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('preparer-phone'); ?></div>
                        <?php } //endif ?>
                    </div> <!-- .col -->
                </div> <!-- form-row form-group -->
            </div> <!-- .col-md -->
        </div> <!-- form-row preparer-row -->

<!-- hiring department campus address -->

        <div class="form-row office-row">
            <div class="col-md-2">
                <div class="form-row form-group">
                    <label class="col-form-label" for="campus-room">Office #:</label>
                    <div class="col">
                        <input type="text" name="campus-room" class="form-control" id="campus-room" placeholder="000" oninvalid="this.setCustomValidity('Please enter your department office\'s room number.')" oninput="this.setCustomValidity('')" <?=(($state == 'new' && !isset($user_data)) || ($state == 'new' && isset($user_data) && (null == $user_data['campus_room'])))?'value="'.set_value('campus-room').'" required':'value="'.$user_data['campus_room'].'"'?>>
                        <?php if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('campus-room'); ?></div>
                        <?php } //endif ?>
                    </div> <!-- .col -->
                </div> <!-- .form-group -->
            </div> <!-- .col -->
            <div class="col-md">
                <div class="form-row form-group">
                    <label class="col-form-label" for="campus-building">Building:</label>
                    <div class="col">
                        <input type="text" name="campus-building" class="form-control" id="campus-building" placeholder="Department building" oninvalid="this.setCustomValidity('Please enter your building.')" oninput="this.setCustomValidity('')" <?=(($state == 'new' && !isset($user_data)) || ($state == 'new' && isset($user_data) && (null == $user_data['campus_building'])))?'value="'.set_value('campus-building').'" required':'value="'.$user_data['campus_building'].'"'?>>
                        <?php if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('campus-building'); ?></div>
                        <?php } //endif ?>
                    </div> <!-- .col -->
                </div> <!-- .form-group -->
            </div> <!-- .col -->
            <div class="col-md">
                <div class="form-row form-group">
                    <label class="col-form-label" for="department-head">Dept. Chair:</label>
                    <div class="col">
                        <input type="text" name="department-head" class="form-control" id="department-head" placeholder="Dept. Chair's name" oninvalid="this.setCustomValidity('Please enter the name of your department\'s chair.')" oninput="this.setCustomValidity('')" <?=(($state == 'new' && !isset($user_data)) || ($state == 'new' && isset($user_data) && (null == $user_data['department_head'])))?'value="'.set_value('department-head').'" required':'value="'.$user_data['department_head'].'"'?>>
                        <?php if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('department-head'); ?></div>
                        <?php } //endif ?>
                    </div> <!-- .col -->
                </div> <!-- form-row form-group -->
            </div> <!-- .col -->
        </div> <!-- .campus-address-row -->

    <hr>

<!-- Employee Identity -->

        <div class="row instructions-row">
            <div class="col">
                <p>Name (as it appears on social security card)</p>
            </div><!-- .col -->
        </div> <!-- .row -->

        <div class="form-row">
            <div class="col-md-2">
                <div class="form-row form-group">
                    <label class="col-form-label" for="prefix">Prefix:</label>
                    <div class="col">
                        <?php if ($state == 'new') { ?>
                            <div class="select-wrapper">
                                <select class="position-select form-control" name="prefix" id="prefix"  oninvalid="this.setCustomValidity('Please select your preferred prefix.')" oninput="this.setCustomValidity('')" required>
                                    <option value="" selected="selected">-</option>
                                    <option value="Dr." <?=set_select('prefix', 'Dr.')?>>Dr.</option>
                                    <option value="Ms." <?=set_select('prefix', 'Ms.')?>>Ms.</option>
                                    <option value="Mr." <?=set_select('prefix', 'Mr.')?>>Mr.</option>
                                    <option value="Mx." <?=set_select('prefix', 'Mx.')?>>Mx.</option>
                                </select>
                            </div><!-- .select-wrapper -->
                        <?php } else { ?>
                            <input type="text" class="form-control" value="<?=$user_data['prefix']?>" disabled>
                        <?php } //endif
                        if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('prefix'); ?></div>
                        <?php } //endif ?>
                    </div><!-- .col -->
                </div> <!-- form-row form-group -->
            </div> <!-- col-md-2 -->
            <div class="col-md">
                <div class="form-row form-group">
                    <label class="col-form-label" for="firstname">First<span class="hide-for-screen"> Name</span>:</label>
                    <div class="col">
                        <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First name" oninvalid="this.setCustomValidity('Please enter your first name.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('firstname').'" required':'value="'.$user_data['first_name'].'" disabled'?>>
                        <?php if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('firstname'); ?></div>
                        <?php } //endif ?>
                    </div><!-- .col -->
                </div> <!-- form-row form-group -->
            </div> <!-- .col-md -->
            <div class="col-md-2">
                <div class="form-row form-group">
                    <label class="col-form-label" for="middlename">Middle:</label>
                    <div class="col">
                        <input type="text" name="middlename" class="form-control" id="middlename" placeholder="M" oninvalid="this.setCustomValidity('Please enter your middle initial.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'':'value="'.$user_data['middle_name'].'" disabled'?>>
                    </div><!-- .col -->
                </div> <!-- form-row form-group -->
            </div> <!-- .col -->
            <div class="col-md">
                <div class="form-row form-group">
                    <label class="col-form-label" for="lastname">Last<span class="hide-for-screen"> Name</span>:</label>
                    <div class="col">
                        <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last name" oninvalid="this.setCustomValidity('Please enter your last name.')" oninput="this.setCustomValidity('')"  <?=($state == 'new')?'value="'.set_value('lastname').'" required':'value="'.$user_data['last_name'].'" disabled'?>>
                        <?php if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('lastname'); ?></div>
                        <?php } //endif ?>
                    </div><!-- .col -->
                </div> <!-- form-row form-group -->
            </div> <!-- .col-md -->
        </div> <!-- .row -->

<!-- Employee ID# & Contact -->

        <div class="form-row">
            <div class="col-md">
                <div class="form-row form-group">
                    <label class="col-form-label" for="spartanid">UNCG ID #:</label>
                    <div class="col">
                        <input type="text" name="spartanid" class="form-control" id="spartanid" pattern="[0-9]{9}" maxlength="9" placeholder="000000000" oninvalid="this.setCustomValidity('Please enter a valid, 9-digit UNCG ID.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('spartanid').'" required':'value="'.$user_data['spartan_id'].'" disabled'?>>
                        <?php if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('spartanid'); ?></div>
                        <?php } //endif ?>
                    </div><!-- .col -->
                </div>
            </div> <!-- .col-md -->
            <div class="col-md-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="no-id" id="no-id" <?=($state !== 'new' && ($user_data['spartan_id'] == ''))?'checked="checked" disabled':''?>>
                    <label class="form-check-label" for="no-id">No UNCG ID#</label>
                </div>
            </div> <!-- .col-md-2 -->
            <div class="col-md">
                <div class="form-row form-group">
                    <label class="col-form-label" for="email">E-mail:</label>
                    <div class="col">
                        <input type="email" name="email" class="form-control" id="email" placeholder="username@uncg.edu" oninvalid="this.setCustomValidity('Please enter a valid email address.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('email').'" required':'value="'.$user_data['email'].'" disabled'?>>
                        <?php if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('email'); ?></div>
                        <?php } //endif ?>
                    </div><!-- .col -->
                </div>
            </div> <!-- .col -->
            <div class="col-md">
                <div class="form-row form-group">
                    <label class="col-form-label" for="phone">Phone:</label>
                        <div class="col">
                    <input type="tel" class="form-control phone" name="phone" id="phone" placeholder="Contact Phone" oninvalid="this.setCustomValidity('Please enter a valid phone number.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('phone').'" required':'value="'.$user_data['phone'].'" disabled'?>>
                        <?php if ($state == 'new') { ?>
                            <div class="form-error"><?php echo form_error('phone'); ?></div>
                        <?php } //endif ?>
                    </div><!-- .col -->
                </div>
            </div> <!-- .col -->
        </div> <!-- .row -->

        <div class="new-employee-info-container<?=($state == 'new' || ($state !== 'new' && $user_data['spartan_id'] !== ''))?' collapse':''?>">

<!-- New Hire Address -->
            <div class="new-employee-address-container">
                <div class="row instructions-row hide-for-screen">
                    <div class="col-md">
                        <hr>
                        <p>This section must be completed for new hires only</p>
                    </div><!-- .col-md -->
                </div> <!-- .row -->

                <div class="form-row form-group">
                    <label class="col-form-label" for="address">Mailing Address:</label>
                    <div class="col">
                        <input type="text" name="address" class="form-control" id="address" placeholder="Home address" oninvalid="this.setCustomValidity('Please enter your street address.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('address').'"':'value="'.$user_data['address'].'" disabled'?>>
                    </div><!-- .col -->
                </div> <!-- .form-row form-group -->

    <!-- New Hire City State Zip -->
                <div class="form-row">
                    <div class="col-md">
                        <div class="form-row form-group">
                            <label class="col-form-label" for="city">City:</label>
                            <div class="col">
                                <input type="text" name="city" class="form-control" id="city" placeholder="City" oninvalid="this.setCustomValidity('Please enter your city.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('city').'"':'value="'.$user_data['city'].'" disabled'?>>
                            </div><!-- .col -->
                        </div> <!-- .form-group -->
                    </div> <!-- .col -->
                    <div class="col-md-2">
                        <div class="form-row form-group">
                            <label class="col-form-label" for="state">State:</label>
                            <div class="col">
                                <?php if ($state == 'new') { ?>
                                    <div class="select-wrapper">
                                        <select class="form-control" name="state" id="state" oninvalid="this.setCustomValidity('Please select your state.')" oninput="this.setCustomValidity('')">
                                            <option value="" selected="selected">select</option>
                                            <option value="AL" <?=set_select('state', 'AL')?>>AL</option>
                                            <option value="AK" <?=set_select('state', 'AK')?>>AK</option>
                                            <option value="AZ" <?=set_select('state', 'AZ')?>>AZ</option>
                                            <option value="AR" <?=set_select('state', 'AR')?>>AR</option>
                                            <option value="CA" <?=set_select('state', 'CA')?>>CA</option>
                                            <option value="CO" <?=set_select('state', 'CO')?>>CO</option>
                                            <option value="CT" <?=set_select('state', 'CT')?>>CT</option>
                                            <option value="DE" <?=set_select('state', 'DE')?>>DE</option>
                                            <option value="DC" <?=set_select('state', 'DC')?>>DC</option>
                                            <option value="FL" <?=set_select('state', 'FL')?>>FL</option>
                                            <option value="GA" <?=set_select('state', 'GA')?>>GA</option>
                                            <option value="HI" <?=set_select('state', 'HI')?>>HI</option>
                                            <option value="ID" <?=set_select('state', 'ID')?>>ID</option>
                                            <option value="IL" <?=set_select('state', 'IL')?>>IL</option>
                                            <option value="IN" <?=set_select('state', 'IN')?>>IN</option>
                                            <option value="IA" <?=set_select('state', 'IA')?>>IA</option>
                                            <option value="KS" <?=set_select('state', 'KS')?>>KS</option>
                                            <option value="KY" <?=set_select('state', 'KY')?>>KY</option>
                                            <option value="LA" <?=set_select('state', 'LA')?>>LA</option>
                                            <option value="ME" <?=set_select('state', 'ME')?>>ME</option>
                                            <option value="MD" <?=set_select('state', 'MD')?>>MD</option>
                                            <option value="MA" <?=set_select('state', 'MA')?>>MA</option>
                                            <option value="MI" <?=set_select('state', 'MI')?>>MI</option>
                                            <option value="MN" <?=set_select('state', 'MN')?>>MN</option>
                                            <option value="MS" <?=set_select('state', 'MS')?>>MS</option>
                                            <option value="MO" <?=set_select('state', 'MO')?>>MO</option>
                                            <option value="MT" <?=set_select('state', 'MT')?>>MT</option>
                                            <option value="NE" <?=set_select('state', 'NE')?>>NE</option>
                                            <option value="NV" <?=set_select('state', 'NV')?>>NV</option>
                                            <option value="NH" <?=set_select('state', 'NH')?>>NH</option>
                                            <option value="NJ" <?=set_select('state', 'NJ')?>>NJ</option>
                                            <option value="NM" <?=set_select('state', 'NM')?>>NM</option>
                                            <option value="NY" <?=set_select('state', 'NY')?>>NY</option>
                                            <option value="NC" <?=set_select('state', 'NC')?>>NC</option>
                                            <option value="ND" <?=set_select('state', 'ND')?>>ND</option>
                                            <option value="OH" <?=set_select('state', 'OH')?>>OH</option>
                                            <option value="OK" <?=set_select('state', 'OK')?>>OK</option>
                                            <option value="OR" <?=set_select('state', 'OR')?>>OR</option>
                                            <option value="PA" <?=set_select('state', 'PA')?>>PA</option>
                                            <option value="RI" <?=set_select('state', 'RI')?>>RI</option>
                                            <option value="SC" <?=set_select('state', 'SC')?>>SC</option>
                                            <option value="SD" <?=set_select('state', 'SD')?>>SD</option>
                                            <option value="TN" <?=set_select('state', 'TN')?>>TN</option>
                                            <option value="TX" <?=set_select('state', 'TX')?>>TX</option>
                                            <option value="UT" <?=set_select('state', 'UT')?>>UT</option>
                                            <option value="VT" <?=set_select('state', 'VT')?>>VT</option>
                                            <option value="VA" <?=set_select('state', 'VA')?>>VA</option>
                                            <option value="WA" <?=set_select('state', 'WA')?>>WA</option>
                                            <option value="WV" <?=set_select('state', 'WV')?>>WV</option>
                                            <option value="WI" <?=set_select('state', 'WI')?>>WI</option>
                                            <option value="WY" <?=set_select('state', 'WY')?>>WY</option>
                                        </select>
                                    </div><!-- select-wrapper -->
                                <?php } else { ?>
                                    <input type="text" class="form-control" value="<?=$user_data['state']?>" disabled>
                                <?php } //endif ?>
                            </div><!-- .col -->
                        </div> <!-- .form-row form-group -->
                    </div> <!-- .col-md-2 -->
                    <div class="col-md-2">
                        <div class="form-row form-group">
                            <label class="col-form-label" for="zip">Zip:</label>
                            <div class="col">
                                <input type="text" name="zip" class="form-control" id="zip" pattern="[0-9]{5}" maxlength="5" placeholder="00000" oninvalid="this.setCustomValidity('Please enter your zip.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('zip').'"':'value="'.$user_data['zip'].'" disabled'?>>
                            </div><!-- .col -->
                        </div> <!-- .form-row form-group -->
                    </div> <!-- .col-md-2 -->
                </div> <!-- .form-row -->
            </div><!-- .new-hire-address-container -->

<!-- New Hire Citizenship -->
            <div class="new-employee-citizenship-container">
                <div class="form-row new-employee-citizenship">
                    <div class="col-md-8">
                        <div class="form-row form-group">
                            <label class="col-form-label" for="citizenship">Citizenship:</label>
                            <div class="col">
                                <?php if ($state == 'new') { ?>
                                    <div class="select-wrapper">
                                        <select class="form-control" name="citizenship" id="citizenship" oninvalid="this.setCustomValidity('Please select your citizenship.')" oninput="this.setCustomValidity('')">
                                            <option value="" selected="selected">- select -</option>
                                            <option value="Non-resident Alien">Non-resident Alien</option>
                                            <option value="Resident Alien">Resident Alien</option>
                                            <option value="Citizen">Citizen</option>
                                        </select>
                                    </div><!-- select-wrapper -->
                                <?php } else { ?>
                                    <input type="text" class="form-control" value="<?=$user_data['citizenship']?>" disabled>
                                <?php } //endif ?>
                            </div><!-- .col -->
                        </div> <!-- .form-row form-group -->
                    </div> <!-- .col-md-8 -->
                </div> <!-- .form-row -->

    <!-- New Hire Visa -->
                <div class="form-row new-employee-visa<?=($state == 'new')?' collapse':''?>">
                    <div class="col-md-8">
                        <div class="form-row form-group">
                            <label class="col-form-label" for="visa-type">Visa Type:</label>
                            <div class="col">
                                <input type="text" name="visa-type" class="form-control visa-type" id="visa-type" placeholder="Visa Type" oninvalid="this.setCustomValidity('Please select your visa type.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('visa-type').'"':'value="'.$user_data['visa_type'].'" disabled'?>>
                            </div><!-- .col -->
                        </div> <!-- .form-row form-group -->
                    </div> <!-- .col-md-8 -->
                    <div class="col-md">
                        <div class="form-row form-group">
                            <label class="col-form-label" for="visa-expires">Visa Expiration Date:</label>
                            <div class="col">
                                <input type="text" name="visa-expires" class="form-control month-day-year-date" id="visa-expires" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" maxlength="11" placeholder="mm/dd/yyyy" oninvalid="this.setCustomValidity('Please enter a valid date as mm/dd/yyyy.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('visa-expires').'"':'value="'.$user_data['visa_expires'].'" disabled'?>>
                            </div><!-- .col -->
                        </div> <!-- .form-row form-group -->
                    </div> <!-- .col-md -->
                </div> <!-- .new-employee-visa form-row -->
            </div><!-- new-employee-citizenship-container -->

        </div><!-- .new-employee-info-container -->

    <hr>

        <div class="uncg-employee-details-container">
    <!-- Employee Status -->
            <div class="form-row form-group employee-status">
                <div class="col-md-6"><span class="hide-for-print">Current permanent </span>UNCG employee:</div>
                <div class="col-md form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="employeestatus" id="employeestatus-yes" value="yes"
                        <?php if ($state !== 'new' && ($user_data['employee_status'] == 'yes')) {
                            echo 'checked="checked"';
                        } elseif ($state == 'new') {
                            echo set_radio('employeestatus', 'yes').' required';
                        }
                        if ($state !== 'new') {
                            echo ' disabled';
                        } ?>
                    >
                    <label class="form-check-label" for="employeestatus-yes">Yes</label>
                </div><!-- form-check form-check-inline -->
                <div class="col-md form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="employeestatus" id="employeestatus-no" value="no"
                        <?php if ($state !== 'new' && ($user_data['employee_status'] == 'no')) {
                            echo 'checked="checked"';
                        } elseif ($state == 'new') {
                            echo set_radio('employeestatus', 'no').' required';
                        }
                        if ($state !== 'new') {
                            echo ' disabled';
                        } ?>
                    >
                    <label class="form-check-label" for="employeestatus-no">No</label>
                </div> <!-- .form-check form-check-inline -->
            </div> <!-- form-row -->

    <!-- Employee Time -->
            <div class="form-row form-group employee-details-container employee-time<?=($state !== 'new' && ($user_data['employee_status'] == 'yes'))?'':' collapse'?>">
                <div class="col-md-6">Full or Part Time:</div>
                <div class="col-md form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="employeetime" id="employeestatus-fulltime" value="full time"
                        <?php if ($state !== 'new' && ($user_data['employee_time'] == 'full time')) {
                            echo 'checked="checked"';
                        } elseif ($state == 'new') {
                            echo set_radio('employeetime', 'full time').'';
                        }
                        if ($state !== 'new') {
                            echo ' disabled';
                        } ?>
                    >
                    <label class="form-check-label" for="employeestatus-fulltime">Full Time</label>
                </div> <!-- form-check form-check-inline -->
                <div class="col-md form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="employeetime" id="employeestatus-parttime" value="part time"
                        <?php if ($state !== 'new' && ($user_data['employee_time'] == 'part time')) {
                            echo 'checked="checked"';
                        } elseif ($state == 'new') {
                            echo set_radio('employeetime', 'part time').'';
                        }
                        if ($state !== 'new') {
                            echo ' disabled';
                        } ?>
                    >
                    <label class="form-check-label" for="employeestatus-parttime">Part Time</label>
                </div> <!-- form-check form-check-inline -->
            </div> <!-- .form-row -->
        </div><!-- .uncg-employee-details-container -->

        <div class="uncg-employee-details-container">
    <!-- Employee Salary -->
            <div class="form-row form-group employee-salary<?=($state !== 'new' && ($user_data['employee_time'] == 'full time'))?'':' collapse'?>">
                <label class="col-md-6 col-form-label">Annual Salary<span class="hide-for-screen"> if full time</span>:</label>
                <div class="col-md">
                    <input type="text" class="form-control" name="salary" id="salary" placeholder="$0.00" oninvalid="this.setCustomValidity('Please enter your annual salary.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'':'value="$'.number_format(floatval($user_data['salary'])).'" disabled'?>>
                </div> <!-- col-md .radio-buttons -->
            </div> <!-- .row -->

    <!-- Employee eClass -->
            <div class="form-row form-group employee-details-container employee-eclass<?=($state !== 'new' && ($user_data['employee_status'] == 'yes'))?'':' collapse'?>">
                <label class="col-md-6 col-form-label">eClass<span class="hide-for-print"> (can be found in Banner PEAEMPL)</span>:</label>
                <div class="col-md">
                    <?php if ($state == 'new') { ?>
                        <div class="select-wrapper">
                            <select class="form-control" name="employee-eclass" id="employee-eclass" oninvalid="this.setCustomValidity('Please select your employee eClass.')" oninput="this.setCustomValidity('')">
                                <option value="" selected="selected">- select -</option>
								<option value="">------------ EHRA Faculty ------------</option>
								<option value="AF">AF - Adjunct (Faculty)</option>
								<option value="E1">E1 - SAAO I 12 Month, leave earning</option>
								<option value="ER">ER - EHRA phased retirees</option>
								<option value="FA">FA - Temporary Academic yr. Faculty</option>
								<option value="FC">FC - Faculty 9 month, non-leave earning</option>
								<option value="FE">FE - Faculty 10 month, non-leave earning</option>
								<option value="FF">FF - Faculty 11 month, leave earning</option>
								<option value="FG">FG - Faculty 12 month, leave earning</option>
								<option value="FO">FO - Other temporary faculty</option>
								<option value="FP">FP - Faculty permanent part-time</option>
								<option value="FS">FS - Temporary semester faculty</option>
								<option value="L1">L1 - Librarians 12 month, leave earning</option>
								<option value="RF">RF - Retired (Faculty) working</option>
								<option value="">----------- EHRA Non-Faculty -----------</option>
								<option value="AJ">AJ - Adjunct (EHRA)</option>
								<option value="E2">E2 - SAAO II 12 Month, leave earning</option>
								<option value="EA">EA - EHRA 10 month, leave earning</option>
								<option value="EB">EB - EHRA 11 month, leave earning</option>
								<option value="EC">EC - EHRA Permanent part-time</option>
								<option value="ED">ED - EHRA 9 month non-leave earning</option>
								<option value="EN">EN - EHRA 9 month leave earning</option>
								<option value="EP">EP - EHRA 12 month, leave earning</option>
								<option value="ET">ET - Temporary EHRA (non faculty)</option>
								<option value="RE">RE - Retired (EHRA) working</option>
                            </select>
                        </div><!-- .select-wrapper -->
                    <?php } else { ?>
                        <input type="text" class="form-control" name="employee-eclass" id="employee-eclass" value="<?=$user_data['employee_eclass']?>" disabled>
                    <?php } //endif ?>
                </div> <!-- col-md -->
            </div> <!-- .form-row -->
        </div><!-- .uncg-employee-details-container -->

    <hr>

        <div class="uncg-student-details-container">
    <!-- Student Status -->
            <div class="form-row form-group student-status">
                <div class="col-md-6"><span class="hide-for-print">Current </span>UNCG student:</div>
                <div class="col-md form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="studentstatus" id="studentstatus-yes" value="yes"
                        <?php if ($state !== 'new' && ($user_data['student_status'] == 'yes')) {
                            echo 'checked="checked"';
                        } elseif ($state == 'new') {
                            echo set_radio('studentstatus', 'yes').' required';
                        }
                        if ($state !== 'new') {
                            echo ' disabled';
                        } ?>
                    >
                    <label class="form-check-label" for="studentstatus-yes">Yes</label>
                </div><!-- form-check form-check-inline -->
                <div class="col-md form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="studentstatus" id="studentstatus-no" value="no"
                        <?php if ($state !== 'new' && ($user_data['student_status'] == 'no')) {
                            echo 'checked="checked"';
                        } elseif ($state == 'new') {
                            echo set_radio('studentstatus', 'no').' required';
                        }
                        if ($state !== 'new') {
                            echo ' disabled';
                        } ?>
                    >
                    <label class="form-check-label" for="studentstatus-no">No</label>
                </div> <!-- .form-check form-check-inline -->
            </div> <!-- row -->

    <!-- Student Type -->
            <div class="form-row form-group student-details-container student-type<?=($state !== 'new' && ($user_data['student_status'] == 'yes'))?'':' collapse'?>">
                <div class="col-md-6">Grad<span class="hide-for-print">uate</span> or Undergrad<span class="hide-for-print">uate</span>:</div>
                <div class="col-md form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="studenttype" id="studenttype-grad" value="grad"
                        <?php if ($state !== 'new' && ($user_data['student_type'] == 'grad')) {
                            echo 'checked="checked"';
                        } elseif ($state == 'new') {
                            echo set_radio('studenttype', 'grad');
                        }
                        if ($state !== 'new') {
                            echo ' disabled';
                        } ?>
                    >
                    <label class="form-check-label" for="studenttype-grad">Grad<span class="hide-for-print">uate</span></label>
                </div> <!-- form-check form-check-inline -->
                <div class="col-md form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="studenttype" id="studenttype-undergrad" value="undergrad"
                        <?php if ($state !== 'new' && ($user_data['student_type'] == 'undergrad')) {
                            echo 'checked="checked"';
                        } elseif ($state == 'new') {
                            echo set_radio('studenttype', 'undergrad');
                        }
                        if ($state !== 'new') {
                            echo ' disabled';
                        } ?>
                    >
                    <label class="form-check-label" for="studenttype-undergrad">Undergrad<span class="hide-for-print">uate</span></label>
                </div> <!-- form-check form-check-inline -->
            </div> <!-- form-row -->

    <!-- Student Time -->
            <div class="form-row form-group student-details-container student-time<?=($state !== 'new' && ($user_data['student_status'] == 'yes'))?'':' collapse'?>">
                <div class="col-md-6">Full or Part Time:</div>
                <div class="col-md form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="studenttime" id="studentstatus-fulltime" value="full time"
                        <?php if ($state !== 'new' && ($user_data['student_time'] == 'full time')) {
                            echo 'checked="checked"';
                        } elseif ($state == 'new') {
                            echo set_radio('studenttime', 'full time');
                        }
                        if ($state !== 'new') {
                            echo ' disabled';
                        } ?>
                    >
                    <label class="form-check-label" for="studentstatus-fulltime">Full<span class="hide-for-print"> Time</span></label>
                </div> <!-- form-check form-check-inline -->
                <div class="col-md form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="studenttime" id="studentstatus-parttime" value="part time"
                        <?php if ($state !== 'new' && ($user_data['student_time'] == 'part time')) {
                            echo 'checked="checked"';
                        } elseif ($state == 'new') {
                            echo set_radio('studenttime', 'part time');
                        }
                        if ($state !== 'new') {
                            echo ' disabled';
                        } ?>
                    >
                    <label class="form-check-label" for="studentstatus-parttime">Part<span class="hide-for-print"> Time</span></label>
                </div> <!-- form-check form-check-inline -->
            </div> <!-- .form-row -->
        </div><!-- uncg-student-details-container -->

        <div class="uncg-student-details-container">
    <!-- Student eClass -->
            <div class="form-row form-group student-details-container student-eclass<?=($state !== 'new' && ($user_data['student_status'] == 'yes'))?'':' collapse'?>">
                <label class="col-md-6 col-form-label">eClass<span class="hide-for-print"> (can be found in Banner PEAEMPL)</span>:</label>
                <div class="col-md">
                    <?php if ($state == 'new') { ?>
                        <div class="select-wrapper">
                            <select class="form-control" name="student-eclass" id="student-eclass" oninvalid="this.setCustomValidity('Please select your student eClass.')" oninput="this.setCustomValidity('')">
                                <option value="" selected="selected">- select -</option>
                                <option value="GF" <?=set_select('student-eclass', 'GF')?>>GF - Graduate flat-pay</option>
                                <option value="GH" <?=set_select('student-eclass', 'GH')?>>GH - Graduate hourly</option>
                                <option value="PH" <?=set_select('student-eclass', 'PH')?>>PH - Pre-Hire Student/Graduate Assistant</option>
                                <option value="UF" <?=set_select('student-eclass', 'UF')?>>UF - Undergraduate Flat-pay</option>
                                <option value="UH" <?=set_select('student-eclass', 'UH')?>>UH - Undergraduate/Graduate Hourly</option>
                                <option value="WG" <?=set_select('student-eclass', 'WG')?>>WG - Graduate Work Study Students</option>
                                <option value="WS" <?=set_select('student-eclass', 'WS')?>>WS - Work Study Students</option>
                            </select>
                        </div><!-- select-wrapper -->
                    <?php } else { ?>
                        <input type="text" class="form-control" name="student-eclass" id="student-eclass" value="<?=$user_data['student_eclass']?>" disabled>
                    <?php } //endif ?>
                </div> <!-- col-md -->
            </div> <!-- .form-row -->

    <!-- Student graduation date -->
            <div class="form-row student-details-container student-grad-date<?=($state !== 'new' && ($user_data['student_status'] == 'yes'))?'':' collapse'?>">
                <label class="col-md-6 col-form-label">Anticipated Graduation date:</label>
                <div class="col-md form-row form-group">
                    <label class="col-form-label" for="grad-month">Month:</label>
                    <div class="col">
                        <input type="text" class="form-control" name="grad-month" id="grad-month" pattern="[0-9]{2}" maxlength="2" placeholder="00" oninvalid="this.setCustomValidity('Please enter your anticipated graduation month.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('grad-month').'"':'value="'.$user_data['grad_month'].'" disabled'?>>
                    </div><!-- .col -->
                </div> <!-- col-md form-row form-group -->
                <div class="col-md form-row form-group">
                    <label class="col-form-label" for="grad-year">Year:</label>
                    <div class="col">
                        <input type="text" name="grad-year" class="form-control" id="grad-year" size="2" pattern="[0-9]{4}" maxlength="4" placeholder="0000" oninvalid="this.setCustomValidity('Please enter your anticipated graduation year.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('grad-year').'"':'value="'.$user_data['grad_year'].'" disabled'?>>
                    </div><!-- .col -->
                </div> <!-- .col-md form-row form-group -->
            </div> <!-- row -->
        </div><!-- uncg-student-details-container -->

    <hr>

        <div class="row instructions-row hide-for-print">
            <div class="col-md">
                <p>Summer Assignment Information<?=($state !== 'print')?' - All Must Complete':''?></p>
            </div><!-- .col-md -->
        </div>

<!-- Courses -->
        <div class="courses-container validation-ok-border">


			<div class="form-row total-row justify-content-start hidden-xs">
				<div class="col text-cell" style="padding: 5px;">
					<p style="text-align: left;">Summer Session I</p>
				</div>
			</div>

			<!-- first session courses (1-3) -->
            <?php
                $session_terms = array(1, 2, 5, 7);
                $count = 1;
                $hidden_courses = false;
                foreach ($all_courses as $course) {
                    // display the course if its term is in this session AND this is a new form or a success display or the course campus matches the current filter
                    if ( in_array($course['course_term'], $session_terms) && (($state == 'new') || ($state == 'success') || (strpos($campus, $course['course_campus']) !== false))) {
                        // for this is a new form, load all 3 course rows
                        $data_array = array(
                            'course_count' => $count,
                            'session' => 1,
                            'session_terms' => $session_terms,
                            'course_data' => $course
                        );
                        $this->template->load('_parts/form_g_course_inputs_view', null, $data_array);
                    } elseif ( in_array($course['course_term'], $session_terms) && (strpos($campus, $course['course_campus']) == false)) {
                        $hidden_courses = true;
                    }
                    $count++;
                } // end foreach ?>

    <!-- second session courses (4-6) -->

			<div class="form-row total-row justify-content-start hidden-xs">
				<div class="col text-cell" style="padding: 5px;">
					<p style="text-align: left;">Summer Session II</p>
				</div>
			</div>

			<?php
                $session_terms = array(3, 4, 6, 8);
                $count = 1;
                $hidden_courses = false;
                foreach ($all_courses as $course) {
                    // display the course if its term is in this session AND this is a new form or a success display or the course campus matches the current filter
                    if ( (in_array($course['course_term'], $session_terms)) && (($state == 'new') || ($state == 'success') || (strpos($campus, $course['course_campus']) !== false)) ) {
                        // for this is a new form, load all 3 course rows
                        $data_array = array(
                            'course_count' => $count,
                            'session' => 2,
                            'session_terms' => $session_terms,
                            'course_data' => $course
                        );
                        $this->template->load('_parts/form_g_course_inputs_view', null, $data_array);
                    } elseif ( in_array($course['course_term'], $session_terms) && (strpos($campus, $course['course_campus']) == false)) {
                        $hidden_courses = true;
                    }
                    $count++;
                } // end foreach ?>

        </div> <!-- courses-container -->

        <div class="form-g-info-error begin-hidden">
            <p class="danger text-center">You must enter at least one assignment.</p>
        </div><!-- .form-g-info-error -->

    <!-- Comments -->
        <div class="form-row form-group comments-row">
            <label class="col-form-label">Comments:</label>
            <div class="col-md">
                <textarea name="comments" id="comments"><?=($state !== 'new' && ($user_data['comments'] !== ''))?$user_data['comments']:''?></textarea>
            </div><!-- col-md -->
        </div> <!-- .row form-group -->

    <!-- Submit row -->
        <div class="form-row submit-row hide-for-print justify-content-center">
            <?php if ($state !== 'print') { ?>
                <div class="col-12 col-md-3">
                    <button type="button" class="btn btn-outline-secondary btn-block print-button">Print</button>
	                <p style="text-align: center; font-size: 11px; margin-top: 8px; line-height: 1;">Please note that printing does not save your data.<br>Your data will not be saved unless you submit.</p>
                </div><!-- col-12 col-md-3 -->
            <?php } // endif
            if ($state == 'new') { ?>
                <div class="col-12 col-md-3">
                    <button class="btn btn-primary btn-block submit-button" type="submit" data-disable="true">Submit</button>
                </div><!-- col-12 col-md-3 -->
            <?php } elseif ($state == 'success' && ($user_data['employee_status'] == 'no' && $user_data['student_status'] == 'no')) { ?>
                <div class="col-12 col-md-3">
                    <a class="btn btn-success btn-block new-hire-info-button" href="<?=base_url()?>new-hire-next-steps.html" target="_blank">New Hire Next Steps</a>
                </div><!-- col-12 col-md-3 -->
            <?php } // endif
            if ($state == 'new' && isset($user_data)) { ?>
                <div class="col-12 col-md-3">
                    <a class="btn btn-warning btn-block" href="<?=site_url('form_g/clear')?>">Clear all fields</a>
                </div><!-- col-12 col-md-3 -->
            <?php } // endif
            if ($state !== 'new' && $state !== 'print') { ?>
                <div class="col-12 col-md-3">
                    <a class="btn btn-info btn-block" href="<?=site_url('form_g')?>">Begin another Form G</a>
                </div><!-- col-12 col-md-3 -->
            <?php } // endif ?>
        </div> <!-- .row .submit-row hide-for-print justify-content-center -->
    </form>
</div> <!-- .container -->

<?php if ($state !== 'print') {
    $this->template->load('_parts/contact_info_view');
}
