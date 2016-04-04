<?php


/**
* 
*/
class Overview extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	function get_total_user(){
		$sql = "select count(id) as total from user";
		$query = $this->db->query($sql);
		return $query->first_row();
	}

	function get_total_exam(){
		$sql = "SELECT count(id) as total FROM exam_user"; 
		$query = $this->db->query($sql);
		return $query->first_row();
	}

	function get_avg_exam_horen(){
		$sql = "SELECT AVG(score) as average FROM exam_horen"; 
		$query = $this->db->query($sql); 
		return $query->first_row();
	}

	function get_avg_exam_lesen(){
		$sql = "SELECT AVG(score) as average FROM exam_lesen"; 
		$query = $this->db->query($sql); 
		return $query->first_row();
	}

}