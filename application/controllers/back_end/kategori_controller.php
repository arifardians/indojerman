<?php


/**
* 
*/
class Kategori_controller extends MY_Controller
{
	private $limit;

	function __construct()
	{
		parent::__construct('admin');
		$this->limit = 10;
		$this->load->model('kategori');
	}

	
	function index($offset=0, $order_column='id', $order_type='asc'){
		if(empty($offset))
			$offset = 0;
		if(empty($order_column))
			$order_column = 'id';
		if(empty($order_type))
			$order_type = 'asc';

		// load data soal struktur
		$kategories = $this->kategori->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'Soal', 'Keterangan', 'Actions');

		$tmpl = array('table_open' => '<table class="table table-striped table-bordered table-hover table-full-width">',
					  'table_close'=> '</table>');

		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination

		$this->load->library('pagination');
		$config['base_url'] =  base_url().'index.php/back_end/soalstructure_controller/index';
		$config['total_rows'] = $this->kategori->get_total_data();
		$config['per_page'] = $this->limit;
		$config['num_links'] = 20;
		$config['uri_segment'] = 2;
		// $config['use_page_numbers'] = true;

		$pagination = $this->pagination->initialize($config);

		$i = 0+$offset;
		foreach ($kategories as $kategori) {
			$cell_nama 		 = array('data'=> $kategori->nama, 'width'=>'25%');
			$cell_keterangan = array('data'=> $kategori->keterangan, 'width' => '30%');
			$this->table->add_row(++$i,
								  $cell_nama,
								  $cell_keterangan,
								  anchor(base_url()."kategori_prev/".$kategori->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn yellow')).' | '.
								  anchor(base_url().'kategori/'.$kategori->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn blue')).' | '.
								  anchor('/back_end/kategori_controller/delete/'.$kategori->id, '<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn red')));
		}

		$this->template_backend->display('/back_end/kategori/index');
	}

	function add(){
		if(isset($_POST['submit'])){
			$nama 		= $this->input->post('nama');
			$keterangan = $this->input->post('keterangan');
			$data = array('nama' => $nama, 'keterangan'=> $keterangan);
			$this->kategori->insert($data);
			redirect(base_url().'kategori');
		}
		$this->template_backend->display('/back_end/kategori/add');
	}



	function view($id = 0){
		$data['kategori'] = $this->kategori->get_data_by_id($id);
		$this->template_backend->display('/back_end/kategori/view', $data);
	}

	function edit($id = 0){
		if(isset($_POST['submit'])){
			$nama 		= $this->input->post('nama');
			$keterangan = $this->input->post('keterangan');
			$data = array('nama' => $nama, 'keterangan'=> $keterangan);
			$this->kategori->update($id,$data);
			redirect(base_url().'kategori'); 
		}
		$data['kategori'] = $this->kategori->get_data_by_id($id);
		$this->template_backend->display('/back_end/kategori/edit', $data);
	}

	function delete($id = 0)
	{
		$this->kategori->delete($id);
		redirect(base_url().'kategori');
	}

}