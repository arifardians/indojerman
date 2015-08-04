<?php


/**
* 
*/
class Access
{
	private $user; 

	function __construct()
	{
		$this->CI = &get_instance();
		$auth = $this->CI->config->item('auth');

		$this->CI->load->helper('cookie');
		$this->CI->load->model('user');
		$this->user = $this->CI->user;
	}

	/**
	 * Cek login user 
	 * @param username from login form 
	 * @param password from login form
	 * @return boolean : true if success, false otherwise
	 */
	
	function login($email, $password)
	{
		$result = $this->user->get_login_info($email);
		if($result){
			$password = md5($password); 
			if($password === $result->password){
				// Start session 
				$data = array('email' => $result->email, 
							  'user_group'=> $result->user_group, 
							  'is_logged_in'=> TRUE);
				$this->CI->session->set_userdata($data);
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * cek apakah sudah login 
	 * @return boolean : true if login, false otherwise
	 * 
	 */

	function is_login()
	{
		return (($this->CI->session->userdata('email')) ? TRUE : FALSE);
	}

	/**
	 * Logout  
	 */

	function logout()
	{
		$data = array('email' =>'', 
					  'user_group'=>'', 
					  'is_logged_in'=>'');
		$this->CI->session->unset_userdata($data);
	}
}