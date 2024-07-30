<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{

	// index2-default
	public function home()
	{
		$this->load->view('Frontend/header');

		$this->load->view('Form_controller/index_forms');
		$this->load->view('Frontend/footer');
	}

	public function design_form()
	{

		$this->load->view('templates/forms_ui');

	}
	public function title()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/form_title');
		$this->load->view('templates/footer');

	}
	public function ui_forms()
	{
		$this->load->view('templates/forms_ui');
	}


}