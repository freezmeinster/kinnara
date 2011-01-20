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
$site = site_url();
?>
<div id="text">
<div id="content" style="padding-left:30px;">
	
	<h1>Now Playing <?php echo $title; ?></h1>
         <br>
	<div id="dewplayer_content">
	<object data="<?php echo base_url();?>style/dewplayer-bubble.swf" width="300" height="80" name="dewplayer" id="dewplayer" type="application/x-shockwave-flash">
	<param name="movie" value="<?php echo base_url();?>style/dewplayer-bubble.swf" />
	<param name="flashvars" value="autostart=1;mp3=<?php echo $site; ?>/lib_kinnara/gen_url/<?php echo $id;?>" />
	<param name="wmode" value="transparent" />
	</object>
	</div>


<script type="text/javascript">
var flashvars = {
  mp3: "<?php echo $site;?>/lib_kinnara/gen_url/<?php echo $id;?>",
  autostart:1
};
var params = {
  wmode: "transparent"
};
var attributes = {
  id: "dewplayer"
};
swfobject.embedSWF("<?php echo base_url();?>style/dewplayer-bubble.swf", "dewplayer_content", "250", "65", "9.0.0", false, flashvars, params, attributes);
</script>
</div>
<div id="detil">
<table cellpadding="10">
<tr><td>Artist</td><td>:</td><td><?php echo $artist;?></td></tr>
<tr><td>Album</td><td>:</td><td><?php echo $album;?></td></tr>
<tr><td>Genre</td><td>:</td><td><?php echo $genre;?></td></tr>
<tr><td>Total Viewed</td><td>:</td><td><?php echo $view;?> times</td></tr>
<tr><td>Upload By</td><td>:</td><td><?php echo $upload_by;?></td></tr>
<tr><td>Lyrics</td><td>:</td><td><?php echo $lyrics;?></td></tr>
</table>
<?php
if ($id_user == $ids){
  echo "<button class=\"button\" id=\"nguk\">Edit Music</button>";
  echo "<button class=\"button\" id=\"del_music\">Delete Music</button>";
}
?>
</div>
<?php
if ($id_user == $ids){
  $this->load->view('edit_music');
}
?>
</div>
</div>
