<div id="text">

<?php 
$site = site_url();
$this->db->reconnect();
$query = $this->db->query("select * from playlist where id_playlist = $id_playlist");
$row = $query->row_array();
$name = $row['name'];
echo "<h1>Now Playing $name Playlist</h1><br><br>\n"
?>
<div style="background:#3096A8;height:200px;width:240px;">
	<object type="application/x-shockwave-flash" data="<?php echo base_url();?>style/dewplayer-playlist.swf" width="240" height="200" id="dewplayer" name="dewplayer">
	<param name="wmode" value="transparent" />
	<param name="movie" value="<?php echo base_url();?>style/dewplayer-playlist.swf" />
	<param name="flashvars" value="autoplay=true&showtime=true&autoreplay=true&xml=<?php echo "$site/lib_kinnara/get_xml/$id_playlist";?>" />
	</object>

</div>
</div>
</div> 
