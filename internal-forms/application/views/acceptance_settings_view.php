<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container-fluid settings-container">
    <div class="row dashboard-header-row justify-content-center">
        <div class="col">
            <h3>Acceptance Form Settings</h3>
        </div><!-- .col -->
    </div>
    <div class="row justify-content-center">
        <h4>Set the rates for undergrad and graduate stipends here.</h4>
    </div>
    <?php echo form_open('acceptance_settings/save', 'class="settings-form"'); ?>
    <div class="row justify-content-center">
        <div class="col-md-2 text-right">
            Undergrad Rate
        </div>
        <div class="col-md-2">
            $<?php echo form_input('ugrad_value', $ugrad_value); ?>
        </div>
    </div> <!-- .row -->
    <div class="row justify-content-center">
        <div class="col-md-2 text-right">
            Graduate Rate
        </div>
        <div class="col-md-2">
            $<?php echo form_input('grad_value', $grad_value); ?>
        </div>
    </div> <!-- .row -->
    <div class="row justify-content-center">
        <div class="col-md-2 text-right">
            Pro-rate multiplier
        </div>
        <div class="col-md-2 multiplier">
            <?php echo form_input('multiplier', $multiplier, 'placeholder="80"'); ?>%
        </div>
    </div> <!-- .row -->
    <div class="row justify-content-center">
        <h4>Set the email address to recieve notifications.<br>(if multiple, separate with commas)</h4>
    </div> <!-- .row -->
    <div class="row justify-content-center">
        <div class="col-md-2 text-right">
            email
        </div>
        <div class="col-md-3">
            <?php echo form_input('email', $email); ?>
        </div>
    </div> <!-- .row -->
    <div class="row submit-row justify-content-center">
        <div class="col-md-2">
            <a class="btn btn-secondary btn-block" href="<?php echo site_url('acceptance_dashboard/'); ?>">Cancel</a>
        </div>
        <div class="col-md-2">
            <?php echo form_submit('submit', 'Update', 'class="btn btn-primary btn-block"'); ?>
        </div>
    </div> <!-- .row -->
    <?php echo form_close(); ?>
</div>