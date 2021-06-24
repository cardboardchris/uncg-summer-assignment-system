<div class="form-row course session-<?=$session?> course-<?php echo $course_count; ?>">

    <div class="col-md-auto course-term">
        <div class="form-row">
            <div class="col-6 col-md-12 header-cell">
                <p>Term</p>
            </div><!-- col-6 col-md-12 header-cell -->
            <div class="col-6 col-md-12">
                <?php if ($state == 'new') { ?>
                    <select class="form-control hide-options-for-print" name="course-<?php echo $course_count; ?>-term" id="course-<?php echo $course_count; ?>-term" oninvalid="this.setCustomValidity('Please select a part of term for this course.')" oninput="this.setCustomValidity('')">
                        <option value="" selected="selected">-</option>
                        <?php foreach ($session_terms as $part_of_term) { ?>
                            <option value="<?=$part_of_term?>" <?=set_select('course-'.$course_count.'-term', $part_of_term)?>>&nbsp;<?=$part_of_term?> (<?=date('n/j/y', $terms[$part_of_term]['start'])?> - <?=date('n/j/y', $terms[$part_of_term]['end'])?>)</option>
                        <?php } // end foreach ?>
                    </select>
                <?php } else { ?>
                    <input type="text" class="form-control" name="course-<?php echo $course_count; ?>-term" id="course-<?php echo $course_count; ?>-term" value="<?=$course_data['course_term']?>" disabled>
                <?php } //endif ?>
            </div> <!-- .col -->
        </div> <!-- .form-row -->
    </div><!-- .col-md-auto -->

    <div class="col-md-auto course-position">
        <div class="form-row">
            <div class="col-6 col-md-12 header-cell">
                <p>Position</p>
            </div><!-- col-6 col-md-12 header-cell -->
            <div class="col-6 col-md-12">
                <?php if ($state == 'new') { ?>
                    <select class="form-control hide-options-for-print" name="course-<?php echo $course_count; ?>-position" id="course-<?php echo $course_count; ?>-position" oninvalid="this.setCustomValidity('Please select a position for this course.')" oninput="this.setCustomValidity('')">
                        <option data-course-specific="false" value="" <?=set_select('course-'.$course_count.'-position', '')?> selected="selected">- select -</option>
                        <?php foreach ($positions as $position_object) { ?>
                            <option data-course-specific="<?=($position_object->course_specific)?'true':'false'?>" value="<?=$position_object->position?>" <?=set_select('course-'.$course_count.'-position', $position_object->position)?>><?=$position_object->description?></option>
                        <?php } // end foreach ?>
                    </select>
                <?php } else { ?>
                    <input type="text" class="form-control" value="<?=$course_data['course_position']?>" disabled>
                <?php } //endif ?>
            </div> <!-- .col-6 col-md-12 -->
        </div> <!-- .form-row course-position -->
    </div> <!-- .col-md-auto -->

    <div class="col-md-auto course-campus">
        <div class="form-row">
            <div class="col-6 col-md-12 header-cell">
                <p>Campus</p>
            </div><!-- col-6 col-md-12 header-cell -->
            <div class="col-6 col-md-12">
                <?php if ($state == 'new') { ?>
                    <select class="form-control hide-options-for-print" name="course-<?php echo $course_count; ?>-campus" id="course-<?php echo $course_count; ?>-campus" oninvalid="this.setCustomValidity('Please select a campus code for this course.')" oninput="this.setCustomValidity('')">
                        <option value="" selected="selected">-</option>
                        <option value="G" <?=set_select('course-'.$course_count.'-campus', 'G')?>>G - Greensboro (Main)</option>
                        <option value="O" <?=set_select('course-'.$course_count.'-campus', 'O')?>>O - Online</option>
                        <option value="S" <?=set_select('course-'.$course_count.'-campus', 'S')?>>S - Off-Site</option>
                    </select>
                <?php } else { ?>
                    <input type="text" class="form-control" name="course-<?php echo $course_count; ?>-campus" value="<?=$course_data['course_campus']?>" disabled>
                <?php } //endif ?>
            </div><!-- col-6 col-md-12 -->
        </div> <!-- .form-row course-campus -->
    </div> <!-- .col-md-auto -->

    <div class="col-md-auto course-crn">
        <div class="form-row">
            <div class="col-6 col-md-12 header-cell">
                <p>CRN</p>
            </div><!-- col-6 col-md-12 header-cell -->
            <div class="col-6 col-md-12">
                <input type="text" class="form-control" name="course-<?php echo $course_count; ?>-crn" id="course-<?php echo $course_count; ?>-crn" pattern="[0-9]{5}" maxlength="5" placeholder="00000" oninvalid="this.setCustomValidity('Please enter the CRN for this course.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('course-'.$course_count.'-crn').'"':'value="'.$course_data['course_crn'].'" disabled'?>>
            </div> <!-- .col-6 col-md-12 -->
        </div> <!-- .form-row course-crn -->
    </div> <!-- .col-md-auto -->

    <div class="col-md-auto course-subject">
        <div class="form-row">
            <div class="col-6 col-md-12 header-cell">
                <p>Subject</p>
            </div><!-- col-6 col-md-12 header-cell -->
            <div class="col-6 col-md-12">
                <input type="text" class="form-control" name="course-<?php echo $course_count; ?>-subject" id="course-<?php echo $course_count; ?>-subject" pattern="[A-Za-z]{3}" maxlength="3" placeholder="AAA" oninvalid="this.setCustomValidity('Please enter the subject for this course.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('course-'.$course_count.'-subject').'"':'value="'.$course_data['course_subject'].'" disabled'?>>
            </div> <!-- .col-6 col-md-12 -->
        </div> <!-- .form-row course-subject -->
    </div> <!-- .col-md-auto -->

    <div class="col-md-auto course-number">
        <div class="form-row">
            <div class="col-6 col-md-12 header-cell">
                <p>Number</p>
            </div><!-- col-6 col-md-12 header-cell -->
            <div class="col-6 col-md-12">
                <input type="text" class="form-control" name="course-<?php echo $course_count; ?>-number" id="course-<?php echo $course_count; ?>-number" maxlength="4" placeholder="000A" oninvalid="this.setCustomValidity('Please enter the CRN for this course.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('course-'.$course_count.'-number').'"':'value="'.$course_data['course_number'].'" disabled'?>>
            </div> <!-- .col-6 col-md-12 -->
        </div> <!-- .form-row course-number -->
    </div> <!-- .col-md-auto -->

    <div class="col-md-auto course-section">
        <div class="form-row">
            <div class="col-6 col-md-12 header-cell">
                <p>Section</p>
            </div><!-- col-6 col-md-12 header-cell -->
            <div class="col-6 col-md-12">
                <input type="text" class="form-control" name="course-<?php echo $course_count; ?>-section" id="course-<?php echo $course_count; ?>-section" maxlength="4" placeholder="00" oninvalid="this.setCustomValidity('Please enter the section for this course.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('course-'.$course_count.'-section').'"':'value="'.$course_data['course_section'].'" disabled'?>>
            </div> <!-- .col-6 col-md-12 -->
        </div> <!-- .form-row course-section -->
    </div> <!-- .col-md-auto -->

    <div class="col-md-auto course-credits">
        <div class="form-row">
            <div class="col-6 col-md-12 header-cell">
                <p>Credit<br>hours</p>
            </div><!-- col-6 col-md-12 header-cell -->
            <div class="col-6 col-md-12">
                <input type="text" class="form-control" name="course-<?php echo $course_count; ?>-credits" id="course-<?php echo $course_count; ?>-credits" maxlength="2" placeholder="0" oninvalid="this.setCustomValidity('Please enter the number of credits for this course.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('course-'.$course_count.'-credits').'"':'value="'.$course_data['course_credits'].'" disabled'?>>
            </div> <!-- .col-6 col-md-12 -->
        </div> <!-- .form-row course-credits -->
    </div> <!-- .col-md-auto -->

    <div class="col-md-auto course-hours">
        <div class="form-row">
            <div class="col-6 col-md-12 header-cell">
                <p>Hours/wk<br>worked</p>
            </div><!-- col-6 col-md-12 header-cell -->
            <div class="col-6 col-md-12">
                <input type="text" class="form-control" name="course-<?php echo $course_count; ?>-hours" id="course-<?php echo $course_count; ?>-hours" <?php echo $course_count; ?>-credit-hours" maxlength="3" placeholder="0" oninvalid="this.setCustomValidity('Please enter the hourse per week worked for this course.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('course-'.$course_count.'-hours').'"':'value="'.$course_data['course_hours'].'" disabled'?>>
            </div> <!-- .col-6 col-md-12 -->
        </div> <!-- .form-row course-hours -->
    </div> <!-- .col-md-auto -->

    <div class="col-md-auto course-stipend">
        <div class="form-row">
            <div class="col-6 col-md-12 header-cell">
                <p>Stipend<br>amount</p>
            </div><!-- col-6 col-md-12 header-cell -->
            <div class="col-6 col-md-12">
                <input type="text" class="form-control stipend-input-session-<?=$session?>" name="course-<?php echo $course_count; ?>-stipend" id="course-<?php echo $course_count; ?>-stipend" <?php echo $course_count; ?>-credit-hours" placeholder="$0.00" oninvalid="this.setCustomValidity('Please enter the stipend amount for this course.')" oninput="this.setCustomValidity('')" <?=($state == 'new')?'value="'.set_value('course-'.$course_count.'-stipend').'"':'value="'.$course_data['course_stipend'].'" disabled'?>>
            </div> <!-- .col-6 col-md-12 -->
        </div> <!-- .form-row course-stipend -->
    </div> <!-- .col-md-auto -->

</div> <!-- .row .course-<?php echo $course_count; ?> -->

<?php if ($state == 'print' && isset($course_data['course_note']) && $course_data['course_note'] !== '') { ?>
    <div class="cell form-group course-note-print">
        <div class="row">
            <div class="col-lg-auto">
                <label>Note:</label>
            </div><!-- .col-lg-auto -->
            <div class="col-lg">
                <textarea class="note-area" name="course_<?=$course_count?>_note" id="course_<?=$course_count?>_note"><?=$course_data['course_note']?></textarea>
            </div><!-- .col-lg-auto -->
        </div><!-- .row -->
    </div><!-- cell course-note -->
<?php } // endif ?>
