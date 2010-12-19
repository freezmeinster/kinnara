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
	
	  function login($before=""){
	  $username = $this->input->post('username');
	  $password = $this->input->post('password');
	  $this->system_user->check_login($username,$password,$before);
	  }
	
	  function error_page(){
	  $this->system_view->error_report('The page you requested was not found.');
	  }
	  
	
	  
	  function gen_url($id_mp3){
	  $this->system_user->check_session('1');
	  $this->system_mp3->add_counter($id_mp3);
	  $this->system_mp3->gen_url($id_mp3);
	  }
	 
	 function upload(){
	 $this->system_user->check_session('1');
	 $user = $this->session->userdata('id_user');
         $title = $this->input->post('title');
         $artist = $this->input->post('artist');
         $album = $this->input->post('album');
         $cat = $this->input->post('category');
         $perm = $this->input->post('permission');
         $desc = $this->input->post('description');
         $lyrics = $this->input->post('lyrics');
         $target_upload = $this->system_setting->get_setting('mp3dir');
         $config['upload_path'] = "$target_upload";
	 $config['allowed_types'] = 'mp3|jpg';
	 $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload())
		{
		   $error =  $this->upload->display_errors();
		   $this->system_view->error_report($error);
		}else {
		$data = $this->upload->data();
		$filename = $data['raw_name'];
		$this->system_mp3->register_music($user,$filename,$title,$cat,$perm,$desc,$lyrics,$artist,$album);
		$this->system_view->success_report("One music Successfuly Uploaded, check in Fresh Music menu");
		}	
    
    }
	  
		
}
