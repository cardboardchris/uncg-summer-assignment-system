<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forms extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['page_title'] = "Forms Directory";
        $this->render('forms_directory_view');

    }
}
