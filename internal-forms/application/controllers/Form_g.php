<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_g extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('form_g_model');
        $this->load->model('departments_model');
        $this->load->model('positions_model');
        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->helper('url');
    }

    public function index()
    {
        // validation rules
        $this->form_validation->set_rules('department', 'department', 'required');
        $this->form_validation->set_rules('org', 'ORG number', 'required');
        $this->form_validation->set_rules('school', 'school or college', 'required');
        $this->form_validation->set_rules('preparer-name', 'preparer\'s name', 'required');
        $this->form_validation->set_rules('preparer-email', 'preparer\'s email', 'required');
        $this->form_validation->set_rules('preparer-phone', 'preparer\'s phone number', 'required');
        $this->form_validation->set_rules('campus-room', 'office room number', 'required');
        $this->form_validation->set_rules('campus-building', 'office building', 'required');
        $this->form_validation->set_rules('department-head', 'department chair', 'required');
        $this->form_validation->set_rules('prefix', 'preferred prefix', 'required');
        $this->form_validation->set_rules('firstname', 'first name', 'required');
        $this->form_validation->set_rules('lastname', 'last name', 'required');
        $this->form_validation->set_rules('email', 'email address', 'required');
        $this->form_validation->set_rules('phone', 'contact phone number', 'required');
        // stipend grand total is required because it will be empty only if no course rows are filled
//        $this->form_validation->set_rules('grand-total', 'stipend total', 'required', array('required' => 'You must enter at least one assignment.'));

        if ($this->form_validation->run() == FALSE)
            {
                $this->data['page_title'] = "Form G";
                $this->data['state'] = 'new';
                $this->data['terms'] = $this->form_g_model->get_terms();
                $this->data['departments'] = $this->departments_model->get_departments();
                if(isset($_SESSION['dept_info'])) {
                    $this->data['user_data'] = $_SESSION['dept_info'];
                }
                // pass array of courses with no values except for term (for use in course row template)
                $this->data['all_courses'] = array(
                    1 => array('course_term' => 1),
                    2 => array('course_term' => 1),
                    3 => array('course_term' => 1),
                    4 => array('course_term' => 6),
                    5 => array('course_term' => 6),
                    6 => array('course_term' => 6),
                );
                $this->render_view('new');
            }
            else
            {
                $this->submit();
            }
    }

    function render_view($state = null)
    {
        if (!$state) {
            $state = $this->uri->segment(4);
        }
        $this->data['state'] = $state;
        $this->data['before_closing_head'] = '<link rel="stylesheet" type="text/css" media="all" href="'.base_url('assets/css/form-g.css').'">';
        $this->data['before_closing_head'] .= "\n".'<link rel="stylesheet" type="text/css" media="print" href="'.base_url('assets/css/form-g-print.css').'">';
        $this->data['before_closing_body'] = '<script src="'.base_url('assets/js/form-g.jquery.js').'"></script>';
        $this->data['before_closing_body'] .= '<script src="'.base_url().'assets/js/jquery.inputmask.bundle.min.js"></script>';
        $this->data['positions'] = $this->positions_model->get_positions();

        $this->render('form_g_view');
    }

    function clear()
    {
        if(isset($_SESSION['dept_info'])) {
            unset($_SESSION['dept_info']);
            $this->data['user_data'] = null;
        }
        redirect('form_g');
    }

    function submit()
    {
        $state = $this->uri->segment(4);
        $form_id = str_replace(' ', '_', trim($this->input->post('firstname')).'_'.trim($this->input->post('lastname')).'_'.time());
        $user_data = array(
            'form_id' => $form_id,
            'department' => $this->input->post('department'),
            'org' => trim($this->input->post('org')),
            'department_head' => trim($this->input->post('department-head')),
            'school' => $this->input->post('school'),
            'preparer_name' => trim($this->input->post('preparer-name')),
            'preparer_email' => trim($this->input->post('preparer-email')),
            'preparer_phone' => trim($this->input->post('preparer-phone')),
            'prefix' => $this->input->post('prefix'),
            'first_name' => trim($this->input->post('firstname')),
            'middle_name' => trim($this->input->post('middlename')),
            'last_name' => trim($this->input->post('lastname')),
            'spartan_id' => trim($this->input->post('spartanid')),
            'email' => trim($this->input->post('email')),
            'phone' => trim($this->input->post('phone')),
            'address' => trim($this->input->post('address')),
            'city' => trim($this->input->post('city')),
            'state' => trim($this->input->post('state')),
            'zip' => trim($this->input->post('zip')),
            'citizenship' => $this->input->post('citizenship'),
            'visa_type' => $this->input->post('visa-type'),
            'visa_expires' => trim($this->input->post('visa-expires')),
            'employee_status' => trim($this->input->post('employeestatus')),
            'employee_type' => 'EHRA',
            'employee_time' => $this->input->post('employeetime'),
            'employee_eclass' => $this->input->post('employee-eclass'),
            'salary' => preg_replace("/[^0-9\s\.]/", "", $this->input->post('salary')),
            'student_status' => $this->input->post('studentstatus'),
            'student_type' => $this->input->post('studenttype'),
            'student_time' => $this->input->post('studenttime'),
            'student_eclass' => $this->input->post('student-eclass'),
            'grad_month' => trim($this->input->post('grad-month')),
            'grad_year' => trim($this->input->post('grad-year')),
            'campus_building' => trim($this->input->post('campus-building')),
            'campus_room' => trim($this->input->post('campus-room')),
            'comments' => trim(str_replace(array("\r","\n","\t"), ' ', $this->input->post('comments')))
            );

            // get user's affiliation from employment & student statuses
            if ($user_data['employee_status'] == 'yes' && $user_data['student_status'] == 'no') {
                $user_data['affiliation'] = 'Current UNCG Employee';
            } elseif ($user_data['employee_status'] == 'no' && $user_data['student_status'] == 'yes') {
                $user_data['affiliation'] = 'Current UNCG Student';
            } elseif ($user_data['employee_status'] == 'no' && $user_data['student_status'] == 'no') {
                if ($user_data['spartan_id'] == '') {
                    $user_data['affiliation'] = 'New Hire';
                } else {
                    $user_data['affiliation'] = 'Previously Affiliated';
                }
            } else {
                $user_data['affiliation'] = 'Current UNCG Employee & Current Student';
            } // endif

		$this->form_g_model->save_user($user_data);

        for ($i=1; $i <= 6; $i++) {
            if(!empty($this->input->post('course-'.$i.'-position'))) {
                if ($this->input->post('course-'.$i.'-crn') !== "") {
                    $crn = trim($this->input->post('course-'.$i.'-crn'));
                } else {
                    $crn = null;
                }
                if ($this->input->post('course-'.$i.'-hours') !== "") {
                    $hours_worked = round(preg_replace("/[^0-9\s\.]/", "", $this->input->post('course-'.$i.'-hours')));
                } else {
                    $hours_worked = null;
                }
                if ($this->input->post('course-'.$i.'-credits') !== "") {
                    $credit_hours = round(preg_replace("/[^0-9\s\.]/", "", $this->input->post('course-'.$i.'-credits')));
                } else {
                    $credit_hours = null;
                }
                $course_data = array(
                    'form_id' => $form_id,
                    'course_term' => trim($this->input->post('course-'.$i.'-term')),
                    'course_position' => trim($this->input->post('course-'.$i.'-position')),
                    'course_crn' => $crn,
                    'course_subject' => strtoupper(trim($this->input->post('course-'.$i.'-subject'))),
                    'course_number' => trim($this->input->post('course-'.$i.'-number')),
                    'course_section' => trim($this->input->post('course-'.$i.'-section')),
                    'course_campus' => strtoupper(trim($this->input->post('course-'.$i.'-campus'))),
                    'course_credits' => $credit_hours,
                    'course_hours' => $hours_worked,
                    'course_stipend' => preg_replace("/[^0-9\s\.]/", "", $this->input->post('course-'.$i.'-stipend'))
                    );
                $this->form_g_model->save_course($course_data);
            }
        }

        redirect('form_g_success/'.$form_id);
    }
}
