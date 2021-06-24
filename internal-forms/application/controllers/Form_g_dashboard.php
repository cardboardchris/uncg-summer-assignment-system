<?php defined('BASEPATH') or exit('No direct script access allowed');

class Form_g_dashboard extends MY_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('form_g_model');
        $this->load->model('acceptance_model');
        $this->load->model('departments_model');
        $this->load->model('positions_model');
        $this->load->library('template');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->render_view('active', 'GOS');
    }

    function editing_user_name()
    {
        return $_SESSION['userdata']['first'].' '.$_SESSION['userdata']['last'];
    }

    function get_counts()
    {
        $num_verified_courses = $this->form_g_model->count_rows_by_state('verified');
        $num_archived_courses = $this->form_g_model->count_rows_by_state('archived');
        $num_active_courses = $this->form_g_model->count_rows_by_state('active');

        echo $num_active_courses.','.$num_verified_courses.','.$num_archived_courses;
    }

    // function for comparing objects by date in an array
    function sort_forms_by_date($a, $b)
    {
        if (strtotime($a['user']->date) < strtotime($b['user']->date)) {
            return 1;
         } else if (strtotime($a['user']->date) > strtotime($b['user']->date)) {
            return -1;
        } else {
            return 0;
        }
    }

    // function for comparing objects by name in an array
    function sort_forms_by_name($a, $b)
    {
        return strcmp($a['user']->last_name, $b['user']->last_name);
    }

    /**
     * get all forms for display
     * @since   1.0.0
     * @access  private
     * @param   string  $state      active, archived, or verified
     * @param   string  $campus     G, O, or S
     * @param   string  $department 3-letter department code
     * @param   string  $subject    3-letter department code
     * @param   string  $sort       name or date
     *
     * @return  array   $forms      array of form objects
     */
    function get_forms($state = null, $campus = null, $department = null, $subject = null, $affiliation = null, $sort = null)
    {

        $users = $this->form_g_model->get_users($department, $affiliation)->result();
        $courses = $this->form_g_model->get_courses($state, $campus, $subject)->result();
        $accepted = $this->acceptance_model->get_submissions('active')->result();
        // convert $accepted from array of objects to 2D array
        $accepted_courses = array();
        foreach ($accepted as $object) {
            $accepted_courses[] = (array) $object;
        }
        unset($accepted);
        // create array of form data by user with form_ids as keys
        // each element contains two objects: [user] and [courses]
        $forms = array();
        // collect all users into an array with form_ids as keys
        $users_by_form_id = array();
        foreach ($users as $user) {
            $users_by_form_id[$user->form_id] = $user;
        }
        unset($users);
        // add the course objects into the array of forms
        foreach ($courses as $course) {
            $form_id = $course->form_id;
            $forms[$form_id]['courses'][] = $course;
        }

        // add the user objects into the array of forms
        foreach ($forms as $form_id => $array) {
            if (isset($users_by_form_id[$form_id])) {
                $user = $users_by_form_id[$form_id];
                $forms[$form_id]['user'] = $user;

                // now that we have both the user data and course data,
                // check for acceptance
                foreach ($array['courses'] as $course_object) {
                    $full_course_number = $course_object->course_subject.$course_object->course_number;

                    // search for the key of the course in $accepted_courses that includes the values that match this course's number
                    $key = array_search($full_course_number, array_column($accepted_courses, 'course_number'));
                    // if there is one, check that the first and last name also match
                    if ($key !== false && $accepted_courses[$key]['firstname'] == $user->first_name && $accepted_courses[$key]['lastname'] == $user->last_name) {
                        // if the course number, and user first name & last name all match
                        // then the course exists in the accepted courses array
                        $course_object->accepted = true;
                        // the key of the course in $accepted_courses is the only unique value in the array of $aacepted_course_variables
                        $accepted_timestamp = strtotime($accepted_courses[$key]['date']);
                        $form_g_received_timestamp = strtotime($user->date);
                        // if the course was accepted after the form g was received (not from a previous year) add the accepted date to the course object
                        if ($accepted_timestamp > $form_g_received_timestamp) {
                            $course_object->accepted_timestamp = $accepted_timestamp;
                        } else {
                            $course_object->accepted_timestamp = false;
                        }
                    } else {
                        $course_object->accepted = $course_object->accepted_timestamp = false;
                    }
                }
            } else {
                unset($forms[$form_id]);
            }
        } // end foreach

        // sort the forms name or date
        if ($sort == 'name') {
            uasort($forms, array($this, "sort_forms_by_name"));
        } else {
            uasort($forms, array($this, "sort_forms_by_date"));
        }

        unset($courses);
        unset($users_by_form_id);
        return $forms;
    }

    /**
     * prepare view variables and render
     * @since   1.0.0
     * @access  private
     * @param   string  $state      active, archived, or verified
     * @param   string  $campus     G, O, or S
     * @return  void
     */
    function render_view($state = null, $campus = null)
    {
        if (!$state) {
            $state = $this->uri->segment(3);
        }
        if (!$campus) {
            $campus = $this->uri->segment(4);
        }
        $this->data['before_closing_head'] = '<link rel="stylesheet" type="text/css" media="screen" href="'.base_url('assets/css/form-g-dashboard.css').'">';
        $this->data['before_closing_head'] .= "\n".'<script>'."\n".'var baseUrl = "'.base_url().'";'."\n".'</script>';
        $this->data['before_closing_body'] = '<script src="'.base_url('assets/js/form-g-dashboard.jquery.js').'"></script>';
                $this->data['page_title'] = "Form G Dashboard";
        $this->data['terms'] = $this->form_g_model->get_terms();
        $this->data['positions'] = $this->positions_model->get_positions();
        $this->data['minimum_stipend'] = $this->form_g_model->get_stipend_minimum();
        $this->data['state'] = $state;
        $this->data['campus'] = $campus;
        $this->render('form_g_dashboard_view');
    }

    public function ajaxGetForm()
    {
        $form_id = $this->input->post('form_id');
        $state = $this->input->post('state');
        $campus = $this->input->post('campus');
        $form = $this->form_g_model->get_form($form_id);
        $terms = $this->form_g_model->get_terms();
        $positions = $this->positions_model->get_positions();
        $minimum_stipend = $this->form_g_model->get_stipend_minimum();
        $this->template->load('_parts/form_g_dashboard_individual_form_view', null, array('form' => $form, 'state' => $state, 'campus' => $campus, 'terms' => $terms, 'positions' => $positions, 'minimum_stipend' => $minimum_stipend));
    }

    public function ajaxGetFilteredForms()
    {
        $state = $this->input->post('state');
        $campus = $this->input->post('campus');
        $department = $this->input->post('dept');
        $subject = $this->input->post('subject');
        $affiliation = $this->input->post('affiliation');
        $order = $this->input->post('sort_order');
        $forms = $this->get_forms($state, $campus, $department, $subject, $affiliation, $order);
        $terms = $this->form_g_model->get_terms();
        $positions = $this->positions_model->get_positions();
        $minimum_stipend = $this->form_g_model->get_stipend_minimum();
        foreach ($forms as $form) {
            $this->template->load('_parts/form_g_dashboard_individual_form_view', null, array('form' => $form, 'state' => $state, 'campus' => $campus, 'terms' => $terms, 'positions' => $positions, 'minimum_stipend' => $minimum_stipend));
        }
    }

    function ajaxGetDepartments() {
        $state = $this->input->post('state');
        $campus = $this->input->post('campus');
        $department = $this->input->post('dept');
        $subject = $this->input->post('subject');
        $affiliation = $this->input->post('affiliation');
        $departments = $this->departments_model->get_departments();
        // get all hiring departments that have users associated with them
        $users = $this->form_g_model->get_users('all', $affiliation)->result();
        $hiring_departments = array();
        foreach ($users as $user_object) {
            $hiring_departments[] = $user_object->department;
        }
        $hiring_departments = array_unique($hiring_departments);
        // make an array of all the department abbreviations
        $all_department_abbreviations = array();
        foreach ($departments as $department_object) {
            $all_department_abbreviations[] = $department_object->abbreviation;
        }
        // make those abbreviations the keys of the departments array
        $departments = array_combine($all_department_abbreviations, $departments);
        $departments_string = '';
        sort($hiring_departments);
        $department_selected = false;
        foreach ($hiring_departments as $hiring_department) {
            $departments_string .= '<option value="'.$hiring_department.'" data-description="'.$departments[$hiring_department]->description.'"';
            if ($department == $hiring_department) {
                $departments_string .= ' selected="selected"';
                $department_selected = true;
            }
            $departments_string .= '>'.$departments[$hiring_department]->description.' ('.$hiring_department.')</option>';
        }
        if (!$department_selected) {
            $departments_string = '<option value="all" selected="selected">All Departments</option>'.$departments_string;
        } else {
            $departments_string = '<option value="all">All Departments</option>'.$departments_string;
        }

        // get all subjects that have a course associated with them
        $courses = $this->form_g_model->get_courses($state, $campus, 'all')->result();
        $course_subjects = array();
        foreach ($courses as $course_object) {
            $course_subjects[] = $course_object->course_subject;
        }
        $course_subjects = array_unique($course_subjects);

        $subjects_string = '';
        sort($course_subjects);
        $subject_selected = false;
        foreach ($course_subjects as $course_subject) {
            // if the subject is blank the course is for a non-instructor position
            if ($course_subject !== '') {
                $description = $departments[$course_subject]->description;
                $parenthetical = ' ('.$course_subject.')';
            } else {
                $description = 'no subject (non-instructor positions)';
                $parenthetical = '';
            }
            // add each option to the html output string
            $subjects_string .= '<option value="'.$course_subject.'" data-description="'.$description.'"';
            if ($subject == $course_subject) {
                $subjects_string .= ' selected="selected"';
                $subject_selected = true;
            }
            $subjects_string .= '>'.$description.$parenthetical.'</option>';
        }
        if (!$subject_selected) {
            $subjects_string = '<option value="all" selected="selected">All Subjects</option>'.$subjects_string;
        } else {
            $subjects_string = '<option value="all" >All Subjects</option>'.$subjects_string;
        }

        echo json_encode(array($departments_string, $subjects_string));
    }

    public function ajaxGetCourseFields()
	{
		$course_number = $this->input->post('courseNumber');
		$terms = $this->form_g_model->get_terms();
		$positions = $this->positions_model->get_positions();

        echo $this->template->load('_parts/form_g_dashboard_course_inputs_view', null, array('course_count' => $course_number+1, 'terms' => $terms, 'positions' => $positions, 'course' => false, 'state' => 'active'));
    }

	public function ajaxProcessBulkActions()
    {
        $data = array(
            'marked' => $this->input->post('marked'),
            'action' => $this->input->post('action')
        );
        if ($data['action'] == 'delete') {
            $this->form_g_model->delete_marked($data['marked']);
        } elseif ($data['action'] == 'activate') {
            $this->form_g_model->activate_marked($data['marked']);
        } elseif ($data['action'] == 'archive') {
            $this->form_g_model->archive_marked($data['marked']);
        }
    }

    // function for use in csv export
    function format_csv($entry) {
        $entry = strip_tags($entry);
        if(strpos($entry, ',') !== false) return '"'.$entry.'"';
        return $entry;
    }

    function export_data()
    {
        $state = $this->input->post('state');
        $campus = $this->input->post('campus');
        $department = $this->input->post('dept');
        $subject = $this->input->post('subject');
        $affiliation = $this->input->post('affiliation');
        $order = $this->input->post('sort_order');
        $forms = $this->get_forms($state, $campus, $department, $subject, $affiliation, $order);

        // create a flat array of courses with corresponding user data
        // from multidimensional $forms array
        $entries = array();
        foreach ($forms as $form) {
            // convert user object to array
            $user_array = (array) $form['user'];
            // remove unused fields
            unset($user_array['id'], $user_array['form_id'], $user_array['status']);
            foreach ($form['courses'] as $course_object) {
                // convert course object to array
                $course_array = (array) $course_object;
                $entries[] = array_merge($user_array, $course_array);
            }
        }

		// begin downloadable data string with a row of column headers (the keys of any element of $entries)
        $output_data = 'Record ID,Submitted Date,Department,School,Department Chair,Org,Preparer Name,Preparer Email,Preparer Phone,Prefix,First Name,Middle Name,Last Name,Affiliation,Spartan Id,Email,Phone,Address,City,State,Zip,Citizenship,Visa Type,Visa Expires,Campus Building,Campus Room,UNCG Employee,Employee Type,Employee Time,Employee eClass,Annual Salary,UNCG Student,Student Type,Student Time,Student eClass,Grad Month,Grad Year,User Comments,Revisions,Part of Term,Start Date,End Date,CRN,Subject,Number,Section,Credit Hours,Campus,Stipend,Position,Hours/week Worked,FTE,Course Note,Accepted Date'.PHP_EOL;
        // get start/end dates for parts of term
        $terms = $this->form_g_model->get_terms();
        foreach ($entries as $form_array) {

			// splice the term dates into the entry array
			$course_term = $form_array['course_term'];
			$course_dates = array(
				date('n/j/y', $terms[$course_term]['start']),
				date('n/j/y', $terms[$course_term]['end']),
			);
			array_splice($form_array, 41, 0, $course_dates);

			// splice affiliation into entry array
			$affiliation = array($form_array['affiliation']);
			array_splice($form_array, 12, 0, $affiliation);

			// splice FTE into array
			$fte = $form_array['course_hours'] * .025;
			array_splice($form_array, 53, 0, $fte);

			// format accepted date if it exists and add it to array
			if ($form_array['accepted_timestamp']) {
				$form_array['accepted_timestamp'] = date('m/d/y', $form_array['accepted_timestamp']);
			} else {
				$form_array['accepted_timestamp'] = '';
			}

			// move id from course data to the beginning of the array
			array_unshift($form_array,$form_array['id']);

			// remove unused fields
			unset($form_array['affiliation'], $form_array['id'], $form_array['form_id'], $form_array['accepted']);
			// format fields for csv output
			foreach ($form_array as $key => $value) {
				$form_array[$key] = $this->format_csv($value);
			}
			// implode the entry array to a string
			$row = implode(',', $form_array);
			$output_data .= $row . PHP_EOL;
		}

        unset($entries);
        echo $output_data;
    }

    function ajaxUpdateRecordState()
    {
        // update the record
        $form_id = $this->input->post('form_id');
        $campus = $this->input->post('campus');
        $current_state = $this->input->post('current_state');
        $new_state = $this->input->post('new_state');
        $this->form_g_model->update_course($new_state, $campus, $form_id);
        // add a note to the revision history
        $db_user_data = (array)$this->form_g_model->get_form($form_id)['user'];
        if (is_null($db_user_data['revisions'])) {
            $revision_entry = '';
        } else {
            $revision_entry = $db_user_data['revisions'].'<br>';
        }
        // set the revision history text and styling class for the new state message
        if ($new_state == 'verified') {
            $state_change = $new_state;
            $class = 'verified';
        } elseif ($new_state == 'active') {
            $state_change = 'activated';
            $class = 'active';
        } else {
            $state_change = $new_state;
            $class = 'archived';
        }
        // set the revision history text for the campus
        if ($campus == "OS") {
            $campus_text = 'O/S campus ';
        } elseif ($campus == "G") {
            $campus_text = 'G campus ';
        } else {
            $campus_text = '';
        }
        $revision_entry .= '<span class="'.$class.'">'.$this->editing_user_name().' <strong>'.ucwords($state_change).'</strong> all '.$campus_text.'courses on this form at '.date('g:i a').' on '.date('n/j/Y').'.</span>';
        $this->form_g_model->update_user($form_id, 'revisions', $revision_entry);
    }

    function ajaxDeleteRecord() {
        $form_id = $this->input->post('form_id');
        $this->form_g_model->delete($form_id);
    }

    function ajaxDeleteCourse() {
        $id = $this->input->post('course_id');
        $course_data = $this->form_g_model->get_course_data_by_id($id);
        $form_id = $course_data->form_id;
        $form = $this->form_g_model->get_form($form_id);
        $revisions = $form['user']->revisions;
        if ($revisions !== '') {
            $revision_entry = '<br>';
        } else {
            $revision_entry = '';
        }
        $revision_entry .= $this->editing_user_name().' <strong>deleted</strong> course <strong>'.$course_data->course_subject.$course_data->course_number.'</strong> at '.date('g:i a').' on '.date('n/j/Y').'.';
        $new_revisions = $revisions.$revision_entry;
        $this->form_g_model->update_user($form_id, 'revisions', $new_revisions);
        $this->form_g_model->delete_course($id);
    }

    function update_multiple() {
        $checked = $this->input->post('marked');
        $action = $this->input->post('action');
        $marked_ids = array();
        $current_state = $this->uri->segment(3);
        if (!empty($marked_ids)) {
            foreach($checked as $form_id) {
                $marked_ids[] = $form_id;
            }
            if ($action == 'archive') {
                $this->form_g_model->delete_marked($marked_ids);
            } elseif ($action == 'activate') {
                $this->form_g_model->activate_marked($marked_ids);
            }
        } else {
            $_SESSION['flashdata']['message'] = 'No entries selected.';
        }
        $this->render_view($current_state);
    }

	function get_affiliation($employee_eclass, $student_eclass, $spartanid)
	{
		if ($spartanid !== '') { //if the userdata includes a spartanid
			$employee_eclasses = array('AF', 'E1', 'ER', 'FA', 'FC', 'FE', 'FF', 'FG', 'FO', 'FP', 'FS', 'L1', 'RF', 'AJ', 'E2', 'EA', 'EB', 'EC', 'ED', 'EN', 'EP', 'ET', 'RE', 'RW', 'SA', 'SB', 'SC', 'SD', 'SE', 'SF', 'SN', 'SP', 'ST');

			$eclass = $employee_eclass . $student_eclass;

			if (strlen($eclass) == 2) { // the user has not submitted 2 eclasses
				if (in_array($eclass, $employee_eclasses)) {
					$affiliation = 'Current UNCG Employee';
				} else {
					$affiliation = 'Current UNCG Student';
				}
			} elseif (strlen($eclass) == 4) { // the length of $eclass is 4; the user has both an employee and a student eclass
				$affiliation = 'Current UNCG Employee & Current Student';
			} else { // the length of $eclass is 0; the user has a spartanid but no eclass
				$affiliation = 'Previously Affiliated';
			}
		} else { // the user has no spartanid
			$affiliation = 'New Hire';
		}

		return $affiliation;
	}

	function ajaxUpdateRecord()
    {
        $form_data = (array) json_decode($this->input->post('form_values'));

		// pull form id, course count, and accepted date out of the array
        $form_id = $form_data['form_id'];
        $state = $this->input->post('state');
        $campus = $this->input->post('campus');

        // get the accepted date from the hidden input at the top of the form if there is one
        if (isset($form_data['any_course_accepted'])) {
            $accepted_date = $form_data['any_course_accepted'];
            unset($form_data['any_course_accepted']);
        } else {
            $accepted_date = false;
        }
        // if the form is coming from verified or archived,
        // it has an extra element that we don't need
        if (isset($form_data['mark-user'])) {
            unset($form_data['mark-user']);
        }

        // get the course count as a separate variable
        $course_count = $form_data['course_count'];

        //// check data for changes to record in revision history
        // get form data as it currently exists in database
        $db_form_data = $this->form_g_model->get_form($form_id);
        // convert database info from objects to arrays
        $db_user_data = (array)$db_form_data['user'];
        $db_courses_data = $db_form_data['courses'];
        $temp = array();
        foreach ($db_courses_data as $course_object) {
            $temp[] = (array)$course_object;
        }
        $db_courses_data = $temp;
        unset($temp);

        // separate user data from course data
        $new_course_data = array();
        foreach ($form_data as $key => $value) {
            if(strpos($key, 'course') !== false) {
                $new_course_data[$key] = $value;
                // format the note value if there is one
                if (strpos($key, 'note') !== false) {
                    $new_course_data[$key] = str_replace(array("\r","\n","\t"), ' ', $value);
                }
                unset($form_data[$key]);
            }
        }
        // rename the remaining elements as $user_data for clarity
        $user_data = (array) $form_data;
        unset($form_data);

		// check if either eClass has changed
		if (array_key_exists('employee_eclass', $user_data)) {
			$user_employee_eclass = $user_data['employee_eclass'];
		} else {
			$user_employee_eclass = '';
		}
		if (array_key_exists('student_eclass',$user_data)) {
			$user_student_eclass = $user_data['student_eclass'];
		} else {
			$user_student_eclass = '';
		}
		if ($user_employee_eclass !== $db_user_data['employee_eclass'] || $user_student_eclass !== $db_user_data['student_eclass']) {
			$user_data['affiliation'] = $this->get_affiliation($user_employee_eclass, $user_student_eclass, $user_data['spartan_id']);
		} else {
			$user_data['affiliation'] = $db_user_data['affiliation'];
		}

        // format the salary and comments values
        if (isset($user_data['salary'])) {
            $user_data['salary'] = (string) preg_replace("/[^0-9\s\.]/", "", $user_data['salary']);
        }
        if (isset($user_data['coments'])) {
            $user_data['comments'] = str_replace(array("\r","\n","\t"), ' ', $user_data['comments']);
        }

        // remove unused elements
        if (isset($form_data['course_count'])) {
            unset($form_data['course_count']);
        }
        if (isset($form_data['mark-user'])) {
            unset($form_data['mark-user']);
        }

        // separate courses_data into one array per course
        $courses_data = array();
        for ($i=0; $i < $course_count; $i++ ) {
            $n = $i + 1;
            $courses_data[$i]['form_id'] = $form_id;
            $courses_data[$i]['id'] = $new_course_data['course_'.$n.'_id'];
            $courses_data[$i]['course_term'] = $new_course_data['course_'.$n.'_term'];
            $courses_data[$i]['course_crn'] = $new_course_data['course_'.$n.'_crn'];
            $courses_data[$i]['course_subject'] = $new_course_data['course_'.$n.'_subject'];
            $courses_data[$i]['course_number'] = $new_course_data['course_'.$n.'_number'];
            $courses_data[$i]['course_section'] = $new_course_data['course_'.$n.'_section'];
            $courses_data[$i]['course_campus'] = strtoupper($new_course_data['course_'.$n.'_campus']);
            $courses_data[$i]['course_credits'] = $new_course_data['course_'.$n.'_credits'];
            $courses_data[$i]['course_stipend'] = (string) preg_replace("/[^0-9\.]/", "", $new_course_data['course_'.$n.'_stipend']);
            $courses_data[$i]['course_position'] = $new_course_data['course_'.$n.'_position'];
            $courses_data[$i]['course_hours'] = $new_course_data['course_'.$n.'_hours'];
            if (!isset($new_course_data['course_'.$n.'_note'])) {
                $courses_data[$i]['course_note'] = '';
            } else {
                $courses_data[$i]['course_note'] = str_replace(array("\r\n","\n","\t"), ' ', $new_course_data['course_'.$n.'_note']);
            }
        }

        //////// revision history ////////
        // make array of elements in $user_data that are different from the same values in $db_user_data
        $updated_values = array();
        foreach ($user_data as $key => $new_value) {
            $old_value = $db_user_data[$key];
            if ($new_value != $old_value) {
                $updated_values[$key] = array($old_value, $new_value);
            }
        }

        // if the course is not a new addition, compare the new values to the existing values in the database
        $new_courses = array();
        for ($i=0; $i < count($courses_data); $i++) {
            if ($courses_data[$i]['id'] !== 'new') {
                foreach ($courses_data[$i] as $key => $new_value) {
                    $old_value = $db_courses_data[$i][$key];
                    if ($new_value != $old_value) {
                        $updated_values['course '.($i+1).'/'.$key] = array($old_value, $new_value);
                    }
                }
            } else {
                $new_courses[] = $courses_data[$i]['course_subject'].$courses_data[$i]['course_number'];
                if ($state == 'verified') {
                    $courses_data[$i]['verified'] = 1;
                    $courses_data[$i]['active'] = 0;
                }
            }
        }

        if (!empty($updated_values)) {
            if (is_null($db_user_data['revisions'])) {
                $revision_entry = '';
            } else {
                $revision_entry = '<br>';
            }
            $n = 0;
            foreach ($updated_values as $key => $changed_value_array) {
                if ($changed_value_array[0] == '') {
                    $changed_value_array[0] = '[empty]';
                }
                if ($changed_value_array[1] == '') {
                    $changed_value_array[1] = '[empty]';
                }
                if ($n > 0) {
                    $revision_entry .= '<br>';
                }
                if (strpos($key, '/') !== false) {
                    $key_parts = explode('/', $key);
                    $course = $key_parts[0];
                    $key = $key_parts[1];
                }
                // remove "course_" from the column names
                if (strpos($key, 'course_') !== false) {
                    $key = ucfirst(substr($key, 7));
                } elseif (strpos($key, '_') !== false) {
                    $key = ucfirst(str_replace('_', ' ', $key));
                }
                $revision_entry .= $this->editing_user_name().' changed <strong>'.$key.'</strong>';
                if (isset($course)) {
                    $revision_entry .= ' of <strong>'.$course.'</strong>';
                }
                $revision_entry .= ' from <em>'.$changed_value_array[0].'</em> to <em>'.$changed_value_array[1].'</em> at '.date('g:i a').' on '.date('n/j/Y').'.';
                $n++;
            }
            $revisions = $db_user_data['revisions'].$revision_entry;
        } else {
            $revisions = $db_user_data['revisions'];
        }

        if (!empty($new_courses)) {
            $n = 0;
            if ($revisions == '') {
                $revision_entry = '';
            } else {
                $revision_entry = '<br>';
            }
            if ($n > 0) {
                $revision_entry .= '<br>';
            }
            foreach ($new_courses as $coursenumber) {
                $revision_entry .= $this->editing_user_name().' added course '.$coursenumber.' at '.date('g:i a').' on '.date('n/j/Y').'.';
            }
            $revisions .= $revision_entry;
        }

        if ($revisions !== '') {
            $user_data['revisions'] = $revisions;
        }

        // update affected rows by form_id
        $this->form_g_model->update_all($form_id, $user_data, $courses_data);

        // load the updated form
        $updated_form = $this->form_g_model->get_form($form_id);
        $updated_form['user'] = $updated_form['user'];
        // add the accepted timestamp to the user object
        if ($accepted_date) {
            $updated_form['user']->accepted_timestamp = $accepted_date;
        } else {
            $updated_form['user']->accepted_timestamp = false;
        }
        // add any accepted timestamps that exist to course objects
        for ($i=0; $i < $course_count; $i++ ) {
            if (!isset($new_course_data[$i]->accepted_timestamp)) {
                $updated_form['courses'][$i]->accepted_timestamp = false;
            } else {
                $updated_form['courses'][$i]->accepted_timestamp = $new_course_data[$i]->accepted_timestamp;
            }
        }
        foreach ($updated_form['courses'] as $course_object) {
            if ($accepted_date) {
                $course_object->accepted_timestamp = $accepted_date;
            } else {
                $course_object->accepted_timestamp = false;
            }
        }

        // get the term dates and minimum stipend, then output the new form html
        $terms = $this->form_g_model->get_terms();
        $positions = $this->positions_model->get_positions();
        $minimum_stipend = $this->form_g_model->get_stipend_minimum();
        $this->template->load('_parts/form_g_dashboard_individual_form_view', null, array('form' => $updated_form, 'state' => $state, 'campus' => $campus, 'terms' => $terms, 'positions' => $positions, 'minimum_stipend' => $minimum_stipend));
    }

    /**
     * this function repairs the database when records have mysteriously changed state
     *
     * it uses the revision history of each record to reset its state.
     *
     * @access  public
     * @return  void
     */
    public function repair_db()
    {
        $department = $affiliation = 'all';
        $users = $this->form_g_model->get_users($department, $affiliation)->result();

        foreach($users as $user_object) {
            $verified_appears = substr_count($user_object->revisions, 'Verified');
            $activated_appears = substr_count($user_object->revisions, 'Activated');
            $archived_appears = substr_count($user_object->revisions, 'Archived');
            if ($verified_appears > $activated_appears) {
                $string_starts = strrpos($user_object->revisions, 'Verified');
                $campus_string = substr($user_object->revisions, $string_starts, 23);
                $campus = substr($campus_string, -1);
                $form_id = $user_object->form_id;
                $state = 'verified';
                $this->form_g_model->update_course($state, $campus, $form_id);
                if ($campus == 'c') {
                    $campus = '';
                } elseif ($campus == 'O') {
                    $campus = 'O/S ';
                } else {
                    $campus = 'G ';
                }
                $new_revision_content = $user_object->revisions.'<br>- Automatically restored all '.$campus.'courses to <strong>'.$state.'</strong> status on 5/6/19. -';
                $this->form_g_model->update_user($form_id, 'revisions', $new_revision_content);
            }
            if ($archived_appears > $activated_appears) {
                $string_starts = strrpos($user_object->revisions, 'Archived');
                $campus_string = substr($user_object->revisions, $string_starts, 23);
                $campus = substr($campus_string, -1);
                $form_id = $user_object->form_id;
                $state = 'archived';
                $this->form_g_model->update_course($state, $campus, $form_id);
                if ($campus == 'c') {
                    $campus = '';
                } elseif ($campus == 'O') {
                    $campus = 'O/S ';
                } else {
                    $campus = 'G ';
                }
                $new_revision_content = $user_object->revisions.'<br>- Automatically restored all '.$campus.'courses to <strong>'.$state.'</strong> status on 5/6/19. -';
                $this->form_g_model->update_user($form_id, 'revisions', $new_revision_content);
            }
        }
    }

}
