<?php 
$id = $this->uri->segment('3');
$this->db->reconnect();
$query = $this->db->query("select * from music m,user u,category c where m.id_user=u.id_user and c.id_cat = m.id_cat and m.id_music = $id");
$row = $query->row_array();
$title = $row['m.title'];
$artist = $row['m.artist'];
$album = $row['m.album'];
$genre = $row['c.name'];
$desc = $row['m.desc'];
$upload_by = $row['u.name'];
$lyrics = $row['m.lyrics'];
$view = $row['m.viewed'];
?>
<div id="text">
<div id="content" style="padding-left:30px;">
	
	<h1>Now Playing <?php echo $title; ?></h1>
         <br>
	<div id="dewplayer_content">
	<object data="<?php echo base_url();?>style/dewplayer-bubble.swf" width="300" height="80" name="dewplayer" id="dewplayer" type="application/x-shockwave-flash">
	<param name="movie" value="<?php echo base_url();?>style/dewplayer-bubble.swf" />
	<param name="flashvars" value="mp3=http://192.168.70.248/kinnara/index.php/lib_kinnara/gen_url/<?php echo $id;?>" />
	<param name="wmode" value="transparent" />
	</object>
	</div>


<script type="text/javascript">
var flashvars = {
  mp3: "http://192.168.70.248/kinnara/index.php/lib_kinnara/gen_url/<?php echo $id;?>"
};
var params = {
  wmode: "transparent"
};
var attributes = {
  id: "dewplayer"
};
swfobject.embedSWF("<?php echo base_url();?>style/dewplayer-bubble.swf", "dewplayer_content", "250", "65", "9.0.0", false, flashvars, params, attributes);
</script>
<table cellpadding="10">
<tr><td>Artist</td><td>:</td><td><?php echo $artist;?></td></tr>
<tr><td>Album</td><td>:</td><td><?php echo $album;?></td></tr>
<tr><td>Genre</td><td>:</td><td><?php echo $genre;?></td></tr>
<tr><td>Total Viewed</td><td>:</td><td><?php echo $view;?> times</td></tr>
<tr><td>Description</td><td>:</td><td><?php echo $desc;?></td></tr>
<tr><td>Upload By</td><td>:</td><td><?php echo $upload_by;?></td></tr>
<tr><td>Lyrics</td><td>:</td><td><?php echo $lyrics;?></td></tr>
</table>
</div>
</div>
</div>