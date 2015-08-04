<?php 

/**
* 
*/
class Opsi_soal_structure extends CI_Model
{
	private $table;
	private $primary_key;
	private $foreign_key;

	function __construct()
	{
		parent::__construct();
		$this->table = 'opsi_soal_struktur'; 
		$this->primary_key = 'id';
		$this->foreign_key = 'id_soal_struktur';
	}

	function insert($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function get_data_by_id($id){
		$query = $this->db->get_where($this->table, array($this->primary_key => $id));
		return $query->first_row();
	}


	function get_data_by_soal_id($soal_id){
		$this->db->where($this->foreign_key, $soal_id);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	function get_data_all(){
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	function update($id, $data){
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	function delete($id){
		$this->db->delete($this->table, array($this->primary_key => $id)); 
		return $this->db->affected_rows();
	}

	function delete_by_soal_id($soal_id){
		$this->db->where($this->foreign_key, $soal_id); 
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}

}