<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url();?>style/style.css" rel="stylesheet" type="text/css"/>  
  <script type="text/javascript" src="<?php echo base_url();?>style/XinhaLoader.js?lang=en&skin=xp-blue"></script>
  <script type="text/javascript" src="<?php echo base_url();?>style/jquery.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>style/jquery.validate.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>style/validate.js"></script>
  <script type="text/javascript">
    _editor_icons = "Tango" 
  </script>
  <script type="text/javascript" src="<?php echo base_url();?>style/swfobject.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/style/XinhaConfig.js"></script>

</head>
<body>
<div id="container">
<!-- header -->
<div id="header">
<div id="logo"><a href="<?php echo base_url();?>"><?php $this->system_setting->get_setting('sitename');?></a></div>
<div id="slogan"><?php $this->system_setting->get_setting('slogan');?></div>
</div>
<div id="header_menu">
<a href="<?php echo base_url();?>">Home</a> &nbsp; | &nbsp; 
<a href="<?php echo site_url();?>/kinnara/register">Register</a> &nbsp; | &nbsp; 
<a href="<?php echo site_url();?>/kinnara/login">Login</a> &nbsp; | &nbsp; 
<a href="<?php echo site_url();?>/kinnara/about">About</a> &nbsp; | &nbsp; 
</div>
