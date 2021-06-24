<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Positions_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_positions()
    {
        $this->db->select('position, description, course_specific');
        $this->db->from('course_positions');
        $rows = $this->db->get()->result();

        return $rows;
    }

    function create_positions()
    {
        $positions = array(
            array(
                'position' => 'Instructor',
                'description' => 'Instructor',
                'course_specific' => 1
                ),
            array(
                'position' => 'Lab Assistant',
                'description' => 'Lab Assistant (non-student)',
                'course_specific' => 1
                ),
            array(
                'position' => 'Grad Assistant',
                'description' => 'Graduate Assistant (grad student)',
                'course_specific' => 1
                ),
            array(
                'position' => 'Teaching Assistant',
                'description' => 'Teaching Assistant (grad student)',
                'course_specific' => 1
                ),
            array(
                'position' => 'Sr. Teaching Assistant',
                'description' => 'Sr. Teaching Assistant (grad student)',
                'course_specific' => 1
                ),
            array(
                'position' => 'Undergraduate',
                'description' => 'Undergraduate Student Position',
                'course_specific' => 0
                ),
            array(
                'position' => 'Bio Preparator',
                'description' => 'Bio Preparator &amp; Coordinator',
                'course_specific' => 0
                ),
            array(
                'position' => 'Stockroom Supervisor',
                'description' => 'Stockroom Supervisor',
                'course_specific' => 0
                ),
            array(
                'position' => 'Chemistry Lab Manager',
                'description' => 'Chemistry Lab Manager',
                'course_specific' => 0
                ),
            array(
                'position' => 'IAR Woodshop Supervisor',
                'description' => 'IAR Woodshop Supervisor',
                'course_specific' => 0
                ),
            array(
                'position' => 'Spanish Tutor',
                'description' => 'Spanish Tutor',
                'course_specific' => 0
                ),
            array(
                'position' => 'Math &amp; Statistics Help Center',
                'description' => 'Math &amp; Statistics Help Center',
                'course_specific' => 0
                ),
            array(
                'position' => 'Student Success Center',
                'description' => 'Student Success Center',
                'course_specific' => 0
                ),
            array(
                'position' => 'Writing Center Hourly Consultant',
                'description' => 'Writing Center Hourly Consultant',
                'course_specific' => 0
                ),
            array(
                'position' => 'Writing Center Manager',
                'description' => 'Writing Center Manager',
                'course_specific' => 0
                ),
            array(
                'position' => 'Writing Center Grad Assistant',
                'description' => 'Writing Center Graduate Assistant',
                'course_specific' => 0
                ),
            array(
                'position' => 'Writing Center Administrator',
                'description' => 'Writing Center Administrator',
                'course_specific' => 0
                ),
            array(
                'position' => 'Speaking Center TA',
                'description' => 'Speaking Center Teaching Assistant (graduate student)',
                'course_specific' => 0
                ),
            array(
                'position' => 'Speaking Center Tutor',
                'description' => 'Speaking Center Tutor (undergrad student)',
                'course_specific' => 0
                ),
            array(
                'position' => 'Speaking Center',
                'description' => 'Speaking Center Other Staff',
                'course_specific' => 0
                ),
            array(
                'position' => 'other',
                'description' => 'other (describe in comments)',
                'course_specific' => 0
                )
        );
        for ($i=0; $i < count($positions); $i++) {
            $this->db->set($positions[$i]);
            $this->db->insert('course_positions');
        }
    }
}