<?php 


/**
* 
*/
class Tutorial_controller extends MY_Controller
{
	private $limit = 10;
	function __construct()
	{
		parent::__construct('admin');
		$this->load->model('kategori');
		$this->load->model('tutorial'); 
	}

	function index($offset=0, $order_column='id', $order_type='asc'){
		if(empty($offset))
			$offset = 0;
		if(empty($order_column))
			$order_column = 'id';
		if(empty($order_type))
			$order_type = 'asc';

		// load data soal struktur
		$tutorials = $this->tutorial->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'Judul', 'Kategori', 'Actions');

		$tmpl = array('table_open' => '<table class="table table-striped table-bordered table-hover table-full-width">',
					  'table_close'=> '</table>');

		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination

		$this->load->library('pagination');
		$config['base_url'] =  base_url().'index.php/back_end/tutorial_controller/index';
		$config['total_rows'] = $this->tutorial->get_total_data();
		$config['per_page'] = $this->limit;
		$config['num_links'] = 20;
		$config['uri_segment'] = 2;
		// $config['use_page_numbers'] = true;

		$pagination = $this->pagination->initialize($config);

		$i = 0+$offset;
		foreach ($tutorials as $tutorial) {
			$kategori = $this->kategori->get_data_by_id($tutorial->id_kategori);
			$cell_judul 	 = array('data'=> $tutorial->judul, 'width'=>'35%');
			$cell_kategori   = array('data'=> $kategori->nama, 'width' => '20%');
			$this->table->add_row(++$i,
								  $cell_judul,
								  $cell_kategori,
								  anchor(base_url()."tutorial_prev/".$tutorial->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn yellow')).' | '.
								  anchor(base_url().'tutorial/'.$tutorial->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn blue')).' | '.
								  anchor('/back_end/tutorial_controller/delete/'.$tutorial->id, '<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn red')));
		}

		$this->template_backend->display('/back_end/tutorial/index');
	}

	function add(){
		if(isset($_POST['submit']))	{
			$judul 		= $this->input->post('judul');
			$materi 	= $this->input->post('materi');
			$kategori 	= $this->input->post('kategori');
			$deskripsi  = $this->input->post('deskripsi');

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
					redirect(base_url().'tutorial_add');
				}
				else
				{
					$data_upload = $this->upload->data();
					$data = array('judul' => $judul,
						  'deskripsi' => $deskripsi,
						  'image' => 'upload/images/'.$data_upload['file_name'],
						  'materi'=> $materi, 
						  'id_kategori'=> $kategori);
					$this->tutorial->insert($data);	  					
				}
				
			}
			else
			{
				$data = array('judul' => $judul,
							  'deskripsi' => $deskripsi, 
							  'materi'=> $materi, 
							  'id_kategori'=> $kategori);
				$this->tutorial->insert($data);
			}


			redirect(base_url().'tutorial');
		}
		$data['kategories'] = $this->kategori->get_all_data();
		$this->template_backend->display('/back_end/tutorial/add', $data);
	}

	function view($id = 0)
	{
		$data['kategories'] = $this->kategori->get_all_data();
		$data['tutorial']   = $this->tutorial->get_data_by_id($id);
		$this->template_backend->display('/back_end/tutorial/view', $data);
	}

	function edit($id = 0)
	{
		if(isset($_POST['submit'])){
			$judul 		= $this->input->post('judul');
			$materi 	= $this->input->post('materi');
			$kategori 	= $this->input->post('kategori');
			$deskripsi	= $this->input->post('deskripsi');

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
					redirect(base_url().'tutorial/'.$id);
				}
				else
				{
					$data_upload = $this->upload->data();
					$data = array('judul' => $judul,
						  'deskripsi' => $deskripsi,
						  'image' => 'upload/images/'.$data_upload['file_name'],
						  'materi'=> $materi, 
						  'id_kategori'=> $kategori);
					$this->tutorial->update($id,$data);	  					
				}
				
			}
			else
			{
				$data = array('judul' => $judul , 
							  'materi' => $materi,
							  'deskripsi' => $deskripsi, 
							  'id_kategori' => $kategori);
			}

			$this->tutorial->update($id, $data);
			redirect(base_url().'tutorial');	
		}
		$data['kategories'] = $this->kategori->get_all_data();
		$data['tutorial']   = $this->tutorial->get_data_by_id($id);
		$this->template_backend->display('/back_end/tutorial/edit', $data);

	}

	function delete($id = 0){
		$this->tutorial->delete($id);
		redirect(base_url().'tutorial');	
	}

}