<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Form_g_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function save_user($data)
    {
        $this->db->set($data);
        $this->db->insert('form_g_users');
    }

    public function save_course($data)
    {
        $this->db->set($data);
        $this->db->insert('form_g_courses');
    }

    public function get_courses($state, $campus)
    {
        $this->db->select('id, form_id, course_term, course_crn, course_subject, course_number, course_section, course_credits, course_campus, course_stipend, course_position, course_hours, course_note');
        if ($campus == 'G') {
            $this->db->where(array($state => 1, 'course_campus' => 'G'));
        } elseif ($campus == 'OS') {
            $this->db->where($state, 1);
            $this->db->where("(course_campus = 'O' OR course_campus = 'S')", NULL, FALSE);
        } else {
            $this->db->where($state, 1);
        }
        $this->db->order_by('form_id DESC');
        $records = $this->db->get('form_g_courses');
        return $records;
    }

    function get_form($form_id)
    {
        $this->db->select('id, form_id, date, department, school, department_head, org, preparer_name, preparer_email, preparer_phone, prefix, first_name, middle_name, last_name, spartan_id, email, phone, address, city, state, zip, citizenship, visa_type, visa_expires, campus_building, campus_room, employee_status, employee_type, employee_time, employee_eclass, salary, student_status, student_type, student_time, student_eclass, grad_month, grad_year, comments, revisions');
        $this->db->where('form_id', $form_id);
        $user = $this->db->get('form_g_users')->result();
        $this->db->select('id, form_id, course_term, course_crn, course_subject, course_number, course_section, course_credits, course_campus, course_stipend, course_position, course_hours, course_note, active, verified, archived');
        $this->db->where('form_id', $form_id);
        $courses = $this->db->get('form_g_courses')->result();
        $form_data = array(
            'user' => $user[0],
            'courses' => $courses
            );
        return $form_data;
    }

    function get_form_ids_by_spartanid($spartanid)
    {
        $this->db->select('form_id');
        $this->db->where('spartan_id', $spartanid);
        $this->db->from('form_g_users');
        $form_ids = $this->db->get()->result();
        return $form_ids;
    }

    public function get_terms()
    {
        $this->db->select('term_1_start, term_1_end, term_2_start, term_2_end, term_3_start, term_3_end, term_4_start, term_4_end, term_5_start, term_5_end, term_6_start, term_6_end, term_7_start, term_7_end, term_8_start, term_8_end');
        $settings = $this->db->get('form_g_settings')->result();
        $terms = array();
        for ($i=1; $i <= 8; $i++) {
            $terms[$i]['start'] = $settings[0]->{'term_'.$i.'_start'};
            $terms[$i]['end'] = $settings[0]->{'term_'.$i.'_end'};
        }
        return $terms;
    }

    public function get_stipend_minimum()
    {
        $this->db->select('min_stipend');
        $minimum_stipend = $this->db->get('form_g_settings')->result()[0]->min_stipend;
        return $minimum_stipend;
    }

}
