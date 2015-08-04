<?php


/**
* 
*/
class Horen_3_controller extends CI_Controller
{
	
	private $limit; 
	
	function __construct()
	{
		parent::__construct('admin');
		$this->load->model('horen_3');
		$this->load->model('opsi_horen_3');
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
		$items = $this->horen_3->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'Question', 'Sound', 'Text', 'Actions');

		$tmpl = array('table_open' => '<table class="table table-striped table-bordered table-hover">',
					  'table_close'=> '</table>');

		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination

		$this->load->library('pagination');
		$config['base_url'] =  base_url().'horen_2';
		$config['total_rows'] = $this->horen_3->get_total_data();
		$config['per_page'] = $this->limit;
		$config['num_links'] = 20;
		$config['uri_segment'] = 2;
		// $config['use_page_numbers'] = true;

		$pagination = $this->pagination->initialize($config);

		$i = 0+$offset;
		foreach ($items as $item) {
			$cell_question	= array('data'=> $item->question, 'width'=>'20%');
			$text  = strlen($item->text) > 100 ? substr($item->text, 0, 100).'...' : $item->text;
			$cell_text 	= array('data'=> $text, 'width' => '25%');		
			$cell_sound   = array('data'=> $item->sound, 'width'=>'25%');
			
			$this->table->add_row(++$i,
								  $cell_question,
								  $cell_sound,
								  $cell_text,
								  anchor(base_url()."horen_3_prev/".$item->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn mini yellow')).' | '.
								  anchor(base_url().'horen_3/'.$item->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn mini blue')).' | '.
								  anchor(base_url().'horen_3_del/'.$item->id, '<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn mini red')));
		}

		$this->template_backend->display('/back_end/horen_3/index');
	}

	function add(){
		if(isset($_POST['submit'])){
			$question = $this->input->post('question');
			$text 	  = $this->input->post('text');
			$hint 	  = $this->input->post('hint');
			$answer   = $this->input->post('answer');

			$data = array('question' => $question, 
						  'text' => $text, 
						  'hint' => $hint);
			
			$soal_id = $this->horen_3->insert($data);
  
			// insert data options
			$total_options = 3; 
			for ($i=1; $i <= $total_options; $i++) { 
				$value = 0; 
				if($i == $answer){
					$value = 1;
				}
				
				$option_text = $this->input->post('opsi'.$i);
				$option_data = array('text' => $option_text, 
									 'value' => $value, 
									 'horen_id' => $soal_id);
				$this->opsi_horen_3->insert($option_data);
			}

			if(isset($_FILES['sound']['name'])){
				/* uploading mp3 */
				$config['upload_path'] 		= './upload/audio/';
				$config['allowed_types'] 	= 'mp3';
				$config['max_size']			= '6000';
				$field_name 				= 'sound';
				$this->load->library('upload', $config);

				// echo "<pre>";
				if (!$this->upload->do_upload($field_name)){
					$error = $this->upload->display_errors('', '');
					//$this->output->set_output($error);
					redirect(base_url().'horen_2/'.$horen_3);
				}else{
					$data_upload = $this->upload->data();
					$audio_name = $data_upload['file_name'];
					$data = array('sound' => 'upload/audio/'.$audio_name);
					$this->horen_3->update($soal_id, $data);
					
				}
			}
			redirect(base_url().'horen_3');
		}
		$this->template_backend->display('/back_end/horen_3/add');
	}

	function edit($id){
		if(isset($_POST['submit'])){
			$question = $this->input->post('question');
			$text 	  = $this->input->post('text');
			$hint 	  = $this->input->post('hint');
			$answer   = $this->input->post('answer');

			$data = array('question' => $question, 
						  'text' => $text, 
						  'hint' => $hint);
			
			$this->horen_3->update($id, $data);

			
			// insert data options
			$total_options = 3; 
			for ($i=1; $i <= $total_options; $i++) { 
				$value = 0; 
				if($i == $answer){
					$value = 1;
				}
				
				$option_id = $this->input->post('opsi_id'.$i);
				$option_text = $this->input->post('opsi'.$i);
				$option_data = array('text' => $option_text, 
									 'value' => $value, 
									 'horen_id' => $id);
				if($option_id > 0){
					$this->opsi_horen_3->update($option_id, $option_data);
				}else{
					$this->opsi_horen_3->insert($option_data);
				}
			}

			if(isset($_FILES['sound']['name'])){
				/* uploading mp3 */
				$config['upload_path'] 		= './upload/audio/';
				$config['allowed_types'] 	= 'mp3';
				$config['max_size']			= '6000';
				$field_name 				= 'sound';
				$this->load->library('upload', $config);

				// echo "<pre>";
				if (!$this->upload->do_upload($field_name)){
					$error = $this->upload->display_errors('', '');
					$this->output->set_output($error);
					//redirect(base_url().'horen_3/'.$id);
				}else{
					$data_upload = $this->upload->data();
					$audio_name = $data_upload['file_name'];
					$data = array('sound' => 'upload/audio/'.$audio_name);
					$this->horen_3->update($id, $data);
				}
			}
			redirect(base_url().'horen_3');

		}
		$data['horen'] = $this->horen_3->get_data_by_id($id);
		$data['options'] = $this->opsi_horen_3->get_data_by_horen_id($id);
		$this->template_backend->display('/back_end/horen_3/edit', $data);	
	}

	function view($id){
		$data['horen'] = $this->horen_3->get_data_by_id($id);
		$data['options'] = $this->opsi_horen_3->get_data_by_horen_id($id);
		$this->template_backend->display('/back_end/horen_3/view', $data);	
	}


	function delete($id){
		$this->horen_3->delete($id); 
		redirect(base_url().'horen_3');
	}


	function ajax_header(){
		$data['title'] 		= "Horen"; 	
		$data['subtitle'] 	= "Manage soal horen 3"; 
		$data['link']		= base_url().'horen_3'; 
		$data['link_label'] = 'Teil 3';

		$this->load->view('/back_end/ajax/header_crud', $data);
	}

}