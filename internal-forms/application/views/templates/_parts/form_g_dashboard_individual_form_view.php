<div class="row form-g-record read-only<?=(strtotime($form['user']->date) < strtotime('-3 years'))?' obsolete':''?>">
    <div class="col-md-12">
        <form>
            <input type="hidden" name="course_count" value="<?=count($form['courses'])?>">
            <input type="hidden" name="form_id" value="<?=$form['user']->form_id?>">
            <!-- status, affiliation, buttons -->
            <div class="row user-header user-<?=strtolower(str_replace(array('&', ' ', '--'), array('', '-', '-'), $form['user']->affiliation))?>">
                <div class="col-md-4">
                    <p>
                        <?php if ($state == 'archived' || $state == 'verified') { ?>
                            <input type="checkbox" name="mark-user" value="<?=$form['user']->form_id?>">&nbsp;
                        <?php } //endif ?>
                        <strong><?=$form['user']->first_name?> <?=$form['user']->last_name?></strong> - <?=$form['user']->affiliation?><?=(strtotime($form['user']->date) < strtotime('-3 years'))?' <span class="obsolete-message">[this record is 3+ years old]</span>':''?>
                    </p>
                </div><!-- .col-md-4 -->
                <div class="col-md-5 text-center">
                    <p><strong>Received:</strong> <?=date('n-j-Y g:m A',strtotime($form['user']->date))?>
                    <?php
                        $any_accepted = false;
                        foreach ($form['courses'] as $course_object) {
                            if (isset($course_object->accepted_timestamp) && $course_object->accepted_timestamp !== false) {
                                $date = $course_object->accepted_timestamp;
                                $any_accepted = true; ?>
                                <input type="hidden" name="any_course_accepted" value="<?=$date?>">
                            <?php } //endif
                        }
                        if ($any_accepted) {
                            echo '&nbsp;&nbsp;<strong>Accepted:</strong> '.date('n-j-Y', $date);
                        }
                    ?>
                    </p>
                </div><!-- .col-md-5 -->
                <div class="col-md-3 header-buttons text-right">
                <!-- History button -->
                    <?php if ($form['user']->revisions) { ?>
                        <button type="button" class="btn btn-light btn-sm history-button" data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="toggle history"><i class="far fa-clock"></i></button>
                    <?php } //endif ?>

                <!-- Print button -->
                    <a href="<?=site_url('form_g_print/'.$form['user']->form_id.'/'.$campus)?>" target="_blank" class="btn btn-light btn-sm print-button" data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="print"><i class="fas fa-print"></i></a>

                <!-- Edit and save buttons -->
                    <?php if ($state !== 'archived') { ?>
                        <button type="button" class="btn btn-light btn-sm edit-button" data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="edit"><i class="fas fa-pencil-alt"></i></button>

                        <button type="button" class="btn btn-primary btn-sm begin-hidden save-button" data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="save"><i class="fas fa-save"></i></button>
                    <?php } //endif ?>

                <!-- Verify button -->
                    <?php if ($state == 'active') { ?>
                        <button type="button" class="btn btn-light btn-sm state-change-button verify-button" data-newstate="verified" data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="verify"><i class="fas fa-check"></i></button>
                    <?php } //endif ?>

                <!-- Reactivate button -->
                    <?php if ($state !== 'active') { ?>
                        <button type="button" class="btn btn-light btn-sm state-change-button reactivate-button" data-newstate="active" data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="reactivate"><i class="fas fa-level-up-alt"></i></button>
                    <?php } //endif ?>

                <!-- Archive button -->
                    <?php if ($state !== 'archived') { ?>
                        <button type="button" class="btn btn-light btn-sm state-change-button archive-button" data-newstate="archived" data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="archive"><i class="fas fa-folder-open"></i></button>
                    <?php } //endif ?>

                <!-- Trash button -->
                    <?php if ($state == 'archived') { ?>
                        <button type="button" class="btn btn-light btn-sm delete-button" data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="delete"><i class="fas fa-trash-alt"></i></button>
                    <?php } //endif ?>

                <!-- Add course button -->
                    <?php if ($state !== 'archived') { ?>
                        <button type="button" class="btn btn-light add-course-button begin-hidden" data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="add course"><i class="fas fa-plus"></i> Course</button>
                    <?php } //endif ?>
                </div><!-- .col-md-3 -->
            </div><!-- row -->

            <!-- user info fields -->
            <?php
                $this->template->load('_parts/form_g_dashboard_user_inputs_view', null, array('user' => $form['user']));
            ?>
            <!-- course fields -->
            <?php
                foreach ($form['courses'] as $course_key => $course) {
                    $this->template->load('_parts/form_g_dashboard_course_inputs_view', null, array('course_count' => $course_key+1, 'course' => $course, 'terms' => $terms, 'positions' => $positions, 'state' => $state, 'minimum_stipend' => $minimum_stipend));
                } // end foreach
            ?>
        </form>
        <?php if ($form['user']->revisions) { ?>
        <div class="user-revisions">
            <div class="row">
                <div class="col-md-auto">
                    <label>Revision History:</label>
                </div> <!-- col-md-auto -->
                <div class="col-md-auto">
                    <span><?php echo $form['user']->revisions; ?></span>
                </div><!-- .col-md-auto -->
            </div><!-- .row -->
        </div><!-- .user-revisions -->
        <?php } //endif ?>
    </div><!-- .col-md-12 -->
</div><!-- row form-g-record -->
