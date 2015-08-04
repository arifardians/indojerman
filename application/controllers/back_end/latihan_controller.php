<?php

/**
* 
*/
class Latihan_controller extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct('admin');	
	}

	function index(){
		$this->load->view('/latihan/index');
	}

	function login(){
		if(isset($_POST['submit'])){
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$this->load->model('user');
			$user_from_database = $this->user->get_user($username);
			echo "<pre>";
			$this->output->set_output(print_r($user_from_database));
		}

		$this->load->view('/latihan/login');
	}
}