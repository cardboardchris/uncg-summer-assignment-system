<div class="row user-course course-<?=$course_count?>">
    <input type="hidden" class="course-id" name="course_<?=$course_count?>_id" value="<?=($course)?$course->id:'new'?>">

    <div class="cell count-col col-12 col-lg-auto">
        <div class="row">
            <?php if ($course_count == 1) { ?>
                <div class="col-6 col-lg-12 cell header-cell">
                    <label>&nbsp;</label>
                </div><!-- col-6 col-lg-12 cell header-cell -->
            <?php } // endif ?>
            <div class="col-6 col-lg-12 cell">
                <strong><?php echo $course_count; ?></strong>
            </div><!-- col-6 col-md-1 cell -->
        </div> <!-- row -->
    </div><!-- cell count-col -->

    <div class="cell term-col col-12 col-lg-auto">
        <div class="row">
            <div class="col-6 col-lg-12 cell header-cell">
                <label>Part of Term</label>
            </div><!-- col-6 col-lg-12 cell header-cell -->
            <div class="col-6 col-lg-12 form-group cell select-cell">
                <select class="form-control" name="course_<?php echo $course_count; ?>_term" <?=($course)?'disabled':'required'?>>
                    <?php foreach ($terms as $term_part => $term_array) { ?>
                        <option value="<?=$term_part?>" <?=($course && $course->course_term == $term_part)?'selected="selected"':''?>><?=$term_part?> (<?=date('n/j', $term_array['start'])?> - <?=date('n/j', $term_array['end'])?>)</option>
                    <?php } // end foreach ?>
                </select>
            </div><!-- col-6 col-md-1 form-group cell term-cell term-col -->
        </div><!-- row -->
    </div><!-- cell term-col -->

    <div class="cell crn-col col-12 col-lg-auto">
        <div class="row">
            <div class="col-6 col-lg-12 cell header-cell">
                <label>CRN</label>
            </div><!-- .col-6 col-lg-12 cell -->
            <div class="col-6 col-lg-12 form-group cell">
                <?php
                if ($course && $course->course_crn == 0) {
                    $crn = '';
                } elseif ($course) {
                    $crn = $course->course_crn;
                }
                ?>
                <input type="text" name="course_<?=$course_count?>_crn" value="<?=($course)?$crn:''?>" maxlength="5" size="2" <?=($course)?'readonly':'required'?>>
            </div><!-- col-6 col-lg-12 form-group cell -->
        </div><!-- row -->
    </div><!-- cell crn-col -->

    <div class="cell subject-col col-12 col-lg-auto">
        <div class="row">
            <div class="col-6 col-lg-12 cell header-cell">
                <label>Subject</label>
            </div><!-- .col-6 col-lg-12 cell -->
            <div class="col-6 col-lg-12 form-group cell">
                <input type="text" name="course_<?=$course_count?>_subject" value="<?=($course)?$course->course_subject:''?>" maxlength="3" size="2" <?=($course)?'readonly':'required'?>>
            </div><!-- col-6 col-lg-12 form-group cell -->
        </div><!-- row -->
    </div><!-- cell subject-col -->

    <div class="cell number-col col-12 col-lg-auto">
        <div class="row">
            <div class="col-6 col-lg-12 cell header-cell">
                <label>Number</label>
            </div><!-- .col-6 col-lg-12 cell -->
            <div class="col-6 col-lg-12 form-group cell">
                <input type="text" name="course_<?=$course_count?>_number" value="<?=($course)?$course->course_number:''?>" maxlength="4" size="2" <?=($course)?'readonly':'required'?>>
            </div><!-- col-6 col-lg-12 form-group cell -->
        </div><!-- row -->
    </div><!-- cell number-col -->

    <div class="cell section-col col-12 col-lg-auto">
        <div class="row">
            <div class="col-6 col-lg-12 cell header-cell">
                <label>Section</label>
            </div><!-- .col-6 col-lg-12 cell -->
            <div class="col-6 col-lg-12 form-group cell">
                <input type="text" name="course_<?=$course_count?>_section" value="<?=($course)?$course->course_section:''?>" maxlength="4" size="2" <?=($course)?'readonly':'required'?>>
            </div><!-- col-6 col-lg-12 form-group cell -->
        </div><!-- row -->
    </div><!-- cell section-col -->

    <div class="cell campus-col col-12 col-lg-auto">
        <div class="row">
            <div class="col-6 col-lg-12 cell header-cell">
                <label>Campus</label>
            </div><!-- .col-6 col-lg-12 cell -->
            <div class="col-6 col-lg-12 form-group cell">
                <input type="text" name="course_<?=$course_count?>_campus" value="<?=($course)?$course->course_campus:''?>" maxlength="1" size="2" <?=($course)?'readonly':'required'?>>
            </div><!-- col-6 col-lg-12 form-group cell -->
        </div><!-- row -->
    </div><!-- cell campus-col -->

    <div class="cell credits-col col-12 col-lg-auto">
        <div class="row">
            <div class="col-6 col-lg-12 cell header-cell">
                <label>Credits</label>
            </div><!-- .col-6 col-lg-12 cell -->
            <div class="col-6 col-lg-12 form-group cell">
                <?php
                if ($course && $course->course_credits == 0) {
                    $credits = '';
                } elseif ($course) {
                    $credits = $course->course_credits;
                }
                ?>
                <input type="text" name="course_<?=$course_count?>_credits" value="<?=($course)?$credits:''?>" maxlength="2" size="2" <?=($course)?'readonly':'required'?>>
            </div><!-- col-6 col-lg-12 form-group cell -->
        </div><!-- row -->
    </div><!-- cell credits-col -->

    <div class="cell position-col col-12 col-lg-auto">
        <div class="row">
            <div class="col-6 col-lg-12 cell header-cell">
                <label>Position</label>
            </div><!-- .col-6 col-lg-12 cell -->
            <div class="col-6 col-lg-12 form-group cell select-cell">
                <select class="form-control" name="course_<?php echo $course_count; ?>_position" <?=($course)?'disabled':'required'?>>
                    <?php foreach ($positions as $position_object) { ?>
                        <option data-course-specific="<?=($position_object->course_specific)?'true':'false'?>" value="<?=$position_object->position?>" <?=($course && $course->course_position == $position_object->position)?'selected="selected"':''?>><?=$position_object->description?></option>
                    <?php } // end foreach ?>
                </select>
            </div><!-- col-6 col-lg-12 form-group cell -->
        </div><!-- row -->
    </div><!-- cell position-col -->

    <div class="cell stipend-col col-12 col-lg-auto">
        <div class="row">
            <div class="col-6 col-lg-12 cell header-cell">
                <label>Stipend</label>
            </div><!-- .col-6 col-lg-12 cell -->
            <div class="col-6 col-lg-12 form-group cell">
                <input type="text" class="<?=($course && $course->course_position == 'Instructor' && $course->course_stipend < $minimum_stipend)?'warning':''?>" name="course_<?=$course_count?>_stipend" value="<?=($course)?'$'.$course->course_stipend:''?>" size="2" <?=($course)?'readonly':'required'?>>
            </div><!-- col-6 col-lg-12 form-group cell -->
        </div><!-- row -->
    </div><!-- cell stipend-col -->

    <div class="cell hours-col col-12 col-lg-auto">
        <div class="row">
            <div class="col-6 col-lg-12 cell header-cell">
                <label>Hours</label>
            </div><!-- .col-6 col-lg-12 cell -->
            <div class="col-6 col-lg-12 form-group cell">
                <input type="text" name="course_<?=$course_count?>_hours" value="<?=($course)?$course->course_hours:''?>" maxlength="2" size="2" <?=($course)?'readonly':'required'?>>
            </div><!-- col-6 col-lg-12 form-group cell -->
        </div><!-- row -->
    </div><!-- cell hours-col -->

    <div class="cell fte-col col-12 col-lg-auto">
        <div class="row">
            <div class="col-6 col-lg-12 cell header-cell">
                <label>FTE</label>
            </div><!-- .col-6 col-lg-12 cell -->
            <div class="col-6 col-lg-12 form-group cell fte-cell">
                <?php
                if ($course) {
                    if ($course->course_hours == 0 && ($course->course_position == 'Instructor' || $course->course_position == 'Lab Assistant')) {
                    $fte = 'N/A';
                    } else {
                        $fte = $course->course_hours * .025;
                    }
                }
                ?>
                <input type="text" name="course_<?=$course_count?>_fte" value="<?=($course)?trim($fte, 0):''?>" size="2" <?=($course)?'readonly':'required'?>>
            </div><!-- col-6 col-lg-12 form-group cell -->
        </div><!-- row -->
    </div><!-- cell fte-col -->

    <?php if ($state !== 'archived') { ?>
        <div class="cell note-button-col col-12 col-lg-auto">
            <div class="row">
                <div class="col-6 col-lg-12 cell header-cell">
                    <label>Note</label>
                </div><!-- .col-6 col-lg-12 cell -->
                <div class="col-6 col-lg-12 cell note-button-cell">
                    <a class="btn btn-light btn-sm note-button <?=($course)?'':'hidden'?>" data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="add course note"><i class="fas fa-pencil-alt"></i></a>
                    <span class="begin-hidden save-button"><button type="submit" class="btn btn-primary btn-sm fas fa-save data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="save"></button></span>

                </div><!-- col-6 col-lg-12 cell note-button-col-->
            </div><!-- row -->
        </div><!-- cell note-button-col -->
    <?php } // endif ?>

    <?php if (isset($course->accepted_timestamp) && $course->accepted_timestamp !== false) { ?>
        <div class="cell count-col accepted-col col-12 col-lg-auto">
            <div class="row">
                <?php if ($course_count == 1) { ?>
                    <div class="col-6 col-lg-12 cell header-cell">
                        <label>&nbsp;</label>
                    </div><!-- col-6 col-lg-12 cell header-cell -->
                <?php } // endif ?>
                <div class="col-6 col-lg-12 cell">
                    <i class="fas fa-user-check"></i>
                    <input type="hidden" name="course_<?=$course_count?>_accepted" value="true">
                </div><!-- col-6 col-md-1 cell -->
            </div> <!-- row -->
        </div><!-- cell count-col accepted-col col-12 col-lg-auto -->
    <?php } //endif ?>

    <?php
        $extra_class = '';
        if ($course) {
            if (!$course->course_note) {
                $extra_class = ' begin-hidden';
            }
        }
    ?>
    <div class="cell form-group course-note<?=$extra_class?>">
        <div class="row">
            <div class="col-lg-auto">
                <label>Note:</label>
            </div><!-- .col-lg-auto -->
            <div class="col-lg-auto note-col">
                <textarea class="note-area" name="course_<?=$course_count?>_note" id="course_<?=$course_count?>_note"<?=($course)?' rows="1" readonly':''?>><?=($course)?$course->course_note:''?></textarea>
            </div><!-- .col-lg-auto -->
            <div class="col-lg-auto hidden-delete">
                <button type="button" class="btn btn-outline-danger delete-course-button"data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="delete course"><i class="fas fa-minus"></i> Course</button>
            </div><!-- .col-lg-auto -->
        </div><!-- .row -->
    </div><!-- cell course-note -->
</div><!-- row user-course -->
