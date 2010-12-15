<?php
class System_view extends Model {

    function System_view()
    {
        parent::Model();
    }

    function static_view($name){
        $this->db->reconnect();
        $this->db->cache_on();
        $query = $this->db->query("select value from static_view where name like '$name'");
        $row = $query->row_array();
        $value = $row['value'];
        echo "$value";
    }
    
    function error_report($message){
      $data['static'] = "$message"; 
      $this->load->view('header');
      $this->load->view('sidebar');
      $this->load->view('error',$data);
      $this->load->view('footer');
    }
    
     function error_logging($message){
      $id_user = $this->session->userdata('id');
      $remote_ip = $_SERVER['REMOTE_ADDR'];
        if ($id_user == ""){
           $id_user = 0;
        }
      $this->db->reconnect();
      $this->db->query("insert into system_log(id_user,ip,action,stat,time) values($id_user,'$remote_ip','$message',0,datetime('now'))");
    }
    
    function success_report($message){
      $data['static'] = "$message"; 
      $this->load->view('header');
      $this->load->view('sidebar');
      $this->load->view('success',$data);
      $this->load->view('footer');
    }
    
    function success_logging($message){
      $id_user = $this->session->userdata('id');
      $remote_ip = $_SERVER['REMOTE_ADDR'];
        if ($id_user == ""){
           $id_user = 0;
        }
      $this->db->reconnect();
      $this->db->query("insert into system_log(id_user,ip,action,stat,time) values($id_user,'$remote_ip','$message',1,datetime('now'))");
    }
    
    function get_static_edit($name){
    $this->db->reconnect();
    $query = $this->db->query("select value from static_view where name like '$name'");
    $row = $query->row_array();
    return $row['value'];
    }
    
    function set_static_view($title,$content){
    $this->db->reconnect();
    $this->db->query("update static_view set value='$content' where name like '$title'");
    $this->system_view->success_report("Static content of $title page update successfuly");
    $this->system_view->success_logging("Static content of $title page update successfuly");
    }

    function system_info($item){
       if($item == "main_memory"){
        $main_mem = shell_exec("free -m | grep Mem | awk '{print $2}'");
        echo "$main_mem Mb";
       }else if ($item == "main_storage"){
         $main_hd_raw = shell_exec("df -m | grep \"/dev/root\" | awk '{print $2}'");
         $main_hd = $main_hd_raw/1024;
         $data = ceil($main_hd);
         echo "$data Gb";
       }else if ($item == "free_memory"){
         $free_mem = shell_exec("free -m | grep Mem | awk '{print $4}'");
         $main_mem = shell_exec("free -m | grep Mem | awk '{print $2}'");
         $percent = ceil(($free_mem/$main_mem)*100);
         echo "$percent %";
       }else if ($item == "free_storage"){
         $main_hd_raw = shell_exec("df -m | grep \"/dev/root\" | awk '{print $2}'");
         $main_hd_raw_free = shell_exec("df -m | grep \"/dev/root\" | awk '{print $4}'");
         $percent = ceil(($main_hd_raw_free/$main_hd_raw)*100);
         echo "$percent %";
       }else if($item == 'uptime'){
         $raw_uptime=shell_exec("cut -f1 -d' ' /proc/uptime | cut -f1 -d.");
	    if ($raw_uptime <= 60 ){
	    $time = "Seconds";
	    $hasil = $raw_uptime;
	    }else if($raw_uptime > 60 && $raw_uptime <= 3600){
	    $time = "Minutes";
	    $hasil = ceil($raw_uptime/60);
	    }else if ($raw_uptime > 3600 && $raw_uptime <= 86400){
	    $time = "Hours";
	    $hasil = ceil($raw_uptime/3600);
	    }
         echo "$hasil $time";
       }else if ($item == "user"){
          $this->db->reconnect();
          $query = $this->db->query("select count(*) as total from user where id_user not like 1");
          $row = $query->row_array();
          echo $row['total'];
       }
    }
}
?>
