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
   
   function get_cat(){
      echo "<select name=\"category\">";
      $this->db->reconnect();
      $query = $this->db->query("select * from category");
	foreach($query->result_array() as $row){
	$name = $row['name'];
	$value = $row['id_cat'];
	echo "<option value=\"$value\">$name</option>";
	}
      echo "</select>";
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
	    }else if ($raw_uptime > 86400 && $raw_uptime <= 604800){
	    $time = "Days";
	    $hasil = ceil($raw_uptime/86400);
	    }
         echo "$hasil $time";
       }else if ($item == "user"){
          $this->db->reconnect();
          $query = $this->db->query("select count(*) as total from user where id_user not like 1");
          $row = $query->row_array();
          echo $row['total'];
       }else if ($item == "mp3"){
       $directory = $this->system_setting->get_setting('mp3dir');
       $dir = "$directory/";
	if (glob("$dir*.mp3") != false)
	{
	$filecount = count(glob("$dir*.mp3"));
	echo "$filecount Files";
	}
	else
	{
	echo "0 Files";
	}
       }
    }
    
    function user_info($item){
      $id_user = $this->session->userdata('id_user');
      $site = site_url();
      if($item == 'news_upload'){
         echo "<ul padding=\"10\">";
         $this->db->reconnect();
         $query = $this->db->query("select * from music order by uploaded_date desc limit 5");
         foreach ($query->result_array() as $row){
            $title = $row['title'];
            $artist = $row['artist'];
            $id = $row['id_music'];
            if ($id_user != ''){
            echo "<li><a href=\"$site/kinnara/play/$id\">$title</a> by $artist</li>";
            }else if ($id_user == '' ){echo "<li>$title by $artist</li>";}
         }
         echo "</ul>";
      }else if($item == 'populer_upload'){
        echo "<ul padding=\"10\">";
         $this->db->reconnect();
         $query = $this->db->query("select * from music order by viewed desc limit 5");
         foreach ($query->result_array() as $row){
            $title = $row['title'];
            $artist = $row['artist'];
            $id = $row['id_music'];
            if ($id_user != ''){
            echo "<li><a href=\"$site/kinnara/play/$id\">$title</a> by $artist</li>";
            }else  if ($id_user == '' ){echo "<li>$title by $artist</li>";}
         }
         echo "</ul>";
      }else if($item == 'new_user'){
        echo "<ul padding=\"10\">";
         $this->db->reconnect();
         $query = $this->db->query("select * from user where id_user not like 1 order by reg_date desc limit 5");
         foreach ($query->result_array() as $row){
           $name = $row['name'];
            echo "<li>$name</li>";
         }
         echo "</ul>";
      }else if($item == 'active_user'){
        echo "<ul padding=\"10\">";
         $this->db->reconnect();
         $query = $this->db->query("select u.name,count(m.id_user) as nguk from music m, user u where m.id_user=u.id_user and u.id_user not like 1 group by m.id_user order by nguk desc limit 5");
         foreach ($query->result_array() as $row){
           $name = $row['u.name'];
            echo "<li>$name</li>";
         }
         echo "</ul>";
      }else if($item == "total_upload"){
        $this->db->reconnect();
        $query = $this->db->query("select count(*) as total from music");
        $row = $query->row_array();
        echo "<ul>";
        echo "<li>".$row['total']."  Files</li>";
        echo "</ul>";
      }else if($item == "total_user"){
        $this->db->reconnect();
        $query = $this->db->query("select count(*) as total from user where id_user not like 1");
        $row = $query->row_array();
        echo "<ul>";
        echo "<li>".$row['total']."  people</li>";
        echo "</ul>";
      }
    }
}
?>
