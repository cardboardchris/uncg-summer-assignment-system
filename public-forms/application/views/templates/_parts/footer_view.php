<?php defined('BASEPATH') OR exit('No direct script access allowed');
if (ENVIRONMENT === 'development') {
    echo '<footer>
            <p class="footer">
                Page rendered in <strong>{elapsed_time}</strong> seconds. CodeIgniter Version <strong>' . CI_VERSION . '</strong>
            </p>
        </footer>';
    }
        ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="<?=base_url()?>assets/js/modernizr.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="<?=base_url()?>assets/js/bootstrap-validator.min.js"></script>
        <script type="text/javascript"></script>
        <?php
            if ($this->uri->segment(1)) {
                echo '<script src="'.base_url().'assets/js/jquery.inputmask.bundle.min.js"></script>'."\n".
                '<script src="'.base_url().'assets/js/input-masks.jquery.js"></script>';
            }
            if ($this->uri->segment(1) == 'acceptanceform') {
                echo '<script src="'.base_url().'assets/js/acceptance-form.jquery.js"></script>';
            } elseif ($this->uri->segment(1) == 'auditorform') {
                echo '<script src="'.base_url().'assets/js/auditorform.jquery.js"></script>';
            } elseif ($this->uri->segment(1) == 'form_g') {
                echo '<script src="'.base_url().'assets/js/form-g.jquery.js"></script>';
            }
            echo $before_closing_body;
            // print new tab javascript for printing forms from backend
            if ($this->uri->segment(2) == 'form_g_print') {
                echo '<script type="text/javascript">window.print();</script>';
            } ?>
    </body>
</html>
