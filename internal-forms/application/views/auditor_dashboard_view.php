<div class="container-fluid">
    <div class="row dashboard-header-row">
        <div class="col-md">
            <h3><?=ucwords($state)?> Submissions</h3>
        </div>
        <div class="col-md-5 text-center">
            <span class="download-heading">Download:</span> <a class="btn btn-secondary download-button" href="<?=site_url('auditordashboard/export_data/personal')?>">Personal info</a> <a class="btn btn-secondary download-button" href="<?=site_url('auditordashboard/export_data/course')?>">Course info</a> <a class="btn btn-secondary download-button" href="<?=site_url('auditordashboard/export_data/all')?>">All info</a>
        </div>
        <div class="col-md text-right">
        <?php if ($state == 'active') {
            $records = $active_requests; ?>
            <a class="btn btn-light archive-button" href="<?php echo site_url('auditor_dashboard/render_view/archived');?>">Go to Archived <i class="fas fa-folder-open"></i>&nbsp;(<?=count($archived_requests)?>)</a>
        <?php } else {
            $records = $archived_requests; ?>
            <a class="btn btn-light active-button" href="<?php echo site_url('auditor_dashboard/render_view/active');?>">Go to Active <i class="fas fa-inbox"></i>&nbsp;(<?=count($active_requests)?>)</a>
        <?php } //endif ?>
        </div>
    </div><!-- row -->
    <?php echo form_open(site_url('archive/update_multiple')); ?>

    <?php if (($state == 'archived') && (count($archived_requests) > 0)) { ?>
        <div class="row bordered bulk-actions">
            <div class="col-sm-1">
                <input type="checkbox" id="select-all">
                <label for="select-all"></label>
            </div>
            <div class="col-sm">Bulk actions - apply to all selected rows</div>
            <div class="col-sm danger">
                Warning: Deleting records from this page is permanent and cannot be undone.
            </div>
            <div class="col-sm-1 text-right">
                <button type="submit" class="btn btn-outline-primary btn-sm" name="action" value="activate" data-toggle="tooltip" data-placement="top" title="reactivate selected"><i class="fas fa-level-up-alt"></i></button>
                <button type="submit" class="btn btn-outline-danger btn-sm" name="action" value="delete" data-toggle="tooltip" data-placement="top" title="delete selected"><i class="fas fa-trash-alt"></i></button>
            </div>
        </div>
    <?php } //endif ?>

    <?php foreach ($records as $row) { ?>
    <div class="row bordered auditor-record">
        <?php if ($state == 'archived') { ?>
            <div class="col-sm-1">
                <input type="checkbox" name="marked[]" value="<?=$row->id?>" id="checkbox-<?=$row->id?>">
                <label for="checkbox-<?=$row->id?>"></label>
            </div><!-- .col-md-1 -->
        <?php } //endif ?>
        <div class="col-sm">
            <strong>Received:</strong> <span class="received-date"><?=date('n-j-Y',strtotime($row->date))?></span>
            <br><strong>First Name:</strong> <?=$row->firstname?>
            <br><strong>MI:</strong> <?=$row->middleinitial?>
            <br><strong>Last Name:</strong> <?=$row->lastname?>
            <br><strong>Address:</strong> <?=$row->address?>
            <br><strong>City:</strong> <?=$row->city?>
            <br><strong>State:</strong> <?=$row->state?>
            <br><strong>Zip:</strong> <?=$row->zip?>
            <br><strong>Ethnicity:</strong> <?=$row->ethnicity?>
            <br><strong>Birthdate:</strong> <?=$row->birthdate?>
            <br><strong>Gender:</strong> <?=$row->gender?>
            <br><strong>Citizen:</strong> <?=$row->citizen?>
            <br><strong>Home Phone:</strong> <?=$row->homephone?>
            <br><strong>Cell Phone:</strong> <?=$row->cellphone?>
            <br><strong>Email:</strong> <a href="mailto:<?=$row->email?>"><?=$row->email?></a>
            <br><strong>Graduated high school:</strong> <?=$row->high_school_grad?>
            <br><strong>Year graduated high school:</strong> <?=$row->high_school_grad_year?>
            <br><strong>Graduated college:</strong> <?=$row->college_grad?>
            <br><strong>Year graduated college:</strong> <?=$row->college_grad_year?>
        </div><!-- .col-sm -->
        <div class="col-sm">
            <strong>Previously attended UNCG:</strong> <?=$row->previously_attended?>
            <br><strong>Attended UNCG for credit:</strong> <?=$row->attended_for_credit?>
            <br><strong>Attended UNCG from:</strong> <?=$row->attended_dates_from?>
            <br><strong>Attended UNCG to:</strong> <?=$row->attended_dates_to?>
            <br><strong>Currently enrolled at UNCG:</strong> <?=$row->current_enrollment?>
            <br><strong>Enrolled at UNCG from:</strong> <?=$row->enrolled_dates_from?>
            <br><strong>Enrolled at UNCG to:</strong> <?=$row->enrolled_dates_to?>
            <br><strong>CRN#:</strong> <?=$row->crn?>
            <br><strong>Course number:</strong> <?=$row->course_number?>
            <br><strong>Course title:</strong> <?=$row->course_title?>
            <br><strong>Course instructor:</strong> <?=$row->course_instructor?>
            <br><strong>Semester:</strong> <?=$row->semester?>
            <br><strong>Year:</strong> <?=$row->semester_year?>
            <br><strong>Comments:</strong> <?=$row->comments?>
        </div><!-- .col-sm -->
        <div class="col-sm-2">
            <strong>Convicted:</strong> <?=$row->convicted?>
            <br><strong>Convicted date:</strong> <?=$row->convicted_date?>
            <br><strong>Guilty plea:</strong> <?=$row->guilty_plea?>
            <br><strong>Responsible for crime:</strong> <?=$row->responsible_for_crime?>
            <br><strong>Pending crime:</strong> <?=$row->pending_crime?>
            <br><strong>School discipline:</strong> <?=$row->school_discipline?>
            <br><strong>Military discharge:</strong> <?=$row->military_discharge?>
            <br><strong>Crime explanation:</strong> <?=$row->crime_explanation?>
            <br><strong>Signature:</strong> <?=$row->signature?>
        </div><!-- .col-sm -->
        <div class="col-sm-1 text-right">
            <?php if ($state == 'active') { ?>
                <a href="<?=site_url('auditor_dashboard/update_record_completed').'/'.$row->id?>" data-id="<?=$row->id?>" data-firstname="<?=$row->firstname?>" data-lastname="<?=$row->lastname?>" data-toggle="tooltip" data-placement="top" title="archive" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
            <?php } else { ?>
                <a href="<?=site_url('auditor_dashboard/update_record_active/'.$row->id)?>" class="btn btn-primary btn-sm unarchive-button" data-toggle="tooltip" data-placement="top" title="reactivate"><i class="fas fa-level-up-alt"></i></a>
                <a href="<?=site_url('auditor_dashboard/delete_record_by_id/'.$row->id)?>" class="btn btn-danger btn-sm delete-button" data-toggle="tooltip" data-placement="top" title="delete"><i class="fas fa-trash-alt"></i></a>
            <?php } //endif ?>
        </div><!-- .col-md -->
    </div><!-- row -->
    <?php } ?>
    <?php echo form_close(); ?>
</div> <!-- .container -->