<?php 


/**
* 
*/
class Dashboard_controller extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct('admin');
		// $this->is_logged_in();
	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) OR $is_logged_in !== TRUE)
		{
			redirect(base_url().'login');
		}
	}

	function index()
	{
		$this->template_backend->display('/back_end/dashboard/index');
	}
}