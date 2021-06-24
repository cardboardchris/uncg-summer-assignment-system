<div class="container-fluid dashboard-header form-g-<?=$state?>">
    <div class="row">
        <div class="col-md-auto state-buttons">
            <a class="btn btn-outline-secondary state-filter-button state-button-active<?php echo ($state == 'active') ? ' selected-button' : ''; ?>" href="<?php echo site_url('form_g_dashboard/render_view/active');?>">Active <i class="fas fa-inbox"></i> (<span id="active-form-count"></span>)</a>
            <a class="btn btn-outline-secondary state-filter-button state-button-verified<?php echo ($state == 'verified') ? ' selected-button' : ''; ?>" href="<?php echo site_url('form_g_dashboard/render_view/verified');?>">Verified <i class="fas fa-check"></i> (<span id="verified-form-count"></span>)</a>
            <a class="btn btn-outline-secondary state-filter-button state-button-archived<?php echo ($state == 'archived') ? ' selected-button' : ''; ?>" href="<?php echo site_url('form_g_dashboard/render_view/archived');?>">Archived <i class="fas fa-folder-open"></i> (<span id="archived-form-count"></span>)</a>
        </div> <!-- col-md-auto state-buttons -->
        <div class="col-md text-center">
            <h5>Sort forms by:</h5>
            <button type="button" class="form-control btn btn-outline-secondary sort-button" value="name">Name</button>
            <button type="button" class="form-control btn btn-outline-secondary sort-button selected-button" value="date">Date</button>
        </div><!-- col-md -->
        <div class="col-md-auto text-right">
            <?php if ($userdata['role'] == 'finance' || $userdata['role'] == 'code') { ?>
                <button type="button" class="btn btn-outline-primary download-button" data-filters="all">Download all</button>
            <?php } //endif ?>
            <button type="button" class="btn btn-outline-primary download-button" data-filters="filtered">Download as filtered</button>
        </div><!-- col-md-auto text-right -->
    </div><!-- row -->
    <div class="row">
        <!-- hidden inputs for filter settings -->
        <input type="hidden" id="state" name="state" value="<?=$state?>">
        <input type="hidden" id="filter-campus" name="filter-campus" value="GOS">
        <input type="hidden" id="sort-order" name="sort-order" value="date">
        <div class="col-md-2 text-right">
            <h5>Filter courses:</h5>
        </div><!-- col-md-2 text-right -->
        <div class="col-md-auto">
            <h5>by campus</h5>
        </div><!-- col-md-auto -->
        <div class="col-md-auto">
            <button type="button" class="form-control btn btn-outline-secondary campus-filter-button" value="G">G only</button>
            <button type="button" class="form-control btn btn-outline-secondary campus-filter-button" value="OS">O/S only</button>
            <button type="button" class="form-control btn btn-outline-secondary campus-filter-button selected-button" value="GOS">All</button>
        </div><!-- .col-md-auto -->
        <div class="col-md-auto">
            <h5>by subject</h5>
        </div><!-- col-md-auto -->
        <div class="col-md">
            <select class="form-control filter-select inactive-select" id="filter-subject" name="filter-subject">
                <option value="all" selected="selected">All Subjects</option>
            </select>
        </div><!-- col-md -->
    </div> <!-- row -->
 <!-- instructor filters -->
    <div class="row">
        <div class="col-md-2 text-right">
            <h5>Filter instructors:</h5>
        </div><!-- col-md-2 text-right -->
        <div class="col-md-auto">
            <h5>by hiring department</h5>
        </div><!-- col-md-auto -->
        <div class="col-md">
            <select class="form-control filter-select inactive-select" id="filter-department" name="filter-department">
                <option value="all" selected="selected">All Departments</option>
            </select>
        </div><!-- col-md -->
        <div class="col-md-auto">
            <h5>by affiliation</h5>
        </div><!-- col-md-auto -->
        <div class="col-md">
            <select class="form-control filter-select inactive-select" id="filter-affiliation" name="filter-affiliation">
                <option value="all" selected="selected">All Affiliations</option>
                <option value="Current UNCG Employee">Current UNCG Employee</option>
                <option value="Current UNCG Student">Current UNCG Student</option>
                <option value="New Hire">New Hire</option>
                <option value="Previously Affiliated">Previously Affiliated</option>
                <option value="Current UNCG Employee & Current Student">Current UNCG Employee & Current Student</option>
            </select>
        </div><!-- .col-md -->
    </div> <!-- row -->
</div><!-- .dashboard-header -->

<div class="container-fluid main-content form-g-<?=$state?>">
    <!-- Bulk actions -->
    <?php if ($state == 'archived' || $state == 'verified') { ?>
        <div class="row bordered bulk-actions">
            <div class="col-md-3">
                <input type="checkbox" id="select-all">
                <label for="select-all">&nbsp;Select all records</label>
                <?php if ($state == 'archived') { ?>
                    <br><input type="checkbox" id="select-all-obsolete">
                    <label for="select-all-obsolete">&nbsp;Select all 3+ year old records</label>
                <?php } //endif ?>
            </div>
            <div class="col-md-7 text-center">
                <label>Bulk actions - apply to all selected records</label>
                <?php if ($state == 'archived') { ?>
                    <br><span style="color: #CC0000;"><strong>Warning</strong>: Deleting records from this page is permanent and cannot be undone.</span>
                <?php } //endif ?>
            </div>
            <div class="col-md-2 text-right">
            <!-- Reactivate all button -->
                <a class="btn btn-primary btn-sm bulk-action-button reactivate-all-button" data-action="activate" data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="reactivate selected"><i class="fas fa-level-up-alt"></i></a>
            <!-- Archive all button -->
                <?php if ($state == 'archived') { ?>
                    <a class="btn btn-danger btn-sm bulk-action-button delete-all-button" data-action="delete" data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="delete selected"><i class="fas fa-trash-alt"></i></a>
            <!-- Delete all button -->
                <?php } elseif ($state == 'verified') { ?>
                    <a class="btn btn-outline-secondary btn-sm bulk-action-button archive-all-button" data-action="archive" data-toggle="tooltip" data-delay='{ "show": "500", "hide": "100" }' title="archive selected"><i class="fas fa-folder-open"></i></a>
                <?php } //endif ?>
            </div>
        </div>
    <?php } //endif ?>

    <div id="form-g-forms-container">
        <div class="loading-animation-container"></div>
    </div><!-- #form-g-forms-container -->
</div> <!-- .main-content -->