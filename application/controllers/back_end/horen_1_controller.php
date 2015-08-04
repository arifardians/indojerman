<?php 


/**
* 
*/
class Horen_1_controller extends MY_Controller
{
	private $limit; 
	function __construct()
	{
		parent::__construct('admin');
		$this->load->model('horen_1');
		$this->load->model('opsi_horen_1');
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
		$soals = $this->horen_1->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'Question', 'Sound', 'Explanation', 'Actions');

		$tmpl = array('table_open' => '<table class="table table-striped table-bordered table-hover">',
					  'table_close'=> '</table>');

		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination

		$this->load->library('pagination');
		$config['base_url'] =  base_url().'horen_1';
		$config['total_rows'] = $this->horen_1->get_total_data();
		$config['per_page'] = $this->limit;
		$config['num_links'] = 20;
		$config['uri_segment'] = 2;
		// $config['use_page_numbers'] = true;

		$pagination = $this->pagination->initialize($config);

		$i = 0+$offset;
		foreach ($soals as $soal) {
			$cell_judul	= array('data'=> $soal->question, 'width'=>'20%');
			$text  = strlen($soal->explanation) > 100 ? substr($soal->explanation, 0, 100).'...' : $soal->explanation;
			$cell_text 	= array('data'=> $text, 'width' => '25%');		
			$cell_isi   = array('data'=> $soal->sound, 'width'=>'25%');
			
			$this->table->add_row(++$i,
								  $cell_judul,
								  $cell_isi,
								  $cell_text,
								  anchor(base_url()."horen_1_prev/".$soal->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn mini yellow')).' | '.
								  anchor(base_url().'horen_1/'.$soal->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn mini blue')).' | '.
								  anchor(base_url().'horen_1_del/'.$soal->id, '<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn mini red')));
		}

		$this->template_backend->display('/back_end/horen_1/index');
	}

	function add(){
		if(isset($_POST['submit'])){
			$question    = $this->input->post('question');
			$explanation = $this->input->post('explanation');

			$data = array('question' => $question, 
						  'explanation' => $explanation);

			$soal_id = $this->horen_1->insert($data);

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
					$this->output->set_output($error);
				}else{
					$data_upload = $this->upload->data();
					$audio_name = $data_upload['file_name'];
					$data = array('sound' => 'upload/audio/'.$audio_name);
					$this->horen_1->update($soal_id, $data);
					redirect(base_url().'horen_1');
				
				}
			}else{
				redirect(base_url().'horen_1');
			}

		}
		$this->template_backend->display('/back_end/horen_1/add');
	}

	function edit($id){
		if(isset($_POST['submit'])){
			$question 		= $this->input->post('question');
			$explanation 	= $this->input->post('explanation');

			$data = array('question' => $question, 
						  'explanation' => $explanation);

			// update horen data 
			$this->horen_1->update($id, $data);

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
					$this->output->set_output($error);
				}else{
					$data_upload = $this->upload->data();
					$audio_name = $data_upload['file_name'];
					$data = array('sound' => 'upload/audio/'.$audio_name);
					$this->horen_1->update($id, $data);
					redirect(base_url().'horen_1');
				
				}
			}else{
				redirect(base_url().'horen_1');
			}

		}
		$horen = $this->horen_1->get_data_by_id($id);
		$data['horen'] = $horen;
		$this->template_backend->display('/back_end/horen_1/edit', $data);
	}

	function view($id){
		$this->load->model('opsi_horen_1');

		$this->load->library('table');
		$this->table->set_heading('No', 'Image', 'Text', 'Value', 'Actions');

		$tmpl = array('table_open'  => '<table class="table table-striped table-bordered table-hover table-full-width">',
					  'table_close' => '</table>');
		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] 	= base_url().'horen_1_prev/'.$id;
		$config['total_rows'] 	= 5; // max total statements each lesen
		$config['per_page'] 	= 10;
		$config['num_links'] 	= 20;
		$config['uri_segment'] 	= 2;

		$pagination = $this->pagination->initialize($config);
		$soals = $this->opsi_horen_1->get_data_by_horen_id($id);

		$i =0;
		foreach ($soals as $soal) {
			$cell_image = array('data' => '<img src="'.base_url().$soal->image.'" width="100px" />', 'width'=>'15%', 'alignment'=> 'center');
			$cell_text  = array('data' => $soal->text, 'width' => '25%');
			$cell_value  = array('data'=> $soal->value == 1 ? 'Richtig' : 'Falsch', 'width'=> '10%');
			$this->table->add_row(++$i,
								  $cell_image,
								  $cell_text,
								  $cell_value,
								  anchor(base_url().'horen_1_opsi/'.$soal->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn mini blue')).' | '.
								  anchor(base_url().'horen_1_opsi_del/'.$soal->id,'<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn mini red')));
		}
		$horen = $this->horen_1->get_data_by_id($id);
		$data['horen'] = $horen; 
		$this->template_backend->display('/back_end/horen_1/view', $data);
	}

	function ajax_view($id){
		$data['horen'] = $this->horen_1->get_data_by_id($id);
		$this->load->view('/back_end/horen_1/ajax_view', $data);
	}

	function delete($id){
		$this->horen_1->delete($id);
		redirect(base_url().'horen_1');
	}


	function ajax_header(){
		$data['title'] 		= "Horen"; 
		$data['subtitle'] 	= "Manage soal horen"; 
		$data['link']		= base_url().'horen_1'; 
		$data['link_label'] = 'Teil 1';

		$this->load->view('/back_end/ajax/header_crud', $data);
	}

	function add_opsi($horen_id){
		if(isset($_POST['submit'])){
			$text = $this->input->post('text');
			$value = $this->input->post('value');
			$hint = $this->input->post('hint');

			$data = array('text' => $text, 
						  'hint' => $hint, 
						  'value' => $value, 
						  'horen_id' => $horen_id);
			
			$opsi_id = $this->opsi_horen_1->insert($data);

			if(!empty($_FILES['image']['name'])){
				//do upload 
				$config['upload_path'] = './upload/images/'; 
				$config['allowed_types'] = 'jpg|png|gif'; 
				$config['max_size']		= '8000';
				$this->load->library('upload', $config); 

				$field_name = 'image';
				$PATH = 'upload/images/';

				if(!$this->upload->do_upload($field_name))
				{
					$data['errors'] = $this->upload->display_errors();
					$this->session->set_userdata($data);
					redirect(base_url().'horen_1_opsi/'.$opsi_id);
				}
				else
				{
					$data_upload = $this->upload->data();
					$data = array('image' => $PATH.''.$data_upload['file_name']);
					$this->opsi_horen_1->update($opsi_id, $data);	  					
				}
			}

			redirect(base_url().'horen_1_prev/'.$horen_id);

		}
		$data['horen'] = $this->horen_1->get_data_by_id($horen_id);
		$this->template_backend->display("/back_end/horen_1/opsi_add", $data);
	}

	function edit_opsi($opsi_id){
		$opsi = $this->opsi_horen_1->get_data_by_id($opsi_id);
		if(isset($_POST['submit'])){
			$text = $this->input->post('text');
			$hint = $this->input->post('hint');
			$value = $this->input->post('value');

			$data = array('text' => $text, 
						  'hint' => $hint, 
						  'value' => $value);
			$this->opsi_horen_1->update($opsi_id, $data);

			if(!empty($_FILES['image']['name'])){
				//do upload 
				$config['upload_path'] = './upload/images/'; 
				$config['allowed_types'] = 'jpg|png|gif'; 
				$config['max_size']		= '8000';
				$this->load->library('upload', $config);

				$field_name = 'image';
				$PATH = 'upload/images/';
				
				if(!$this->upload->do_upload($field_name))
				{
					$data['errors'] = $this->upload->display_errors();
					$this->session->set_userdata($data);
					redirect(base_url().'horen_1_opsi/'.$opsi_id);
				}
				else
				{
					$data_upload = $this->upload->data();
					$data = array('image' => $PATH.''.$data_upload['file_name']);
					$this->opsi_horen_1->update($opsi_id, $data);	  					
				} 
			}

			redirect(base_url().'horen_1_prev/'.$opsi->horen_id);
		}
		$data['opsi'] = $opsi;
		$this->template_backend->display('/back_end/horen_1/opsi_edit', $data);
	}

	function delete_opsi($opsi_id){
		$opsi = $this->opsi_horen_1->get_data_by_id($opsi_id);
		$this->opsi_horen_1->delete($opsi_id);

		redirect(base_url().'horen_1_prev/'.$opsi->horen_id);
	}

}