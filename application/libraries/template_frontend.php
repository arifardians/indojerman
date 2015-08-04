<?php 

class Template_frontend {
	protected $_ci;
	function __construct(){
		$this->_ci = &get_instance();
	}

	function display($template, $data=null){
		$data['_content'] = $this->_ci->load->view($template, $data, true);
		$data['_header'] = $this->_ci->load->view('/front_end/template/header', $data, true);
		$data['_footer'] = $this->_ci->load->view('/front_end/template/footer', $data, true);
		$this->_ci->load->view('/front_end/template/template.php', $data);
	}
}