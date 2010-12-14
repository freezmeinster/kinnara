<div id="text">
<div id="content">
	
	<h1><img src="zdewplayer.png" alt="Dewplayer" /></h1>
  
	<div id="dewplayer_content">
	<object data="<?php echo base_url();?>style/dewplayer-bubble.swf" width="300" height="80" name="dewplayer" id="dewplayer" type="application/x-shockwave-flash">
	<param name="movie" value="<?php echo base_url();?>style/dewplayer-bubble.swf" />
	<param name="flashvars" value="mp3=http://localhost/kinnara/mp3/hah.mp3" />
	<param name="wmode" value="transparent" />
	</object>
	</div>

</div>

<script type="text/javascript">
var flashvars = {
  mp3: "http://localhost/kinnara/mp3/hah.mp3"
};
var params = {
  wmode: "transparent"
};
var attributes = {
  id: "dewplayer"
};
swfobject.embedSWF("<?php echo base_url();?>style/dewplayer-bubble.swf", "dewplayer_content", "250", "65", "9.0.0", false, flashvars, params, attributes);
</script>
<div>
	<object type="application/x-shockwave-flash" data="<?php echo base_url();?>style/dewplayer-playlist.swf" width="240" height="200" id="dewplayer" name="dewplayer">
	<param name="wmode" value="transparent" />
	<param name="movie" value="<?php echo base_url();?>style/dewplayer-playlist.swf" />
	<param name="flashvars" value="showtime=true&autoreplay=true&xml=<?php echo base_url();?>style/playlist.xml" />
	</object>

</div>
</div>
</div>