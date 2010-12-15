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
	
	function about()
	{
	        $data['static'] = "about"; 
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('body',$data);
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
	
}
