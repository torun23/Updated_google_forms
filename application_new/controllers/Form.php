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
}