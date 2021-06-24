<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/_parts/header_view'); ?>
<div class="container-fluid">
    <?php echo $the_view_content; ?>
</div>
<?php $this->load->view('templates/_parts/footer_view');?>