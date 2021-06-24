<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auditorform extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('auditorform_model');
        $settings = $this->auditorform_model->get_settings()->result();
        $this->data['semester'] = $settings[0]->semester;
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('template');
    }

    public function index()
    {
        $this->data['page_title'] = "Visiting Auditor Registration Form";
//        $this->render('auditor_form_view');
        $this->render('no_access_view');

    }

    private function generateRandomString($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function submit()
    {
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'middleinitial' => $this->input->post('middleinitial'),
            'lastname' => $this->input->post('lastname'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip' => $this->input->post('zip'),
            'ethnicity' => $this->input->post('ethnicity'),
            'birthdate' => $this->input->post('birthdate'),
            'gender' => $this->input->post('gender'),
            'citizen' => $this->input->post('citizen'),
            'homephone' => $this->input->post('homephone'),
            'cellphone' => $this->input->post('cellphone'),
            'email' => $this->input->post('email'),
            'high_school_grad' => $this->input->post('high_school_grad'),
            'high_school_grad_year' => $this->input->post('high_school_grad_year'),
            'college_grad' => $this->input->post('college_grad'),
            'college_grad_year' => $this->input->post('college_grad_year'),
            'previously_attended' => $this->input->post('previously_attended'),
            'attended_for_credit' => $this->input->post('attended_for_credit'),
            'attended_dates_from' => $this->input->post('attended_dates_from'),
            'attended_dates_to' => $this->input->post('attended_dates_to'),
            'current_enrollment' => $this->input->post('current_enrollment'),
            'enrolled_dates_from' => $this->input->post('enrolled_dates_from'),
            'enrolled_dates_to' => $this->input->post('enrolled_dates_to'),
            'crn' => $this->input->post('crn'),
            'course_number' => $this->input->post('course_number'),
            'course_title' => $this->input->post('course_title'),
            'course_instructor' => $this->input->post('course_instructor'),
            'semester' => $this->input->post('semester'),
            'semester_year' => $this->input->post('semester_year'),
            'comments' => $this->input->post('comments'),
            'convicted' => $this->input->post('convicted'),
            'convicted_date' => $this->input->post('convicted_date'),
            'guilty_plea' => $this->input->post('guilty_plea'),
            'responsible_for_crime' => $this->input->post('responsible_for_crime'),
            'pending_crime' => $this->input->post('pending_crime'),
            'school_discipline' => $this->input->post('school_discipline'),
            'military_discharge' => $this->input->post('military_discharge'),
            'crime_explanation' => $this->input->post('crime_explanation'),
            'signature' => $this->input->post('signature')
            );

        $this->auditorform_model->save($data);

        // declare variables for email parts
        $settings = $this->auditorform_model->get_settings()->result();
        $subject = 'Visiting Auditor form submission';

        // set values for internal email
        $internal_recipient = $settings[0]->email;
        $internal_email_content = $data['firstname'].' '.$data['lastname'].' has submitted an visiting auditor application for '.$data['course_number'].': '.$data['course_title'].', '.$data['semester'].' '.$data['semester_year'].'.';

        // set values for user email
        $user_recipient = $data['email'];
        $user_email_content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>  <meta http-equiv="Content-Type" content="text/html; harset=UTF-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0"/></head><body><p>'.$data['firstname'].' '.$data['lastname'].',</p><p>Thank you for your interest in auditing a UNCG course. Please submit your payment online at the link below.</p><p><a href="https://www.nexternal.com/uncg/visiting-auditor-fees-p2868.aspx">https://www.nexternal.com/uncg/visiting-auditor-fees-p2868.aspx</a></p><p>Once classes begin we will request permission from the instructor. We will notify you once approval is received and process your payment.</p><hr><p>If paying by check, make payable to: <strong>UNCG Online</strong></p><p>Mail to:</p><p>UNCG Online<br>POB 26170<br>915 Northridge Street<br>Greensboro, NC 27402-6170<hr>Phone: 336.315.7742<br>Fax: 336.315.7737</p><p><strong>Auditing Fees</strong><br>Lecture Course</p><ul><li>$125 per course </li><li>$0 Senior Citizen (65 and older} </li><li>$50 Faculty/Staff </li><li>$50 Faculty/Staff Spouse</li></ul><p>Physical Activity Course</p><ul><li>$100 per course (No additional discounts because of the nature of the course.)</li></ul><p><strong>Refund Policy</strong><br>A full refund will be given if no space is available, you are denied, or class is cancelled. If you are unable to attend a course, a written request for a refund must be received one week prior to the beginning of the session. After that date a portion or all of the fee will be retained to cover costs.</p><p>Thank you,</p><p>UNCG Online</p></body></html>';

        // prepare library params for sending to UNCG Online
        $this->email->from('auditorform@uncg.edu');
        $this->email->to($internal_recipient);
        $this->email->subject($subject);
        $this->email->message($internal_email_content);
        $this->email->send();

        // prepare library params for sending to user
        $this->email->from('auditorform@uncg.edu');
        $this->email->to($user_recipient);
        $this->email->subject($subject);
        $this->email->message($user_email_content);
        $this->email->send();

        // $this->render('user_email_view');
        echo $this->email->print_debugger();
        $this->render('form_success_view');
    }
}
