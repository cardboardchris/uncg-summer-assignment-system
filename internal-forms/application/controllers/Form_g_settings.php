<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_g_settings extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('form_g_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->data['terms'] = $this->form_g_model->get_terms();
        $this->data['minimum_stipend'] = $this->form_g_model->get_stipend_minimum();
        $this->render('form_g_settings_view');
    }

    public function save()
    {
        $settings_array = array();
        for ($i=1; $i <= 8; $i++) {
            $settings_array['term_'.$i.'_start'] = strtotime($this->input->post('term-'.$i.'-start'));
            $settings_array['term_'.$i.'_end'] = strtotime($this->input->post('term-'.$i.'-end'));
        }
        $settings_array['min_stipend'] = $this->input->post('minimum_stipend');
        $this->form_g_model->save_settings($settings_array);
        $_SESSION['flashdata']['message'] = 'Settings updated';
        redirect('form_g_dashboard', 'refresh');
    }
}
