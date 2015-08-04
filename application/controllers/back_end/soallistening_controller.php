<?php 


/**
* 
*/
class Soallistening_controller extends MY_Controller
{
	private $limit;	
	function __construct()
	{
		parent::__construct('admin');
		$this->load->model('soal_listening');
		$this->load->model('opsi_soal_listening');
		$this->load->model('jenis_soal');
		$this->limit =  10;
	}

	function index($offset=0, $order_column='id', $order_type='asc'){
	if(empty($offset))
			$offset = 0;
		if(empty($order_column))
			$order_column = 'id';
		if(empty($order_type))
			$order_type = 'asc';

		// load data 
		$soals = $this->soal_listening->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'Soal', 'audio', 'Jenis Soal', 'Actions');

		$tmpl = array('table_open' => '<table class="table table-striped table-bordered table-hover table-full-width">',
					  'table_close'=> '</table>');

		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination

		$this->load->library('pagination');
		$config['base_url'] =  base_url().'index.php/back_end/soallistening_controller/index';
		$config['total_rows'] = $this->soal_listening->get_number_of_data();
		$config['per_page'] = $this->limit;
		$config['num_links'] = 20;
		$config['uri_segment'] = 2;
	
		$pagination = $this->pagination->initialize($config);
	
		$i = 0+$offset;
		foreach ($soals as $soal) {
			$cell_soal = array('data'=> $soal->soal, 'width'=>'25%');
			$cell_penjelasan = array('data'=> $soal->audio, 'width' => '30%');
			$this->table->add_row(++$i,
								  $cell_soal,
								  $cell_penjelasan,
								  $soal->id_jenis_soal == 1 ? 'Soal Latihan' : 'Soal Ujian',
								  anchor(base_url()."soal_lst_prev/".$soal->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn yellow')).' | '.
								  anchor(base_url().'soal_lst/'.$soal->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn blue')).' | '.
								  anchor('/back_end/soallistening_controller/delete/'.$soal->id, '<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn red')));
		}


		$this->template_backend->display('/back_end/soal_listening/index');
	
	}

	function add(){
		if (isset($_POST['submit'])) {
			$soal 		= $this->input->post('soal');
			$penjelasan = $this->input->post('penjelasan');
			$jenis_soal = $this->input->post('jenis_soal');

			$answer = $this->input->post('answer');
			
			$data = array('soal' => $soal, 
						  'penjelasan' => $penjelasan, 
						  'id_jenis_soal' => $jenis_soal);
			$id_soal = $this->soal_listening->insert($data);
			$total_opsi = 4; 
			$data_options = array();
			for ($i=1; $i <= $total_opsi; $i++) { 
				$value = 0;
				if($i == $answer){
					$value = 1;
				}
				$opsi = $this->input->post('opsi'.$i);
				$option_data = array('opsi'=>$opsi, 
								 	 'nilai'=>$value, 
								 	 'id_soal_listening'=>$id_soal);
				array_push($data_options, $option_data);
				$this->opsi_soal_listening->insert($option_data);
			}
			/* uploading mp3 */
			$config['upload_path'] 		= './upload/audio/';
			$config['allowed_types'] 	= 'mp3';
			$config['max_size']			= '6000';
			$field_name 				= 'audio';
			$this->load->library('upload', $config);
			// echo "<pre>";
			// $this->output->set_output($);
			if (!$this->upload->do_upload('audio')){
					$error = $this->upload->display_errors('', '');
					$this->output->set_output($error);
			}else{
				$data_upload = $this->upload->data();
				$audio_name = $data_upload['file_name'];
				$data = array('audio' => '/upload/audio/'.$audio_name);
				$this->soal_listening->update($id_soal, $data);
				redirect(base_url().'soal_lst');
				/*echo "<pre>";
				$this->output->set_output($data_upload);
*/
			}
		}

		$this->load->model('jenis_soal');
		$data['jenis_soal'] = $this->jenis_soal->get_all_data();
		$this->template_backend->display('/back_end/soal_listening/add', $data);
	}

		
	function view($id=null){
		$data['jenis_soal'] = $this->jenis_soal->get_all_data();
		$data['soal'] = $this->soal_listening->get_data_by_id($id);
		$data['options'] = $this->opsi_soal_listening->get_data_by_soal_id($id);
		$this->template_backend->display('/back_end/soal_listening/view', $data);
	}

	function edit($id = null){
		if(isset($_POST['submit'])){
			$soal 		= $this->input->post('soal');
			$penjelasan = $this->input->post('penjelasan');
			$jenis_soal = $this->input->post('jenis_soal');

			
			$data = array('soal' => $soal, 'penjelasan' => $penjelasan, 
						  'id_jenis_soal' => $jenis_soal);
			$this->soal_listening->update($id, $data);
			
			/* answer options*/
			$answer = $this->input->post('answer');

			$total_opsi = 4; 
			for ($i=1; $i <= $total_opsi ; $i++) { 
				$value = 0;
				if($i == $answer){
					$value = 1;
				}
				$id_opsi = $this->input->post('id_opsi'.$i); // looping untuk id_opsi1, id_opsi2 dst
				$opsi = $this->input->post('opsi'.$i);
				$option = array('opsi'=>$opsi, 
								'nilai'=>$value, 
								'id_soal_listening'=>$id);
				$this->opsi_soal_listening->update($id_opsi, $option);
			}

			/* upload actions */
			if(empty($_FILES['audio']['name'])){
				redirect(base_url().'soal_lst_prev/'.$id);
			}else{
				$config['upload_path'] 		= './upload/audio/';
				$config['allowed_types'] 	= 'mp3';
				$config['max_size']			= '6000';
				$field_name 				= 'audio';
				$this->load->library('upload', $config);
			
				if (!$this->upload->do_upload('audio')){
						$error = $this->upload->display_errors('', '');
						$this->output->set_output($error);
				}else{
					$data_upload = $this->upload->data();
					$audio_name = $data_upload['file_name'];
					$data = array('audio' => '/upload/audio/'.$audio_name);
					$this->soal_listening->update($id, $data);
					redirect(base_url().'soal_lst_prev/'.$id);
				}
			}
		}
		$data['jenis_soal'] = $this->jenis_soal->get_all_data();
		$data['soal'] 		= $this->soal_listening->get_data_by_id($id);
		$data['options'] 	= $this->opsi_soal_listening->get_data_by_soal_id($id);
		$this->template_backend->display('/back_end/soal_listening/edit', $data);
	}

	function delete($id=null){
		$this->opsi_soal_listening->delete_by_soal_id($id);
		$this->soal_listening->delete($id);
		redirect(base_url().'soal_lst');
	}

}