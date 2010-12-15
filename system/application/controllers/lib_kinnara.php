<?php

class Lib_kinnara extends Controller {

	function Lib_kinnara()
	{
		parent::Controller();	
	}
	
	function index()
	{
	$this->system_view->error_report("Sorry you can't access this page directly");
	$this->system_view->error_logging("User Access forbiden Controller, lib_kinnara/index");
	}
	
	function register(){
	$username = $this->input->post('username');
	$name = $this->input->post('name');
	$password = $this->input->post('password');
	$confirm_password = $this->input->post('confirm_password');
	$this->system_user->add_user($name,$username,$password,$confirm_password);
	}
		
}
