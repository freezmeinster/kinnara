<?php
class System_user extends Model {

    function System_user()
    {
        parent::Model();
    }
    
    function add_user($name,$username,$pass1,$pass2){
        $this->db->reconnect();
        $query = $this->db->query("select * from user where username like '%$username%' or name like '%$name%'");
        $row = $query->num_rows();
        if($pass1 != $pass2){
        	$this->system_view->error_report('Password Not match');
        }else if ( $name == "" || $username == "" || $pass1 == "" || $pass2 == ""){
         	$this->system_view->error_report('Please fill Registration Form completely');
        }else if ($pass1 == $pass2 && $name != "" && $username != "" && $pass1 != "" && $pass2 != ""){
		$enc_pass = $this->system_setting->hashing($pass1);
		$this->db->reconnect();
		$this->db->query("insert into user(username,password,name,reg_date) values('$username','$enc_pass','$name',date('now'))");
		$message = "Congratulation $name, you has been registered succesfuly in our system, now login and start to enjoy our service";
		$this->system_view->success_report($message);
		$this->system_view->success_logging("User succesfuly registerd, username is $username");
	}else if ($row > 0){
                $message = "Sorry, your username or name already in use";
		$this->system_view->error_report($message);
	}
    }
  
    function check_login($username,$password,$before){
	$enc_pass = $this->system_setting->hashing($password);
	$this->db->reconnect();
	$query = $this->db->query("select * from user where username like '$username' and password like '$enc_pass'");
	if ($query->num_rows() > 0){
	  $this->db->reconnect();
	  $wew = $this->db->query("select * from user where username like '$username' and password like '$enc_pass' and baned_status = 0");
	  if ($wew->num_rows() > 0){
           $row = $query->row_array();
           $data = array(
                   'id_user'   => $row['id_user'],
                   'username'  => $row['username'],
                   'password'  => $row['password']
               );
           $this->session->set_userdata($data);
           if ($before == ''){
              redirect('kinnara');
           }else redirect("kinnara/$before");
          }else{
           $message = "Your Account suspended with our administrator";
	   $this->system_view->error_report($message);
          }
         }else {
	   $message = "Sorry, Wrong username or password ";
	   $this->system_view->error_report($message);
	   $this->system_view->error_logging("Wrong user name or Password and user is $username ");
        }
    }
    
    function check_session($permission){
    $user = $this->session->userdata('username');
    $pass = $this->session->userdata('password');

       if ($user != ''){
           $this->db->reconnect();
           $query = $this->db->query("select * from user where username like '$user' and password like '$pass' and level = $permission");
          if ($query->num_rows() < 1){
            redirect('kinnara/login');
          }
       }else redirect('kinnara/login');
    }
    
    function get_user_list(){
   	$this->db->reconnect();
   	$query = $this->db->query("select username,name,strftime('%d-%m-%Y',reg_date) as date,baned_status,level from user where id_user not like '1'");
   	echo "<table class=\"sample\">\n";
    	echo "<tr><th>Username</th><th>Sure Name</th><th>Register Date</th><th>Baned</th><th>Level</th><th>Action</th></tr>\n";
   	foreach($query->result_array() as $row){
   	$username = $row['username'];
   	$name = $row['name'];
   	$reg_date = $row['date'];
   	$baned_status = $row['baned_status'];
   	$level = $row['level'];
   	  if ($baned_status == 0){
   	     $baned = "<a href=\"\" rel=\"facebox\">No</a>";
   	  }else if ($baned_status == 1){
   	     $baned = "<a href=\"\" rel=\"facebox\">Yes</a>";
   	  }
       	
       	  if ($level == 0){
   	     $lev = "<a href=\"\" rel=\"facebox\">Admin</a>";
   	  }else if ($level == 1){
   	     $lev = "<a href=\"\" rel=\"facebox\">User</a>";
   	  }
   	  
       	echo "<tr><td>$username</td><td>$name</td><td>$reg_date</td><td>$baned</td><td>$lev</td><td><a href=\"\" rel=\"facebox\">Edit</a> || <a href=\"\" rel=\"facebox\">Delete</a></td></tr>\n";
   	}
   	echo "</table>\n";
    }
    
    
    function get_video_list(){
   	$this->db->reconnect();
   	$query = $this->db->query("select * from user where id_user not like '1'");
   	echo "<table class=\"sample\">\n";
    	echo "<tr><th>Username</th><th>Sure Name</th><th>Register Date</th><th>Baned</th><th>Level</th><th>Action</th></tr>\n";
   	foreach($query->result_array() as $row){
   	$username = $row['username'];
   	$name = $row['name'];
   	$reg_date = $row['reg_date'];
   	$baned_status = $row['baned_status'];
   	$level = $row['level'];
   	  if ($baned_status == 0){
   	     $baned = "<a href=\"\" rel=\"facebox\">No</a>";
   	  }else if ($baned_status == 1){
   	     $baned = "<a href=\"\" rel=\"facebox\">Yes</a>";
   	  }
       	
       	  if ($level == 0){
   	     $lev = "<a href=\"\" rel=\"facebox\">Admin</a>";
   	  }else if ($level == 1){
   	     $lev = "<a href=\"\" rel=\"facebox\">User</a>";
   	  }
   	  
       	echo "<tr><td>$username</td><td>$name</td><td>$reg_date</td><td>$baned</td><td>$lev</td><td><a href=\"\" rel=\"facebox\">Edit</a> || <a href=\"\" rel=\"facebox\">Delete</a></td></tr>\n";
   	}
   	echo "</table>\n";
    }
}
?>