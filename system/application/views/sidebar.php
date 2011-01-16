<div id="main">
<div id="sidebar">

<p><?php 
 $ada = $this->session->userdata('id_user');
 $default = $this->session->userdata('playlist_name_default');
 if ($ada != '' && $default != ''){
 $site = site_url();
 echo "<h2>Default Playlist</h2>";
 
 $id_playlist = $this->session->userdata('id_playlist_default');
 $a = $this->db->query("select * from listening where id_playlist = $id_playlist");
 $total = $a->num_rows();
 echo "<a href=\"$site/kinnara/listen/$id_playlist\" tip=\"Default Playlist, all music will be added here. <br><br> Total $total Musics\">$default</a>";
 
 echo "<br><h2>Search Music</h2>"; 
 echo "<form action=\"$site/lib_kinnara/search/\" method=\"POST\">";
 echo "<table>";
 echo "<tr><td><input type=\"text\" name=\"word\" class=\"input\" tip=\"Search your favorite music here, just enter song title or artist name and press 'Search'\"></td></tr>";
 echo "<tr><td><input type=\"submit\" value=\"Search\" class=\"button\"></td></tr>";
 echo "</table>";
 echo "</form>";
 }
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