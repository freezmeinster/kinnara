<?php

class Admin extends Controller {

	function Admin()
	{
		
		parent::Controller();	
	}
	
	function index()
	{
	        $this->system_user->check_session('0');
		$this->load->view('admin/header');
		$this->load->view('sidebar');
		$this->load->view('admin/index');
		$this->load->view('admin/footer');;
	}
	
	function edit_static($view = "")
	{ 
	       $this->system_user->check_session('0');
	       if( $view == ""){
		$this->load->view('admin/header');
		$this->load->view('sidebar');
		$this->load->view('admin/edit_static');
		$this->load->view('admin/footer');
		}else if($view != ""){
		  $content = $this->system_view->get_static_edit($view);
		  $data['content'] = $content;
		  $data['title'] = $view;
		  $this->load->view('admin/header');
		  $this->load->view('sidebar');
		  $this->load->view('admin/edit_static_view',$data);
		  $this->load->view('admin/footer');
		}
	}
	
	function user()
	{
	        $this->system_user->check_session('0');
		$this->load->view('admin/header');
		$this->load->view('sidebar');
		$this->load->view('admin/user');
		$this->load->view('admin/footer');;
	}
	
	function videos()
	{
	        $this->system_user->check_session('0');
		$this->load->view('admin/header');
		$this->load->view('sidebar');
		$this->load->view('admin/video');
		$this->load->view('admin/footer');;
	}
	
        function sysinfo($item){
        $this->system_view->system_info($item);
        }
        
        function userinfo($item){
        $this->system_view->user_info($item);
        }
	
	
}
