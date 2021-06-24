<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Acceptanceform extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('acceptanceform_model');
        $this->load->model('form_g_model');
        $this->load->library('template');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['page_title'] = "Appointment Acceptance Form Login";
        $this->render('acceptance_form_login_view');
    }

    public function form()
    {
        // get pro-rate values
        $settings = $this->acceptanceform_model->get_settings()->result();
        $this->data['grad_rate'] = $settings[0]->grad_value;
        $this->data['ugrad_rate'] = $settings[0]->ugrad_value;
        $this->data['percent'] = $settings[0]->multiplier/100;
        $this->data['minimum_stipend'] = $this->form_g_model->get_stipend_minimum();
        // load styles
        $this->data['before_closing_head'] = '<link rel="stylesheet" type="text/css" media="all" href="'.base_url().'assets/css/acceptanceform.css">'."\n".
            '<link rel="stylesheet" type="text/css" media="print" href="'.base_url().'assets/css/acceptanceform-print.css">';

        // check spartan id
        if ($this->input->post('spartanid') !== null) {
            $spartanid = $this->input->post('spartanid');
            // get form_ids from any forms that exist for this spartanid
            $form_id_objects = $this->form_g_model->get_form_ids_by_spartanid($spartanid);
            if ($form_id_objects) {
                // if there are any Form Gs associated with this spartan id, get the data for each
                $forms = array();
                foreach ($form_id_objects as $form_id_object) {
                    $forms[] = $this->form_g_model->get_form($form_id_object->form_id);
                }

                // get user's info from the most recent form data.
                $reversed_forms = array_reverse($forms);
                $user_data = $reversed_forms[0]['user'];
                unset($reversed_forms);
                $this->data['verified_user'] = true;

                // get faculty or staff status from eclass
                $faculty_eclasses = array( 'AF', 'E1', 'ER', 'FA', 'FC', 'FE', 'FF', 'FG', 'FO', 'FP', 'FS', 'L1', 'RF' );
                $staff_eclasses = array( 'AJ', 'E2', 'EA', 'EB', 'EC', 'ED', 'EN', 'EP', 'ET', 'RE', 'RW', 'SA', 'SB', 'SC', 'SD', 'SE', 'SF', 'SN', 'SP', 'ST' );
                if (in_array($user_data->employee_eclass, $faculty_eclasses)) {
                    $this->data['employeestatus'] = 'faculty';
                } elseif (in_array($user_data->employee_eclass, $staff_eclasses)) {
                    $this->data['employeestatus'] = 'staff';
                } elseif ($user_data->student_status == 'yes') {
                    $this->data['employeestatus'] = 'student';
                } else {
                    $this->data['employeestatus'] = 'none';
                }

                // check each form to see if it is recent and verified
                foreach ($forms as $key => $form) {
                    // check that the form was sumbitted in the last 6 months (it's not from last year)
                    if (strtotime($form['user']->date) < strtotime('-6 months')) {
                        // old forms can be ignored
                        $forms[$key]['age'] = 'old';
                    } else {
                        $forms[$key]['age'] = 'current';
                    }

                    // check that all courses on the form have been verified
                    if (!empty($form['courses'])) {
                        foreach ($form['courses'] as $course_object) {
                            $form_verified = true;
                            if (!$course_object->verified) {
                                $form_verified = false;
                            }
                            $form_active = true;
                            if (!$course_object->active) {
                                $form_active = false;
                            }
                        }
                        if ($form_verified) {
                            $forms[$key]['status'] = 'verified';
                        } elseif ($form_active) {
                            $forms[$key]['status'] = 'waiting';
                        } else {
                            $forms[$key]['status'] = 'archived';
                        }
                    } // endif
                } // end foreach

                // prepare a single array to hold all current, non-archived course data
                $courses = array();

                // add course data to the new array
                foreach ($forms as $key => $form) {
                    // remove old and archived forms
                    if ($form['age'] == 'old' || (array_key_exists('status', $form) && $form['status'] == 'archived')) {
                        unset($forms[$key]);
                    } else {
                        if (!empty($form['courses'])) {
                            // add course data from remaining forms
                            foreach ($form['courses'] as $course)
                            $courses[] = $course;
                        }
                    }
                }

                // get any courses that have already been accepted
                $accepted_courses = $this->acceptanceform_model->get_accepted_courses_by_spartanid($user_data->spartan_id);
                if (!empty($accepted_courses)) {
                    $courses_temp = array();
                    foreach ($accepted_courses as $course_object) {
                        // only get courses that were accepted in the last 6 months
                        if (strtotime($course_object->date) > strtotime('-6 months')) {
                            // add the full course number with section as a property
                            $course_object->full_course_number = $course_object->course_number.$course_object->course_section;
                            // re-type the course object as an array so it can be searched later
                            $courses_temp[] = (array)$course_object;
                        }
                    }
                    $accepted_courses = $courses_temp;

                    // add all acceptance information to form G information in each course object
                    foreach ($courses as $course_object) {
                        $full_course_number = $course_object->course_subject.$course_object->course_number.$course_object->course_section;

                        // check if each course from $form_data is in the 2D array of accepted courses
                        if(array_search($full_course_number, array_column($accepted_courses, 'full_course_number')) !== false) {
                            $course_object->accepted = true;
                            foreach ($accepted_courses as $course_array) {
                                if ($course_array['full_course_number'] == $full_course_number) {
                                    $course_object->course_accept = $course_array['course_accept'];
                                    $course_object->accept_prorate = $course_array['course_prorate'];
                                    $course_object->minimum_enrollment = $course_array['course_minimum'];
                                    $course_object->accepted_date = $course_array['date'];
                                }
                            }
                        } else {
                            $course_object->accepted = false;
                            $course_object->course_accept = false;
                            $course_object->accept_prorate = false;
                            $course_object->minimum_enrollment = false;
                            $course_object->accepted_date = false;
                        }
                    }
                } else {
                    foreach ($courses as $course_object) {
                        $course_object->accepted = false;
                        $course_object->course_accept = false;
                        $course_object->accept_prorate = false;
                        $course_object->minimum_enrollment = false;
                        $course_object->accepted_date = false;
                    }
                }

                $active_courses = array();
                foreach ($courses as $course_object) {
                    if ($course_object->active == true) {
                        $active_courses[] = $course_object;
                    }
                }

                $verified_courses = array();
                foreach ($courses as $course_object) {
                    if ($course_object->verified == true && $course_object->accepted == false) {
                        $verified_courses[] = $course_object;
                    }
                }

                $accepted_courses = array();
                foreach ($courses as $course_object) {
                    if ($course_object->accepted == true) {
                        $accepted_courses[] = $course_object;
                    }
                }
//echo '<pre>';
//print_r($accepted_courses);
//echo '</pre>';
                $courses = array(
                    'active_courses' => $active_courses,
                    'verified_courses' => $verified_courses,
                    'accepted_courses' => $accepted_courses
                );

            } else { // no form objects found for spartan id
                $user_data = false;
            }

        } else { // no spartan id entered
            $form_id = 'new';
            $user_data = false;
        }

        $this->data['user_data'] = $user_data;
        $this->data['courses'] = $courses;
        $this->data['page_title'] = "Summer Appointment Acceptance Form";
        $this->render('acceptance_form_view');
    }

    public function submit()
    {
        $user_data = array(
            'pre_filled' => $this->input->post('pre-filled'),
            'firstname' => $this->input->post('firstname'),
            'middleinitial' => $this->input->post('middleinitial'),
            'lastname' => $this->input->post('lastname'),
            'spartanid' => $this->input->post('spartanid'),
            'email' => $this->input->post('email'),
            'employeestatus' => $this->input->post('employeestatus'),
            'summerstudent' => $this->input->post('summerstudent'),
            'summerstatus' => $this->input->post('summerstatus'),
            'fallstudent' => $this->input->post('fallstudent'),
            'fallstatus' => $this->input->post('fallstatus'),
            'signature_accept' => $this->input->post('signature-accept'),
            'signature' => $this->input->post('signature'),
            'status' => 'active'
            );
        for ($i=1; $i <= 6; $i++) {
            if(!empty($this->input->post('course-'.$i.'-accept'))) {
                ${'course'.$i} = array(
                    'course_accepted' => $this->input->post('course-'.$i.'-previously-accepted'),
                    'course_number' => $this->input->post('course-'.$i.'-number'),
                    'course_section' => $this->input->post('course-'.$i.'-section'),
                    'course_campus' => $this->input->post('course-'.$i.'-campus'),
                    'course_accept' => $this->input->post('course-'.$i.'-accept'),
                    'course_prorate' => $this->input->post('course-'.$i.'-prorate'),
                    'course_minimum' => $this->input->post('course-'.$i.'-minimum'),
                );
            }
        }

        for ($i=1; $i <= 7; $i++) {
            if (isset(${'course'.$i}) && !${'course'.$i}['course_accepted']) {
                unset(${'course'.$i}['course_accepted']);
                $data = array_merge($user_data, ${'course'.$i});
                $this->acceptanceform_model->save($data);
            }
        }

        // declare variables for email parts
        $settings = $this->acceptanceform_model->get_settings()->result();
        $recipient = $settings[0]->email;
        $subject = 'Appointment confirmation form submission';

        $email_body = 'has submitted an appointment acceptance form for Summer '.date('Y').'.';

        $content = $user_data['firstname'].' '.$user_data['lastname'].' '.$email_body;

        // load library and collect data
        $this->load->library('email');

        // prepare library params for sending
        $this->email->from('acceptanceform@uncg.edu');
        $this->email->to($recipient);
        $this->email->subject($subject);
        $this->email->message($content);
        $this->email->send();

        $this->render('form_success_view');
    }
}
