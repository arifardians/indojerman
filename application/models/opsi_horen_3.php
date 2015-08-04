<?php


/**
* 
*/
class Opsi_horen_3 extends CI_Model
{
	
	private $table; 
	private $primary_key;
	private $foreign_key;

	function __construct()
	{
		parent::__construct(); 
		$this->table = "opsi_horen_3"; 
		$this->primary_key = "id";
		$this->foreign_key = "horen_id";
	}

	function insert($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function get_data_by_id($id){
		$query = $this->db->get_where($this->table, array($this->primary_key => $id));
		return $query->first_row();
	}

	function get_all_data()
	{
		$query = $this->db->get($this->table);
		return $query->result_object();
	}

	function get_data_by_horen_id($horen_id){
		$query = $this->db->get_where($this->table, array($this->foreign_key => $horen_id));
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
}