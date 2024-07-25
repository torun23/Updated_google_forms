<?php
class New_form extends CI_Controller
{
    public function create_form() {
        if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to login page
            redirect('users/login');
        }
    
        $data['title'] = 'Form Details';
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('templates/form_title', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('create_model');
            $form_id = $this->create_model->details(); // Get the new form_id
    
            // Redirect to the form view with the form_id
            redirect('form/view/' . $form_id);
        }
    }
    
}

?>