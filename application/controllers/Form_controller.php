<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_controller extends CI_Controller {

	public function index_forms($form_id = null)
    {
		$this->load->model('Frontend_model');
        // Check if the user is logged in
        if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to login page
            redirect('users/login');
        }

        // Retrieve form title from the forms table using form_id
        $form_title = 'Untitled Form'; // Default title
        if ($form_id) {
            $form = $this->Frontend_model->getFormById($form_id);
            if ($form) {
                $form_title = $form['title'];
            }
        }

        // Load views and data if user is logged in
        $this->load->view('templates/header');

        $data = $this->Frontend_model->getforms();
        $this->load->view('Tables/list_forms', ['forms' => $data, 'form_title' => $form_title]);

        $this->load->view('templates/footer');
    }

	public function delete($id)
	{
		if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to login page
            redirect('users/login');
        }
$this->load->model('Frontend_model');
$this->Frontend_model->deleteForm($id);
$this->session->set_flashdata('status','Form data deleted successfully');
redirect('default_page');
	}
    public function __construct() {
        parent::__construct();
        $this->load->model('Updation_model');
    }

    // Load the form for editing
    public function edit_form($form_id) {
        $data['form'] = $this->Updation_model->get_form($form_id);
        $data['questions'] = $this->Updation_model->get_questions($form_id);
        $data['options'] = $this->Updation_model->get_options();

		// $this->load->view('templates/header');
        $this->load->view('edit_form_view', $data);
		// $this->load->view('templates/footer');

    }

    // Save the edited form
    public function update_form() {
        $form_id = $this->input->post('form_id');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $questions = $this->input->post('questions');

        $this->Updation_model->update_form($form_id, $title, $description);
        $this->Updation_model->update_questions($form_id, $questions);

        echo json_encode(['status' => 'success']);
    }
	public function index_forms_draft($form_id = null) {
		$this->load->model('Frontend_model');
	
		// Check if the user is logged in
		if (!$this->session->userdata('logged_in')) {
			// If not logged in, redirect to login page
			redirect('users/login');
		}
	
		// Retrieve form title from the forms table using form_id
		$form_title = 'Untitled Form'; // Default title
		if ($form_id) {
			$form = $this->Frontend_model->getFormById($form_id);
			if ($form) {
				$form_title = $form['title'];
			}
		}
	
		// Get the user_id from session
		$user_id = $this->session->userdata('user_id');
	
		// Load views and data if user is logged in
		$this->load->view('templates/header');
	
		// Get the forms created by the user
		$data = $this->Frontend_model->getforms_draft($user_id);
		$this->load->view('Tables/draft', ['forms' => $data, 'form_title' => $form_title]);
	
		$this->load->view('templates/footer');
	}
	
}