<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_controller extends CI_Controller
{

    public function index_forms($form_id = null)
    {
        $this->load->model('Frontend_model');
        $this->load->model('Form_model');
        $this->load->model('Response_model');
    
        // Check if the user is logged in
        if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to login page
            redirect('users/login');
        }
        $user_id = $this->session->userdata('user_id');

        // Retrieve form title from the forms table using form_id
        $form_title = 'Untitled Form'; // Default title
        if ($form_id) {
            $form = $this->Frontend_model->getFormById($form_id);
            if ($form) {
                $form_title = $form['title'];
            }
        }
    
        // Fetch data from models
        $data['total_forms'] = $this->Form_model->get_total_forms($user_id);
        $data['published_forms'] = $this->Form_model->get_published_forms($user_id);
        $data['total_responses'] = $this->Response_model->get_total_responses($user_id);
        $data['forms'] = $this->Form_model->get_all_forms($user_id);
        $data['form_title'] = $form_title;
    
        // Load views and data if user is logged in
        $this->load->view('templates/header');
        $this->load->view('Tables/list_forms', $data);
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
        $this->session->set_flashdata('status', 'Form data deleted successfully');
        redirect('drafts');
    }
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Updation_model');
    }

    // Load the form for editing
    public function edit_form($form_id)
    {
        $data['form'] = $this->Updation_model->get_form($form_id);
        $data['questions'] = $this->Updation_model->get_questions($form_id);
        $data['options'] = $this->Updation_model->get_options();

        // $this->load->view('templates/header');
        $this->load->view('edit_form_view', $data);
        // $this->load->view('templates/footer');

    }

    // Save the edited form
    public function update_form()
    {
        $formData = $this->input->post('formData');

        if (!$formData) {
            echo json_encode(['status' => 'error', 'message' => 'Form data is missing']);
            return;
        }

        $form_id = $formData['form_id'];
        $title = $formData['title'];
        $description = $formData['description'];
        $questions = $formData['questions'];

        $this->load->model('Updation_model');
        $updateStatus = $this->Updation_model->update_form_data($form_id, $title, $description, $questions);

        if ($updateStatus) {
            echo json_encode(['status' => 'success', 'message' => 'Form updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update form data']);
        }
    }

    public function index_forms_draft($form_id = null)
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