<?php 

/**
* 
*/
class Usergroup_controller extends MY_Controller
{
	private $limit;
	function __construct()
	{
		parent::__construct('admin');
		$this->load->model('user_group');
	}


	function index($offset=0, $order_column='id', $order_type='asc'){
		if(empty($offset))
			$offset = 0;
		if(empty($order_column))
			$order_column = 'id';
		if(empty($order_type))
			$order_type = 'asc';

		// load data soal struktur
		$groups = $this->user_group->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'Nama', 'Keterangan', 'Actions');

		$tmpl = array('table_open' => '<table class="table table-striped table-bordered table-hover table-full-width">',
					  'table_close'=> '</table>');

		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination

		$this->load->library('pagination');
		$config['base_url'] =  base_url().'index.php/back_end/usergroup_controller/index';
		$config['total_rows'] = $this->user_group->get_total_data();
		$config['per_page'] = $this->limit;
		$config['num_links'] = 20;
		$config['uri_segment'] = 2;
		// $config['use_page_numbers'] = true;

		$pagination = $this->pagination->initialize($config);

		$i = 0+$offset;
		foreach ($groups as $group) {
			$cell_nama 	 	   = array('data'=> $group->nama, 'width'=>'20%');
			$cell_keterangan   = array('data'=> $group->keterangan, 'width' => '45%');
			$this->table->add_row(++$i,
								  $cell_nama,
								  $cell_keterangan,
								  anchor(base_url()."user_group_prev/".$group->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn yellow')).' | '.
								  anchor(base_url().'user_group/'.$group->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn blue')).' | '.
								  anchor('/back_end/usergroup_controller/delete/'.$group->id, '<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn red')));
		}

		$this->template_backend->display('/back_end/user_group/index');
	}

	function add(){
		if(isset($_POST['submit']))
		{
			$nama = $this->input->post('nama');
			$keterangan = $this->input->post('keterangan');
			$data = array('nama' => $nama, 'keterangan'=> $keterangan);
			$this->user_group->insert($data); 
			redirect(base_url().'user_group');
		}
		$this->template_backend->display('/back_end/user_group/add');
	}

	function view($id = null){
		$data['user_group'] = $this->user_group->get_data_by_id($id);
		$this->template_backend->display('/back_end/user_group/view', $data);
	}

	function edit($id = null){
		if(isset($_POST['submit'])){
			$nama = $this->input->post('nama');
			$keterangan = $this->input->post('keterangan');
			$data = array('nama' => $nama, 'keterangan'=> $keterangan);
			$this->user_group->update($id, $data); 
			redirect(base_url().'user_group');
		}
		$data['user_group'] = $this->user_group->get_data_by_id($id);
		$this->template_backend->display('/back_end/user_group/edit', $data);

	}

	function delete($id = null){
		$this->user_group->delete($id);
		redirect(base_url().'user_group');
	}	

}