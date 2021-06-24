<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auditorform_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function save($data)
    {
        $this->db->set($data);
        $this->db->insert('auditor_form');
    }

    function get_submissions($flag, $type)
    {
        if ($type == 'personal') {
        $this->db->select('semester, semester_year, lastname, firstname, middleinitial, address, city, state, zip, gender, birthdate, homephone, cellphone, email, citizen, ethnicity');
            $this->db->order_by('semester_year ASC, semester DESC, lastname ASC, firstname ASC');
        } elseif ($type == 'course') {
        $this->db->select('lastname, firstname, address, cellphone, email, crn, course_number, course_title, course_instructor');
            $this->db->order_by('date DESC, semester_year ASC, semester DESC, lastname ASC, firstname ASC');
        } else {
            $this->db->select('id, date, firstname, middleinitial, lastname, address, city, state, zip, ethnicity, birthdate, gender, citizen, homephone, cellphone, email, high_school_grad, high_school_grad_year, college_grad, college_grad_year, previously_attended, attended_for_credit, attended_dates_from, attended_dates_to, current_enrollment, enrolled_dates_from, enrolled_dates_to, crn, course_number, course_title, course_instructor, semester, semester_year, comments, convicted, convicted_date, guilty_plea, responsible_for_crime, pending_crime, school_discipline, military_discharge, crime_explanation, signature');
        }
        $this->db->where($flag, 1);
        $this->db->order_by('date DESC, lastname ASC, firstname ASC');
        $requests = $this->db->get('auditor_form');
        return $requests;
    }

    function get_submission($id)
    {
        $this->db->select('firstname, middleinitial, lastname, email, spartanid');
        $this->db->where('id', $id);
        $request = $this->db->get('auditor_form');
        return $request;
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('auditor_form');
    }

    function delete_marked($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->delete('auditor_form');
    }

    function activate_marked($ids)
    {
        $array = array(
            'active' => 1,
            'completed' => 0
        );
        $this->db->set($array);
        $this->db->where_in('id', $ids);
        $this->db->update('auditor_form');
    }

    function update($status, $id)
    {
        $array = array(
            'active' => 0,
            'completed' => 0
        );
        $this->db->set($array);
        $this->db->set($status, 1);
        $this->db->where('id', $id);
        $this->db->update('auditor_form');
    }

    function update_all($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('auditor_form');
    }

    function get_settings()
    {
        $this->db->select('email, semester');
        $this->db->from('auditor_settings');
        $settings = $this->db->get();
        return $settings;
    }

    function save_settings($email, $semester)
    {
        $this->db->set('email', $email);
        $this->db->set('semester', $semester);
        $this->db->where('id', 1);
        $this->db->update('auditor_settings');
    }
}
