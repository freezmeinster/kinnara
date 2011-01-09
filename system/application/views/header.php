<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->system_setting->get_setting('sitename');?> || <?php echo $this->system_setting->get_setting('slogan');?> </title>
  <link rel="shortcut icon" href="<?php echo base_url();?>style/favicon.png">
  <link href="<?php echo base_url();?>style/style.css" rel="stylesheet" type="text/css"/>  
  <link href="<?php echo base_url();?>style/cupertino/jquery-ui.css" rel="stylesheet" type="text/css"/>   
  <script type="text/javascript" src="<?php echo base_url();?>style/tiny_mce/tiny_mce.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>style/jquery.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>style/jquery-ui.js"></script> 
  <script type="text/javascript" src="<?php echo base_url();?>style/jquery.qtip.js"></script> 
  <script type="text/javascript" src="<?php echo base_url();?>style/function.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>style/swfobject.js"></script>
 
    
    <script type="text/javascript">
$(function() {
    $(".button").button();
	});
</script>

<script type="text/javascript">  

</script> 
</head>
<body>
<div id="container">
<!-- header -->
<div id="header">
<div id="logo"><a href="<?php echo base_url();?>"><?php echo $this->system_setting->get_setting('sitename');?></a></div>
<div id="slogan"><?php echo $this->system_setting->get_setting('slogan');?></div>
</div>
<div id="header_menu">
<?php
$GLOBALS['id'] = $this->session->userdata('id_user');
$GLOBALS['user'] = $this->session->userdata('username');
$GLOBALS['password']= $this->session->userdata('password');
$id = $GLOBALS['id'];
$user = $GLOBALS['user'];
$password = $GLOBALS['password'];
?>
<a href="<?php echo base_url();?>">Home</a> &nbsp; | &nbsp; 
<?php
 $site = site_url();
 if ($id == ''){
    echo "<a href=\"$site/kinnara/register\">Register</a> &nbsp; | &nbsp;"; 
    echo "<a href=\"$site/kinnara/login\">Login</a> &nbsp; | &nbsp;";  
 }else {
    $this->db->reconnect();
    $query = $this->db->query("select * from user where id_user = $id");
    $row = $query->row_array();
    $GLOBALS['level'] = $row['level']; 
    echo "<a href=\"$site/kinnara/upload\">Upload</a> &nbsp; | &nbsp;"; 
    echo "<a href=\"$site/kinnara/playlist\">Playlist</a> &nbsp; | &nbsp;";
    echo "<a href=\"$site/kinnara/fresh\">Fresh Music</a> &nbsp; | &nbsp;";
    echo "<a href=\"$site/kinnara/search\">Search</a> &nbsp; | &nbsp;"; 
    echo "<a href=\"$site/kinnara/logout\">Logout</a> &nbsp; | &nbsp;";
    if ($GLOBALS['level'] == 0){
    echo "<a href=\"$site/admin\">Admin</a> &nbsp; | &nbsp;";
    }
 }
?>
</div>