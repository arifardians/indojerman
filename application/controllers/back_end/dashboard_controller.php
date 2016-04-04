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
		$this->load->model('overview');
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
		$users = $this->overview->get_total_user();
		$exams = $this->overview->get_total_exam();
		$avg_horen = $this->overview->get_avg_exam_horen();
		$avg_lesen = $this->overview->get_avg_exam_lesen();
		// echo "<pre>";
		// var_dump($users);
		$data['total_user'] = $users->total;
		$data['total_exam'] = $exams->total; 
		$data['average_horen'] = $avg_horen->average;
		$data['average_lesen'] = $avg_lesen->average;
		$this->template_backend->display('/back_end/dashboard/index', $data);
	}
}