<?php

/**
* 
*/
class Login_controller extends CI_Controller
{
	private $member_group;
	private $admin_group;
	function __construct()
	{
		parent::__construct();
		$this->load->model('user');
		$this->load->library('access');
		$this->load->library('template_login');
		$this->member_group = 1; 
		$this->admin_group  = 2; 
	}

	function index()
	{
		$this->load->view('/login/index');
	}

	function sign_in()
	{
		$this->is_login();
		if(isset($_POST['submit']))
		{
			$username	= $this->input->post('username');
			$password	= $this->input->post('password'); 
			$result 	= $this->access->login($username, $password); 
			
			if($result)
			{
				if($this->session->userdata('user_group') == 2){
					redirect(base_url().'dashboard');
				}
			}
			else
			{
				redirect(base_url().'login');
			}
		}
		$this->template_login->display('/login/sign_in');
		
	}

	function sign_up()
	{
		$this->template_login->display('/login/sign_up');
	}

	function logout()
	{
		$this->access->logout();
		redirect(base_url());
	}

	function login_user()
	{

		if(isset($_POST['submit']))
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$result	  = $this->access->login($username, $password);
			
			if($result)
			{
				if($this->session->userdata('user_group') == 2)
					redirect(base_url().'dashboard');
				else if($this->session->userdata('user_group') ==1)
				{
					redirect(base_url().'my_dashboard');
				}
			}
			else
				redirect(base_url().'login_user');
		}

		

		$titles  = array('Home', 'Pages', 'Login');
		$links 	 = array(base_url().'', '', '');
		$breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}

		$data['title'] 			= "Login"; 
		$data['breadcrumbs']	= $breadcrumbs;

		$this->template_frontend->display('/login/login_user', $data);
	}

	function register_user(){
		if(isset($_POST['submit'])){
			$first_name = $this->input->post('first_name');
			$last_name	= $this->input->post('last_name');
			$password	= $this->input->post('password');
			$email		= $this->input->post('email');
			$password_confirm = $this->input->post('password_confirmation');

			if($password == $password_confirm){
				$data = array('first_name' => $first_name,
							  'last_name' => $last_name, 
							  'email' => $email,
							  'password' => md5($password),
							  'user_group' => $this->member_group);
				 
				$inserted_id =  $this->user->insert($data);
				
				if($inserted_id)
				{
					$result = $this->access->login($email, $password);
					if($result)
					{
						if($this->session->userdata('user_group') == $this->member_group)
						{
							redirect(base_url());
						}
						else
						{
							redirect(base_url().'/dashboard');
						}
					}
				}
				else{
					redirect(base_url().'login_user');
				}
			}
			else
			{
				redirect(base_url().'login_user');
			}
		}

		$titles = array('Home', 'Pages', 'Register');
		$links 	= array(base_url().'', '#', '#');
		$breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}		
		$data['title'] = "Daftar (Register)"; 
		$data['breadcrumbs'] = $breadcrumbs;
		$this->template_frontend->display('/login/login_user', $data);
	}

	function is_login()
	{
		$is_login = $this->access->is_login();
		if($is_login)
		{
			if($this->session->userdata('user_group')==2)
			{
				redirect(base_url().'dashboard');
			}
		}

	}

	function check_login()
	{
		
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$login = $this->access->login($username, $password);
			if($login){
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode(array("value"=>1, "username"=> $username, "password"=> $password)));
			}else{
			$this->output
					->set_content_type('application/json')
					->set_output(json_encode(array("value"=>0, "username"=> $username, "password"=> $password)));			}

		
	}

	function get_json_data(){
		$data = $this->user->get_all_data();
		$this->output
			 ->set_content_type('application/json')
			 ->set_output(json_encode($data));
	}
}