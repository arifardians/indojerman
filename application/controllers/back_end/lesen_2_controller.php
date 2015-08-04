<?php

/**
* 
*/
class Lesen_2_controller extends CI_Controller
{
	private $limit;
	function __construct()
	{
		parent::__construct('admin');
		$this->load->model('lesen_2');
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
		$soals = $this->lesen_2->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'Pertanyaan', 'Penjelasan', 'Actions');

		$tmpl = array('table_open' => '<table class="table table-striped table-bordered table-hover">',
					  'table_close'=> '</table>');

		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination

		$this->load->library('pagination');
		$config['base_url'] =  base_url().'index.php/back_end/lesen_2_controller/index';
		$config['total_rows'] = $this->lesen_2->get_total_data();
		$config['per_page'] = $this->limit;
		$config['num_links'] = 20;
		$config['uri_segment'] = 2;
		// $config['use_page_numbers'] = true;

		$pagination = $this->pagination->initialize($config);

		$i = 0+$offset;
		foreach ($soals as $soal) {
			$cell_question	= array('data'=> $soal->question, 'width'=>'25%');
			$explanation  	= strlen($soal->explanation) > 100 ? substr($soal->text, 0, 100).'...' : $soal->explanation;
			$cell_expl 	= array('data'=> $explanation, 'width' => '30%');		
		
			$this->table->add_row(++$i,
								  $cell_question,
								  $cell_expl,
								  anchor(base_url()."lesen_2_prev/".$soal->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn mini yellow')).' | '.
								  anchor(base_url().'lesen_2/'.$soal->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn mini blue')).' | '.
								  anchor(base_url().'lesen_2_del/'.$soal->id, '<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn mini red')));
		}

		$this->template_backend->display('/back_end/lesen_2/index');
	}

	function add(){
		if (isset($_POST['submit'])) {
			$question 	  = $this->input->post('question');
			$explanation  = $this->input->post('explanation');
			$data = array('question' => $question, 'explanation' => $explanation);
			$this->lesen_2->insert($data); 
			redirect(base_url().'lesen_2');
		}
		$this->template_backend->display('/back_end/lesen_2/add');
	}

	function edit($id){
		if(isset($_POST['submit'])){
			$question    = $this->input->post('question');
			$explanation = $this->input->post('explanation');
			$data = array('question' => $question, 'explanation' => $explanation);
			$this->lesen_2->update($id, $data);
			redirect(base_url().'lesen_2');
		}
		$data['lesen'] = $this->lesen_2->get_data_by_id($id);
		$this->template_backend->display('/back_end/lesen_2/edit', $data);

	}

	function view($id){
		$this->load->model('opsi_lesen_2');

		$this->load->library('table');
		$this->table->set_heading('No', 'Statement', 'Image', 'Value', 'Actions');

		$tmpl = array('table_open'  => '<table class="table table-striped table-bordered table-hover table-full-width">',
					  'table_close' => '</table>');
		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] 	= base_url().'index.php/back_end/lesen_1_controller/view/'.$id;
		$config['total_rows'] 	= 5; // max total statements each lesen
		$config['per_page'] 	= 10;
		$config['num_links'] 	= 20;
		$config['uri_segment'] 	= 2;

		$pagination = $this->pagination->initialize($config);
		$options = $this->opsi_lesen_2->get_data_by_lesen_id($id);

		$i =0;
		foreach ($options as $option) {
			$cell_statment = array('data' => $option->statement, 'width'=>'30%');
			$cell_value  = array('data'=> $option->value == 1 ? 'Richtig' : 'Falsch', 'width'=> '20%');
			$cell_image = array('data' => '<img src="'.base_url().''.$option->image.'" width="200px"/>', 'width' => '25%');
			$this->table->add_row(++$i,
								  $cell_statment,
								  $cell_image,
								  $cell_value,
								  anchor(base_url().'lesen_2_opsi/'.$option->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn mini blue')).' | '.
								  anchor(base_url().'lesen_2_opsi_del/'.$option->id,'<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn mini red')));
		}

		$data['lesen'] = $this->lesen_2->get_data_by_id($id); 
		$this->template_backend->display('/back_end/lesen_2/view', $data);
	}


	function delete($id){
		$this->lesen_2->delete($id); 
		redirect(base_url().'lesen_2');
	}

	function ajax_header(){
		$data['title'] 		= "Lesen"; 
		$data['subtitle'] 	= "Manage soal bacaan"; 
		$data['link']		= base_url().'lesen_2'; 
		$data['link_label'] = 'Teil 2';

		$this->load->view('/back_end/ajax/header_crud', $data);
	}

	function ajax_view_lesen_2($id){
		$data['lesen'] = $this->lesen_2->get_data_by_id($id); 
		$this->load->view('/back_end/lesen_2/ajax_view', $data);
	}

	function add_opsi($lesen_id){
		$this->load->model('opsi_lesen_2');
		if(isset($_POST['submit'])){
			$statement = $this->input->post('statement');
			$text 	   = $this->input->post('text');
			$value 	   = $this->input->post('value');

			if(!empty($_FILES['image']['name'])){
				//do upload 
				$config['upload_path'] = './upload/images/'; 
				$config['allowed_types'] = 'jpg|png|gif'; 
				$config['max_size']		= '8000';
				$this->load->library('upload', $config); 

				$field_name = 'image';
				
				if(!$this->upload->do_upload($field_name))
				{
					$data['errors'] = $this->upload->display_errors();
					$this->session->set_userdata($data);
					redirect(base_url().'lesen_2_opsi_add/'.$id);
				}
				else
				{
					$data_upload = $this->upload->data();
					$data = array('statement' => $statement,
						  'text' => $text,
						  'image' => 'upload/images/'.$data_upload['file_name'],
						  'value' => $value, 
						  'lesen_2_id' => $lesen_id);
					$this->opsi_lesen_2->insert($data);	  					
				}
				
			}
			else
			{
				$data = array('statement' => $statement , 
							  'text' => $text,
							  'value' => $value, 
							  'lesen_2_id' => $lesen_id);
				$this->opsi_lesen_2->insert($data);
			}
			redirect(base_url().'lesen_2_prev/'.$lesen_id);
		}

		$data['lesen'] = $this->lesen_2->get_data_by_id($lesen_id);
		$this->template_backend->display('/back_end/lesen_2/opsi_add', $data);
	}

	function edit_opsi($opsi_id){
		$this->load->model('opsi_lesen_2');
		$opsi = $this->opsi_lesen_2->get_data_by_id($opsi_id);

		if(isset($_POST['submit'])){
			$statement = $this->input->post('statement');
			$text	   = $this->input->post('text');
			$value 	   = $this->input->post('value'); 

			if(!empty($_FILES['image']['name'])){
				//do upload 
				$config['upload_path'] = './upload/images/'; 
				$config['allowed_types'] = 'jpg|png|gif'; 
				$config['max_size']		= '8000';
				$this->load->library('upload', $config); 

				$field_name = 'image';
				
				if(!$this->upload->do_upload($field_name))
				{
					$data['errors'] = $this->upload->display_errors();
					$this->session->set_userdata($data);
					redirect(base_url().'lesen_2_opsi_add/'.$opsi->id);
				}
				else
				{
					$data_upload = $this->upload->data();
					$data = array('statement' => $statement,
						  'text' => $text,
						  'image' => 'upload/images/'.$data_upload['file_name'],
						  'value' => $value);
					$this->opsi_lesen_2->update($opsi_id, $data);	  					
				}
				
			}
			else
			{
				$data = array('statement' => $statement , 
							  'text' => $text,
							  'value' => $value);
				$this->opsi_lesen_2->update($opsi_id, $data);
			}
			redirect(base_url().'lesen_2_prev/'.$opsi->lesen_2_id);
		}

		$data['opsi'] = $opsi;
		$this->template_backend->display('/back_end/lesen_2/opsi_edit', $data);
	}
	

	function delete_opsi($opsi_id){
		$this->load->model('opsi_lesen_2');
		$opsi = $this->opsi_lesen_2->get_data_by_id($opsi_id);
		$this->opsi_lesen_2->delete($opsi_id);
		redirect(base_url().'lesen_2_prev/'.$opsi->lesen_2_id);
	}

}