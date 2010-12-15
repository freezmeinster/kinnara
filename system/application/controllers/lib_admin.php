<?php

class Lib_admin	 extends Controller {

	function Lib_admin()
	{
		parent::Controller();	
	}
	
	function index()
	{
	$this->system_view->error_report("Sorry you can't access this page directly");
	$this->system_view->error_logging("User Access forbiden Controller, lib_admin/index");
	}
	
	function set_static_view(){
	$title = $this->input->post('title');
	$content = $this->input->post('content');
	$this->system_view->set_static_view($title,$content);
	}
}
?>