<?php
 /**
 * 
 */
 class Test_frontend extends CI_Controller
 {
 	
 	function index()
 	{
 		$this->template_frontend->display('/front_end/pages/index');
 	}


 	function test()
 	{
 		$this->template_frontend->display('/front_end/pages/test');
 	}
 }
