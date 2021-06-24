<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    protected $data = array();
    function __construct()
    {
        parent::__construct();
        ////////////////////////////////////////////////////////////
        session_start();
        // get shibboleth variables depending on environment
        if (ENVIRONMENT == 'development') {
            $_SERVER['cn'] = 'cmmetivi';
            $_SERVER['givenName'] = 'Chris';
            $_SERVER['sn'] = 'Metivier';
        }
        // get array of session variables from shibboleth session
        $_SESSION['userdata'] = array(
            'username' => strtolower($_SERVER['cn']),
            'first' => $_SERVER['givenName'],
            'last' => $_SERVER['sn']
        );
        $userdata = $_SESSION['userdata'];
        ////////////////////////////////////////////////////////////
        $this->load->model('user_access_model');
        $this->user_access_model->update_user_name($userdata['username'], $userdata['first'], $userdata['last']);
        $userdata['access_level'] = $this->user_access_model->get_access_level($userdata['username']);
        $userdata['role'] = $this->user_access_model->get_role($userdata['username']);
        $this->data['userdata'] = $userdata;
        $_SESSION['userdata'] = $userdata;
        $this->data['page_title'] = 'UNCG Online Digital Forms';
        $this->data['dashboard_name'] = '';
        $this->data['before_closing_head'] = '';
        $this->data['before_closing_body'] = '';
        $this->data['dashboard_page'] = '';
        $this->data['settings_page'] = '';
    }

    protected function render($the_view = null, $template = 'master')
    {
        if ($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        } elseif (is_null($template)) {
            $this->load->view($the_view, $this->data);
        } else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, true);
            $this->load->view('templates/'.$template.'_view', $this->data);
        }
    }
}
