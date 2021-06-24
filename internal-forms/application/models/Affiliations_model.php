<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Affiliations_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    // use this only to update all users' affiliations in the database
    function update_affiliations()
    {
        $this->db->select('id, spartan_id, affiliation, employee_status, student_status');
        $this->db->from('form_g_users');
        $records = $this->db->get()->result();
        echo '<pre>';
        print_r($records);
        echo '</pre><hr>';
        foreach ($records as $user_array) {
            if ($user_array->employee_status == 'yes' && $user_array->student_status == 'no') {
                $affiliation = 'Current UNCG Employee';
            } elseif ($user_array->employee_status == 'no' && $user_array->student_status == 'yes') {
                $affiliation = 'Current UNCG Student';
            } elseif ($user_array->employee_status == 'no' && $user_array->student_status == 'no') {
                if ($user_array->spartan_id == '') {
                    $affiliation = 'New Hire';
                } else {
                    $affiliation = 'Previously Affiliated';
                }
            } else {
                $affiliation = 'Current UNCG Employee & Student';
            } // endif

            $this->db->set('affiliation', $affiliation);
            $this->db->where('id', $user_array->id);
            $this->db->update('form_g_users');
        } // end foreach
        echo '<pre>';
        print_r($records);
        echo '</pre>';
        exit;
    }
}
