<?php 

/**
* 
*/
class Berita_controller extends MY_Controller
{
	private $limit;
	function __construct()
	{
		parent::__construct('admin');
		$this->load->model('berita');
	}

	function index($offset=0, $order_column='id', $order_type='asc'){
		if(empty($offset))
			$offset = 0;
		if(empty($order_column))
			$order_column = 'id';
		if(empty($order_type))
			$order_type = 'asc';

		// load data soal struktur
		$beritas = $this->berita->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'judul', 'deskripsi', 'Actions');

		$tmpl = array('table_open' => '<table class="table table-striped table-bordered table-hover">',
					  'table_close'=> '</table>');

		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination

		$this->load->library('pagination');
		$config['base_url'] =  base_url().'index.php/back_end/berita_controller/index';
		$config['total_rows'] = $this->berita->get_total_data();
		$config['per_page'] = $this->limit;
		$config['num_links'] = 20;
		$config['uri_segment'] = 2;
		// $config['use_page_numbers'] = true;

		$pagination = $this->pagination->initialize($config);

		$i = 0+$offset;
		foreach ($beritas as $berita) {
			$cell_judul 	 	    = array('data'=> $berita->judul, 'max-width'=>'20%');
			$cell_isi   			= array('data'=> $berita->isi, 'max-width' => '40%');
			$this->table->add_row(++$i,
								  $cell_judul,
								  $cell_isi,
								  anchor(base_url()."berita_prev/".$berita->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn yellow')).' | '.
								  anchor(base_url().'berita/'.$berita->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn blue')).' | '.
								  anchor('/back_end/berita_controller/delete/'.$berita->id, '<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn red')));
		}

		$this->template_backend->display('/back_end/berita/index');
	}

	function add()
	{
		if(isset($_POST['submit'])){
			$judul 	= $this->input->post('judul');
			$isi 	= $this->input->post('isi');
			$data = array('judul' => $judul, 'isi' => $isi );
			$id_berita = $this->berita->insert($data);

			redirect(base_url().'berita');
		}
		$this->template_backend->display('/back_end/berita/add');
	}

	function view($id = null)
	{
		$data['berita'] = $this->berita->get_data_by_id($id);
		$this->template_backend->display('/back_end/berita/view', $data);
	}

	function edit($id = null)
	{
		if(isset($_POST['submit'])){
			$judul 	= $this->input->post('judul');
			$isi 	= $this->input->post('isi');
			$data 	= array('judul' => $judul, 'isi' => $isi);
			$this->berita->update($id, $data);

			redirect(base_url().'berita');
		}
		$data['berita'] = $this->berita->get_data_by_id($id);
		$this->template_backend->display('/back_end/berita/edit', $data);
	}

	function delete($id = null)
	{
		$this->berita->delete($id);
		redirect(base_url().'berita');
	}

}