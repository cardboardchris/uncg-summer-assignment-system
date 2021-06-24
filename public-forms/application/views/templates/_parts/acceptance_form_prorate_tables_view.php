<div class="row table-row">
    <div class="col-md-12">
        <table class="table table-striped">
            <tr class="ugrad-header-row">
                <th colspan="5">
                    Pro-Rated Stipend Matrix for UNDERGRADUATE Courses <span class="hide-for-screen"><br></span>(100-400 level)
                </th>
            </tr>
            <tr>
                <th>
                    # students
                    <br>registered
                </th>
                <th>
                    $<?php echo $ugrad_prorate; ?>/sch
                    <br><span class="subtext">(80% x $<?php echo $ugrad_rate; ?>)</span>
                </th>
                <th class="v-centered">
                    1 SCH
                    <br>maximum stipend
                </th>
                <th class="v-centered">
                    2 SCH
                    <br>maximum stipend
                </th>
                <th class="v-centered">
                    3 SCH
                    <br>maximum stipend
                </th>
            </tr>
            <?php
                for ($i=14; $i >= 9; $i--) { ?>
                    <tr>
                        <td>
                            <?php echo $i ?>
                        </td>
                        <td>
                            $<?php echo $ugrad_prorate; ?>
                        </td>
                        <td>
                            $<?php echo number_format($ugrad_prorate*$i, 2); ?>
                        </td>
                        <td>
                            $<?php echo number_format($ugrad_prorate*2*$i, 2); ?>
                        </td>
                        <td>
                            $<?php echo number_format($ugrad_prorate*3*$i, 2); ?>
                        </td>
                    </tr>
                <?php }
            ?>
        </table>
        <table class="table table-striped">
            <tr class="grad-header-row">
                <th colspan="5">
                    Pro-Rated Stipend Matrix for GRADUATE Courses <span class="hide-for-screen"><br></span>(500 level &amp; above)
                </th>
            </tr>
            <tr>
                <th>
                    # students
                    <br>registered
                </th>
                <th>
                    $<?php echo $grad_prorate; ?>/sch
                    <br><span class="subtext">(80% x $<?php echo $grad_rate; ?>)</span>
                </th>
                <th class="v-centered">
                    1 SCH
                    <br>maximum stipend
                </th>
                <th class="v-centered">
                    2 SCH
                    <br>maximum stipend
                </th>
                <th class="v-centered">
                    3 SCH
                    <br>maximum stipend
                </th>
            </tr>
            <?php
                for ($i=9; $i >= 5; $i--) { ?>
                    <tr>
                        <td>
                            <?php echo $i ?>
                        </td>
                        <td>
                            $<?php echo $grad_prorate; ?>
                        </td>
                        <td>
                            $<?php echo number_format($grad_prorate*$i, 2); ?>
                        </td>
                        <td>
                            $<?php echo number_format($grad_prorate*2*$i, 2); ?>
                        </td>
                        <td>
                            $<?php echo number_format($grad_prorate*3*$i, 2); ?>
                        </td>
                    </tr>
                <?php }
            ?>
        </table>
    </div>
</div>
