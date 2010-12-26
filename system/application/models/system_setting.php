<?php
class System_setting extends Model {

    function System_setting()
    {
        parent::Model();
    }

    function get_setting($name){
        $this->db->reconnect();
        $query = $this->db->query("select value from setting where name like '$name'");
        $row = $query->row_array();
        $value = $row['value'];
        return $value;
    }
    
    function hashing($message){
      $main_algo = "snefru";
      $salt_algo = "whirlpool";
      $wew = str_split($message);
      foreach ($wew as $hah){
	$salt = hash($salt_algo, $message);
	$part_message = hash($main_algo, $hah);
	$nguk = $salt . $part_message;
	$final = hash($main_algo, $nguk);
      }
      return $final;
    }
    
     function get_log_list(){
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
   	
   	 if ($baned_status == 1){
   	 $baned = "Baned";
   	 } else if($baned_status == 0){$baned == "Active";}
   	 
   	 if($level == 0){
   	  $lev = "Administrator";
   	 }else $lev = "User";
       	echo "<tr><td>$username</td><td>$name</td><td>$reg_date</td><td>$baned</td><td>$lev</td><td><a href=\"\" rel=\"facebox\">Edit</a> || <a href=\"\" rel=\"facebox\">Delete</a></td></tr>\n";
   	}
   	echo "</table>\n";
    }
}
?>