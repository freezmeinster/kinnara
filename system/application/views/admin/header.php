<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->system_setting->get_setting('sitename');?> || <?php echo $this->system_setting->get_setting('slogan');?> </title>
 <link rel="shortcut icon" href="<?php echo base_url();?>style/favicon.png">
  <link href="<?php echo base_url();?>style/style.css" rel="stylesheet" type="text/css"/>  
  <link href="<?php echo base_url();?>style/facebox.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="<?php echo base_url();?>style/XinhaLoader.js?lang=en&skin=xp-blue"></script>
  <script type="text/javascript" src="<?php echo base_url();?>style/jquery.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>style/jquery.validate.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>style/validate.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>style/flowplayer.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>style/facebox.js"></script>
  <script type="text/javascript">
    _editor_icons = "Tango" 
  </script>
  <script type="text/javascript" src="<?php echo base_url();?>style/swfobject.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/style/XinhaConfig.js"></script>
   <script type="text/javascript">
    $f("player", "<?php echo base_url();?>style/flowplayer-3.2.5.swf", {
	plugins: {
		audio: {
			url: '<?php echo base_url();?>style/flowplayer.audio.swf'
		}
	}
     }); 
  </script>
   <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : '<?php echo base_url();?>style/loading.gif',
        closeImage   : '<?php echo base_url();?>style/closelabel.png'
      })
    })
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
<a href="<?php echo site_url();?>/admin/">Home</a> &nbsp; | &nbsp; 
<a href="<?php echo site_url();?>/admin/user">User</a> &nbsp; | &nbsp; 
<a href="<?php echo site_url();?>/admin/videos">Video</a> &nbsp; | &nbsp; 
</div>
