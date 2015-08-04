<?php 

/**
* 
*/
class Lesen_1_controller extends MY_Controller
{
	private $limit;
	function __construct()
	{
		parent::__construct('admin');
		$this->load->model('lesen_1');
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
		$soals = $this->lesen_1->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'judul', 'text', 'image', 'Actions');

		$tmpl = array('table_open' => '<table class="table table-striped table-bordered table-hover">',
					  'table_close'=> '</table>');

		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination

		$this->load->library('pagination');
		$config['base_url'] =  base_url().'index.php/back_end/schreiben_1_controller/index';
		$config['total_rows'] = $this->lesen_1->get_total_data();
		$config['per_page'] = $this->limit;
		$config['num_links'] = 20;
		$config['uri_segment'] = 2;
		// $config['use_page_numbers'] = true;

		$pagination = $this->pagination->initialize($config);

		$i = 0+$offset;
		foreach ($soals as $soal) {
			$cell_judul	= array('data'=> $soal->title, 'width'=>'20%');
			$text  = strlen($soal->text) > 100 ? substr($soal->text, 0, 100).'...' : $soal->text;
			$cell_text 	= array('data'=> $text, 'width' => '25%');		
			$cell_isi   = array('data'=> '<img src="'.base_url().''.$soal->image.'" width="250px" height="250px"/>', 'max-width' => '40%');
			
			$this->table->add_row(++$i,
								  $cell_judul,
								  $cell_text,
								  $cell_isi,
								  anchor(base_url()."lesen_1_prev/".$soal->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn mini yellow')).' | '.
								  anchor(base_url().'lesen_1/'.$soal->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn mini blue')).' | '.
								  anchor(base_url().'lesen_1_del/'.$soal->id, '<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn mini red')));
		}

		$this->template_backend->display('/back_end/lesen_1/index');
		
	}

	function add(){
		if(isset($_POST['submit'])){
			$title = $this->input->post('title');
			$text  = $this->input->post('text');
			
			$date = new DateTime(); 
			$lesen_id = 0;

			if(!empty($_FILES['image']['name'])){
				$config['upload_path'] = './upload/images/'; 
				$config['allowed_types'] = 'jpg|png|gif'; 
				$config['max_size']		= '8000';
				$this->load->library('upload', $config); 

				$field_name = 'image';
				
				if(!$this->upload->do_upload($field_name))
				{
					$data['errors'] = $this->upload->display_errors();
					$this->session->set_userdata($data);
					redirect(base_url().'lesen_1_add');
				}
				else
				{
					$data_upload = $this->upload->data();
					$data = array('title' => $title,
						  'text' => $text,
						  'image' => 'upload/images/'.$data_upload['file_name'], 
						  'created_at' => $date->format('Y-m-d H:i:s'),
						  'updated_at' => $date->format('Y-m-d H:i:s'));
					$lesen_id = $this->lesen_1->insert($data);	  					
				}
			}
			else
			{
				$data = array('title' => $title, 
							  'text' => $text, 
							  'created_at' => $date->format('Y-m-d H:i:s'),
							  'updated_at' => $date->format('Y-m-d H:i:s'));
				$lesen_id = $this->lesen_1->insert($data);
			}
			redirect(base_url().'lesen_1_prev/'.$lesen_id);
		}

		$this->template_backend->display('back_end/lesen_1/add');
	}
	

	function edit($id){
		if(isset($_POST['submit'])){
			$title 		= $this->input->post('title');
			$text 		= $this->input->post('text');

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
					redirect(base_url().'lesen_1/'.$id);
				}
				else
				{
					$data_upload = $this->upload->data();
					$data = array('title' => $title,
						  'text' => $text,
						  'image' => 'upload/images/'.$data_upload['file_name'],
						  'created_at'=> $created_at, 
						  'updated_at'=> $updated_at);
					$this->lesen_1->update($id,$data);	  					
				}
				
			}
			else
			{
				$data = array('title' => $title , 
							  'text' => $text,
							  'created_at' => $created_at, 
							  'updated_at' => $updated_at);
			}

			$this->lesen_1->update($id, $data);
			redirect(base_url().'lesen_1_prev/'.$id);	
		}
		$data['lesen'] = $this->lesen_1->get_data_by_id($id);
		$this->template_backend->display('/back_end/lesen_1/edit', $data);
	}

	function view($id){
		$this->load->model('statement_lesen_1');

		$this->load->library('table');
		$this->table->set_heading('No', 'Statement', 'Value', 'Actions');

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
		$soals = $this->statement_lesen_1->get_data_by_lesen_id($id);

		$i =0;
		foreach ($soals as $soal) {
			$cell_statment = array('data' => $soal->statement, 'width'=>'30%');
			$cell_value  = array('data'=> $soal->value == 1 ? 'Richtig' : 'Falsch', 'width'=> '30%');
			$this->table->add_row(++$i,
								  $cell_statment,
								  $cell_value,
								  anchor(base_url().'lesen_1_soal/'.$soal->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn mini blue')).' | '.
								  anchor(base_url().'lesen_1_soal_del/'.$soal->id,'<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn mini red')));
		}

		$data['lesen'] = $this->lesen_1->get_data_by_id($id); 
		$this->template_backend->display('/back_end/lesen_1/view', $data);
	}

	function ajax_view_lesen_1($id){
		$data['lesen'] = $this->lesen_1->get_data_by_id($id); 
		$this->load->view('/back_end/lesen_1/ajax_view', $data);
	}

	function ajax_header(){
		$data['title'] 		= "Lesen"; 
		$data['subtitle'] 	= "Manage soal bacaan"; 
		$data['link']		= base_url().'lesen_1'; 
		$data['link_label'] = 'Teil 1';

		$this->load->view('/back_end/ajax/header_crud', $data);
	}

	function delete($id){
		$this->lesen_1->delete($id); 
		redirect(base_url().'lesen_1');
	}
	
	function add_soal($lesen_id){
		if(isset($_POST['submit'])){
			$this->load->model('statement_lesen_1');
			$statement = $this->input->post('statement');
			$answer    = $this->input->post('answer');

			$date = new DateTime();
			$data = array('statement' => $statement, 'value' => $answer, 'lesen_1_id' => $lesen_id);

			$this->statement_lesen_1->insert($data);
			redirect(base_url().'lesen_1_prev/'.$lesen_id);
		}
		$data['lesen'] = $this->lesen_1->get_data_by_id($lesen_id);
		$this->template_backend->display('back_end/lesen_1/add_soal', $data);
	}

	function edit_soal($soal_id){
		$this->load->model('statement_lesen_1');
		$soal = $this->statement_lesen_1->get_data_by_id($soal_id);
		if(isset($_POST['submit'])){
			$statement = $this->input->post('statement');
			$answer    = $this->input->post('answer');

			$date = new DateTime();
			$data = array('statement' => $statement, 'value' => $answer);

			$this->statement_lesen_1->update($soal_id, $data);
			redirect(base_url().'lesen_1_prev/'.$soal->lesen_1_id);
		}

		$data['statement'] = $soal;
		$this->template_backend->display('back_end/lesen_1/edit_soal', $data);
	}

	function delete_soal($soal_id){
		$this->load->model('statement_lesen_1');
		$soal = $this->statement_lesen_1->get_data_by_id($soal_id);
		$this->statement_lesen_1->delete($soal_id);
		redirect(base_url().'lesen_1_prev/'.$soal->lesen_1_id);
	}
	
}