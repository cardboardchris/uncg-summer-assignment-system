<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Acceptanceform_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function save($data)
    {
        $this->db->set($data);
        $this->db->insert('acceptance_form');
    }

    function get_settings()
    {
        $this->db->select('grad_value, ugrad_value, multiplier, email');
        $settings = $this->db->get('acceptance_settings');
        return $settings;
    }

    function get_acceptance_by_spartanid($spartanid)
    {
        $this->db->select('date, course_number, course_section, course_campus, course_accept, course_prorate, course_decline, course_minimum, status');
        $this->db->where('spartanid', $spartanid);
        $this->db->where('status', 'active');
        $this->db->from('acceptance_form');
        $date = $this->db->get()->result();
        if ($date) {
            return $date;
        } else {
            return 'none';
        }
    }

    function get_accepted_courses_by_spartanid($spartanid)
    {
        $this->db->select('date, course_number, course_section, course_campus, course_accept, course_prorate, course_decline, course_minimum, status');
        $this->db->where('spartanid', $spartanid);
        $this->db->where('status', 'active');
        $this->db->from('acceptance_form');
        $courses = $this->db->get()->result();
        $accepted_courses = array();
        foreach ($courses as $course) {
            if ($course->course_accept == 'yes') {
                $accepted_courses[] = $course;
            }
        }
        return $accepted_courses;
    }

}
