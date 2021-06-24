<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_access_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->dbutil();
    }

    function update_user_name($username, $first, $last)
    {
        $this->db->select('username, firstname, lastname, role');
        $this->db->where('username', $username);
        $this->db->from('user_access');
        $record = $this->db->get();
        if ($record->result() !== false) {
            $role = $record->result()[0]->role;
            $data = array(
                'firstname' => $first,
                'lastname' => $last,
                );
            $this->db->set($data);
            $this->db->where('username', $username);
            $this->db->update('user_access');
        }

    }

    function get_access_level($username)
    {
        $this->db->select('access_level');
        $this->db->where('username', $username);
        $this->db->from('user_access');
        $record = $this->db->get();
        if ($record->result()) {
            return $record->result()[0]->access_level;
        } else {
            $data = array(
                'username' => $username,
                'access_level' => 1,
                'role' => 'staff'
                );
            $this->db->set($data);
            $this->db->insert('user_access');
            return 1;
        }
    }

    function get_role($username)
    {
        $this->db->select('role');
        $this->db->where('username', $username);
        $record = $this->db->get('user_access');
        if ($record->result()) {
            return $record->result()[0]->role;
        } else {
            $data = array(
                'username' => $username,
                'access_level' => 1,
                'role' => 'staff'
                );
            $this->db->set($data);
            $this->db->insert('user_access');
            return 'staff';
        }
    }

    function get_users_by_role($role)
    {
        $this->db->select('username, firstname, lastname, role');
        $this->db->where('role', $role);
        $this->db->from('user_access');
        $records = $this->db->get()->result();
        return $records;
    }
}
