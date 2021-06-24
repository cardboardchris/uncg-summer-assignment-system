<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_directory extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('template');
    }

	public function index()
	{
		$this->render('home_directory_view');
	}
}
