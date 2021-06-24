<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">    <title><?php echo $page_title;?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <?php
        //if ($this->uri->segment(1)) {
            //echo '<link rel="stylesheet" type="text/css" media="all" href="'.base_url().'assets/css/awesome-bootstrap-checkbox.css">'."\n".
            //'<link rel="stylesheet" type="text/css" media="screen" href="'.base_url().'assets/css/font-awesome.css">';
        //}
    ?>
    <link rel="stylesheet" type="text/css" media="all" href="<?=base_url()?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" media="print" href="<?=base_url()?>assets/css/print.css">
    <?php
        echo $before_closing_head;
    ?>
</head>
<body>
