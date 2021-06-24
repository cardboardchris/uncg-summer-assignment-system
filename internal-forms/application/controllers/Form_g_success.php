<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_g_success extends MY_Controller
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
        $this->data['page_title'] = "Form G Submitted";
        $this->data['before_closing_head'] = '<link rel="stylesheet" type="text/css" media="all" href="'.base_url('assets/css/form-g.css').'">';
        $form_id = $this->uri->segment(2);
        $form_data = $this->form_g_model->get_form($form_id);
        $user_data = (array) $form_data['user']; // convert object to array
        // check if user is new hire
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
        $_SESSION['dept_info'] = array(
            'department' => $user_data['department'],
            'org' => $user_data['org'],
            'school' => $user_data['school'],
            'preparer_name' => $user_data['preparer_name'],
            'preparer_email' => $user_data['preparer_email'],
            'preparer_phone' => $user_data['preparer_phone'],
            'campus_room' => $user_data['campus_room'],
            'campus_building' => $user_data['campus_building'],
            'campus_room' => $user_data['campus_room'],
            'department_head' => $user_data['department_head'],
        );
        $this->data['session_1_total'] = $session_1_total; // number
        $this->data['session_2_total'] = $session_2_total; // number
        $this->data['grand_total'] = $session_1_total + $session_2_total; // number
        $this->data['user_data'] = $user_data;
        $this->data['all_courses'] = $all_courses;
        $this->data['terms'] = $this->form_g_model->get_terms();
        $this->data['state'] = 'success';
        $this->data['campus'] = 'GOS';
        $this->render('form_g_view');
    }
}
