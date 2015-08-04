<?php 

class Template_login {
	protected $_ci;
	function __construct(){
		$this->_ci = &get_instance();
	}

	function display($template, $data=null){
		$data['_content'] = $this->_ci->load->view($template, $data, true);
		$this->_ci->load->view('/login/template/template.php', $data);
	}
}