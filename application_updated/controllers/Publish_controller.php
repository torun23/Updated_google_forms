<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publish_controller extends CI_Controller {

    // Method to publish a form
    public function publish_form($form_id) {
        // Generate a unique link
        if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to login page
            redirect('users/login');
        }
        $response_link = base_url("response_preview/" . $form_id);
        $this->load->model('Publish_model');
        // Update is_published to 1 and set the response link
        $this->Publish_model->update_form($form_id, [
            'is_published' => 1,
            'response_link' => $response_link
        ]);

        // Redirect to the list_user_published_forms function
        redirect('published_forms');
    }

    // Method to list published forms of a user
    public function list_user_published_forms() {
        if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to login page
            redirect('users/login');
        }
        $user_id = $this->session->userdata('user_id');
        $this->load->model('Publish_model');
        $data['forms'] = $this->Publish_model->get_published_forms_by_user($user_id);
    
        $this->load->view('templates/header');
        $this->load->view('publish_view', $data);
        $this->load->view('templates/footer');
    }
    

    // Method to unpublish a form
    public function unpublish_form($form_id) {
        if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to login page
            redirect('users/login');
        }
        $this->load->model('Publish_model');
        // Update is_published to 0
        $this->Publish_model->update_form($form_id, ['is_published' => 0]);

        // Redirect to the list_user_published_forms function
        redirect('published_forms');
    }
}
