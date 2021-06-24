<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Leave_request_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->dbutil();
    }

    public function save($data)
    {
        $this->db->set($data);
        $this->db->insert('leave_requests');
    }

    public function update($status, $id)
    {
        $this->db->set('status', $status);
        $this->db->where('id', $id);
        $this->db->update('leave_requests');
    }

}
