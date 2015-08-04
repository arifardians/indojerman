<?php 


/**
* 
*/
class Exam_lesen extends CI_Model
{
	
	private $table; 
	private $primary_key; 
	private $foreign_key; 

	function __construct()
	{
		parent::__construct();
		$this->table 		= 'exam_lesen';
		$this->primary_key 	= 'id'; 
		$this->foreign_key  = 'exam_user_id';
	}

	function insert($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function get_data_by_id($id){
		$query = $this->db->get_where($this->table, array($this->primary_key => $id));
		$query = $query->first_row();
		return $query;
	}

	function get_all_data(){
		$query = $this->db->get($this->table);
		return $query->result_object();
	}

	function get_paged_list($limit =5, $offset=0, $order_column='', $order_type='asc')
	{
		if(empty($order_column) || empty($order_type))
			$this->db->order_by($this->$primary_key, 'asc');
		else
			$this->db->order_by($order_column, $order_type);
		return $this->db->get($this->table, $limit, $offset);
	}

	function get_data_by_exam_user_id($user_id){
		$query = $this->db->get_where($this->table, array($this->foreign_key => $user_id));
		return $query->result_object();
	}

	function get_avg_score_by_user_id($user_id){
		$sql = "SELECT SUM(score) / COUNT(id) AS score FROM exam_lesen WHERE exam_user_id IN ( SELECT id FROM exam_user WHERE user_id = ? )"; 
		$query = $this->db->query($sql, array($user_id));
		return $query->first_row();
	}

	function get_score_records_by_user_id($user_id){
		$sql = "SELECT score FROM exam_lesen WHERE exam_user_id IN ( SELECT id FROM exam_user WHERE user_id = ? )"; 
		$query = $this->db->query($sql, array($user_id));
		return $query->result_object();
	}

	function update($id, $data)
	{
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	function delete($id){
		$this->db->delete($this->table, array($this->primary_key => $id));
		return $this->db->affected_rows();
	}

	function get_total_data()
	{
		return $this->db->count_all($this->table);
	}
}