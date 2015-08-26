<?php
/**
 * 
 * @author David Mezquíriz Osés
 *
 */
class Login extends CI_Controller {
	function index ($error = '') {
		if ($error) {
			$data['login'] = $error;
		} else {
			$data['login_error'] = '';
		}
	
	
		$data['title'] = 'Login Page';
		$data['description'] = 'Login Page';
		$data['keyword'] = 'login, login page';
		$data['main_content'] = 'login/login';
		
		$this->load->view('includes/login_template', $data);
	}
	
	/**
	 * Functions for validations
	 */
	
	function validate_login() {
		//Username is required
		$this->form_validation->set_rules('username', 'Username', 'trim|required'); 
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->load->model('Login_model');
			$query = $this->Login_model->validate();
			if ($query) {
				//if true
				redirect('site/index');
			} else {
				$error = 'User Name & Password do not Match';
				$this->index($error);
			}
		}
	}
}