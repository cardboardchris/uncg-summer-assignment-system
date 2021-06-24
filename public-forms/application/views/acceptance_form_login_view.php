<?php defined('BASEPATH') OR exit('No direct script access allowed');

//get form year
if (date('n') > 9) {
    $year = date('Y')+1;
} else {
    $year = date('Y');
}

?>
<div class="row">
    <div class="col-md-12">
        <h1>UNC Greensboro Division of Online Learning Acceptance Form</h1>
    </div><!-- col-md-12 -->
</div><!-- row -->
<!-- Form -->
<div class="acceptance-form-login-container">
    <form class="acceptance-form-login-form" action="<?=site_url('acceptanceform/form')?>" method="post" accept-charset="utf-8" data-toggle="validator">
        <div class="row">
            <div class="col-md-12 text-center">
                <label for="spartanid">Please enter your UNCG ID</label>
                <input type="text" name="spartanid" id="spartanid" pattern="[0-9]{9}" maxlength="9" data-error="Please enter a valid, 9-digit UNCG ID." placeholder="888888888" required autofocus>
            </div><!-- col-md-12 -->
        </div><!-- row -->
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div><!-- col-md-12 -->
        </div><!-- row -->
    </form>
</div> <!-- .form-container -->

<?php $this->template->load('_parts/contact_info_view', null); ?>
