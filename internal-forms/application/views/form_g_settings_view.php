<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid settings-container">
    <div class="row dashboard-header-row justify-content-center">
        <div class="col">
            <h3>Form G Settings</h3>
        </div><!-- .col -->
    </div>
    <div class="row">
        <div class="col">
            <h4>Set the date ranges for parts of term.</h4>
        </div><!-- .col -->
    </div> <!-- .row -->
    <form class="settings-form" action="<?=site_url('form_g_settings/save')?>" method="post" accept-charset="utf-8">
    <?php for ($i=1; $i <= 8; $i++) { ?>
        <div class="row justify-content-center">
            <div class="col-md-3 text-right">
                Part of Term <strong><?=$i?></strong> date range
            </div>
            <div class="col-md-2">
                <input type="text" name="term-<?=$i?>-start" id="term-<?=$i?>-start" value="<?=date('n/j/y', $terms[$i]['start'])?>">
            </div>
            <div class="col-md-1 text-center">
                to
            </div>
            <div class="col-md-2">
                <input type="text" name="term-<?=$i?>-end" id="term-<?=$i?>-end" value="<?=date('n/j/y', $terms[$i]['end'])?>">
            </div>
        </div> <!-- .row -->
    <?php } //end for loop ?>
    <div class="row justify-content-center">
        <div class="col-md-3 text-right">
            Minimum Stipend
        </div>
        <div class="col-md-2">
            $<input type="text" name="minimum_stipend" id="minimum_stipend" value="<?=$minimum_stipend?>">
        </div>
    </div> <!-- .row -->
    <div class="row submit-row justify-content-center">
        <div class="col-md-2">
            <a class="btn btn-secondary btn-block" href="<?php echo site_url('form_g_dashboard/'); ?>">Cancel</a>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary btn-block submit-button" type="submit">Submit</button>
        </div>
    </div> <!-- .row -->
    </form>
</div>