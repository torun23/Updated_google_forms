<?php
class New_form extends CI_Controller
{
    public function create_form()
    {
        if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to login page
            redirect('users/login');
        }
        $data['title'] = 'Form Details';
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');


        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('templates/form_title',$data);
            $this->load->view('templates/footer');
        } else {
            // $enc_password = md5($this->input->post('password'));
            $this->load->model('create_model');
    // $user_id = $this->session->userdata('user_id');


            $this->create_model->details();
            // $this->user_model->register();


            // $this->session->set_flashdata('user_registered', 'You are now registered and can log in');
            redirect('designform');
        }

    }
}

?>