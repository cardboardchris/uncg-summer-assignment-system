<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Form_g_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function save_user($data)
    {
        $this->db->set($data);
        $this->db->insert('form_g_users');
    }

    function save_course($data)
    {
        $this->db->set($data);
        $this->db->insert('form_g_courses');
    }

    function get_form_id_by_spartanid($spartanid)
    {
        $this->db->select('id, form_id');
        $this->db->where('spartan_id', $spartanid);
        $record = $this->db->get('form_g_users');
        if ($record->result()) {
            return $record;
        } else {
            return 'new';
        }
    }

    function get_course_data_by_id($id)
    {
        $this->db->select('form_id, course_term, course_crn, course_subject, course_number, course_section, course_credits, course_campus, course_stipend, course_position, course_hours, course_note');
        $this->db->where('id', $id);
        $this->db->from('form_g_courses');
        $record = $this->db->get();

        return $record->result()[0];
    }

    function get_courses($state, $campus, $subject)
    {
        $this->db->select('id, form_id, course_term, course_crn, course_subject, course_number, course_section, course_credits, course_campus, course_stipend, course_position, course_hours, course_note');
        $this->db->from('form_g_courses');
        if ($state !== null) {
            $this->db->where($state, 1);
        }
        if ($campus == 'G') {
            $this->db->where('course_campus', 'G');
        } elseif ($campus == 'OS') {
            $this->db->where("(course_campus = 'O' OR course_campus = 'S')", NULL, FALSE);
        }
        if ($subject !== 'all') {
            $this->db->where('course_subject', $subject);
        }
        $this->db->order_by('form_id DESC');
        $records = $this->db->get();
        return $records;
    }

    function get_users($department, $affiliation)
    {
        $this->db->select('id, form_id, date, department, school, department_head, org, preparer_name, preparer_email, preparer_phone, prefix, first_name, middle_name, last_name, spartan_id, email, phone, address, city, state, zip, citizenship, visa_type, visa_expires, campus_building, campus_room, affiliation, employee_status, employee_type, employee_time, employee_eclass, salary, student_status, student_type, student_time, student_eclass, grad_month, grad_year, comments, revisions');
        $this->db->from('form_g_users');
        if ($department !== 'all') {
            $this->db->where('department', $department);
        }
        if ($affiliation !== 'all') {
            $this->db->where('affiliation', $affiliation);
        }
        $records = $this->db->get();
        return $records;
    }

    function count_rows_by_state($state) {
        $this->db->select('id');
        $this->db->from('form_g_courses');
        $this->db->where($state, 1);
        $records = $this->db->get();
        return $records->num_rows();
    }

    function get_form($form_id)
    {
        $this->db->select('id, form_id, date, department, school, department_head, org, preparer_name, preparer_email, preparer_phone, prefix, first_name, middle_name, last_name, spartan_id, email, phone, address, city, state, zip, citizenship, visa_type, visa_expires, campus_building, campus_room, affiliation, employee_status, employee_type, employee_time, employee_eclass, salary, student_status, student_type, student_time, student_eclass, grad_month, grad_year, comments, revisions');
        $this->db->where('form_id', $form_id);
        $this->db->from('form_g_users');
        $user = $this->db->get()->result()[0];
        $this->db->select('id, form_id, course_term, course_crn, course_subject, course_number, course_section, course_credits, course_campus, course_stipend, course_position, course_hours, course_note, active, verified, archived');
        $this->db->where('form_id', $form_id);
        $this->db->from('form_g_courses');
        $courses = $this->db->get()->result();
        $form_data = array(
            'user' => $user,
            'courses' => $courses
            );
        return $form_data;
    }

    function delete($form_id)
    {
        $this->db->where('form_id', $form_id);
        $this->db->delete('form_g_users');
        $this->db->where('form_id', $form_id);
        $this->db->delete('form_g_courses');
    }

    function delete_course($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('form_g_courses');
    }

    function delete_marked($form_ids)
    {
        $this->db->where_in('form_id', $form_ids);
        $this->db->delete('form_g_users');
        $this->db->where_in('form_id', $form_ids);
        $this->db->delete('form_g_courses');
    }

    function activate_marked($form_ids)
    {
        $array = array(
            'active' => 1,
            'verified' => 0,
            'archived' => 0
        );
        $this->db->set($array);
        $this->db->where_in('form_id', $form_ids);
        $this->db->update('form_g_courses');
    }

    function archive_marked($form_ids)
    {
        $array = array(
            'active' => 0,
            'verified' => 0,
            'archived' => 1
        );
        $this->db->set($array);
        $this->db->where_in('form_id', $form_ids);
        $this->db->update('form_g_courses');
    }

    function update_course($state, $campus, $form_id)
    {
        $array = array(
            'active' => 0,
            'verified' => 0,
            'archived' => 0
        );
        $array[$state] = 1;
        $this->db->set($array);
        $this->db->set($state, 1);
        $this->db->where('form_id', $form_id);
        if ($campus == 'OS') {
            $this->db->where('course_campus', 'O');
            $this->db->or_where('course_campus', 'S');
        } elseif ($campus == 'G') {
            $this->db->where('course_campus', $campus);
        }
        $this->db->update('form_g_courses');
    }

    function update_user($form_id, $field, $content)
    {
        $this->db->set($field, $content);
        $this->db->where('form_id', $form_id);
        $this->db->update('form_g_users');
    }

    function update_all($form_id, $user_data, $course_data)
    {
        $this->db->set($user_data);
        $this->db->where('form_id', $form_id);
        $this->db->update('form_g_users');
        foreach ($course_data as $course) {
            if ($course['id'] !== 'new') {
                $this->db->set($course);
                $this->db->where('id', $course['id']);
                $this->db->update('form_g_courses');
            } else {
                $this->db->set($course);
                $this->db->insert('form_g_courses');
            }
        }
    }

    function get_terms()
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

    function get_stipend_minimum()
    {
        $this->db->select('min_stipend');
        $minimum_stipend = $this->db->get('form_g_settings')->result()[0]->min_stipend;
        return $minimum_stipend;
    }

    function save_settings($settings_array)
    {
        $this->db->where('id', 1);
        $this->db->update('form_g_settings', $settings_array);
    }
}
