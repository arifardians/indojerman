<?php 

/**
* 
*/
class MY_Controller extends CI_Controller
{
	
	function __construct($user_group_name)
	{
		parent::__construct();
		$this->is_logged_in($user_group_name);
	}

	function is_logged_in($user_group_name)
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(! isset($is_logged_in) OR $is_logged_in !== TRUE)
		{
			redirect(base_url().'login');
		}
		else
		{
			$this->load->model('user_group');
			$current_user_group = $this->session->userdata('user_group');
			$user_group = $this->user_group->get_data_by_name($user_group_name);
			if($user_group->id != $current_user_group){
				redirect(base_url().'login');
			}
		}
	}
}