<?php

class Soalstructure_controller extends MY_Controller
{
	private $limit;

	function __construct()	{
		parent::__construct('admin');
		$this->load->model('soal_structure');
		$this->load->model('jenis_soal');
		$this->load->model('opsi_soal_structure');
		$this->limit = 10;
	}

	function index($offset=0, $order_column='id', $order_type='asc'){
		if(empty($offset))
			$offset = 0;
		if(empty($order_column))
			$order_column = 'id';
		if(empty($order_type))
			$order_type = 'asc';

		// load data soal struktur
		$soals = $this->soal_structure->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'Soal', 'Penjelasan', 'Jenis Soal', 'Actions');

		$tmpl = array('table_open' => '<table class="table table-striped table-bordered table-hover table-full-width">',
					  'table_close'=> '</table>');

		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination

		$this->load->library('pagination');
		$config['base_url'] =  base_url().'index.php/back_end/soalstructure_controller/index';
		$config['total_rows'] = $this->soal_structure->get_number_of_data();
		$config['per_page'] = $this->limit;
		$config['num_links'] = 20;
		$config['uri_segment'] = 2;
		// $config['use_page_numbers'] = true;

		$pagination = $this->pagination->initialize($config);

		$i = 0+$offset;
		foreach ($soals as $soal) {
			$cell_soal = array('data'=> $soal->soal, 'width'=>'25%');
			$cell_penjelasan = array('data'=> $soal->penjelasan, 'width' => '30%');
			$this->table->add_row(++$i,
								  $cell_soal,
								  $cell_penjelasan,
								  $soal->id_jenis_soal == 1 ? 'Soal Latihan' : 'Soal Ujian',
								  anchor(base_url()."soal_str_prev/".$soal->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn yellow')).' | '.
								  anchor(base_url().'soal_str/'.$soal->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn blue')).' | '.
								  anchor('/back_end/soalstructure_controller/delete/'.$soal->id, '<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn red')));
		}


		$this->template_backend->display('/back_end/soal_structure/index');

	}

	function add(){
		if(isset($_POST['submit'])){
			$soal = $this->input->post('soal');
			$penjelasan = $this->input->post('penjelasan');
			$jenis_soal = $this->input->post('jenis_soal');

			$opsi1 = $this->input->post('opsi1');
			$opsi2 = $this->input->post('opsi2');
			$opsi3 = $this->input->post('opsi3');
			$opsi4 = $this->input->post('opsi4');

			$answer = $this->input->post('answer');

			$data = array('soal' => $soal,
						  'id_jenis_soal' => $jenis_soal,
						  'penjelasan' => $penjelasan);

			$soal_id = $this->soal_structure->insert($data);

			$options = array();
			array_push($options, $opsi1);
			array_push($options, $opsi2);
			array_push($options, $opsi3);
			array_push($options, $opsi4);

			$opsi_index = 1;
			$this->load->model('opsi_soal_structure');

			foreach ($options as $option) {
				$value = 0;
				if($opsi_index == $answer){
					$value = 1;
				}
				$data = array('opsi'=> $option, 'nilai'=>$value, 'id_soal_struktur'=> $soal_id);
				$this->opsi_soal_structure->insert($data);
				$opsi_index++;
			}

			redirect(base_url().'soal_str_prev/'.$soal_id);

		}
		$this->load->model('jenis_soal');
		$data['jenis_soal'] = $this->jenis_soal->get_all_data();
		$this->template_backend->display('/back_end/soal_structure/add', $data);

	}

	function edit($id = null){
		if(isset($_POST['submit'])){
			$soal = $this->input->post('soal');
			$penjelasan = $this->input->post('penjelasan');
			$jenis_soal = $this->input->post('jenis_soal');


			$options = array();
			$option = array();
			for ($i=1; $i <=4 ; $i++) {
				$option = array('id' => $this->input->post('opsi_id'.$i),
								'opsi' => $this->input->post('opsi'.$i));
				array_push($options, $option);
			}

			$answer = $this->input->post('answer');

			$data = array('soal' => $soal,
						  'id_jenis_soal' => $jenis_soal,
						  'penjelasan' => $penjelasan);
			$this->soal_structure->update($id, $data);

			$opsi_index = 1;
			foreach ($options as $option) {
				$value = 0;
				if($opsi_index == $answer){
					$value = 1;
				}
				$data = array('opsi'=> $option['opsi'],
							  'nilai'=> $value,
							  'id_soal_struktur' => $id);
				if($option['id']==0){
					$this->opsi_soal_structure->insert($data);
				}else{
					$this->opsi_soal_structure->update($option['id'], $data);
				}
				$opsi_index++; // opsi di increment
			}
			redirect(base_url().'soal_str_prev/'.$id);
		}

		$data['jenis_soal'] = $this->jenis_soal->get_all_data();
		$data['soal'] = $this->soal_structure->get_data_by_id($id);
		$data['options']  = $this->opsi_soal_structure->get_data_by_soal_id($id);
		$this->template_backend->display('/back_end/soal_structure/edit', $data);
	}

	function view($id=null){
		$data['jenis_soal'] = $this->jenis_soal->get_all_data();
		$data['soal'] = $this->soal_structure->get_data_by_id($id);
		$data['options'] = $this->opsi_soal_structure->get_data_by_soal_id($id);
		$this->template_backend->display('/back_end/soal_structure/view', $data);
	}

	function delete($id=null){
		$this->opsi_soal_structure->delete_by_soal_id($id);
		$this->soal_structure->delete($id);
		redirect(base_url().'soal_str');
	}
}
