<?php 

/**
* 
*/
class Error_controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function show_404_error(){
		$this->template_backend->display('/error/error_404');
	}

	function show_error_404_2()
	{
		$this->load->view('/error/error_404_2');
	}
}