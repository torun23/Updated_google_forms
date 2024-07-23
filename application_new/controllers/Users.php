<?php
class Users extends CI_Controller
{
    //signup user
    public function register()
    {
        $data['title'] = 'Sign Up';
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Confirm Passsword', 'matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/register', $data);
            $this->load->view('templates/footer');
        } else {
            $enc_password = md5($this->input->post('password'));
            $this->load->model('user_model');

            $this->user_model->register($enc_password);
            // $this->user_model->register();


            $this->session->set_flashdata('user_registered', 'You are now registered and can log in');
            redirect('start');
        }

    }


/**
 * function to login into google forms
 * @param  null
 * @return mixed(data return type)
 * @author torun
 */
    public function login()
    {
        $data['title'] = 'Sign In';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
        } else {

            // Get username
            $username = $this->input->post('username');
            // Get and encrypt the password
            $password = md5($this->input->post('password'));
            $this->load->model('user_model');
            // Login user
            $person_id = $this->user_model->login($username, $password);

            if ($person_id) {
                // Create session
                $user_data = array(
                    'user_id' => $person_id,
                    'username' => $username,
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);
                $person_id = $this->session->userdata('user_id');


                // Set message
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');

                redirect('home');
            } else {
                // Set message
                $this->session->set_flashdata('login_failed', 'Login is invalid');

                redirect('users/login');
            }
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');

        $this->session->set_flashdata('user_loggedout', 'You are now logged out');
        redirect('users/login');

    }
    // check if username exists
    public function check_username_exists($username)
    {
        $this->form_validation->set_message('check_username_exists', 'The username is taken.Please choose a different one');
        $this->load->model('user_model');
        if ($this->user_model->check_username_exists($username)) {
            return true;
        } else {
            return false;
        }
    }

    public function check_email_exists($email)
    {
        $this->form_validation->set_message('check_email_exists', 'The email is taken.Please choose a different one');
        $this->load->model('user_model');

        if ($this->user_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }
    // public function callback_user_id_exists($id)
    // {
    //     $this->form_validation->set_message('user_id_exists', 'The ID is taken.Please choose a different one');
    //     $this->load->model('user_model');

    //     if ($this->user_model->user_id_exists($id)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}


?>