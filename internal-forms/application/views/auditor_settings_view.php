<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid settings-container">
    <div class="row dashboard-header-row justify-content-center">
        <div class="col">
            <h3>Auditor Form Settings</h3>
        </div><!-- .col -->
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <h4 class="info">Set the email address to recieve notifications.<br>(if multiple, separate with commas)</h4>
        </div><!-- .col -->
    </div> <!-- .row -->
    <?php echo form_open('auditor_settings/save', 'class="settings-form"'); ?>
    <div class="row justify-content-center">
        <div class="col-md-2 text-right">
            email
        </div>
        <div class="col-md-3">
            <?php echo form_input('email', $email); ?>
        </div>
    </div> <!-- .row -->
    <div class="row justify-content-center">
        <div class="col-md-2 text-right">
            semester
        </div>
        <div class="col-md-3">
            <?php echo form_input('semester', $semester); ?>
        </div>
    </div> <!-- .row -->
    <div class="row submit-row justify-content-center">
        <div class="col-md-2">
            <a class="btn btn-secondary btn-block" href="<?php echo site_url('auditor_dashboard'); ?>">Cancel</a>
        </div>
        <div class="col-md-2">
            <?php echo form_submit('submit', 'Update', 'class="btn btn-primary btn-block"'); ?>
        </div>
    </div> <!-- .row -->
    <?php echo form_close(); ?>
</div>