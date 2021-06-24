<?php defined('BASEPATH') OR exit('No direct script access allowed')?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?=$page_title?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url('assets/css/style.css')?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <?=$before_closing_head?>
</head>
<body>
    <?php
    $no_navbar_views = array('form_g', 'form_g_print', 'form_g_success');
    if (!in_array($this->uri->segment(1), $no_navbar_views)) { ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="main-navigation">
        <a class="navbar-brand" href="<?=site_url()?>"><?=$page_title?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navigation" aria-controls="main-navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?=site_url()?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <!-- show dashboard select for users with level 2 or above -->
                <?php if ($userdata['access_level'] > 1) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            dashboards
                        </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?=site_url('acceptance_dashboard')?>">Acceptance</a>
                        <a class="dropdown-item" href="<?=site_url('auditor_dashboard')?>">Auditors</a>
                        <a class="dropdown-item" href="<?=site_url('form_g_dashboard')?>">Form G</a>
                    </div>
                    </li>
                <?php } //endif ?>
                <?php
                if ($this->uri->segment(1) == 'acceptance_dashboard') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=site_url('acceptance_settings')?>">Acceptance Form Settings</a>
                    </li>
                <?php } elseif ($this->uri->segment(1) == 'auditor_dashboard') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=site_url('auditor_settings')?>">Auditor Form Settings</a>
                    </li>
                <?php } elseif ($this->uri->segment(1) == 'form_g_dashboard') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=site_url('form_g_settings')?>">Form G Settings</a>
                    </li>
                <?php } //endif ?>
            </ul> <!-- navbar-nav mr-auto -->
            <div class="user-info my-2 my-lg-0">
                Logged in as <?php echo $userdata['first'].' '.$userdata['last']; ?> | Role: <?=$userdata['role']?>
            </div><!-- user-info -->
        </div>
    </nav>
<?php } //endif
if (array_key_exists('flashdata', $_SESSION)) { ?>
    <div class="container-fluid">
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
            <?php
                echo $_SESSION['flashdata']['message'];
                unset($_SESSION['flashdata']);
            ?>
        </div>
    </div>
<?php } //endif
