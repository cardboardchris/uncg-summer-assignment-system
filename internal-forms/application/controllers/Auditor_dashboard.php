<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auditor_dashboard extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('auditor_model');
        $this->load->helper('form');
        $this->data['view'] = 'dashboard';
    }

    public function index()
    {
        $this->data['page_title'] = "Auditor Forms Dashboard";
        $this->data['before_closing_body'] = '<script src="'.base_url('assets/js/auditor-dashboard.jquery.js').'"></script>';
        $this->render_view('active');
    }

    function render_view($state = null) // states are 'active' and 'completed'
    {
        if (!$state) {
            $state = $this->uri->segment(3);
        }
        $this->data['state'] = $state;
        $this->data['active_requests'] = $this->auditor_model->get_submissions('active', 'all')->result();
        $this->data['archived_requests'] = $this->auditor_model->get_submissions('completed', 'all')->result();
        $this->render('auditor_dashboard_view');
    }

    function export_data($type)
    {
        $this->load->dbutil();

        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "auditor-applications.csv";
        $result = $this->auditor_model->get_submissions('active', $type);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
        redirect('auditor_dashboard');
    }

    function update_record_completed()
    {
        $id = $this->uri->segment(3);
        $this->auditor_model->update('completed', $id);
        redirect('auditor_dashboard');
    }

    function update_record_active()
    {
        $id = $this->uri->segment(3);
        $this->auditor_model->update('active', $id);
        redirect('auditor_dashboard');
    }

    function delete_record_by_id() {
        $id = $this->uri->segment(3);
        $this->auditor_model->delete($id);
        redirect('auditor_dashboard');
    }
}
