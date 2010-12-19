<div id="text">
<h1>Your Profile</h1>
<?php
$id = $this->session->userdata('id_user');
if ($id == ''){
  echo 
  $this->system_view->static_view($static);

}else if($id != ''){
  $this->load->view('profile');
}
?>
<h1>Your Music</h1>
<?php $this->system_mp3->home_mp3_list($id);?>
<div>
	<object type="application/x-shockwave-flash" data="<?php echo base_url();?>style/dewplayer-playlist.swf" width="240" height="200" id="dewplayer" name="dewplayer">
	<param name="wmode" value="transparent" />
	<param name="movie" value="<?php echo base_url();?>style/dewplayer-playlist.swf" />
	<param name="flashvars" value="showtime=true&autoreplay=true&xml=<?php echo base_url();?>style/playlist.xml" />
	</object>

</div>

</div>
</div>