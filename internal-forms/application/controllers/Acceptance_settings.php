<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Acceptance_settings extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('acceptance_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $settings = $this->acceptance_model->get_settings()->result();
        $this->data['email'] = $settings[0]->email;
        $this->data['ugrad_value'] = $settings[0]->ugrad_value;
        $this->data['grad_value'] = $settings[0]->grad_value;
        $this->data['multiplier'] = $settings[0]->multiplier;
        $this->data['view'] = 'settings';
    }

    public function index()
    {
        $this->render('acceptance_settings_view');
    }

    public function save()
    {
        $grad_value = $this->input->post('grad_value');
        $ugrad_value = $this->input->post('ugrad_value');
        $email = $this->input->post('email');
        $multiplier = $this->input->post('multiplier');
        $this->acceptance_model->save_settings($grad_value, $ugrad_value, $multiplier, $email);
        $_SESSION['flashdata']['message'] = 'Settings updated';
        redirect('acceptance_dashboard', 'refresh');
    }
}
