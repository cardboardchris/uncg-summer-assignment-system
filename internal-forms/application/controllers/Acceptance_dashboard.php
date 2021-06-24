<?php defined('BASEPATH') or exit('No direct script access allowed');

class Acceptance_dashboard extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('acceptance_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->data['page_title'] = 'Acceptance Forms Dashboard';
        $this->data['active_requests'] = $this->acceptance_model->get_submissions('active')->result();
        // $this->data['completed_requests'] = $this->acceptance_model->get_submissions('completed')->result();
        $this->data['before_closing_body'] = '<script src="'.base_url('assets/js/acceptance-dashboard.jquery.js').'"></script>';
        $this->render('acceptance_dashboard_view');
    }

    function complete()
    {
        $id = $this->uri->segment(3);
        $request_data = $this->acceptance_model->get_submission($id)->result();
        $request = $request_data[0];

        $this->acceptance_model->update('completed', $id);
        $this->session->set_flashdata('message', 'Submission archived.');
        $this->session->set_flashdata('type', 'success');
        redirect('acceptance_dashboard');
    }

    function export_data()
    {
        $this->load->dbutil();

        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "acceptance-submissions.csv";
        $result = $this->acceptance_model->get_submissions('active');
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
        redirect('acceptance_dashboard');
    }

    function update_record_pending()
    {
        $id = $this->uri->segment(3);
        $this->acceptance_model->update('pending', $id);
        redirect('acceptance_dashboard');
    }

    function update_record_waitlisted()
    {
        $id = $this->uri->segment(3);
        $this->acceptance_model->update('waitlisted', $id);
        redirect('acceptance_dashboard');
    }

    function update_record_completed()
    {
        $id = $this->uri->segment(3);
        $this->acceptance_model->update('completed', $id);
        redirect('acceptance_dashboard');
    }

    function update_record()
    {
        $id = $this->uri->segment(3);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('spartanid', 'Student ID', 'trim|required|numeric|exact_length[9]|differs[username]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', validation_errors());
            $this->session->set_flashdata('type', 'danger');
            redirect('acceptance_dashboard', 'refresh');
        } else {
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'username' => $this->input->post('username'),
                'spartanid' => $this->input->post('spartanid'),
            );
            $this->acceptance_model->update_all($id, $data);
            $this->session->set_flashdata('message', 'Entry updated.');
            $this->session->set_flashdata('type', 'success');
        }
        redirect('acceptance_dashboard', 'refresh');
    }
}
