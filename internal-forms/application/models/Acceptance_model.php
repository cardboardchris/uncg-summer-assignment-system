<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Acceptance_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->dbutil();
    }

    function save($data)
    {
        $this->db->set($data);
        $this->db->insert('acceptance_form');
    }

    public function get_submissions($status)
    {
        $this->db->select('id, date, pre_filled, firstname, middleinitial, lastname, email, spartanid, employeestatus, summerstudent, summerstatus, fallstudent, fallstatus, course_number, course_section, course_campus, course_minimum, course_accept, course_prorate, course_decline, signature_accept, signature');
        $this->db->where('status', $status);
        $this->db->order_by('date DESC, lastname ASC, firstname ASC');
        $requests = $this->db->get('acceptance_form');
        return $requests;
    }

    function get_submission($id)
    {
        $this->db->select('firstname, middleinitial, lastname, email, spartanid, date');
        $this->db->where('id', $id);
        $request = $this->db->get('acceptance_form');
        return $request;
    }

    function get_single_submission($spartanid, $course_number)
    {
        $this->db->select('date');
        $this->db->where('spartanid', $spartanid);
        $this->db->where('course_number', $course_number);
        $this->db->from('acceptance_form');
        $record = $this->db->get();
        return $record;
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('acceptance_form');
    }

    function delete_marked($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->delete('acceptance_form');
    }

    function activate_marked($ids)
    {
        $array = array(
            'active' => 1,
            'completed' => 0
        );
        $this->db->set($array);
        $this->db->where_in('id', $ids);
        $this->db->update('acceptance_form');
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
        $this->db->update('acceptance_form');
    }

    function update_all($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('acceptance_form');
    }

    // settings functions //

    function get_settings()
    {
        $this->db->select('grad_value, ugrad_value, multiplier, email');
        $settings = $this->db->get('acceptance_settings');
        return $settings;
    }

    function save_settings($grad_value, $ugrad_value, $multiplier, $email)
    {
        $this->db->set('grad_value', $grad_value);
        $this->db->set('ugrad_value', $ugrad_value);
        $this->db->set('multiplier', $multiplier);
        $this->db->set('email', $email);
        $this->db->where('id', 1);
        $this->db->update('acceptance_settings');
    }
}
