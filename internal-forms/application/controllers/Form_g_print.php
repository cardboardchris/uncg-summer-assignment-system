<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_g_print extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('form_g_model');
        $this->load->library('template');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->data['page_title'] = "Print";
        $this->data['before_closing_head'] = '<link rel="stylesheet" type="text/css" media="all" href="'.base_url('assets/css/form-g.css').'">';
        $this->data['before_closing_head'] .= "\n".'<link rel="stylesheet" type="text/css" media="print" href="'.base_url('assets/css/form-g-print.css').'">';
        $this->data['before_closing_body'] .= "\n".'<script type="text/javascript">window.print();</script>';
        $form_id = $this->uri->segment(2);
        $campus = $this->uri->segment(3);
        $form_data = $this->form_g_model->get_form($form_id);
        $user_data = (array) $form_data['user']; // convert object to array
        // get user's affiliation
        if ($user_data['employee_status'] == 'yes' && $user_data['student_status'] == 'no') {
            $user_data['affiliation'] = 'Current UNCG Employee';
        } elseif ($user_data['employee_status'] == 'no' && $user_data['student_status'] == 'yes') {
            $user_data['affiliation'] = 'Current UNCG Student';
        } elseif ($user_data['employee_status'] == 'no' && $user_data['student_status'] == 'no') {
            $user_data['affiliation'] = 'New Hire';
        } else {
            $user_data['affiliation'] = 'Current UNCG Employee & Current Student';
        } // endif

        $courses_data = $form_data['courses']; // array of objects
        $session_1_total = 0;
        $session_2_total = 0;
        $session_1_courses = array();
        $session_2_courses = array();
        foreach ($courses_data as $course_object) {
            if ($course_object->course_term == '1' || $course_object->course_term == '2' || $course_object->course_term == '5' || $course_object->course_term == '7') {
                $session_1_total += $course_object->course_stipend;
                $session_1_courses[] = $course_object;
            } else {
                $session_2_total += $course_object->course_stipend;
                $session_2_courses[] = $course_object;
            }
        }
        $all_courses = array();
        for ($i=1; $i <= 6; $i++) {
            if (isset($courses_data[$i-1])) {
                $all_courses[$i] = (array) $courses_data[$i-1];
            }
        }
        $this->data['session_1_total'] = $session_1_total; // number
        $this->data['session_2_total'] = $session_2_total; // number
        $this->data['grand_total'] = $session_1_total + $session_2_total; // number
        $this->data['user_data'] = $user_data;
        $this->data['all_courses'] = $all_courses;
        $this->data['terms'] = $this->form_g_model->get_terms();
        $this->data['state'] = 'print';
        $this->data['campus'] = $campus;
        $this->render('form_g_view');
    }
}
