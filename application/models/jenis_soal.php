<?php 

/**
* 
*/
class Jenis_soal extends MY_Model 
{
	private $table; 
	private $table_id; 

	function __construct()
	{
		parent::__construct();
		$this->table = 'jenis_soal';
		$this->table_id = 'id'; 
	}

	function insert($data){
		return $this->insert($this->table, $data);
	}

	function get_data_by_id($id){
		return $this->get_data_by_id($this->table, $this->table_id, $id, null, null); 
	}

	function get_all_data(){
		$query = $this->db->get($this->table); 
		$data = $query->result_array();
		return $data;
		// return $this->get_all_data($this->table);
	}

	function update($data){
		return $this->update($this->table, $this->table_id, $id, $data);
	}

	function delete($id){
		return $this->delete($this->table, $this->table_id, $id);
	}

}