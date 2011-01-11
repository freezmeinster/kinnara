<script type="text/javascript">
  $(document).ready(function() 
    {
       $("#edit").hide();
        $( "#nguk" ).click(function() {
	$("#edit").show('clip','slow');
	$("#detil").hide();
	
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "elm",
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "silver",
		plugins : "pagebreak,style,advhr,advimage,advlink,emotions,iespell,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
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

	
	});
    });
</script>
<br>
<div id="edit">
<?php 
$id_user = $this->session->userdata('id_user');
$id = $this->uri->segment('3');
$this->db->reconnect();
$query = $this->db->query("select * from music m,user u,category c where m.id_user=u.id_user and c.id_cat = m.id_cat and m.id_music = $id");
$row = $query->row_array();
$title = $row['m.title'];
$ids = $row['m.id_user'];
$artist = $row['m.artist'];
$album = $row['m.album'];
$genre = $row['c.name'];
$desc = $row['m.desc'];
$upload_by = $row['u.name'];
$lyrics = $row['m.lyrics'];
$view = $row['m.viewed'];
?>
<table cellpadding="10">
<tr><td>Artist</td><td>:</td><td><input type="text" value="<?php echo $artist;?>" class="input"></td></tr>
<tr><td>Album</td><td>:</td><td><input type="text" value="<?php echo $album;?>" class="input"></td></tr>
<tr><td>Genre</td><td>:</td><td><?php $this->system_view->get_cat();?></td></tr>
<tr><td>Lyrics</td><td></td><td></td></tr>
<tr><td colspan="3"><textarea id="elm">asdfasdf</textarea></td></tr>
</table>
</div>

<div id="del_dialog" style="display:none;">Yakin mau hapus ?</div>
