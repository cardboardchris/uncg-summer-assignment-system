<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Departments_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_departments()
    {
        $this->db->select('abbreviation, description');
        $this->db->from('departments');
		$this->db->order_by('description ASC');
        $rows = $this->db->get()->result();

        return $rows;
    }

    function save_departments()
    {
        $departments = array(
            array(
                'abbreviation' => 'ARS',
                'description' => 'Academic Recovery Seminar'
                ),
            array(
                'abbreviation' => 'ACC',
                'description' => 'Accounting'
                ),
            array(
                'abbreviation' => 'ADS',
                'description' => 'African American and African Diaspora Studies'
                ),
            array(
                'abbreviation' => 'ASL',
                'description' => 'American Sign Language'
                ),
            array(
                'abbreviation' => 'ATY',
                'description' => 'Anthropology'
                ),
            array(
                'abbreviation' => 'APD',
                'description' => 'Apparel Product Design'
                ),
            array(
                'abbreviation' => 'ARE',
                'description' => 'Art Education'
                ),
            array(
                'abbreviation' => 'ARH',
                'description' => 'Art History'
                ),
            array(
                'abbreviation' => 'RCO',
                'description' => 'Ashby Residential College'
                ),
            array(
                'abbreviation' => 'AST',
                'description' => 'Astronomy'
                ),
            array(
                'abbreviation' => 'BIO',
                'description' => 'Biology'
                ),
            array(
                'abbreviation' => 'BUS',
                'description' => 'Business Administration'
                ),
            array(
                'abbreviation' => 'BSA',
                'description' => 'Business Affairs'
                ),
            array(
                'abbreviation' => 'CHE',
                'description' => 'Chemistry and Biochemistry'
                ),
            array(
                'abbreviation' => 'CHI',
                'description' => 'Chinese'
                ),
            array(
                'abbreviation' => 'CCI',
                'description' => 'Classical Civilization'
                ),
            array(
                'abbreviation' => 'CSD',
                'description' => 'Communication Sciences and Disorders'
                ),
            array(
                'abbreviation' => 'CST',
                'description' => 'Communication Studies'
                ),
            array(
                'abbreviation' => 'CTR',
                'description' => 'Community and Therapeutic Recreation'
                ),
            array(
                'abbreviation' => 'CTP',
                'description' => 'Comprehensive Transition and Postsecondary Education'
                ),
            array(
                'abbreviation' => 'CSC',
                'description' => 'Computer Science'
                ),
            array(
                'abbreviation' => 'CRS',
                'description' => 'Consumer, Apparel, and Retail Studies'
                ),
            array(
                'abbreviation' => 'CED',
                'description' => 'Counseling and Educational Development'
                ),
            array(
                'abbreviation' => 'DAC',
                'description' => 'Dance'
                ),
            array(
                'abbreviation' => 'DCE',
                'description' => 'Digital ACT Studio'
                ),
            array(
                'abbreviation' => 'DOL',
                'description' => 'Division of Online Learning'
                ),
            array(
                'abbreviation' => 'ECO',
                'description' => 'Economics'
                ),
            array(
                'abbreviation' => 'ELC',
                'description' => 'Educational Leadership and Cultural Foundations'
                ),
            array(
                'abbreviation' => 'ERM',
                'description' => 'Educational Research Methodology'
                ),
            array(
                'abbreviation' => 'ENG',
                'description' => 'English'
                ),
            array(
                'abbreviation' => 'ENS',
                'description' => 'Ensemble'
                ),
            array(
                'abbreviation' => 'ENT',
                'description' => 'Entrepreneurship'
                ),
            array(
                'abbreviation' => 'ENV',
                'description' => 'Environmental & Sustainability Studies'
                ),
            array(
                'abbreviation' => 'FIN',
                'description' => 'Finance'
                ),
            array(
                'abbreviation' => 'FFL',
                'description' => 'Foundations for Learning'
                ),
            array(
                'abbreviation' => 'FRE',
                'description' => 'French'
                ),
            array(
                'abbreviation' => 'FMS',
                'description' => 'Freshman Seminars'
                ),
            array(
                'abbreviation' => 'GEN',
                'description' => 'Genetic Counseling'
                ),
            array(
                'abbreviation' => 'GER',
                'description' => 'German'
                ),
            array(
                'abbreviation' => 'GES',
                'description' => 'Geography, Environment, and Sustainability'
                ),
            array(
                'abbreviation' => 'GRO',
                'description' => 'Gerontology'
                ),
            array(
                'abbreviation' => 'GRK',
                'description' => 'Greek'
                ),
            array(
                'abbreviation' => 'GRC',
                'description' => 'Grogan College'
                ),
            array(
                'abbreviation' => 'HHS',
                'description' => 'Health and Human Sciences'
                ),
            array(
                'abbreviation' => 'HED',
                'description' => 'Higher Education'
                ),
            array(
                'abbreviation' => 'HIS',
                'description' => 'History'
                ),
            array(
                'abbreviation' => 'HSS',
                'description' => 'Honors Program'
                ),
            array(
                'abbreviation' => 'HDF',
                'description' => 'Human Development and Family Studies'
                ),
            array(
                'abbreviation' => 'BLS',
                'description' => 'Humanities'
                ),
            array(
                'abbreviation' => 'ISM',
                'description' => 'Information Systems and Operations Management'
                ),
            array(
                'abbreviation' => 'IPS',
                'description' => 'Integrated Professional Studies'
                ),
            array(
                'abbreviation' => 'ISC',
                'description' => 'Integrated Science'
                ),
            array(
                'abbreviation' => 'ISL',
                'description' => 'Integrated Studies Lab'
                ),
            array(
                'abbreviation' => 'IAR',
                'description' => 'Interior Architecture'
                ),
            array(
                'abbreviation' => 'IGS',
                'description' => 'International and Global Studies'
                ),
            array(
                'abbreviation' => 'IPC',
                'description' => 'International Programs'
                ),
            array(
                'abbreviation' => 'ITA',
                'description' => 'Italian'
                ),
            array(
                'abbreviation' => 'JNS',
                'description' => 'Japanese Studies'
                ),
            array(
                'abbreviation' => 'KIN',
                'description' => 'Kinesiology'
                ),
            array(
                'abbreviation' => 'LLC',
                'description' => 'Languages, Literatures, and Cultures'
                ),
            array(
                'abbreviation' => 'LAT',
                'description' => 'Latin'
                ),
            array(
                'abbreviation' => 'LIS',
                'description' => 'Library and Information Studies'
                ),
            array(
                'abbreviation' => 'MGT',
                'description' => 'Management'
                ),
            array(
                'abbreviation' => 'MKT',
                'description' => 'Marketing Development'
                ),
            array(
                'abbreviation' => 'MLS',
                'description' => 'Master of Arts in Liberal Studies'
                ),
            array(
                'abbreviation' => 'MBA',
                'description' => 'Master of Business Adminstration'
                ),
            array(
                'abbreviation' => 'MAS',
                'description' => 'Masters in Applied Arts and Sciences'
                ),
            array(
                'abbreviation' => 'MAT',
                'description' => 'Mathematics'
                ),
            array(
                'abbreviation' => 'MST',
                'description' => 'Media Studies'
                ),
            array(
                'abbreviation' => 'MUS',
                'description' => 'Music'
                ),
            array(
                'abbreviation' => 'MUE',
                'description' => 'Music Education'
                ),
            array(
                'abbreviation' => 'MUP',
                'description' => 'Music Performance'
                ),
            array(
                'abbreviation' => 'NAN',
                'description' => 'Nanoscience'
                ),
            array(
                'abbreviation' => 'NUR',
                'description' => 'Nursing'
                ),
            array(
                'abbreviation' => 'NTR',
                'description' => 'Nutrition'
                ),
            array(
                'abbreviation' => 'PCS',
                'description' => 'Peace and Conflict Studies'
                ),
            array(
                'abbreviation' => 'PHI',
                'description' => 'Philosophy'
                ),
            array(
                'abbreviation' => 'PHY',
                'description' => 'Physics'
                ),
            array(
                'abbreviation' => 'PSC',
                'description' => 'Political Science'
                ),
            array(
                'abbreviation' => 'POR',
                'description' => 'Portuguese'
                ),
            array(
                'abbreviation' => 'PRV',
                'description' => 'Provost'
                ),
            array(
                'abbreviation' => 'PSY',
                'description' => 'Psychology'
                ),
            array(
                'abbreviation' => 'HEA',
                'description' => 'Public Heath'
                ),
            array(
                'abbreviation' => 'REL',
                'description' => 'Religious Studies'
                ),
            array(
                'abbreviation' => 'RCS',
                'description' => 'Retailing and Consumer Studies'
                ),
            array(
                'abbreviation' => 'RUS',
                'description' => 'Russian'
                ),
            array(
                'abbreviation' => 'SOE',
                'description' => 'School of Education'
                ),
            array(
                'abbreviation' => 'SON',
                'description' => 'School of Nursing'
                ),
            array(
                'abbreviation' => 'SSC',
                'description' => 'Social Sciences'
                ),
            array(
                'abbreviation' => 'SWK',
                'description' => 'Social Work'
                ),
            array(
                'abbreviation' => 'SOC',
                'description' => 'Sociology'
                ),
            array(
                'abbreviation' => 'SPA',
                'description' => 'Spanish'
                ),
            array(
                'abbreviation' => 'SC"',
                'description' => 'Speaking Center'
                ),
            array(
                'abbreviation' => 'SES',
                'description' => 'Specialized Education Services'
                ),
            array(
                'abbreviation' => 'STA',
                'description' => 'Statistics'
                ),
            array(
                'abbreviation' => 'STR',
                'description' => 'Strong College'
                ),
            array(
                'abbreviation' => 'ST"',
                'description' => 'Student Success Center'
                ),
            array(
                'abbreviation' => 'ART',
                'description' => 'Studio Art'
                ),
            array(
                'abbreviation' => 'SCM',
                'description' => 'Supply Chain Management'
                ),
            array(
                'abbreviation' => 'STH',
                'description' => 'Sustainable Tourism and Hospitality'
                ),
            array(
                'abbreviation' => 'TED',
                'description' => 'Teacher Education'
                ),
            array(
                'abbreviation' => 'THR',
                'description' => 'Theatre'
                ),
            array(
                'abbreviation' => 'UNS',
                'description' => 'University Studies'
                ),
            array(
                'abbreviation' => 'VPA',
                'description' => 'Visual and Performing Arts'
                ),
            array(
                'abbreviation' => 'WCV',
                'description' => 'Western Civilization'
                ),
            array(
                'abbreviation' => 'WGS',
                'description' => 'Women\'s and Gender Studies'
                ),
            array(
                'abbreviation' => 'WC"',
                'description' => 'Writing Center'
                )
        );
        for ($i=0; $i < count($departments); $i++) {
            $this->db->set($departments[$i]);
            $this->db->insert('departments');
        }
    }
}
