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
  <script type="text/javascript" src="<?php echo base_url();?>style/swfobject.js"></script>
 <script type="text/javascript">
    $(function (){
        $('a.ajax').click(function() {
            var url = this.href;
            var dialog = $('<div style="display:hidden" title="Add Music to Playlist"></div>').appendTo('body');
            // load remote content
            dialog.load(
                url, 
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                    draggable:false,
                    resizable: false,  
		    modal: true,  
		    width: 400,  
		    height: 200, 
		    hide: "explode"
		   

                    });
                }
            );
            //prevent the browser to follow the link
            return false;
        });
    });
    </script>
<script type="text/javascript">  
tinyMCE.init({
		// General options
		mode : "exact",
		elements : "elm",
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "silver",
		plugins : "pagebreak,style,advhr,advimage,advlink,emotions,iespell,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,

		// Example content CSS (should be your site CSS)
		content_css : "<?php echo base_url();?>style/css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "<?php echo base_url();?>style/lists/template_list.js",
		external_link_list_url : "<?php echo base_url();?>style/lists/link_list.js",
		external_image_list_url : "<?php echo base_url();?>style/lists/image_list.js",
		media_external_list_url : "<?php echo base_url();?>style/lists/media_list.js",

	});

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
    echo "<a href=\"$site/kinnara/group\">Group</a> &nbsp; | &nbsp;"; 
    echo "<a href=\"$site/kinnara/search\">Search</a> &nbsp; | &nbsp;"; 
    echo "<a href=\"$site/kinnara/logout\">Logout</a> &nbsp; | &nbsp;";
    if ($GLOBALS['level'] == 0){
    echo "<a href=\"$site/admin\">Admin</a> &nbsp; | &nbsp;";
    }
 }
?>
</div>