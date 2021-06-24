<?php
$non_instructor_course_specific_positions = array(
    'Lab Assistant',
    'Grad Assistant',
    'Teaching Assistant',
    'Sr. Teaching Assistant'
);
?>
<div class="row course verified-course course-<?php echo $course_count; ?> <?=($course_count == 1 || $course->course_position !== 'Instructor')?'show-headers':''?>">
    <input type="hidden" name="course-<?=$course_count?>-previously-accepted" value="<?=$accepted?>">
    <div class="col-xs-12">
        <div class="row">
            <?php if ($course->course_position !== 'Instructor') { ?>
                <div class="col-md-4 course-position">
                    <div class="row table-row">
                        <div class="col-xs-12 cell header-cell first-cell">
                            <p>Position</p>
                        </div>
                        <div class="col-xs-12 cell input-cell form-group first-cell">
                            <p><?=$course->course_position?></p>
                        </div>
                    </div> <!-- .row -->
                </div> <!-- .col-md-1 -->
            <?php } // endif ?>
            <?php if (!empty($course->course_subject) && !empty($course->course_number)) { ?>
                <div class="col-md-2 course-number">
                    <div class="row table-row">
                        <div class="col-xs-12 cell header-cell <?=($course->course_position == 'Instructor')?'first-cell':''?>">
                            <p>Course Number</p>
                        </div>
                        <div class="col-xs-12 cell input-cell <?=($course->course_position == 'Instructor')?'first-cell':''?> form-group">
                            <input type="hidden" class="course-number-only" value="<?php echo $course->course_number; ?>">
                            <input type="text" name="course-<?php echo $course_count; ?>-number" id="course-<?php echo $course_count; ?>-number" value="<?=$course->course_subject.$course->course_number?>" readonly>
                        </div> <!-- .col-xs-12 -->
                    </div> <!-- .row -->
                </div> <!-- .col-md-2 -->
            <?php } // endif ?>
            <?php if (!empty($course->course_section)) { ?>
                <div class="col-md-1 course-section">
                    <div class="row table-row">
                        <div class="col-xs-12 cell header-cell">
                            <p>Section</p>
                        </div>
                        <div class="col-xs-12 cell input-cell form-group">
                            <input type="text" name="course-<?php echo $course_count; ?>-section" id="course-<?php echo $course_count; ?>-section" value="<?=$course->course_section?>" readonly>
                        </div>
                    </div> <!-- .row -->
                </div> <!-- .col-md-1 -->
            <?php } // endif ?>
            <div class="col-md-1 course-campus">
                <div class="row table-row">
                    <div class="col-xs-12 cell header-cell">
                        <p>Campus</p>
                    </div>
                    <div class="col-xs-12 cell input-cell form-group">
                        <input type="text" name="course-<?php echo $course_count; ?>-campus" id="course-<?php echo $course_count; ?>-campus" value="<?=$course->course_campus?>" readonly>
                    </div>
                </div> <!-- .row -->
            </div> <!-- .col-md-2 -->
            <div class="col-md-2 course-accept">
                <div class="row table-row">
                    <div class="col-xs-12 cell header-cell">
                        <p>Accept this assignment</p>
                    </div>
                    <div class="col-xs-12 cell input-cell">
                        <div class="form-group">
                            <div class="checkbox checkbox-inline">
                                <input type="radio" class="form-control" name="course-<?=$course_count?>-accept" id="course-<?=$course_count?>-accept-yes" value="yes" <?=($course->course_accept == 'yes')?'checked="checked"':''?>  <?=($accepted)?'disabled':''?> required>
                                <label for="course-<?=$course_count?>-accept-yes" class="radio-inline">Yes</label>
                            </div>
                            <div class="checkbox checkbox-inline">
                                <input type="radio" class="form-control" name="course-<?=$course_count?>-accept" id="course-<?=$course_count?>-accept-no" value="no" <?=($course->course_accept == 'no')?'checked="checked"':''?> <?=($accepted)?'disabled':''?> required>
                                <label for="course-<?=$course_count?>-accept-no" class="radio-inline">No</label>
                            </div>
                        </div> <!-- .form-group -->
                    </div>
                </div> <!-- .row -->
            </div> <!-- .col-md-2 -->
            <?php if ($course->course_position == 'Instructor') { ?>
                <div class="col-md-2 course-accept-prorate">
                    <div class="row table-row">
                        <div class="col-xs-12 cell header-cell">
                            <p>Accept pro-rated pay for this assignment</p>
                        </div>
                        <div class="col-xs-12 cell input-cell">
                            <div class="form-group">
                                <div class="checkbox checkbox-inline">
                                    <input type="radio" class="form-control" name="course-<?=$course_count?>-prorate" id="course-<?=$course_count?>-prorate-yes" value="yes" <?=($course->accept_prorate == 'yes')?'checked="checked"':''?> <?=($accepted)?'disabled':''?>>
                                    <label for="course-<?=$course_count?>-prorate-yes" class="radio-inline">Yes</label>
                                </div>
                                <div class="checkbox checkbox-inline">
                                    <input type="radio" class="form-control" name="course-<?=$course_count?>-prorate" id="course-<?=$course_count?>-prorate-no" value="no" <?=($course->accept_prorate == 'no')?'checked="checked"':''?> <?=($accepted)?'disabled':''?>>
                                    <label for="course-<?=$course_count?>-prorate-no" class="radio-inline">No</label>
                                </div>
                            <div class="disabled-overlay"></div><!-- .disabled-overlay -->
                            </div> <!-- .form-group -->
                        </div>
                    </div> <!-- .row -->
                </div> <!-- .col-md-2 course-accept-prorate -->
                <div class="col-md-2 course-minimum">
                    <div class="row table-row">
                        <div class="col-xs-12 cell header-cell">
                            <p>Accept pro-rated pay for minimum enrollment of</p>
                        </div>
                        <div class="col-xs-12 cell input-cell form-group">
                            <select class="form-control" name="course-<?=$course_count?>-minimum" id="course-<?=$course_count?>-minimum" <?=($accepted)?' disabled':''?>>
                                <option value="" selected="selected" disabled>-</option>
                                <?php if ($course->course_number < 500) {
                                    for ($i=14; $i >= 9; $i--) { ?>
                                         <option value="<?=$i?>" <?=($course->minimum_enrollment == $i)?'selected="selected"':''?>><?=$i?> students</option>
                                    <?php } // end for loop
                                } else {
                                    for ($i=9; $i >= 5; $i--) { ?>
                                         <option value="<?=$i?>" <?=($course->minimum_enrollment == $i)?'selected="selected"':''?>><?=$i?> students</option>
                                    <?php } // end for loop
                                } // endif ?>
                            </select>
                            <span class="hide-for-screen">students</span>
                            <div class="disabled-overlay"></div><!-- .disabled-overlay -->
                        </div>
                    </div> <!-- .row -->
                </div> <!-- .col-md-2 -->
            <?php } else { ?>
                <input type="hidden" class="course-minimum" name="course-<?=$course_count?>-minimum" value="">
                <input type="hidden" name="course-<?=$course_count?>-prorate" value="no">
            <?php } // endif ?>
            <div class="col-md-2 course-stipend">
                <div class="row table-row">
                    <div class="col-xs-12 cell header-cell">
                        <p><?=(!in_array($course->course_position, $non_instructor_course_specific_positions))?'Minimum stipend':'Stipend'?></p>
                    </div>
                    <div class="col-xs-12 cell input-cell form-group">
                        <input type="hidden" class="course-credits" value="<?php echo $course->course_credits; ?>">
                        <input type="hidden" class="course-maximum-stipend" value="<?php echo $course->course_stipend; ?>">
                        <input type="hidden" class="minimum-stipend" value="<?=$minimum_stipend?>">
                        <input type="text" class="adjusted-stipend" name="course-<?php echo $course_count; ?>-stipend" id="course-<?php echo $course_count; ?>-stipend" value="$<?=number_format($course->course_stipend, 2)?>" readonly>
                    </div>
                </div> <!-- .row -->
            </div> <!-- .col-md-2 -->
        </div> <!-- .row -->
    </div> <!-- .col-xs-9 .col-sm-10 .col-md-11 -->
</div> <!-- .row .course-<?php echo $course_count; ?> -->
