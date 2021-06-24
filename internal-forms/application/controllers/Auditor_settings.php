<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auditor_settings extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('auditor_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $settings = $this->auditor_model->get_settings()->result();
        $this->data['email'] = $settings[0]->email;
        $this->data['semester'] = $settings[0]->semester;
    }

    public function index()
    {
        $this->render('auditor_settings_view');
    }

    public function save()
    {
        $email = $this->input->post('email');
        $semester = $this->input->post('semester');
        $this->auditor_model->save_settings($email, $semester);
        $_SESSION['flashdata']['message'] = 'Settings updated';
        redirect('auditor_dashboard', 'refresh');
    }
}
