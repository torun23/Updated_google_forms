<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Form_model');
    }

    public function submit() {
        if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to login page
            redirect('users/login');
        }
        $form_data = json_decode($this->input->raw_input_stream, true);

        if ($this->Form_model->save_form($form_data)) {
            $response = array('status' => 'success', 'message' => 'Form submitted successfully.');
        } else {
            $response = array('status' => 'error', 'message' => 'Error submitting form.');
        }

        echo json_encode($response);
    }

    public function view($form_id) {
        $data['title'] = $this->Form_model->get_form_title($form_id);

        if ($data['title'] === null) {
            show_404(); // Show 404 if form_id is invalid
        }

		$this->load->view('templates/forms_ui',$data);
    }
}