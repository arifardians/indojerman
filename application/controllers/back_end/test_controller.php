<?php
class Test_controller extends CI_Controller{

	function __construct() {
		parent::__construct();
		$this->load->library('Datatables');		
	}

	function datatable(){
		// id, soal, penjelasan, jenis_soal
		$this->datatables->select('id, soal,penjelasan, id_jenis_soal')
						 ->from('soal_struktur');
		echo $this->datatables->generate();
	}

	function index(){
		$this->template_backend->display('/latihan/index');
	}

	function get_data_json(){
		$this->load->model('soal_structure');
		$data = $this->soal_structure->get_all_data();
		echo json_encode($data);
	}
}