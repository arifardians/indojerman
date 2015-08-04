<?php

/**
* 
*/
class Lesen_3_controller extends MY_Controller
{
	private $limit; 
	
	function __construct()
	{
		parent::__construct('admin');
		$this->load->model('lesen_3');
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
		$soals = $this->lesen_3->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'Petunjuk', 'Statement', 'Value', 'Actions');

		$tmpl = array('table_open' => '<table class="table table-striped table-bordered table-hover">',
					  'table_close'=> '</table>');

		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination

		$this->load->library('pagination');
		$config['base_url'] =  base_url().'index.php/back_end/lesen_3_controller/index';
		$config['total_rows'] = $this->lesen_3->get_total_data();
		$config['per_page'] = $this->limit;
		$config['num_links'] = 20;
		$config['uri_segment'] = 2;
		// $config['use_page_numbers'] = true;

		$pagination = $this->pagination->initialize($config);

		$i = 0+$offset;
		foreach ($soals as $soal) {
			$cell_clue	= array('data'=> $soal->clue, 'width'=>'25%');
			$cell_statement = array('data'=> $soal->statement, 'width' => '30%');		
			$cell_value = $soal->value == 1? 'Richtig' : 'Falsch';
			$this->table->add_row(++$i,
								  $cell_clue,
								  $cell_statement,
								  $cell_value,
								  anchor(base_url()."lesen_3_prev/".$soal->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn mini yellow')).' | '.
								  anchor(base_url().'lesen_3/'.$soal->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn mini blue')).' | '.
								  anchor(base_url().'lesen_3_del/'.$soal->id, '<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn mini red')));
		}

		$this->template_backend->display('/back_end/lesen_3/index');
	}

	function add(){
		if(isset($_POST['submit'])){
			$clue 	 	= $this->input->post('clue');
			$statement  = $this->input->post('statement');
			$value		= $this->input->post('value');

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
					redirect(base_url().'lesen_3_add/');
				}
				else
				{
					$data_upload = $this->upload->data();
					$data = array('clue' => $clue,
						  'image' => 'upload/images/'.$data_upload['file_name'],
						  'statement' => $statement,
						  'value' => $value);
					$this->lesen_3->insert($data);	  					
				}
				
			}
			else
			{
				$data = array('clue' => $clue,
							  'statement' => $statement , 
							  'value' => $value);
				$this->lesen_3->insert($data);
			}
			redirect(base_url().'lesen_3/');
		}

		$this->template_backend->display('/back_end/lesen_3/add');
	}

	function edit($id){
		if(isset($_POST['submit'])){
			$clue 		= $this->input->post('clue');
			$statement 	= $this->input->post('statement');
			$value 		= $this->input->post('value');

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
					redirect(base_url().'lesen_3_edit/'.$id);
				}
				else
				{
					$data_upload = $this->upload->data();
					$data = array('clue' => $clue,
						  'image' => 'upload/images/'.$data_upload['file_name'],
						  'statement' => $statement,
						  'value' => $value);
					$this->lesen_3->update($id, $data);	  					
				}
				
			}
			else
			{
				$data = array('clue' => $clue,
							  'statement' => $statement , 
							  'value' => $value);
				$this->lesen_3->update($id, $data);
			}
			redirect(base_url().'lesen_3/');
		}
		$data['lesen'] = $this->lesen_3->get_data_by_id($id);
		$this->template_backend->display('/back_end/lesen_3/edit', $data);
	}

	function view($id){
		$data['lesen'] = $this->lesen_3->get_data_by_id($id);
		$this->template_backend->display('/back_end/lesen_3/view', $data);
	}

	function delete($id){
		$this->lesen_3->delete($id);
		redirect(base_url().'lesen_3/');
	}

	function ajax_header(){
		$data['title'] 		= "Lesen"; 
		$data['subtitle'] 	= "Manage soal bacaan"; 
		$data['link']		= base_url().'lesen_3'; 
		$data['link_label'] = 'Teil 3';

		$this->load->view('/back_end/ajax/header_crud', $data);
	}

}