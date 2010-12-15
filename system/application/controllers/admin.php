<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('admin/header');
		$this->load->view('sidebar');
		$this->load->view('admin/index');
		$this->load->view('admin/footer');;
	}
	
	function edit_static($view = "")
	{ 
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

        function sysinfo($item){
        $this->system_view->system_info($item);
        }
	
	
}
