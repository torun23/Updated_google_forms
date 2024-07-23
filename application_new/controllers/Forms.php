<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forms extends CI_Controller
{
    public function preview($form_id)
    {
        if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to login page
            redirect('users/login');
        }
        // Load the model that handles the form data
        $this->load->model('preview_model');

        // Fetch the form details
        $form = $this->preview_model->get_form($form_id);

        // Fetch the questions for the form
        $questions = $this->preview_model->get_questions($form_id);

        // Fetch the options for each question
        foreach ($questions as &$question) {
            $question->options = $this->preview_model->get_options($question->id);
        }

        // Pass the data to the view
        $data['form'] = $form;
        $data['questions'] = $questions;

		$this->load->view('templates/header');

        $this->load->view('form_preview', $data);
        $this->load->view('templates/footer');

    }
 
        public function response_preview($form_id)
        {
            if (!$this->session->userdata('logged_in')) {
                // If not logged in, redirect to login page
                redirect('users/login');
            }
        
            // Load the model that handles the form data
            $this->load->model('preview_model');
        
            // Fetch the form details
            $form = $this->preview_model->get_form($form_id);
        
            // Fetch the questions for the form
            $questions = $this->preview_model->get_questions($form_id);
        
            // Fetch the options for each question
            foreach ($questions as &$question) {
                $question->options = $this->preview_model->get_options($question->id);
            }
        
            // Pass the data to the view
            $data['form'] = $form;
            $data['questions'] = $questions;
        
            $this->load->view('response_submit', $data);
        }
    public function preview_back($form_id) {
        if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to login page
            redirect('users/login');
        }
        
        // Load the model that handles the form data
        $this->load->model('preview_model');
    
        // Fetch the form details
        $form = $this->preview_model->get_form($form_id);
    
        // Fetch the questions for the form including 'is_required'
        $questions = $this->preview_model->get_questions($form_id);
    
        // Fetch the options for each question
        foreach ($questions as &$question) {
            $question->options = $this->preview_model->get_options($question->id);
        }
    
        // Pass the data to the view
        $data['form'] = $form;
        $data['questions'] = $questions;
    
        $this->load->view('templates/header');
        $this->load->view('form_preview_back', $data);
        $this->load->view('templates/footer');
    }
    
}
