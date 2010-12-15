<?php
class System_user extends Model {

    function System_user()
    {
        parent::Model();
    }
    
    function add_user($name,$username,$pass1,$pass2){
        if($pass1 != $pass2){
        $this->system_view->error_report('Password Not match');
        }else if ( $name == "" || $username == "" || $pass1 == "" || $pass2 == ""){
         $this->system_view->error_report('Please fill Registration Form completely');
        }else if ($pass1 == $pass2 && $name != "" && $username != "" && $pass1 != "" && $pass2 != ""){
	$enc_pass = sha1($pass1);
	$this->db->reconnect();
	$this->db->query("insert into user(username,password,name,reg_date) values('$username','$enc_pass','$name',date('now'))");
	$message = "Congratulation $name, you has been registered succesfuly in our system, now login and start to enjoy our service";
	$this->system_view->success_report($message);
	$this->system_view->success_logging("User succesfuly registerd, username is $username");
	}else echo "Nggk tau ada apa ini ";
    }
}
?>