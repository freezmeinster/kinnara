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
	  
	  function edit_profile($id){
	  $name = $this->input->post('name');
	  $email = $this->input->post('email');
	  $phone = $this->input->post('phone');
	  $web = $this->input->post('web');
	  $this->system_user->edit_user($id,$name,$email,$phone,$web);
	  $this->system_view->success_report("Your Profile has been Upadated");
	  }
	  
	  function edit_password($id){
	  $password = $this->input->post('password');
	  $confirm_password = $this->input->post('confirm_password');
	  $this->system_user->edit_password($id,$password,$confirm_password);
	  $this->system_view->success_report("Your Password has been Upadated");
	  }
	  
	  function add_playlist($id){
	  
	  $this->system_user->check_session('1');
	  $site = site_url();
	  $id_user = $this->session->userdata('id_user');
	  $nguk = $this->db->query("select * from playlist where id_user = $id_user");
	  if ($nguk->num_rows() < 1){
	  echo "Sorry , You don't have a Playlist , create one <a href=\"$site/kinnara/playlist\">here</a>";
	  }else{
	  $query = $this->db->query("select * from music where id_music = $id");
	  $row = $query->row_array();
	  $id_music = $row['id_music'];
	  $name = $row['title'];
	  $artist = $row['artist'];
	  $hah = $this->db->query("select * from playlist where id_user = $id_user");
	  echo "<form action=\"$site/lib_kinnara/add_music_playlist/\" method=\"POST\"> Choose a playlist: <select name=\"playlist\">";
	  foreach($hah->result_array() as $row){
	  $id_playlist = $row['id_playlist'];
	  $ngek = $row['name'];
	  echo "<option value=\"$id_playlist\">$ngek</option>";
	  }
	  
	  echo "</select><input type=\"hidden\" name=\"id_music\" value=\"$id_music\"><br><br>";
	  echo "Are you sure to add <strong>$name</strong> by <strong>$artist</strong> to your playlist ?<br><br>";
	  echo "<input type=\"submit\" value=\"Yes\" class=\"button\">";
	  echo "</form>";
	  }
	  }
	  
	  function add_music_playlist(){
	  $playlist = $this->input->post('playlist');
	  $id_music = $this->input->post('id_music');
	  $pesan = $this->system_mp3->add_to_playlist($playlist,$id_music);
	  echo $pesan;
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
	 $config['allowed_types'] = 'mp3';
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
    
    function create_playlist(){
    $this->system_user->check_session('1');
    $id = $this->session->userdata('id_user');
    $name = $this->input->post('name');
    $this->system_mp3->create_playlist($id,$name);
    }
    
    function del_playlist($id_playlist){
    $this->system_user->check_session('1');
    $this->db->reconnect();
    $this->db->query("delete from playlist where id_playlist = $id_playlist");
    $this->db->query("delete from listening where id_playlist = $id_playlist");
    $data = array(
                   'id_playlist_default'   => '',
                   'playlist_name_default'  => ''
               );
    $this->session->set_userdata($data);
    $this->system_view->success_report("Playlist deleted successfuly");
    }
    
    function empty_playlist($id_playlist){
    $this->system_user->check_session('1');
    $this->db->reconnect();
    $this->db->query("delete from listening where id_playlist = $id_playlist");
    $this->system_view->success_report("Playlist truncated successfuly ");
    }
    
    function default_playlist($id_playlist){
    $this->system_user->check_session('1');
    $id_user = $this->session->userdata("id_user");
    $this->db->reconnect();
    $p = $this->db->query("select * from playlist where id_playlist = $id_playlist");
    $row = $p->row_array();
    $name = $row['name'];
    $data = array(
                   'id_playlist_default'   => $id_playlist,
                   'playlist_name_default'  => $name
               );
    $this->db->reconnect();
    $this->db->query("update user set playlist = $id_playlist where id_user = $id_user");
    $this->session->set_userdata($data);
    $this->system_view->success_report("Playlist $name set to default Playlist");
    }
    
    function del_mp3_from_playlist($id_playlist,$id_music){
    $this->system_user->check_session('1');
    $this->db->reconnect();
    $this->db->query("delete from listening where id_playlist = $id_playlist and id_music=$id_music");
    $this->system_view->success_report("One Music successfuly deleted from playlist ");
    }
    
    function get_xml($id){
    $this->system_mp3->get_xml($id);
    }
    
       function search(){
    $word = $this->input->post('word');
    if ($word == ''){
       $this->system_view->error_report("Please input word to search");
    }else if ($word != ''){ 
                $data['word'] = $word;
                $this->load->view('header');
		$this->load->view('sidebar');
                $this->load->view('search_result',$data);
		$this->load->view('footer');

    }
    }
    
    function error_search(){
    $this->load->view('search_error');
    }
	  	
}
