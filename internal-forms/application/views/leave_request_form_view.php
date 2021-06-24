<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container leave-request-form-container">
    <div class="row">
        <div class="col-md-12">
            <h1>UNCG Online <span>Leave Request Form</span></h1>
        </div>
    </div> <!-- .row -->

    <!-- Form -->
    <div class="form-container">
        <form action="<?=site_url('leave_request_form/submit')?>" method="post" accept-charset="utf-8">
    <!-- Identity -->
            <div class="row">
                <div class="col-6 form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" id="name" data-error="Please enter your name." placeholder="Name" value="<?=$userdata['first'].' '.$userdata['last'];?>" required>
                </div> <!-- .col -->
                <div class="col-6 form-group">
                    <label for="date">Today's Date:</label>
                    <input type="text" name="date" class="form-control" id="date" placeholder="today's date" value="<?=date('m/d/Y')?>" required>
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col form-group">
                    <label for="leave-begin-date">Begin date:</label>
                    <input name="leave-begin-date" class="form-control" id="leave-begin-date" placeholder="begin date" required>
                    <div class="invalid-feedback">
                        Please enter a date.
                    </div>
                </div> <!-- .col -->
                <div class="col-1 form-group">
                    <label for="leave-begin-time">all day</label>
                    <input type="checkbox" name="leave-begin-all-day" class="form-control" id="leave-begin-all-day">
                </div> <!-- .col -->
                <div class="col form-group">
                    <label for="leave-begin-time">at:</label>
                    <input name="leave-begin-time" class="form-control" id="leave-begin-time" placeholder="begin time">
                    <div class="invalid-feedback">
                        Please enter a time.
                    </div>
                </div> <!-- .col -->
                <div class="col form-group">
                    <label for="leave-end-date">End date:</label>
                    <input name="leave-end-date" class="form-control" id="leave-end-date" placeholder="end date" required>
                    <div class="invalid-feedback">
                        Please enter a date.
                    </div>
                </div> <!-- .col -->
                <div class="col-1 form-group">
                    <label for="leave-begin-time">all day</label>
                    <input type="checkbox" name="leave-begin-all-day" class="form-control" id="leave-begin-all-day">
                </div> <!-- .col -->
                <div class="col form-group">
                    <label for="leave-end-time">at:</label>
                    <input name="leave-end-time" class="form-control" id="leave-end-time" placeholder="end time" required>
                    <div class="invalid-feedback">
                        Please enter a time.
                    </div>
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-6 form-group">
                    <label for="leave-type">Type of Leave Requested?</label>
                    <select class="form-control" name="leave-type" required>
                        <?php foreach ($leave_types as $value) { ?>
                            <option value="<?=$value?>"><?=$value?></option>
                        <?php } // end foreach ?>
                    </select>
                    <div class="help-block with-errors"></div>
                </div> <!-- .col -->
                <div class="col-6 form-group">
                    <label for="supervisor">Please select your supervisor</label>
                    <select class="form-control" name="supervisor" required>
                        <?php foreach ($supervisors as $username => $full_name) { ?>
                            <option value="<?=$username?>"><?=$full_name?></option>
                        <?php } // end foreach ?>
                    </select>
                    <div class="help-block with-errors"></div>
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row hide-for-print">
                <div class="col text-center">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div> <!-- .row .submit-row -->

        </form>
    </div> <!-- .form-container -->
</div> <!-- leave-request-form-container -->
