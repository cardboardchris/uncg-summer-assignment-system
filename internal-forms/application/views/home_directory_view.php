<div class="container-fluid directory-container">
    <div class="row">
        <div class="col">
            <h1>Public Forms</h1>
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="../../apps/public-forms/acceptanceform">Summer Appointment Acceptance Form</a></li>
                        <li><a href="../../apps/public-forms/auditorform">External Auditor Application Form</a></li>
                    </ul>
                </div>
            </div> <!-- .row -->
            <?php if ($userdata['access_level'] >= 1) { ?>
                <hr>
                <h1>External Forms (academic dept admins)</h1>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li><a href="<?=site_url('form_g')?>">Form G</a></li>
							<li><a target="_blank" href="https://www.google.com/url?q=https://docs.google.com/forms/d/e/1FAIpQLSeyPe377y3erT6DR2pyTHfsg5ltL-wzRCPeSCIdpFboEpGSrA/viewform&sa=D&source=hangouts&ust=1580329822995000&usg=AFQjCNET_0poa7TrmpG6wXqbHJgcxbIuvA">Form G Change Form</a></li>
                        </ul>
                    </div>
                </div> <!-- .row -->
                <hr>
				<?php if ($userdata['role'] == 'code' || $userdata['role'] == 'supervisor') { ?>
                <h1>Internal Forms (division staff)</h1>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                                <li><a href="<?=site_url('leave_request_form')?>">Leave Request Form</a></li>
                        </ul>
                    </div>
                </div> <!-- .row -->
				<?php } //endif ?>
            <?php } //endif ?>
            <?php if ($userdata['role'] == 'code' || $userdata['role'] == 'supervisor') { ?>
                <hr>
                <h1>Dashboards (supervisors)</h1>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li><a href="<?=site_url('leave_request_dashboard')?>">Leave Request Dashboard</a></li>
                        </ul>
                    </div>
                </div> <!-- .row -->
            <?php } //endif ?>
            <?php if ($userdata['access_level'] >= 3) { ?>
                <hr>
                <h1>Dashboards (registration, finance, program directors)</h1>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li><a href="<?=site_url('acceptance_dashboard')?>">Acceptance Form Dashboard</a></li>
                            <li><a href="<?=site_url('auditor_dashboard')?>">Auditor Form Dashboard</a></li>
                            <li><a href="<?=site_url('form_g_dashboard')?>">Form G Dashboard</a></li>
                            <li><a target="_blank" href="https://www.google.com/url?q=https://docs.google.com/spreadsheets/d/1VN94YCXk7KXwYeFqsdDe3YAIEaVW-qTYmqBX2r1m3W0/edit?usp%3Dsharing&sa=D&source=hangouts&ust=1580329856056000&usg=AFQjCNF3bOyalXT1KPWxBfE6YlAmFW6lNg">Form G Changes Sheet</a></li>
                            <?php if ($userdata['role'] == 'code') { ?>
                                <li><a href="<?=site_url('leave_request_dashboard')?>">Leave Request Dashboard</a></li>
                            <?php } //endif ?>
                        </ul>
                    </div>
                </div> <!-- .row -->
            <?php } //endif ?>
        </div><!-- .col -->
        <div class="col-md-3">
            <?php $this->template->load('_parts/changelog'); ?>
        </div><!-- .col-md-3 -->
    </div><!-- .row -->
</div> <!-- .container -->
