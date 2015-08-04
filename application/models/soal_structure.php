<?php

/**
* 
*/
class Soal_structure extends MY_Model
{
	private $table;
	private $table_id;
	function __construct()
	{
		parent::__construct();
		$this->table 	= 'soal_struktur';
		$this->table_id = 'id';
	}

	function insert($data){
		$this->db->insert($this->table, $data);
        return $this->db->insert_id();
		// return $this->insert($this->table, $data);
	}

	function get_data_by_id($id){
		 $query = $this->db->get_where($this->table, array($this->table_id => $id));
       	 return $query->result_array();
	}

	function get_all_data(){
		$query 	= $this->db->get($this->table);
		$data 	= $query->result_array();
		return $data;
	}

	function get_paged_list($limit =10, $offset=0, $order_column='', $order_type='asc'){
		if(empty($order_column) || empty($order_type))
			$this->db->order_by($this->$table_id, 'asc');
		else
			$this->db->order_by($order_column, $order_type);
		return $this->db->get($this->table, $limit, $offset);
	}

	function get_all_data_humanize(){
		$query =  $this->db->query("SELECT s.id, s.soal, s.penjelasan, j.jenis FROM soal_struktur s, jenis_soal j WHERE s.id_jenis_soal = j.id");
		$data = $query->result_array();
		return $data;
	}

	function update($id, $data){
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	} 

	function delete($id){
		$this->db->delete($this->table, array($this->table_id => $id));
		return $this->db->affected_rows();
	}

	function get_number_of_data(){
		return $this->db->get($this->table)->num_rows();
	}

	function get_latihan()
	{
		$query = $this->db->query('SELECT * FROM soal_struktur WHERE id_jenis_soal = 1 ORDER BY RAND() limit 5');
		return $query->result_object();
	}
}

