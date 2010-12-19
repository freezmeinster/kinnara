<?php

class Kinnara extends Controller {

	function Kinnara()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$data['static'] = "index"; 
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('body',$data);
		$this->load->view('footer');;
	}
	
	function login()
	{
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('login');
		$this->load->view('footer');
	}
	
	
	function register()
	{
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('register');
		$this->load->view('footer');
	}
	
        function upload()
	{
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('upload');
		$this->load->view('footer');
	}
	
	 function fresh()
	{
		$this->system_user->check_session('1');
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('fresh');
		$this->load->view('footer');
	}
	
	 function play()
	{
		$this->system_user->check_session('1');
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('view');
		$this->load->view('footer');
	}
	
	 function playlist()
	{
		$this->system_user->check_session('1');
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('playlist');
		$this->load->view('footer');
	}
	
	 function search()
	{
		$this->system_user->check_session('1');
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('search');
		$this->load->view('footer');
	}
	
	 function group()
	{
		$this->system_user->check_session('1');
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('group');
		$this->load->view('footer');
	}
	
	
	function logout(){
		$this->session->sess_destroy();
		redirect('kinnara');
	}
	
	
}
