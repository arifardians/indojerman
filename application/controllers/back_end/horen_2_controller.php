<?php 


/**
* 
*/
class Horen_2_controller extends MY_Controller
{
	private $limit; 
	
	function __construct()
	{
		parent::__construct('admin');
		$this->load->model('horen_2');
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
		$items = $this->horen_2->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'Statement', 'Sound', 'Text', 'Value', 'Actions');

		$tmpl = array('table_open' => '<table class="table table-striped table-bordered table-hover">',
					  'table_close'=> '</table>');

		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination

		$this->load->library('pagination');
		$config['base_url'] =  base_url().'horen_2';
		$config['total_rows'] = $this->horen_2->get_total_data();
		$config['per_page'] = $this->limit;
		$config['num_links'] = 20;
		$config['uri_segment'] = 2;
		// $config['use_page_numbers'] = true;

		$pagination = $this->pagination->initialize($config);

		$i = 0+$offset;
		foreach ($items as $item) {
			$cell_statement	= array('data'=> $item->statement, 'width'=>'20%');
			$text  = strlen($item->text) > 100 ? substr($item->text, 0, 100).'...' : $item->text;
			$cell_text 	= array('data'=> $text, 'width' => '25%');		
			$cell_sound   = array('data'=> $item->sound, 'width'=>'25%');
			$cell_value  = $item->value == 1? 'Richtig' : 'Falsch';
			$this->table->add_row(++$i,
								  $cell_statement,
								  $cell_sound,
								  $cell_text,
								  $cell_value,
								  anchor(base_url()."horen_2_prev/".$item->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn mini yellow')).' | '.
								  anchor(base_url().'horen_2/'.$item->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn mini blue')).' | '.
								  anchor(base_url().'horen_2_del/'.$item->id, '<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn mini red')));
		}

		$this->template_backend->display('/back_end/horen_2/index');
	}


	function add(){
		if(isset($_POST['submit'])){
			$statement 	= $this->input->post('statement');
			$text 	   	= $this->input->post('text');
			$hint		= $this->input->post('hint'); 
			$value 		= $this->input->post('value');

			$data = array('statement' => $statement, 
						  'text' => $text, 
						  'hint' => $hint, 
						  'value' => $value);

			$horen_id = $this->horen_2->insert($data);

			if(!empty($_FILES['sound']['name'])){
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
					redirect(base_url().'horen_2/'.$horen_2);
				}else{
					$data_upload = $this->upload->data();
					$audio_name = $data_upload['file_name'];
					$data = array('sound' => 'upload/audio/'.$audio_name);
					$this->horen_2->update($horen_id, $data);
				
				}
			}
			redirect(base_url().'horen_2');

		}
		$this->template_backend->display('/back_end/horen_2/add');
	}

	function edit($id){
		$horen = $this->horen_2->get_data_by_id($id);
		
		if(isset($_POST['submit'])){
			$statement 	= $this->input->post('statement');
			$text 		= $this->input->post('text');
			$hint 		= $this->input->post('hint');
			$value		= $this->input->post('value'); 

			$data = array('statement' => $statement, 
						  'text' => $text, 
						  'hint' => $hint, 
						  'value' => $value);

			$this->horen_2->update($id, $data);
			if(!empty($_FILES['sound']['name'])){
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
					redirect(base_url().'horen_2/'.$horen_2);
				}else{
					$data_upload = $this->upload->data();
					$audio_name = $data_upload['file_name'];
					$data = array('sound' => 'upload/audio/'.$audio_name);
					$this->horen_2->update($id, $data);
					
				}
			}
			redirect(base_url().'horen_2');
		}

		$data['horen'] = $horen;
		$this->template_backend->display('/back_end/horen_2/edit', $data);
	}

	function view($id){
		$data['horen'] = $this->horen_2->get_data_by_id($id);
		$this->template_backend->display('/back_end/horen_2/view', $data);
	}

	function delete($id){
		$this->horen_2->delete($id); 
		redirect(base_url().'horen_2');
	}


	function ajax_header(){
		$data['title'] 		= "Horen"; 
		$data['subtitle'] 	= "Manage soal horen 2"; 
		$data['link']		= base_url().'horen_2'; 
		$data['link_label'] = 'Teil 2';

		$this->load->view('/back_end/ajax/header_crud', $data);
	}
}