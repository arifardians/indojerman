<?php 


/**
* 
*/
class User_controller extends MY_Controller
{
	private $limit;
	function __construct()
	{
		parent::__construct('admin');
		$this->load->model('user_group'); 
		$this->load->model('user');
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
		$users = $this->user->get_paged_list($this->limit, $offset, $order_column, $order_type)->result();

		// generate table
		$this->load->library('table');
		$this->table->set_heading('No', 'Full Name', 'Email', 'Group', 'Actions');

		$tmpl = array('table_open' => '<table class="table table-striped table-bordered table-hover table-full-width">',
					  'table_close'=> '</table>');

		$this->table->set_template($tmpl);
		$this->table->set_empty('&nbsp;');

		// generate pagination

		$this->load->library('pagination');
		$config['base_url'] =  base_url().'index.php/back_end/user_controller/index';
		$config['total_rows'] = $this->user->get_total_data();
		$config['per_page'] = $this->limit;
		$config['num_links'] = 20;
		$config['uri_segment'] = 2;
		// $config['use_page_numbers'] = true;

		$pagination = $this->pagination->initialize($config);

		$i = 0+$offset;
		foreach ($users as $user) {
			$cell_username 	 	    = array('data'=> $user->first_name .' '. $user->last_name, 'max-width'=>'20%');
			$cell_email   			= array('data'=> $user->email, 'max-width' => '20%');
			// $cell_address			= array('data'=> $user->address, 'max-width' => '20%');
			$usergroup 				= $this->user_group->get_data_by_id($user->user_group);
			$cell_group				= array('data'=> $usergroup->nama);
			$this->table->add_row(++$i,
								  $cell_username,
								  $cell_email,
								  // $cell_address,
								  $cell_group,
								  anchor(base_url()."user_prev/".$user->id, '<span> <i class="fa fa-eye"></i> </span> View', array('class'=> 'btn yellow')).' | '.
								  anchor(base_url().'user/'.$user->id, '<span> <i class="fa fa-edit"></i> </span> Edit', array('class'=>'btn blue')).' | '.
								  anchor('/back_end/user_controller/delete/'.$user->id, '<span> <i class="fa fa-trash"></i> </span> Delete', array('class'=>'btn red')));
		}

		$this->template_backend->display('/back_end/user/index');
	}

	function add(){
		if(isset($_POST['submit'])){
			$username 	= $this->input->post('username'); 
			$email    	= $this->input->post('email');
			$password 	= $this->input->post('password');
			$user_group = $this->input->post('user_group');
			$data = array('username' => $username, 'email'=> $email, 
						  'password'=> md5($password), 'user_group'=>$user_group);
			$this->user->insert($data);
			redirect('/back_end/user_controller/');
		}
		$data['groups'] = $this->user_group->get_all_data();
		$this->template_backend->display('/back_end/user/add', $data);
	}

	function view($id = null)
	{
		$data['user'] 	= $this->user->get_data_by_id($id); 
		$data['groups'] = $this->user_group->get_all_data();
		$this->template_backend->display('/back_end/user/view', $data);
	}

	function edit($id = null){
	
		if(isset($_POST['submit']))
		{
			$username   = $this->input->post('username');
			$email 	    = $this->input->post('email');
			$user_group = $this->input->post('user_group');
			$data = array('username' => $username, 'email' => $this->input->post('email'), 'user_group' => $user_group);
			$this->user->update($id, $data);
			redirect('/back_end/user_controller/');
		}
		$data['user'] 	= $this->user->get_data_by_id($id); 
		$data['groups'] = $this->user_group->get_all_data();
		$this->template_backend->display('/back_end/user/edit', $data);

	}

	function delete($id = null)
	{
		$this->user->delete($id);
		redirect(base_url().'user');
	}


}