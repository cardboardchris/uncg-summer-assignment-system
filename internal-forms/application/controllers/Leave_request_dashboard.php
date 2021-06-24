<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave_request_dashboard extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->render_view('active');
    }

    /**
     * prepare view variables and render
     * @since   1.0.0
     * @access  private
     * @param   string  $state      active or approved
     * @return  void
     */
    function render_view($state = null)
    {
        if (!$state) {
            $state = $this->uri->segment(3);
        }
        $this->data['page_title'] = "Leave Request Dashboard";
        $this->data['state'] = $state;

        $this->render('leave_request_dashboard_view');
    }

}
