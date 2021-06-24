<div class="container-fluid">
    <div class="row dashboard-header-row">
        <div class="col-md-4">
            <!-- <h3>Active Submissions</h3> -->
        </div>
        <div class="col-md-4 text-center">
            <a class="btn btn-secondary download-button" href="<?=site_url('acceptance_dashboard/export_data')?>">Download submissions</a>
        </div>
        <div class="col-md-4">
            <!-- <h4 class="text-right"><?php //echo (count($completed_requests) == 0) ? 'No' : count($completed_requests); ?> archived submission<?php //echo (count($completed_requests) !== 1)? 's' : ''; ?></h4> -->
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <tr>
                <th>Accepted</th>
                <th>Pre-filled</th>
                <th>First Name</th>
                <th>MI</th>
                <th>Last Name</th>
                <th>UNCG ID</th>
                <th>email</th>
                <th>Employee Status</th>
                <th>Student Status (Summer)</th>
                <th>Student Status (Fall)</th>
                <th>Course Number</th>
                <th>Course Section</th>
                <th>Campus</th>
                <th>Accept assignment</th>
                <th>Accept pro-rate</th>
                <th>Minimum enrollment</th>
                <th>Signature</th>
                <!-- <th>Processed</th> -->
            </tr>
            <?php
                foreach ($active_requests as $row) {
            ?>
            <tr>
                <td>
                    <span class="cell-data received-date"><?=date('n-j-Y',strtotime($row->date))?></span>
                </td>
                <td>
                    <span class="cell-data"><?=($row->pre_filled)?'yes':'no'?></span>
                </td>
                <td>
                    <span class="cell-data"><?=$row->firstname?></span>
                </td>
                <td>
                    <span class="cell-data"><?=$row->middleinitial?></span>
                </td>
                <td>
                    <span class="cell-data"><?=$row->lastname?></span>
                </td>
                <td>
                    <span class="cell-data"><?=$row->spartanid?></span>
                </td>
                <td>
                    <span class="cell-data"><a href="mailto:<?=$row->email?>"><?=$row->email?></a></span>
                </td>
                <td>
                    <span class="cell-data"><?=$row->employeestatus?></span>
                </td>
                <td>
                    <span class="cell-data"><?=$row->summerstudent?></span>
                    <?php if(!is_null($row->summerstatus)) { ?>
                     <span class="cell-data"><?=$row->summerstatus?></span>
                    <?php } ?>
                </td>
                <td>
                    <span class="cell-data"><?=$row->fallstudent?></span>
                    <?php if(!is_null($row->fallstudent)) { ?>
                     <span class="cell-data"><?=$row->fallstatus?></span>
                    <?php } ?>
                </td>
                <td>
                    <span class="cell-data"><?=$row->course_number?></span>
                </td>
                <td>
                    <span class="cell-data"><?=$row->course_section?></span>
                </td>
                <td>
                    <span class="cell-data"><?=$row->course_campus?></span>
                </td>
                <td>
                    <?php
                    if ($row->course_accept == 'no') {
                        echo '<span style="color: red;">';
                    } else {
                        echo '<span>';
                    }
                    echo $row->course_accept.'</span>';
                    ?>
                </td>
                <td>
                    <?php
                    if ($row->course_prorate) {
                        $output = $row->course_prorate;
                    } elseif ($row->course_decline) {
                        $output = 'no';
                    } else {
                        $output = 'yes';
                    }
                    if ($output == 'no') {
                        echo '<span style="color: red;">';
                    } else {
                        echo '<span>';
                    }
                    echo $output.'</span>';
                    ?>
                </td>
                <td<?php if (($row->course_minimum == 0) && (!$row->course_decline)) { echo ' class="danger"'; } ?>>
                    <span class="cell-data"><?php if ((!$row->course_minimum == 0) && (!$row->course_decline)) { echo $row->course_minimum; } ?></span>
                </td>
                <td>
                    <span class="cell-data"><?=$row->signature?></span>
                </td>
                <!-- <td>
                    <a href="<?=site_url('acceptancedashboard/complete').'/'.$row->id?>" data-id="<?=$row->id?>" data-firstname="<?=$row->firstname?>" data-lastname="<?=$row->lastname?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span></a>
                </td> -->
            </tr>
        <?php } ?>
        </table>
    </div> <!-- .row -->
</div> <!-- .container -->