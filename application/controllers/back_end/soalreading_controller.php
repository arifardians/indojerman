<?php
class Soalreading_controller extends MY_Controller{

	private $limit;
	function __construct(){
		parent::__construct('admin');
		$this->load->model('reading_text');
		$this->load->model('soal_reading');
		$this->load->model('opsi_soal_reading');
		$this->load->model('jenis_soal');
		$this->limit = 10;
	}

	function index($offset = 0, $order_column = 'id', $order_type = 'asc'){
		if(empty($offset))
			$offset = 0;
		if(empty($order_column))
			$order_column = 'id';
		if(empty($order_type))
			$order_type = 'asc';

		$reading_texts = $this->reading_text->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'Judul Artikel', 'Text', 'Jenis Soal', 'Actions');

		$tmpl = array('table_open'  => '<table class="table table-striped table-bordered table-hover table-full-width">',
					  'table_close' => '</table>');
		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] 	= base_url().'index.php/back_end/soalreading_controller/index';
		$config['total_rows'] 	= $this->reading_text->get_total_data();
		$config['per_page'] 	= $this->limit;
		$config['num_links'] 	= 20;
		$config['uri_segment'] 	= 2;

		$pagination = $this->pagination->initialize($config);

		$i = 0+$offset;
		foreach ($reading_texts as $article) {
			$cell_text = array('data' => $article->isi, 'width'=>'50%');
			$this->table->add_row(++$i,
								  $article->judul,
								  $cell_text,
								  $article->id_jenis_soal == 1 ? 'Soal Latihan' : 'Soal Ujian',
								  anchor(base_url()."read_text_prev/".$article->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn yellow')).' | '.
								  anchor(base_url().'read_text/'.$article->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn blue')).' | '.
								  anchor(base_url().'index.php/back_end/soalreading_controller/delete/'.$article->id,'<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn red')));
		}

		$this->template_backend->display('/back_end/soal_reading/index');
	}

	function add(){
		if(isset($_POST['submit'])){
			$judul 		= $this->input->post('judul');
			$jenis_soal = $this->input->post('jenis_soal');
			$isi 		= $this->input->post('isi');

			$data = array('judul' => $judul,
						  'id_jenis_soal' => $jenis_soal,
						  'isi'=>$isi);
			$record_article = $this->reading_text->insert($data);
			if($record_article){
				redirect(base_url().'read_text', 'refresh');
			}
		}
		$this->template_backend->display('/back_end/soal_reading/text/add');
	}

	function edit($id){
		if(isset($_POST['submit'])){
			$judul = $this->input->post('judul');
			$jenis_soal = $this->input->post('jenis_soal');
			$isi = $this->input->post('isi');

			$data = array('judul' => $judul, 'id_jenis_soal' => $jenis_soal, 'isi' => $isi);
			$this->reading_text->update($id, $data);
			redirect(base_url().'read_text');
		}
		$data['jenis_soal'] = $this->jenis_soal->get_all_data();
		$data['reading_text'] = $this->reading_text->get_data_by_id($id);
		$this->template_backend->display('/back_end/soal_reading/text/edit', $data);
	}

	function view($id=null){
		
		// $soal_readings = $this->soal_reading->get_paged_list($limit_soal, $offset, $order_column, $order_type)->result();
		$soal_readings = $this->soal_reading->get_data_by_reading_text($id);
		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'Soal Reading', 'Penjelasan', 'Actions');

		$tmpl = array('table_open'  => '<table class="table table-striped table-bordered table-hover table-full-width">',
					  'table_close' => '</table>');
		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] 	= base_url().'index.php/back_end/soalreading_controller/view/'.$id;
		$config['total_rows'] 	= $this->soal_reading->get_total_data();
		$config['per_page'] 	= 10;
		$config['num_links'] 	= 20;
		$config['uri_segment'] 	= 2;

		$pagination = $this->pagination->initialize($config);

		$i =0;
		foreach ($soal_readings as $soal_reading) {
			$cell_soal = array('data' => $soal_reading->soal, 'width'=>'30%');
			$cell_penjelasan = array('data'=>$soal_reading->penjelasan, 'width'=> '30%');
			$this->table->add_row(++$i,
								  $cell_soal,
								  $cell_penjelasan,
								  anchor(base_url().'soal_reading_edit/'.$soal_reading->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn blue')).' | '.
								  anchor(base_url().'index.php/back_end/soalreading_controller/delete_soal/'.$soal_reading->id,'<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn red')));
		}


		$data['jenis_soal'] = $this->jenis_soal->get_all_data();
		$data['reading_text'] = $this->reading_text->get_data_by_id($id);
		$this->template_backend->display('/back_end/soal_reading/text/view', $data);
	}

	function delete($id=null){
		$this->reading_text->delete($id);
		redirect('/back_end/soalreading_controller/index');
	}

	function add_soal($id_reading_text = 0){
		if(isset($_POST['submit'])){
			$soal 		= $this->input->post('soal');
			$penjelasan = $this->input->post('penjelasan');

			$data = array('soal' => $soal, 'penjelasan'=> $penjelasan, 'id_artikel'=>$id_reading_text);			
			$id_soal_reading = $this->soal_reading->insert($data);

			/* opsi soal reading */
			$opsi1 = $this->input->post('opsi1');
			$opsi2 = $this->input->post('opsi2');
			$opsi3 = $this->input->post('opsi3');
			$opsi4 = $this->input->post('opsi4');

			/* answer */
			$answer = $this->input->post('answer');

			$options = array(); 
			array_push($options, $opsi1);
			array_push($options, $opsi2);
			array_push($options, $opsi3);
			array_push($options, $opsi4);

			$all['data'] = $data; 
			$all['answer'] = $answer; 
			$all['options'] = $options;

			echo "<pre>";
			print_r($all);

			$opsi_index = 1; 
			foreach ($options as $option) {
				$value = 0; 
				if($opsi_index == $answer){
					$value = 1; 
				}
				$data = array('opsi' => $option, 'nilai'=>$value, 'id_soal_artikel' => $id_soal_reading);
				$this->opsi_soal_reading->insert($data);
				$opsi_index++;
			}

			/* after inserting process, redirect to view reading text */
			redirect(base_url().'read_text_prev/'.$id_reading_text);
		}
		$data['reading_text']  = $this->reading_text->get_data_by_id($id_reading_text);
		$data['jenis_soal']		 = $this->jenis_soal->get_all_data();
		$this->template_backend->display('/back_end/soal_reading/soal/add', $data);

	}

	
	function edit_soal($id_soal){
		if(isset($_POST['submit'])){
			$soal = $this->input->post('soal');
			$penjelasan = $this->input->post('penjelasan');

			$data = array('soal' => $soal, 'penjelasan' => $penjelasan);

			$this->soal_reading->update($id_soal, $data);

			/* opsi soal reading */
			$answer = $this->input->post('answer');

			$total_opsi = 4; 
			$data_options = array();
			for ($i=1; $i <= $total_opsi; $i++) { 
				$value = 0;
				if($i == $answer){
					$value = 1;
				}
				$id_opsi = $this->input->post('id_opsi'.$i); // looping untuk id_opsi1, id_opsi2 dst
				$opsi = $this->input->post('opsi'.$i);
				$option_data = array('opsi'=>$opsi, 
								 	 'nilai'=>$value, 
								 	 'id_soal_artikel'=>$id_soal);
				// array_push($data_options, $option_data);
				$this->opsi_soal_reading->update($id_opsi, $option_data);
			}
			// echo "<pre>"; 
			// $this->output->set_output(print_r($data_options));
			$soal_reading = $this->soal_reading->get_data_by_id($id_soal);
			redirect(base_url().'read_text_prev/'.$soal_reading->id_artikel);
			
		}
		$soal_reading = $this->soal_reading->get_data_by_id($id_soal);
		$reading_text = $this->reading_text->get_data_by_id($soal_reading->id_artikel);
		$options      = $this->opsi_soal_reading->get_data_by_soal_id($soal_reading->id);
		$jenis_soal   = $this->jenis_soal->get_all_data();
		$data['reading_text'] = $reading_text; 
		$data['soal_reading'] = $soal_reading;
		$data['options'] 	  = $options;
		$data['jenis_soal']	  = $jenis_soal;

		$this->template_backend->display('back_end/soal_reading/soal/edit', $data);
	}

	function delete_soal($id_soal = 0){
		$this->opsi_soal_reading->delete_by_soal_id($id_soal);

		$soal_reading = $this->soal_reading->get_data_by_id($id_soal);
		$id_reading_text = $soal_reading->id_artikel;
		$this->soal_reading->delete($id_soal);
		redirect(base_url().'read_text_prev/'.$id_reading_text);
	}

}
