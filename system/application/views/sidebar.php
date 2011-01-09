<div id="main">
<div id="sidebar">
<h2>Default Playlist</h2>
<p><?php 
 $site = site_url();
 $default = $this->session->userdata('playlist_name_default');
 $id_playlist = $this->session->userdata('id_playlist_default');
 echo "<a href=\"$site/kinnara/listen/$id_playlist\" tip=\"Default Playlist, all music will be added here\">$default</a>";
?></p>
<br>
<h2>What's New ?</h2>
<table>
<tr><td><h3>Music</h3></td></tr>
<tr><td><strong>Newest Upload</strong></td></tr>
<tr><td><?php $this->system_view->user_info('news_upload');?></td></tr>
<tr><td><strong>Most Populer</strong></td></tr>
<tr><td><?php $this->system_view->user_info('populer_upload');?></td></tr>
<tr><td><strong>Total Music</strong></td></tr>
<tr><td><?php $this->system_view->user_info('total_upload');?></td></tr>
<tr><td><h3>User</h3></td></tr>
<tr><td><strong>Newest User</strong></td></tr>
<tr><td><?php $this->system_view->user_info('new_user');?></td></tr>
<tr><td><strong>Most Active User</strong></td></tr>
<tr><td><?php $this->system_view->user_info('active_user');?></td></tr>
<tr><td><strong>All User</strong></td></tr>
<tr><td><?php $this->system_view->user_info('total_user');?></td></tr>
</table>
<br>
<?php
	$admin = $this->uri->segment('1');
	if ($admin == "admin"){
          $this->load->view('admin/sidebar');
	}
?>
</div>