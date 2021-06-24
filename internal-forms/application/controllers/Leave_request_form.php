<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave_request_form extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->model('user_access_model');
        $this->load->helper('url');
    }

    public function index()
    {
        // // validation rules
        // $this->form_validation->set_rules('department', 'department', 'required');
        // $this->form_validation->set_rules('grand-total', 'stipend total', 'required', array('required' => 'You must enter at least one assignment.'));

        // get user info


        if ($this->form_validation->run() == FALSE)
            {
                $this->data['page_title'] = "Leave Request Form";
                $this->data['before_closing_head'] = '<link rel="stylesheet" type="text/css" media="all" href="'.base_url('assets/css/leave-request-form.css').'">';
                $this->data['before_closing_head'] .= '<link rel="stylesheet" type="text/css" media="all" href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css">';
                $this->data['before_closing_body'] = '<script src="'.base_url('assets/js/leave-request-form.jquery.js').'"></script>';
                $this->data['before_closing_body'] .= '<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js"></script>';
                $this->data['leave_types'] = array(
                    'Vacation Leave',
                    'Sick Leave',
                    'Bonus Leave',
                    'Family Medical Leave',
                    'Community/Civil Involvement',
                    'Leave Without Pay',
                    'Military Leave',
                    'Civil Leave',
                    'Comp Time'
                );

                // get supervisors
                $records = $this->user_access_model->get_users_by_role('supervisor');
                $supervisors = array();
                foreach ($records as $user_object) {
                    $supervisors[$user_object->username] = $user_object->firstname.' '.$user_object->lastname;
                }
                $this->data['supervisors'] = $supervisors;
                $this->render('leave_request_form_view');
            }
            else
            {
                $this->submit();
            }
    }

    function submit()
    {
        $user_data = array(
            'name' => trim($this->input->post('name')),
            'date_submitted' => trim($this->input->post('date')),
            'leave_begin_date' => trim($this->input->post('leave-begin-date')),
            'leave_end_date' => trim($this->input->post('leave-end-date')),
            );

        // $this->form_g_model->save_user($user_data);

        redirect('leave_request_form_success');
    }
}
